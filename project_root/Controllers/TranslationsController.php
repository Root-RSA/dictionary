<?php


namespace Controllers;


class TranslationsController
{
    public function actionTranslate()
    {
        $lang = htmlspecialchars($_GET['lang']);
        //Sets user session cookie for one month
        setcookie('lang', $lang, time()+60*60*24*30, BASE, false, false, true);
        header('location: ../../');
    }
}