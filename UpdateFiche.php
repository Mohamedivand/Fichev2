
<?php

require_once('Identification.php');

include('Connexiondb.php');


    $nombreProduits = $_POST['nombreProduit'];
    $idFiche = $_GET['idFiche'];
    $idDirection = $_SESSION['user']['idDirection'];
    $commentaire = $_POST['commentaire'];
    $idCategorie = $_POST['categorie1'];
    $dga = $_POST['dga'];
    $destination = $_POST['destination'];
    $dateModif = date('d-m-Y H:i:s');
    $requeteFiche = "UPDATE Fiche as f
                        inner join produit as p on p.idFiche = f.idFiche
                        set f.commentaire = :commentaire,
                        f.dateModif = now(),
                        f.dga = :dga,
                        f.destination = :destination,
                        f.v1 = false,
                        f.v2 = false,
                        f.v3 = false,
                        f.dm1 = false,
                        f.dm2 = false,
                        f.dm3 = false,
                        f.r1 = false,
                        f.r2 = false,
                        f.r3 = false,
                        f.etat = 'en attente',
                        f.remarque = null
                        where f.idFiche = :idFiche";
                        
    //$resultatf = $pdo->query($requeteFiche);
    $stmtFiche = $pdo->prepare($requeteFiche);
    $stmtFiche->execute(array(
        ':commentaire' => $commentaire,
        ':dga' => $dga,
        ':destination' => $destination,
        ':idFiche' => $idFiche,
    ));

    // $idFiche = $pdo->lastInsertId(); // Récupération de l'ID de la fiche insérée

    
    //var_dump($idFiche);
// Récupération des valeurs du formulaire dans des tableaux PHP
/*
$delete = "delete from ficheproduit where idFiche = $idFiche";
    $resultat = $pdo->query($delete);
    $resultat->execute();

    $delete = "delete from produit where idFiche = $idFiche";
    $resultat = $pdo->query($delete);
    $resultat->execute();
*/


   //header('Location: VoirFiche.php?idFiche='.$idFiche);
//var_dump($nombreProduits);


// Traitement des données et exécution des requêtes SQL

for ($i = 1; $i <= $nombreProduits; $i++) {
    $idProduit = $_POST['idProduit'.$i];
    $categorie = $_POST['categorie'.$i];
    $nomProduit = $_POST['produit'.$i];
    $quantite = $_POST['quantite'.$i];
    //var_dump($categorie);
    //var_dump($produit) ;
    //var_dump($nombreProduits) ;

    // Effectuer la requête SQL pour mettre à jour les données du produit
    $requeteProduit = "UPDATE Produit SET idCategorie = :idCategorie, nomProduit = :nomProduit, quantite = :quantite WHERE idFiche = :idFiche AND idProduit = :idProduit";
    $stmtProduit = $pdo->prepare($requeteProduit);
    $stmtProduit->execute(array(
        ':idCategorie' => $categorie,
        ':nomProduit' => $nomProduit,
        'quantite' => $quantite,
        ':idFiche' => $idFiche,
        ':idProduit' => $idProduit
        
    ));
    // var_dump($nomProduit) ;
    // var_dump($categorie) ;
    // var_dump($quantite) ;
}

    
    //Redirection vers la page de visualisation de la fiche
    if(isset($_POST['submit'])){
    $requeteDate = "UPDATE fiche set dateModif = now() where idFiche = $idFiche";
    $stmntDate = $pdo->prepare($requeteDate);
    $stmntDate->execute();
    }
  
    $i=$nombreProduits +1;
    var_dump($nombreProduits);
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
            $idProduit = $pdo->lastInsertId(); // Récupération de l'ID de la fiche insérée

            $requeteFicheProduit = "INSERT INTO FicheProduit (idFiche, idProduit) VALUES (:idfiche, :idProduit)";
            $stmtFicheProduit = $pdo->prepare($requeteFicheProduit);
            $stmtFicheProduit->execute(array(
                ':idfiche' => $idFiche,
                ':idProduit' => $idProduit,
            ));

        }

        $i++;

var_dump($i);
        
    }while($i<=10);

    $location = "<a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";
    
    $email = "select email, nomUser, nomRole from user, role where idDirection = $idDirection and user.idRole = role.idRole and nomRole = 'Chef de service'";
    $to = $pdo->query($email);
    $emailChefTab = $to->fetch();
    $emailChef = $emailChefTab['email'];
    $nomUser = $emailChefTab['nomUser'];

    
    // Envoi du mail  
        
        $subject = "Validation de nouvelle fiche requise";
        $message = "Bonjour $nomUser, <br>La fiche de besoin $idFiche a été modifier. Connectez-vous en suivant le lien ci-dessous:<br>
        <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";
    
        // Envoi de l'e-mail
        $headers = "From: Fiche de besoin\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
        if (mail($emailChef, $subject, $message, $headers)) {
            echo "E-mail envoyé avec succès.";
        } else {
            echo "Erreur lors de l'envoi de l'e-mail.";
        }
    
    



    header('Location: VoirFiche.php?idFiche='.$idFiche);
    //header('Location:Fiches.php');

    
    
?>