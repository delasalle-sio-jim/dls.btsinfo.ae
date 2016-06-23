<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueSupprimerCompteEleve.php : visualiser la vue de suppression d'un compte élève
// Ecrit le 18/1/2016 par Nicolas Esteve
// Modifié le 26/05/2016 par Killian BOUTIN
?>
<!doctype html>
<html lang="en">
<head>	
<meta charset="utf-8">
	<?php include_once ('head.php');
	include_once ('modele/DAO.class.php');
	$dao = new DAO();?>
	<script>
		window.onload = initialisations;
		function initialisations() {
			<?php if ($typeMessage == 'avertissement') { ?>
				afficher_avertissement("<?php echo $message; ?>");
			<?php } ?>
			
			<?php if ($typeMessage == 'information') { ?>
				afficher_information("<?php echo $message; ?>");
			<?php } ?>
		}
		
		</script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  		<style>
  .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 100px;
  }
  </style>
		<script>
		 $(function() {
			    var listeEleves  = [ 
			     <?php 
		     	$eleveMails='"';
				foreach($lesMails as $unMail){ 
					$eleveMails .= $unMail.'","';
				 } 
				 $eleveMails = substr($eleveMails ,0,-2);
				 echo $eleveMails;?>	         			    
				];
			    $( "#listeEleves" ).autocomplete({
			      source: listeEleves
			    });
			  });
		</script>		
		<script>
		
		function afficher_information(msg) {
			document.getElementById("titre_message").innerHTML = "Information...";
			document.getElementById("titre_message").className = "classe_information";
			document.getElementById("texte_message").innerHTML = msg;
			window.open ("#affichage_message", "_self");
		}
		function afficher_avertissement(msg) {
			document.getElementById("titre_message").innerHTML = "Avertissement...";
			document.getElementById("titre_message").className = "classe_avertissement";
			document.getElementById("texte_message").innerHTML = msg;
			window.open ("#affichage_message", "_self");
		}
	</script>
</head> 
<body>
	<div id="page">
	
		<div id="header">
			<div id=header-menu>
				<ul id="menu-horizontal">
					<li><a href="index.php?action=Menu#menu4">Retour menu</a></li>
					<?php include_once 'ReseauxSociaux.php';?>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>Supprimer un utilisateur</h2>
			<form name="form1" id="form1" action="index.php?action=SupprimerCompteEleve" method="post">
				
				<?php if ($etape == 0)
				{?>
					<div class="ui-widget">
					<p>
						 <label for="listeEleves">Eleves: </label>
	 					 <input id="listeEleves"  value="<?php if($etape == 1 ) echo $mail ; else echo ''; ?>" name="listeEleves" placeholder="recherchez à l'aide de l'email de l'utilisateur">
					</p>
					
						
					<p>
						<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
					</p>	
					</div>
					
	
				<?php } else
				{?>
					
					<br><b>Prénom de l'utilisateur : </b><?php echo $prenom ?><br>
					<b>Nom de l'utilisateur : </b><?php echo $nom ?><br>
					<b>Mail de l'utilisateur : </b><?php echo $mail ?><br><br>
					
					<b>Année d'entrée en BTS : </b><?php echo $annee ?>
					<input type="submit" name="btnSupprimer" id="btnSupprimer" value="Supprimer l'utilisateur">
					
				<?php } ?>
			</form>
		</div>
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>
	
	<aside id="affichage_message" class="classe_message">
		<div>
			<h2 id="titre_message" class="classe_information">Message</h2>
			<p id="texte_message" class="classe_texte_message">Texte du message</p>
			<a href="<?php echo $lienRetour; ?>" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>						