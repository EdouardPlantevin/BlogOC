<?php

namespace App\Controllers;

abstract class Controller 
{
    public function render(string $file, array $data = [], string $template = 'default')
    {
        extract($data);

        ob_start();

        require_once ROOT . '/Views/' . $file . '.php';

        $body = ob_get_clean();

        require_once ROOT . '/Views/' . $template . '.php';
    }
} 