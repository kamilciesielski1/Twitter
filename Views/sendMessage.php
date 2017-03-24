<?php
session_start();

require_once '../Controller/UsersController.php';


if (!isset($_SESSION['zalogowany'])){
        header("Location: ../index.php");
        exit();
    }
    
if ('GET' === $_SERVER['REQUEST_METHOD']){
    if (isset($_GET['id'])){
        $mesReceiverId = $_GET['id'];
        $messageReceiver = Users::loadUserById($conn, $mesReceiverId);
    }
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
        <title>Message Sender</title>
    </head>
    <body>
        <div class="message">
            <h1>Send message to user <?php echo $messageReceiver->getUsername();?></h1>
            <form method="POST" action="sendMessage2.php">
                <textarea maxlength="250" name="mesText" id="messageText"></textarea>
                <div><input type="submit" name="sendText" value="Wyślij wiadomość" id="button">
                <?php
                echo '<input type="hidden" name=recId value="'.$mesReceiverId.'">'
                ?>
                </div>
            </form>
        </div>
    </body>
</html>
