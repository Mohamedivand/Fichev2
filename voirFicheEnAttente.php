<?php
    require_once('Identification.php');
    include('Connexiondb.php');
    $idFiche = $_GET['idFiche'];
        
  //$approbationEffectuee = false; // Variable pour suivre l'état de l'approbation
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/DetailFiche.css">
        <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
        <script>
            // fonction pour cacher le bouton pendant l'impression
            function hideButtonDuringPrint() {
                var printButton = document.getElementById('print-button');
                printButton.style.display = 'none';
                window.print();
                printButton.style.display = 'block';
            }
            
            // événement de clic pour le bouton "Imprimer"
            var printButton = document.getElementById('print-button');
            printButton.addEventListener('click', hideButtonDuringPrint);


            
        function afficherPopup(redirection) {
          var champTexte = document.createElement("textarea");
          champTexte.rows = 4;
          champTexte.cols = 50; 

            var bouton = document.createElement("button");
            bouton.innerHTML = "Envoyer";

            var divPopup = document.createElement("div");
            divPopup.className = "popup";
            champTexte.placeholder = "Saisissez vos remarques...";
            divPopup.appendChild(champTexte);
            divPopup.appendChild(bouton);

            document.body.appendChild(divPopup);

            bouton.addEventListener("click", function () {
    var texteSaisi = champTexte.value;
    var texteEncode = encodeURIComponent(texteSaisi);
    
    window.location.href = redirection + "&texte=" + texteEncode;
    
    alert("Envoyée");
    
    divPopup.style.display = "none";
  });
            divPopup.style.display = "block";
        }
    </script>

    <style>
      .popup{
    position: fixed;
    top: 50%;
    left: 50%;
    justify-content: center;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    z-index: 9999;
  }
  </style>
        
    </head>
    <body>
    <?php include("Menu.php"); ?>
    <img src='../Images/LogoPMU.png' width = 320, heigth = 116/>
    <?php $idFiche = $_GET['idFiche'];
    $requetef = "SELECT idFiche, DATE_FORMAT(dateFiche, '%d-%m-%Y') as dateFiche, DATE_FORMAT(dateModif, '%d-%m-%Y') as dateModif, dga, destination, commentaire, nomDirection, v1, v2, v3, dm1, dm2, dm3, r1, r2, r3, sign1, sign2, sign3, remarque, demandeModif, auteurRejet, sigleDirection, etat from Fiche as f, Direction as d where f.idDirection = d.idDirection and idFiche = $idFiche";
    $requetep = "SELECT nomProduit, quantite, nomCategorie from Produit as p, Categorie as c where p.idCategorie = c.idCategorie and idFiche = $idFiche";
    $resultatf = $pdo->query($requetef);
    $resultatp = $pdo->query($requetep);

    $fiche = $resultatf->fetch();
?>

        <div class = "marginright right" id="print-button">
          
                    <a href ="FichesEnAttente.php" id="print-button">            
                        <button id="print-button">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                            Retour aux fiches en attentes
                        </button>
                    </a>
                    </div>
                
                
        </div>
        
        
        <div class = "marginright right">       
                    
        </div>
                    
        
<?php
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

            if($resultatf) {
                
                ?>
                
                  
                  
                <div class = "marginleft">
                    <h3 class = "EnteteDetail">Fiche de besoin N°<?php echo $fiche['idFiche']; ?>/ Direction: &nbsp;<?php echo ucfirst(strtolower($fiche['nomDirection'])); ?> </h3>
                    
                
                
                        <tr>
                            <label>Date de création : &nbsp;<?php echo $fiche['dateFiche']; ?></label>
                            
                        </tr>
                        <br>
                        <?php if(isset($fiche['dateModif'])){ ?>
                        <tr>
                        <label id = "Modification">
                    Modifié le <?php echo $fiche['dateModif']; ?> par <?php echo strtoupper($_SESSION['user']['nomUser']); ?>
                      <?php echo $_SESSION['user']['prenomUser']?>
                      
                  </label>
                  </tr>
                  </br>
                  <?php } ?>
                        <tr>
                            <label>Commentaire : &nbsp;<?php echo ucfirst(strtolower($fiche['commentaire'])); ?></label>
                        </tr>
                </div>
                </br>
                    <div class="table-responsive">
                    <div class="table-responsive">
  <table class="margetop">
    <thead>
      <tr>
        <th>Catégorie</th>
        <th>Désignation</th>
        <th>Quantité</th>
        <th style="width: 15%;">Destination</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $count = 0;
        while ($produit = $resultatp->fetch()) { 
          $count++;
      ?>
        <tr>
          <td><?php echo ucfirst(strtolower($produit['nomCategorie'])); ?></td>
          <td><?php echo ucfirst(strtolower($produit['nomProduit'])); ?></td>
          <td><?php echo ucfirst(strtolower($produit['quantite'])); ?></td>
          <?php if ($resultatp->rowCount() == 1) { ?>
            <td><?php echo ucfirst(strtolower($fiche['destination'])); ?></td>
          <?php } else if ($resultatp->rowCount() > 1) {
            if ($count == 1) { ?>
              <td rowspan="<?php echo $resultatp->rowCount(); ?>"><?php echo ucfirst(strtolower($fiche['destination'])); ?></td>
            <?php }
          } ?>
        </tr>
      <?php } ?>
    </tbody>
                        
                    </table>

                    <div class="signature-container">
  <div class="signature">
    <div>
      <label>Le chef de service <br> demandeur <br>
      --------------<br>
        <?php //Si l'utilisateur connecté est le chef de service de la meme direction que l'utilisateur qui a saisi la fiche
                // if($_SESSION['user']['nomDirection'] == $fiche['user']['nomDirection']) ?>
        
        <?php 
        
        if($fiche['v1'] == true) { ?>
        <label class = "valider"> 
          <span class = "glyphicon glyphicon-ok"></span>
            Approuvée par <br> <?php echo $fiche['sign1'];?> 
            
        </label>
        <?php }elseif($fiche['dm1'] == true) { ?>
        <label class = "demandeModif"> 
          <span class = "glyphicon glyphicon-edit"></span>
            Modification demandée par <br> <?php echo $fiche['demandeModif'];?> 
           
        </label> <br>
        <label style = color:red;>
          <u>  Remarque</u>: <?php echo $fiche['remarque'];?> 
        </label> 
        <?php
        }elseif($fiche['r1'] == true) { ?>
        <label class = "refuser"> 
          <span class = "glyphicon glyphicon-remove"></span>
            Refusé par <br> <?php echo $fiche['auteurRejet'];?> 
           
        </label> <br>
        <label style = color:red;>
          <u>  Remarque</u>: <?php echo $fiche['remarque'];?> 
        </label> 
        <?php
        }else { ?>
        <button <?php if($_SESSION['user']['nomRole']!="Chef de service" || $_SESSION['user']['nomDirection'] != $fiche['nomDirection']){ ?> class = "grise" <?php ;
                              }else{ ?>class = "approuver"; OnClick="location.href='Approuver.php?idFiche=<?php echo $idFiche; ?>&v1'"<?php } ?>>
            Approuver</button>
            
            
        
            <button <?php if ($_SESSION['user']['nomRole'] != "Chef de service" || $_SESSION['user']['nomDirection'] != $fiche['nomDirection']) { ?> class="grise" <?php ;
} else { ?> class="demandeModif" onclick="afficherPopup('Approuver.php?idFiche=<?php echo $idFiche; ?>&dm1');" <?php } ?>>Demander la modification</button>
   
             
        <button <?php if($_SESSION['user']['nomRole']!="Chef de service" || $_SESSION['user']['nomDirection'] != $fiche['nomDirection']){ ?> class = "grise" <?php ;
                              }else{ ?> class = "refuser"; onclick="afficherPopup('Approuver.php?idFiche=<?php echo $idFiche; ?>&r1');"<?php } ?>>Refuser</button>
                               
      </label><br><br>
      <?php  } ?>
          
    </div>
    <div>
      <label class="signature-adjoint">Directeur général adjoint &nbsp;<br><?php echo ucfirst(strtolower($fiche['dga'])); ?> <br>
      --------------<br>

      <?php 
        
        if($fiche['v2'] == true) { ?>
        <label class = "valider"> 
          <span class = "glyphicon glyphicon-ok"></span>
            Approuvée par <br> <?php echo $fiche['sign2'];?> 
            
        </label>
        <?php }elseif($fiche['dm1'] == true && $fiche['dm2'] == true && $fiche['dm3'] == true) { ?>
          <label class = "demandeModif"> 
          <span class = "glyphicon glyphicon-edit"></span>
            Modification demandée par <br> <?php echo $fiche['demandeModif'];?> 
           
        </label> <br>
        <label style = color:red;>
          <u>  Remarque</u>: <?php echo $fiche['remarque'];?> 
        </label> 
        <?php }elseif($fiche['r1'] == true && $fiche['r2'] == true && $fiche['r3'] == true) { ?>
        <label class = "refuser"> 
          <span class = "glyphicon glyphicon-remove"></span>
            Refusée par <br> <?php echo $fiche['auteurRejet']; ?>
        </label><br>
        <label style = color:red;>
          <u>  Remarque</u>: <?php echo $fiche['remarque'];?> 
        </label> 
        <?php }else{ ?>
      <button <?php if($fiche['dga'] =='technique'){
                      if($fiche['v1']!=true || $_SESSION['user']['nomRole']!= "DGAT"){ ?> class = "grise" <?php ;
                      }else{ ?> class = "approuver"
                        OnClick="location.href='Approuver.php?idFiche=<?php echo $idFiche; ?>&v2'"
                      <?php } ?>
                      <?php }elseif($fiche['v1']!=true || $_SESSION['user']['nomRole']!= "DGAO"){ ?> class = "grise" <?php ;
                      }else{ ?> class = "approuver"
                        OnClick="location.href='Approuver.php?idFiche=<?php echo $idFiche; ?>&v2'"
                      <?php } ?>
            >Approuver</button>
        <button <?php if($fiche['dga'] =='technique'){
                      if($fiche['v1']!=true || $_SESSION['user']['nomRole']!= "DGAT"){ ?> class = "grise" <?php ;
                      }else{ ?> class = "demandeModif"
                        onclick="afficherPopup('Approuver.php?idFiche=<?php echo $idFiche; ?>&dm2');"
                      <?php } ?>
                      <?php }elseif($fiche['v1']!=true || $_SESSION['user']['nomRole']!= "DGAO"){ ?> class = "grise" <?php ;
                      }else{ ?> class = "demandeModif"
                        onclick="afficherPopup('Approuver.php?idFiche=<?php echo $idFiche; ?>&dm2');"
                      <?php } ?>>Demander la modification</button>
        <button <?php if($fiche['dga'] =='technique'){
                      if($fiche['v1']!=true || $_SESSION['user']['nomRole']!= "DGAT"){ ?> class = "grise" <?php ;
                      }else{ ?> class = "refuser"
                        onclick="afficherPopup('Approuver.php?idFiche=<?php echo $idFiche; ?>&r2');"
                      <?php } ?>
                      <?php }elseif($fiche['v1']!=true || $_SESSION['user']['nomRole']!= "DGAO"){ ?> class = "grise" <?php ;
                      }else{ ?> class = "refuser"
                        onclick="afficherPopup('Approuver.php?idFiche=<?php echo $idFiche; ?>&r2');"
                      <?php } ?>>Refuser</button>
      </label><br><br>
      <?php } ?>
      

    </div>
    <div>
      <label>Directeur <br>général<br>
      --------------<br>
      <?php 
        
        if($fiche['v3'] == true) { ?>
        <label class = "valider"> 
          <span class = "glyphicon glyphicon-ok"></span>
            Approuvée par <br> <?php echo $fiche['sign3'];?> 
            
        </label>
        <?php }elseif($fiche['dm1'] == true && $fiche['dm2'] == true && $fiche['dm3'] == true) { ?>
        <label class = "demandeModif"> 
          <span class = "glyphicon glyphicon-edit"></span>
            modification demandée par <br> <?php echo $fiche['demandeModif']; ?>
        </label><br>
        <label style = color:red;>
          <u>  Remarque</u>: <?php echo $fiche['remarque'];?> 
        </label> 
        <?php }elseif($fiche['r1'] == true && $fiche['r2'] == true && $fiche['r3'] == true) { ?>
        <label class = "refuser"> 
          <span class = "glyphicon glyphicon-remove"></span>
            Refusée par <br> <?php echo $fiche['auteurRejet']; ?>
        </label><br>
        <label style = color:red;>
          <u>  Remarque</u>: <?php echo $fiche['remarque'];?> 
        </label> 
        <?php }else{ ?>
      <button <?php if($_SESSION['user']['nomRole']!="DG" || $fiche['v1']!=true || $fiche['v2']!=true){ ?> class = "grise" <?php ;
                              }else{ ?> class = "approuver" 
        OnClick="location.href='Approuver.php?idFiche=<?php echo $idFiche; ?>&v3'"
                              <?php } ?>
        >Approuver</button>
        <button <?php if($_SESSION['user']['nomRole']!="DG" || $fiche['v1']!=true || $fiche['v2']!=true){ ?> class = "grise" <?php ;
                              }else{ ?> class= "demandeModif" onclick="afficherPopup('Approuver.php?idFiche=<?php echo $idFiche; ?>&dm3');"<?php } ?>>Demander la modification</button>
        <button <?php if($_SESSION['user']['nomRole']!="DG" || $fiche['v1']!=true || $fiche['v2']!=true){ ?> class = "grise" <?php ;
                              }else{ ?> class = "refuser" onclick="afficherPopup('Approuver.php?idFiche=<?php echo $idFiche; ?>&r3');"<?php } ?>>Refuser</button>
      </label><br><br>
      <?php } ?>
    </div>
  </div>
</div>
                    
                    
                </div>
                <?php
            } else {
                echo "Erreur : la fiche demandée n'existe pas.";
            }
        ?>
   
   </body>

  