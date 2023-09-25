<?php

require_once('Identification.php');

include('Connexiondb.php');

$idUser = $_GET['idUser'];

$requete = "delete from user where idUser = $idUser";
$resultat = $pdo->query($requete);
$resultat->execute();

header('location: Utilisateurs.php');