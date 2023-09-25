<?php

require_once('Identification.php');

include('Connexiondb.php');

 $idUser = $_GET['idUser'];
    $idDirection = $_POST['direction'];
    $idRole = $_POST['role'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $login = $_POST['login'];
    $matricule = $_POST['matricule'];
    $email = $_POST['email'];

    $requeteU = "Update User set matricule=:matricule, nomUser=:nomUser, prenomUser=:prenomUser, loginUser=:loginUser, idDirection=:idDirection,idRole=:idRole, email=:email where idUser = $idUser";
    $stmtU = $pdo->prepare($requeteU);
    $stmtU->execute(array(
        ':matricule' => $matricule,
        ':nomUser' => $nom,
        ':prenomUser' => $prenom,
        ':loginUser' => $login,
        ':idDirection' => $idDirection,
        ':idRole' => $idRole,
        ':email' => $email,
    ));

    
    header('Location: Confirmation.php');

    

    exit();
    
?>