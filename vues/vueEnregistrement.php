<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Synthèse des données saisies</title>
		<link type="text/css" rel="stylesheet" href="styles.css" />
	</head>

	<body>
		<h4>Les données suivantes ont bien été enregistrées dans la base :</h4>
		<p>
		Nom : <?php echo $nom; ?><br />
		Prénom : <?php echo $prenom; ?><br />
		Sexe : <?php echo $sexe; ?><br />
		Situation : <?php echo $situation; ?><br />
		Date de naissance : <?php echo $dateNaissance; ?><br />
		Permis moto : <?php echo $caseMoto; ?><br />
		Permis voiture : <?php echo $caseVoiture; ?><br />
		Permis poids lourd : <?php echo $casePL; ?><br />
		Rue : <?php echo $rue; ?><br />
		Code postal : <?php echo $codePostal; ?><br />
		Ville : <?php echo $ville; ?><br />
		Téléphone 1 : <?php echo $tel1; ?><br />
		Téléphone 2 : <?php echo $tel2; ?><br />
		Fax : <?php echo $fax; ?><br />
		Email : <?php echo $email; ?><br />
		Expérience : <?php echo nl2br($experience);		// la fonction nl2br (NewLine to BReak) remplace les sauts de lignes par la balise <br /> ?><br />		
		</p>
	</body>
</html>	