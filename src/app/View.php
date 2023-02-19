<?php

declare(strict_types=1);

namespace App;

class View
{
    public function __construct(protected string $view, array $params = [])
    {

    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    public function render(): string
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';
        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }
        ob_start();
        include VIEW_PATH . '/' . $this->view . '.php';
        return ob_get_clean();
    }

    public function __toString(): string
    {
        return $this->render();
    }
}