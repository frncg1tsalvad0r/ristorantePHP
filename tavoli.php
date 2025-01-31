<!-- CONTROLLER -->
<?php
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
    <header>
        <h1>Tavoli</h1>
        <nav>
            <ul>
                <li><a href="signout.php">Esci</a></li>
            </ul>
        </nav>
    </header>

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
                    echo "<td><form method='POST' action='ordine.php'><input type='submit' name='numero' value='$tavolo[numero]'></form></td>";
                    echo "<td>" . $tavolo['nome'] . "</td>";
                    echo "<td>" . $tavolo['numeroPosti']. "</td>";
                    echo "</tr>";
                    $tavolo = mysqli_fetch_assoc($tavoli);
                }
            ?>


        </table>
    </main>

    <footer>
        <p>&copy; 2025 Ristorante Newton Pertini</p>   
    </footer>

</body>
</html>