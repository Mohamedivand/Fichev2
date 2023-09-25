<?php

    require_once('Identification.php');

    include('Connexiondb.php');
    


    $requeteC = "select * from Categorie";
    $resultatC = $pdo->query($requeteC);

    $requeteD = "select * from Direction";
    $resultatD = $pdo->query($requeteD);

    ?>


<!DOCTYPE HTML>
<HTML>
    <HEAD>
    <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/Monstyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    var counter = 2;

                    $("#addButton").click(function () {
                        if(counter>10){
                            alert("Vous avez atteint la limite de 10 produits");
                            return false;
                        }   

                        var newProductRow = '<tr class = "product-row">' +
                                                '<td>' +
                                                    '<select name="categorie' + counter + '" class="Combobox" required>' +
                                                        '<option value="">Choisissez une Catégorie</option>' +
                                                        '<?php while($categorie = $resultatC->fetch()){ ?>' +
                                                            '<option value="<?php echo $categorie['idCategorie'] ?>"><?php echo $categorie['nomCategorie'] ?></option>' +
                                                        '<?php } ?>' +
                                                    '</select>' +
                                                '</td>' +
                                                '<td><input type="text" name="produit' + counter + '"></td>' +
                                                '<td><input type="number" name="quantite' + counter + '"></td>' +
                                            '</tr>';

                        $("#productTable").append(newProductRow);

                        counter++;
                    });

                    $("#removeButton").click(function () {
                        if(counter == 2){
                            alert("Il doit y avoir au moins un produit");
                            return false;
                        }   

                        counter--;


                            $("#productTable tr.product-row:last-child").remove();
                        
                    });
                });
            </script>
    </HEAD>
    <BODY>
   
    <?php include("Menu.php"); 
    if($_SESSION['user']['nomRole']==="Admin" || $_SESSION['user']['nomRole']==="Utilisateur"){
        include('Entete.php');
        ?>
        <div class="table-responsive">
            <form action="InsertFiche.php" method="post">
                <table id = "productTable">


                    <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Produit demandé</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <tr class="product-row">
                                <div>
                                    <td>                           
                                        <select name="categorie1" class = "Combobox" required>

                                            <option value="">Choisissez une Catégorie</option>
                                            <?php 
                                                $resultatC = $pdo->query("select * from Categorie");
                                                while($categorie = $resultatC->fetch()){ ?>
                                            <option value="<?php echo $categorie['idCategorie'] ?>">
                                                <?php echo $categorie['nomCategorie'] ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </div>
                                <div>
                                    <td><input type="text" name="produit1"></td>
                                </div>
                                <div>
                                    <td><input type="number" name="quantite1"></td>
                                </div>
                            </tr>
                            

                    </tbody>
                </table>
            <br>
            <div class = "submit">
                <button type="button" id="addButton">Ajouter une ligne <span class="glyphicon glyphicon-plus" style="color:green"></span> </button>
                &nbsp;&nbsp;&nbsp;
                <button type="button" id="removeButton">Supprimer la dernière ligne <span class="glyphicon glyphicon-minus" style="color:red"></span> </button>
            </div>
        </div>
        

        <br><br>

        <div class="form-group">
            <label class = "taillePlus" for="commentaire">Commentaire :</label> <br>
            <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
        </div>

            <br><br>
        
            <div class = "flex-container">
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class = "taillePlus">Directeur général adjoint : </label>
                <select class = "taillePlus" style = "width: 350px;" name="dga" required>
                    <option value="">Choisissez un DGA</option>
                    <option value="technique">
                                Technique
                    </option>
                    <option value="chargé des operations">
                               Chargé des opérations
                    </option>
                            
                </select>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class = "taillePlus">Direction destinataire: </label>
                <select class = "taillePlus" style = "width: 350px;" name="destination" required>
                    <option value="">Choisissez une direction destinataire</option>
                    <?php 
                        $resultatD = $pdo->query("select * from Direction");
                        while($direction = $resultatD->fetch()){ ?>
                            <option value="<?php echo $direction['nomDirection'] ?>">
                                <?php echo $direction['nomDirection'] ?>
                            </option>
                                <?php } ?>
                </select>
            
            </div>
            
                
        
        <br>
        <br>
        <div class="submit">
            <input type="submit"  name = "submit" class="btn btn-success" value="Envoyer la demande">
                <a href = "Fiches.php" >            
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
</BODY>
</HTML>