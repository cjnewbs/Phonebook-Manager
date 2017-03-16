<?php
class Error_404 extends Controller
{
    public function run()
    {
        header("HTTP/1.1 404 Not Found");
        echo '<h1>Page not found</h1>';
    }
}