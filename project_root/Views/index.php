<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= _("Словарь греческого языка"); ?></title>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon"
          type="image/png"
          href="img/greek_flag.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tenor+Sans&display=swap" rel="stylesheet">
    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript" src="js/part_of_speech.js"></script>
</head>
<body>
<div class="bars_icon" onclick="toggle_bar()">
        <img src="img/bars_icon.png" alt="">
    </div>
    <div id="bar" class="bar_visible">
        <div class="content">
            <?php if($user_authorised): include "components/exit_icon.php"; endif; ?>
            <div class="close" onclick="toggle_bar()"><img src="img/close.png" alt=""></div>
            <?php if(!$user_authorised): include "components/reg_log.php"; else: include "components/new_word.php"; endif; ?>
        </div>
        <div class="languages">
            <a href="translations/translate/?lang=en_US">English | </a>
            <a href="translations/translate/?lang=ru_RU">Русский | </a>
            <a href="translations/translate/?lang=el_GR">Ελληνικά</a>
        </div>
    </div>
    <div id="main" class="main_narrow">
        <div id="container">
            <div class="title">
                <p><?= _("БОЛЬШОЙ"); ?></p>
                <p><?= _("ГРЕЧЕСКО-РУССКИЙ"); ?></p>
                <p><?= _("СЛОВАРЬ"); ?></p>
            </div>
            <div class="flag">
                <img src="img/greek_flag.png">
                <div class="title">
                    <p><?= _("БОЛЬШОЙ"); ?></p>
                    <p><?= _("ГРЕЧЕСКО-РУССКИЙ"); ?></p>
                    <p><?= _("СЛОВАРЬ"); ?></p>
                </div>
            </div>
            <div id="form">
                <form id="search_form" class="example">
                    <input id="input" type='text' name='word' placeholder="<?= _("введите слово"); ?>" autocomplete="off" onclick="appear()" onkeyup="showResult(this.value); searchByEnter(this.value)">
                    <button id="srch_btn" type="submit" onclick="search()"><i class="fa fa-search"></i></button>
                    <div class="example" id="livesearch"></div>
                    <div class="example" id="errmsg"></div>
                </form>
            </div>
            <p id="test"></p>
        </div>
        <div id="result">
        </div>
    </div>
</body>
</html>