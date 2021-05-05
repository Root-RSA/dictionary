<?php


namespace Models;


class TranslationModel
{
    public function getTranslation($lang = null)
    {
        if($lang !=null) {
            //I18N support information here
            putenv("LANG=".$lang.".UTF-8");
            setlocale(LC_ALL, $lang.".UTF-8");

            //Set the text domain "messages"
            $domain = "messages";
            bindtextdomain($domain, "Locale");
            textdomain($domain);
            return;
        } else {
            return;
        }
    }
}