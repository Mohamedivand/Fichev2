<?php
    require_once('identification.php');
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


                    $login = $_SESSION['user']['loginUser'];
                    if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){
                        $login=$_POST['login'];
                        $password=$_POST['password'];
                        $confirmPassword = $_POST['confirmPassword'];

                        
                        
                        $idUser = $_SESSION['user']['idUser'];
                        
                        if($password === $confirmPassword){
                            
                                    $setSecondConnexion = "update user set firstConnexion = false, passwordUser = '$password' where idUser = '$idUser'";
                                    $setSecondConnexion = $pdo->query($setSecondConnexion);
                                    $setSecondConnexion->execute();
                                    ?>
                                    <script>
                                        alert("Mot de passe changé");
                                    </script>
                                    <?php
                                    header("Location:Dashboard.php");
                                    
                                    exit();
                                
                           
                            
                        }else{
                            $messagePass = "Les mots de passe ne correspondent pas.";
                        }
                    }
                
                if(isset($message)){ ?>
                        <div class="red">
                            <span class = "rouge"><?php echo $message; ?></span>
                        </div>
                <?php } 
                if(isset($messagePass)){ ?>
                    <div class="red">
                        <span class = "rouge"><?php echo $messagePass; ?></span>
                    </div>
            <?php } ?>
            <form method="post" action="" class="form" id="form">

            <div class="form-group">
                <label for="login">Login :</label>
                <input type="text" name="login" placeholder="Login" class="form-control" value = "<?php echo $login ?>"/>
            </div>

            <div class="form-group">
                <label for="password">Créer un nouveau mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirmer le mot de passe :</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Saisissez encore votre mot de passe" class="form-control" required/>
            </div>
            <div id="passwordError" style="color: red;"></div>

            <script>
                const passwordField = document.getElementById('password');
                const confirmPasswordField = document.getElementById('confirmPassword');
                const passwordError = document.getElementById('passwordError');

                confirmPasswordField.addEventListener('input', function () {
                    if (passwordField.value !== confirmPasswordField.value) {
                        passwordError.textContent = "Les mots de passe ne correspondent pas.";
                    } else {
                        passwordError.textContent = "";
                    }
                });
            </script>


            <button type="submit" class="taillePlus submit btn btn-success">
                <span class="glyphicon glyphicon-log-in"></span>
                Se connecter
            </button>
            </form>
    </div>
</body>
</html>
