<?php
define("ROOT_PATH", dirname(__DIR__)."\OOP_in_action\Src\\");
spl_autoload_register(function ($class_name) {
    require_once (\ROOT_PATH . str_replace("\\", "/",  $class_name) . ".php");
});

Core\Session::start();

Core\Router::get('/', ["controller" => "home","action"=>"index"]);
Core\Router::get('/home', ["controller" => "home","action"=>"index"]);
Core\Router::get('/about', ["controller" => "about","action"=>"index"]);
Core\Router::get('/products', ["controller" => "products","action"=>"index"]);
Core\Router::get('/products/create', ["controller" => "products","action"=>"create"]);
Core\Router::post('/products/store', ["controller" => "products","action"=>"store"]);
Core\Router::handle(Core\Request::createFromGlobals());