<?php
require_once('Identification.php');
include('Connexiondb.php');

$idProduit = $_GET['idProduit'];
$idFiche = $_GET['idFiche'];

$requete = "update produit set satisfaction = true where idProduit = $idProduit and idFiche = $idFiche";
$resultat = $pdo->query($requete);
$resultat->execute();

header('location:VoirFiche.php?idFiche='.$idFiche);

?>