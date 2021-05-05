<?php

namespace Controllers;

use System\View;
use Models\UserModel;

class LoginController
{

    //Checks if the user with entered username exists
    public function actionLogin()
    {
        $user = (new UserModel())->read();

        if($user !== false) {
            $this->verify($user);
        } else {
            $msg = _("Пользователь с таким именем не найден. Попробуйте еще раз!");
            setcookie('feedback', $msg, time()+5, BASE, false, false, true);
            header('location: ../');
        }
    }

    //Verifies the entered password and loggs the user in or provides him a feedback
    public function verify(array $user)
    {
        if(password_verify(htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8'), $user['password']))
        {
            //Sets user session cookie for one month
            setcookie('userid', $user['id'], time()+60*60*24*30, BASE, false, false, true);
            header('location: ../');

        } else {
            $msg = _("Неверный пароль, пожалуйста, попробуйте ещё раз");
            setcookie('feedback', $msg, time()+5, BASE, false, false, true);
            header('location: ../');
        }
    }

    public function actionLogout()
    {
        if (isset($_COOKIE['userid'])) {
            setcookie('userid', null, time() - 3600, BASE);
        }
        header('location: ../');
    }
}