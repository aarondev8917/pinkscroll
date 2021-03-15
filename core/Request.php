<?php

namespace app\core;
/**
 * 
 * Class Request
 * 
 * @author aaron
 * @package app\core
 */

 class Request {

    public function getPath(){

        $path = $_SERVER['REQUEST_URI'] ?? '/';
        return $path;
    }

    public function getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);

    }

    public function getUrlParams(){
        $params = end(explode('/', rtrim($this->getPath(), '/')));
        if(is_numeric($params)){
            return  $params;
        }
        return false;
    }
 }