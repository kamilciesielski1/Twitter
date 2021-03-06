<?php
session_start();
require_once '../Controller/UsersController.php';

if('POST' === $_SERVER['REQUEST_METHOD']){
    if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password2'])){
        
        $walidacja = true;
        //sprawdzenie username------------------------------------------------
        $username = $_POST['username'];
        
        if (strlen($username) < 5 || strlen($username) > 20){
            
            $_SESSION['usernameError'] = "Username must have 5-20 signs!";
            $walidacja = false;
        }
        
        if (ctype_alnum($username) == false){
            
            $_SESSION['usernameError'] = "Username can only use integers and letters";
            $walidacja = false;
        }
        //sprawdzenie maila w bazie---------------------------------------------
        $email = $_POST['email'];
        
        $sql = 'Select * From `Users` Where `email` = :email;';
        $sqlParams = ['email' => $email];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute($sqlParams);
            
            if ($result == true && $query->rowcount() > 0){
                $walidacja = false;
                $_SESSION['emailErr'] = "This email already exists";
            }
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        
         //sprawdzenie hasła---------------------------------------------------
        $pass1 = $_POST['password'];
        $pass2 = $_POST['password2'];
        
        if (strlen($pass1) < 8 || strlen($pass1) > 20){
            
            $walidacja = false;
            $_SESSION['passErr'] = "Password must have 8-20 signs";
        }
        
        if ($pass1 !== $pass2){
            
            $walidacja = false;
            $_SESSION['passErr'] = "Passwords are not the same";
        }
        
        
        //sprawdzenie zatwierdzenia regulaminu---------------------------------
        if (!isset($_POST['regulamin'])){
            $walidacja = false;
            $_SESSION['regErr'] = "You have to accept Policy!!";
        }
        //rejestracja jeśli walidajca ok--------------------------------------
        if ($walidacja == true){
            $user1 = new Users();
            $user1->setUsername($username);
            $user1->setEmail($email);
            $user1->setPassword($pass1);
            $user1->saveToDB($conn);
            
            if ($user1->getId() > 0){
                $_SESSION['zalogowany'] = true;

                $_SESSION['id'] = $user1->getId();
                $_SESSION['username'] = $user1->getUsername();
                $_SESSION['email'] = $user1->getEmail();

                header("Location: main.php");
            }
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
        <title>Sign up</title>
    </head>
    <body>
        <div class="register">
        <form method="POST">
            Username (5-20 signs):<br><input type="text" name="username"><br>
            <?php
            if (isset($_SESSION['usernameError'])){
                echo '<div class="error">'.$_SESSION['usernameError'].'</div>';
                unset($_SESSION['usernameError']);
            }
            ?>
            Email:<br><input type="email" name="email"><br>
            <?php
            if (isset($_SESSION['emailErr'])){
                echo '<div class="error">'.$_SESSION['emailErr'].'</div>';
                unset($_SESSION['emailErr']);
            }
            ?>
            Password (8-20 signs):<br><input type="password" name="password"><br>
            <?php
            if (isset($_SESSION['passErr'])){
                echo '<div class="error">'.$_SESSION['passErr'].'</div>';
                unset($_SESSION['passErr']);
            }
            ?>
            Repeat password:<br><input type="password" name="password2"><br>
            
            <label><input type="checkbox" name="regulamin">Accept Policy</label><br>
            <?php
            if (isset($_SESSION['regErr'])){
                echo '<div class="error">'.$_SESSION['regErr'].'</div>';
                unset($_SESSION['regErr']);
            }
            ?>
            <input type="submit" value="Sign up">
        </form>
        </div>
    </body>
</html>
        
        
        
        
        
        
        
        
        
        
        
        
        