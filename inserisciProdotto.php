<!-- CONTROLLER -->
 <?php
    if(isset($_POST["verbo"])){
        $verbo = $_POST["verbo"];
        if($verbo == "inserisciProdotto.php"){
            $con = mysqli_connect("127.0.0.1","root","","ristorante");
            $query = "INSERT INTO prodotti (nome, prezzo, categoria) VALUES ('".$_POST["nome"]."',".$_POST["prezzo"].",'".$_POST["categoria"]."')";
            mysqli_query($con, $query);
            header("Location: visualizzaProdotti.php");
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
    <title>Inserisci Prodotto</title>
</head>
<body>
    <?php
        require_once("headerAmministratore.php");
    ?>
    <main>
        <h2>Inserisci Prodotto</h2>
        <form action="inserisciProdotto.php" method="POST">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required><br><br>
            <label for="prezzo">Prezzo</label>
            <input type="text" pattern="[0-9]{1,}\.[0-9]{2}" placeholder="0.00" id="prezzo" name="prezzo" required><br><br>
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria">
                <option value="antipasto">Antipasto</option>
                <option value="primo">Primo</option>
                <option value="secondo">Secondo</option>
                <option value="contorno">Contorno</option>
                <option value="dolce">Dolce</option>
            </select><br><br>
 
            <button name="verbo" value="inserisciProdotto.php">Inserisci Prodotto</button>
            <br><br>
        </form>
    </main>
    <?php
        require_once("footer.php");
    ?>
</body>
</html>