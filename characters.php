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
            .chrM {
                flex: 0 0 calc(50% - 150px); 
                padding: 20px;
                text-align: center;
                background: rgb(172, 172, 172);
                border-radius: 30px;
                box-sizing: border-box;
                box-shadow: 2px 2px 10px #555;
            }

            .midChr {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: flex-start;
                gap: 20px;
                width: 100%;
                max-width: 1000px;
                margin: 0 auto;       
            }
        </style>
        <title>Characters</title>
    </head>
    <body>
        <ul>
            <li> <a href="http://localhost/cs295/final/about.php">About</a></li>
            <li> <a href="http://localhost/cs295/final/characters.php">Meet the Characters</a></li>
            <li> <a href="http://localhost/cs295/final/messageboard.php">Message Board</a></li>
            <li style="float:right"><a class="active" href="http://localhost/cs295/final/login.php">Logout</a></li>
        </ul>

        <h1>Characters</h1>
        <div class="midChr">
            <?php
                if ($_SESSION['logged'] == 'LoggedIn'){
                    $pdo = new PDO('sqlite:../../sqlite/characters.db');
                    $sql = "SELECT * FROM characters";

                    $results = $pdo->query($sql);
                    foreach($results as $result) {
                        echo "<div class='chrM'>";
                            echo "<h2>" . $result['character'] . "</h2>";
                            echo "<p>" . $result['desc'] . "</p>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </body>
</html>