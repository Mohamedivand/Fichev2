<?php
    include('Identification.php');
    require_once('Connexiondb.php');

    $idUser = $_GET['idUser'];

    $requete="select matricule, nomUser, prenomUser, loginUser, passwordUser, nomRole, u.idRole, u.email, u.idDirection, nomDirection from user as u
                inner join direction as d on u.idDirection = d.idDirection
                inner join role as r on u.idRole = r.idRole
                where u.idUser = $idUser";
    $resultat=$pdo->query($requete); 
    
    $requeteD="select * from Direction";
    $resultatD=$pdo->query($requeteD);
    $direction = $resultatD->fetch();

    $requeteR = "select * from Role";
    $resultatR = $pdo->query($requeteR);
    $role = $resultatR->fetch();
    

?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <tit>Modifier utilisateur</tit>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">   
        <link rel="stylesheet" type="text/css" href="../css/Monstyle.css">

        
   

    </head>
    <body>
    <img src='../Images/LogoPMU.png' width="380" height="176" style="float: left;"/>
        <?php
        
        include("Menu.php");
        for($i=1;$i<8;$i++){echo'<br>';}

        if($_SESSION['user']['nomRole']==="Admin"){
           
           while($user = $resultat->fetch()){?>
        
        
        <div class="container">
            
            <div class="panel panel-primary" style = "margin-top: 100px;">
                    <div class= "panel-heading">Modification d'un utilisateur:</div>
                    <div class= "panel-body">
                       <form method="post" action="UpdateUser.php?idUser=<?php echo $idUser; ?>" class="form">
                        
                       <div class="form-group">
                            <label for="matricule">Matricule : </label>
                            <input type="text" name="matricule"
                                   placeholder="Numéro matricule"
                                   class="form-control"
                                   value="<?php echo $user['matricule']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="nom">Nom : </label>
                            <input type="text" name="nom"
                                   placeholder="Nom de famille"
                                   class="form-control"
                                   value="<?php echo $user['nomUser']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prénom : </label>
                            <input type="text" name="prenom"
                                   placeholder="Prénom de l'utilisateur"
                                   class="form-control"
                                   value="<?php echo $user['prenomUser']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="login">login : </label>
                            <input type="text" name="login"
                                   placeholder="login de l'utilisateur"
                                   class="form-control" required
                                   value="<?php echo $user['loginUser']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail : </label>
                            <input type="text" name="email"
                                   placeholder="Adresse e-mail"
                                   class="form-control" required
                                   value="<?php echo $user['email']; ?>">
                        </div>

                        

                      

                        <div class="form-group">
                            <label for="direction">Direction: </label>
                            <select name="direction" class="form-control" id="direction" required>
                            
                                <?php while($direction=$resultatD->fetch()){ ?>
                                   
                                    <option value="<?php echo $direction['idDirection'] ?>"
                                    <?php if($direction['nomDirection']===$user['nomDirection']) echo "selected";?>>
                                        <?php echo $direction['nomDirection'];?>
                                    </option>

                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role">Role: </label>
                            <select name="role" class="form-control" id="role" required>
                            
                                <?php while($role=$resultatR->fetch()){ ?>
                                   
                                    <option value="<?php echo $role['idRole'] ?>"
                                    <?php if($role['nomRole'] == $user['nomRole']) echo "selected";?>>
                                        <?php echo $role['nomRole'];?>
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
                        
                        </div>
                        </div>
                        </div>
                         
                        
<?php
           }
        }else{?>
    <p class = "PasAcces">Accès refusé, veuillez contacter l'administrateur.</p>
<?php } ?>
    </body>    
</html>