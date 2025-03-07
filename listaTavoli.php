<!-- CONTROLLER -->
<?php
    session_start();
    $con = mysqli_connect('127.0.0.1', 'root', '', 'ristorante');
    
    $query = "SELECT * FROM tavoli";

    $tavoli = mysqli_query($con, $query);
?>




<!-- VIEW -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tavoli</title>
</head>
<body>
    <?php
    require_once('headerUtente.php');
    ?>

    <main>
         <!-- html che visualizza i tavoli della sala -->
        <table>
            <tr>
                <th>Numero Tavolo</th>
                <th>Nome</th>
                <th>Numero Posti</th>
            </tr>
            <?php
                $tavolo = mysqli_fetch_assoc($tavoli);
                while($tavolo != null){ 
                    echo "<tr>";
                    echo "<td>
                    <form method='POST' action='visualizzaOrdine.php'>
                        <input type='hidden' name='numeroTavolo' value='$tavolo[numero]'>
                        <button type='submit' name='verbo' value='visualizzaOrdine'>
                            $tavolo[numero]
                        </button>
                    </form></td>";
                    echo "<td>" . $tavolo['nome'] . "</td>";
                    echo "<td>" . $tavolo['numeroPosti']. "</td>";
                    echo "</tr>";
                    $tavolo = mysqli_fetch_assoc($tavoli);
                }
            ?>


        </table>
    </main>

    <?php
        require_once('footer.php');
    ?>
</body>
</html>