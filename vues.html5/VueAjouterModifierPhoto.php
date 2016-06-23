<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueAjouterModifierPhoto.php : permet d'ajouter ou de modifier une photo
	// Ecrit le 16/06/2016 par Killian BOUTIN 
?>
<!doctype html>

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
			<div id="header-menu">
				<ul id="menu-horizontal">
					<li><a href="index.php?action=GererPhotos" data-ajax="false">Gérer les photos</a></li>
					<?php include_once 'ReseauxSociaux.php';?>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>Modifier la galerie photo</h2>
			
			<h3><?php echo $leTitre; ?></h3>
			
			<p>Pour la <b>photo</b>, veuillez choisir un type .png, .jpg ou .jpeg
			<p>Pour la <b>promo</b>, veuillez indiquer la première année (au mois de septembre).<br>
				Exemple : pour 2000-2001, entrez 2000.</p>
			<p>Pour la <b>classe</b>, veuillez indiquer si c'est 1<sup>ère</sup> année, 2<sup>ème</sup> année ou 3<up>ème</up> année (Post-BTS).</p>
			
			<form name="form1" id="form1" enctype="multipart/form-data" action="index.php?action=AjouterModifierPhoto&actionGalerie=<?php echo $url ?>" method="post">
				<table class="tableau">
					<!-- affichage ligne d'entête colorée en vert (success)-->
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th><?php echo $leSousTitre ?> photo de classe</th>
						</tr>
					</thead>

						<tr>
							<td style="font-weight: bold;">Photo</td>
							<td><input type="file" name="filePhoto" id="filePhoto" <?php if ($action == 'ajouter') echo 'required' ?> accept=".jpg, .jpeg, .png" style="border: 0px; margin-left: -10px;"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;">Promo</td>
							<td><input type="text" name="txtPromo" id="txtPromo" placeholder="Entrez la promo sous la forme 'jjjj'" required maxlength="4" pattern="^(19[8-9][0-9])|(20[0-9][0-9])$" value="<?php echo $unePromo; ?>" /></td>
						</tr>
						<tr>
							<td style="font-weight: bold;">Classe</td>
							<td><input type="text" name="txtClasse" id="txtClasse" placeholder="Entrez la classe (1,2 ou 3)" required maxlength="1" pattern="^(1|2|3)$" value="<?php echo $uneClasse; ?>" /></td>
						</tr>
				</table>
				<input type="submit" value="Envoyer les données" name="btnEnvoi" id="btnEnvoi" />
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