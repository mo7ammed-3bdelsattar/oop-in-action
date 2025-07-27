<?php
namespace Controllers;
use Core\Controller;

class About extends Controller{

    public function index(){
        require_once "views/about.php";
    }
}