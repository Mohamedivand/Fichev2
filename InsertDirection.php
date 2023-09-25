<?php

require_once('Identification.php');

include('Connexiondb.php');


// Si le formulaire est soumis

    // Insertion de la fiche de demande dans la table Fiche
    $nomDirection = $_POST['nomDirection'];
    $sigleDirection = $_POST['sigleDirection'];

    $requeteD = "INSERT INTO Direction (nomDirection, sigleDirection) VALUES (:nomDirection, :sigleDirection)";
    $stmtD = $pdo->prepare($requeteD);
    $stmtD->execute(array(
        ':nomDirection' => $nomDirection,
        ':sigleDirection' => $sigleDirection,
    ));

    if(isset($requeteD)){
   header('Location: Confirmation.php');

    }

    exit();
    
?>