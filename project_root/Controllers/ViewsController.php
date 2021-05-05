<?php

namespace Controllers;

use System\View;
use System\Security;
use Models\TranslationModel;

class ViewsController
{
    public function actionIndex()
    {
        //Check the language
        $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : null;
        (new TranslationModel())->getTranslation($lang);

        //Check if the user is authorised
        $user_authorised = Security::is_authorised() ? true : false;
        //Check if there is a feedback to be displayed
        $feedback = isset($_COOKIE['feedback']) ? $_COOKIE['feedback'] : "";

        View::render('index', [
            'user_authorised' => $user_authorised,
            'feedback' => $feedback,
        ]);
    }
}