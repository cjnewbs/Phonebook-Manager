<?php
class Edit_Save extends Controller
{
    function run()
    {

        if (!$this->_checkAuthStatus()) {
            $this->_authenticate();
        } else {
            $rows = $_POST['data'];

            $this->createArchiveCopy();

            $filename = 'var/phonebook.csv';

            $csvfile = fopen($filename, 'w');

            foreach ($rows as $row) {
                if ($row['fName'] == '' && $row['lName'] == '' && $row['mobile'] == '' && $row['work'] == '' && $row['home'] == '') {
                    continue;
                }
                fputcsv($csvfile, $row, ',', '"');
            }
            fclose($csvfile);

            header('Location: ' . $this->_baseURL . 'edit');

        }
    }

    function createArchiveCopy()
    {
        $oldCsvData = file_get_contents('var/phonebook.csv');
        //$newPath = '../var/archive/'.time().'.csv';
        $result = file_put_contents('var/archive/'.time().'.csv', $oldCsvData);
    }
}