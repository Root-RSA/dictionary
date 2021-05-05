<?php

namespace Controllers;

use Models\SearchModel;
use Models\TranslationModel;
use System\View;

class SearchController
{
    public function actionSearch()
    {
        $result = (new SearchModel())->search();

        //Check the language
        $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : null;
        (new TranslationModel())->getTranslation($lang);

        View::render('result', ['result' => $result]);
    }

    public function actionLivesearch()
    {
        (new SearchModel())->livesearch();
    }
}