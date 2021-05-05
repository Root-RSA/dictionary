<?php

namespace System;

class View
{
    public static function render($path, array $data = [])
    {
        // Get the path where all views are
        $fullPath = __DIR__ . '/../Views/' . $path . '.php';

        // If the view hasn't been found throw an exception
        if (!file_exists($fullPath)) {
            throw new \ErrorException('view cannot be found');
        }

        // If the data has been transmitted then elements of the array
        // form variables that will be available in the views
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        // Display the view
        include($fullPath);
    }
}