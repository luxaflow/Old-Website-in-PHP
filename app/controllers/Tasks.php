<?php

class Tasks extends Controller {

    public function __construct(){
        
        if(isLoggedIn()){
            $this->taskModel = $this->model('Task');
            
        } else {
            redirect('');
        }

    }

    public function index(){
        redirect_previous();
    }
    
    public function add($todoId){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'todoId' => $todoId,
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'userId' => $_SESSION['user_id'],
                'name_err' => '',
                'description_err' => ''
            ];


            if(empty($data['name'])){
                $data['name_err'] = 'Task name required';
            }

            if(empty($data['description'])){
                $data['description_err'] = 'Description is required';
            }

            if(empty($data['name_err']) && empty($data['description_err'])){
                if($this->taskModel->addTask($data)){
                    redirect_previous();
                } else {
                    die('Something went wrong');
                }
            } else {
                redirect_previous();
            }
        } else {
            redirect_previous();
        }
    }

    public function start($id){
        
        if($this->taskModel->startTask($id, $_SESSION['user_id'])){
            redirect_previous();
        } else {
            die('Something went wrong!');
        }
        
    }

    public function close($id){
        
        if($this->taskModel->closeTask($id, $_SESSION['user_id'])){
            redirect_previous();
        } else {
            die('Something went wrong!');
        }
        
    }
}