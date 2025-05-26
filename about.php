<?php
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== 'LoggedIn') {
        echo '<a href="http://localhost/cs295/final/login.php">You are not logged in. Login instead</a>';
        die();
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="Styles/navBar.css">
        <link rel="stylesheet" href="Styles/style.css">
        <link rel="icon" type="image/x-icon" href="images/looney.ico">

        <style>
            .middle {
                text-align: center;
                padding: 30px;
            }

            .about {
                background: rgb(172, 172, 172);
                padding: 40px;
                margin: 20px auto;
                width: 70%;
                border-radius: 50px;
                box-shadow: 2px 2px 10px #555;
            }

            img {
                width: 300px;
                border-radius: 20px;
                margin-bottom: 20px;
            }

            p {
                font-size: larger;
                line-height: 1.6;
            }
        </style>
        <title>About Looney Tunes</title>
    </head>
    <body>
        <ul>
            <li><a class="active" href="http://localhost/cs295/final/about.php">About</a></li>
            <li><a href="http://localhost/cs295/final/characters.php">Meet the Characters</a></li>
            <li><a href="http://localhost/cs295/final/messageboard.php">Message Board</a></li>
            <li style="float:right"><a href="http://localhost/cs295/final/login.php">Logout</a></li>
        </ul>

        <h1>About Looney Tunes</h1>
        <div class="middle">
            <div class="about">
                <img src="images/looney.png" alt="Looney Tunes Logo">

                <p> <strong>Looney Tunes</strong> is a legendary animated media franchise created by Warner Bros. It began in the 1930s as a series of theatrical cartoon shorts and quickly became one of the most iconic series in animation history. </p>
                <p> The franchise introduced the world to unforgettable characters like Bugs Bunny, Daffy Duck, Tweety Bird, and many others. Over the years, Looney Tunes has grown beyond cartoons into full-length movies, video games, and even comic books. </p>
                <p> Known for its slapstick comedy, clever writing, and memorable catchphrases, Looney Tunes remains a beloved part of entertainment history for both children and adults around the world. </p>
            </div>
        </div>
    </body>
</html>