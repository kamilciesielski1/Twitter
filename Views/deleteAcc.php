<?php
session_start();
require_once '../Controller/UsersController.php';

if (!isset($_SESSION['zalogowany'])){
    
    header("Location: ../index.php");
    exit();
}

if ('POST' === $_SERVER['REQUEST_METHOD']){
    
    if(isset($_POST['nie'])){
        header("Location: main.php");
        
    } elseif (isset ($_POST['tak'])){
        
        $user2 = Users::loadUserById($conn, $_SESSION['id']);
        
        $user2->delete($conn);
        
        session_unset();
        
        header("Location:deleteAccNext.php");
    }
    $conn = null;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="Views/css/style.css" type="text/css">
        <style>
            body{background-color: lightgreen;}
        </style>
        <title>Deleting Account</title>
    </head>
    <body>
        <div>
            <form method="POST">
                <label>
                    Are You sure You want to delete Your account?
                    <input type="submit" value="YES" name="tak">
                    <input type="submit" value="NO" name="nie">
                </label>
            </form>
        </div>
    </body>
</html>