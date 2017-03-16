<?php
class Logout extends Controller
{
    protected $_alert;

    public function run()
    {
        setcookie('authenticated', '', time()+60*60*24*30);
        header('Location: '.$this->_baseURL.'login');
    }
}