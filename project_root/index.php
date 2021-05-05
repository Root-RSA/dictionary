<?php
//Start a session
session_start();
//Define the base path
define("BASE", "/current_version_of_projects/dict/procedural/project_root/");
// Require the autoloader
require_once 'System/autoload.php';
// Launch the app
System\App::run();