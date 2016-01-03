<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueMenu.php : visualiser le menu de l'élève ou de l'administrateur
	// cette vue est appelée par le lien "index.php?action=Menu"
	// la barre d'entête possède un lien de déconnexion permettant de retourner à la page de connexion
	// Ecrit le 30/12/2015 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
</head> 
<body>
	<div id="page">
	
		<div id="header">
			<div id="header-menu">
				<ul id="menu-horizontal">
					<li><a href="index.php?action=Connecter">Déconnexion</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">			 		
			<h2><?php echo $titre . $prenom . ' ' . $nom; ?></h2>
			<div id="menu-vertical">				
				<?php if ( $typeUtilisateur == "eleve" ) {
					// menu élève ?>
					<p><a href="index.php?action=ChangerDeMdp" class="bouton-menu">Modifier mon mot de passe</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Informations sur la soirée des anciens</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">M'inscrire à la soirée des anciens</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Recherche d'autres anciens élèves</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Mettre à jour mon profil</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Galerie des photos de classe</a></p>
				<?php } ?>
				
				<?php if ( $typeUtilisateur == "administrateur" ) {
					// menu administrateur ?>
					<p><a href="index.php?action=ChangerDeMdp" class="bouton-menu">Modifier mon mot de passe</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Créer un administrateur</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Supprimer un administrateur</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Gérer les comptes élèves</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">MAJ des informations sur la soirée</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Consulter les inscriptions à la soirée</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Envoyer courriels de relance</a></p>
					<p><a href="index.php?action=Menu" class="bouton-menu">Gérer la galerie des photos de classe</a></p>
				<?php } ?>
			</div>			
		</div>
			
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>
	</div>
</body>
</html>