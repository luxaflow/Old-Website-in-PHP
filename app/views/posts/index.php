<?php require APPROOT . '/views/inc/header.php'; ?> 


<section class="section-posts">
    <div class="container">
        <div class="row">
            <div class="col s12 ">
          
            <?php if(isLoggedIn()) : ?>
              
                <a class="btn-floating btn-large waves-effect waves-light green accent-4 right" href="<?php echo URLROOT; ?>/posts/add"><i class="material-icons">add</i></a>
                
            <?php endif ; ?>
            </div>
        </div>
        <div class="row">
        <?php foreach(array_slice($data['posts'], ($data['page'] - 1) * $data['postsPerPage'], ($data['postsPerPage']), true) as $post) : ?>

        <div class="card grey lighten-2">
            <div class="card-content">
                <span class="card-title"><strong><?php echo $post->title; ?></strong></span>
                <p><?php echo nl2br($post->body); ?></p>
            </div>
            <div class="card-action">
                <div class="row">
                    <div class="col s6 left">
                        <p class="post-by">Written by: <?php echo $post->username; ?></p>
                    </div>
                    <div class="col s6 right-align">
                        <p class="post-by"><?php echo $post->postModified; ?></p>
                    </div>
                </div>
                <?php if(isLoggedIn()) : ?>
                <div class="row">
                    <div class="col s12 right-align">
                        <a href="<?php echo URLROOT . '/posts/edit/' . $post->postId ; ?>" class="btn delete-btn waves-effect waves-light light-blue white-text"><i class="fas fa-pen"></i> edit</a>
                    </div>
                </div>
                <?php endif ; ?>
            </div>
        </div>
        
        <?php endforeach; ?>

        </div>
        <div class="row">
            <div class="col s12 m6 offset-m3 center">
                <ul class="pagination">
                    <li><a href="<?php echo URLROOT . '/posts/' . ($data['page'] - 1);  ?>"><i class="fas fa-chevron-left light-blue-text"></i></a></li>

                    <?php 
                    // pagination always showing atleast 5 options with
                    for($i = $data['startPagination']; $i <= $data['endPagination'];$i++): ?>
                    
                    <li class="waves-effect <?php echo $data['page'] == $i ? 'light-blue':''; ?>">
                        <a href="<?php echo URLROOT . '/posts/' . $i;  ?>" class="<?php echo $data['page'] == $i ? 'white-text':'light-blue-text'; ?>"><?php echo $i; ?></a>
                    </li>

                    <?php endfor; ?>

                    <li class="waves-effect"><a href="<?php echo URLROOT . '/posts/' . ($data['page'] + 1);  ?>"><i class="fas fa-chevron-right light-blue-text"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?> 
