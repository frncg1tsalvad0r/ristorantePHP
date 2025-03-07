<?php
    
    if(isset($_SESSION) && $_SESSION['tipo'] == 'admin') {

    } else {
        echo "<h1>Non accreditato</h1>";
        die();
    }
/*
    if( isset($_COOKIE) && 
        isset($_COOKIE['username']) && 
        isset($_COOKIE['passwd']) && 
        isset($_COOKIE['tipo']) && 
        $_COOKIE['tipo'] == 'admin') {
        
    } else {
        echo "<h1>Non accreditato</h1>";
        die();
    }
*/
echo "<header>
        <h1>RISTORANTE (Salve $_SESSION[username])</h1>
        <nav>
            <ul>
                <li><a href='index.php'>Home</a></li>
                <li><a href='inserisciProdotto.php'>Inserisci Prodotto</a></li>
                <li><a href='visualizzaProdotti.php'>Visualizza Prodotti</a></li>
                <li><a href='logout.php'>Esci</a></li>
            </ul>
        </nav>
    </header>";
?>