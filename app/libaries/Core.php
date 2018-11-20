<?php

/* 
    - App Core Class
    - Creates URL & Loads Core Controller
    - URL FORMAT - /controller/method/params
*/

class Core {
    protected $currentContoller = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        //print_r($this->getUrl());
        
        $url = $this->getUrl();

        // Look in controller for first value/index
        // ucwords does capitalize on text
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            //if exists set as controller
            $this->currentContoller = ucwords($url[0]);
            // unset 0 Index
            unset($url[0]);
        } 
        
        // Require the controller
        require_once '../app/controllers/' . $this->currentContoller . '.php';

        //instantiate controller
        $this->currentContoller = new $this->currentContoller;

        //Check for second part of url
        if(isset($url[1])){
            //Check to see if method exists in controller
            if(method_exists($this->currentContoller, $url[1])){
                $this->currentMethod = $url[1];

                //unset 1 Index
                unset($url[1]);
            }
        }

        //Get parameters    
        $this->params = $url ? array_values($url) : [];

        //Call a callback with array of parameters
        call_user_func_array([$this->currentContoller, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }


    }
}

