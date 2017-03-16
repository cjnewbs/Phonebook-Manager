<?php
class App
{

    // Define routes and controller classes
    protected $_routes = [
        '' => 'Login',
        'phonebook.xml' => 'Phonebook',
        'login' => 'Login',
        'logout' => 'Logout',
        'edit' => 'Edit',
        'edit/save' => 'Edit_Save',
        'edit/addrow' => 'Edit_Addrow',
        'edit/restore' => 'Edit_Restore',
        'edit/preview' => 'Edit_Preview',
        'edit/revert' => 'Edit_Revert'
    ];

    public function run($request)
    {
        $controller = $this->getController($request);

        $app = new $controller();
        $app->run();
    }

    protected function getController($request)
    {

        // Remove trailing slash if present
        if (substr($request, -1) === '/') {
            $request = substr($request, 0, strlen($request)-1);
        }

        // Determine correct controller 
        foreach ($this->_routes as $route => $controller) {
            if ($request == $route) {
                return $controller;
            }
        }
        return 'Error_404';
    }
}