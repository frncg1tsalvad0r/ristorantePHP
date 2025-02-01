<!-- CONTROLLER -->
<?php
    if(isset($_POST['numero']) || isset($_POST['aumentaNumeroProdotti']) || isset($_POST['diminuisciNumeroProdotti']) || isset($_POST['rimuoviProdotto'])) {
        
    } else {
        header('Location: errore.php');
        die();
    }


    $con = mysqli_connect('127.0.0.1', 'root', '', 'ristorante');
    
    
    if(isset($_POST['numero'])) {
        // Selezione dell'ordine
        $query = "SELECT * FROM ordini WHERE numeroTavolo = $_POST[numero]";
        $ordini = mysqli_query($con, $query);
    
        if(mysqli_num_rows($ordini) == 0){
            $query = "INSERT INTO ordini (numeroTavolo, dataOra, numeroCoperti) VALUES ($_POST[numero] , NOW(), 0)";
            mysqli_query($con, $query);
    
        }
    
        $ordine = mysqli_fetch_assoc($ordini);
    
        $prodotti = mysqli_query($con, "SELECT * FROM prodotti");

        $righeOrdine = mysqli_query($con, "SELECT * FROM righeOrdine INNER JOIN prodotti ON righeOrdine.idProdotto = prodotti.id WHERE idOrdine = $ordine[id]");

        

    }    
    elseif (isset($_POST['aggiungiProdotto'])) {
        $query = "INSERT INTO righeOrdine (idOrdine, idProdotto, quantita, modifiche) VALUES ($_POST[idOrdine], $_POST[idProdotto], $_POST[quantita], $_POST[modifiche])";
        mysqli_query($con, $query);
        
    }
    elseif (isset($_POST['aumentaNumeroProdotti'])) {
       
    }
    elseif (isset($_POST['diminuisciNumeroProdotti'])) {
       
    }
    elseif (isset($_POST['rimuoviProdotto'])) {
        
    }

    
    

?>


<!-- VIEW -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ordine</title>
</head>

<body>
    <header>
        <h1>Ristorante</h1>
        <nav>
            <ul>
                <li><a href="tavoli.php">Tavoli</a></li>
                <li><a href="signout.php">Esci</a></li>
            </ul>
        </nav>  
    </header>

    <?php echo "<h2>Ordine tavolo $ordine[numeroTavolo]</h2>"; ?>
    <form method="POST" action="aggiungiPiatto.php">
        ID: <input type="text" readonly name="id" value="<?php echo $ordine['id']; ?>"><br><br>
        DATA ORA: <input type="datetime-local" readonly name="dataOra" value="<?php echo $ordine['dataOra']; ?>"><br><br>
        NUMERO COPERTI: <select name = "numeroCoperti">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
    </form>
    <table>
        <tr>
            <th>🍽️</th>
            <th>Nome Prodotto</th>
            <th>Quantità</th>
            <th>Modifiche</th>
        </tr>
        <tr>
            <form method="POST" action="ordine.php">
                <th><input type="button" name="aggiungiProdotto" value="➕"></th>
                <th>
                    <select>
                        <?php
                            $prodotto = mysqli_fetch_assoc($prodotti);
                            while($prodotto != null){ 
                                echo "<option value='$prodotto[id]'>$prodotto[nome]</option>";
                                $prodotto = mysqli_fetch_assoc($prodotti);
                            }
                        ?>
                    </select>

                </th>
                <th><input type="number" min="1" name="quantita" value="1" ></th>
                <th><input type="text" name="modifiche" value="" placeholder="Modifiche"></th>
            </form>
        </tr>
        <?php
            $rigaOrdine = mysqli_fetch_assoc($righeOrdine);
            while($rigaOrdine != null){ 
                echo "<tr>";
                    echo "<td></td>";
                    echo "<td>".$rigaOrdine['nome']."</td>";

                    echo "<td>".
                            "<form method='post' action='ordine.php'>" .
                                "<input type='hidden' name='idOrdine' value='$ordine[id]'>" .
                                "<button type='submit' name='aumentaNumeroProdotti' value='$rigaOrdine[idProdotto]'>➕</button>".
                                "<button type='submit' name='diminuisciNumeroProdotti' value='$rigaOrdine[idProdotto]'>➖</button>".
                                "<button type='submit' name='rimuoviProdotto' value='$rigaOrdine[idProdotto]'>🗑️</button>".
                                "$rigaOrdine[quantita]".
                            "</form>";
                        "</td>";
                    
                    echo "<td>" . $rigaOrdine['modifiche']. "</td><br>";
                echo "</tr>";
                $rigaOrdine = mysqli_fetch_assoc($righeOrdine);
            }
        ?>
    </table>
    <footer>
        <p>&copy; 2025 Ristorante Newton Pertini</p>
    </footer>
</body>
</html>