<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Views\View;

class UsersController
{
    public function form()
    {
        View::render('registration', []);
    }

    public function save()
    {
        $email = $_POST['useremail'];
        $name = $_POST['username'];
        $password = $_POST['userpassword'];
        $userRepository = new UserRepository();
        $userRepository->addUser($email, $name, $password);
        header('Location: http://blog.local/home/default');
        die;
    }
}