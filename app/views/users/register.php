<?php require APPROOT . '/views/inc/header.php'; ?> 

<section class="section section-register">
    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card-panel grey lighten-3">
                    <h4 class="center">Register</h4>
                    <p class="center">Fill form to register account</p>
                     <form action="<?php echo URLROOT; ?>/users/register" method="post" >
                        <div class="row">
                            <div class="col m6 s12 input-field">
                                <input type="text" name="first_name" class="validate" value="<?php echo $data['first_name']; ?>">
                                <label for="first_name" >First Name</label>
                                <span class="helper-text"><?php echo $data['first_name_err']; ?></span>
                            </div>
                            <div class="col m6 s12 input-field">
                                <input type="text" name="last_name" class="validate" value="<?php echo $data['last_name']; ?>">
                                <label for="last_name">Last Name</label>
                                <span class="helper-text"><?php echo $data['last_name_err']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 input-field">
                                <input type="text" name="username" class="validate" value="<?php echo $data['username']; ?>">
                                <label for="username">Username</label>
                                <span class="helper-text"><?php echo $data['username_err']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m6 s12 input-field">
                                <input type="email" name="email" class="validate" value="<?php echo $data['email']; ?>">
                                <label for="email">E-mail</label>
                                <span class="helper-text"><?php echo $data['email_err']; ?></span>
                            </div>
                            <div class="col m6 s12 input-field">
                                <input type="email" name="confirm_email" class="validate" value="<?php echo $data['confirm_email']; ?>">
                                <label for="confirm_email">Confirm E-mail</label>
                                <span class="helper-text"><?php echo $data['confirm_email_err']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m6 s12 input-field">
                                <input type="password" name="password" class="password" value="<?php echo $data['password']; ?>">
                                <label for="password">Password</label>
                                <span class="helper-text"><?php echo $data['password_err']; ?></span>
                            </div>
                            <div class="col m6 s12 input-field">
                                <input type="password" name="confirm_password" class="validate" value="<?php echo $data['confirm_password']; ?>">
                                <label for="confirm_password">Confirm Password</label>
                                <span class="helper-text"><?php echo $data['confirm_password_err']; ?></span>
                            </div>
                        </div>
                        <div class="row valign-wrapper bold">
                            <div class="col m6 s12">
                                <button type="submit" class="btn btn-large waves-effect waves-light light-blue">Register</button>
                            </div>
                            <div class="col m6 s12 input-field">
                                <a href="<?php echo URLROOT; ?>/users/login">Have an account? Login!</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?> 
