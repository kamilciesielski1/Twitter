<?php

session_start();

require_once '../Controller/TweetController.php';

if (!isset($_SESSION['zalogowany'])){
        header("Location: ../index.php");
        exit();
}

if ('GET' === $_SERVER['REQUEST_METHOD']){
    if (isset($_GET['id'])){
        $tweetId = $_GET['id'];
        $tweetToDel = Tweet::loadTweetById($conn, $tweetId);
        $tweetToDel->delete($conn);
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
        <title>Deleting Tweet</title>
    </head>
    <body>
        <h1>Tweet deleted</h1><br>
        <a href="main.php">Main page</a>
    </body>
</html>
        
