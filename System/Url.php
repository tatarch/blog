<?php

namespace App\System;

class Url
{
    public static function getRoot(): string
    {
        return (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    }
}
