<?php

// la fonction $_GET r�cup�re une donn�e pass�e en param�tre dans l'URL
// exemple d'URL utilis�e ici :
//     Formulaire.php?action=Traitement
// lors du premier appel du formulaire, ce param�tre n'existe pas
// il n'existe que lors de la validation du formulaire

if (empty ($_GET ["action"]) )
{	// c'est le premier appel du formulaire
	$premierAppel = true;
	// les champs sont vides et les styles sont � "normal"
	$nom = "" ; $class_nom = "normal";
	$prenom = "" ; $class_prenom = "normal";
	$sexe = "" ; $class_sexe = "normal";
	$situation = "" ; $class_situation = "normal";
	$dateNaissance = "" ; $class_dateNaissance = "normal";
	$caseMoto = "" ;
	$caseVoiture = "" ;
	$casePL = "" ;
	$rue = "" ; $class_rue = "normal";
	$codePostal = "" ; $class_codePostal = "normal";
	$ville = "" ; $class_ville = "normal";
	$tel1 = "" ; $class_tel1 = "normal";
	$tel2 = "" ; $class_tel2 = "normal";
	$fax = "" ; $class_fax = "normal";
	$email = "" ; $class_email = "normal";
	$experience = "" ; $class_experience = "normal";
	
	// on ne peut pas encore valider les donn�es car elles ne sont pas encore saisies				
	$ok = false;
	
	// et on place le focus sur la premi�re zone
	$instructionJS = "document.form1.txtNom.focus();";
}
else
{	// ce n'est pas le premier appel du formulaire, des donn�es ont �t� saisies et post�es
	$premierAppel = false;

	// fonctions de validation des saisies
	include ('BoiteAoutils.php');		// "include" peut �tre remplac� par "require"
	  
	// r�cup�ration des donn�es saisies dans le formulaire
	// (le tableau $_POST r�cup�re les donn�es post�es avec un formulaire)
	// (la fonction empty teste si une variable est vide)
	if  ( empty ($_POST ["txtNom"]) == true)  $nom = "";  
		else   $nom = $_POST ["txtNom"];
	if  ( empty ($_POST ["txtPrenom"]) == true)  $prenom = "";  
		else   $prenom = $_POST ["txtPrenom"];
	if  ( empty ($_POST ["radioSexe"]) == true)  $sexe = "";  
		else   $sexe = $_POST ["radioSexe"];
	if  ( empty ($_POST ["listeSituations"]) == true)  $situation = "";  
		else   $situation = $_POST ["listeSituations"];
	if  ( empty ($_POST ["txtDateNaissance"]) == true)  $dateNaissance = "";  
		else   $dateNaissance = $_POST ["txtDateNaissance"];
	if  ( empty ($_POST ["caseMoto"]) == true)  $caseMoto = "";  
		else   $caseMoto = $_POST ["caseMoto"];
	if  ( empty ($_POST ["caseVoiture"]) == true)  $caseVoiture = "";  
		else   $caseVoiture = $_POST ["caseVoiture"];
	if  ( empty ($_POST ["casePL"]) == true)  $casePL = "";  
		else   $casePL = $_POST ["casePL"];
	if  ( empty ($_POST ["txtRue"]) == true)  $rue = "";  
		else   $rue = $_POST ["txtRue"];
	if  ( empty ($_POST ["txtCodePostal"]) == true)  $codePostal = "";  
		else   $codePostal = $_POST ["txtCodePostal"];
	if  ( empty ($_POST ["txtVille"]) == true)  $ville = "";  
		else   $ville = $_POST ["txtVille"];
	if  ( empty ($_POST ["txtTel1"]) == true)  $tel1 = "";  
		else   $tel1 = $_POST ["txtTel1"];
	if  ( empty ($_POST ["txtTel2"]) == true)  $tel2 = "";  
		else   $tel2 = $_POST ["txtTel2"];
	if  ( empty ($_POST ["txtFax"]) == true)  $fax = "";  
		else   $fax = $_POST ["txtFax"];
	if  ( empty ($_POST ["txtEmail"]) == true)  $email = "";  
		else   $email = $_POST ["txtEmail"];
	if  ( empty ($_POST ["txtExperience"]) == true)  $experience = "";  
		else   $experience = $_POST ["txtExperience"];
	
	// on suppose au d�part que les donn�es sont correctes
	$ok = true;
	
	// cette variable placera le focus sur la premi�re zone � corriger
	$instructionJS = "";
		
	// test des donn�es saisies et remise en forme �ventuelle
	if ($nom == "")
	{	$ok = false;
		$class_nom = "nonRempli";
		if ($instructionJS == "") $instructionJS = "document.form1.txtNom.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	$nom = strtoupper ($nom);
		$class_nom = "normal";
	}
	
	if ($prenom == "")
	{	$ok = false;
		$class_prenom = "nonRempli";
		if ($instructionJS == "") $instructionJS = "document.form1.txtPrenom.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	$prenom = correctionPrenom ($prenom);
		$class_prenom = "normal";
	}
	
	if ($sexe == "")
	{	$ok = false;
		$class_sexe = "nonRempli";
	}
	else
	{	$class_sexe = "normal";
	}
	
	if ($situation == "")
	{	$ok = false;
		$class_situation = "nonRempli";
		if ($instructionJS == "") $instructionJS = "document.form1.listeSituations.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	$class_situation = "normal";
	}
	
	if ($dateNaissance == "")
	{	$ok = false;
		$class_dateNaissance = "nonRempli";
		if ($instructionJS == "") $instructionJS = "document.form1.txtDateNaissance.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	if (validerUneDate ($dateNaissance) == false)
		{	$ok = false;
			$class_dateNaissance = "incorrect";
			if ($instructionJS == "") $instructionJS = "document.form1.txtDateNaissance.focus();";	// placer le focus sur la zone � corriger
		}
		else
		{	$dateNaissance = correctionDate ($dateNaissance);
			$class_dateNaissance = "normal";
		}
	}
	
	if ($rue == "")
	{	$ok = false;
		$class_rue = "nonRempli";
		if ($instructionJS == "") $instructionJS = "document.form1.txtRue.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	$class_rue = "normal";
	}
	
	if ($codePostal == "")
	{	$ok = false;
		$class_codePostal = "nonRempli";
		if ($instructionJS == "") $instructionJS = "document.form1.txtCodePostal.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	if (validerUnCodePostal ($codePostal) == false)
		{	$ok = false;
			$class_codePostal = "incorrect";
			if ($instructionJS == "") $instructionJS = "document.form1.txtCodePostal.focus();";	// placer le focus sur la zone � corriger
		}
		else
		{	$class_name = "normal";
		}
	}
	
	if ($ville == "")
	{	$ok = false;
		$class_ville = "nonRempli";
		if ($instructionJS == "") $instructionJS = "document.form1.txtVille.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	$ville = correctionVille ($ville);
		$class_ville = "normal";
	}
	
	if ($tel1 == "")
	{	$ok = false;
		$class_tel1 = "nonRempli";
		if ($instructionJS == "") $instructionJS = "document.form1.txtTel1.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	if (validerUnNumeroTelephone ($tel1) == false)
		{	$ok = false;
			$class_tel1 = "incorrect";
			if ($instructionJS == "") $instructionJS = "document.form1.txtTel1.focus();";	// placer le focus sur la zone � corriger
		}
		else
		{	$tel1 = correctionTelephone ($tel1);
			$class_tel1 = "normal";
		}
	}
	
	if (validerUnNumeroTelephone ($tel2) == false)
	{	$ok = false;
		$class_tel2 = "incorrect";
		if ($instructionJS == "") $instructionJS = "document.form1.txtTel2.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	$tel2 = correctionTelephone ($tel2);
		$class_tel2 = "normal";
	}
	
	if (validerUnNumeroTelephone ($fax) == false)
	{	$ok = false;
		$class_fax = "incorrect";
		if ($instructionJS == "") $instructionJS = "document.form1.txtFax.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	$fax = correctionTelephone ($fax);
		$class_fax = "normal";
	}
	
	if (validerUneAdresseMail ($email) == false)
	{	$ok = false;
		$class_email = "incorrect";
		if ($instructionJS == "") $instructionJS = "document.form1.txtEmail.focus();";	// placer le focus sur la zone � corriger
	}
	else
	{	$class_email = "normal";
	}
}


if ($ok == false)
{	// si les donn�es sont incompl�tes ou incorrectes, on r�affiche le formulaire
	include ('../vues/vueFormulaire.php');
}
else
{	// si les donn�es sont correctes et compl�tes, elles vont �tre ajout�es � la base de donn�es.
	// connexion de l'application � la base MySQL
	include ('Connexion.php');
	// pr�paration d'une requ�te d'insertion
	$requete = "Insert into Stagiaires (Nom, Prenom, Sexe, Situation, DateNaissance, PermisMoto, PermisVoiture, ";
	$requete = $requete . "PermisPL, Rue, CodePostal, Ville, Tel1, Tel2, Fax, Email, Experience) values ('";
	$requete = $requete . $nom . "', '";
	$requete = $requete . $prenom . "', '";
	$requete = $requete . $sexe . "', '";
	$requete = $requete . $situation . "', '";
	$requete = $requete . dateUS($dateNaissance) . "', '";
	$requete = $requete . $caseMoto . "', '";
	$requete = $requete . $caseVoiture . "', '";
	$requete = $requete . $casePL . "', '";
	$requete = $requete . $rue . "', '";
	$requete = $requete . $codePostal . "', '";
	$requete = $requete . $ville . "', '";
	$requete = $requete . $tel1 . "', '";
	$requete = $requete . $tel2 . "', '";
	$requete = $requete . $fax . "', '";
	$requete = $requete . $email . "', '";
	$requete = $requete . $experience . "')";
	// ex�cution de la requ�te :	
	// mysql_db_query ("lycee" , $requete)  or  die ( $requete . '<br />' . mysql_error() );	
	mysql_query ($requete, $cnx)  or  die ( $requete . '<br />' . mysql_error() );	
	// fermeture :
	mysql_close ($cnx);			// ferme la connexion � MySQL
	
	// affichage d'un compte-rendu
	include ('../vues/vueEnregistrement.php');
}
?>

