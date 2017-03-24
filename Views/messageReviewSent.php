<?php

session_start();

require_once '../Controller/MessagesController.php';
require_once '../Controller/UsersController.php';

if (!isset($_SESSION['zalogowany'])){
        header("Location: ../index.php");
        exit();
}

if ('GET' === $_SERVER['REQUEST_METHOD']){
    if(isset($_GET['id'])){
        
        $messageId = $_GET['id'];
        
        $newmessage = Messages::loadMessageById($conn, $messageId);
        
        
    }else {
        
    header("Location:main.php");
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
        <title>Message Review</title>
    </head>
    <body>
        <div>
            <h1>Message</h1><br>
            <?php
            $senderId = $newmessage->getSenderId();
            $receiverId = $newmessage->getReceiverId();
            
            $messageReceiver = Users::loadUserById($conn, $receiverId);
            $messageSender = Users::loadUserById($conn, $senderId);
            
            $senderUsername = $messageSender->getUsername();
            $receiverUsername = $messageReceiver->getUsername();
            
            $messagetext = $newmessage->getText();
            $messagedate = $newmessage->getCreationDate();
            
            echo '<span class="text2">Author: '.$senderUsername.'</span><br><br>';
            echo '<span class="text2">Receiver: '.$receiverUsername.'</span><br><br>';
            echo '<span class="text2">Send date: '.$messagedate.'</span><br><br>';
            echo '<span class="text1">Text: '.$messagetext.'</span>';
            ?>
        </div>
    </body>
</html>
