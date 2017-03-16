<?php
require 'autoload.php';

//remove the directory path we don't want
$request  = str_replace("/phonebook/", "", $_SERVER['REDIRECT_URL']);

try {
    // Load application
    $app = new App();

    // Pass request path to router
    $app->run($request);

} catch (Exception $e) {
    die($e->getMessage());
}