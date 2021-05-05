<div class="upper_bar">
    <div class="left">
        <div id="welcome"><?= "Добро пожаловать!" ?></div>
    </div>
    <div class="right">
        <div class="sign-up"><a id="sign_in" href="registration/register">Регистрация</a></div>
        <div class="sign-in">Вход</div>
        <div>
            <form class="upper_bar_form" method="post" action="login/login">
                <input type="text" name="username" placeholder="Ваш логин">
                <input type="text" name="password" placeholder="Ваш пароль">
                <button type="submit">Войти</button>
            </form>
        </div>
    </div>
</div>