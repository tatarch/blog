<?php

namespace App\Views;

class View
{
    static function render($path, $data, $user)
    {
        ob_start();
        include __DIR__ . '/../pages/' . $path . '.php';
        $content = ob_get_contents();
        ob_clean();

        include __DIR__ . '/../pages/templates/default.php';
    }
}
