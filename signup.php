<?php
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    $_SESSION['logged'] = 'LoggedOut';
?>

<html>
    <head>
        <link rel="stylesheet" href="Styles/style.css">
        <link rel="icon" type="image/x-icon" href="images/looney.ico">
        <title>Signup</title>
    </head>
    <body>
        <div class="center">
            <div id="login">
                <h1 style="margin:20px;">Sign-Up</h1>
                <form action="signup.php" method="post">
                    <label for="user">USERNAME</label><br>
                    <input type="text" name="USER" id="user" required><br>

                    <label for="pass">PASSWORD</label><br>
                    <input type="password" name="PASS" id="pass" required><br>

                    <input type="submit" value="Create Account" style="margin:10px;">
                </form>
                <a class="active" href="http://localhost/login.php" style="border-radius: 50px;">Login instead</a>
        
                <?php
                    if(isset($_POST["USER"]) && isset($_POST["PASS"])){
                        $userEntered = strToLower($_POST["USER"]);
                        $passEntered = $_POST["PASS"];

                        $pdo = new PDO('sqlite:sqlite/comments.db');
                        $sql = "SELECT userName from users WHERE userName ='".($userEntered)."'";

                        $result = $pdo->query($sql);
                        $row = $result->fetch(PDO::FETCH_ASSOC);

                        if ($row && ($userEntered) === $row['userName']){
                            echo "Already an account with that username";
                        } else {
                            $pdo->exec("INSERT INTO users (userName, passWord, sec) VALUES ('".($userEntered)."', '".$passEntered."', 'u')");
                            $_SESSION['logged'] = 'LoggedIn';
                            $_SESSION['username'] = $userEntered;
                            header("Location: http://localhost/about.php");
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>