<?php
require 'Database.php';
require 'lib/Template.class.php';
$host = 'localhost';
//$db   = 'internettechdb';
//$user = 'root';
//$pass = 'geheim';
//$charset = 'utf8';

//$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
//new PDO($dsn, $user, $pass, $opt);

$range = array (
    'options' => array (
        'min_range' => 1,
        'max_range' => 6
    )
);

$dbuser = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$dbpassword = crypt(filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW));
$dbnote = filter_input(INPUT_POST, 'note', FILTER_VALIDATE_INT, $range);
if ($dbnote === false || $dbnote === null) {
    $dbnote = 6;
}
$errcode = Database::regUser($dbuser, $dbpassword, $dbnote);

$tpl = new Template();
if ($errcode === 1) {
    $tpl->assign('TITLE', 'username taken!');
    $info = '<div class="alert alert-warning">
                <strong>Username already taken!</strong> Please try another username.
            </div>';
    $tpl->assign('INFO', $info);
    $tpl->assign('SLOGAN', 'Register!');
    $tpl->display('templates/register.tpl.html'); 
}
else if($errcode === 2)
{
    $tpl->assign('TITLE', 'database failed!');
    $info = '<div class="alert alert-danger">
                <strong>Login failed!</strong> Internal Database error! Please try again later.
            </div>';
    $tpl->assign('INFO', $info);
    $tpl->assign('SLOGAN', 'Register!');
    $tpl->display('templates/register.tpl.html'); 
}
else
{
    $tpl->assign('TITLE', 'Login sucess!');
    $tpl->assign('INFO', '<div class="alert alert-success">
            <strong>Registration was sucessfully!</strong> Now login.
        </div>');
    $tpl->assign('SLOGAN', 'Welcome back to the Login!');
    $tpl->display('templates/login.tpl.html'); 
}
?>