<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueDemanderCreationCompte.php : visualiser la vue de modification de compte élève par un administrateur
// Ecrit le 12/1/2016 par Nicolas Esteve
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
					<li><a href="index.php?action=menu">Retour accueil</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
		<h2>Modifier un Utilisateur</h2>
	<form name="form1" id="form1" action="index.php?action=ModifUserAdmin" method="post">
				
				<!--ceci est un prototype de liste déroulante dynamique non utilisée car trop d'objets à gerer
				<p>

					 <select size="1" onchange="submit()" name="listeEleve" id="listeEleve">
					<option value="<?php //if( isset($mail)) echo $mail ?>"><?php // if( isset($mail)) echo $mail ?></option>
					
						<?php //foreach ($lesEleves as $unEleve) { ?>
						<option value="<?php //echo $unEleve->getId()?>" <?php //if ($idEleve == $unEleve->getAdrMail()) echo 'selected="selected"'; ?>><?php //echo $unEleve->getAdrMail(); ?></option>					
						<?php //} ?>	
										
					</select>
				</p> -->
		
				<div class="ui-widget">
				<p>
					 <label for="listeEleves">Eleves: </label>
 					 <input id="listeEleves"  value="<?php if($etape == 1 ) echo $mail; else echo ''; ?>" name="listeEleves" placeholder="recherchez à l'aide de l'email de l'utilisateur">
				</p>
				
					
				<p>
					<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
				</p>	
				</div>
				

				<?php if($etape == 1)
				{?>
				
				<p>
					<label for="txtNom">Nom (de naissance) *</label>
					<input type="text" name="txtNom" id="txtNom" maxlength="30" required value="<?php echo $nom; ?>" />
				</p>
				<p>
					<label for="txtPrenom">Prénom *</label>
					<input type="text" name="txtPrenom" id="txtPrenom" maxlength="30" required value="<?php echo $prenom; ?>" />
				</p>
				<p>
					<label for="txtAnneeDebutBTS">Année d'entrée en BTS *</label>
					<input type="text" name="txtAnneeDebutBTS" id="txtAnneeDebutBTS" maxlength="4" pattern="^[0-9]{4}$" required value="<?php echo $anneeDebutBTS; ?>" />
				</p>
				<p>
					<label for="txtAdrMail">Adresse mail *</label>
					<input type="email" name="txtAdrMail" id="txtAdrMail" maxlength="50" required pattern="^.+@.+\..+$" value="<?php echo $mail; ?>" />
				</p>
				<p>
					<label for="txtTel">Téléphone</label>
					<input type="text" name="txtTel" id="txtTel" maxlength="14" pattern="^([0-9]{2}( |-|\.)?){4}[0-9]{2}$" value="<?php echo $tel; ?>" />
				</p>
				<p>
					<label for="txtRue">Rue</label>
					<input type="text" name="txtRue" id="txtRue" maxlength="80" value="<?php echo $rue; ?>" />
				</p>						
				<p>
					<label for="txtCodePostal">Code postal</label>
					<input type="text" name="txtCodePostal" id="txtCodePostal" maxlength="5" pattern="^[0-9]{5}$" value="<?php echo $codePostal; ?>" />
				</p>
				<p>
					<label for="txtVille">Ville</label>
					<input type="text" name="txtVille" id="txtVille" maxlength="30" value="<?php echo $ville; ?>" />
				</p>
				<p>
					<label for="txtEtudesPostBTS">Etudes post BTS</label>
					<textarea rows="2" name="txtEtudesPostBTS" id="txtEtudesPostBTS" maxlength="150"><?php echo $etudesPostBTS; ?></textarea>
				</p>
				<p>
					<label for="txtEntreprise">Entreprise actuelle</label>
					<input type="text" name="txtEntreprise" id="txtEntreprise" maxlength="50" value="<?php echo $entreprise; ?>" />
				</p>						
				<p>
					<label for="listeFonctions">Fonction actuelle</label>
					
					<select size="1" name="listeFonctions" id="listeFonctions">
						<?php foreach ($lesFonctions as $uneFonction) { ?>
							<option value="<?php echo $uneFonction->getId(); ?>" <?php if ($idFonction == $uneFonction->getId()) echo 'selected="selected"'; ?>><?php echo $uneFonction->getLibelle(); ?></option>
						<?php } ?>	
							
					</select>
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
			<a href="" onclick='window.location.reload(false)' title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>						