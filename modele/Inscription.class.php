<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Inscription.class.php
// Rôle : la classe Inscription représente une inscription à une soirée des anciens 
// Création : 2/2/2016 par Nicolas Esteve
// Mise à jour : 27/05/2015 par Killian BOUTIN

// inclusion de la classe Outils
include_once ('Outils.class.php');

class Inscription
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;					// identifiant (numéro automatique dans la BDD)
	private $dateInscription;		// date de l'inscription
	private $nbrePersonnes;			// nombre de personnes inscrites
	private $montantRegle;			// montant réglé
	private $montantRembourse;		// montant remboursé (en cas d'annulation)
	private $idEleve;				// identifiant de l'élève inscrit
	private $idSoiree;				// identifiant de la soirée
	private $inscriptionAnnulee;	// true si inscription annulée, false par défaut
	private $nom;					// le nom de l'ancien élève inscrit
	private $prenom;				// le prénom de l'ancien élève inscrit
	private $anneeDebutBTS;			// année d'entrée en BTS (sur 4 caractères)
	private $tarif;					// tarif

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function Inscription($unId, $unNom, $unPrenom, $anneeDebutBTS, $dateInscription, $unNbrePersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee, $leTarif) {
		$this->id = $unId;
		$this->nom = strtoupper($unNom);
		$this->prenom = Outils::corrigerPrenom($unPrenom);
		$this->anneeDebutBTS = $anneeDebutBTS;
		$this->dateInscription = $dateInscription;
		$this->nbrePersonnes = $unNbrePersonnes;
		$this->montantRegle = $montantRegle;
		$this->montantRembourse = $montantRembourse;
		$this->idEleve = $idEleve;
		$this->idSoiree = $idSoiree;
		$this->inscriptionAnnulee = $inscriptionAnnulee;
		$this->tarif = $leTarif;
	}	
	
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------

	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}

	public function getDateInscription() {return $this->dateInscription;}
	public function setDateInscription($uneDateInscription) {$this->dateInscription = $uneDateInscription;}

	public function getNbrePersonnes() {return $this->nbrePersonnes;}
	public function setNbrePersonnes($unNbrePersonnes) {$this->nbrePersonnes = $unNbrePersonnes;}

	public function getMontantRegle() {return $this->montantRegle;}
	public function setMontantRegle($unMontantRegle) {$this->montantRegle = $unMontantRegle;}

	public function getMontantRembourse() {return $this->montantRembourse;}
	public function setMontantRembourse($unMontantRembourse) {$this->montantRembourse = $unMontantRembourse;}

	public function getIdEleve() {return $this->idEleve;}
	public function setIdEleve($unIdEleve) {$this->idEleve = $unIdEleve;}

	public function getIdSoiree() {return $this->idSoiree;}
	public function setIdSoiree($unIdSoiree) {$this->idSoiree = $unIdSoiree;}

	public function getInscriptionAnnulee() {return $this->inscriptionAnnulee;}
	public function setInscriptionAnnulee($inscriptionAnnulee) {$this->inscriptionAnnulee = $inscriptionAnnulee;}
	
	public function getNom() {return $this->nom;}
	public function setNom($unNom) {$this->nom = strtoupper($unNom);}
	
	public function getPrenom() {return $this->prenom;}
	public function setPrenom($unPrenom) {$this->prenom = Outils::corrigerPrenom($unPrenom);}
	
	public function getAnneeDebutBTS() {return $this->anneeDebutBTS;}
	public function setAnneeDebutBTS($uneAnneeDebutBTS) {$this->anneeDebutBTS = $uneAnneeDebutBTS;}
	
	public function getTarif() {return $this->tarif;}
	public function setTarif($leTarif) {$this->tarif = $leTarif;}


	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------

	public function toString() {
		$msg  = 'Inscription : <br>';
		$msg .= 'id : ' . $this->getId() . '<br>';
		$msg .= 'nom : ' . $this->getNom() . '<br>';
		$msg .= 'prenom : ' . $this->getPrenom() . '<br>';
		$msg .= 'anneeDebutBTS : ' . $this->getAnneeDebutBTS() . '<br>';
		$msg .= 'dateInscription : ' . $this->getDateInscription() . '<br>';
		$msg .= 'nbrePersonnes : ' . $this->getNbrePersonnes() . '<br>';
		$msg .= 'montantRegle : ' . $this->getMontantRegle() . '<br>';
		$msg .= 'montantRembourse : ' . $this->getMontantRembourse() . '<br>';
		$msg .= 'idEleve : ' . $this->getIdEleve() . '<br>';
		$msg .= 'idSoiree : ' . $this->getIdSoiree() . '<br>';
		$msg .= 'Tarif : ' . $this->getTarif() . '<br>';
		if ($this->getInscriptionAnnulee())
			$msg .= 'inscriptionAnnulee : OUI <br>';
		else
			$msg .= 'inscriptionAnnulee : NON <br>';
		return $msg;
	}

} // fin de la classe Inscription

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!