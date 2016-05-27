<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueMenu.php : visualiser le menu de l'élève ou de l'administrateur
	// cette vue est appelée par le lien "index.php?action=Menu"
	// la barre d'entête possède un lien de déconnexion permettant de retourner à la page de connexion
	// Ecrit le 29/11/2015 par Jim
	// Modifié le 20/5/2016 par Jim
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
					
					<?php if ( $typeUtilisateur == "eleve" ) {
					// menu élève ?>
					<div data-role="collapsible-set">
						<div data-role="collapsible">
							<h3>Gérer mon compte...</h3>
							<ul data-role="listview" data-inset="true">
								<li><a href="index.php?action=ChangerDeMdpEleve" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier mon mot de passe</a></li>
								<li><a href="index.php?action=ModifierMaFichePersoEleve" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Mettre à jour mon profil</a></li>						
							</ul>
						</div>
					
						<div data-role="collapsible" data-collapsed="false">
							<h3>La soirée annuelle des anciens...</h3>
							<ul data-role="listview" data-inset="true">
								<?php 
									if ($typeUtilisateur == "eleve" && $dao->getIdInscription($id) == -1){
								?>
								<li><a href="index.php?action=CreerMonInscription" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">M'inscrire à la soirée des anciens</a></li>
								<?php 
								} ?>
								<li><a href="index.php?action=VoirDetailsSoiree" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Consulter les infos sur la soirée</a></li>
								<li><a href="index.php?action=VoirListeInscritsEleve" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Consulter la liste des inscriptions</a></li>
								<?php 
									if ($typeUtilisateur == "eleve" && $dao->getIdInscription($id) != -1){
								?>
								<li><a href="index.php?action=ModifierMonInscription" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier ou annuler mon inscription</a></li>
								<?php 
								} ?>
							</ul>
						</div>	
													
						<div data-role="collapsible">
							<h3>Le réseau des anciens élèves...</h3>
							<ul data-role="listview" data-inset="true">								
								<li><a href="index.php?action=RechercherAnciens" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Rechercher d'autres anciens élèves</a></li>
								<li><a href="index.php?action=ProposerStage" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Proposer un stage à un étudiant</a></li>
								<li><a href="index.php?action=VoirPhotos" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Consulter la galerie de photos</a></li>
							</ul>
						</div>
					</div>
					<?php } ?>
					
					<?php if ( $typeUtilisateur == "administrateur" ) {
					// menu administrateur ?>
					<div data-role="collapsible-set">
						<div data-role="collapsible">
							<h3>Gérer mon compte...</h3>
							<ul data-role="listview" data-inset="true">
								<li><a href="index.php?action=ChangerDeMdpAdmin" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier mon mot de passe</a></li>
								<li><a href="index.php?action=ModifierMaFichePersoAdmin" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Mettre à jour mon profil</a></li>						
							</ul>
						</div>					
								
						<div data-role="collapsible" data-collapsed="false">
							<h3>La soirée annuelle des anciens...</h3>
							<ul data-role="listview" data-inset="true">	
								<li><a href="index.php?action=ModifierDetailsSoiree" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier les infos sur la soirée</a></li>
								<li><a href="index.php?action=VoirListeInscritsAdmin" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Consulter la liste des inscriptions</a></li>
								<li><a href="index.php?action=EnvoyerCourriel" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Envoyer un courriel de relance</a></li>
								<li><a href="index.php?action=ModifierReglementsRemboursements" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Mettre à jour réglements et remboursements</a></li>
							</ul>
						</div>	
	
						<div data-role="collapsible">
							<h3>Le réseau des anciens élèves...</h3>
							<ul data-role="listview" data-inset="true">		
								<li><a href="index.php?action=RechercherAnciens" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Rechercher d'autres anciens élèves</a></li>
								<li><a href="index.php?action=GererPhotos" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Gérer la galerie de photos</a></li>
							</ul>
						</div>	
											
						<div data-role="collapsible" >
							<h3>Gérer les comptes élèves...</h3>
							<ul data-role="listview" data-inset="true">
								<li><a href="index.php?action=CreerCompteEleve" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Créer un compte élève</a></li>
								<li><a href="index.php?action=ModifierCompteEleve" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier un compte élève</a></li>
								<li><a href="index.php?action=SupprimerCompteEleve" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Supprimer un compte élève</a></li>
							</ul>
						</div>
						
						<div data-role="collapsible" >
							<h3 data-mini="true">Gérer les comptes administrateurs...</h3>
							<ul data-role="listview" data-inset="true">
								<li><a href="index.php?action=CreerCompteAdmin" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Créer un compte administrateur</a></li>
								<li><a href="index.php?action=ModifierCompteAdmin" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Modifier un compte administrateur</a></li>
								<li><a href="index.php?action=SupprimerCompteAdmin" data-mini="true" data-role="button" data-ajax="false" data-transition="<?php echo $transition; ?>">Supprimer un compte administrateur</a></li>
							</ul>
						</div>
					</div>	
					<?php } ?>
				
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