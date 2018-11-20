<?php

class Users extends Controller {
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    private function passwordStrength($password){
        $err = '';

        if(strlen($password)  < 6){
            $err = 'At least 6 characters required';
        } elseif(!preg_match('#[a-z]+#', $password)){
            $err = 'At least 1 lowercase character required';
        } elseif(!preg_match('#[A-Z]+#', $password)){
            $err = 'At least 1 uppercase character required';
        } elseif(!preg_match('#[0-9]+#', $password)){
            $err = 'At least 1 number required';
        } 
                
        return $err;
    }

    public function login(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];  

            if(empty($data['username'])){
                $data['username_err'] = 'Please enter username/e-mail';
            }

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            if(!$this->userModel->findUserByLoginName($data['username'])){
                flashMessage('login_failed', 'Username/Password incorrect', 'card-panel z-depth-1 red accent-2 center');
                $this->view('users/login', $data);
            }

            if(empty($data['username_err']) && empty($data['password_err'])){
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if($loggedInUser){
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    
                }
            } else {
                $this->view('users/login', $data);
            }

        } else {
            $data = [
                'username' =>  '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => ''
            ];  
        }

        $this->view('users/login', $data);
    }

    public function register(){

        // if(!isLoggedIn()){
        //     redirect('');
        // }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'confirm_email' => trim($_POST['confirm_email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'first_name_err' => '',
                'last_name_err' => '',
                'username_err' => '',
                'email_err' => '',
                'confirm_email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];  

            if(empty($data['first_name'])){
                $data['first_name_err'] = 'Please enter first name';
            }

            if(empty($data['last_name'])){
                $data['last_name_err'] = 'Please enter last name';
            }

            if(empty($data['username'])){
                $data['username_err'] = 'Please enter username';
            } else {
                //check if username exists
                if($this->userModel->findUserByLoginName($data['username'])){
                    $data['username_err'] = 'Username is already taken';
                }
            }

            if(empty($data['email'])){
                $data['email_err'] = 'Please enter e-mail';
            } else {
                //check if email exists
                if($this->userModel->findUserByLoginName($data['email'])){
                    $data['email_err'] = 'E-mail is already taken';
                }
            }

            if(empty($data['confirm_email'])){
                $data['confirm_email_err'] = 'Please confirm e-mail';
            } else {
                if($data['email'] != $data['confirm_email']){
                    $data['confirm_email_err'] = 'Addresses do not match';
                }
            }

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            } else {
                $err = $this->passwordStrength($data['password']);
                if(!empty($err)){
                    $data['password_err'] = $err;
                }
            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            if(empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['username_err']) && empty($data['email_err']) && empty($data['confirm_email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                // hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user with model
                if($this->userModel->register($data)){
                    flashMessage('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('users/register', $data);
            }

        } else {
            $data = [
                'first_name' => '',
                'last_name' => '',
                'username' => '',
                'email' => '',
                'confirm_email' => '',
                'password' => '',
                'confirm_password' => '',
                'first_name_err' => '',
                'last_name_err' => '',
                'username_err' => '',
                'email_err' => '',
                'confirm_email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];  
        }
        
        $this->view('users/register', $data);
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_username'] = $user->username;

        redirect('pages/index');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_username']);
        session_destroy();

        redirect('');
    }

    
}