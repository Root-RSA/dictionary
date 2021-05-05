<div class="new_word">
    <p><?= _("Хотите внести новое слово в словарь?"); ?></p><br>
    <p class="subtitle"><?= _("Выберите часть речи"); ?></p>
    <select id="mySelect" required>
        <option value="verb"><?= _("Глагол"); ?></option>
        <option value="noun"><?= _("Существительное"); ?></option>
        <option value="adjective"><?= _("Прилагательное"); ?></option>
        <option value="adverb"><?= _("Наречие"); ?></option>
    </select>
    <button type="button" onclick="show(this.selected)"><?= _("Выбрать"); ?></button><br>
    <span class="err-msg"><?php if(isset($feedback)) echo $feedback; ?></span><br><br>

    <! -- A form for filling in a new verb -->
    <form id="verb" method="post" action="insertions/create">
        <p class="subtitle"><?= _("Тип: переходный или непереходный"); ?></p>
        <select name="type" required>
            <option value="">-</option>
            <option value="μετ."><?= _("переходный"); ?></option>
            <option value="αμετ."><?= _("непереходный"); ?></option>
        </select><br><br><br>
        <p class="subtitle"><?= _("Введите глагол на греческом"); ?></p>
        <input type="text" name="greek_word" placeholder="<?= _("Греческое слово"); ?>" required><br><br><br>
        <p class="subtitle"><?= _("Введите русский перевод"); ?></p>
        <input type="text" name="translation" placeholder="<?= _("Перевод"); ?>" required><br><br><br>
        <p class="subtitle"><?= _("Введите, если есть, примечания"); ?></p>
        <input type="text" name="clarification" placeholder="<?= _("Примечание"); ?>"><br><br><br>
        <button type="submit"><?= _("Внести"); ?></button>
    </form>

    <! -- A form for filling in a new noun -->
    <form id="noun" method="post" action="insertions/create">
        <p class="subtitle"><?= _("Род: мужской, женский, средний"); ?></p>
        <select name="gender" required>
            <option value="">-</option>
            <option value="ο">ο</option>
            <option value="η">η</option>
            <option value="το">το</option>
        </select><br><br><br>
        <p class="subtitle"><?= _("Введите существительное на греческом"); ?></p>
        <input type="text" name="greek_word" placeholder="<?= _("Греческое слово"); ?>" required><br><br><br>
        <p class="subtitle"><?= _("Введите русский перевод"); ?></p>
        <input type="text" name="translation" placeholder="<?= _("Перевод"); ?>" required><br><br><br>
        <p class="subtitle"><?= _("Введите, если есть, примечания"); ?></p>
        <input type="text" name="clarification" placeholder="<?= _("Примечание"); ?>"><br><br><br>
        <button type="submit"><?= _("Внести"); ?></button>
    </form>

    <! -- A form for filling in a new adjective -->
    <form id="adjective" method="post" action="insertions/create">
        <p class="subtitle"><?= _("Введите прилагательное на греческом"); ?></p>
        <input type="text" name="greek_word" placeholder="<?= _("Греческое слово"); ?>" required><br><br><br>
        <p class="subtitle"><?= _("Введите русский перевод"); ?></p>
        <input type="text" name="translation" placeholder="<?= _("Перевод"); ?>" required><br><br><br>
        <p class="subtitle"><?= _("Введите, если есть, примечания"); ?></p>
        <input type="text" name="clarification" placeholder="<?= _("Примечание"); ?>"><br><br><br>
        <button type="submit"><?= _("Внести"); ?></button>
    </form>

    <! -- A form for filling in a new adverb -->
    <form id="adverb" method="post" action="insertions/create">
        <p class="subtitle"><?= _("Введите наречение на греческом"); ?></p>
        <input type="text" name="greek_word" placeholder="<?= _("Греческое слово"); ?>" required><br><br><br>
        <p class="subtitle"><?= _("Введите русский перевод"); ?></p>
        <input type="text" name="translation" placeholder="<?= _("Перевод"); ?>" required><br><br><br>
        <p class="subtitle"><?= _("Введите, если есть, примечания"); ?></p>
        <input type="text" name="clarification" placeholder="<?= _("Примечание"); ?>"><br><br><br>
        <button type="submit"><?= _("Внести"); ?></button>
    </form>
</div>