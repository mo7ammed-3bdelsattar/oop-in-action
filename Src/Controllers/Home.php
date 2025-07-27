<?php
namespace Controllers;

use Core\Controller;

class Home extends Controller{

    public function index(){
        require_once "views/home.php";
    }
}