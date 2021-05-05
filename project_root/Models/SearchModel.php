<?php
namespace Models;

use System\Conn;

class SearchModel
{
    public function search()
    {
        $conn = Conn::getInstance();
        $word = htmlspecialchars($_GET['word']);

        //This block searches for the fist meaning of the inserted word
        try {
            $query = "SELECT id, grammar_note, reference, note, semantic_remark, translation, clarification, abbreviation, source FROM dict_table WHERE source = :lemma";
            $dict = $conn->get()->prepare($query);
            $dict->execute(['lemma' => $word]);
            $firstMeaning = $dict->fetch(\PDO::FETCH_ASSOC);
            if ($firstMeaning) {
                $result['meanings'][0] = $firstMeaning;
            } else {
                $result = false;
                return $result;
            }
        } catch (\PDOException $e) {
            echo _('Ошибка выполнения запроса: ') . $e->getMessage();
        }

        //This block searches for the rest of the meanings
        try {
            $source_rest = null;
            /*$grammar_note_rest = null;
            $reference_rest = null;
            $note_rest = null;
            $semantic_remark_rest = null;
            $translation_rest = null;
            $clarification_rest = null;
            $abbreviation_rest = null;*/
            $i = 1;
            $query = 'SELECT source, grammar_note, reference, note, semantic_remark, translation, clarification, abbreviation FROM dict_table WHERE id = :num';
            $dict = $conn->get()->prepare($query);

            while ($source_rest == null) {
                $firstMeaning['id']++;
                $dict->execute(['num' => $firstMeaning['id']]);
                $restMeanings[$i] = $dict->fetch(\PDO::FETCH_ASSOC);
                if ($restMeanings[$i]) {
                    $source_rest = $restMeanings[$i]['source'];
                    if ($source_rest == null) {
                        $result['meanings'][$i] = $restMeanings[$i];
                    }
                }
                $i++;
            }
        } catch (\PDOException $e) {
            echo _('Ошибка выполнения запроса: ') . $e->getMessage();
        }

        //The next three blocks search for examples of the word use
        try {
            $query = "SELECT source, translation, clarification FROM dict_table WHERE source LIKE :lemma";
            $dict = $conn->get()->prepare($query);
            $dict->execute(['lemma' => "{$_GET['word']} %"]);
            $examplesOne = $dict->fetchAll(\PDO::FETCH_ASSOC);
            if ($examplesOne) {
                $examplesOne_count = count($examplesOne);
            }
        } catch (\PDOException $e) {
            echo _('Ошибка выполнения запроса: ') . $e->getMessage();
        }

        try {
            $query = "SELECT source, translation, clarification FROM dict_table WHERE source LIKE :lemma";
            $dict = $conn->get()->prepare($query);
            $dict->execute(['lemma' => "% {$_GET['word']}"]);
            $examplesTwo = $dict->fetchAll(\PDO::FETCH_ASSOC);
            if ($examplesTwo) {
                $examplesTwo_count = count($examplesTwo);
            }
        } catch (\PDOException $e) {
            echo _('Ошибка выполнения запроса: ') . $e->getMessage();
        }

        try {
            $query = "SELECT source, translation, clarification FROM dict_table WHERE source LIKE :lemma";
            $dict = $conn->get()->prepare($query);
            $dict->execute(['lemma' => "% {$_GET['word']} %"]);
            $examplesThree = $dict->fetchAll(\PDO::FETCH_ASSOC);
            if ($examplesThree) {
                $examplesThree_count = count($examplesThree);
            }
        } catch (\PDOException $e) {
            echo _('Ошибка выполнения запроса: ') . $e->getMessage();
        }

        //This block merges the arrays containing the three types of examples
        $examples = array_merge($examplesOne, $examplesTwo, $examplesThree);

        $result['examples'] = $examples;

        return $result;
    }

    public function livesearch()
    {
        $conn = Conn::getInstance();

        $q = $_GET['wordpart'];
        
        try {
            $query = "SELECT source FROM dict_table WHERE source LIKE :lemma AND source NOT LIKE '% %'";
            $dict = $conn->get()->prepare($query);
            $dict->execute(['lemma' => "{$q}%"]);
            $hintArr = $dict->fetchAll(\PDO::FETCH_NUM);
            sort($hintArr);
            if ($hintArr) {
                $count = count($hintArr);
                if ($count > 5) {
                    $count = 5;
                }
                if ($count !=0) {
                    for ($i = 0; $i < $count; $i++){
                        $x = $hintArr[$i][0];
                        echo "<span class = 'list' id='$i' tabindex='-1' onclick='search(this.innerHTML)' onkeyup='searchByEnter(this.innerHTML)'>$x</span>";
                    }
                }
            } else {
                echo "<p class='live_no_result'>такое слово не найдено</p>";
            }

        } catch (\PDOException $e) {
            echo _('Ошибка выполнения запроса: ') . $e->getMessage();
        }
    }

}