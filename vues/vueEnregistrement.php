<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Synth�se des donn�es saisies</title>
		<link type="text/css" rel="stylesheet" href="styles.css" />
	</head>

	<body>
		<h4>Les donn�es suivantes ont bien �t� enregistr�es dans la base :</h4>
		<p>
		Nom : <?php echo $nom; ?><br />
		Pr�nom : <?php echo $prenom; ?><br />
		Sexe : <?php echo $sexe; ?><br />
		Situation : <?php echo $situation; ?><br />
		Date de naissance : <?php echo $dateNaissance; ?><br />
		Permis moto : <?php echo $caseMoto; ?><br />
		Permis voiture : <?php echo $caseVoiture; ?><br />
		Permis poids lourd : <?php echo $casePL; ?><br />
		Rue : <?php echo $rue; ?><br />
		Code postal : <?php echo $codePostal; ?><br />
		Ville : <?php echo $ville; ?><br />
		T�l�phone 1 : <?php echo $tel1; ?><br />
		T�l�phone 2 : <?php echo $tel2; ?><br />
		Fax : <?php echo $fax; ?><br />
		Email : <?php echo $email; ?><br />
		Exp�rience : <?php echo nl2br($experience);		// la fonction nl2br (NewLine to BReak) remplace les sauts de lignes par la balise <br /> ?><br />		
		</p>
	</body>
</html>	