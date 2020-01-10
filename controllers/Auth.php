<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

//TODO: это не контроллер. этот класс нужно отсуда убрать
class Auth
{
    public static function getUser()
    {
        if (isset($_SESSION['userId'])) {
            $userId = new UserRepository();

            return $userId->getById($_SESSION['userId']);
        }

        return null;
    }
}
