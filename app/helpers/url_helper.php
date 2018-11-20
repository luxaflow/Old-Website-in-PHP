<?php
    // simple page redirect
    function redirect($page){
        header('location:' . URLROOT . '/' . $page);
    }

    //check if url value is set and compare. can be used to set active classes
    function checkUrl($url){
        if(isset($_GET['url'])){
            if($_GET['url'] == $url){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // redirects to previous page, can be used for page reloads
    function redirect_previous(){
        $url = (str_replace(URLROOT . '/', '', $_SERVER['HTTP_REFERER']));

        redirect($url); 
    }

    function url_previous(){
        $url = (str_replace(URLROOT . '/', '', $_SERVER['HTTP_REFERER']));

        return $url;
    }

    function url_strip($url, int $elementCount){
        $url = str_replace(URLROOT . '/', '', $url);
        $url = explode('/', $url);

        $output = [];
        for($i = 0; $i < $elementCount; $i++){
            array_push($output, $url[$i]);
        }

        $output = implode('/', $output);

        return $output;
    }