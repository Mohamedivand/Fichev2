<?php

require_once('Identification.php');

include('Connexiondb.php');

    $idDirection = $_POST['direction'];
    $idRole = $_POST['role'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $login = $_POST['login'];
    $matricule = $_POST['matricule'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $requeteU = "INSERT INTO User (matricule, nomUser, prenomUser, loginUser, passwordUser, idDirection,idRole, firstConnexion, email) VALUES (:matricule, :nomUser, :prenomUser, :loginUser, :passwordUser, :idDirection, :idRole, true, :email)";
    $stmtU = $pdo->prepare($requeteU);
    $stmtU->execute(array(
        ':matricule' => $matricule,
        ':nomUser' => $nom,
        ':prenomUser' => $prenom,
        ':loginUser' => $login,
        ':passwordUser' => $password,
        ':idDirection' => $idDirection,
        ':idRole' => $idRole,
        ':email' => $email,
    ));

    
    header('Location: Confirmation.php');

    

    exit();
    
?>