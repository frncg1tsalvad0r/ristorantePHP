<!-- CONTROLLER -->

<?php
    session_start();
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

            $query = "SELECT * FROM righeOrdine INNER JOIN prodotti ON righeOrdine.idProdotto = prodotti.id
                WHERE righeOrdine.idOrdine=$ordine[id]";
            $righeOrdineProdotto = mysqli_query($con, $query);

            $query = "SELECT * FROM prodotti";
            $prodotti = mysqli_query($con, $query);

            // Mi ricordo in che tavolo sono e quale ordine sto modificando
            $_SESSION["numeroTavolo"] = $numeroTavolo;
            $_SESSION["idOrdine"] = $ordine['id'];

        } else if($verbo == 'aggiungiRigaOrdine') {
            // Implemento l'azione di inserimento della nuova riga ordine
            $con = mysqli_connect('127.0.0.1', 'root', '', 'ristorante');
            $query = "INSERT INTO righeOrdine (idOrdine, idProdotto, quantita, modifiche) 
                    VALUES ($_SESSION[idOrdine], $_POST[idProdotto], $_POST[quantita], '$_POST[modifiche]')";
            mysqli_query($con, $query); 
            
            $numeroTavolo = $_SESSION["numeroTavolo"];
            $idOrdine = $_SESSION["idOrdine"];


            $query = "SELECT * FROM ordini WHERE numeroTavolo = $numeroTavolo";
            $ordini = mysqli_query($con, $query);
            $ordine = mysqli_fetch_assoc($ordini); // Solo una riga risultante

            $query = "SELECT * FROM righeOrdine INNER JOIN prodotti ON righeOrdine.idProdotto = prodotti.id
                WHERE righeOrdine.idOrdine=$idOrdine";
            $righeOrdineProdotto = mysqli_query($con, $query);

            $query = "SELECT * FROM prodotti";
            $prodotti = mysqli_query($con, $query);

        } else if($verbo == 'rimuoviRigaOrdine') {
            // Implemento l'azione di rimozione della riga ordine
            $con = mysqli_connect('127.0.0.1', 'root', '', 'ristorante');
            $query = "DELETE FROM righeOrdine WHERE id=$_POST[idRigaOrdine]";
            mysqli_query($con, $query); 

            $numeroTavolo = $_SESSION["numeroTavolo"];
            $idOrdine = $_SESSION["idOrdine"];

            $query = "SELECT * FROM ordini WHERE numeroTavolo = $numeroTavolo";
            $ordini = mysqli_query($con, $query);
            $ordine = mysqli_fetch_assoc($ordini); // Solo una riga risultante

            $query = "SELECT * FROM righeOrdine INNER JOIN prodotti ON righeOrdine.idProdotto = prodotti.id
                WHERE righeOrdine.idOrdine=$idOrdine";
            $righeOrdineProdotto = mysqli_query($con, $query);

            $query = "SELECT * FROM prodotti";
            $prodotti = mysqli_query($con, $query);

            //print_r($_POST); die();
        } else if($verbo == 'inviaCucina') {
            // Per adesso elimino ordine
            $con = mysqli_connect('127.0.0.1', 'root', '', 'ristorante');
            $idOrdine = $_SESSION["idOrdine"];
            $query = "DELETE FROM righeOrdine WHERE idOrdine=$idOrdine";
            mysqli_query($con, $query);
            
            $query = "DELETE FROM ordini WHERE id=$idOrdine";
            mysqli_query($con, $query);
            header("Location: listaTavoli.php");
            
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
    <main>
        <br>
        <form action="visualizzaOrdine.php" method="POST>
            NUMERO TAVOLO: <?php echo $ordine['numeroTavolo']; ?> -  ID ORDINE: <?php echo $ordine['id']; ?>
            <button type="submit" name="verbo" value="inviaCucina">Invia Cucina</button><br><br>
            DATA ORA: <input type="datetime-local" name="dataOra" value="<?php echo $ordine['dataOra']; ?>" ><br><br>
            NUMERO COPERTI: <input size="10" type="number" name="numeroCoperti" value="<?php echo $ordine['numeroCoperti']; ?>" ><br><br>
            
        </form>
        <table>
            <tr><th width="50px"></th>
                <th>QUANTITA</th>
                <th>NOME PRODOTTO</th>
                <th>MODIFICHE</th>
            </tr>
                <form action="visualizzaOrdine.php" method="POST">
                    <td><button type="submit" name="verbo" value="aggiungiRigaOrdine">➕</button></td>
                    <td><input type="number" min="0" required name="quantita" value="0"></td>
                    <td>
                        <select name="idProdotto">
                            <?php
                                while($prodotto=mysqli_fetch_assoc($prodotti)) {
                                    echo "<option value='$prodotto[id]'>$prodotto[nome]</option>";
                                }
                            ?>
                        </select>
                    </td>
                
                <td><input name="modifiche" type="text"></td>
                </form>
            </tr>
            <?php
            while($rigaOrdineProdotto = mysqli_fetch_assoc($righeOrdineProdotto)){
                echo "<tr>
                    <form action='visualizzaOrdine.php' method='POST'>
                        <td>
                            <button type='submit' name='verbo' value='rimuoviRigaOrdine'>🗑️</button>
                            <input type='hidden' name='idRigaOrdine' value='$rigaOrdineProdotto[id]'>
                        </td>
                        <td>$rigaOrdineProdotto[quantita]</td>
                        <td>$rigaOrdineProdotto[nome]</td>
                        <td>$rigaOrdineProdotto[modifiche]</td>
                    </form>
                </tr>";
            }
            ?>
            
        </table>
    </main>

    <?php
    require_once('footer.php');
    ?>
</body>
</html>