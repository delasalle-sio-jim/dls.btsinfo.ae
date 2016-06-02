<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlExporterDesDonnees.php : traite la demande d'export des données présente dans la table au format .csv
// Ecrit le 01/06/2016 par Killian BOUTIN
// Modifié le 02/06/2016 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
$dao = new DAO();

$texte = "";

/* on crée le tableau $lesFichiers */
$lesFichiers = array();

if (! isset ($_POST ["btnExporter"])) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueExporterDesDonnees.php');
}
else {
	
	if (isset($_POST['export'])){
		/* on parcourt le tableau de checkbox */
		foreach($_POST['export'] as $value)
		{
			/* on traite chaque cas, on faut des "AS" pour renommer les colonnes. Les array de $nomColonnes doivent porter les mêmes noms que les AS de $donneesTable dans le même ordre */
			if ($value == "ElevesParPromo"){
				$nomColonnes = array("Promo","Nom","Prenom","Sexe","Telephone","Adresse Mail","Rue","Code Postal","Ville","Entreprise");
				$donneesTable = "SELECT anneeDebutBTS AS Promo, nom AS Nom, prenom AS Prenom, sexe AS Sexe,";
				$donneesTable .= " tel AS Telephone, adrMail AS \"Adresse Mail\", rue AS Rue, codePostal AS \"Code Postal\",";
				$donneesTable .= " ville AS Ville, entreprise AS Entreprise";
				$donneesTable .= " FROM ae_eleves";
				$donneesTable .= " ORDER BY Promo, Nom, Prenom;";
				$nomFichierCSV = "ElevesParPromo";
				
				$ok1 = $dao->ExportToCSV($nomColonnes, $donneesTable, $nomFichierCSV);
				
				/* on rentre une nouvelle valeur dans le tableau */
				array_push($lesFichiers, "ElevesParPromo.csv");
				
			}
			if ($value == "ElevesParNom"){
				$nomColonnes = array("Nom","Prenom","Sexe","Promo","Telephone","Adresse Mail","Rue","Code Postal","Ville","Entreprise");
				$donneesTable = "SELECT nom AS Nom, prenom AS Prenom, sexe AS Sexe, anneeDebutBTS AS Promo,";
				$donneesTable .= " tel AS Telephone, adrMail AS \"Adresse Mail\", rue AS Rue, codePostal AS \"Code Postal\",";
				$donneesTable .= " ville AS Ville, entreprise AS Entreprise";
				$donneesTable .= " FROM ae_eleves;";
				$nomFichierCSV = "Eleves";
				
				$ok2 = $dao->ExportToCSV($nomColonnes, $donneesTable, $nomFichierCSV);
				
				/* on rentre une nouvelle valeur dans le tableau */
				array_push($lesFichiers, "Eleves.csv");
				
			}
			if ($value == "Inscrits"){
				$nomColonnes = array("Nom","Prenom","Promo","Date d'inscription","Nombre de personnes","Montant regle","Montant rembourse");
				$donneesTable = "SELECT nom AS Nom, prenom AS Prenom, anneeDebutBTS AS Promo, dateInscription AS \"Date d'inscription\", nbrePersonnes AS \"Nombre de personnes\",";
				$donneesTable .= " montantRegle AS \"Montant regle\", montantRembourse AS \"Montant rembourse\"";
				$donneesTable .= " FROM ae_inscriptions, ae_eleves";
				$donneesTable .= " WHERE ae_inscriptions.idEleve = ae_eleves.id";
				$donneesTable .= " AND inscriptionAnnulee = 0";
				$donneesTable .= " ORDER BY Nom, Prenom";
				$nomFichierCSV = "Inscrits";
				
				$ok3 = $dao->ExportToCSV($nomColonnes, $donneesTable, $nomFichierCSV);
				
				/* on rentre une nouvelle valeur dans le tableau */
				array_push($lesFichiers, "Inscrits.csv");
				
			}
			if ($value == "NonInscrits"){
				$nomColonnes = array("Nom","Prenom","Promo","Adresse Mail");
				$donneesTable = "SELECT nom AS Nom, prenom AS Prenom, anneeDebutBTS AS Promo, adrMail AS \"Adresse Mail\"";
				$donneesTable .= " FROM ae_eleves WHERE ae_eleves.id NOT IN (SELECT idEleve FROM ae_inscriptions)";
				$donneesTable .= " ORDER BY Nom, Prenom";
				$nomFichierCSV = "NonInscrits";
				
				$ok4 = $dao->ExportToCSV($nomColonnes, $donneesTable, $nomFichierCSV);
				
				/* on rentre une nouvelle valeur dans le tableau */
				array_push($lesFichiers, "NonInscrits.csv");
				
			}
		}
	}
	
	// On instancie la classe
	$zip = new ZipArchive();
	
	// On teste si le dossier existe
	if(is_dir('exportations/'))
    {
    	// On crée le dossier export.zip qui sera proposé en téléchargement
        if($zip->open('export.zip', ZipArchive::OVERWRITE) == TRUE)
        {	
			// Pour chaque checkbox séléctionné, on ajoute le fichier correspondant au .zip
			foreach($lesFichiers as $leFichier)
			{
				// On ajoute chaque fichier à l’archive (on le nomme du même nom que dans le dossier ici)
				 $zip->addFile('exportations/'.$leFichier, $leFichier);
				 echo $leFichier.'<br>';
			}
			
			// On ferme l’archive.
			$zip->close();
			
			// Téléchargement
			// On peut ensuite, comme dans le tuto de DHKold, proposer le téléchargement.
			header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier).
			header('Content-Disposition: attachment; filename="export.zip"'); //Nom du fichier.
			header('Content-Length: '.filesize('export.zip')); //Taille du fichier.
			
			readfile('export.zip');
			
			/* Utile pour "ZipArchive::CREATE" mais on utilise "ZipArchive::OVERWRITE"
			// On supprime maintenant ce dossier zip
			unlink ("export.zip");
			*/
        }
        else
        {
        	// Erreur lors de l’ouverture.
        	// On peut ajouter du code ici pour gérer les différentes erreurs.
     		echo 'Erreur, impossible de créer l&#039;archive.';
     	}
	}
	else
	{
		echo 'Le dossier &quot;exportationssio/&quot; n&#039;existe pas.';
	}
     
     include_once ($cheminDesVues . 'VueExporterDesDonnees.php');

	/*
	if ($ok) 
		{
			$message = "Modifications effectuées.";
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueExporterDesDonnees.php');
		}
		else
		{
			$message = "L\'application a rencontré un problème.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueExporterDesDonnees.php');
		}
	*/
}


