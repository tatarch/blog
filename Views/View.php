<?php

namespace App\Views;

class View
{
    public static function render(string $path, array $data = [], string $template = 'default'): void
    {
        ob_start();
        include __DIR__ . '/../pages/' . $path . '.php';
        $content = ob_get_contents();
        ob_clean();

        include __DIR__ . '/../pages/templates/' . $template . '.php';
    }
}
