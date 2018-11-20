<?php require APPROOT . '/views/inc/header.php'; ?> 


<section class="section-list-todos section">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="col s4 m2 offset-m2">
                        <a class="btn light-blue <?php echo checkUrl('todos/list/active') || checkUrl('todos/list/active/' . $data['page']) ? 'todos-btn-active' : 'todos-btn' ; ?>" href="<?php echo URLROOT;?>/todos/list/active">Active</a>
                    </div>
                    <div class="col s4 m2 ">
                        <a class="btn light-blue <?php echo checkUrl('todos/list/inactive') || checkUrl('todos/list/inactive/' . $data['page']) ? 'todos-btn-active' : 'todos-btn' ; ?>" href="<?php echo URLROOT; ?>/todos/list/inactive">Inactive</a>
                    </div>
                    <div class="col s4 m2 p">
                        <a class="btn light-blue <?php echo checkUrl('todos/list/all') || checkUrl('todos/list/all/' . $data['page']) ? 'todos-btn-active' : 'todos-btn' ; ?>" href="<?php echo URLROOT; ?>/todos/list/all">All</a>
                    </div>
                </div>
                <div class=" col s12">
                        <a class="btn-floating btn-large waves-effect waves-light green accent-4 right modal-trigger" href="#todos-add"><i class="material-icons">add</i></a>
                    </div>
            </div>
        </div>
        <?php foreach($data['todos'] as $todo) : ?>

        <div class="row">
            <div class="col s12">
                <div class="card grey lighten-3">
                    <div class="card-content">
                    <div class="card-panel z-depth-0">
                        <div class="row">
                            <div class="col <?php echo $todo->statusId != 3 ? 's6' : 's12'; ?>">
                                <h5><strong><?php echo $todo->todoName;?></strong></h5>
                                <span><strong>Description: </strong><?php echo $todo->todoDescription;?></span><br>
                                <span><strong>Status: </strong><?php echo $todo->statusName; ?></span><br>
                                <span><strong>End Date: </strong><?php echo $todo->deadline; ?></span>
                            </div>
             
                            <?php if($todo->statusId == 1) : ?>
                            <div class="col s6 right">
                                <div class="right-align">
                                    <a href="<?php echo URLROOT . '/todos/start/' . $todo->todoId; ?>" class="btn waves-effect waves-light green accent-4">Start</a>
                                </div>
                            </div>
                            <?php elseif($todo->statusId == 2) : ?>
                            <div class="col s6 right">
                                <div class="right-align">
                                    <a href="<?php echo URLROOT . '/todos/close/' . $todo->todoId; ?>" class="btn waves-effect waves-light red">Close</a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        </div>
                        <div class="card-panel z-depth-0">    
                            <?php if(filterTasks($data['tasks'], $todo->todoId)) : ?>
                            <div class="row">
                                <div class="col <?php echo $todo->statusId != 3 ? 's7' : 's12'; ?>">
                                    <h5><strong>Tasks:</strong></h5>
                                </div>
                                <div class="col s5">
                                    <?php if($todo->statusId != 3) : ?>
                                    <a class="btn waves-effect waves-light light-blue right modal-trigger" href="#add-task<?php echo $todo->todoId; ?>">New</a>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="row"> 
                                <ul class="collection">
                                    <?php foreach(filterTasks($data['tasks'], $todo->todoId) as $task) : ?>
                                    <li class="collection-item">
                                        <div class="row">
                                            <div class="col <?php echo $todo->statusId == 3 || $task->statusId == 3 ? 's12' : 's7'; ?>">
                                                <span class="truncate"><h6><strong><?php echo $task->taskName; ?></strong></h6></span>
                                                <span class=""><?php echo $task->taskDescription;?></span><br>
                                                <span class=""><strong>Status: </strong><?php echo $task->statusName;?></span>
                                            </div>
                                            
                                            <?php if($task->statusId == 1 && $todo->statusId != 3)  : ?>
                                            <div class="col s5">
                                                <div class="right-align">
                                                    <a href="<?php echo URLROOT . '/tasks/start/' . $task->taskId; ?>" class="btn waves-effect waves-light green accent-4">Start</a>
                                                </div>
                                            </div>
                                            <?php elseif($task->statusId == 2  && $todo->statusId != 3) : ?>
                                            <div class="col s5">
                                                <div class="right-align">
                                                    <a href="<?php echo URLROOT . '/tasks/close/' . $task->taskId; ?>" class="btn waves-effect waves-light red">close</a>
                                                </div>
                                            </div>
                                            <?php else : ?>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php else :?> 
                            <div class="row">
                                <div class="col <?php echo $todo->statusId != 3 ? 's7' : 's12'; ?>">
                                    <h5><strong>No Tasks</strong></h5>
                                </div>
                                <?php if($todo->statusId != 3) : ?>
                                <div class="col s5">
                                    <a class="btn waves-effect waves-light light-blue right modal-trigger" href="#add-task<?php echo $todo->todoId; ?>">New</a>
                                </div>
                                <?php endif;?>
                            </div>                           
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    <div class="row">
        <div class="col s12 m6 offset-m3 center">
            <ul class="pagination">
                <li><a href="<?php echo URLROOT . '/todos/list/active/'; echo ($data['page'] - 1) <=  $data['startPagination'] ? $data['startPagination'] : ($data['page'] - 1);?>"><i class="fas fa-chevron-left light-blue-text"></i></a></li>

                <?php for($i = $data['startPagination']; $i <= $data['endPagination'];$i++): ?>
                
                <li class="waves-effect <?php echo $data['page'] == $i ? 'light-blue':''; ?>">
                    
                    <a href="<?php echo URLROOT . '/' . url_strip($_GET['url'], 3) . '/' . $i;  ?>" class="<?php echo $data['page'] == $i ? 'white-text':'light-blue-text'; ?>"><?php echo $i; ?></a>
                </li>

                <?php endfor; ?>

                <li class="waves-effect"><a href="<?php echo URLROOT . '/todos/list/active/'; echo ($data['page'] + 1) >=  $data['endPagination'] ? $data['endPagination'] : ($data['page'] + 1); ?>"><i class="fas fa-chevron-right light-blue-text"></i></a></li>
            </ul>
        </div>
    </div>
</section>

<div id="todos-add" class="modal">
    <div class="modal-content">
        <form action="<?php echo URLROOT;?>/todos/add" method="post">
            <div class="row">
                <div class="col s12 input-field">
                    <input type="text" id="todo-name" name="name" class="validate" data-length="100">
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field">
                    <textarea id="todo-description" name="description" class="validate materialize-textarea" data-length="255"></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 input-field">
                    <select name="user_id">
                        <option value="" disabled selected>Choose a user:</option>
                        <?php foreach($data['users'] as $user) : ?>
                        <option value="<?php echo $user->id;?>"><?php echo $user->username;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col s12 m6 input-field">
                     <input type="date" name="deadline">
                     <label for="deadline">Deadline</label>
                </div>
                <div class="row">
                    <div class="col s12 input-field right-align">
                        <button type="submit" class="btn waves-effect waves-light green accent-4">
                            Submit
                        </button>
                        <a class="modal-close waves-effect waves-light red btn" href="#!">Close</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php foreach ($data['todos'] as $todo) : ?>

<div id="<?php echo 'add-task' . $todo->todoId; ?>" class="modal">
    <div class="modal-content">
        <form action="<?php echo URLROOT . '/tasks/add/' . $todo->todoId;?>" method="post">
            <div class="row">
                <div class="col s12 input-field">
                    <input type="text" id="task-name" name="name" class="validate" data-length="100" value="<?php if(isset($data['todoId'])){ echo $data['todoId'] == $todo->todoId ? $data['name'] : ''; } ?>">
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field">
                    <textarea id="task-description" name="description" class="validate materialize-textarea" data-length="255"><?php if(isset($data['todoId'])){ echo $data['todoId'] == $todo->todoId ? $data['description'] : ''; } ?></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field right-align">
                    <button type="submit" class="btn waves-effect waves-light green accent-4">
                        Submit
                    </button>
                    <a class="modal-close waves-effect waves-light red btn" href="#!">Close</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php endforeach ?>

          
<?php require APPROOT . '/views/inc/footer.php'; ?> 