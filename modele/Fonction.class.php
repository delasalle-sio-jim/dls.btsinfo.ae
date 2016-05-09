<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Fonction.class.php
// Rôle : la classe Fonction représente les fonctions que peuvent occuper les anciens élèves en entreprise
// Création : 5/11/2015 par JM CARTRON
// Mise à jour : 5/5/2016 par JM CARTRON

class Fonction
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;				// identifiant de la fonction
	private $libelle;			// libelle de la fonction

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function Fonction($unId, $unLibelle) {
		$this->id = $unId;
		$this->libelle = $unLibelle;
	}

	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}
	
	public function getLibelle()	{return $this->libelle;}
	public function setLibelle($unLibelle) {$this->libelle = $unLibelle;}

	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function toString() {
		$msg = 'Fonction : <br>';
		$msg .= 'id : ' . $this->getId() . '<br>';
		$msg .= 'libelle : ' . $this->getLibelle() . '<br>';

		return $msg;
	}
		
} // fin de la classe Fonction

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!