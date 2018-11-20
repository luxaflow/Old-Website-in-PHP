<?php

/*
    - Base Controller
    - Loads the models and views
*/

class Controller {
    // Load model

    public function model($model){
        // require model file
        require_once '../app/models/' . $model . '.php';

        //instantiate the model
        return new $model();
    }

    //Load view
    public function view($view, $data = []){
        //Check for the view file

        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else{
            die('View does not exist');
        }
    }

    public function controller($path, $data = []){

        $url = filter_var_array(explode('/', $path), FILTER_SANITIZE_STRING);
        
        $data = filter_var_array($data, FILTER_SANITIZE_STRING);
        $controller = ucwords($url[0]);
        
        if(file_exists('../app/controllers/' . $controller . '.php')) {
            
            require_once '../app/controllers/' . $controller . '.php';
            $this->controller = new $controller;
            unset($url[0]);
            $method = $url[1];
            if(method_exists($this->controller, $method)){

                unset($url[1]);
                $params = $url ? array_values($url) : [];
                
                $this->controller->$method($params, $data); 

            } else {
                die('Method not found');
            }   
        } else {
            die('Controller not found');
        }
    }
}