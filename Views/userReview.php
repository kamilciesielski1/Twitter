<?php

session_start();

require_once '../Controller/TweetController.php';
require_once '../Controller/UsersController.php';
require_once '../Controller/CommentController.php';

if (!isset($_SESSION['zalogowany'])){
        header("Location: ../index.php");
        exit();
    }

if ($_SESSION['id'] == $_GET['id']){
    header("Location: yourAcc.php");
}
    
if ('GET' === $_SERVER['REQUEST_METHOD']){
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
        
        $wantedUserId = $_GET['id'];
        $wantedUser = Users::loadUserById($conn, $wantedUserId);
        
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
        <title>User page</title>
    </head>
    <body>
        <div class="panel">
            <?php 
            echo 'Page of User:<br><span class="text1"> '.$wantedUser->getUsername().'</span><br>';
            
            echo '<a id="sendMes" href="sendMessage.php?id='.$wantedUserId.'">Send message</a><br><br>'
            ?>
            
            <a href="main.php">Main page</a>
        </div>
        <div class="all">
                <?php
                $arrayId = Tweet::loadAllTweetsByUserId($conn, $wantedUserId);
                
                if(count($arrayId) > 0){
                    foreach($arrayId as $tweet1){

                        echo '<p class="tweets"><span class="text1">'.$tweet1->getText().'</span><br>';

                        $authorOfTweet = Users::loadUserById($conn, $tweet1->getUserId());

                        echo '<span class="text2">author:'.$authorOfTweet->getUsername().'<br>';
                        echo $tweet1->getCreationDate().'</span></p>';

                        //komentarze
                        $tweetId = $tweet1->getId();
                        echo "COMMENTS:";
                        $allcomments = Comment::loadAllCommentsByTweetId($conn, $tweetId);

                            if (count($allcomments) > 0){
                                foreach($allcomments as $comment){
                                    echo '<div class="comtext"><span class=text3>'.$comment->getText().'</span><br>';
                                    $autorOfComment = Users::loadUserById($conn, $comment->getUserId());
                                    echo "<span class=text2>Author: ".$autorOfComment->getUsername().'<br>';
                                    echo $comment->getCreationDate().'</span></div>';

                                }
                            } else {
                                echo "No comments";
                            }

                    echo '<hr>';
                    }
                } else {
                    echo "No tweets";
                }
                ?>
        </div>
    </body>
</html>
            
        
        
        