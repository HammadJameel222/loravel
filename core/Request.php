<?php

namespace app\core;

class Request
{
    public function getPath() {
        $url = $_SERVER['REQUEST_URI'];
        $path = parse_url($url, PHP_URL_PATH);
        return $path;
    }

    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
