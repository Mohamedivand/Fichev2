<?php
    include('Identification.php');
    require_once('Connexiondb.php');

    $requeteD="select * from Direction";
    $resultatD=$pdo->query($requeteD);
    
?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <tit>Nouvelle catégorie</tit>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">   
        <link rel="stylesheet" type="text/css" href="../css/Monstyle.css">
        
        
    
    </head>
    <body>
    <img src='../Images/LogoPMU.png' width="380" height="176" style="float: left;"/>
    <?php
        
        include("Menu.php");
        for($i=1;$i<8;$i++){echo'<br>';}
        if($_SESSION['user']['nomRole']==="Admin"){
           ?>
        
        <div class="container">
            
            <div class="panel panel-primary" style = "margin-top: 150px;">
                    <div class= "panel-heading">Ajout d'une nouvelle Catégorie de produit:</div>
                    <div class= "panel-body">
                       <form method="post" action="InsertCategorie.php" class="form">
                        
                       <div class="form-group">
                            <label for="nomCategorie">Nom de la Catégorie : </label>
                            <input type="text" name="nomCategorie"
                                   placeholder="Exemple: Equipement"
                                   class="form-control" required>
                        </div>

                        <div>
                          <button type="submit" class="btn btn-success">
                              <span class="glyphicon glyphicon-save"></span>
                              Enregistrer
                          </button>
                          <a href = "Dashboard.php" >            
                            <button class="btn btn-danger" onclick='location.href="Dashboard.php"'>
                            <span class="glyphicon glyphicon-trash"></span>
                            Annuler
                            </button>
                          </a>
                        </div>
                        </form> 
                        
        <?php
        }else{?>
    <p class = "PasAcces">Accès refusé, veuillez contacter l'administrateur.</p>
<?php } ?>
    </body>    
</html>