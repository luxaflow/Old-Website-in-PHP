<?php

class Todo {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getTodos(){

        $this->db->query('  SELECT
                            todos.id AS todoId,
                            users.id AS userId,
                            status.id AS statusId,
                            todos.name AS todoName,
                            todos.description AS todoDescription,
                            status.name AS statusName,
                            users.username AS username,
                            todos.deadline AS deadline,
                            todos.created_by AS todoCreated,
                            todos.modified_by AS todoModifiedBy,
                            todos.modified_at AS todoModifiedAt
                            FROM todos 
                            LEFT JOIN status ON todos.status_id = status.id
                            LEFT JOIN users  ON  todos.user_id = users.id
                            ORDER BY todos.deadline ASC'
                            );

        $results = $this->db->resultSet();

        return $results;
    }

    public function getActiveTodos(){

        $this->db->query('  SELECT
                            todos.id AS todoId,
                            users.id AS userId,
                            status.id AS statusId,
                            todos.name AS todoName,
                            todos.description AS todoDescription,
                            status.name AS statusName,
                            users.username AS username,
                            todos.deadline AS deadline,
                            todos.created_by AS todoCreated,
                            todos.modified_by AS todoModifiedBy,
                            todos.modified_at AS todoModifiedAt
                            FROM todos 
                            LEFT JOIN status ON todos.status_id = status.id
                            LEFT JOIN users  ON  todos.user_id = users.id
                            WHERE todos.status_id != 3
                            ORDER BY todos.deadline ASC'
                            );

        $results = $this->db->resultSet();

        return $results;
    }

    public function getInactiveTodos(){

        $this->db->query('  SELECT
                            todos.id AS todoId,
                            users.id AS userId,
                            status.id AS statusId,
                            todos.name AS todoName,
                            todos.description AS todoDescription,
                            status.name AS statusName,
                            users.username AS username,
                            todos.deadline AS deadline,
                            todos.created_by AS todoCreated,
                            todos.modified_by AS todoModifiedBy,
                            todos.modified_at AS todoModifiedAt
                            FROM todos 
                            LEFT JOIN status ON todos.status_id = status.id
                            LEFT JOIN users  ON  todos.user_id = users.id
                            WHERE todos.status_id = 3
                            ORDER BY todos.deadline ASC'
                            );

        $results = $this->db->resultSet();

        return $results;
    }

    public function addTodo($name, $description, $userId, $deadline, $createdBy){
        
        $this->db->query('INSERT INTO todos 
                        (user_id, name, description, deadline, status_id, created_by, modified_by) 
                        VALUES 
                        (:user_id, :name, :description, :deadline, :status_id, :created_by, :modified_by)');

        $this->db->bind(':user_id', $userId);
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->bind(':deadline', $deadline);
        $this->db->bind(':status_id', 1);
        $this->db->bind(':created_by', $createdBy);
        $this->db->bind(':modified_by', $createdBy);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function startTodo($id, $userId){
        $this->db->query('UPDATE todos SET status_id = 2, modified_by = :modified_by, modified_at = NOW() WHERE id = :id');

        $this->db->bind(':id', $id);
        $this->db->bind(':modified_by', $userId);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function closeTodo($id, $userId){
        $this->db->query('UPDATE todos SET status_id = 3, modified_by = :modified_by, modified_at = NOW() WHERE id = :id');

        $this->db->bind(':id', $id);
        $this->db->bind(':modified_by', $userId);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}