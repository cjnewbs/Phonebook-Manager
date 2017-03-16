<?php
function __autoload($class)
{
    if (file_exists('app/'.$class.'.php')) {
        require_once 'app/'.$class.'.php';
    } else {
        throw new Exception('Applicaion incomplete, unable to load.');
    }
}