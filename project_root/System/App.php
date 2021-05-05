<?php

namespace System;

class App
{
    /**
    * App launch
    */
    public static function run()
    {

        // Get the requested URI
        $path = $_SERVER['REQUEST_URI'];
        // Divide the URI by delimiter
        $pathParts = explode('/', $path);

        // Check if the requested page is index.php
        if(count($pathParts) == 6){
            $controller = 'views';
            $action = 'index';
        } else {
            // Designate controller's name
            $controller = $pathParts[5];
            // Check if the last part contains any GET parameters
            if (strstr($pathParts[6], "?")) {
                $length = strpos($pathParts[6], "?");
                // Get the name of the action
                $action = substr($pathParts[6], 0, $length);
            } else {
                // Get the name of the action
                $action = $pathParts[6];
            }
        }

        // Form a namespace of the controller
        $controller = 'Controllers\\' . ucfirst($controller) . 'Controller';
        // Form a name of the action
        $action = 'action' . ucfirst($action);

        // Allow display errors
        ini_set("display_errors", 1);

        // If the class doesn't exist, throw exception
        if (!class_exists($controller)) {
//            throw new \ErrorException('Controller does not exist');
            header('location: ../views/notfound');
        }

        // Create an object of the controller class
        $objController = new $controller;

        // If the controller doesn't have such action, redirect to 404
        if (!method_exists($objController, $action)) {
//            throw new \ErrorException('Action does not exist');
            header('location: ../views/notfound');
        }

        // Call the method of the controller
        $objController->$action();

    }
}