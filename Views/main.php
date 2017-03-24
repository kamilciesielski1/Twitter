<?php
    session_start();
    
    require_once '../Controller/TweetController.php';
    require_once '../Controller/UsersController.php';
    require_once '../Controller/CommentController.php';
    require_once '../Controller/MessagesController.php';
    
    if (!isset($_SESSION['zalogowany'])){
        header("Location: ../index.php");
        exit();
    }
    
    
    
    if ('POST' === $_SERVER['REQUEST_METHOD']){
        if(!empty($_POST['textarea']) && isset($_POST['tweet'])){
            
            $tweet = new Tweet();
            $tweet->setUserId($_SESSION['id']);
            $tweet->setText($_POST['textarea']);
            $tweet->setCreationDate(date("Y-n-j G:i:s", time()));
            
            $tweet->saveToDB($conn);
            
        }
        
        if (!empty($_POST['commentext']) && isset($_POST['comment'])){
            
            
            $comment = new Comment();
            $comment->setUserId($_SESSION['id']);
            $comment->setTweetId($_POST['tweetId']);
            $comment->setCreationDate(date("Y-n-j G:i:s", time()));
            $comment->setText($_POST['commentext']);
            
            $comment->saveToDB($conn);
        }
        
    }
    
    //new messages
    $newmessages = Messages::loadAllMessagesByStatus0($conn, $_SESSION['id']);
    $numberOfNewMessages = count($newmessages);

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
        <title>Twitter Main</title>
    </head>
    <body>
        
        <div class="panel">
            <?php
            echo "Welcome ".$_SESSION['username']."<br>";
            ?>
            <a href="yourAcc.php">Your Account</a><br>
            <a href="Inbox.php">Inbox<?php echo " (".$numberOfNewMessages.")";?></a><br>
            <a href="SentMail.php">Sent Mail</a><br>
            <a href="logout.php">Logout</a><br><br>            
            <a href="deleteAcc.php" id="deletebutton">Delete Account</a>
        </div>
        <div class="posty">
            <form method="POST">
            <textarea maxlength="140" id="text" name="textarea"></textarea>
            <input type="submit" name="tweet" id="button1" value="Send Tweet">
            </form>
        </div>
        <div class="all">
            <?php
                $array = Tweet::loadAllTweets($conn);
                if(count($array) > 0){
                    foreach ($array as $tweet1){
                        //tweety i info----------------------------------------------
                        echo '<p class="tweets"><span class="text1">'.$tweet1->getText().'</span><br>';
                        $authorOfTweet = Users::loadUserById($conn, $tweet1->getUserId());
                        echo '<span class="text2">Author:<a href="userReview.php?id='.$authorOfTweet->getId().'">'.$authorOfTweet->getUsername().'</a><br>';

                        echo $tweet1->getCreationDate().'</span></p>';
                        //komentarze-------------------------------------------------
                        $tweetId = $tweet1->getId();
                        echo '<div class="comment"><form method="POST">'
                            . '<textarea maxlength=100 id="text2" name="commentext"></textarea>';
                        echo '<input type="submit" name="comment" value="Send comment">'
                            .'<input type=\'hidden\' name=\'tweetId\' value='.$tweetId.'>'
                            . '</form></div>';
                        echo 'COMMENTS:<br>';
                        $allcomments = Comment::loadAllCommentsByTweetId($conn, $tweetId);

                        if (count($allcomments) > 0){
                            foreach($allcomments as $comment){
                                echo '<div class="comtext"><span class="text3">'.$comment->getText().'</span><br>';
                                $autorOfComment = Users::loadUserById($conn, $comment->getUserId());
                                echo '<span class=text2>Author:<a href="userReview.php?id='.$autorOfComment->getId().'">'.$autorOfComment->getUsername().'</a><br>';
                                echo $comment->getCreationDate().'</span></div>';

                            }
                        } else {
                            echo "None";
                        }
                        echo '<hr>';
                    }
                }        
            ?>
        </div>
    </body>
</html>
        
        