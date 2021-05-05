<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
/*include_once '../config/database.php';*/
include_once '../objects/search.php';

// instantiate database and product object
/*$database = new Database();
$db = $database->getConnection();*/

// initialize object
$search = new Search();
$meanings = $search->read();
var_dump($meanings);

// query products
$stmt = $product->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $meanings_arr=array();
    $meanings_arr["meanings"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $meaning=array(
            "id" => $id,
            "grammar_note" => $grammar_note,
            "reference" => html_entity_decode($reference),
            "note" => $note,
            "semantic_remark" => $semantic_remark,
            "translation" => $translation,
            "clarification" => $clarification,
            "abbreviation" => $abbreviation,
            "source" => $source
        );

        array_push($meanings_arr["meanings"], $meaning);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($meanings_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "Nothing found.")
    );
}