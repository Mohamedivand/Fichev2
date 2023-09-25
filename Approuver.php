<?php
include("Connexiondb.php");
include('Identification.php');
$idFiche = $_GET['idFiche'];

if(isset($_GET['texte'])){
  $texte = $_GET['texte'];
}
if(isset($_GET['motif'])){
  $motif = $_GET['motif'];
}

$reqFiche = "select * from fiche where idFiche = $idFiche";
$resFiche = $pdo->query($reqFiche);
$fiche = $resFiche->fetch();
$idDirection = $fiche['idDirection'];

$emailu = "select email, nomUser from user, role where user.idDirection = $idDirection and user.idRole = role.idRole and nomRole = 'Utilisateur'";
$resu = $pdo->query($emailu);
$emailuserTab = $resu->fetch();
$emailuser = $emailuserTab['email'];
$nomU = $emailuserTab['nomUser'];

$rdga = "select dga from fiche where idFiche = $idFiche";
$res = $pdo->query($rdga);
$dga = $res->fetch();
$dga = $dga['dga'];


$emailt = "select email, nomUser, nomRole from user, role where user.idRole = role.idRole and nomRole = 'dgat'";
$tot = $pdo->query($emailt);
$emaildgatTab = $tot->fetch();
$emaildgat = $emaildgatTab['email'];
$nomDgat = $emaildgatTab['nomUser'];

$emailo = "select email, nomUser, nomRole from user, role where user.idRole = role.idRole and nomRole = 'dgao'";
$too = $pdo->query($emailo);
$emaildgaoTab = $too->fetch();
$emaildgao = $emaildgaoTab['email'];
$nomDgao = $emaildgaoTab['nomUser'];

$emaild = "select email, nomUser, nomRole from user, role where user.idRole = role.idRole and nomRole = 'dg'";
$tod = $pdo->query($emaild);
$emaildgTab = $tod->fetch();
$emaildg = $emaildgTab['email'];
$nomDG = $emaildgTab['nomUser'];


$valider = false;
$modification = false;
$refus = false;

if(isset($_GET['v1'])){
$v1 = $_GET['v1'];
}

if(isset($_GET['v2'])){
$v2 = $_GET['v2'];
}

if(isset($_GET['v3'])){
$v3 = $_GET['v3'];
}

if(isset($_GET['dm1'])){
$dm1 = $_GET['dm1'];
}

if(isset($_GET['dm2'])){
$dm2 = $_GET['dm2'];
}

if(isset($_GET['dm3'])){
$dm3 = $_GET['dm3'];
}

if(isset($_GET['r1'])){
$r1 = $_GET['r1'];
}

if(isset($_GET['r2'])){
$r2 = $_GET['r2'];
}

if(isset($_GET['r3'])){
$r3 = $_GET['r3'];
}
if(isset($_GET['motif'])){
  $motif = $_GET['motif'];
}


     
  $subject = "Validation de nouvelle fiche requise";
  $messageU = "Bonjour $nomU,<br>Une nouvelle fiche de besoin attend votre approbation. Connectez-vous en suivant le lien ci-dessous:<br>
  <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";

  $messageDg = "Bonjour $nomDG,<br>Une nouvelle fiche de besoin attend votre approbation. Connectez-vous en suivant le lien ci-dessous:<br>
  <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";

  
  
  // Envoi de l'e-mail
  $headers = "From: Fiche de besoin\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  

  // Redirection vers la page de visualisation de la fiche
  //header("Location: VoirFiche.php?idFiche=$idFiche");



$nom = strtoupper($_SESSION['user']['nomUser'])." ".$_SESSION['user']['prenomUser'];
if(isset($v1)){
  $update = "UPDATE fiche SET v1 = true WHERE idFiche = $idFiche";
  $updateV = "UPDATE fiche SET sign1 = '$nom' WHERE idFiche = $idFiche";
  $stmnt = $pdo->prepare($update);
  $stmnt->execute();
  $stmntV = $pdo->prepare($updateV);
  $stmntV->execute();

  $valider = true;
//var_dump($dga);
  switch ($dga){
    case "technique":
      $messageDgat = "Bonjour $nomDgat,<br>Une nouvelle fiche de besoin attend votre approbation. Connectez-vous en suivant le lien ci-dessous:<br>
        <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";

      if (mail($emaildgat, $subject, $messageDgat, $headers)) {
        echo "E-mail envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi de l'e-mail.";
    }
     break;
    case "chargé des operations":
      $messageDgao = "Bonjour $nomDgao,<br>Une nouvelle fiche de besoin attend votre approbation. Connectez-vous en suivant le lien ci-dessous:<br>
        <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";
      if (mail($emaildgao, $subject, $messageDgao, $headers)) {
        echo "E-mail envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi de l'e-mail.";
    }
      break;
  }
  
}

if(isset($v2)){
  $update = "UPDATE fiche SET v2 = true WHERE idFiche = $idFiche";
  $updateV = "UPDATE fiche SET sign2 = '$nom' WHERE idFiche = $idFiche";
  $stmnt = $pdo->prepare($update);
  $stmnt->execute();
  $stmntV = $pdo->prepare($updateV);
  $stmntV->execute();

  $valider = true;

  if (mail($emaildg, $subject, $messageDg, $headers)) {
    echo "E-mail envoyé avec succès.";
} else {
    echo "Erreur lors de l'envoi de l'e-mail.";
}
}

if(isset($v3)){
  $update = "UPDATE fiche SET v3 = true, etat = 'validée', dateValidation = now() WHERE idFiche = $idFiche";
  $updateV = "UPDATE fiche SET sign3 = '$nom' WHERE idFiche = $idFiche";
  $stmnt = $pdo->prepare($update);
  $stmnt->execute();
  $stmntV = $pdo->prepare($updateV);
  $stmntV->execute();

  $valider = true;

  $messageValider = "Bonjour $nomU,<br>Votre fiche de besoin numéro $idFiche a été approuvé. Connectez-vous en suivant le lien ci-dessous:<br>
  <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";

  if (mail($emailuser, $subject, $messageValider, $headers)) {
    echo "E-mail envoyé avec succès.";
} else {
    echo "Erreur lors de l'envoi de l'e-mail.";
}
}

if(isset($dm1) || isset($dm2) || isset($dm3)){
  $update = "UPDATE fiche SET etat = 'modification', dm1 = true, dm2 = true, dm3 = true, demandeModif = '$nom', remarque = '$texte' WHERE idFiche = $idFiche";
  $stmnt = $pdo->prepare($update);
  $stmnt->execute();

  $modification = true;

  $messageModification = "Bonjour $nomU,<br>Votre fiche de besoin numéro $idFiche a été retourné pour modification. Connectez-vous en suivant le lien ci-dessous:<br>
  <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";

  if (mail($emailuser, $subject, $messageModification, $headers)) {
    echo "E-mail envoyé avec succès.";
} else {
    echo "Erreur lors de l'envoi de l'e-mail.";
}

}

if(isset($r1) || isset($r2) || isset($r3)){
  $update = "UPDATE fiche SET etat = 'rejetée', r1 = true, r2 = true, r3 = true, auteurRejet = '$nom', remarque = '$texte' WHERE idFiche = $idFiche";
  $stmnt = $pdo->prepare($update);
  $stmnt->execute();

  $messageRefuser = "Bonjour $nomU,<br>Votre fiche de besoin numéro $idFiche a été refusé. Connectez-vous en suivant le lien ci-dessous:<br>
  <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";
  
  if (mail($emailuser, $subject, $messageRefuser, $headers)) {
    echo "E-mail envoyé avec succès.";
  } else {
    echo "Erreur lors de l'envoi de l'e-mail.";
  }
  
  $refus = true;
}

if(isset($motif) && isset($_GET['canceled'])){
  if(strpos($motif, "'") !== false){
    $motif = str_replace("'", "''", $motif);
  }
  $update = "UPDATE fiche SET signAbandon = '$nom', etat = 'Abandonnée', dateAbandon = now(), motifAbandon = '$motif' WHERE idFiche = $idFiche";
  $stmnt = $pdo->prepare($update);
  var_dump($update);
  $stmnt->execute();
 

  $Abandon = true;

  $messageAbandon = "Bonjour $nomU,<br>Votre fiche de besoin numéro $idFiche a été Abandonnée. Connectez-vous en suivant le lien ci-dessous:<br>
  <a href='fichev2/Pages/VoirFiche.php?idFiche=$idFiche'>Cliquez ici pour consulter</a>";

  if (mail($emailuser, $subject, $messageValider, $headers)) {
    echo "E-mail envoyé avec succès.";
} else {
    echo "Erreur lors de l'envoi de l'e-mail.";
}
}


  //var_dump($update);
  
  header('location:voirFiche.php?idFiche='.$idFiche);
  ?>
