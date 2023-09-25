<?php
require_once('Identification.php');

include('Connexiondb.php');


$idProduit = $_GET['idProduit'];
$idFiche = $_GET['idFiche'];

var_dump($idProduit);

if(isset($idProduit)){

    $deleteProduit = "delete from produit where idProduit = $idProduit";
    $resultat = $pdo->query($deleteProduit);
    $resultat->execute();

    $delete = "delete from ficheProduit where idProduit = $idProduit";
    $resultat = $pdo->query($delete);
    $resultat->execute();
    header('Location: Modifier.php?idFiche='.$idFiche);
    }


?>