<?php


namespace Models;

use System\Conn;

class InsertionModel
{
    public function word_exists($source)
    {
        $conn = Conn::getInstance();

        try {
            $query = "SELECT source FROM dict_table WHERE source = :lemma";
            $dict = $conn->get()->prepare($query);
            $dict->execute(['lemma' => "$source"]);
            $result = $dict->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo _('Ошибка выполнения запроса: ') . $e->getMessage();
        }
    }

    public function validate_form()
    {
        $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : null;
        $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : null;
        if ($type != null) {
            $grammar_note = $type;
        } elseif ($gender != null) {
            $grammar_note = $gender;
        } else {
            $grammar_note = "";
        }

        if(!isset($_POST['greek_word'])) {
            $msg = _("Вы не ввели греческое слово");
            setcookie('feedback', $msg, time()+5, BASE, false, false, true);
            header('location: ../');
        } elseif (!isset($_POST['translation'])) {
            $msg = _("Вы не ввели перевод слова");
            setcookie('feedback', $msg, time()+5, BASE, false, false, true);
            header('location: ../');
        } else {
            $source = htmlspecialchars($_POST['greek_word']);
            $translation = htmlspecialchars($_POST['translation']);
        }

        $clarification = isset($_POST['clarification']) ? htmlspecialchars($_POST['clarification']) : null;

        $form_data = [
            'grammar_note' => $grammar_note,
            'source' => $source,
            'translation' => $translation,
            'clarification' => $clarification
        ];

        return $form_data;
    }

    public function insert_word($grammar_note, $source, $translation, $clarification)
    {
        $conn = Conn::getInstance();

        try {
            $query = "INSERT INTO dict_table (source, grammar_note, translation, clarification, reference, note, semantic_remark, abbreviation) VALUES (:source, :grammar_note, :translation, :clarification, '', '', '', '')";
            $entry = $conn->get()->prepare($query);
            $entry->execute(['source' => $source, 'grammar_note' => $grammar_note, 'translation' => $translation, 'clarification' => $clarification]);
            $query = "SELECT source, grammar_note, translation, clarification FROM dict_table WHERE source = :source";
            $check = $conn->get()->prepare($query);
            $check->execute(['source' => $source]);
            $fetch_entry = $check->fetch(\PDO::FETCH_NUM);
            if ($fetch_entry) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo _('Ошибка выполнения запроса: ') . $e->getMessage();
        }
    }
}