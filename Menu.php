<?php
    require_once('Identification.php');
?>
<nav class="navbar navbar-inverse navbar-fixed-top">

	<div class="container-fluid">
	
		<div>
		
			<label class="navbar-brand">Fiche de besoins <?php
				for ($i = 0; $i < 80; $i++) {
					echo "&nbsp;";
				}
				?>
			</label>
			
		</div>
				<label class="navbar-brand"><?php echo $_SESSION['user']['nomDirection']?> - <?php echo strtoupper($_SESSION['user']['nomUser'])?> &nbsp;<?php echo $_SESSION['user']['prenomUser']?></label>


		
		<ul class="nav navbar-nav navbar-right">			
			<li>
				<a href="Deconnexion.php">
                <span class="glyphicon glyphicon-log-out"></span>
					Se déconnecter
				</a>
				
			</li>
			
		</ul>
		
	</div>
</nav>
