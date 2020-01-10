<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\UserRepository;
use App\Views\View;
use App\Controllers\Auth;

class UsersController
{
    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function form()
    {
        $user=Auth::getUser();
        if($user==null){
            View::render('registration', [], []);
        }else{
            header('Location: http://blog.local/home/default');
            die;
        }
    }

    public function loginForm()
    {
        $user=Auth::getUser();
        if($user==null){
        View::render('login', [], []);
        }else{
            header('Location: http://blog.local/home/default');
            die;
        }
    }

    public function save()
    {
        $email = $_POST['useremail'];
        $name = $_POST['username'];
        $password = $_POST['userpassword'];
        $this->userRepository->addUser($email, $name, $password);
        $user= $this->userRepository->getByNamePassword($email,$password);
        if(isset($user)){
            $_SESSION['userId']=$user['id'];
        }
        header('Location: http://blog.local/home/default');
        die;
    }

    public function login()
    {
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];
        $user= $this->userRepository->getByNamePassword($email,$password);
        if(isset($user)){
            $_SESSION['userId']=$user['id'];
        }
        header('Location: http://blog.local/home/default');
        die;
    }
}