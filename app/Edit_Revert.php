<?php
class Edit_Revert extends Controller
{
    public function run()
    {
        if (!$this->_checkAuthStatus()) {
            $this->_authenticate();
        } else {
            include 'view/Revert.phtml';
        }
    }
}