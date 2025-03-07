<?php
    session_start();
    if(isset($_POST['verbo'])) {
        $verbo = $_POST['verbo'];

        if($verbo == 'inviaCucina') {
            // Per adesso elimino ordine
            $con = mysqli_connect('127.0.0.1', 'root', '', 'ristorante');
            $idOrdine = $_SESSION["idOrdine"];
            $query = "DELETE FROM righeOrdine WHERE idOrdine=$idOrdine";
            mysqli_query($con, $query);
            
            $query = "DELETE FROM ordini WHERE id=$idOrdine";
            mysqli_query($con, $query);
            echo "<h1>No. $idOrdine</h1>";
        }
    }
    else {
        header("Location: errore.php");
    }
?>

<h2>Ordine inviato in cucina</h2>
<a href="listaTavoli.php">Torna alla lista tavoli</a>
