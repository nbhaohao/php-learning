<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index');
    }

    public function upload(): string
    {
        echo '<pre>';
        var_dump($_FILES);
        echo '</pre>';
        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];
        move_uploaded_file(
            $_FILES['receipt']['tmp_name'],
            $filePath
        );
        echo '<pre>';
        var_dump(pathinfo($filePath));
        echo '</pre>';
        return '';
    }

}