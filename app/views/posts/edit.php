<?php require APPROOT . '/views/inc/header.php'; ?> 

<section class="section-posts-add">
    <div class="container">
        <div class="card-panel grey lighten-3">
            <form action="<?php echo URLROOT . '/posts/edit/' . $data['id']; ?>" method="post">
                <div class="row">
                    <div class="col s12 input-field">
                        <input type="text" name="title" class="validate" value="<?php echo $data['title'] ?>">
                        <label for="title">Title</label>
                        <span class="helper-text"><?php echo $data['title_err'] ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 input-field">
                        <textarea name="body" class="validate materialize-textarea"><?php echo $data['body'] ?></textarea>
                        <label for="body">Body</label>
                        <span class="helper-text"><?php echo $data['body_err'] ?></span>
                    </div>
                </div>
                <div class="row right-align">
                    <div class="col s12">
                        <button type="submit" class="btn waves-effect waves-light green accent-4">Submit</button>
                        <a href="#post-delete" class="btn delete-btn waves-effect waves-light red white-text modal-trigger"><i class="fas fa-trash"></i> Delete</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<div id="post-delete" class="modal">
    <div class="modal-content center">
      <h4 class="truncate">Post: <?php echo $data['title']; ?></h4>
      <p>Are you sure you want to delete this post?</p>
    </div>
    <div class="row center">
      <a href="<?php echo URLROOT . '/posts/delete/' . $data['id']; ?>" class="btn  green accent-4 waves-effect waves-light">Yes</a>
       <a href="#!" class="modal-close btn waves-effect waves-light red  white-text">No</a>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 