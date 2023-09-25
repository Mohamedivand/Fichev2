<?php
    require_once('Connexiondb.php');
    
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    
    $requete = "SELECT * FROM User WHERE loginUser = :login";
    $stmt = $pdo->prepare($requete);
    $stmt->bindValue(":login", $login);
    $stmt->execute();
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['passwordUser'])) {
        // Les informations d'identification sont correctes, rediriger vers la page NouvelleFiche.php
        header("Location: NouvelleFiche.php");
        exit();
    } else {
        // Les informations d'identification sont incorrectes, afficher un message d'erreur
        $message = "Login ou mot de passe incorrect";
        header("location:Login.php");
    }
?>
