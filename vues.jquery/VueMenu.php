<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueMenu.php : visualiser le menu de l'élève ou de l'administrateur
	// cette vue est appelée par le lien "index.php?action=Menu"
	// la barre d'entête possède un lien de déconnexion permettant de retourner à la page de connexion
	// Ecrit le 29/11/2015 par Jim
?>
<!doctype html>
<html>
	<head>
		<?php include_once ($cheminDesVues . 'head.php'); ?>
	</head> 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
				<a href="index.php?action=Connecter" data-ajax="false" data-transition="<?php echo $transition; ?>">Déconnexion</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 20px; margin-bottom: 20px;"><?php echo $titre . $prenom . ' ' . $nom; ?></h4>
				<ul data-role="listview" data-inset="true">
					<?php if ( $typeUtilisateur == "eleve" ) {
						// menu élève ?>
						<li><a href="index.php?action=ChangerDeMdp" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier mon mot de passe</a></li>
						<li><a href="index.php?action=DetailsSoiree" data-ajax="false" data-transition="<?php echo $transition; ?>">Informations sur la soirée des anciens</a></li>
						<li><a href="index.php?action=InscriptionSoiree" data-ajax="false" data-transition="<?php echo $transition; ?>">M'inscrire à la soirée des anciens</a></li>
						<li><a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Recherche d'autres anciens élèves</a></li>
						<li><a href="index.php?action=ModifFichePerso" data-ajax="false" data-transition="<?php echo $transition; ?>">Mettre à jour mon profil</a></li>
						<li><a href="index.php?action=DepotStage" data-ajax="false" data-transition="<?php echo $transition; ?>">Mettre à disposition un stage</a></li>
						<li><a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Galerie des photos de classe</a></li>
					<?php } ?>
					<?php if ( $typeUtilisateur == "administrateur" ) {
						// menu administrateur ?>
						<li><a href="index.php?action=ChangerDeMdp" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier mon mot de passe</a></li>
						<li><a href="index.php?action=CreerAdmin" data-ajax="false" data-transition="<?php echo $transition; ?>">Créer un administrateur</a></li>
						<li><a href="index.php?action=SupprimerAdmin" data-ajax="false" data-transition="<?php echo $transition; ?>">Supprimer un administrateur</a></li>
						<li><a href="index.php?action=ModifSoiree" data-ajax="false" data-transition="<?php echo $transition; ?>">MAJ des informations sur la soirée</a></li>
						<li><a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Consulter les inscriptions à la soirée</a></li>
						<li><a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Envoyer courriels de relance</a></li>
						<li><a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Gérer la galerie des photos de classe</a></li>
						
						<div data-role="collapsible" >
						<h3>Gérer les comptes élèves</h3>
							<li><a href="index.php?action=CreatUserAdmin" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Créer un compte utilisateur</a></li>
							<li><a href="index.php?action=ModifUserAdmin" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier un compte utilisateur</a></li>
							<li><a href="index.php?action=SupprUserAdmin" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Supprimer un compte utilisateur</a></li>
							
						</div>
					<?php } ?>
				</ul>
				
				<?php if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					if ( isset ($_SESSION['adrMail']) == true)
						echo "<p>SESSION['adrMail'] = " . $_SESSION['adrMail'] . "</p>";
					if ( isset ($_SESSION['motDePasse']) == true)
						echo "<p>SESSION['motDePasse'] = " . $_SESSION['motDePasse'] . "</p>";
					if ( isset ($_SESSION['typeUtilisateur']) == true)
						echo "<p>SESSION['typeUtilisateur'] = " . $_SESSION['typeUtilisateur'] . "</p>";
					
					if ( isset ($_POST['txtAdrMail']) == true)
						echo "<p>POST['txtAdrMail'] = " . $_POST['txtAdrMail'] . "</p>";
					if ( isset ($_POST['txtMotDePasse']) == true)
						echo "<p>POST['txtMotDePasse'] = " . $_POST['txtMotDePasse'] . "</p>";
					if ( isset ($_POST['caseAfficherMdp']) == true)
						echo "<p>POST['caseAfficherMdp'] = " . $_POST['caseAfficherMdp'] . "</p>";
										
					echo "<p>adrMail = " . $adrMail . "</p>";
					echo "<p>motDePasse = " . $motDePasse . "</p>";
					echo "<p>afficherMdp = " . $afficherMdp . "</p>";
				} ?>
				
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
	</body>
</html>