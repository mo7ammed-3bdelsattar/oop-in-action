<?php

namespace Controllers;

use Core\Model;
use Core\Session;
use Core\Controller;
use Core\Validation;

class Products extends Controller
{

    public function index()
    {
        $products=(new Model)->findAll();
        require_once "views/products/index.php";
    }
    public function create()
    {
        require_once "views/products/create.php";
    }
    public function store()
    {
        $validator = new Validation();
        $validator->validate([
            "title" => ["required", "string", "min:3"],
            "price" => ["required", "numeric", "min:2"]
        ]);
        if ($validator->getErrors()) {
        } else {
            Session::set("success", "Data Inserted Successfully");
            $data = [
                "title" => self::$request->post['title'],
                "price" => self::$request->post['price'],
                "description" => self::$request->post['description'],
            ];
            (new Model)->create($data);
        }
        header("Location: create");
    }
}
