<?php
    // load config
    require_once 'configs/config.php';
    // load helpers
    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';
    require_once 'helpers/pagination_helper.php';
    require_once 'helpers/todos_helper.php';


    // Autoload core libaries
    spl_autoload_register(function($className){
        require_once 'libaries/' . $className . '.php';
    });