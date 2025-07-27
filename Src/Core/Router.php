<?php
namespace Core;

class Router
{

    private static array $routes = [];  
    public static function get($path, $params)
    {
        $params["method"] = "GET";
        self::$routes[] = [
            "path" => $path,
            "params" => $params
        ];
    }
    public static function post($path, $params)
    {
        $params["method"] = "POST";
        self::$routes[] =  [
            "path" => $path,
            "params" => $params
        ];
    }
    private static function match(string $path, $method)
    {
        $path = urldecode($path);
        $path = trim($path, "/");
        foreach (self::$routes as $route) {
            $route['path'] = trim($route['path'], '/');
            $params = $route['params'];
            if ($route['path'] === $path) {
                if (array_key_exists('method', $params)) { 
                    if (strtolower($params['method']) !== strtolower($method)) {
                        continue;
                    }
                }
                return $params;
            }
        }
        return false;
    }
    public static function handle(Request $request)
    {
        $params = self::match(self::getPath(), $request->method);
        if (!$params) {
            require_once "views/404.php";
        } else {
            $controller = $params['controller']??null;
            $controller ="Controllers\\".ucfirst($controller);
            $action = $params['action']??null;
            $controller_obj =new $controller(); 
            $controller_obj->setRequest(Request::createFromGlobals());
            $args=self::getActionArguments($controller,$action,$params);
            $controller_obj->$action(...$args);
        }
    }
    public static function getAll()
    {
        return self::$routes;
    }
    private static function getUri()
    {
        return (Request::createFromGlobals())->uri();
    }
    private static function getPath()
    {
        $path = parse_url(self::getUri(), \PHP_URL_PATH);
        $path = trim($path, "/");
        if ($path === false) {
            throw new \UnexpectedValueException("Invalid URL path:" . self::getUri());
        }
        return $path;
    }
    private static function getActionArguments(string $controller, string $action, array $params): array
    {
        $args = [];
        $method = new \ReflectionMethod($controller, $action);
        foreach ($method->getParameters() as $parameter) {
            $name = $parameter->getName();
            $args[$name] = $params[$name];
        }
        return $args;
    }
    public static function check()
    {
        return in_array(self::getUri(), self::$routes);
    }   
    public static function route(string $path){
        $path=trim($path,"/");
        $url= (Request::createFromGlobals())->url();
        return "http://".$url."/".$path;
    }
}
