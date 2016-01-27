<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueModifFichePerso.php : visualiser la vue de modification d'un utilisateur qui modifie sa propre fiche perso
	// Ecrit le 11/01/2016 par Nicolas esteve
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
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
					<li><a href="index.php?action=Menu">Retour au Menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
		
		<div id="content">
			 		
			<h2>Modification de votre compte</h2>
			
			<p>Vous pouvez modifier les informations liées à votre compte.</p>
			
			 
			<h3>Entrez les données que vous voulez modifier de votre profil :</h3>
			
		<form name="form1" id="form1" action="index.php?action=ModifFichePerso" method="post">

				<p>
					<label for="txtNom">Nom (de naissance) :</label>
					<input type="text" name="txtNom" id="txtNom" maxlength="30" value="<?php echo $nom; ?>" />
				</p>
				<p>
					<label for="txtPrenom">Prénom :</label>
					<input type="text" name="txtPrenom" id="txtPrenom" maxlength="30" value="<?php echo $prenom; ?>" />
				</p>
				<p>
					<label for="txtAnneeDebutBTS">Année d'entrée en BTS :</label>
					<input type="text" name="txtAnneeDebutBTS" id="txtAnneeDebutBTS" maxlength="4" pattern="^[0-9]{4}$" value="<?php echo $anneeDebutBTS; ?>" />
				</p>
				<p>
					<label for="txtTel">Téléphone :</label>
					<input type="text" name="txtTel" id="txtTel" maxlength="14" pattern="^([0-9]{2}( |-|\.)?){4}[0-9]{2}$" value="<?php echo $tel; ?>" />
				</p>
				<p>
					<label for="txtRue">Rue :</label>
					<input type="text" name="txtRue" id="txtRue" maxlength="80" value="<?php echo $rue; ?>" />
				</p>						
				<p>
					<label for="txtCodePostal">Code postal :</label>
					<input type="text" name="txtCodePostal" id="txtCodePostal" maxlength="5" pattern="^[0-9]{5}$" value="<?php echo $codePostal; ?>" />
				</p>
				<p>
					<label for="txtVille">Ville :</label>
					<input type="text" name="txtVille" id="txtVille" maxlength="30" value="<?php echo $ville; ?>" />
				</p>
				<p>
					<label for="txtEtudesPostBTS">Etudes post BTS :</label>
					<textarea rows="2" name="txtEtudesPostBTS" id="txtEtudesPostBTS" maxlength="150"><?php echo $etudesPostBTS; ?></textarea>
				</p>
				<p>
					<label for="txtEntreprise">Entreprise actuelle :</label>
					<input type="text" name="txtEntreprise" id="txtEntreprise" maxlength="50" value="<?php echo $entreprise; ?>" />
				</p>						
				<p>
					<label for="listeFonctions">Fonction actuelle :</label>
					
					<select size="1" name="listeFonctions" id="listeFonctions">
						<?php foreach ($lesFonctions as $uneFonction) { ?>
							<option value="<?php echo $uneFonction->getId(); ?>" <?php if ($idFonction == $uneFonction->getId()) echo 'selected="selected"'; ?>><?php echo $uneFonction->getLibelle(); ?></option>
						<?php } ?>				
					</select>
				</p>						
				<p>
					<input type="submit" value="Envoyer les données" name="btnModifier" id="btnModifier" />
				</p>
			</form>
		</div>
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>	
	</div>
		
	</div>
	
	<aside id="affichage_message" class="classe_message">
		<div>
			<h2 id="titre_message" class="classe_information">Message</h2>
			<p id="texte_message" class="classe_texte_message">Texte du message</p>
			<a href="#close" title="Fermer">Fermer</a>
		</div>
	</aside>
	</body>
	