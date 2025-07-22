<?php
require_once "Request.php";
require_once "RequestFactory.php";
$request = RequestFactory::create();
echo "Name: " . $request->input('name') . "<br>";
echo "Email: " . $request->input('email') . "<br>";
echo "IP Address: " . $request->ip() . "<br>";
echo "Request URI: " . $request->url() . "<br>";
echo "Request Method: " . $request->method() . "<br>";
echo $request->isGet() ? 'GET request' : 'Not a GET request <br>';
echo $request->isPost() ? 'POST request' : 'Not a POST request <br>';
var_dump($request->headers());
echo "<pre>";
print_r($request->all());
echo "</pre>";
