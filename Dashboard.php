<?php 
    include('Identification.php');
    require_once('Connexiondb.php');

    $idDirection = $_SESSION['user']['idDirection'];
    
/*
    $requeteCount="select count(*) countf from fiche where etat = 'en attente'";
    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrF=$tabCount['countf'];
*/
    $requetef = "SELECT idFiche, DATE_FORMAT(dateFiche, '%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif, '%d-%m-%Y') as dateModif, dga, destination, commentaire, d.idDirection, d.nomDirection, v1, v2, v3, dm1, dm2, dm3, r1, r2, r3, sign1, sign2, sign3, auteurRejet, sigleDirection, etat from Fiche as f, Direction as d where f.idDirection = d.idDirection";

    $resultatf = $pdo->query($requetef);
    $fiche = $resultatf->fetch();
   
/*
    $requeteCountT="select count(*) countf from fiche where etat = 'en attente' and $nomDirection = $directionFiche";
    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrF=$tabCount['countf'];
*/
    
/*
    $requeteCount="select count(*) countf from fiche where etat = 'en attente'";
    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrF=$tabCount['countf'];
*/
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tableau de bord</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/Monstyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        <?php include("Menu.php"); ?>
        <div style = "margin-top: 50px;">
            <img src='../Images/LogoPMU.png' width="380" height="176" style="float: left;"/>
        </div>
        
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-12">
                
                    <div style = "margin-top: 80px;">
                        
                        <h2 style = "text-align: center;"><label>Gestion des fiches de besoins</label></h2>
                        <br><br><br>
<?php 
//var_dump($idDirection);
//var_dump($directionFiche);
if($fiche != null){
    if($_SESSION['user']['nomRole'] == "Chef de service"){
        
            $requeteCountC = "select count(*) countf from fiche as f, direction as d where f.idDirection = d.idDirection and etat = 'en attente' and f.idDirection = $idDirection and v1 = false";
            $resultatCountC=$pdo->query($requeteCountC);
            $tabCount=$resultatCountC->fetch();
            $nbrF=$tabCount['countf'];?>
            <div class = "enAttente";> <label>Vous avez <b> <?php echo $nbrF; ?> fiche(s) </b> en attente <br>
                                                <a href = "FichesEnAttente.php">Cliquez ici</a> pour les consulter</label> </div>
            <?php
        
    }
elseif($_SESSION['user']['nomRole'] == "DGAT" || $_SESSION['user']['nomRole'] == "DGAO"){
    if($_SESSION['user']['nomRole'] == "DGAT"){
        if($fiche['dm2'] != true || $fiche['r2'] != true){
            $v2 = $fiche['v2'];
            $dm2 = $fiche['dm2'];
            $r2 = $fiche['r2'];
            $requeteCountDGA = "select count(*) countf from fiche where etat = 'en attente' and dga = 'technique' and v2 = false and v1 = true";
            $resultatCountDGA=$pdo->query($requeteCountDGA);
            $tabCount=$resultatCountDGA->fetch();
            $nbrF=$tabCount['countf'];?>
            <div class = "enAttente";> <label>Vous avez <b> <?php echo $nbrF; ?> fiche(s) </b> en attente <br>
                                                <a href = "FichesEnAttente.php">Cliquez ici</a> pour les consulter</label> </div>
            <?php
        }
    }else{
        if($fiche['dm2'] != true || $fiche['r2'] != true){
            $v2 = $fiche['v2'];
            $dm2 = $fiche['dm2'];
            $r2 = $fiche['r2'];
            $requeteCountDGA = "select count(*) countf from fiche where etat = 'en attente' and dga = 'chargé des operations' and v2 = false and v1 = true";
            $resultatCountDGA=$pdo->query($requeteCountDGA);
            $tabCount=$resultatCountDGA->fetch();
            $nbrF=$tabCount['countf'];?>
            <div class = "enAttente";> <label>Vous avez <b> <?php echo $nbrF; ?> fiche(s) </b> en attente <br>
                                                <a href = "FichesEnAttente.php">Cliquez ici</a> pour les consulter</label> </div>
            <?php
        }
    }
}elseif($_SESSION['user']['nomRole'] == "DG"){
    if($fiche['dm3'] != true || $fiche['r3'] != true){
        $v3 = $fiche['v3'];
        $dm3 = $fiche['dm3'];
        $r3 = $fiche['r3'];
        $requeteCountDG = "select count(*) countf from fiche where etat = 'en attente' and v3 = false and v1 = true and v2 = true";
        $resultatCountDG=$pdo->query($requeteCountDG);
        $tabCount=$resultatCountDG->fetch();
        $nbrF=$tabCount['countf'];?>
        <div class = "enAttente";> Vous avez <span style = font-weight:bold;> <?php echo $nbrF; ?> fiche(s) </span> en attente <br>
                                               <a href = "FichesEnAttente.php"><i> <strong>Cliquez ici</strong></i></a> pour les consulter </div>
        <?php
    }
}elseif($_SESSION['user']['nomRole'] == "Admin"){
    $requeteCount="select count(*) countf from fiche where etat = 'en attente'";
    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrF=$tabCount['countf'];?>
    <div class = "enAttente";> <label>Vous avez <b> <?php echo $nbrF; ?> fiche(s) </b> en attente <br>
                                                <a href = "FichesEnAttente.php">Cliquez ici</a> pour les consulter</label> </div>
    <?php
}
}


                        
                        
                        //var_dump($_SESSION['user']['nomRole']);
                          //  var_dump('chef de service',$requeteCountC);
                            //var_dump('dga',$requeteCountDGA);
                            //var_dump('dg',$requeteCountDG);
                           // var_dump('admin',$requeteCount);

                        //var_dump($user['name']);
                        //var_dump($_SESSION['user']['acces']);
                        //var_dump($_SESSION['user']['nomDirection']);
                        switch($_SESSION['user']['nomRole']){
                            case "Admin":?>

                        
                                
                        <div class = "btn-container">
                            
                                <a href="NouvelleFiche.php">
                                    
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus"></span> Créer une nouvelle fiche
                                        </button>
                                    
                                </a>

                                <a href="Fiches.php">
                                    
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-folder-open"></span> Voir toutes les fiches
                                        </button>
                                    
                                </a>

                                <a href="AjouterUtilisateur.php">
                                    
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus"></span> Ajouter un nouvel utilisateur
                                        </button>
                                    
                                </a>

                                <a href="Utilisateurs.php">
                                    
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-user"></span> Voir tous les utilisateurs
                                        </button>
                                    
                                </a>

                                <a href="AjouterDirection.php">
                                    
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus"></span> Ajouter une nouvelle direction
                                        </button>
                                    
                                </a>

                                <a href="AjouterCategorie.php">
                                
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus"></span> Ajouter une catégorie
                                        </button>
                                    
                                </a>
                                <?php
                                break;
                                case "Utilisateur":?>
                            
                            
                           <div class = "btn-container" style = "display:flex;">
                                    <a href="NouvelleFiche.php">
                                    
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-plus"></span> Créer une nouvelle fiche
                                        </button>
                                
                                    </a>
                                    <a href="Fiches.php">
                                    
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-folder-open"></span> Voir toutes les fiches
                                        </button>
                                    
                                </a>
                                </div>
                                
                                <?php
                                break;
                                case "Controleur":?>
                                
                                
                                
                            
                            <div class = "btn-container" style = "display:flex;">
                                    <a href="Fiches.php">
                                    
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-folder-open"></span> Voir toutes les fiches
                                        </button>
                                        </div>

                            <?php break;
                            case "Chef de service":?>
                                
                                
                                
                            
                                <div class = "btn-container" style = "display:flex;">
                                        <a href="Fiches.php">
                                        
                                            <button class="btn btn-success">
                                                <span class="glyphicon glyphicon-folder-open"></span> Voir toutes les fiches
                                            </button>
                                            </div>
    
                                <?php break;
                                case "DGAO":?>
                                
                                
                                
                            
                                    <div class = "btn-container" style = "display:flex;">
                                            <a href="Fiches.php">
                                            
                                                <button class="btn btn-success">
                                                    <span class="glyphicon glyphicon-folder-open"></span> Voir toutes les fiches
                                                </button>
                                                </div>
        
                                    <?php break;
                                    case "DGAT":?>
                                
                                
                                
                            
                                        <div class = "btn-container" style = "display:flex;">
                                                <a href="Fiches.php">
                                                
                                                    <button class="btn btn-success">
                                                        <span class="glyphicon glyphicon-folder-open"></span> Voir toutes les fiches
                                                    </button>
                                                    </div>
            
                                        <?php break;
                                        case "DG":?>
                                
                                
                                
                            
                                            <div class = "btn-container" style = "display:flex;">
                                                    <a href="Fiches.php">
                                                    
                                                        <button class="btn btn-success">
                                                            <span class="glyphicon glyphicon-folder-open"></span> Voir toutes les fiches
                                                        </button>
                                                        </div>
                
                                            <?php break;
                            default:
                            echo "Contacter l'administrateur";
                            }
                                ?>
                                
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
