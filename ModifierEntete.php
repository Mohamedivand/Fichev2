<?php
    include('Connexiondb.php');

    $requeteDirection = $pdo->query('SELECT * FROM Direction');
    $resultatDirection = $requeteDirection->fetch();

    $sigle=isset($_GET['sigle'])?$_GET['sigle']:"DI";
    $idFiche = $_GET['idFiche'];

    
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
            Fiche de besoin N°<?php echo $idFiche ?> 
        </h1>
    </BODY>
</HTML>