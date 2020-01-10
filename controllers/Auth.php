<?php


namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Controllers\UsersController;

class Auth
{

    public static function getUser ()
    {

        if(isset($_SESSION['userId'])) {
            $userId= new userRepository();
            $user=$userId->getById($_SESSION['userId']);
            return $user;
        }else{
            $user=null;
            return $user;
        }
    }
}