<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueMenu.php : visualiser le menu de l'élève ou de l'administrateur
	// cette vue est appelée par le lien "index.php?action=Menu"
	// la barre d'entête possède un lien de déconnexion permettant de retourner à la page de connexion
	// version de base avec une liste de boutons (critique : la liste est trop longue)
	// Ecrit le 30/12/2015 par Jim
	// Modifié le 06/06/2016 par Killian BOUTIN
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
					<?php include_once 'ReseauxSociaux.php';?>
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
					<div id="menu1" class="menu">
						<h3><a href="#menu1">Gérer mon compte...</a></h3>
						<div>
							<p><a href="index.php?action=ChangerDeMdpEleve" class="bouton-menu">Modifier mon mot de passe</a></p>
							<p><a href="index.php?action=ModifierMaFichePersoEleve" class="bouton-menu">Mettre à jour mon profil</a></p>						
						</div>
					</div>
					
					<div id="menu2" class="menu">
						<h3><a href="#menu2">La soirée annuelle des anciens...</a></h3>
						<div>
							<p><a href="index.php?action=VoirDetailsSoiree" class="bouton-menu">Consulter les infos sur la soirée</a></p>
							<?php 
								if ($dao->getInscriptionEleve($idEleve) == null AND $dao->getSoiree(true) != NULL){
							?>
							<p><a href="index.php?action=CreerMonInscription" class="bouton-menu">M'inscrire à la soirée des anciens</a></p>
							<?php 
							} ?>
							<p><a href="index.php?action=VoirListeInscritsEleve" class="bouton-menu">Consulter la liste des inscriptions</a></p>
							<?php 
								if ($dao->getInscriptionEleve($idEleve) != null AND $dao->getSoiree(true) != NULL){
							?>
							<p><a href="index.php?action=ModifierMonInscription" class="bouton-menu">Modifier ou annuler mon inscription</a></p>
							<p><a href="https://docs.google.com/forms/d/e/1FAIpQLSf4TQyA6g3B3VHK_ALFvnl6xwrDYzF_VsDC093fi8bhqHTSjQ/viewform?c=0&w=1" class="bouton-menu" target="_blank">Choisissez votre menu</a>
							<?php 
							} ?>
						</div>
					</div>
					
					<div id="menu3" class="menu">
						<h3><a href="#menu3">Le réseau des anciens élèves...</a></h3>
						<div>
							<!-- <p><a href="index.php?action=RechercherAnciens" class="bouton-menu">Rechercher d'autres anciens élèves</a></p> -->
							<p><a href="index.php?action=ProposerStage" class="bouton-menu">Proposer un stage à un étudiant</a></p>
							<p><a href="index.php?action=VoirPhotos" class="bouton-menu" target="_blank">Consulter la galerie de photos</a></p>
						</div>
					</div>
				<?php } ?>
				
				<?php if ( $typeUtilisateur == "administrateur" ) {
					// menu administrateur ?>
					<div id="menu1" class="menu">
						<h3><a href="#menu1">Gérer mon compte...</a></h3>
						<div>
							<p><a href="index.php?action=ChangerDeMdpAdmin" class="bouton-menu">Modifier mon mot de passe</a></p>
							<p><a href="index.php?action=ModifierMaFichePersoAdmin" class="bouton-menu">Mettre à jour mon profil</a></p>						
						</div>
					</div>
					
					<div id="menu2" class="menu">
						<h3><a href="#menu2">La soirée annuelle des anciens...</a></h3>
						<div>
							<p><a href="index.php?action=ModifierDetailsSoiree" class="bouton-menu">Modifier les infos sur la soirée</a></p>
							<p><a href="index.php?action=VoirListeInscritsAdmin" class="bouton-menu">Consulter la liste des inscriptions</a></p>
							<!-- <p><a href="index.php?action=EnvoyerCourriel" class="bouton-menu">Envoyer un courriel</a></p> -->
							<p><a href="index.php?action=ExporterDesDonnees" class="bouton-menu">Exporter des données</a></p>
							<p><a href="index.php?action=ModifierReglementsRemboursements" class="bouton-menu">Mettre à jour règlements et remboursements</a></p>
						</div>
					</div>
					
					<div id="menu3" class="menu">
						<h3><a href="#menu3">Le réseau des anciens élèves...</a></h3>
						<div>
							<!-- <p><a href="index.php?action=RechercherAnciens" class="bouton-menu">Rechercher d'autres anciens élèves</a></p> -->
							<p><a href="index.php?action=GererPhotos" class="bouton-menu">Gérer la galerie de photos</a></p>
						</div>
					</div>
					
					<div id="menu4" class="menu">
						<h3><a href="#menu4">Gérer les comptes élèves...</a></h3>
						<div>
							<p><a href="index.php?action=CreerCompteEleve" class="bouton-menu">Créer un compte élève</a></p>
							<p><a href="index.php?action=ModifierCompteEleve" class="bouton-menu">Modifier un compte élève</a></p>
							<p><a href="index.php?action=SupprimerCompteEleve" class="bouton-menu">Supprimer un compte élève</a></p>
						</div>
					</div>
					
					<div id="menu5" class="menu">
						<h3><a href="#menu5">Gérer les comptes administrateurs...</a></h3>
						<div>
							<p><a href="index.php?action=CreerCompteAdmin" class="bouton-menu">Créer un compte administrateur</a></p>
							<p><a href="index.php?action=ModifierCompteAdmin" class="bouton-menu">Modifier un compte administrateur</a></p>
							<p><a href="index.php?action=SupprimerCompteAdmin" class="bouton-menu">Supprimer un compte administrateur</a></p>
						</div>
					</div>
				<?php } ?>
			</div>			
		</div>
			
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>
	</div>
</body>
</html>