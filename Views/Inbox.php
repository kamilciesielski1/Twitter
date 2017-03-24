<?php

session_start();

require_once '../Controller/MessagesController.php';
require_once '../Controller/UsersController.php';

if (!isset($_SESSION['zalogowany'])){
        header("Location: ../index.php");
        exit();
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
        <title>Inbox</title>
    </head>
    <body>
        <div>
            <div class="newmessages">
                <h1>New Messages</h1>
                <?php
                $receiverId = $_SESSION['id'];

                $allMessages = Messages::loadAllMessagesByReceiverId($conn, $receiverId);

                if (count($allMessages) > 0){

                    foreach ($allMessages as $message){

                        $messageStatus = $message->getStatus();
                        if ($messageStatus == 0){
                            $messageId = $message->getId();
                            $messageCD = $message->getCreationDate();
                            $messageSenderId = $message->getSenderId();
                            $sender = Users::loadUserById($conn, $messageSenderId);
                            $senderUsername = $sender->getUsername();
                            echo '<ul>';
                            echo '<li><a href="messageReview.php?id='.$messageId.'">Message from: <span class="sender">'.$senderUsername.''
                                    . '</span> Sent:'.$messageCD.'</a></li>';
                            echo '</ul>';
                        } 
                    }
                }else {
                    echo "No New messages";
                } 
                ?>
            </div>
            <div class="readmessages">
                <h1>Read messages</h1>
                <?php
                if (count($allMessages) > 0){

                    foreach ($allMessages as $message){

                        $messageStatus = $message->getStatus();
                        if ($messageStatus == 1){
                            $messageId = $message->getId();
                            $messageCD = $message->getCreationDate();
                            $messageSenderId = $message->getSenderId();
                            $sender = Users::loadUserById($conn, $messageSenderId);
                            $senderUsername = $sender->getUsername();
                            echo '<ul>';
                            echo '<li><a href="messageReview.php?id='.$messageId.'">Message from: <span class="sender">'.$senderUsername.''
                                    . '</span> Sent:'.$messageCD.'</a></li>';
                            echo '</ul>';
                        }
                    }
                } else {
                    echo "No read messages";
                } 
                ?>
            </div>
        </div>
    </body>
</html>
            
                    
