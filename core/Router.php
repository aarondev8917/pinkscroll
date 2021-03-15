<?php

namespace app\core;

/**
 * Class router
 * 
 * @author Aaron
 * @package app\core
 */

 class Router {

    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * @param \app\core\Request $request
     * @param \app\core\Response $response
     */
    public function __construct(Request $request, Response $response){
        $this->request = $request;
        $this->response = $response;
    } 

    public  function get($path, $callback){
        
        $this->routes['get'][$path] = $callback;
    }

    public function resolve(){
       $path = $this->request->getPath();
       $method =  $this->request->getMethod();
       $urlParam = $this->request->getUrlParams();
       if(is_numeric($urlParam)){
           $path = str_replace($urlParam, ':id', $path );
       }
       $callback = $this->routes[$method][$path] ?? false;
       if($callback === false){
           $this->response->setStatusCode(404);
           return "Not found";
       }
       if(is_string($callback)){
           return $this->renderView($callback);
       }

       if(is_array($callback)){
         $callback[0] = new $callback[0]();
       }
       return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params= []){
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent,  $layoutContent);
        // include_once Application::$ROOT_DIR . "/views/$view.php";
    }

    protected function layoutContent(){
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params){

        foreach($params as $key => $value){
            $$key = $value;
        }
        // echo '<pre>';
        // var_dump($name );
        // echo '</pre>';
        // exit;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

 }