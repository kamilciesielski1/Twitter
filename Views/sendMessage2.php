<?php
session_start();
require_once '../Controller/UsersController.php';
require_once '../Controller/MessagesController.php';

if (!isset($_SESSION['zalogowany'])){
        header("Location: ../index.php");
        exit();
}

if ('POST' === $_SERVER['REQUEST_METHOD']){
    if (!empty($_POST['mesText'])){
        
        $mesText = $_POST['mesText'];
        $mesReceiverId = $_POST['recId'];
        $newuser = Users::loadUserById($conn, $mesReceiverId);
        $newusername = $newuser->getUsername();
                
        $newmessage = new Messages();
        $newmessage->setSenderId($_SESSION['id']);
        $newmessage->setReceiverId($mesReceiverId);
        $newmessage->setCreationDate(date("Y-n-j G:i:s", time()));
        $newmessage->setStatus(0);
        $newmessage->setText($mesText);
        
        $newmessage->saveToDB($conn);
    }
} else {
    header("Location:main.php");
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
        <title>Message info</title>
    </head>
    <body>
        <h1>Message was sent to <?php echo $newusername; ?></h1>
        <a href="main.php">MAIN PAGE</a>
    </body>
</html>
        
        