<!-- CONTROLLER -->
<?php
    if(isset($_POST['verbo'])) {
        $verbo = $_POST['verbo'];
        if($verbo == 'login') {
            // verifica le credenziali
            $username = $_POST['username'];
            $passwd = $_POST['passwd'];
            $con = mysqli_connect("127.0.0.1", "root", "", "ristorante");
            $query = "SELECT * FROM utenti WHERE username = '$username'  AND passwd='$passwd'";
            $utenti = mysqli_query($con, $query);
            if(mysqli_num_rows($utenti) > 0) {
                $utente = mysqli_fetch_assoc($utenti);
                header("Location: visualizzaProdotti.php");
            }
        }

    }
?>




<!-- VIEW -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="signin-form">
            <div>
            <h2>Login</h2>
            <form action="login.php" method="POST">
                
                <label for="username">NOME UTENTE:</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="password">PASSWORD:</label>
                <input type="password" name="passwd" required><br><br>
                <button type="submit" name="verbo" value="login">Entra</button><br><br> 
 
            </form>
        </div>   
        </div>
    </main>
</body>
</html>