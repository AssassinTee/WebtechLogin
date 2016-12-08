<?php
    require 'lib/Template.class.php';
    $tpl = new Template();
    $tpl->assign('TITLE', 'Register!');
    $tpl->assign('SLOGAN', 'Welcome to the Registration');
    $tpl->assign('INFO', '');
    $tpl->display('templates/register.tpl.html');   
?>
