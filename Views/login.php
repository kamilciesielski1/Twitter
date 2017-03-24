<?php

session_start();

if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true){
    header("Location: main.php");
    exit();
}

require_once '../Controller/UsersController.php';

if ('POST' === $_SERVER['REQUEST_METHOD']){
    if (isset($_POST['email'], $_POST['password'])){
        
        $sql = 'Select * From `Users` Where `email` = :email;';
        
        $sqlParams = ['email' => $_POST['email']];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute($sqlParams);
            $row = $query->fetch();
            
            if (password_verify($_POST['password'], $row['password']) && $query->rowcount() > 0){
                
                $_SESSION['zalogowany'] = true;
                
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                
                header("Location: main.php");
                
            } else {
                $_SESSION['error'] = "Username or passowrd incorrect!";
                
            }
            
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
    $conn = null;
}
                
                
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <style>
            body{background-color: lightgreen;}
        </style>
        <title>Sign in</title>
    </head>
    <body>
        <div class="login">
            <form method="POST">
                <p>Your email</p>
                <input type="email" id="email" name="email">
                <p>Your password</p>
                <input type="password" id="password" name="password"><br>
                <button type="submit">Sign in!</button>
            </form>
            <?php
            if (isset($_SESSION['error'])){
            echo '<div class="error">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);
            }
            ?>
        </div>
    </body>
</html>
            
            
                
            
