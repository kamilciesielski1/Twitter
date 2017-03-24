<?php
session_start();

if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true){
    header("Location: Views/main.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="Views/css/style.css" type="text/css">
        <style>
            body{background-color: lightgreen;}
        </style>
        <title>Twitter</title>
    </head>
    <body>
        <div class ="index">
            <div class="zaloguj">
                <form method="POST" action="Views/login.php">
                <p>If You are already a User...</p>
                <button type="submit" id="zaloguj" name="zaloguj">Sign in</button>

            </form>
            </div>
            <div class="zarejestruj">
                <form method="POST" action="Views/register.php">
                <p>If this is Your first time here...</p>
                <button type="submit" id="zarejestruj" name="zarejestruj">Sign up</button>
            </form>
            </div>
        </div>
    </body>
</html>
