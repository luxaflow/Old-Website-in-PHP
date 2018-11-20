<?php if(isset($_SESSION['user_id'])) :?>
<ul id="nav-dropdown" class="dropdown-content">
    <li>
        <a class="light-blue-text" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
    </li>
</ul>

<ul id="todos-dropdown" class="dropdown-content">
    <li>
        <a class="light-blue-text" href="<?php echo URLROOT; ?>/todos/overview">Overview</a>
    </li>
    <li>
        <a class="light-blue-text" href="<?php echo URLROOT; ?>/todos/list/active">List</a>
    </li>
</ul>
<?php endif; ?>

<ul id="main-menu-dropdown" class="dropdown-content center">
    
    <li>
        <a class="center light-blue-text" href="<?php echo URLROOT; ?>">Home</a>
    </li>
    <li>
        <a class="center light-blue-text" href="<?php echo URLROOT; ?>/pages/about">About</a>
    </li>
    <li>
        <a class="center light-blue-text" href="<?php echo URLROOT; ?>/posts/about">Posts</a>
    </li>
    <li class="divider"></li>
    <li>
        <span class="center black-text">To do's</span>
    </li>
    <li>
        <a class="center light-blue-text" href="<?php echo URLROOT; ?>/todos/overview">Overview</a>
    </li>
    <li>
        <a class="center light-blue-text" href="<?php echo URLROOT; ?>/todos/list">List</a>
    </li>
    <li class="divider"></li>
    <?php if(isset($_SESSION['user_id'])) : ?>
    <li>
        <div class="row">
            <div class="col s12">
                <a class="center btn waves-effect waves-light grey lighten-2 light-blue-text" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
            </div>
        </div>
    </li>

    <?php else : ?>

    <li>
        <div class="row">
            <div class="col s12">
                <a class="center btn waves-effect waves-light grey lighten-2 light-blue-text" href="<?php echo URLROOT; ?>/users/login">Login</a>
            </div>
        </div>
    </li>
<?php endif;?>
</ul>

<nav>
    <div class="nav-wrapper light-blue">
        <div class="container">
            <a href="<?php echo URLROOT; ?>" class="brand-logo hide-on-med-and-down">LuxaFlow</a>
            <div class="hide-on-large-only center valign-wrapper">
                <div class="row">
                <a class='menu-dropdown-trigger' data-target='main-menu-dropdown'><h4><?php echo isset($_SESSION['user_username']) ? ucwords($_SESSION['user_username']) . ' ' : 'LuxaFlow  '; ?><i class="fas fa-caret-down"></i></h4></a>
                </div>
            </div>
            <ul class="right hide-on-med-and-down">
                <li class="<?php echo checkUrl('pages/index') ? 'active' : ''; ?>">
                    <a href="<?php echo URLROOT; ?>/pages/index">Home</a>
                </li>

                <!-- ABOUT PAGE WILL BE UPLADED WHEN READY -->
                <!-- <li class="<?php echo checkUrl('pages/about') ? 'active' : ''; ?>">
                    <a href="<?php echo URLROOT; ?>/pages/about">About</a>
                </li> -->
                <li class="<?php echo checkUrl('posts') ? 'active' : ''; ?>">
                    <a href="<?php echo URLROOT; ?>/posts">Posts</a>
                </li>

                <?php if(isLoggedIn()) :?>

                    <li>
                        <a class="todos-dropdown-trigger" data-target="todos-dropdown" href="#">Todos</a>
                    </li>

                    <li>
                        <a class="nav-dropdown-trigger" data-target="nav-dropdown"><?php echo ucfirst($_SESSION['user_username']) . ' '; ?><i class="fas fa-caret-down"></i></a>
                    </li>
                <?php endif; ?>

                <?php if(!checkUrl('users/login') && !isLoggedIn()) : ?>
                    <li class="button">
                        <a class="btn waves-effect waves-light grey lighten-1" href="<?php echo URLROOT; ?>/users/login">Login</a>
                    </li>
                <?php endif ; ?>

                <?php if(isLoggedIn() && !isLoggedIn()) : ?>
                    <li class="button">
                        <a class="btn waves-effect waves-light grey lighten-1" href="<?php echo URLROOT; ?>/users/register">register</a>
                    </li>
                <?php endif ; ?>

            </ul>
        </div>
    </div>
</nav>
 