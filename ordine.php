<!-- CONTROLLER -->
<?php
    if(!isset($_POST['numero'])){
        header('Location: errore.php');
        exit;
    }

    $con = mysqli_connect('127.0.0.1', 'root', '', 'ristorante');
    $query = "SELECT * FROM ordini WHERE numeroTavolo = $_POST[numero]";
    $ordini = mysqli_query($con, $query);

    if(mysqli_num_rows($ordini) == 0){
        $query = "INSERT INTO ordini (numeroTavolo, dataOra, numeroCoperti) VALUES ($_POST[numero] , NOW(), 0)";
        mysqli_query($con, $query);

    }
    echo "Hai selezionato il tavolo numero: " . $_POST['numero'];
    die();

?>


<!-- VIEW -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordine</title>
</head>
<body>
    
</body>
</html>