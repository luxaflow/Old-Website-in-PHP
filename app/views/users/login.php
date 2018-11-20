<?php require APPROOT . '/views/inc/header.php'; ?> 

<section class="section section-login">
    <div class="container">
        <div class="row">
            <div class="col s12 m4 offset-m4">
                <div class="card-panel grey lighten-3">
                    <?php flashMessage('register_success'); ?>
                    <?php flashMessage('login_failed'); ?>
                    <h4 class="center">Login</h4>
                    <p class="center">Enter credentials to login</p>
                     <form action="<?php echo URLROOT; ?>/users/login" method="post" >
                        <div class="row">
                            <div class="col s12 input-field">
                                <input type="text" name="username" class="validate" value="<?php echo $data['username']; ?>">
                                <label for="username">Username/E-mail</label>
                                <span class="helper-text"><?php echo $data['username_err']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 input-field">
                                <input type="password" name="password" class="password" value="<?php echo $data['password']; ?>">
                                <label for="password">Password</label>
                                <span class="helper-text"><?php echo $data['password_err']; ?></span>
                            </div>
                        </div>
                        <div class="row valign-wrapper">
                            <div class="col m5 s12">
                                <button type="submit" class="btn btn-large waves-effect waves-light light-blue">Login</button>
                            </div>
                            <div class="col m7 s12 input-field">
                                <a href="<?php echo URLROOT; ?>/users/login">No account? Register!</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?> 
