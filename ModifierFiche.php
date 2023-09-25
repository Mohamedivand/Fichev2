<?php
    require_once('Identification.php');
    include('Connexiondb.php');
  $idFiche = $_GET['idFiche'];
  
  $requeteCountLigne = "select count(*) countL from ficheproduit where idFiche = $idFiche";
  $resultatCount = $pdo->query($requeteCountLigne);
  $tabCount = $resultatCount->fetch();
  $nbrLigne = $tabCount['countL'];

 

    $requetef = "SELECT f.idFiche, DATE_FORMAT(dateFiche, '%d-%m-%Y') as dateFiche, dga, destination, commentaire, nomDirection, sigleDirection, etat from Fiche as f
                    inner join Direction as d on f.idDirection = d.idDirection where f.idFiche = $idFiche";
            $requetep = "SELECT * from Produit as p 
                            inner join Categorie as c on p.idCategorie = c.idCategorie 
                            where p.idFiche = $idFiche";
            $requeteC = "select * from Categorie";

            $resultatC = $pdo->query($requeteC);
            
            $resultatf = $pdo->query($requetef);
            $resultatp = $pdo->query($requetep);
            
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">

        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/DetailFiche.css">
        <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
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

    </head>
    <body>
    <?php 
      include("Menu.php");
    ?>
    <img src='../Images/LogoPMU.png' width = 320, heigth = 116/>
    <?php 
      $idFiche = $_GET['idFiche'];
      $fiche = $resultatf->fetch();
    ?>
       
     
                    
        <?php
            


            // Récupérer l'idFiche depuis l'URL
            

            // Requête pour récupérer les informations de la fiche
            /*
            $requete = "SELECT f.idFiche, f.dateFiche, f.commentaire, d.sigleDirection, c.nomCategorie, p.nomProduit, p.quantite 
            FROM Fiche f where idFiche = '$idFiche'
            INNER JOIN Produit p ON p.idFiche = p.idFiche 
            INNER JOIN Categorie c ON p.idCategorie = c.idCategorie 
            INNER JOIN Direction d ON f.idDirection = d.idDirection";
            $requeteFiche = "SELECT * from Fiche where idFiche = $idFiche";
            $requeteProduit = "SELECT * from Produit as p, Fiche as f where p.idFiche = $idFiche";
            $requeteFicheProduit = "SELECT  * from FicheProduit as fp, Fiche as f where fp.idFiche = $idFiche";

            $requete = "SELECT f.idFiche, f.dateFiche, f.commentaire, p.nomProduit, p.quantite 
            FROM FicheProduit fp where idFiche = 3
            INNER JOIN Produit p ON p.idFiche = p.idFiche 
            INNER JOIN Fiche d ON fp.idFiche = f.idFiche";
            */
            

            // Afficher les informations de la fiche
            if($fiche['etat'] !== "validée" && $fiche['etat'] !== "rejetée"){
            if($resultatf) {

                $idFiche = $fiche['idFiche'];
                ?>
                <div class = "marginleft">
                    <h3 class = "EnteteDetail">Fiche de besoin N°<?php echo $fiche['idFiche']; ?>/ Direction: &nbsp;<?php echo $fiche['sigleDirection']; ?> </h3>
                    <form method="post" action="UpdateFiche.php?idFiche=<?php echo $idFiche ?>"> 
                        <tr>
                            <label>Date : &nbsp;<?php echo $fiche['dateFiche']; ?></label>
                        </tr>
                        <br>
                        <tr>
                            <label>Commentaire : &nbsp;</label><input type="text" name = "commentaire" value = "<?php echo $fiche['commentaire']; ?>">
                        </tr>
                </div>
                    
                    <div class="table-responsive">
                    <div class="table-responsive">
            
                <table id = "productTable">


                    <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Produit demandé</th>
                            <th>Quantité</th>
                            <th style="width: 15%;">Destination</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <tr class="product-row">
                                <div>
                                    <td><input type="text" name="produit1"></td>
                                </div>
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
                                <td>
              <select name="destination">
              <?php 
                        $resultatD = $pdo->query("select * from Direction");
                        while($direction = $resultatD->fetch()){ ?>
                            <option name = "destination" value="<?php echo $direction['nomDirection']; ?>"
                               <?php if($direction['nomDirection']===$fiche['destination']) echo "selected"; ?>>
                                <?php echo $direction['nomDirection'] ?>
                            </option>
                                <?php } ?>
                        </select>
                    </td>
            

                            </tr>
                            

                    </tbody>
                </table>
                    
                    <div class = "submit">
                <button type="button" id="addButton">Ajouter une ligne <span class="glyphicon glyphicon-plus" style="color:green"></span> </button>
                &nbsp;&nbsp;&nbsp;
                <button type="button" id="removeButton">Supprimer la dernière ligne <span class="glyphicon glyphicon-minus" style="color:red"></span> </button>
            </div>

            
                    <div>
                        <label class="signature-adjoint">Directeur général adjoint &nbsp;<br>
                        <select name="dga" required>

                        <option value="technique" <?php if($fiche['dga']=="technique"){ echo "selected";}?>>
                        Technique
                        </option>



                        <option value="chargé des operations"<?php if($fiche['dga']=="chargé des operations") echo "selected";?>>
                        Chargé des opérations
                        </option>


                        </select></label><br><br>

                    </div>
                    
                </div>
            </div>


</div>
                <?php
            } else {
                echo "Erreur : la fiche demandée n'existe pas.";
            }
        ?>
        <div class="submit">
            <input type="submit"  name = "submit" class="btn btn-success" value="Enregistrer les modifications">
            </form>
                <a href = "VoirFiche.php?idFiche=<?php echo $idFiche; ?>" >            
                    <button class="btn btn-danger" onclick='window.location.href="VoirFiche.php?idFiche=<?php echo $idFiche; ?>"'>
                        <span class="glyphicon glyphicon-trash"></span>
                        Annuler
                    </button>
                </a>
        </div>
    <?php }else{ ?>
      <p class = "PasAcces">Accès refusé, veuillez contacter l'administrateur.</p>
    <?php } ?>
   </body>
   

  