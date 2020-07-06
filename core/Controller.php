<?php namespace Core;

class Controller
{
    
}

/*
 * Helper Functions
*/
function view(string $view)
{
    include APP_DIR . 'views\\' . $view . '.php';
}