<?php require APPROOT . '/views/inc/header.php'; ?> 

<section class="section section-todos">
    <div class="container">
        <div class="row">
            <div class="col s12 ">
          <h3 class="left">Todos</h3>
                <a class="btn-floating btn-large waves-effect waves-light green accent-4 modal-trigger right" href="#todos-add"><i class="material-icons">add</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <ul class="collection">
                    <?php foreach($data['todos'] as $todo): ?>
                    <li class="collection-item">
                        <div class="row">
                            <div class="col s8">
                                <a href="#!" class="truncate"><h5><strong><?php echo $todo->todoName; ?></strong></h5></a>
                                <span class="truncate"><strong>Description: </strong><?php echo $todo->todoDescription;?></span>
                                <span class=""><strong>Status: </strong><?php echo $todo->statusName;?></span>
                            </div>
                            <div class="col s4">
                                <?php if($todo->statusId == 1) : ?>
                                <div class="right-align">
                                    <a href="<?php echo URLROOT . '/todos/start/' . $todo->todoId; ?>" class="btn waves-effect waves-light green accent-4">Start</a>
                                </div>
                                <?php else : ?>
                                <div class="right-align">
                                    <a href="<?php echo URLROOT . '/todos/close/' . $todo->todoId; ?>" class="btn waves-effect waves-light red">close</a>
                                </div>
                                <?php endif; ?>
                                <div class="right-align">
                                    <a href="#view-todo<?php echo  $todo->todoId; ?>" class="btn waves-effect waves-light light-blue modal-trigger">View</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section section-tasks">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h3 class="left">Tasks</h3>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <ul class="collection">
                    <?php foreach($data['tasks'] as $task): ?>
                    <li class="collection-item">
                        <div class="row">
                            <div class="col s8">
                                <a href="#!" class="truncate"><h5><strong><?php echo $task->taskName; ?></strong></h5></a>
                                <span class="truncate"><strong>Description: </strong><?php echo $task->taskDescription;?></span>
                                <span class=""><strong>Status: </strong><?php echo $task->statusName;?></span>
                            </div>
                            <div class="col s4">
                                <?php if($task->statusId == 1) : ?>
                                <div class="right-align">
                                    <a href="<?php echo URLROOT . '/tasks/start/' . $task->taskId; ?>" class="btn waves-effect waves-light green accent-4">Start</a>
                                </div>
                                <?php else : ?>
                                <div class="right-align">
                                    <a href="<?php echo URLROOT . '/tasks/close/' . $task->taskId; ?>" class="btn waves-effect waves-light red">Close</a>
                                </div>
                                <?php endif; ?>
                                <div class="right-align">
                                    <a href="#view-todo<?php echo $task->todoId; ?>" class="btn waves-effect waves-light light-blue modal-trigger">View</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
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

<?php foreach($data['todos'] as $todo) : ?>

<div id="view-todo<?php echo $todo->todoId; ?>" class="modal">
    <div class="modal-content">
        <div class="row">
            <div class="col s12">
                <h5><strong><?php echo $todo->todoName;?></strong></h5>
                <span><strong>Description: </strong><?php echo $todo->todoDescription;?></span><br>
                <span><strong>Status: </strong><?php echo $todo->statusName; ?></span><br>
                <span><strong>End Date: </strong><?php echo $todo->deadline; ?></span>
            </div>
        </div>
        <?php if(filterTasks($data['tasks'], $todo->todoId)) : ?>
        <div class="row">
            <div class="col s12">
                <h5><strong>Tasks:</strong></h5>
            </div>
        </div>
        <div class="row"> 
            <ul class="collection">
                <?php foreach(filterTasks($data['tasks'], $todo->todoId) as $task) : ?>
                <li class="collection-item">
                    <div class="row">
                        <div class="col s12">
                            <span class="truncate"><h6><strong><?php echo $task->taskName; ?></strong></h6></span>
                            <span class=""><?php echo $task->taskDescription;?></span><br>
                            <span class=""><strong>Status: </strong><?php echo $task->statusName;?></span>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php else :?> 
        <div class="row">
            <div class="col s12">
                <h5><strong>No Tasks</strong></h5>
            </div>
        </div>                           
        <?php endif; ?>
    </div>
    <div class="modal-footer ">
        <a href="#!" class="btn waves-effect waves-light red modal-close center-align">Close</a>
    </div>
</div>

<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?> 