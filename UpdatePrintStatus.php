<?php
include('Connexiondb.php');

if(isset($_GET['idFiche'])) {
    $idFiche = $_GET['idFiche'];
    $upPrint = "UPDATE fiche SET firstPrint = false WHERE idFiche = $idFiche";
    $resPrint = $pdo->query($upPrint);

    if($resPrint->execute()) {
        echo "success";
    } else {
        echo "failed";
    }
} else {
    echo "failed";
}
?>
