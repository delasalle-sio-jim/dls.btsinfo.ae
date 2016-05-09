<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Administrateur.class.php
// Rôle : la classe Administrateur représente les administrateurs de l'application
// Création : 6/11/2015 par JM CARTRON
// Mise à jour : 9/5/2016 par JM CARTRON

// inclusion de la classe Outils
include_once ('Outils.class.php');

class Administrateur
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;				// identifiant de l'administrateur
	private $adrMail;			// adresse mail (utilisée comme login)
	private $motDePasse;		// mot de passe (hashé en SHA1 dans la BDD)
	private $prenom;			// prénom
	private $nom;				// nom
	
	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function Administrateur($unId, $uneAdrMail, $unMotDePasse, $unPrenom, $unNom) {
		$this->id = $unId;
		$this->adrMail = $uneAdrMail;
		$this->motDePasse = $unMotDePasse;
		$this->prenom = Outils::corrigerPrenom($unPrenom);
		$this->nom = strtoupper($unNom);
	}

	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}

	public function getAdrMail() {return $this->adrMail;}
	public function setAdrMail($uneAdrMail) {$this->adrMail = $uneAdrMail;}
	
	public function getMotDePasse() {return $this->motDePasse;}
	public function setMotDePasse($unMotDePasse) {$this->motDePasse = $unMotDePasse;}

	public function getPrenom() {return $this->prenom;}
	public function setPrenom($unPrenom) {$this->prenom = Outils::corrigerPrenom($unPrenom);}

	public function getNom() {return $this->nom;}
	public function setNom($unNom) {$this->nom = strtoupper($unNom);}

	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function toString() {
		$msg  = 'Administrateur : <br>';
		$msg .= 'id : ' . $this->getId() . '<br>';
		$msg .= 'adrMail : ' . $this->getAdrMail() . '<br>';
		$msg .= 'motDePasse : ' . $this->getMotDePasse() . '<br>';
		$msg .= 'prenom : ' . $this->getPrenom() . '<br>';
		$msg .= 'nom : ' . $this->getNom() . '<br>';
		
		return $msg;
	}
		
} // fin de la classe Administrateur

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!