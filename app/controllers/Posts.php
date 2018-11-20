<?php

class Posts extends Controller {

    public function __construct(){
         $this->postModel = $this->model('Post');
    }

    public function index($page = 1){
        $posts = $this->postModel->getPosts();

        $postsPerPage = 5;
        $pageCount = ceil(count($posts) / $postsPerPage);

        if($page < 1){
            $page = 1;
        }

        if($page > $pageCount){
            $page = $pageCount;
        }

        $pagination = pagination($page, $pageCount);

        $data = [
            'posts' => $posts,
            'postsPerPage' => $postsPerPage,
            'page' => $page,
            'pageCount' => $pageCount,
            'startPagination' => $pagination['start'],
            'endPagination' => $pagination['end'],
        ];

        $this->view('posts/index', $data);
    }

    public function post($id){
        $post = $this->postModel->getPost($id);

        $data = [
            'post' => $post
        ];
        
        $this->view('posts/post', $data);
    }

    public function add(){
        if(!isLoggedIn()){
            redirect('users/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            $data = [
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'title_err' => '',
            'body_err' => ''
            ];

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body';
            }

            if(empty($data['title_err']) && empty($data['body_err'])){
                if($this->postModel->addPost($data['title'], $data['body'])){
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    $this->view('posts/add', $data);
                }

            } else {
                $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => ''
            ];
        }

        $this->view('posts/add', $data);
    }

    public function edit($id){
        if(!isLoggedIn()){
            redirect('users/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
            'id' => $id,
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'title_err' => '',
            'body_err' => ''
            ];

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body';
            }

            if(empty($data['title_err']) && empty($data['body_err'])){
                if($this->postModel->updatePost($id, $data['title'], $data['body'])){
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    $this->view('posts/add', $data);
                }

            } else {
                $post = $this->postModel->getPost($id);

                if(empty($post)){
                    die('Something went wrong');
                }

                $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
                'title_err' => '',
                'body_err' => ''
            ];
        }

        $this->view('posts/edit', $data);
    }

    public function delete($id){

        if($this->postModel->deletePost($id)){
            redirect('posts');
        } else {
            die('Something went wrong');
        }
    }
}   