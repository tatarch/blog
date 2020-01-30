<?php

namespace App\Views;

class View
{
    //TODO: сделай $data пустым массивом по умолчанию. убери параметр $user
    static function render($path, $data, $user)
    {
        ob_start();
        include __DIR__ . '/../pages/' . $path . '.php';
        $content = ob_get_contents();
        ob_clean();

        include __DIR__ . '/../pages/templates/default.php';
    }
}
