<?php

class Pages extends Controller {
    public function __construct(){
        $this->postModel = $this->model('Post');
    }

    public function index(){
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => array_slice($posts, 0, 5)
        ];

        $this->view('pages/index', $data);
    }

    public function about(){

        redirect('');
        $data = ['title' => 'About Us'];
         $this->view('pages/about', $data);
    }

}