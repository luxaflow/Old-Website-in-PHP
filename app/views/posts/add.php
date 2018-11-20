<?php require APPROOT . '/views/inc/header.php'; ?> 

<section class="section-posts-add">
    <div class="container">
        <div class="card-panel grey lighten-3">
            <form action="<?php echo URLROOT ?>/posts/add" method="post">
                <div class="row">
                    <div class="col s12 input-field">
                        <input type="text" name="title" class="validate">
                        <label for="title">Title</label>
                        <span class="helper-text"><?php echo $data['title_err'] ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 input-field">
                        <textarea name="body" class="validate materialize-textarea"></textarea>
                        <label for="body">Body</label>
                        <span class="helper-text"><?php echo $data['body_err'] ?></span>
                    </div>
                </div>
                <div class="row right-align">
                    <div class="col s12">
                        <button type="submit" class="btn waves-effect waves-light green accent-4">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?> 