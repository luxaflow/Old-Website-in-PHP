<?php require APPROOT . '/views/inc/header.php'; ?> 

<section class="section-posts-view">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card grey lighten-2">
            <div class="card-content">
                <span class="card-title"><strong><?php echo $data['post']->title; ?></strong></span>
                <p><?php echo nl2br($data['post']->body); ?></p>
            </div>
            <div class="card-action">
                <div class="row">
                    <div class="col s6 left">
                        <p class="post-by">Written by: <?php echo $data['post']->username; ?></p>
                    </div>
                    <div class="col s6 right-align">
                        <p class="post-by"><?php echo $data['post']->postModified; ?></p>
                    </div>
                </div>

                <?php if(isLoggedIn()) : ?>
                <div class="row">
                    <div class="col s12 right-align">
                        <a href="<?php echo URLROOT . '/posts/edit/' . $data['post']->postId ; ?>" class="btn delete-btn waves-effect waves-light light-blue white-text"><i class="fas fa-pen"></i> edit</a>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<?php if(isLoggedIn()): ?>
<div id="post-delete" class="modal">
    <div class="modal-content center">
      <h4 class="truncate">Post: <?php echo $data['post']->title; ?></h4>
      <p>Are you sure you want to delete this post?</p>
    </div>
    <div class="row center">
      <a href="<?php echo URLROOT . '/posts/delete/' . $data['post']->postId; ?>" class="btn  green accent-4 waves-effect waves-light">Yes</a>
       <a href="#!" class="modal-close btn waves-effect waves-light red  white-text">No</a>
    </div>
</div>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?> 