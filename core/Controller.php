<?php

namespace app\core;
/**
 * Class Controller
 * 
 * @author Aaron
 * @package app\core
 */

 Class Controller
 {
     public function render($view, $params = []){

        return Application::$app->router->renderView($view, $params);
     }

 }