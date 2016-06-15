<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Image.class.php
// Rôle : la classe Image représente les photos de la galerie des anciens 
// Création : 15/06/2016 par Killian BOUTIN

class Image
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;		// identifiant (numéro automatique dans la BDD)
	private $promo;		// année de la photo
	private $classe;	// Info 1 ou Info 2
	private $lien;		// nom de l'image dans le dossier

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function Image($unId, $unePromo, $uneClasse, $unLien) {
		$this->id = $unId;
		$this->promo = $unePromo;
		$this->classe = $uneClasse;
		$this->lien = $unLien;
	}	
	
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------

	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}
	
	public function getPromo()	{return $this->promo;}
	public function setPromo($unePromo) {$this->promo = $unePromo;}
	
	public function getClasse()	{return $this->classe;}
	public function setClasse($uneClasse) {$this->classe = $uneClasse;}
	
	public function getLien()	{return $this->lien;}
	public function setLien($unLien) {$this->lien = $unLien;}

	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------

	public function toString() {
		$msg  = 'Galerie : <br>';
		$msg .= 'id : ' . $this->getId() . '<br>';
		$msg .= 'Promo : ' . $this->getPromo() . '<br>';
		$msg .= 'Classe : ' . $this->getClasse() . '<br>';
		$msg .= 'Lien : ' . $this->getLien() . '<br>';
		return $msg;
	}

} // fin de la classe Galerie

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!