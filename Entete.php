<?php
    include('Connexiondb.php');

    $requeteMaxId = $pdo->query('SELECT max(idFiche) AS dernier_numero FROM Fiche');
    $resultatMaxId = $requeteMaxId->fetch();
    $dernier_numero = $resultatMaxId['dernier_numero'];

    $nouveau_numero = $dernier_numero + 1;

    $requeteDirection = $pdo->query('SELECT * FROM Direction');
    $resultatDirection = $requeteDirection->fetch();

    $sigle=isset($_GET['sigle'])?$_GET['sigle']:"DI";
?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/Monstyle.css">
    </HEAD>

    <BODY>
        <img src='../Images/LogoPMU.png' width = 330, heigth = 126/>

        <h1 class = "Entete" >
            Fiche de besoin N°<?php echo $nouveau_numero ?> 
        </h1>
    </BODY>
</HTML>