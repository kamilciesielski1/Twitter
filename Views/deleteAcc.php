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
        
        $user2 = new Users();
        $user2->setId($_SESSION['id']);
        $user2->delete($conn);
        
        session_unset();
        
        header("Location:deleteAccNext.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="Views/css/style.css" type="text/css">
        <title>Twitter</title>
    </head>
    <body>
        <div>
            <form method="POST">
                <label>
                    Czy na pewno chcesz usunąc konto?
                    <input type="submit" value="TAK" name="tak">
                    <input type="submit" value="NIE" name="nie">
                </label>
            </form>
        </div>
    </body>
</html>