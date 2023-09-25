<?php

    require_once('Identification.php');

    include('Connexiondb.php');
    
    $idFiche = $_GET['idFiche'];

    $requeteD = "select * from Direction";
    $resultatD = $pdo->query($requeteD);

    $requetef = "SELECT f.idFiche, DATE_FORMAT(dateFiche, '%d-%m-%Y') as dateFiche, dga, destination, commentaire, nomDirection, sigleDirection, etat from Fiche as f
                    inner join Direction as d on f.idDirection = d.idDirection where f.idFiche = $idFiche";
            $requetep = "SELECT * from Produit as p 
                            inner join Categorie as c on p.idCategorie = c.idCategorie 
                            where p.idFiche = $idFiche  order by idProduit";
            $requeteC = "select * from Categorie";

            $resultatC = $pdo->query($requeteC);
            
            $resultatf = $pdo->query($requetef);
            $resultatp = $pdo->query($requetep);


            $fiche = $resultatf->fetch();

            $countProduit = "select count(idProduit) nbrProduit from produit where idFiche = $idFiche";
            $resultatcount = $pdo ->query($countProduit);
            $tabCount = $resultatcount->fetch();
            $nombreProduits = $tabCount['nbrProduit'];

    ?>


<!DOCTYPE HTML>
<HTML>
    <HEAD>
    <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/DetailFiche.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    var counter = <?php echo $resultatp->rowCount(); ?> +1;

                    $("#addButton").click(function () {
                        if(counter>10){
                            alert("Vous avez atteint la limite de 10 produits");
                            return false;
                        }   

                        var newProductRow = '<tr class = "product-row">' +
                                                '<td></td>' +
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

        include('ModifierEntete.php');

        /* 
        $ligne = [];
        creation du bouton remove
        
        */

        ?>
       <?php if($fiche['etat'] !== "validée" && $fiche['etat'] !== "rejetée"){ ?>
        <div class="table-responsive">
            <form action="UpdateFiche.php?idFiche=<?php echo $idFiche ?>" method="post">
            <div class = "marginleft">
                    
                        <tr>
                            <label>Date : &nbsp;<?php echo $fiche['dateFiche']; ?></label>
                        </tr>
                        <br>
                        <tr>
                            <label>Commentaire : &nbsp;</label><input type="text" name = "commentaire" value = "<?php echo $fiche['commentaire']; ?>">
                        </tr>
                        <div>
                        <label class="signature-adjoint">Directeur général adjoint &nbsp;
                        <select name="dga" required>

                        <option value="technique" <?php if($fiche['dga']=="technique"){ echo "selected";}?>>
                        Technique
                        </option>



                        <option value="chargé des operations"<?php if($fiche['dga']=="chargé des operations") echo "selected";?>>
                        Chargé des opérations
                        </option>


                        </select></label>

                    
                    
                
                        </div>

                </div>
                <table id = "productTable">


                    <thead>
                        <tr>
                        <th>Action</th>
                            <th>Catégorie</th>
                            <th>Produit demandé</th>
                            <th>Quantité</th>
                            <th style="width: 15%;">Destination</th>
                        </tr>
                    </thead>
                    <tbody>
      <?php 
        $count = 0;

        while ($produit = $resultatp->fetch()) {
             
          $count++;
          //$idCategorie=$produit['idCategorie'];
      ?>
        <tr class="product-row">
            <td>
        <a <?php if($nombreProduits > 1){?> onclick="return confirm('Voulez-vous supprimer le produit?')" 
                                                        href="DeleteProduit.php?idProduit=<?php echo $produit['idProduit'];?>&idFiche=<?php echo $idFiche; ?> "
                                                        <?php
                                                    }else{ ?> onclick="return alert('Il doit y avoir au moins un produit')" <?php } ?>
                                                    >
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </a>
        </td>
                                                    <td>
          <select name = "categorie<?php echo $count; ?>">
              <?php 
                        $resultatC = $pdo->query("select * from Categorie");
                        while($categorie = $resultatC->fetch()){ ?>
                            <option value="<?php echo $categorie['idCategorie']; ?>"
                               <?php if($categorie['nomCategorie']===$produit['nomCategorie']) echo "selected"; ?>>
                                <?php echo $categorie['nomCategorie'] ?>
                            </option>
                                <?php } ?>
                        </select>
        </td>
        <input type="hidden" name = "idProduit<?php echo $count; ?>" value ="<?php echo $produit['idProduit']; ?>">
          <td><input type="text" name = "produit<?php echo $count ?>" value ="<?php echo $produit['nomProduit']; ?>"></td>
          <td><input type="text" name = "quantite<?php echo $count; ?>" value ="<?php echo $produit['quantite']; ?>"></td>
          <?php if ($resultatp->rowCount() == 1) { ?>
            <td><select name="destination">
              <?php 
                        $resultatD = $pdo->query("select * from Direction");
                        while($direction = $resultatD->fetch()){ ?>
                            <option name = "destination" value="<?php echo $direction['nomDirection']; ?>"
                               <?php if($direction['nomDirection']===$fiche['destination']) echo "selected"; ?>>
                                <?php echo $direction['nomDirection'] ?>
                            </option>
                                <?php } ?>
                        </select></td>
          <?php } else if ($resultatp->rowCount() > 1) {
            if ($count == 1) { ?>
              <td rowspan="<?php echo $resultatp->rowCount(); ?>">
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
            <?php }

          } ?>
        </tr>
      <?php }?>
      <input type = "hidden" name = "nombreProduit" value="<?php echo $count; ?>">
                </table>
            <br>
            <div class = "submit">
                <button type="button" id="addButton">Ajouter une ligne <span class="glyphicon glyphicon-plus" style="color:green"></span> </button>
                &nbsp;&nbsp;&nbsp;
                <button type="button" id="removeButton">Supprimer la dernière ligne <span class="glyphicon glyphicon-minus" style="color:red"></span> </button>
            </div>
        </div>
        <br>
        
                
                   
                    
        <div class="submit">
            <input type="submit"  name = "submit" class="btn btn-success" value="Enregistrer les modifications">
            </form>
                <a>            
                    <button class="btn btn-danger" onclick='location.href="VoirFiche.php?idFiche=<?php echo $idFiche; ?>"'>
                        <span class="glyphicon glyphicon-trash"></span>
                        Annuler
                    </button>
                </a>
        </div>
        
    
    <?php
    }else{?>
        <p class = "PasAcces">Fiche non modifiable, Accès refusé !</p>
    <?php } 
        }else{?>
    <p class = "PasAcces">Accès refusé, veuillez contacter l'administrateur.</p>
<?php } ?>
</BODY>
</HTML>