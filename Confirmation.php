<?php 
    include('Identification.php');
    require_once('Connexiondb.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Confirmation</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/Monstyle.css">
        <style>
            .btn-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                margin-top: 10px;
            }

            .btn-container button {
                margin: 30px;
                background-color: #4CAF50;
                color: white;
                padding: 15px 20px;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                font-size: 18px;
            }
        </style>
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
                    
                        <h1 style = "text-align: center;"><label>Enregistré avec succes!</label></h1>

                        <br><br><br>
                        <a href="Dashboard.php">
                        <div class="btn-container" style = "margin-top:10px;">
                            <button class="btn btn-success">
                                <span class="glyphicon glyphicon-arrow-left"></span> Retour
                            </button>
        </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
