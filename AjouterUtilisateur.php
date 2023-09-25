<?php
    include('Identification.php');
    require_once('Connexiondb.php');

    $requeteD="select * from Direction";
    $resultatD=$pdo->query($requeteD);
    $requeteR = "select * from Role";
    $resultatR = $pdo->query($requeteR);
    
?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <tit>Nouvel utilisateur</tit>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">   
        <link rel="stylesheet" type="text/css" href="../css/Monstyle.css">

        
   

    </head>
    <body>
    <img src='../Images/LogoPMU.png' width="380" height="176" style="float: left;"/>
        <?php
        
        include("Menu.php");
        for($i=1;$i<5;$i++){echo'<br>';}
        if($_SESSION['user']['nomRole']==="Admin"){
           ?>
        
        
        <div class="container">
            
            <div class="panel panel-primary" style = "margin-top: 100px;">
                    <div class= "panel-heading">Ajout d'un nouvel utilisateur:</div>
                    <div class= "panel-body">
                       <form method="post" action="InsertUtilisateur.php" class="form">
                        
                       <div class="form-group">
                            <label for="matricule">Matricule : </label>
                            <input type="text" name="matricule"
                                   placeholder="Numéro matricule"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="nom">Nom : </label>
                            <input type="text" name="nom"
                                   placeholder="Nom de famille"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prénom : </label>
                            <input type="text" name="prenom"
                                   placeholder="Prénom de l'utilisateur"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="login">login : </label>
                            <input type="text" name="login"
                                   placeholder="login de l'utilisateur"
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail : </label>
                            <input type="text" name="email"
                                   placeholder="Adresse e-mail"
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe : </label>
                            <input type="password" name="password"
                                   placeholder="Mot de passe"
                                   class="form-control" required>
                        </div>

                      

                        <div class="form-group">
                            <label for="direction">Direction: </label>
                            <select name="direction" class="form-control" id="direction" required>
                            <option value="">
                                        Choisissez la direction
                                    </option>
                                <?php while($direction=$resultatD->fetch()){ ?>
                                   
                                    <option value="<?php echo $direction['idDirection'] ?>">
                                        <?php echo $direction['nomDirection'] ?>
                                    </option>

                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role">Role: </label>
                            <select name="role" class="form-control" id="role" required>
                            <option value="">
                                        Choisissez le role
                                    </option>
                                <?php while($role=$resultatR->fetch()){ ?>
                                   
                                    <option value="<?php echo $role['idRole'] ?>">
                                        <?php echo $role['nomRole'] ?>
                                    </option>

                                <?php } ?>
                            </select>
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