<?php
    require_once('Identification.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/FicheStyle.css">

</head>
<body>
<?php include("Menu.php"); ?>
<img src='../Images/LogoPMU.png' width = 340, heigth = 136/>
<?php
    include('Connexiondb.php');
?>
<div style = "margin-left: 30px;">
<a href="Dashboard.php">
                                    
                                    <button class="btn btn-success">
                                        <span class="glyphicon glyphicon-arrow-left"></span> Acceuil
                                    </button>
                                
                            </a>

</div>
<?php

    // Récupérer l'idFiche depuis l'URL
   // $idFiche = $_GET['idFiche'];
    $idDirection=isset($_GET['direction'])?$_GET['direction']:0;
    $etat=isset($_GET['etat'])?$_GET['etat']:"Abandonnée";

    $userDirection = $_SESSION['user']['idDirection'];
    
    if(isset($_GET['date']) && (!empty($_GET['date']))){
        $date = $_GET['date'];
        //date_format($date, "Y-mm-d");
        if($idDirection==0){
            if($etat == 'all'){
                $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and dateFiche='$date' ORDER BY  idFiche DESC";

                $requeteCount = "SELECT count(idFiche) as countF, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and dateFiche='$date' ORDER BY  idFiche DESC";
            }else{
                $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and etat = '$etat' and dateFiche='$date' ORDER BY idFiche DESC";

                $requeteCount = "SELECT count(idFiche) as countF, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and etat = '$etat' and dateFiche='$date' ORDER BY idFiche DESC";
            }
            
        }else{
            if($etat == 'all'){
                $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $idDirection and dateFiche='$date' ORDER BY  idFiche DESC";

                $requeteCount = "SELECT count(idFiche) as countF, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $idDirection and dateFiche='$date' ORDER BY  idFiche DESC";
            }else{
                $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $idDirection and etat = '$etat' and dateFiche='$date' ORDER BY idFiche DESC";

                $requeteCount = "SELECT count(idFiche) as countF, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $idDirection and etat = '$etat' and dateFiche='$date' ORDER BY idFiche DESC";
            }
        }
              
    }else{
        //var_dump($etat);
        if($idDirection==0){
            if($etat == 'all'){
                $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection ORDER BY  idFiche DESC";

                $requeteCount = "SELECT count(idFiche) as countF, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection ORDER BY  idFiche DESC";
                
            }else{
                $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and etat = '$etat' ORDER BY idFiche DESC";

                $requeteCount = "SELECT count(idFiche) as countF, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and etat = '$etat' ORDER BY idFiche DESC";
                //var_dump($requete);
            }
            
        }else{
            if($etat == 'all'){
                $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $idDirection ORDER BY  idFiche DESC";

                $requeteCount = "SELECT count(idFiche) as countF, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $idDirection ORDER BY  idFiche DESC";
                
            }else{
                $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $idDirection and etat = '$etat' ORDER BY idFiche DESC";

                $requeteCount = "SELECT count(idFiche) as countF, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, etat, sigleDirection
                FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $idDirection and etat = '$etat' ORDER BY idFiche DESC";
                
            }
        }
    }
    //var_dump($requete);
    $requeteUserDirection = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif,'%d-%m-%Y') as dateModif, commentaire, sigleDirection
            FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $userDirection ORDER BY idFiche DESC";
    $requeteCountUD = "SELECT count(*) as countF FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $userDirection";

    $countU = $pdo->query($requeteCountUD);
    $tabCount = $countU->fetch();
    $nbrFicheUD = $tabCount['countF'];

    

    $resultatUserDirection = $pdo->query($requeteUserDirection);

    // Requête pour récupérer les informations de la fiche
    $requeteD = "SELECT * from Direction";
    $resultatD = $pdo->query($requeteD);
/*
    if($idDirection==0){
        $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, commentaire, sigleDirection
        FROM Fiche as f, Direction as d where d.idDirection = f.idDirection";
    }else{
        $requete = "SELECT idFiche, DATE_FORMAT(dateFiche,'%d-%m-%Y') as dateFiche, commentaire, sigleDirection
        FROM Fiche as f, Direction as d where d.idDirection = f.idDirection and d.idDirection = $idDirection";
    }
*/
    $resultat = $pdo->query($requete);
    $count = $pdo->query($requeteCount);
    $tabCount = $count->fetch();
    $nbrFiche = $tabCount['countF'];
?>
<?php
                                if($_SESSION['user']['sigleDirection']==="DPMG" || $_SESSION['user']['nomDirection']==="Direction générale" || $_SESSION['user']['nomRole']==="Admin"){
                            ?>
    <div class="allonger parent container">
            <div class="parent panel panel-success margetop">
                <div class= "margetop panel-heading">Filtrer par Date, Direction et/ou Status...</div>
                <div class= "panel-body">
                    <form action="Fiches.php" method="GET">
                        
                            <label for="date">Date :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="date" id="date" name="date" value = "<?php if(isset ($_GET['date'])){ echo $_GET['date'];} ?>" onchange="this.form.submit();">
                        <br><br>
                        <div>
                        
                            <label class = "taillePlus">Direction: </label>
                            <select class = "taillePlus" name="direction" id="direction" onchange="this.form.submit()">
                                <option value=0>Toutes les directions</option>
                                <?php 
                                    while($direction = $resultatD->fetch()){ ?>
                                        <option value="<?php echo $direction['idDirection'] ?>"
                                        <?php if($direction['idDirection'] === $idDirection) echo "selected"?>>
                                            <?php echo $direction['nomDirection'] ?>
                                        </option>
                                            <?php } ?>
                            </select> <br><br>

                            <label class = "taillePlus">Status : </label> &nbsp;&nbsp;&nbsp;&nbsp;
                            <select class = "taillePlus" name="etat" id="etat" onchange="this.form.submit()">
                                <option value="all">Toutes les fiches</option>
                                
                                        <option value = "en attente" <?php if($etat == "en attente") echo "selected"; ?>>
                                            En attente
                                        </option>
                                        <option value = "modification" <?php if($etat == "modification") echo "selected"; ?>>
                                            Retournée en modification
                                        </option>
                                        <option value = "validée" <?php if($etat == "validée") echo "selected"; ?>>
                                            Validée
                                        </option>
                                        <option value = "rejetée" <?php if($etat == "rejetée") echo "selected" ;?>>
                                            Rejetée
                                        </option>
                                        <option value = "Abandonnée" <?php if($etat == "Abandonnée") echo "selected" ;?>>
                                            Abandonnée
                                        </option>
                                          
                            </select>

                        </div>

                        <button type="submit" class="submit btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Rechercher
                        </button>
                    </form>
                </div>
            </div>
                
        </div>
        <br>
        <h2 style = "text-align: center;"><label><u>Liste des fiches de besoins - <?php echo $nbrFiche; ?> Fiche(s)</u></label></h2>
        <br><br>
<?php 
    $tableCounter = 0;
    while($fiche = $resultat->fetch()) {
        if($tableCounter % 4 == 0) {
        ?>
        <div class="flex-container">
            <?php 
        }
        ?>
        <div class="col-md-3">
            <table class = "margeleft">
                <div border = "1">

                    <h1 class = "margeleft">Fiche n° <?php echo $fiche['idFiche']; ?></h1>
                    <thead>
                    <tr>
                    <?php if(isset($fiche['dateModif'])){ ?>
                        <td>Modifié le :</td>
                        <td><?php
                            echo $fiche['dateModif']; ?></td>
                            <?php
                        }else{ ?>
                            <td>Créer le :</td>
                            <td><?php
                            echo $fiche['dateFiche'];} ?></td>
                    </tr>
                                <tr>
                                    <td>Etat : </td>
                                    <td <?php if($fiche['etat'] == "validée"){?> style = "color: #3CB371; font-weight: bold;" <?php }
                                        elseif($fiche['etat'] == "modification"){ ?> style = "color: #DBA520; font-weight: bold;" <?php }
                                        elseif($fiche['etat'] == "rejetée"){ ?> style = "color: red; font-weight: bold;" <?php }
                                        else{ ?> style = "font-weight: bold;" <?php } ?>> 
                                        <?php echo $fiche['etat'];?></td>
                                </tr>                    
                    <tr>
                        <td>Commentaire :</td>
                        <td><?php echo $fiche['commentaire']; ?></td>
                    </tr>
                    <tr>
                        <td>Direction :</td>
                        <td><?php echo $fiche['sigleDirection']; ?></td>
                    </tr>
                
                </div>
                    <tr>
                    
                        <td >
                            <a  href = "voirFiche.php?idFiche=<?php echo $fiche['idFiche'] ?>">
                                Voir les details
                                <span class="glyphicon glyphicon-info-sign"></span>
                                
                            </a>
                        </td>
                    </tr>
                
                       

                </thead> 

                <tbody>
                    
                </tbody>   
                
            </table>
            <br><br>
    </div>
    <?php
                    
                    $tableCounter++;
                

                // Si le compteur est différent de 0 (il y a eu au moins une table), on ferme la dernière colonne
                if($tableCounter % 4 != 0) {
                    ?>
        </div>
        </div>
        



                                <?php    
                                }
                            ?>
                    <?php
                }
            ?>

        <?php
    }else{ 
    ?>
<h2 style = "text-align: center;"><label><u>Liste des fiches de besoins - <?php echo $nbrFicheUD; ?> Fiche(s)</u></u></label></h2>
<br><br>
<?php 
    $tableCounter = 0;
    while($ficheUserDirection = $resultatUserDirection->fetch()) {
        if($tableCounter % 4 == 0) {
        ?>
        <div class="flex-container">
            <?php 
        }
        ?>
        <div class="col-md-3">
            <table class = "margeleft">
                <div border = "1">

                    <h1 class = "margeleft">Fiche n° <?php echo $ficheUserDirection['idFiche']; ?></h1>
                    <thead>
                    <tr>
                        <td>Date :</td>
                        <td><?php echo $ficheUserDirection['dateFiche']; ?></td>
                    </tr>
                    <tr>
                        <td>Commentaire :</td>
                        <td><?php echo $ficheUserDirection['commentaire']; ?></td>
                    </tr>
                    <tr>
                        <td>Direction :</td>
                        <td><?php echo $ficheUserDirection['sigleDirection']; ?></td>
                    </tr>
                
                </div>
                    <tr>
                    
                        <td >
                            <a  href = "voirFiche.php?idFiche=<?php echo $ficheUserDirection['idFiche'] ?>">
                                Voir les details
                                <span class="glyphicon glyphicon-info-sign"></span>
                                
                            </a>
                        </td>
                    </tr>
                
                       

                </thead> 

                <tbody>
                    
                </tbody>   
                
            </table>
            <br><br>
    </div>
    <?php
                    
                    $tableCounter++;
                

                // Si le compteur est différent de 0 (il y a eu au moins une table), on ferme la dernière colonne
                if($tableCounter % 4 != 0) {
                    ?>
        </div>
        </div>
        



                                <?php    
                                }
                            ?>
                    <?php
                }

    } ?>

    </body>