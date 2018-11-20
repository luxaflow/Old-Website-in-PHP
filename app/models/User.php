<?php

class User {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getUsers(){
        $this->db->query('SELECT id, username FROM users');

        $results = $this->db->resultSet();

        return $results;
    }

    public function login($username, $password){
        $this->db->query('SELECT * FROM users WHERE username = :username OR email = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if($row){
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function register($data){
        //create user record in users table
        $this->db->query('INSERT INTO users (first_name, last_name, username, email, password) VALUES (:first_name, :last_name, :username, :email, :password);');
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

    
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
        
    }

    // find user by email or username
    public function findUserByLoginName($loginName) {
        $this->db->query('SELECT * FROM users WHERE email = :loginName OR username = :loginName');

        $this->db->bind(':loginName', $loginName);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
}