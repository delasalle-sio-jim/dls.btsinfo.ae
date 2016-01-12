<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueDemanderCreationCompte.php : visualiser la vue de création de compte élève
	// Ecrit le 12/1/2016 par Nicolas Esteve
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
					<li><a href="index.php?action=Connecter">Retour accueil</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
	<form name="form1" id="form1" action="index.php?action=SupprUserAdmin" method="post">
	<p>
					<label for="listeFonctions">Eleve actuel</label>
					
					<select size="1" name="listeEleve" id="listeEleve">
						<?php foreach ($lesEleves as $unEleve) { ?>
							<option value="<?php echo $unEleve->getId(); ?>" <?php if ($idEleve == $unEleve->getId()) echo 'selected="selected"'; ?>><?php echo $unEleve->getAdrMail(); ?></option>
						<?php } ?>				
					</select>
				</p>	
				<?php if(etape == 1)
				{?>
				<
				<p>
				<label class="label2" for="prenomAdmin">Prénom de l'administrateur:	<?php echo $unEleve->getPrenom(); ?></label>
				</p>
				
				<p>
					<label class="label2" for="nomAdmin">Nom de l'adminisrateur:	<?php echo $nomAdmin ?></label>
				</p>
				
				<p>
					<label class="label2" for="MailAdmin">Mail de l'administrateur:	<?php echo $txtMailAdmin ?></label>
				</p>
				
								
				
				
				
				
				
				
				
				
				
				
				
				
				<?php }?>			