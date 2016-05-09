<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Eleve.class.php
// Rôle : la classe Eleve représente les élèves (actuels ou anciens) de l'application
// Création : 16/11/2015 par JM CARTRON
// Mise à jour : 9/5/2016 par JM CARTRON

// inclusion de la classe Fonction
include_once ('Fonction.class.php');
// inclusion de la classe Outils
include_once ('Outils.class.php');

class Eleve
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;				// identifiant de l'élève
	private $nom;				// nom de naissance
	private $prenom;			// prénom
	private $sexe;				// sexe : "H" ou "F"
	private $anneeDebutBTS;		// année d'entrée en BTS (sur 4 caractères)
	private $tel;				// numéro de téléphone (sur 14 caractères)			
	private $adrMail;			// adresse mail (utilisée comme login)
	private $rue;				// rue
	private $codePostal;		// code postal	
	private $ville;				// ville	
	private $entreprise;		// nom de l'entreprise actuelle (ou null pour les étudiants et les sans-emplois)	
	private $compteAccepte;		// false initialement, true quand le compte a été accepté	
	private $motDePasse;		// mot de passe (hashé en SHA1 dans la BDD)
	private $etudesPostBTS;		// études suivies après le BTS
	private $dateDerniereMAJ;	// date de dernière mise à jour des données par l'élève
	private $idFonction;		// l'identifiant de la fonction actuellement occupée

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------

	public function Eleve($unId, $unNom, $unPrenom, $unSexe, $uneAnneeDebutBTS, $unTel, $uneAdrMail, $uneRue, $unCodePostal,
			$uneVille, $uneEntreprise, $unCompteAccepte, $unMotDePasse, $desEtudesPostBTS, $uneDateDerniereMAJ, $unIdFonction) {
		$this->id = $unId;
		$this->nom = strtoupper($unNom);
		$this->prenom = Outils::corrigerPrenom($unPrenom);
		$this->sexe = $unSexe;
		$this->anneeDebutBTS = $uneAnneeDebutBTS;
		$this->tel = Outils::corrigerTelephone($unTel);
		$this->adrMail = $uneAdrMail;
		$this->rue = $uneRue;
		$this->codePostal = $unCodePostal;
		$this->ville = Outils::corrigerVille($uneVille);
		$this->entreprise = $uneEntreprise;
		$this->compteAccepte = $unCompteAccepte;
		$this->motDePasse = $unMotDePasse;
		$this->etudesPostBTS = $desEtudesPostBTS;
		$this->dateDerniereMAJ = $uneDateDerniereMAJ;
		$this->idFonction = $unIdFonction;
	}

	
	
	
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}

	public function getNom() {return $this->nom;}
	public function setNom($unNom) {$this->nom = strtoupper($unNom);}

	public function getPrenom() {return $this->prenom;}
	public function setPrenom($unPrenom) {$this->prenom = Outils::corrigerPrenom($unPrenom);}	

	public function getSexe() {return $this->sexe;}
	public function setSexe($unSexe) {$this->sexe = $unSexe;}

	public function getAnneeDebutBTS() {return $this->anneeDebutBTS;}
	public function setAnneeDebutBTS($uneAnneeDebutBTS) {$this->anneeDebutBTS = $uneAnneeDebutBTS;}

	public function getTel() {return $this->tel;}
	public function setTel($unTel) {$this->tel = Outils::corrigerTelephone($unTel);}
	
	public function getAdrMail() {return $this->adrMail;}
	public function setAdrMail($uneAdrMail) {$this->adrMail = $uneAdrMail;}

	public function getRue() {return $this->rue;}
	public function setRue($uneRue) {$this->rue = $uneRue;}	

	public function getCodePostal() {return $this->codePostal;}
	public function setCodePostal($unCodePostal) {$this->codePostal = $unCodePostal;}

	public function getVille() {return $this->ville;}
	public function setVille($uneVille) {$this->ville = Outils::corrigerVille($uneVille);}	

	public function getEntreprise() {return $this->entreprise;}
	public function setEntreprise($uneEntreprise) {$this->entreprise = $uneEntreprise;}	

	public function getCompteAccepte() {return $this->compteAccepte;}
	public function setCompteAccepte($unCompteAccepte) {$this->compteAccepte = $unCompteAccepte;}	

	public function getMotDePasse() {return $this->motDePasse;}
	public function setMotDePasse($unMotDePasse) {$this->motDePasse = $unMotDePasse;}	
	
	public function getEtudesPostBTS() {return $this->etudesPostBTS;}
	public function setEtudesPostBTS($desEtudesPostBTS) {$this->etudesPostBTS = $desEtudesPostBTS;}

	public function getDateDerniereMAJ() {return $this->dateDerniereMAJ;}
	public function setDateDerniereMAJ($uneDateDerniereMAJ) {$this->dateDerniereMAJ = $uneDateDerniereMAJ;}

	public function getIdFonction() {return $this->idFonction;}
	public function setIdFonction($unIdFonction) {$this->idFonction = $unIdFonction;}
		
	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function toString() {
		$msg  = 'Elève : <br>';
		$msg .= 'id : ' . $this->getId() . '<br>';
		$msg .= 'nom : ' . $this->getNom() . '<br>';
		$msg .= 'prenom : ' . $this->getPrenom() . '<br>';
		$msg .= 'sexe : ' . $this->getSexe() . '<br>';				
		$msg .= 'anneeDebutBTS : ' . $this->getAnneeDebutBTS() . '<br>';
		$msg .= 'tel : ' . $this->getTel() . '<br>';				
		$msg .= 'adrMail : ' . $this->getAdrMail() . '<br>';
		$msg .= 'rue : ' . $this->getRue() . '<br>';
		$msg .= 'codePostal : ' . $this->getCodePostal() . '<br>';		
		$msg .= 'ville : ' . $this->getVille() . '<br>';		
		$msg .= 'entreprise : ' . $this->getEntreprise() . '<br>';
		if ($this->getCompteAccepte()) $texte = "oui"; else $texte = "non";
		$msg .= 'compteAccepte : ' . $texte . '<br>';
		$msg .= 'motDePasse : ' . $this->getMotDePasse() . '<br>';
		$msg .= 'etudesPostBTS : ' . $this->getEtudesPostBTS() . '<br>';
		$msg .= 'dateDerniereMAJ : ' . $this->getDateDerniereMAJ() . '<br>';
		$msg .= 'idFonction : ' . $this->getIdFonction() . '<br>';
		return $msg;
	}
		
} // fin de la classe Eleve

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!