<?php

class Post {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getPosts(){
        $this->db->query('  SELECT 
                            posts.title AS title,
                            posts.body AS body,
                            posts.id AS postId,
                            users.id AS userId,
                            posts.created_at AS postCreated,
                            posts.modified_at AS postModified,
                            users.username AS username
                            FROM posts
                            LEFT JOIN users ON posts.created_by = users.id
                            ORDER BY posts.created_at DESC
                            ');

        $results = $this->db->resultSet();  

        return $results;
    }

    public function getPost($id){
        $this->db->query('  SELECT *,
                            posts.id AS postId,
                            users.id AS userId,
                            posts.created_at AS postCreated,
                            posts.modified_at AS postModified,
                            users.created_at AS userCreated
                            FROM posts
                            
                            LEFT JOIN users ON posts.created_by = users.id

                            WHERE posts.id = :id
                            ORDER BY posts.created_at DESC
                            LIMIT 1

                            ');

        $this->db->bind(':id', $id);

        $results = $this->db->single();  

        return $results;
    }

    public function addPost($title, $body){
        $this->db->query('INSERT INTO posts (title, body, created_by, modfied_by) VALUES (:title, :body, :created_by, :modfied_by)');

        $this->db->bind(':title',  trim($title));
        $this->db->bind(':body', trim($body));
        $this->db->bind('created_by', $_SESSION['user_id']);
        $this->db->bind('modfied_by', $_SESSION['user_id']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function updatePost($id, $title, $body){

        $this->db->query('UPDATE posts SET title = :title, body = :body, modified_by = :modified_by, modified_at = NOW() Where id = :id');

        $this->db->bind(':id', $id);
        $this->db->bind(':title',  trim($title));
        $this->db->bind(':modified_by', $_SESSION['user_id']);
        $this->db->bind(':body', trim($body));

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id){

        $this->db->query('DELETE FROM posts WHERE id = :id');

        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}