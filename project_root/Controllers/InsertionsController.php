<?php


namespace Controllers;

use Models\InsertionModel;


class InsertionsController
{
    public function actionCreate()
    {
        $form_data = (new InsertionModel())->validate_form();

        $existance_check = (new InsertionModel())->word_exists($form_data['source']);

        if ($existance_check === true) {
            $msg = _("Слово уже есть в словаре");
            setcookie('feedback', $msg, time()+5, BASE, false, false, true);
            return header('location: ../');
        } else {
            extract($form_data);
            $result = (new InsertionModel())->insert_word($grammar_note, $source, $translation, $clarification);
        }

        if($result) {
            $msg = "<span style='color: #004480'>". _("Слово успешно внесено"). "</span>";
            setcookie('feedback', $msg, time()+5, BASE, false, false, true);
            header('location: ../');
        } else {
            $msg = _("Что-то пошло не так и слово не было внесено");
            setcookie('feedback', $msg, time()+5, BASE, false, false, true);
            header('location: ../');
        }

    }
}