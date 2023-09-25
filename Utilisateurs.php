<?php
    include('Identification.php');
    require_once("Connexiondb.php");

    $nomPrenom=isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $idDirection=isset($_GET['idDirection'])?$_GET['idDirection']:0;


    $requeteD="select * from Direction";

    if($idDirection==0){
        $requeteU="select *
                    from Direction as d, User as u
                    inner join role as r on u.idRole=r.idRole
                    where d.idDirection=u.idDirection
                    
                    and (nomUser like '%$nomPrenom%' or prenomUser like '%$nomPrenom%')";
        $requeteCount="select count(*) countU from User
                    where nomUser like '%$nomPrenom%' or prenomUser like '%$nomPrenom%'";
    }else{
        $requeteU="select *
                    from Direction as d, User as u
                    inner join role as r on u.idRole=r.idRole
                    where d.idDirection=u.idDirection
                    and (nomUser like '%$nomPrenom%' or prenomUser like '%$nomPrenom%')
                    and d.idDirection=$idDirection";
        $requeteCount="select count(*) countU from User
                    where (nomUser like '%$nomPrenom%' or prenomUser like '%$nomPrenom%')
                    and idDirection=$idDirection";
    }
    
    $resultatD=$pdo->query($requeteD);
    
    $resultatU=$pdo->query($requeteU);

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrU=$tabCount['countU'];

?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/Monstyle.css">
    </head>
    <body>
        
        <?php include("Menu.php"); ?>
        <img src='../Images/LogoPMU.png' width = 340, heigth = 136/>
        <div style = "margin-left: 30px;">
<a href="Dashboard.php">
                                    
                                    <button class="btn btn-success">
                                        <span class="glyphicon glyphicon-arrow-left"></span> Retour à l'acceuil
                                    </button>
                                
                            </a>

</div>
        <div class="container">
            <div class="panel panel-success margetop">
                <div class= "panel-heading" style = "background-color:#333; color:#fff;">Rechercher un utilisateur...</div>
                <div class= "panel-body">
                    <form method="get" action="Utilisateurs.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nomPrenom" 
                                   placeholder="Nom ou prénom" 
                                   class="form-control"
                                   value="<?php echo $nomPrenom ?>" >
                        </div>
                        <label for="idDirection">Direction: </label>
                        <select name="idDirection" class="form-control" id="idDirection"
                            onchange="this.form.submit()">
                            <option value=0>Toutes les Directions</option>
                            <?php while($direction=$resultatD->fetch()){ ?>
                                <option value="<?php echo $direction['idDirection']?>"
                                    <?php if($direction['idDirection'] === $idDirection) echo "selected"?> > 
                                    <?php echo $direction['nomDirection']?> 
                                </option>
                            <?php } ?>
                        </select>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Rechercher
                        </button>
                        &nbsp &nbsp

                    </form>
                </div>
            </div>
        </div>
        
        <div>
            <div class="panel  margetop">
                    <div style = "text-align:center;"><label>Liste des utilisateurs -  <?php echo $nbrU?> Utilisateur(s)</label></div>
                    <div class= "panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Matricule</th> <th>Nom</th> <th>Prénom</th> <th>Login</th> <th>E-mail</th> <th>Role/Poste</th> <th>Direction</th> <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <?php while($user=$resultatU->fetch()){?>
                                            <tr>
                                                <td style="white-space: nowrap;"> <?php echo $user['matricule'] ?> </td>
                                                <td style="white-space: nowrap;"> <?php echo $user['nomUser'] ?> </td>
                                                <td style="white-space: nowrap;"> <?php echo $user['prenomUser'] ?> </td>
                                                <td style="white-space: nowrap;"> <?php echo $user['loginUser'] ?> </td>
                                                <td style="white-space: nowrap;"> <?php echo $user['email'] ?> </td>
                                                <td style="white-space: nowrap;"> <?php echo $user['nomRole'] ?> </td>
                                                <td style="white-space: nowrap;"> <?php echo $user['nomDirection'] ?> </td>
                                                
                                                <td style="white-space: nowrap;">
                                                    <a href = "EditerUser.php?idUser=<?php echo $user['idUser']; ?>">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                    </a>
                                                    &nbsp;
                                                    <a onclick = "return confirm('Voulez-vous supprimer cet utilisateur?')" href = "DeleteUser.php?idUser=<?php echo $user['idUser']; ?>" >
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    </a>
                                                    &nbsp;
                                                    <a onclick = "return confirm('Reinitialiser le mot de passe de cet utilisateur?')" href="UpdatePassword.php?idUser=<?php echo $user['idUser'];?>">reset password</a>
                                                </td>
                                            </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                       
                    </div>
                </div>
        </div>
    </body>
</html>