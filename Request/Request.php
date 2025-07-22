<?php


class Request{
    private array $postInputs;
    private array $getInputs;
    public function __construct(public array $inputs,
                                public string $uri,
                                public string $method,
                                public array $headers,
                                public array $get,
                                public array $post,
                                public array $files,
                                public array $cookies,
                                public array $server,
                                public array $session= []){
        $this->postInputs = $this->postInputs();
        $this->getInputs = $this->getInputs();
    }
     public static function createFromGlobals()
    {
        return new static(
            inputs: $_REQUEST,
            uri: $_SERVER["REQUEST_URI"],
            method: $_SERVER["REQUEST_METHOD"],
            headers: getallheaders(),
            get: $_GET,
            post: $_POST,
            files: $_FILES,
            cookies: $_COOKIE,
            server: $_SERVER,
            session: $_SESSION ?? [],
        );
    }
    private function sanitizeInput(string $input): string {
        return trim(htmlentities(htmlspecialchars($input)));
    }         
    public function postInput($key){
        return  $this->postInputs[$key] ?? null;
    }
    private function postInputs(): array {
        $inputs = [];
        foreach ($this->post as $key => $value) {
            $inputs[$key] = $this->sanitizeInput($value);
        }
        return $inputs;
    }
    public function getInput($key){
        return  $this->getInputs[$key] ?? null;
    }
    private function getInputs(): array {
        $inputs = [];
        foreach ($this->get as $key => $value) {
            $inputs[$key] = $this->sanitizeInput($value);
        }
        return $inputs;
    }
    public function all(){
        return [...$this->postInputs , ...$this->getInputs,...$this->files];
    }
    public function input($key){
        return $this->all()[$key] ?? null;
    }
    public function method(){
        return $this->server['REQUEST_METHOD'];
    }
    public function isPost(): bool {
        return $this->method() === 'POST';
    }       
    public function isGet(): bool {
        return $this->method() === 'GET';
    }
    public function ip(){
        return $this->server['REMOTE_ADDR'] ?? 'unknown';
    }
    public function url(){
        return $this->server['HTTP_HOST'] ?? 'unknown';
    }
    public function path(){
        return $this->server['REQUEST_URI'] ?? 'unknown';
    }
    public function queryParams(): array {
        $query=parse_url($this->path(), PHP_URL_QUERY);
        parse_str($query, $params);
        return $params;
    }
    public function server($key){
        return $this->server[$key] ?? null;
    }
    public function headers(){
        return $this->headers;
    }
    public function header($key){
        return $this->headers[$key] ?? null;
    }
    public function cookies(){
        return $this->cookies;
    }
    public function cookie($key){
        return $this->cookies[$key] ?? null;
    }
}