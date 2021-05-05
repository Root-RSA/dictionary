<?php

namespace System;

class Security
{
    public $credentials = [];

    public static function sanitize()
    {
        $credentials['username'] = isset($_POST['username']) ? htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8') : header('location: ../');
        $credentials['email'] = isset($_POST['email']) ? htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8') : header('location: ../');
        $credentials['password'] = isset($_POST['password']) ? htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8') : header('location: ../');
        return $credentials;
    }

    public static function is_authorised()
    {
        //Check if the user is logged in
        if(isset($_COOKIE['userid'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkFeedback()
    {
        if(isset($_COOKIE['feedback'])){
            setcookie('feedback', null, time() - 3600, '/');
            return $_COOKIE['feedback'];
        } else {
            return null;
        }
    }
}