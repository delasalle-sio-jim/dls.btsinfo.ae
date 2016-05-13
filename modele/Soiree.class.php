<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Soiree.class.php
// Rôle : la classe Soiree représente la soirée annuelle des anciens élèves
// Création : 20/1/2016 par Nicolas Esteve
// Mise à jour : 13/5/2016 par JM CARTRON

class Soiree
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;				// identifiant de la soirée	
	private $dateSoiree;		// date de la soirée
	private $nomRestaurant;		// nom du restaurant	
	private $adresse;			// adresse du restaurant
	private $tarif;				// tarif
	private $lienMenu;			// lien vers une image du menu (ou vers le site du restaurant : à voir)
	private $latitude;			// coordonnées GPS pour afficher l'emplacement sur une Google Maps
	private $longitude;			// coordonnées GPS pour afficher l'emplacement sur une Google Maps				

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function Soiree($unId, $uneDateSoiree, $unNomRestaurant, $uneAdresse, $unTarif, $unLienMenu, $uneLatitude, $uneLongitude) {
		$this->id = $unId;
		$this->dateSoiree = $uneDateSoiree;
		$this->nomRestaurant = $unNomRestaurant;
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

	public function getDateSoiree() {return $this->dateSoiree;}
	public function setDateSoiree($uneDateSoiree) {$this->dateSoiree = $uneDateSoiree;}
	
	public function getNomRestaurant() {return $this->nomRestaurant;}
	public function setNomRestaurant($unNomRestaurant) {$this->nomRestaurant = $unNomRestaurant;}

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
		$msg  = 'Soirée : <br>';
		$msg .= 'id : ' . $this->getId() . '<br>';
		$msg .= 'dateSoiree : ' . $this->getDateSoiree() . '<br>';
		$msg .= 'nomRestaurant : ' . $this->getNomRestaurant() . '<br>';
		$msg .= 'adresse : ' . $this->getAdresse() . '<br>';				
		$msg .= 'lienMenu : ' . $this->getLienMenu() . '<br>';
		$msg .= 'tarif : ' . $this->getTarif() . '<br>';				
		$msg .= 'latitude : ' . $this->getLatitude() . '<br>';
		$msg .= 'longitude : ' . $this->getLongitude() . '<br>';
		return $msg;
	}
		
} // fin de la classe Soiree

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!