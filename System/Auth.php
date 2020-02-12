<?php

namespace App\System;

use App\Repositories\UserRepository;

class Auth
{
    public static function getUser()
    {
        if (isset($_SESSION['userId'])) {
            $userRepository = new UserRepository();

            return $userRepository->getById($_SESSION['userId']);
        }
// тут не нужно писать else. напиши просто return null. и отформатируй код
        else {return null;}
    }
}
