<?php
require 'Database.php';
require 'lib/Template.class.php';
session_start();
$minlenuser = 8;
$minlenpassword = 8;
$maxlenuser = 32;
$maxlenpassword = 32;

$user = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
$lenuser = strlen($user);
$lenpassword = strlen($password);

//$password = crypt($password);//crypt the password

$errcode = Database::validateUserpass($user, $password);
$tpl = new Template();        
if($errcode === 0) {
    $_SESSION["username"] = $user;//Maybe this is fucking insecure
    $_SESSION["password"] = $password;//Oh no, i just read that Sessioncookies are server sided
    $_SESSION["auth"] = true;
    //Redirect
    header('Location: userdata.php');
}
else if($errcode === 1)    //do Some nice messages and stuff
{    
    $tpl->assign('TITLE', 'Login failed!');
    $tpl->assign('INFO', '<div class="alert alert-danger">
                            <strong>Login failed!</strong> Username or password wrong!
                            </div>');
    $tpl->assign('SLOGAN', 'Login!');
    $tpl->display('templates/login.tpl.html'); 
    
} 
else {
    $tpl->assign('TITLE', 'database failed!');
    $info = '<div class="alert alert-danger">
                        <strong>Login failed!</strong> Internal Database error! Please try again later.
                    </div>';
    $tpl->assign('INFO', $info);
    $tpl->assign('SLOGAN', 'Login!');
    $tpl->display('templates/login.tpl.html'); 
}
?>

