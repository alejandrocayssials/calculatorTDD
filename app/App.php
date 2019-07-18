<?php
namespace App;

class App
{
    public function run()
    {
        $script = substr($_SERVER['REQUEST_URI'],19);
        
        if($script === '')
            $script = 'index';
            
        include("../views/$script.php");
    }
}