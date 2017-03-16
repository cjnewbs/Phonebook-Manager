<?php
class controller
{
    protected $_username;
    protected $_password;
    protected $_baseURL;


    public function __construct()
    {
        if (file_exists('app/config.php')) {
            include 'app/config.php';
            if (!isset($username) || !isset($password) || !isset($baseURL)) {
                throw new Exception('Application missing configuration');
            }
            $this->_username = $username;
            $this->_password = $password;
            $this->_baseURL = $baseURL;
        }
    }

    protected function _checkAuthStatus()
    {
        if ($_COOKIE['authenticated'] == 'cdf0faacab760a06cbf73a0018930563') {
            return true;
        }
        return false;
    }
    
    protected function _authenticate()
    {
        header('Location: '.$this->_baseURL.'login');
    }
    
    protected function getLogout()
    {
        include 'view/Logout.phtml';
    }
}