<?php
class Edit extends Controller
{
    public function run()
    {
        if (!$this->_checkAuthStatus()) {
            $this->_authenticate();
        } else {
            include 'view/Edit.phtml';
        }
    }

    public function getCsvData()
    {
        $filename = 'var/phonebook.csv';

        $csvfile = fopen($filename, 'rb');
        while (!feof($csvfile)) {
            $csvarray[] = fgetcsv($csvfile);
        }
        return $csvarray;
    }
}