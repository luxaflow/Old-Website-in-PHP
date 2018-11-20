<?php

class Task {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }
    
        public function getTasks(){

        $this->db->query('  SELECT
                            tasks.id AS taskId,
                            todos.id AS todoId,
                            status.id AS statusId,
                            todos.name AS todoName,
                            tasks.name AS taskName,
                            tasks.description AS taskDescription,
                            status.name AS statusName,
                            tasks.created_by AS todoCreated,
                            tasks.modified_by AS taskModifiedBy,
                            tasks.modified_at AS taskModifiedAt
                            FROM tasks 
                            LEFT JOIN status  ON tasks.status_id = status.id 
                            LEFT JOIN todos  ON  tasks.todo_id = todos.id
                            ORDER BY todos.deadline ASC'
                            );

        $results = $this->db->resultSet();

        return $results;
    }

     public function getTasksByTodoId($todoId){

        $this->db->query('  SELECT
                            tasks.id AS taskId,
                            todos.id AS todoId,
                            status.id AS statusId,
                            todos.name AS todoName,
                            tasks.name AS taskName,
                            tasks.description AS taskDescription,
                            status.name AS statusName,
                            tasks.created_by AS todoCreated,
                            tasks.modified_by AS taskModifiedBy,
                            tasks.modified_at AS taskModifiedAt
                            FROM tasks 
                            LEFT JOIN status  ON tasks.status_id = status.id 
                            LEFT JOIN todos  ON  tasks.todo_id = todos.id
                            WHERE tasks.todo_id = :todoId
                            ORDER BY todos.deadline ASC'
                            );
        
        $this->db->bind(':todoId', $todoId);

        $results = $this->db->resultSet();

        return $results;
    }
    


    public function getActiveTasks(){

        $this->db->query('  SELECT
                            tasks.id AS taskId,
                            todos.id AS todoId,
                            status.id AS statusId,
                            todos.name AS todoName,
                            tasks.name AS taskName,
                            tasks.description AS taskDescription,
                            status.name AS statusName,
                            tasks.created_by AS todoCreated,
                            tasks.modified_by AS taskModifiedBy,
                            tasks.modified_at AS taskModifiedAt
                            FROM tasks 
                            LEFT JOIN status  ON tasks.status_id = status.id 
                            LEFT JOIN todos  ON  tasks.todo_id = todos.id
                            WHERE tasks.status_id != 3
                            ORDER BY todos.deadline ASC'
                            );

        $results = $this->db->resultSet();

        return $results;
    }

    public function addTask($data){
        
        $this->db->query('INSERT INTO tasks (todo_id, name, description, status_id, created_by, modified_by) VALUES (:todo_id, :name, :description, 1, :created_by, :modified_by)');

        $this->db->bind(':todo_id', $data['todoId']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':created_by', $data['userId']);
        $this->db->bind(':modified_by', $data['userId']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
   
    }

    public function startTask($id, $user_id){
        
        $this->db->query('UPDATE tasks SET status_id = 2, modified_by = :modified_by, modified_at = NOW()  WHERE id = :id');

        $this->db->bind(':modified_by', $user_id);
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function closeTask($id, $user_id){
        
        $this->db->query('UPDATE tasks SET status_id = 3, modified_by = :modified_by, modified_at = NOW() WHERE id = :id');

        $this->db->bind(':modified_by', $user_id);
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

}