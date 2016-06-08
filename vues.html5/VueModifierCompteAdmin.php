<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueModifierCompteEleve.php : visualiser la vue de modification de compte élève par un administrateur
// Ecrit le 18/1/2016 par Nicolas Esteve
// Modifié le 20/5/2016 par Jim

?>
<!doctype html>
<html lang="fr">
<head>	
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
		    var listeAdmins  = [ 
		     <?php 
	     	$adminMails='"';
			foreach($lesMailsAdmin as $unMail){ 
				$adminMails .= $unMail.'","';
			 } 
			 $adminMails = substr($adminMails ,0,-2);
			 echo $adminMails;?>	         			    
			];
		    $( "#listeAdmins" ).autocomplete({
		      source: listeAdmins
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
					<li><a href="index.php?action=Menu#menu5">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>Modifier un administrateur</h2>
			<form name="form1" id="form1" action="index.php?action=ModifierCompteAdmin" method="post">
				
				<?php if($etape == 0)
				{?>
					<div class="ui-widget">
						<p>
							 <label for="listeAdmins">Administrateur: </label>
		 					 <input id="listeAdmins" type=email"  value="<?php if($etape == 1 ) echo $uneAdrMail; else echo ''; ?>" name="listeAdmins" required pattern="^.+@.+\..+$" placeholder="Recherchez à l'aide de l'email de l'administrateur">
						</p>
						
						<p>
							<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
						</p>	
					</div>
				
	
				<?php } else
				{?>
				
					<p>
						<label for="txtNom">Nom (de naissance) * :</label>
						<input type="text" name="txtNom" id="txtNom" maxlength="30" required value="<?php echo $nom; ?>" />
					</p>
					<p>
						<label for="txtPrenom">Prénom * :</label>
						<input type="text" name="txtPrenom" id="txtPrenom" maxlength="30" required value="<?php echo $prenom; ?>" />
					</p>
								
					<p>
						<input type="submit" value="Envoyer les données" name="btnEnvoyer" id="btnEnvoyer" />
					</p>
				<?php }?>	
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