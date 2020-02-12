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
        return null;
    }
}
