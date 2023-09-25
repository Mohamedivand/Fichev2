<?php

require_once('Identification.php');

include('Connexiondb.php');

 $idUser = $_GET['idUser'];

    $requeteU = "Update User set passwordUser = 'PMU@1234', firstConnexion=true where idUser = $idUser";
    $stmtU = $pdo->prepare($requeteU);
    $stmtU->execute();

    
    header('Location: Confirmation.php');

    

    exit();
    
?>