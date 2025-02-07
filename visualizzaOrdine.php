<!-- CONTROLLER -->

<?php
    if(isset($_POST['verbo'])) {
        $verbo = $_POST['verbo'];

        if($verbo == 'visualizzaOrdine') {
            $numeroTavolo = $_POST['numeroTavolo'];
            $con = mysqli_connect('127.0.0.1', 'root', '', 'ristorante');
            $query = "SELECT * FROM ordini WHERE numeroTavolo = $numeroTavolo";

            $ordini = mysqli_query($con, $query);

            if(mysqli_num_rows($ordini) == 0){
                $query = "INSERT INTO ordini (numeroTavolo) VALUES ($numeroTavolo)";
                mysqli_query($con, $query);
            }

            $query = "SELECT * FROM ordini WHERE numeroTavolo = $numeroTavolo";
            $ordini = mysqli_query($con, $query);
            $ordine = mysqli_fetch_assoc($ordini); // Solo una riga risultante

        }

    }
    else {
        header("Location: errore.php");
    }
?>


<!-- VIEW -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Visualizza Ordine</title>
</head>
<body>
    <?php
    require_once('headerUtente.php');
    ?>
    <h1>Tavolo No:<?php echo("$numeroTavolo"); ?> </h1>
    <?php
    require_once('footer.php');
    ?>
</body>
</html>


