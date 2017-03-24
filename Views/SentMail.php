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
        <title>Sent Mail</title>
    </head>
    <body>
        
        <div>
            <h1>Sent Messages</h1>
            <?php
            $senderId = $_SESSION['id'];

            $allMessages = Messages::loadAllMessagesBySenderId($conn, $senderId);

            if (count($allMessages) > 0){

                foreach ($allMessages as $message){

                    $messageId = $message->getId();
                    $messageCD = $message->getCreationDate();
                    $messageReceiverId = $message->getReceiverId();
                    $receiver = Users::loadUserById($conn, $messageReceiverId);
                    $receiverUsername = $receiver->getUsername();
                    echo '<ul>';
                    echo '<li><a href="messageReviewSent.php?id='.$messageId.'">Message to: <span class="sender">'.$receiverUsername.''
                            . '</span> Sent:'.$messageCD.'</a></li>';
                    echo '</ul>';

                }
            } else {
                echo "No Sent Messages";
            } 
            ?>
        </div>
            
    </body>
</html>


