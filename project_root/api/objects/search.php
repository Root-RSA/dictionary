<?php

use Models\SearchModel;

class Search{

    // database connection and table name
    private $conn;
    private $table_name = "dict_table";

    // object properties
    public $id;
    public $grammar_note;
    public $reference;
    public $note;
    public $semantic_remark;
    public $translation;
    public $clarification;
    public $abbreviation;
    public $source;

   /* // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }*/

    // read products
    public function read(){

        $search = new SearchModel();
        $result = $search->search();

        /*// select all query
        $query = "SELECT id, grammar_note, reference, note, semantic_remark, 
                    translation, clarification, abbreviation, source FROM dict_table WHERE source = :lemma";

        // prepare query statement
        $dict = $this->conn->prepare($query);

        // execute query
        $dict->execute(['lemma' => $_GET['word']]);

        return $dict;*/
        return $result;
    }
}
?>
