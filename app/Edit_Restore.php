<?php
class Edit_Restore extends Controller
{
    public function run()
    {
        if (!$this->_checkAuthStatus()) {
            $this->_authenticate();
        } else {
            if ($_GET['confirm'] === 'true') {
                $backupCsvData = 'var/archive/' . $_GET['id'];
                $phonebookPath = 'var/phonebook.csv';

                $status = copy($backupCsvData, $phonebookPath);

                if ($status == true) {
                    include 'view/Restore_Success.phtml';
                } else {
                    echo 'Something went wrong';
                }
            } else {
                include 'view/Restore_Confirm.phtml';
            }
        }
    }
}