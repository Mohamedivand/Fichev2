<?php

require_once('Identification.php');

include('Connexiondb.php');



    $idDirection = $_SESSION['user']['idDirection'];
    $commentaire = $_POST['commentaire'];
    $idCategorie = $_POST['categorie1'];
    $dga = $_POST['dga'];
    $destination = $_POST['destination'];
    $dateFiche = date('d-m-Y H:i:s');
    $etat = "en attente";
    $v1 = false;
    $v2 = false;
    $v3 = false;
    $dm1 = false;
    $dm2 = false;
    $dm3 = false;
    $r1 = false;
    $r2 = false;
    $r3 = false;
    $requeteFiche = "INSERT INTO Fiche (idDirection, dga, destination, commentaire, dateFiche, etat, v1, v2, v3, dm1, dm2, dm3, r1, r2, r3) 
                        VALUES (:idDirection, :dga, :destination, :commentaire, now(), :etat, :v1, :v2, :v3, :dm1, :dm2, :dm3, :r1, :r2, :r3)";
    $stmtFiche = $pdo->prepare($requeteFiche);
    $stmtFiche->execute(array(
        ':idDirection' => $idDirection,
        ':dga' => $dga,
        ':destination' => $destination,
        ':commentaire' => $commentaire,
        ':etat' => $etat,
        ':v1' => $v1,
        ':v2' => $v2,
        ':v3' => $v3,
        ':dm1' => $dm1,
        ':dm2' => $dm2,
        ':dm3' => $dm3,
        ':r1' => $r1,
        ':r2' => $r2,
        ':r3' => $r3,

    ));
    $idFiche = $pdo->lastInsertId(); 

    /*



    $etatFiche = "UPDATE fiche set etat = en attente where idFiche = $idFiche";
    $stmntetatFiche = $pdo->prepare($etatFiche);
    $stmntetatFiche->execute();

    */

    
    $i=1;
    do{
        if(isset($_POST['produit'.$i])){
            $produit = $_POST['produit'.$i];
            $quantite = $_POST['quantite'.$i];
            $idCategorie = $_POST['categorie'.$i];
            $requeteProduit = "INSERT INTO Produit (idCategorie, nomProduit, quantite, idFiche) VALUES (:idCategorie, :nomProduit, :quantite, :idFiche)";
            $stmtProduit = $pdo->prepare($requeteProduit);
            $stmtProduit->execute(array(
                ':idCategorie' => $idCategorie,
                ':nomProduit' => $produit,
                ':quantite' => $quantite,
                ':idFiche' => $idFiche
            ));
            $idProduit = $pdo->lastInsertId(); 

            $requeteFicheProduit = "INSERT INTO FicheProduit (idFiche, idProduit) VALUES (:idfiche, :idProduit)";
            $stmtFicheProduit = $pdo->prepare($requeteFicheProduit);
            $stmtFicheProduit->execute(array(
                ':idfiche' => $idFiche,
                ':idProduit' => $idProduit,
            ));
        }
        
        $i++;
        
    }while($i<=10);

    
    

    
    $location = "<a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";
    
    $email = "select email, nomUser, nomRole from user, role where idDirection = $idDirection and user.idRole = role.idRole and nomRole = 'Chef de service'";
    $to = $pdo->query($email);
    $emailChefTab = $to->fetch();
    $emailChef = $emailChefTab['email'];
    $nom = $emailChefTab['nomUser'];

    

    if (isset($idFiche)) {
        
        $subject = "Validation de nouvelle fiche requise";
        $message = "Bonjour $nom,<br>Une nouvelle fiche de besoin attend votre approbation. Connectez-vous en suivant le lien ci-dessous:<br>
        <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";
    
        // Envoi de l'e-mail
        $headers = "From: Fiche de besoin\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
        if (mail($emailChef, $subject, $message, $headers)) {
            echo "E-mail envoyé avec succès.";
        } else {
            echo "Erreur lors de l'envoi de l'e-mail.";
        }
    
       
        header("Location: VoirFiche.php?idFiche=$idFiche");
    } else {
        echo "Erreur : $idFiche n'est pas défini ou a une valeur invalide.";
    }
    ?>
    
