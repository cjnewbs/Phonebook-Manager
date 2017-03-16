<?php
class Edit_Addrow extends Controller
{
    public function run()
    {
        if (!$this->_checkAuthStatus()) {
            $this->_authenticate();
        } else {
            file_put_contents('var/phonebook.csv', "\n\"\"", FILE_APPEND);
            header('Location: ' . $this->_baseURL . 'edit');
        }
    }
}