<?php


class UsersController
{
    function form()
    {
        include 'pages/registration.php';
    }

    function save()
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