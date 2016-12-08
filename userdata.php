<?php
    require 'lib/Template.class.php';
    require 'Database.php';
    session_start();
    $username = $_SESSION["username"];
    //print_r($username);
    $sql = "SELECT note FROM user WHERE username = :username";


    try {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR); 
        $stmt->execute();
        //print_r($stmt->errorInfo());
        $count = $stmt->rowCount();
        if($count == 1) {
            $buf = $stmt->fetch();
            $note = $buf["note"];//I was not able to test this :C
            
            $tpl = new Template();
            $tpl->assign('TITLE', 'Userdata!');
            $tpl->assign('USERNAME', $username);
            $tpl->assign('GRADE', $note);
            
            
            $tpl->display('templates/userdata.tpl.html');
            exit();
        }
    } catch (PDOException $e) {
        
    }
    //Internal side error
    $tpl = new Template();
    $tpl->assign('TITLE', 'database failed!');
    $info = '<div class="alert alert-danger">
                        <strong>Login failed!</strong> Internal Database error! Please try again later.
                    </div>';
    $tpl->assign('INFO', $info);
    $tpl->assign('SLOGAN', 'Login!');
    $tpl->display('templates/login.tpl.html'); 
  
?>
