<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Soiree.class.php
// Rôle : la classe Soiree représente la soiree de l'application
// Auteur : Nicolas Esteve
// Dernière mise à jour : 20/01/2016

// inclusion de la classe Fonction
include_once ('Fonction.class.php');
// inclusion de la classe Outils
include_once ('Outils.class.php');

class Soiree
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;	
	private $nomRestaurant;				
	private $date;				
	private $adresse;				
	private $tarif;		
	private $lienMenu;					
	private $latitude;			
	private $longitude;				

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	public function __construct($unId, $unNomRestaurant, $uneDate, $uneAdresse, $unTarif, $unLienMenu, $uneLatitude, $uneLongitude) {
		$this->id = $unId;
		$this->nomRestaurant = $unNomRestaurant;
		$this->date = $uneDate;
		$this->adresse = $uneAdresse;
		$this->lienMenu = $unLienMenu;
		$this->tarif = $unTarif;
		$this->latitude = $uneLatitude;
		$this->longitude = $uneLongitude;
		
	}

	
	
	
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}

	public function getNomRestaurant() {return $this->nomRestaurant;}
	public function setNomRestaurant($unNomRestaurant) {$this->nomRestaurant =$unNomRestaurant;}

	public function getDate() {return $this->date;}
	public function setDate($undate) {$this->date = $undate;}	

	public function getAdresse() {return $this->adresse;}
	public function setAdresse($uneAdresse) {$this->adresse = $uneAdresse;}

	public function getLienMenu() {return $this->lienMenu;}
	public function setLienMenu($unLienMenu) {$this->lienMenu = $unLienMenu;}

	public function getTarif() {return $this->tarif;}
	public function setTarif($unTarif) {$this->tarif = $unTarif;}
	
	public function getLatitude() {return $this->latitude;}
	public function setLatitude($uneLatitude) {$this->latitude = $uneLatitude;}

	public function getLongitude() {return $this->longitude;}
	public function setLongitude($uneLongitude) {$this->longitude = $uneLongitude;}	

	
	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function toString() {
		$msg = 'id : ' . $this->getId() . '<br>';
		$msg .= 'nomRestaurant : ' . $this->getNomRestaurant() . '<br>';
		$msg .= 'date : ' . $this->getDate() . '<br>';
		$msg .= 'adresse : ' . $this->getAdresse() . '<br>';				
		$msg .= 'lienMenu : ' . $this->getLienMenu() . '<br>';
		$msg .= 'tarif : ' . $this->getTarif() . '<br>';				
		$msg .= 'latitude : ' . $this->getLatitude() . '<br>';
		$msg .= 'longitude : ' . $this->getLongitude() . '<br>';
		return $msg;
	}
		
} // fin de la classe Eleve

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!