<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlExporterDesDonnees.php : traite la demande d'export des données présente dans la table au format .csv
// Ecrit le 01/06/2016 par Killian BOUTIN
// Modifié le 04/10/2016 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
$dao = new DAO();

$texte = "";

/*

// on crée le tableau $lesFichiers
$lesFichiers = array();


if (! isset ($_POST ["btnExporter"])) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$lienRetour = '#page_principale';	// pour le retour en version jQuery mobile
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueExporterDesDonnees.php');
}
else {
	
	if (!isset($_POST['export'])){
		$message = 'Veuillez selectionner au moins un fichier à exporter.';
		$typeMessage = 'avertissement';			// 2 valeurs possibles : 'information' ou 'avertissement'
		$lienRetour = '#page_principale';		// pour le retour en version jQuery mobile
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueExporterDesDonnees.php');
	}
	else{
		// on parcourt le tableau de checkbox 
		foreach($_POST['export'] as $value)
		{
			// on traite chaque cas, on faut des "AS" pour renommer les colonnes. Les array de $nomColonnes doivent porter les mêmes noms que les AS de $requeteSQL dans le même ordre 
			if ($value == "ElevesParPromo"){
				$nomColonnes = array("Promo","Nom","Prenom","Sexe","Telephone","Adresse Mail","Rue","Code Postal","Ville","Entreprise");
				$requeteSQL = "SELECT anneeDebutBTS AS Promo, nom AS Nom, prenom AS Prenom, sexe AS Sexe,";
				$requeteSQL .= " tel AS Telephone, adrMail AS \"Adresse Mail\", rue AS Rue, codePostal AS \"Code Postal\",";
				$requeteSQL .= " ville AS Ville, entreprise AS Entreprise";
				$requeteSQL .= " FROM ae_eleves";
				$requeteSQL .= " ORDER BY Promo, Nom, Prenom;";
				$nomFichierCSV = "ElevesParPromo";
				
				$dao->exporterEnCSV($nomColonnes, $requeteSQL, $nomFichierCSV);
				
				// on rentre une nouvelle valeur dans le tableau 
				array_push($lesFichiers, "ElevesParPromo.csv");
				
			}
			if ($value == "ElevesParNom"){
				$nomColonnes = array("Nom","Prenom","Sexe","Promo","Telephone","Adresse Mail","Rue","Code Postal","Ville","Entreprise");
				$requeteSQL = "SELECT nom AS Nom, prenom AS Prenom, sexe AS Sexe, anneeDebutBTS AS Promo,";
				$requeteSQL .= " tel AS Telephone, adrMail AS \"Adresse Mail\", rue AS Rue, codePostal AS \"Code Postal\",";
				$requeteSQL .= " ville AS Ville, entreprise AS Entreprise";
				$requeteSQL .= " FROM ae_eleves";
				$requeteSQL .= " ORDER BY Nom, Prenom";
				$nomFichierCSV = "Eleves";
				
				$dao->exporterEnCSV($nomColonnes, $requeteSQL, $nomFichierCSV);
				
				// on rentre une nouvelle valeur dans le tableau 
				array_push($lesFichiers, "Eleves.csv");
				
			}
			if ($value == "Inscrits"){
				$nomColonnes = array("Nom","Prenom","Promo","Date d'inscription","Nombre de personnes","Montant regle","Montant rembourse");
				$requeteSQL = "SELECT nom AS Nom, prenom AS Prenom, anneeDebutBTS AS Promo, dateInscription AS \"Date d'inscription\", nbrePersonnes AS \"Nombre de personnes\",";
				$requeteSQL .= " montantRegle AS \"Montant regle\", montantRembourse AS \"Montant rembourse\"";
				$requeteSQL .= " FROM ae_inscriptions, ae_eleves";
				$requeteSQL .= " WHERE ae_inscriptions.idEleve = ae_eleves.id";
				$requeteSQL .= " AND inscriptionAnnulee = 0";
				$requeteSQL .= " ORDER BY Nom, Prenom";
				$nomFichierCSV = "Inscrits";
				
				$dao->exporterEnCSV($nomColonnes, $requeteSQL, $nomFichierCSV);
				
				// on rentre une nouvelle valeur dans le tableau 
				array_push($lesFichiers, "Inscrits.csv");
				
			}
			if ($value == "NonInscrits"){
				$nomColonnes = array("Nom","Prenom","Promo","Adresse Mail");
				$requeteSQL = "SELECT nom AS Nom, prenom AS Prenom, anneeDebutBTS AS Promo, adrMail AS \"Adresse Mail\"";
				$requeteSQL .= " FROM ae_eleves WHERE ae_eleves.id NOT IN (SELECT idEleve FROM ae_inscriptions)";
				$requeteSQL .= " ORDER BY Nom, Prenom";
				$nomFichierCSV = "NonInscrits";
				
				$dao->exporterEnCSV($nomColonnes, $requeteSQL, $nomFichierCSV);
				
				// on rentre une nouvelle valeur dans le tableau 
				array_push($lesFichiers, "NonInscrits.csv");
				
			}
		}
	
	
		// On instancie la classe
		$zip = new ZipArchive();
		
		// On teste si le dossier existe
		if(is_dir('exportations/'))
	    {
	    	
	    	$name = "export.zip";
	    	// On crée le dossier export.zip qui sera proposé en téléchargement
	        if($zip->open($name, ZipArchive::CREATE) == TRUE)
	        {	
				// Pour chaque checkbox séléctionné, on ajoute le fichier correspondant au .zip
				foreach($lesFichiers as $leFichier)
				{
					// On ajoute chaque fichier à l’archive (on le nomme du même nom que dans le dossier ici)
					 $zip->addFile('exportations/'.$leFichier, $leFichier);
					// echo $leFichier.'<br>';
				}
				
				// On ferme l’archive.
				$zip->close();
				
				// Téléchargement
				// On peut ensuite, comme dans le tuto de DHKold, proposer le téléchargement.
				
				header("Content-type: application/force-download");
				header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier).
				header('Content-Disposition: attachment; filename="export.zip"'); //Nom du fichier.
				header('Content-Length: '.filesize("export.zip")); //Taille du fichier.
				
				readfile($name);
				
				// Utile pour "ZipArchive::CREATE", inutile "ZipArchive::OVERWRITE"
				// On supprime maintenant ce dossier zip
				unlink ($name);
				
	        }
	        else
	        {
	        	// Erreur lors de l’ouverture.
	        	// On peut ajouter du code ici pour gérer les différentes erreurs.
	     		echo "Erreur, impossible de créer l'archive.";
	     	}
		}
		else
		{
			echo "Le dossier \"exportations\" n'existe pas.";
		}
		
     
   		include_once ($cheminDesVues . 'VueExporterDesDonnees.php');
   		
	}
	
}

*/

include_once ($cheminDesVues . 'VueExporterDesDonnees.php');


