<!-- CONTROLLER -->
<?php
    $con = mysqli_connect("127.0.0.1","root","","ristorante");
    $query = "SELECT * FROM prodotti";
    $prodotti = mysqli_query($con, $query);
?>



<!-- VIEW -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Visualizza Prodotti</title>
</head>
<body>
    <?php
        require_once("headerAmministratore.php");
    ?>
    <main>
        <h2>Visualizza Prodotti</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>PREZZO</th>
                <th>CATEGORIA</th>
            </tr>
            <?php
                while($prodotto = mysqli_fetch_assoc($prodotti)){
                    echo "<tr>";
                    echo "
                        <td>
                        <form action='modificaProdotto.php' method='POST'>
                        $prodotto[id]
                        <button name='verbo' value='modificaProdotto'>Modifica</button>
                        <input type='hidden' name='idProdotto' value='$prodotto[id]'>
                        </form>
                        </td>
                    ";
                    echo "<td>$prodotto[nome]</td>";
                    echo "<td>$prodotto[prezzo]</td>";
                    echo "<td>$prodotto[categoria]</td>";
                    echo "</tr>";
                }
            ?>
            
        </table>
    </main>
    <?php
        require_once("footer.php");
    ?>
</body>
</html>