<?php


namespace core;
//require_once '/vendor/autoload.php';

class Controller
{
    public $request;

    public function __construct()
    {
        $this->request = new Request;
    }

    public function view($arquivo, $array = null)
    {
        if (!is_null($array)) {
            foreach ($array as $var => $value) {
                ${$var} = $value;
            }
        }
        ob_start();
        include "app/views/{$arquivo}.php";
        ob_flush();
    }
}