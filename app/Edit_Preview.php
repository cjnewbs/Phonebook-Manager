<?php
class Edit_Preview extends Controller
{
    public function run()
    {
        if (!$this->_checkAuthStatus()) {
            $this->_authenticate();
        } else {
            include 'view/Preview.phtml';

        }
    }
    
    function getCsvData($filename)
    {
        $csvfile = fopen($filename, 'rb');
        while (!feof($csvfile)) {
            $csvarray[] = fgetcsv($csvfile);
        }
        return $csvarray;
    }
}