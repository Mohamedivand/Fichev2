<?php

require_once('Identification.php');

include('Connexiondb.php');


// Si le formulaire est soumis

    // Insertion de la fiche de demande dans la table Fiche
    $nomCategorie = $_POST['nomCategorie'];
    $requeteC = "INSERT INTO Categorie (nomCategorie) VALUES (:nomCategorie)";
    $stmtC = $pdo->prepare($requeteC);
    $stmtC->execute(array(
        ':nomCategorie' => $nomCategorie,
    ));

    
   header('Location: Confirmation.php');

    

    exit();
    
?>