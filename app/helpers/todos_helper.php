<?php

    function filterTasks($tasks, $todoId){
        
        $results = [

        ];

        foreach($tasks as $task){
           if($task->todoId == $todoId) {
                array_push($results, $task);
           }
        }

        if(count($results) > 0){
            return $results;
        } else {
            return false;
        }

    }
