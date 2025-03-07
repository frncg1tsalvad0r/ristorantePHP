<!-- CONTROLLER -->
<?php
    session_start();
    
    if(isset($_POST["verbo"])){
        $verbo = $_POST["verbo"];
        if($verbo == "modificaProdotto"){
            $idProdotto = $_POST['idProdotto'];
            $con = mysqli_connect("127.0.0.1","root","","ristorante");
            $query = "SELECT * FROM prodotti WHERE id = $idProdotto";
            $prodotti = mysqli_query($con, $query);
            $prodotto = mysqli_fetch_assoc($prodotti);
            

        } else if($verbo == "confermaModificaProdotto"){
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $prezzo = $_POST['prezzo'];
            $categoria = $_POST['categoria'];

            $con = mysqli_connect("127.0.0.1","root","","ristorante");
            $query = "UPDATE prodotti SET
                nome='$nome',
                prezzo=$prezzo,
                categoria='$categoria' WHERE id = $id";
                
            mysqli_query($con, $query);
            header("Location: visualizzaProdotti.php");

        } else {
            print_r($_POST); die();
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
    <title>Modifica Prodotto</title>
</head>
<body>
    <?php
        require_once("headerAmministratore.php");
    ?>
    <main>
        <h2>Modifica Prodotto</h2>
        <form action="modificaProdotto.php" method="POST">
            <label for="id">ID</label>
            <input readonly type="text" size="5" id="id" name="id" value="<?php echo $prodotto['id']; ?>"><br><br>
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?php echo $prodotto['nome']; ?>" required><br><br>
            <label for="prezzo">Prezzo</label>
            <input type="text" pattern="[0-9]{1,}\.[0-9]{2}" placeholder="0.00" id="prezzo" name="prezzo" required value="<?php echo $prodotto['prezzo']; ?>"><br><br>
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria">
                <option value="antipasto" <?php if($prodotto['categoria'] == 'antipasto') echo 'selected'; ?>">Antipasto</option>
                <option value="primo" <?php if($prodotto['categoria'] == 'primo') echo 'selected'; ?>>Primo</option>
                <option value="secondo" <?php if($prodotto['categoria'] == 'secondo') echo 'selected'; ?>>Secondo</option>
                <option value="contorno" <?php if($prodotto['categoria'] == 'contorno') echo 'selected'; ?>>Contorno</option>
                <option value="dolce" <?php if($prodotto['categoria'] == 'dolce') echo 'selected'; ?>>Dolce</option>
            </select><br><br>
 
            <button name="verbo" value="confermaModificaProdotto">Modifica Prodotto</button>
            <br><br>
        </form>
    </main>
    <?php
        require_once("footer.php");
    ?>
</body>
</html>