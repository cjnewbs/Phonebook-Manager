<?php
class Phonebook extends Controller
{
    protected $xml;

    public function run()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Text to send if user hits Cancel button';
        } else {
            $user = $_SERVER['PHP_AUTH_USER'];
            $pass = $_SERVER['PHP_AUTH_PW'];

            if ($user === $this->_username && $pass === $this->_password) {
                header('Content-Type:application/xml');

                echo $this->getPhonebookXml();

            } else {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo 'Text to send if user hits Cancel button';
                exit;
            }
        }
    }

    protected function getCsvData()
    {
        $filename = 'var/phonebook.csv';
        $csvfile = fopen($filename,'rb');
        while(!feof($csvfile)) {
            $csvarray[] = fgetcsv($csvfile);
        }
        return $csvarray;
    }

    protected function getPhonebookXml()
    {
        $this->xml = new DOMDocument('1.0', 'UTF-8');
        $addressbook = $this->xml->createElement('AddressBook');
        $version = $this->xml->createElement('version', '1');
        $addressbook->appendChild($version);
        $csvContacts = $this->getCsvData();
        foreach ($csvContacts as $k => $csvContact) {
            $contact = $this->xml->createElement('Contact');
            $contact->appendChild($this->xml->createElement('FirstName', $csvContact[0]));
            $contact->appendChild($this->xml->createElement('LastName', $csvContact[1]));
            if (isset($csvContact[2])) {
                $contact->appendChild($this->renderPhone('Mobile', $csvContact[2]));
            }
            if (isset($csvContact[3])) {
                $contact->appendChild($this->renderPhone('Work', $csvContact[3]));
            }
            if (isset($csvContact[4])) {
                $contact->appendChild($this->renderPhone('Home', $csvContact[4]));
            }
            $addressbook->appendChild($contact);
        }
        $this->xml->appendChild($addressbook);
        return $this->xml->saveXML();
    }

    protected function renderPhone($type, $number)
    {
        $phone = $this->xml->createElement('Phone');
        $phone->setAttribute('type', $type);
        $phone->appendChild($this->xml->createElement('phonenumber', $number));
        $phone->appendChild($this->xml->createElement('accountindex', '1'));
        return $phone;
    }
}