<div class="bar_reg_log">
    <p class="sign-up"><span onclick="toggle_bar_reg_form()"><?= _("Регистрация"); ?></span></p>
    <form id="bar_reg_form" class="bar_reg_form_hidden" method="post" action="registration/register">
        <div>
            <input type="text" name="username" placeholder="<?= _("Ваш логин"); ?>" required>
        </div>
        <div>
            <input type="email" name="email" placeholder="<?= _("Ваш email"); ?>" required>
        </div>
        <div>
            <input type="text" name="password" placeholder="<?= _("Ваш пароль"); ?>" required>
            <button type="submit" onclick="this.focus()"><?= _("Вперёд"); ?></button>
        </div>
    </form>
    <p class="sign-in" style="display: <?= $reglog_display ?>"><span onclick="toggle_bar_login_form()"><?= _("Вход"); ?></span></p>
    <form id="bar_login_form" class="bar_login_form_hidden" method="post" action="login/login">
        <div>
            <input type="text" name="username" placeholder="<?= _("Ваш логин"); ?>" required>
        </div>
        <div>
            <input type="text" name="password" placeholder="<?= _("Ваш пароль"); ?>" required>
            <button type="submit" onclick=""><?= _("Войти"); ?></button>
        </div>
    </form>
    <span class="err-msg"><?php if(isset($feedback)) echo $feedback; ?></span>
    <div class="description">
        <span>
            <?= _("Добро пожаловать на страницу онлайн греческо-русского словаря. Данный словарь является наиболее полным из существующих на данный момент."); ?>
        </span>
        <span>
            <?= _("Несмотря на свою полноту, есть слова, которые вы не сможете в нём найти. Поэтому при желании вы можете его пополнять сами, предварительно зарегистрировавшись."); ?>
        </span>
    </div>
</div>