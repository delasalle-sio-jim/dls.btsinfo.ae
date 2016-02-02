<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Inscription.class.php
// Rôle : la classe Soiree représente la soiree de l'application
// Auteur : Nicolas Esteve
// Dernière mise à jour : 2/02/2016

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
	private $nbrePersonne;
	private $montantRegle;
	private $montantRembourse;
	private $idEleve;
	private $idSoiree;
	private $annule;

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function __construct($unId, $dateInscription, $unNbrePersonne, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $annule) {
		$this->id = $unId;
		$this->dateInscription = $dateInscription;
		$this->nbrePersonne = $unNbrePersonne;
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

	public function getnbrePersonne() {return $this->nbrePersonne;}
	public function setnbrePersonne($unNbrePersonne) {$this->nbrePersonne = $unNbrePersonne;}

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
		$msg .= 'nbrePersonne : ' . $this->getnbrePersonne() . '<br>';
		$msg .= 'montantRegle : ' . $this->getmontantRegle() . '<br>';
		$msg .= 'montantRembourse : ' . $this->getmontantRembourse() . '<br>';
		$msg .= 'idEleve : ' . $this->getidEleve() . '<br>';
		$msg .= 'idSoiree : ' . $this->getidSoiree() . '<br>';
		$msg .= 'annule : ' . $this->getannule() . '<br>';
		return $msg;
	}

} // fin de la classe Eleve

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!