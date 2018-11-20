<?php require APPROOT . '/views/inc/header.php'; ?> 

<section class="section section-index-banner grey lighten-3">
    <div class="row">
        <div class="col s12">
            <div class="card-content">
                <span class="card-title center"><h2><strong>Luxa<span class="light-blue-text">Flow</span></strong></h2></span>
                <p class="center-align">Running and Learning Code</p>
            </div>
        </div>
    </div>
</section>

<section class="section">   
    <div class="row">
        <div class="col s12 m6 ">
            <div class="card-panel animated slideInLeft card-running grey lighten-3 card-coding">
                <h4 class="center-align">Coding</h4>
                <p>It started with Powershell, but over the course of the past year I learned a lot. After trying several languages I've started focusing on PHP. Currently building this website and have some idea's for apps that will improve my skills.</p>
                <div class="center">
                    <a href="#" class="btn waves-effect waves-light light-blue">Read More...</a>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="card-panel animated slideInRight grey lighten-3 card-running">
                <h4 class="center-align">Running</h4>
                <p>When my wife told me we were going to have a baby, I realized that i was way overweight. So i started running to lose weight. In 1,5 year I lost about 30kg and got addicted to running.</p>
                <div class="center">
                    <a href="#" class="btn waves-effect waves-light light-blue">Read More...</a>
                </div>
            </div>
        </div>
    </div>  
</section>

<section class="section section-index-posts">
    <div class="row">
        <div class="col s12 m6">
            <div class="card grey lighten-2  card-singlepost">
                <div class="card-content singlepost-body">
                    <a href="<?php echo URLROOT . '/posts/post/' . $data['posts'][0]->postId; ?>"><span class="card-title"><strong><?php echo $data['posts'][0]->title; ?></strong></span></a>
                    <p><?php echo nl2br($data['posts'][0]->body); ?></p>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="collection cellection-posts">
                <?php foreach($data['posts'] as $post) : ?>
                    <a href="<?php echo URLROOT .  '/posts/post/' . $post->postId; ?>" class="collection-item light-blue-text truncate"><?php echo $post->title ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?> 
