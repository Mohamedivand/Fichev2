<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Se connecter</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/Monstyle.css">
</head>
<body>
    <img src='../Images/LogoPMU.png' width = 370, height = 166 style="float: left;"/>
    <div class="parent container col-md-6 mx-auto">
        <div class="panel panel-default" style="width: 500px;">
            <div class="taillePlus textCentrer panel-heading">Se connecter :</div>
            <div class="panel-body">
                <?php
                    require_once('Connexiondb.php');
                    
                    if(isset($_POST['login']) && isset($_POST['password'])){
                        $login=$_POST['login'];
                        $password=$_POST['password'];
                        
                        $requete="SELECT * FROM User AS u
                        INNER JOIN Direction AS d ON d.idDirection = u.idDirection 
                        INNER JOIN Role AS r ON r.idRole = u.idRole 
                        WHERE loginUser='$login' AND passwordUser='$password'";
                          
                        $resultat=$pdo->query($requete);
                        $user=$resultat->fetch();

                         
                        if($user){
                            $_SESSION['user']=$user;
                                if($user['firstConnexion'] == true){
                                    header("Location:Logon.php");
                                }else{
                                    header("Location:Dashboard.php");
                                exit();
                                }
                        }else{
                            $message=" Login ou mot de passe incorrect";
                        }
                        
                    }
                     
                ?>
                <form method="post" action="" class="form" id="form">

                    <div class="form-group">
                        <label for="login">Login :</label>
                        <input type="text" name="login" placeholder="Login" class="form-control" autocomplete="off" required/>
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" placeholder="Mot de passe" class="form-control" required/>
                    </div>

                    <button type="submit" class="taillePlus submit btn btn-success">
                        <span class="glyphicon glyphicon-log-in"></span>
                        Se connecter
                    </button>
                </form>
                    
            </div>
                <?php if(isset($message)){ ?>
                        <div class="red">
                            <span class = "rouge"><?php echo $message; ?></span>
                        </div>
                <?php } ?>
        </div>
    </div>
</body>
</html>
