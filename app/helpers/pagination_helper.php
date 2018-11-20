<?php

    function pagination($page, $pageCount , $paginationCount = 5){
        
        if($pageCount < $paginationCount){
            $endPage = $pageCount;
            $paginationCount = $pageCount;
        }

        if($page > $pageCount || $page == 0) {
            redirect('posts');
        } 

        if($page <= ceil($paginationCount / 2)){
            $startPage = 1;
        } else {
            $startPage = $page - floor($paginationCount / 2);
        }

        if($page <= ceil($paginationCount / 2)){
            $startPage = 1;
            $endPage = $paginationCount;
        } elseif($page + floor($paginationCount / 2) >= $pageCount){
            $endPage = $pageCount;
            $startPage = ($pageCount + 1) - $paginationCount;
        } else {
            $endPage = $page + floor($paginationCount / 2);
        }

        
    
        $data = [
            'start' => $startPage,
            'end' => $endPage
        ]; 

        return $data;
    }