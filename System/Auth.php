<?php

namespace App\System;

use App\Repositories\UserRepository;

class Auth
{
    // тайпхинт
    public static function getUser()
    {
        if (isset($_SESSION['userId'])) {
            // сделай так чтобы при повторном вызове этого метода не шел запрос в базу
            // сохрани пользователя в статическое свойство перед тем как его отдать наружу
            // проверяй есть ли у тебя в статическом свойстве пользователь, если есть - отдавай его со свойста
            $userRepository = new UserRepository();

            return $userRepository->getById($_SESSION['userId']);
        }
        return null;
    }
}
