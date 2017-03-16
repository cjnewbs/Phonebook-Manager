<?php
class Login extends Controller
{
    protected $_alert;

    public function run()
    {
        if ($this->_checkAuthStatus()) {
            header('Location: '.$this->_baseURL.'edit');
        } else {
            if ($_POST['username'] == $this->_username && $_POST['password'] == $this->_password) {
                setcookie('authenticated', 'cdf0faacab760a06cbf73a0018930563', time()+60*60*24*30);
                header('Location: edit');
            } else {
                if (isset($_POST['username']) && isset($_POST['password'])) {
                    $this->_alert = "Invalid username or password";
                }
                include 'view/Login.phtml';
            }
        }
    }
    
    protected function getAlert()
    {
        if ($this->_alert) {
            return $this->_alert;
        }
    }
}