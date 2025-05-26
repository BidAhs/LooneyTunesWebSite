<?php
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();

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
            .fixed-form {
                position: sticky;
                bottom: 0;
                left: 0;
                width: 100%;
                background: transparent;
                z-index: 1000;
            }

            .msg {
                width: 300px;
                padding: 50px;
                margin: 20px 0; 
                text-align: center;
                background: rgb(172, 172, 172);
                border-radius: 50px;
                font-size: larger;
                box-shadow: 2px 2px 10px #555;
            }

            .mid {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding-bottom: 80px;
            }
        </style>
        <title>Message Board</title>
    </head>

    <body>
        <ul>
            <li> <a href="http://localhost/cs295/final/about.php">About</a></li>
            <li> <a href="http://localhost/cs295/final/characters.php">Meet the Characters</a></li>
            <li> <a href="http://localhost/cs295/final/messageboard.php">Message Board</a></li>
            <li style="float:right"><a class="active" href="http://localhost/cs295/final/login.php">Logout</a></li>
        </ul>

        <h1>Message Board</h1>

        <div class="mid">
            <?php
                if ($_SESSION['logged'] == 'LoggedIn'){
                    $pdo = new PDO('sqlite:../../sqlite/comments.db');

                    $username = $_SESSION['username'];
                    $userQuery = $pdo->query("SELECT id FROM users WHERE userName = '$username'");
                    $user = $userQuery->fetch(PDO::FETCH_ASSOC);

                    if ($user) {
                        $currentId = $user['id'];

                        $msgQuery = $pdo->query("SELECT msg FROM msgs WHERE userId = '$currentId'");

                        foreach ($msgQuery as $row) {
                            echo '<p class="msg">' . $row['msg'] . '</p><br>';
                        }

                    } else {
                        echo "<p> User not found. </p>";
                    }
                }
            ?>

            <div class="fixed-form">
                <form action="messageBoard.php" method="post" class="mid">
                    <p class="msg"> Write a message: <br> 
                    <input type="text" name="mesg" required> <br>
                    <input style="margin:3px;" type="submit" value="SEND"> </p>
                </form>
            </div>

            <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["mesg"])) {
                    $userIDStmt = $pdo->prepare("SELECT id FROM users WHERE userName = ?");
                    $userIDStmt->execute([$username]);
                    $userRow = $userIDStmt->fetch(PDO::FETCH_ASSOC);

                    if ($userRow) {
                        $userID = $userRow['id'];
                        $msg = $_POST["mesg"];

                        $insert = $pdo->prepare("INSERT INTO msgs (userID, msg) VALUES (?, ?)");
                        $insert->execute([$userID, $msg]);
                    } else {
                        echo "<p>No userID</p>";
                    }

                    header("Location: http://localhost/cs295/final/messageBoard.php");
                }                
            ?>
        </div>
    </body>
</html>