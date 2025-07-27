<?php

namespace Core;
class Controller{
     protected static Request $request;
    public static function setRequest(Request $request): void
    {
        self::$request = $request;
    }

}