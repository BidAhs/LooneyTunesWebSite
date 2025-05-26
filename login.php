<?php
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    $_SESSION['logged'] = 'LoggedOut';
?>

<html>
    <head>
        <link rel="stylesheet" href="Styles/style.css">
        <link rel="icon" type="image/x-icon" href="images/looney.ico">
        <title>Login</title>
    </head>
    <body>
        <div class="center">
            <div id="login">
                <h1 style="margin:20px;">Login</h1>

                <form action="login.php" method="post">
                    <label for="user">USERNAME</label><br>
                    <input type="text" name="USER" id="user" required><br>

                    <label for="pass">PASSWORD</label><br>
                    <input type="password" name="PASS" id="pass" required><br>

                    <input type="submit" value="LOGIN"><br>
                </form>

                <a href="http://localhost/cs295/final/signup.php" style="border-radius: 50px;">Sign Up Instead</a>
        
                <?php
                    if (isset($_POST["USER"]) && isset($_POST["PASS"])){
                        $userEntered = strtolower($_POST["USER"]);
                        $passEntered = $_POST["PASS"];

                        $pdo = new PDO('sqlite:../../sqlite/comments.db');
                        $sql = "SELECT Password from users WHERE userName ='".$userEntered."'";

                        $result = $pdo->query($sql);
                        $row = $result->fetch(PDO::FETCH_ASSOC);

                        if ($row && $passEntered === $row['passWord']){
                            echo "Login successful";
                            $_SESSION['logged'] = 'LoggedIn';
                            $_SESSION['username'] = $userEntered;
                            header("Location: http://localhost/cs295/final/about.php");
                            
                        } else{
                            echo "Your attempt to hack this account has been reported to the FBI";
                        } 
                    }
                ?>
            </div>
        </div>
    </body>
</html>