<?php


namespace Controllers;

use Models\SearchModel;

class ApiController
{
    public function actionRead()
    {
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $search = new SearchModel();
        $meanings = $search->search();

        // check if more than 0 meaning found
        if($meanings and !empty($meanings)){

            // set response code - 200 OK
            http_response_code(200);

            // show products data in json format
            echo json_encode($meanings);
        }

        else{

            // set response code - 404 Not found
            http_response_code(404);

            // tell the user no products found
            echo json_encode(
                array("message" => "Nothing found.")
            );
        }
    }

}