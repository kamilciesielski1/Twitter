<?php

session_start();
require_once '../Controller/TweetController.php';
require_once '../Controller/UsersController.php';
require_once '../Controller/CommentController.php';

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
        <title>Your account</title>
    </head>
    <body>
        <div>
            <?php
            echo '<div class="panel">Your Tweets:<span class="text1">'.$_SESSION['username'].'</span><br>';
            echo '<a href="main.php">Main page</a></div>';
            ?>
            <div class="all">
                <?php
                $arrayId = Tweet::loadAllTweetsByUserId($conn, $_SESSION['id']);
                if (count($arrayId) > 0){
                    foreach($arrayId as $tweet1){
                        $tweetId = $tweet1->getId();
                        echo '<p class="tweets"><span class="text1">'.$tweet1->getText().'</span><br>';

                        $authorOfTweet = Users::loadUserById($conn, $tweet1->getUserId());

                        echo '<span class="text2">author:'.$authorOfTweet->getUsername().'<br>';
                        echo $tweet1->getCreationDate().'</span><br>';
                        echo '<a href=deleteTweet.php?id='.$tweetId.'>Delete Tweet</a></p>';
                        //komentarze
                        
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
                                echo "None";
                            }

                    echo '<hr>';
                    }
                } else {
                    echo "None";
                }
                ?>
            </div>
        </div>
    </body>
</html>
                
                
                
                    
