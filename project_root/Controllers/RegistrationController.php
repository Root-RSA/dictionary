<?php
namespace Controllers;

use System\View;
use System\Conn;
use System\Security;
use Models\UserModel;


class RegistrationController
{
    public function actionRegister()
    {
        //Sanitize the iserted data
        $credentials = Security::sanitize();

        $user = new UserModel();

        //Check if the username is already in use
        $check = $user->userExists($credentials['username']);

        if(!$check) {
            $this->createUser($user, $credentials['username'], $credentials['email'], password_hash($credentials['password'], PASSWORD_DEFAULT));
        } else {
            $msg = _("Другой пользователь с таким именем уже зарегистрирован. Попоробуйте другое имя.");
            setcookie('feedback', $msg, time()+5, BASE, false, false, true);
            header('location: ../');
        }
    }

    //Creates a new user and gives feedback in case a new user creation fails
    public function createUser(UserModel $user, $username, $email, $password)
    {
        //Create a user
        $newUser = $user->create($username, $email, $password);

        if($newUser) {
            header('location: ../');
        } else {
            $msg = _("Регистрация не была завершена по техническим причинам. Пожалуйста, попробуйте другое сочетания имени пользователя и пароля");
            setcookie('feedback', $msg, time()+5, BASE, false, false, true);
            header('location: ../');
        }
    }
}