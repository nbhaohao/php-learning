<?php

namespace App;

use App\Exceptions\Container\ContainerException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{

    private array $entries = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            return $entry($this);
        }
        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    private function resolve(string $id)
    {
        $reflectionClass = new \ReflectionClass($id);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException('Class "' . $id . '" is not instantiable');
        }

        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $id;
        }

        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return new $id;
        }

        $dependencies = array_map(function (\ReflectionParameter $parameter) use ($id) {
            $name = $parameter->getName();
            $type = $parameter->getType();
            if (!$type) {
                throw new ContainerException(
                    'Failed to resolve class "' . $id . '" because param "' . $name . '" is missing a type hint'
                );
            }

            if ($type instanceof \ReflectionUnionType) {
                throw new ContainerException(
                    'Failed to resolve class "' . $id . '" because of union type for param "' . $name . '"'
                );
            }

            if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            }
            throw new ContainerException(
                'Failed to resolve class "' . $id . '" because invalid param "' . $name . '"'
            );

        }, $parameters);
        return $reflectionClass->newInstanceArgs($dependencies);
    }
}