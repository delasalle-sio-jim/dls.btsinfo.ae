<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Inscription.class.php
// Rôle : la classe Inscription représente une inscription à une soirée des anciens 
// Création : 2/2/2016 par Nicolas Esteve
// Mise à jour : 9/5/2016 par JM CARTRON

// inclusion de la classe Fonction
include_once ('Fonction.class.php');
// inclusion de la classe Outils
include_once ('Outils.class.php');

class Inscription
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;
	private $dateInscription;
	private $nbrePersonnes;
	private $montantRegle;
	private $montantRembourse;
	private $idEleve;
	private $idSoiree;
	private $annule;

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function Inscription($unId, $dateInscription, $unNbrePersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $annule) {
		$this->id = $unId;
		$this->dateInscription = $dateInscription;
		$this->nbrePersonnes = $unNbrePersonne;
		$this->montantRegle = $montantRegle;
		$this->montantRembourse = $montantRembourse;
		$this->idEleve = $idEleve;
		$this->idSoiree = $idSoiree;
		$this->annule = $annule;

	}

	
	
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------

	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}

	public function getdateInscription() {return $this->dateInscription;}
	public function setdateInscription($uneDateInscription) {$this->dateInscription = $uneDateInscription;}

	public function getnbrePersonnes() {return $this->nbrePersonnes;}
	public function setnbrePersonnes($unNbrePersonnes) {$this->nbrePersonnes = $unNbrePersonnes;}

	public function getmontantRegle() {return $this->montantRegle;}
	public function setmontantRegle($unMontantRegle) {$this->montantRegle = $unMontantRegle;}

	public function getmontantRembourse() {return $this->montantRembourse;}
	public function setmontantRembourse($unMontantRembourse) {$this->montantRembourse = $unMontantRembourse;}

	public function getidEleve() {return $this->idEleve;}
	public function setidEleve($unIdEleve) {$this->idEleve = $unIdEleve;}

	public function getidSoiree() {return $this->idSoiree;}
	public function setidSoiree($unIdSoiree) {$this->idSoiree = $unIdSoiree;}

	public function getannule() {return $this->annule;}
	public function setannule($uneAnnule) {$this->annule = $uneAnnule;}


	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------

	public function toString() {
		$msg = 'id : ' . $this->getId() . '<br>';
		$msg .= 'dateInscription : ' . $this->getdateInscription() . '<br>';
		$msg .= 'nbrePersonnes : ' . $this->getnbrePersonnes() . '<br>';
		$msg .= 'montantRegle : ' . $this->getmontantRegle() . '<br>';
		$msg .= 'montantRembourse : ' . $this->getmontantRembourse() . '<br>';
		$msg .= 'idEleve : ' . $this->getidEleve() . '<br>';
		$msg .= 'idSoiree : ' . $this->getidSoiree() . '<br>';
		$msg .= 'annule : ' . $this->getannule() . '<br>';
		return $msg;
	}

} // fin de la classe Inscription

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!