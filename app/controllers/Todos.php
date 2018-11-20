<?php

class Todos extends Controller {

    public function __construct(){

        if(isLoggedIn()){ 
            $this->todoModel = $this->model('Todo');
            $this->taskModel = $this->model('Task');
            $this->userModel = $this->model('User');
        } else {
            redirect('');
        }
    }

    public function index(){
        $todos = $this->todoModel->getActiveTodos();
        $tasks = $this->taskModel->getActiveTasks();
        $users = $this->userModel->getUsers();

        $data = [
            'todos' => array_slice($todos, 0 , 5),
            'tasks' => array_slice($tasks, 0, 5),
            'users' => $users
        ];
        
        $this->view('todos/index', $data);
    }

    public function list($selection = 'active' ,$page = 1){
        
        $users = $this->userModel->getUsers();

        switch($selection){
            case 'inactive':
                $todos = $this->todoModel->getInactiveTodos(3);
                break;
            case 'all':
                $todos = $this->todoModel->getTodos();
                break;
            default:
                $todos = $this->todoModel->getActiveTodos(3);
        }
        
        $todosPerPage = 5;
        $pageCount = ceil(count($todos) / $todosPerPage);

        if($page < 1){
            $page = 1;
        }

        if($page > $pageCount){
            $page = $pageCount;
        }

        $todos = array_slice($todos, ($todosPerPage * ($page - 1) ) , $todosPerPage);
        $pagination = pagination($page, $pageCount);

        $tasks = [];
        foreach($todos as $todo){
            $todoTasks = $this->taskModel->getTasksByTodoId($todo->todoId);

            foreach($todoTasks as $task){
                array_push($tasks, $task);
            }
        }

        $data= [
            'title' => 'Active Todos',
            'todos' => $todos,
            'tasks' => $tasks,
            'users' => $users,
            'todosPerPage' => $todosPerPage,
            'page' => $page,
            'pageCount' => $pageCount,
            'startPagination' => $pagination['start'],
            'endPagination' => $pagination['end']
        ];

        $this->view('todos/list', $data);
   
    }

    public function inactive($page = 1){
        $activeTodos = $this->todoModel->getInactiveTodos();
        $tasks = [];

        $todosPerPage = 5;
        $pageCount = ceil(count($activeTodos) / $todosPerPage);

        if($page < 1){
            $page = 1;
        }

        if($page > $pageCount){
            $page = $pageCount;
        }

        $pagination = pagination($page, $pageCount);
        
        foreach($activeTodos as $todo){
            $todoTasks = $this->taskModel->getTasksByTodoId($todo->todoId);

            foreach($todoTasks as $task){
                array_push($tasks, $task);
            }
        }

        $data= [
            'title' => 'Finished Todos',
            'todos' => $activeTodos,
            'tasks' => $tasks,
            'todosPerPage' => $todosPerPage,
            'page' => $page,
            'pageCount' => $pageCount,
            'startPagination' => $pagination['start'],
            'endPagination' => $pagination['end']
        ];

        $this->view('todos/list', $data);

    }

    public function add(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'user_id' => trim($_POST['user_id']),
                'deadline' => trim($_POST['deadline']),
                'created_by' => $_SESSION['user_id'],
                'name_err' => '',
                'description_err' => '',
                'user_id_err' =>  '',
                'deadline_err' => ''
            ];

            if(empty($data['name'])){
                $data['name_err'] = 'Name is required';
            }

            if(empty($data['description'])){
                $data['description_err'] = 'Description is required';
            }

            if(empty($data['user_id'])){
                $data['user_id_err'] = 'User is required';
            }

            if(empty($data['deadline'])){
                $data['deadline_err'] = 'Deadline is required';
            }

            if(empty($data['name_err']) && empty($data['description_err']) && empty($data['user_id_err']) && empty($data['dead_line_err'])){
                if($this->todoModel->addTodo($data['name'], $data['description'], $data['user_id'], $data['deadline'], $data['created_by'])){
                    redirect_previous();
                } else {
                    die('Something went wrong');
                }
                $this->controller(url_previous(),$data);
            } 
            
        }
    }

    public function start($id){
        
        if($this->todoModel->startTodo($id, $_SESSION['user_id'])){
            redirect_previous();
        } else {
            die('Something went wrong!');
        }
    }

    public function close($id){
        
        if($this->todoModel->closeTodo($id, $_SESSION['user_id'])){
            redirect_previous();
        } else {
            die('Something went wrong!');
        }
    }

    
}