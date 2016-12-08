<?php
    require 'lib/Template.class.php';
    session_start();
    if(isset($_SESSION) && isset($_SESSION["auth"]) && $_SESSION["auth"] == true) {
        header('Location: userdata.php');
    }
    else {
        $tpl = new Template();
        $tpl->assign('TITLE', 'Login!');
        $tpl->assign('SLOGAN', 'Welcome to the Login!');
        $tpl->assign('INFO', '');
        $tpl->display('templates/login.tpl.html');   
    }
?>
