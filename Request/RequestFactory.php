<?php

class RequestFactory {
    public static function create(): Request {
        return Request::createFromGlobals();
    }
}
