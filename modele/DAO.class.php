<?php
// -------------------------------------------------------------------------------------------------------------------------
//                                          Projet DLS - BTS Info - Anciens élèves
//                                                 DAO : Data Access Object
//                             Cette classe fournit des méthodes d'accès à la bdd anciensEtudiants
//                                                 Elle utilise l'objet PDO
//                       Auteur : JM Cartron                       Dernière modification : 14/03/2016
//						 Participation de : Nicolas Esteve
// -------------------------------------------------------------------------------------------------------------------------

// ATTENTION : la position des méthodes dans ce fichier est identique à la position des tests dans la classe DAO.test.php

// liste des méthodes de cette classe (dans l'ordre d'apparition dans la classe) :

// __construct                   : le constructeur crée la connexion $cnx à la base de données
// __destruct                    : le destructeur ferme la connexion $cnx à la base de données

// getLesFonctions() : array
//   fournit la liste des fonctions que peut occuper un ancien élève ; le résultat est fourni sous forme d'une collection d'objets Fonction

// getTypeUtilisateur($uneAdrMail, $unMdp) : Chaine
//   permet d'authentifier un utilisateur ; retourne 'inconnu' ou 'eleve' ou 'administrateur'

// existeAdrMail($uneAdrMail) : booléen
//   fournit true si l'adresse mail ($adrMail) existe dans la table ae_eleves, false sinon

// creerCompteEleve($unEleve) : booléen
//   enregistre l'élève dans la bdd et retourne true si enregistrement effectué correctement, retourne false en cas de problème

// modifierCompteEleve($unEleve) : booléen
//   modifie l'élève dans la bdd et retourne true si mise à jour effectuée correctement, retourne false en cas de problème

// getEleve($parametre) : Eleve
//   recherche et fournit un objet Eleve à partir de son identifiant ou de son adresse mail
//   fournit la valeur null si le paramètre n'existe pas ou est incorrect

// getLesEleves() : array
//   fournit la liste de tous les élèves ; le résultat est fourni sous forme d'une collection d'objets Eleve

// getLesAdressesMails() : array
//   fournit la liste de toutes les adresses mails des eleves ; le résultat est fourni sous forme d'une collection d'adresses mails

// supprimerCompteEleve($parametre) : booléen
//   supprime un compte Eleve (ainsi que ses inscriptions s'il en a) à partir de son identifiant ou de son adresse mail
//   retourne true si enregistrement supprimé correctement, retourne false en cas de problème

// validerCreationCompte($idCompte, $decision) : booléen
//   enregistre dans la bdd l'acceptation ou le rejet d'une demande de création de compte élève
//   le paramètre $decision doit être égal à "acceptation" ou à "rejet"

// modifierMdpEleve($adrMail, $nouveauMdp) : booléen
//   enregistre le nouveau mot de passe de l'élève dans la bdd après l'avoir hashé en SHA1

// envoyerMdp($adrMail, $nouveauMdp) : booléen
//   envoie un mail à l'utilisateur avec son nouveau mot de passe ; retourne true si envoi correct, false en cas de problème d'envoi

// creerCompteAdministrateur($unAdministrateur) : booléen
//   enregistre l'administrateur dans la bdd et retourne true si enregistrement effectué correctement, retourne false en cas de problème

// getAdministrateur($parametre) : Administrateur
//   recherche et fournit un objet Administrateur à partir de son identifiant ou de son adresse mail
//   fournit la valeur null si le paramètre n'existe pas ou est incorrect

// supprimerCompteAdministrateur($parametre) : booléen
//    supprime un compte Administrateur à partir de son identifiant ou de son adresse mail
//    retourne true si enregistrement supprimé correctement, retourne false en cas de problème

// modifierMdpAdministrateur($adrMail, $nouveauMdp) : booléen
//   enregistre le nouveau mot de passe de l'administrateur dans la bdd après l'avoir hashé en SHA1

// getSoiree($relire) : Soiree
//   fournit un objet Soiree qui contient tous les détails concernant la PROCHAINE soirée
//   le paramètre "relire" permet de tester si les données ont déjà été lues et stockées en variable de session
//   si "relire" est égal à true, on relit la bdd et on recharge la variable de session

// modifierSoiree($uneSoiree) : booléen
//   modifie une soirée dans la bdd et retourne true si mise à jour effectuée correctement, retourne false en cas de problème

// creerInscription($uneInscription) : booléen
//   enregistre une inscription dans la bdd et retourne true si enregistrement effectué correctement, retourne false en cas de problème

// getInscription($idInscription) : Inscription
//   fournit un objet Inscription à partir de son identifiant ; fournit la valeur null si l'identifiant n'existe pas

// getInscriptionEleve($idEleve) : id de l'inscription ou  null
//   fournit si l'élève a déjà effectué une inscription 
//   renvoie null si l'inscription est inexistante
//	 renvoie l'id de l'inscription sinon

// getLesInscription() : array
//	 fournit la liste de toutes les inscriptions à la soirée des anciens élèves
//	 le résultat est fourni sous forme de collection d'inscriptions

// modifierInscription($uneInscription) : booléen
//   modifie l'inscription dans la bdd et retourne true si mise à jour effectuée correctement, retourne false en cas de problème

// getIdInscription($idEleve) : entier
//   fournit l'identifiant de l'inscription à partir de l'identifiant de l'élève
//   fournit la valeur -1 si aucune inscription ou si l'identifiant élève n'existe pas

// annulerInscription($idInscription) : booléen
//   annule une inscription dans la bdd et retourne true si enregistrement effectué correctement, retourne false en cas de problème

// getLesAdressesMailsDesInscrits() : array
//   fournit la liste de toutes les adresses mails des élèves inscrits à la soirée
//   le résultat est fourni sous forme d'une collection d'adresses mails



// méthode prévue mais non écrite /////////////////////////////////////////////////////////////////
// estInscritAlaProchaineSoiree ($uneAdrMail) : bool


// certaines méthodes nécessitent les fichiers suivants :
include_once ('Fonction.class.php');
include_once ('Eleve.class.php');
include_once ('Administrateur.class.php');
include_once ('Soiree.class.php');
include_once ('Inscription.class.php');
include_once ('Outils.class.php');

// inclusion des paramètres de l'application
//include_once ('parametres.free.php');
include_once ('parametres.localhost.php');

// début de la classe DAO (Data Access Object)
class DAO
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
		
	private $cnx;				// la connexion à la base de données
	
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Constructeur et destructeur ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	// le constructeur crée la connexion $cnx à la base de données
	public function __construct() {
		global $PARAM_HOTE, $PARAM_PORT, $PARAM_BDD, $PARAM_USER, $PARAM_PWD;
		try
		{	$this->cnx = new PDO ("mysql:host=" . $PARAM_HOTE . ";port=" . $PARAM_PORT . ";dbname=" . $PARAM_BDD,
							$PARAM_USER,
							$PARAM_PWD);
			return true;
		}
		catch (Exception $ex)
		{	echo ("Echec de la connexion a la base de donnees <br>");
			echo ("Erreur numero : " . $ex->getCode() . "<br />" . "Description : " . $ex->getMessage() . "<br>");
			echo ("PARAM_HOTE = " . $PARAM_HOTE);
			return false;
		}
	}
	
	// le destructeur ferme la connexion $cnx à la base de données
	public function __destruct() {
		unset($this->cnx);
	}

	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------

	// fournit la liste des fonctions que peut occuper un ancien élève
	// le résultat est fourni sous forme d'une collection d'objets Fonction
	// modifié par Jim le 9/11/2015
	public function getLesFonctions()
	{	// préparation de la requete de recherche
		$txt_req = "Select id, libelle from ae_fonctions order by id";
		
		$req = $this->cnx->prepare($txt_req);
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		
		// construction d'une collection d'objets Fonction
		$lesFonctions = array();
		// tant qu'une ligne est trouvée :
		while ($uneLigne)
		{	// création d'un objet Fonction
			$unId = utf8_encode($uneLigne->id);
			$unLibelle = utf8_encode($uneLigne->libelle);
			
			$uneFonction = new Fonction($unId, $unLibelle);
			// ajout de la fonction à la collection
			$lesFonctions[] = $uneFonction;
			// extrait la ligne suivante
			$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		}
		// libère les ressources du jeu de données
		$req->closeCursor();
		// fourniture de la collection
		return $lesFonctions;
	}	
	
	// fournit le type d'un utilisateur identifié par $adrMail et $motDePasse
	// renvoie "eleve" ou "administrateur" si authentification correcte, "inconnu" sinon
	// modifié par Jim le 16/11/2015
	public function getTypeUtilisateur($adrMail, $motDePasse)
	{	// préparation de la requête de recherche dans la table ae_eleves
		$txt_req = "Select count(*) from ae_eleves where adrMail = :adrMail and motDePasse = :motDePasseChiffre and compteAccepte = 1";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de ses paramètres
		$req->bindValue("adrMail", $adrMail, PDO::PARAM_STR);
		$req->bindValue("motDePasseChiffre", sha1($motDePasse), PDO::PARAM_STR);
		// extraction des données et comptage des réponses
		$req->execute();
		$nbReponses = $req->fetchColumn(0);
		// libère les ressources du jeu de données
		$req->closeCursor();		
		// fourniture de la réponse
		if ($nbReponses == 1) return "eleve";

		// préparation de la requête de recherche dans la table ae_administrateurs
		$txt_req = "Select count(*) from ae_administrateurs where adrMail = :adrMail and motDePasse = :motDePasseCrypte";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de ses paramètres
		$req->bindValue("adrMail", $adrMail, PDO::PARAM_STR);
		$req->bindValue("motDePasseCrypte", sha1($motDePasse), PDO::PARAM_STR);
		// extraction des données et comptage des réponses
		$req->execute();
		$nbReponses = $req->fetchColumn(0);
		// libère les ressources du jeu de données
		$req->closeCursor();
		// fourniture de la réponse
		if ($nbReponses == 1) return "administrateur";		

		// si on arrive ici, c'est que l'authentification est incorrecte
		return "inconnu";
	}	

	// fournit true si l'adresse mail ($adrMail) existe dans la table ae_eleves, false sinon
	// modifié par Jim le 12/11/2015
	public function existeAdrMail($adrMail)
	{	// préparation de la requete de recherche
		$txt_req = "Select count(*) from ae_eleves where adrMail = :adrMail";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de ses paramètres
		$req->bindValue("adrMail", $adrMail, PDO::PARAM_STR);
		// exécution de la requete
		$req->execute();
		$nbReponses = $req->fetchColumn(0);
		// libère les ressources du jeu de données
		$req->closeCursor();
		
		// fourniture de la réponse
		if ($nbReponses == 0)
			return false;
		else
			return true;
	}

	// enregistre l'élève dans la bdd et retourne true si enregistrement effectué correctement, retourne false en cas de problème
	// modifié par Jim le 15/11/2015
	public function creerCompteEleve ($unEleve)
	{	// préparation de la requête
		$txt_req = "insert into ae_eleves (nom, prenom, sexe, anneeDebutBTS, tel, adrMail, rue, codePostal, ville, entreprise, compteAccepte, motDePasse, etudesPostBTS, dateDerniereMAJ, idFonction)";
		$txt_req .= " values (:nom, :prenom, :sexe, :anneeDebutBTS, :tel, :adrMail, :rue, :codePostal, :ville, :entreprise, :compteAccepte, :motDePasse, :etudesPostBTS, :dateDerniereMAJ, :idFonction)";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de ses paramètres
		$req->bindValue("nom", utf8_decode($unEleve->getNom()), PDO::PARAM_STR);
		$req->bindValue("prenom", utf8_decode($unEleve->getPrenom()), PDO::PARAM_STR);
		$req->bindValue("sexe", utf8_decode($unEleve->getSexe()), PDO::PARAM_STR);
		$req->bindValue("anneeDebutBTS", utf8_decode($unEleve->getAnneeDebutBTS()), PDO::PARAM_STR);
		$req->bindValue("tel", utf8_decode($unEleve->getTel()), PDO::PARAM_STR);
		$req->bindValue("adrMail", utf8_decode($unEleve->getAdrMail()), PDO::PARAM_STR);
		$req->bindValue("rue", utf8_decode($unEleve->getRue()), PDO::PARAM_STR);
		$req->bindValue("codePostal", utf8_decode($unEleve->getCodePostal()), PDO::PARAM_STR);
		$req->bindValue("ville", utf8_decode($unEleve->getVille()), PDO::PARAM_STR);
		$req->bindValue("entreprise", utf8_decode($unEleve->getEntreprise()), PDO::PARAM_STR);
		$req->bindValue("compteAccepte", utf8_decode($unEleve->getCompteAccepte()), PDO::PARAM_INT);
		// ATTENTION : le mot de passe est hashé en sha1 avant l'enregistrement dans la bdd
		$req->bindValue("motDePasse", utf8_decode(sha1($unEleve->getMotDePasse())), PDO::PARAM_STR);
		$req->bindValue("etudesPostBTS", utf8_decode($unEleve->getEtudesPostBTS()), PDO::PARAM_STR);
		$req->bindValue("dateDerniereMAJ", utf8_decode($unEleve->getDateDerniereMAJ()), PDO::PARAM_STR);
		$req->bindValue("idFonction", utf8_decode($unEleve->getIdFonction()), PDO::PARAM_INT);
		// exécution de la requête
		$ok = $req->execute();
		return $ok;
	}	

	// modifie l'élève dans la bdd et retourne true si mise à jour effectuée correctement, retourne false en cas de problème
	// créé par Nicolas Esteve  le XX/01/2016
	// modifié par Jim le 13/05/2016
	public function modifierCompteEleve($unEleve)
	{
		// préparation de la requête
		$txt_req = "UPDATE ae_eleves SET ";
		$txt_req .= " nom = :nom,";
		$txt_req .= " prenom = :prenom,";
		$txt_req .= " sexe = :sexe,";
		$txt_req .= " anneeDebutBTS = :anneeDebutBTS,";
		$txt_req .= " tel = :tel,";
		$txt_req .= " rue = :rue,";
		$txt_req .= " codePostal = :codePostal,";
		$txt_req .= " ville = :ville,";
		$txt_req .= " entreprise = :entreprise,";
		$txt_req .= " idFonction = :idFonction,";
		$txt_req .= " etudesPostBTS = :etudesPostBTS,";
		$txt_req .= " dateDerniereMAJ = :dateDerniereMAJ";
		$txt_req .= " WHERE adrMail = :adrMail;";	
		$req = $this->cnx->prepare($txt_req);
	
		// liaison de la requête et de ses paramètres
		$req->bindValue("nom", utf8_decode($unEleve->getNom()), PDO::PARAM_STR);
		$req->bindValue("prenom", utf8_decode($unEleve->getPrenom()), PDO::PARAM_STR);
		$req->bindValue("sexe", utf8_decode($unEleve->getSexe()), PDO::PARAM_STR);
		$req->bindValue("anneeDebutBTS", utf8_decode($unEleve->getAnneeDebutBTS()), PDO::PARAM_STR);
		$req->bindValue("tel", utf8_decode($unEleve->getTel()), PDO::PARAM_STR);
		$req->bindValue("adrMail", utf8_decode($unEleve->getAdrMail()), PDO::PARAM_STR);
		$req->bindValue("rue", utf8_decode($unEleve->getRue()), PDO::PARAM_STR);
		$req->bindValue("codePostal", utf8_decode($unEleve->getCodePostal()), PDO::PARAM_STR);
		$req->bindValue("ville", utf8_decode($unEleve->getVille()), PDO::PARAM_STR);
		$req->bindValue("entreprise", utf8_decode($unEleve->getEntreprise()), PDO::PARAM_STR);
		$req->bindValue("etudesPostBTS", utf8_decode($unEleve->getEtudesPostBTS()), PDO::PARAM_STR);
		$req->bindValue("dateDerniereMAJ", utf8_decode(date('Y-m-d H:i:s', time())), PDO::PARAM_STR);
		$req->bindValue("idFonction", utf8_decode($unEleve->getIdFonction()), PDO::PARAM_INT);
	
		// exécution de la requête
		$ok = $req->execute();
		return $ok;
	}
	
	// recherche et fournit un objet Eleve à partir de son identifiant ou de son adresse mail
	// fournit la valeur null si le paramètre n'existe pas ou est incorrect
	// modifié par Jim le 16/11/2015
	public function getEleve($parametre)
	{	// si le paramètre n'est ni un nombre entier, ni une adresse mail, on retourne la valeur null
		if ( ! Outils::estUnEntierValide($parametre) && ! Outils::estUneAdrMailValide($parametre) ) return null;
		
		// préparation de la requete de recherche
		if (Outils::estUnEntierValide($parametre)) $txt_req = "Select * from ae_eleves where id = :parametre";
		if (Outils::estUneAdrMailValide($parametre)) $txt_req = "Select * from ae_eleves where adrMail = :parametre";
		
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de son paramètre
		if (Outils::estUnEntierValide($parametre)) $req->bindValue("parametre", $parametre, PDO::PARAM_INT);
		if (Outils::estUneAdrMailValide($parametre)) $req->bindValue("parametre", $parametre, PDO::PARAM_STR);
		
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		// libère les ressources du jeu de données
		$req->closeCursor();
		
		// traitement de la réponse
		if ( ! $uneLigne)
			return null;
		else
		{	// création d'un objet Eleve
			$id = utf8_encode($uneLigne->id);
			$nom = utf8_encode($uneLigne->nom);
			$prenom = utf8_encode($uneLigne->prenom);
			$sexe = utf8_encode($uneLigne->sexe);
			$anneeDebutBTS = utf8_encode($uneLigne->anneeDebutBTS);
			$tel = utf8_encode($uneLigne->tel);
			$adrMail = utf8_encode($uneLigne->adrMail);
			$rue = utf8_encode($uneLigne->rue);
			$codePostal = utf8_encode($uneLigne->codePostal);
			$ville = utf8_encode($uneLigne->ville);
			$entreprise = utf8_encode($uneLigne->entreprise);
			$compteAccepte = utf8_encode($uneLigne->compteAccepte);
			$motDePasse = utf8_encode($uneLigne->motDePasse);
			$etudesPostBTS = utf8_encode($uneLigne->etudesPostBTS);
			$dateDerniereMAJ = utf8_encode($uneLigne->dateDerniereMAJ);
			$idFonction = utf8_encode($uneLigne->idFonction);			
					
			$unEleve = new Eleve($id, $nom, $prenom, $sexe, $anneeDebutBTS, $tel, $adrMail, $rue, $codePostal, 
				$ville, $entreprise, $compteAccepte, $motDePasse, $etudesPostBTS, $dateDerniereMAJ, $idFonction);
			return $unEleve;
		}
	}

	// fournit la liste de tous les élèves
	// le résultat est fourni sous forme d'une collection d'objets Eleve
	// créé par Nicolas Esteve le XX/01/2016
	// modifié par Jim le 13/5/2016
	public function getLesEleves()
	{	// préparation de la requete de recherche
		$txt_req = "Select * from ae_eleves order by id";
		
		$req = $this->cnx->prepare($txt_req);
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		
		// construction d'une collection d'objets Eleve
		$lesEleves = array();
		// tant qu'une ligne est trouvée :
		while ($uneLigne)
		{
			// création d'un objet Eleve
			$id = utf8_encode($uneLigne->id);
			$nom = utf8_encode($uneLigne->nom);
			$prenom = utf8_encode($uneLigne->prenom);
			$sexe = utf8_encode($uneLigne->sexe);
			$anneeDebutBTS = utf8_encode($uneLigne->anneeDebutBTS);
			$tel = utf8_encode($uneLigne->tel);
			$adrMail = utf8_encode($uneLigne->adrMail);
			$rue = utf8_encode($uneLigne->rue);
			$codePostal = utf8_encode($uneLigne->codePostal);
			$ville = utf8_encode($uneLigne->ville);
			$entreprise = utf8_encode($uneLigne->entreprise);
			$compteAccepte = utf8_encode($uneLigne->compteAccepte);
			$motDePasse = utf8_encode($uneLigne->motDePasse);
			$etudesPostBTS = utf8_encode($uneLigne->etudesPostBTS);
			$dateDerniereMAJ = utf8_encode($uneLigne->dateDerniereMAJ);
			$idFonction = utf8_encode($uneLigne->idFonction);
		
			$unEleve = new Eleve($id, $nom, $prenom, $sexe, $anneeDebutBTS, $tel, $adrMail, $rue, $codePostal,
					$ville, $entreprise, $compteAccepte, $motDePasse, $etudesPostBTS, $dateDerniereMAJ, $idFonction);
				
			// ajout de l'élève à la collection
			$lesEleves[] = $unEleve;
			// extrait la ligne suivante
			$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		}
		// libère les ressources du jeu de données
		$req->closeCursor();
		// fourniture de la collection
		return $lesEleves;
	}

	// fournit la liste de toutes les adresses mails des eleves
	// le résultat est fourni sous forme d'une collection d'adresses mails
	// créé par Nicolas Esteve le XX/01/2016
	// modifié par Jim le 13/05/2016
	public function getLesAdressesMails()
	{	// préparation de la requete de recherche
		$txt_req = "Select adrMail from ae_eleves order by adrMail";
		
		$req = $this->cnx->prepare($txt_req);
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		
		// construction d'une collection d'adresses mail
		$lesMails = array();
		// tant qu'une ligne est trouvée :
		while ($uneLigne)
		{	$unMail = utf8_encode($uneLigne->adrMail);
			$lesMails[] = $unMail;
				
			// extrait la ligne suivante
			$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		}
		// libère les ressources du jeu de données
		$req->closeCursor();
		// fourniture de la collection
		return $lesMails;
	}
	
	// supprime un compte Eleve (ainsi que ses inscriptions s'il en a) à partir de son identifiant ou de son adresse mail
	// retourne true si enregistrement supprimé correctement, retourne false en cas de problème
	// modifié par Nicolas Esteve  le XX/01/2016
	// modifié par Jim le 11/5/2016
	public function supprimerCompteEleve($parametre)
	{	$unEleve = $this->getEleve($parametre);
		// si le paramètre est incorrect ou inexistant, on retourne la valeur FALSE
		if ( $unEleve == null ) return FALSE;
		
		// préparation de la requete de suppression des inscriptions de l'élève à supprimer
		$txt_req_inscriptions = "Delete from ae_inscriptions where idEleve = :idEleve";
		$req1 = $this->cnx->prepare($txt_req_inscriptions);	
		// liaison de la requête et de son paramètre
		$req1->bindValue("idEleve", $unEleve->getId(), PDO::PARAM_INT);
		// exécution de la requete
		$ok = $req1->execute();
		
		// préparation de la requete de suppression de l'élève
		$txt_req_eleve = "Delete from ae_eleves where id = :idEleve";
		$req2 = $this->cnx->prepare($txt_req_eleve);	
		// liaison de la requête et de son paramètre
		$req2->bindValue("idEleve", $unEleve->getId(), PDO::PARAM_INT);
		// exécution de la requete
		$ok = $req2->execute();
		
		return $ok;
	}
		
	// enregistre dans la bdd l'acceptation ou le rejet d'une demande de création de compte élève
	// le paramètre $decision doit être égal à "acceptation" ou à "rejet"
	// modifié par Jim le 16/11/2015
	public function validerCreationCompte($idCompte, $decision)
	{	// vérification de la décision
		if ($decision != 'acceptation' && $decision != 'rejet' ) return null;
		
		// préparation de la requete
		if ($decision == 'acceptation') $txt_req = "update ae_eleves set compteAccepte = true where id = :idcompte";
		if ($decision == 'rejet') $txt_req = "update ae_eleves set compteAccepte = false where id = :idcompte";		
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de ses paramètres
		$req->bindValue("idcompte", $idCompte, PDO::PARAM_INT);
		// exécution de la requete
		$ok = $req->execute();
		return $ok;
	}
	
	// enregistre le nouveau mot de passe de l'élève dans la bdd après l'avoir hashé en SHA1
	// modifié par Jim le 24/11/2015
	public function modifierMdpEleve($adrMail, $nouveauMdp)
	{	// préparation de la requête
		$txt_req = "update ae_eleves set motDePasse = :nouveauMdp where adrMail = :adrMail";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de ses paramètres
		$req->bindValue("nouveauMdp", sha1($nouveauMdp), PDO::PARAM_STR);
		$req->bindValue("adrMail", $adrMail, PDO::PARAM_STR);
		// exécution de la requete
		$ok = $req->execute();
		return $ok;
	}
	
	// envoie un mail à l'utilisateur avec son nouveau mot de passe
	// retourne true si envoi correct, false en cas de problème d'envoi
	// modifié par Jim le 12/05/2016
	public function envoyerMdp($adrMail, $nouveauMdp)
	{	global $ADR_MAIL_EMETTEUR;
		// si l'adresse mail n'est pas dans la table ae_eleves :
		if ( ! $this->existeAdrMail($adrMail) ) return false;
		
		// envoie un mail à l'utilisateur avec son nouveau mot de passe
		$sujet = "Modification de votre mot de passe d'accès à l'annuaire des anciens élèves du Lycée De La Salle";
		$message = "Votre mot de passe d'accès à l'annuaire des anciens élèves du Lycée De La Salle a été modifié.\n\n";
		$message .= "Votre nouveau mot de passe est : " . $nouveauMdp;
		$ok = Outils::envoyerMail ($adrMail, $sujet, $message, $ADR_MAIL_EMETTEUR);
		return $ok;
	}	

	// enregistre l'administrateur dans la bdd et retourne true si enregistrement effectué correctement, retourne false en cas de problème
	// créé par Nicolas Esteve  le XX/01/2016
	// modifié par Jim le 12/5/2016
	public function creerCompteAdministrateur($unAdministrateur)
	{	// préparation de la requete
		$txt_req = "insert into ae_administrateurs (adrMail, motDePasse, prenom, nom) values (:adrMail, :mdp, :prenom, :nom)";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de ses paramètres
		$req->bindValue("adrMail", utf8_decode($unAdministrateur->getAdrMail()), PDO::PARAM_STR);
		// ATTENTION : le mot de passe est hashé en sha1 avant l'enregistrement dans la bdd
		$req->bindValue("mdp", utf8_decode(sha1($unAdministrateur->getMotDePasse())), PDO::PARAM_STR);
		$req->bindValue("prenom", utf8_decode($unAdministrateur->getPrenom()), PDO::PARAM_STR);
		$req->bindValue("nom", utf8_decode(strtoupper($unAdministrateur->getNom())), PDO::PARAM_STR);
		//execution de la requete
		$ok = $req->execute();
		return $ok;
	}
	
	// modifie l'admnistrateur dans la bdd et retourne true si mise à jour effectuée correctement, retourne false en cas de problème
	// créé par Killian BOUTIN le 24/05/2016
	// ----------------------------------------   getAdrMail() NE FONCTIONNE PAS   -----------------------------------------------
	public function modifierCompteAdmin($unAdministrateur)
	{
		// préparation de la requête
		$txt_req = "UPDATE ae_administrateurs SET ";
		$txt_req .= " nom = :nom,";
		$txt_req .= " prenom = :prenom";
		$txt_req .= " WHERE adrMail = :adrMail;";
		//echo $txt_req;
		
		$req = $this->cnx->prepare($txt_req);
	
		// liaison de la requête et de ses paramètres
		$req->bindValue("nom", utf8_decode($unAdministrateur->getNom()), PDO::PARAM_STR);
		$req->bindValue("prenom", utf8_decode($unAdministrateur->getPrenom()), PDO::PARAM_STR);
		$req->bindValue("adrMail", utf8_decode($unAdministrateur->getAdrMail()), PDO::PARAM_STR);
	
		// exécution de la requête
		$ok = $req->execute();
		return $ok;
	}
	
	// fournit un objet Administrateur à partir de son identifiant ou de son adresse mail
	// fournit la valeur null si le paramètre n'existe pas ou est incorrect
	// modifié par Jim le 23/11/2015
	public function getAdministrateur($parametre)
	{	// si le paramètre n'est ni un nombre entier, ni une adresse mail, on retourne la valeur null
		if ( ! Outils::estUnEntierValide($parametre) && ! Outils::estUneAdrMailValide($parametre) ) return null;
		
		// préparation de la requete de recherche
		if (Outils::estUnEntierValide($parametre)) $txt_req = "Select * from ae_administrateurs where id = :parametre";
		if (Outils::estUneAdrMailValide($parametre)) $txt_req = "Select * from ae_administrateurs where adrMail = :parametre";
		
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de son paramètre
		if (Outils::estUnEntierValide($parametre)) $req->bindValue("parametre", $parametre, PDO::PARAM_INT);
		if (Outils::estUneAdrMailValide($parametre)) $req->bindValue("parametre", $parametre, PDO::PARAM_STR);
		
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		// libère les ressources du jeu de données
		$req->closeCursor();
		
		// traitement de la réponse
		if ( ! $uneLigne)
			return null;
		else
		{	// création d'un objet Eleve
			$id = utf8_encode($uneLigne->id);
			$nom = utf8_encode($uneLigne->nom);
			$prenom = utf8_encode($uneLigne->prenom);
			$adrMail = utf8_encode($uneLigne->adrMail);
			$motDePasse = utf8_encode($uneLigne->motDePasse);
			
			$unAdministrateur = new Administrateur($id, $adrMail, $motDePasse, $prenom, $nom);
			return $unAdministrateur;
		}
	}	

	// supprime un compte Administrateur à partir de son identifiant ou de son adresse mail
	// retourne true si enregistrement supprimé correctement, retourne false en cas de problème
	// modifié par Nicolas Esteve  le XX/01/2016
	// modifié par Jim le 12/5/2016
	public function supprimerCompteAdministrateur($parametre)
	{	$unAdministrateur = $this->getAdministrateur($parametre);
		// si le paramètre est incorrect ou inexistant, on retourne la valeur FALSE
		if ( $unAdministrateur == null ) return FALSE;
		
		// préparation de la requete de suppression
		$txt_req = "Delete from ae_administrateurs where id = :idAdministrateur";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de son paramètre
		$req->bindValue("idAdministrateur", $unAdministrateur->getId(), PDO::PARAM_INT);
		// exécution de la requete
		$ok = $req->execute();
		
		return $ok;
	}

	// enregistre le nouveau mot de passe de l'administrateur dans la bdd après l'avoir hashé en SHA1
	// modifié par Nicolas Esteve  le XX/01/2016
	// modifié par Jim le 13/5/2016
	public function modifierMdpAdministrateur($adrMail, $nouveauMdp)
	{	// préparation de la requête
		$txt_req = "update ae_administrateurs set motDePasse = :nouveauMdp where adrMail = :adrMail";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de ses paramètres
		$req->bindValue("nouveauMdp", sha1($nouveauMdp), PDO::PARAM_STR);
		$req->bindValue("adrMail", $adrMail, PDO::PARAM_STR);
		// exécution de la requete
		$ok = $req->execute();
		return $ok;
	}

	// fournit un objet Soiree qui contient tous les détails concernant la PROCHAINE soirée (un seul enregistrement dans la table ae_soirees)
	// le résultat est fourni sous forme d'un objet Soiree
	// le paramètre "relire" permet de tester si les données ont déjà été lues et stockées en variable de session
	// si "relire" est égal à true, on relit la bdd et on recharge la variable de session
	// créé par Nicolas Esteve le XX/01/2016
	// modifié par Jim le 13/05/2016
	public function getSoiree($relire)
	{
		if ( isset($_SESSION['Soiree']) == true && $relire == false)
		{
			// la fonction unserialise sert à convertir la variable de session (de type chaine) en un objet Soiree
			$uneSoiree = unserialize($_SESSION['Soiree']);
			return $uneSoiree;
		}
		else
		{	// on relit la bdd et on recharge la variable de session
			// préparation de la requête
			$txt_req = "Select * from ae_soirees";
			$req = $this->cnx->prepare($txt_req);
			// exécution de la requête
			$req->execute();
			$uneLigne = $req->fetch(PDO::FETCH_OBJ);
			// si la requête ne renvoie aucune ligne
			if( ! $uneLigne)
				return null;
			else
			{	$unId = utf8_encode($uneLigne->id);
				$uneDateSoiree = utf8_encode($uneLigne->dateSoiree);
				$unNomRestaurant = utf8_encode($uneLigne->nomRestaurant);
				$uneAdresse = utf8_encode($uneLigne->adresse);
				$unTarif = utf8_encode($uneLigne->tarif);
				$unLienMenu = utf8_encode($uneLigne->lienMenu);
				$uneLatitude = utf8_encode($uneLigne->latitude);
				$uneLongitude = utf8_encode($uneLigne->longitude);
	
				$uneSoiree = new Soiree($unId, $uneDateSoiree, $unNomRestaurant, $uneAdresse, $unTarif, $unLienMenu, $uneLatitude, $uneLongitude);
				// la fonction serialise sert à convertir l'objet Soiree en une chaine de caratères afin de la mettre dans une variable de session
				$_SESSION['Soiree'] = serialize($uneSoiree);
				// on retourne l'objet Soiree
				return $uneSoiree;
			}
		}
	}	

	// modifie une soirée dans la bdd et retourne true si mise à jour effectuée correctement, retourne false en cas de problème
	// créé par Nicolas Esteve le XX/01/2016
	// modifié par Jim le 13/05/2016
	public function modifierSoiree($uneSoiree)
	{
		// préparation de la requête
		$txt_req = "UPDATE ae_soirees SET";
		$txt_req .= " dateSoiree = :dateSoiree,";
		$txt_req .= " nomRestaurant = :nomRestaurant,";
		$txt_req .= " adresse = :adresse,";
		$txt_req .= " tarif = :tarif,";
		$txt_req .= " lienMenu = :lienMenu,";
		$txt_req .= " latitude = :latitude,";
		$txt_req .= " longitude = :longitude";
		$txt_req .= " WHERE id = :id;";

		$req = $this->cnx->prepare($txt_req);
		
		// liaison de la requête et de ses paramètres
		$req->bindValue("dateSoiree", Outils::convertirEnDateUS($uneSoiree->getDateSoiree()), PDO::PARAM_STR);
		$req->bindValue("nomRestaurant",  utf8_decode($uneSoiree->getNomRestaurant()), PDO::PARAM_STR);
		$req->bindValue("adresse",utf8_decode($uneSoiree->getAdresse()), PDO::PARAM_STR);
		$req->bindValue("tarif" , utf8_decode($uneSoiree->getTarif()), PDO::PARAM_STR);
		$req->bindValue("lienMenu", utf8_decode($uneSoiree->getLienMenu()), PDO::PARAM_STR);
		$req->bindValue("latitude" , utf8_decode($uneSoiree->getLatitude()), PDO::PARAM_STR);
		$req->bindValue("longitude", utf8_decode($uneSoiree->getLongitude()), PDO::PARAM_STR);
		$req->bindValue("id", utf8_decode($uneSoiree->getId()), PDO::PARAM_STR);
		
		// exécution de la requête
		$ok = $req->execute();
		return $ok;
	}	

	// enregistre une inscription dans la bdd et retourne true si enregistrement effectué correctement, retourne false en cas de problème
	// créé par Nicolas Esteve  le XX/01/2016
	
	public function creerInscription($uneInscription)
	{	// préparation de la requête
		$txt_req = "Insert Into ae_inscriptions (dateInscription, nbrePersonnes, montantRegle, montantRembourse, idEleve, idSoiree, inscriptionAnnulee)";
		$txt_req .= " values (:dateInscription, :nbrePersonnes, :montantRegle, :montantRembourse, :idEleve, :idSoiree, :inscriptionAnnulee);";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de ses paramètres
		$req->bindValue("dateInscription", Outils::convertirEnDateUS($uneInscription->getDateInscription()), PDO::PARAM_STR);
		$req->bindValue("nbrePersonnes",  utf8_decode($uneInscription->getNbrePersonnes()), PDO::PARAM_INT);
		$req->bindValue("montantRegle",  utf8_decode($uneInscription->getMontantRegle()), PDO::PARAM_INT);
		$req->bindValue("montantRembourse",  utf8_decode($uneInscription->getMontantRembourse()), PDO::PARAM_INT);
		$req->bindValue("idEleve",  utf8_decode($uneInscription->getIdEleve()), PDO::PARAM_INT);
		$req->bindValue("idSoiree",  utf8_decode($uneInscription->getIdSoiree()), PDO::PARAM_INT);
		$req->bindValue("inscriptionAnnulee",  utf8_decode($uneInscription->getInscriptionAnnulee()), PDO::PARAM_INT);
		// exécution de la requête
		$ok = $req->execute();
		return $ok;
	}

	// fournit un objet Inscription à partir de son identifiant
	// fournit la valeur null si l'identifiant n'existe pas
	// créé par Jim le 13/05/2016
	
	public function getInscription($idInscription)
	{	// préparation de la requête
		$txt_req = "Select * from ae_inscriptions where id = :idInscription";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de son paramètre
		$req->bindValue("idInscription", $idInscription, PDO::PARAM_INT);
		
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		// libère les ressources du jeu de données
		$req->closeCursor();
		
		// traitement de la réponse
		if ( ! $uneLigne)
			return null;
		else
		{	// création d'un objet Inscription
			$unId = utf8_encode($uneLigne->id);
			$dateInscription = utf8_encode(Outils::convertirEnDateFR($uneLigne->dateInscription));
			$unNbrePersonnes = utf8_encode($uneLigne->nbrePersonnes);
			$montantRegle = utf8_encode($uneLigne->montantRegle);
			$montantRembourse = utf8_encode($uneLigne->montantRembourse);
			$idEleve = utf8_encode($uneLigne->idEleve);
			$idSoiree = utf8_encode($uneLigne->idSoiree);
			$inscriptionAnnulee = utf8_encode($uneLigne->inscriptionAnnulee);
							
			$uneInscription = new Inscription($unId, $dateInscription, $unNbrePersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee);
			return $uneInscription;
		}
	}
	
	// fournit si l'élève a déjà effectué une inscription 
	// renvoie null si l'inscription est inexistante
	// renvoie l'id de l'inscription sinon
	// créé par Killian BOUTIN  le 26/05/2016
	
	public function getInscriptionEleve($idEleve)
	{	// préparation de la requête
	$txt_req = "Select * from ae_inscriptions where idEleve = :idEleve";
	$req = $this->cnx->prepare($txt_req);
	// liaison de la requête et de son paramètre
	$req->bindValue("idEleve", $idEleve, PDO::PARAM_INT);
	
	// extraction des données
	$req->execute();
	$uneLigne = $req->fetch(PDO::FETCH_OBJ);
	// libère les ressources du jeu de données
	$req->closeCursor();
	
	// traitement de la réponse
	if ( ! $uneLigne)
		return null;
	else{
		return $uneLigne->id;
	}
	}
		
	// fournit toutes les inscriptions (non annulées) de la BDD
	// créé par Killian BOUTIN le 25/05/2016
	// modifié par Killian BOUTIN le 26/05/2016
	
	public function getLesInscriptions()
	{	// préparation de la requête d'extraction des inscriptions non annulées
		// le GROUP BY permet de ne retenir qu'un seul exemplaire des inscriptions pour chaque membre au cas où il y aurait des doublons. 
		// |=> A supprimer quand on aura modifié le fait qu'une 2ème inscription supprime la première
		$txt_req = "SELECT nom, prenom, anneeDebutBTS, ae_soirees.tarif , ae_inscriptions.id, dateInscription, nbrePersonnes, montantRegle, montantRembourse, idEleve, idSoiree, inscriptionAnnulee";
		$txt_req .= " FROM ae_eleves, ae_inscriptions, ae_soirees"; 
		$txt_req .= " WHERE ae_eleves.id = ae_inscriptions.idEleve";
		$txt_req .= " AND inscriptionAnnulee = 0";
		$txt_req .=	" GROUP BY ae_eleves.nom, ae_eleves.prenom";	// à supprimer plus tard !
		$txt_req .=	" ORDER BY nom, prenom";
		$req = $this->cnx->prepare($txt_req);
		
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);

		// construction d'une collection d'objets Inscription
		$lesInscriptions = array();
		
		// tant qu'une ligne est trouvée :
		while ($uneLigne)
			{	// création d'un objet Inscription
				$unId = utf8_encode($uneLigne->id);
				$unNom = utf8_encode($uneLigne->nom);
				$unPrenom = utf8_encode($uneLigne->prenom);
				$anneeDebutBTS = utf8_encode($uneLigne->anneeDebutBTS);
				$dateInscription = utf8_encode($uneLigne->dateInscription);
				$unNbrePersonnes = utf8_encode($uneLigne->nbrePersonnes);
				$montantRegle = utf8_encode($uneLigne->montantRegle);
				$montantRembourse = utf8_encode($uneLigne->montantRembourse);
				$idEleve = utf8_encode($uneLigne->idEleve);
				$idSoiree = utf8_encode($uneLigne->idSoiree);
				$inscriptionAnnulee = utf8_encode($uneLigne->inscriptionAnnulee);
				$unTarif = utf8_encode($uneLigne->tarif);
				
				$uneInscription = new Inscription($unId, $unNom, $unPrenom, $anneeDebutBTS, $dateInscription, $unNbrePersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee, $unTarif);
				// ajout de l'inscription à la collection
				$lesInscriptions[] = $uneInscription;
				// extraction de la ligne suivante
				$uneLigne = $req->fetch(PDO::FETCH_OBJ);
			}
		// libère les ressources du jeu de données
		$req->closeCursor();
		
		return $lesInscriptions;
	}
	
	// modifie l'inscription dans la bdd et retourne true si mise à jour effectuée correctement, retourne false en cas de problème
	// créé par Nicolas Esteve  le XX/01/2016
	// modifié par Jim le 13/05/2016
	public function modifierInscription($uneInscription)
	{	// préparation de la requête
		$txt_req = "UPDATE ae_inscriptions SET ";
		$txt_req .= " dateInscription = :dateInscription,";
		$txt_req .= " nbrePersonnes = :nbrePersonnes,";
		$txt_req .= " montantRegle = :montantRegle,";
		$txt_req .= " montantRembourse = :montantRembourse,";
		$txt_req .= " inscriptionAnnulee = :inscriptionAnnulee,";
		$txt_req .= " idEleve = :idEleve,";
		$txt_req .= " idSoiree = :idSoiree";
		$txt_req .= " WHERE id = :id";
		
		$req = $this->cnx->prepare($txt_req);
		
		// liaison de la requête et de ses paramètres
		$req->bindValue("id",  utf8_decode($uneInscription->getId()), PDO::PARAM_INT);
		$req->bindValue("dateInscription",  Outils::convertirEnDateUS($uneInscription->getDateInscription()), PDO::PARAM_STR);
		$req->bindValue("nbrePersonnes",  utf8_decode($uneInscription->getNbrePersonnes()), PDO::PARAM_INT);
		$req->bindValue("montantRegle",  utf8_decode($uneInscription->getMontantRegle()), PDO::PARAM_INT);
		$req->bindValue("montantRembourse",  utf8_decode($uneInscription->getMontantRembourse()), PDO::PARAM_INT);
		$req->bindValue("idEleve",  utf8_decode($uneInscription->getIdEleve()), PDO::PARAM_INT);
		$req->bindValue("idSoiree",  utf8_decode($uneInscription->getIdSoiree()), PDO::PARAM_INT);
		$req->bindValue("inscriptionAnnulee",  utf8_decode($uneInscription->getInscriptionAnnulee()), PDO::PARAM_INT);
	
		// exécution de la requête
		$ok = $req->execute();
		return $ok;
	}	

	// fournit l'identifiant de l'inscription à partir de l'identifiant de l'élève
	// fournit la valeur -1 si aucune inscription ou si l'identifiant élève n'existe pas
	// créé par Jim le 13/05/2016
	public function getIdInscription($idEleve)
	{	// préparation de la requête
		$txt_req = "Select id from ae_inscriptions where idEleve = :idEleve";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de son paramètre
		$req->bindValue("idEleve", $idEleve, PDO::PARAM_INT);
		
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		// libère les ressources du jeu de données
		$req->closeCursor();
		
		// traitement de la réponse
		if ( ! $uneLigne)
			return -1;
		else
			return $uneLigne->id;
	}	
	
	// annule une inscription dans la bdd et retourne true si enregistrement effectué correctement, retourne false en cas de problème
	// créé par Nicolas Esteve  le XX/01/2016
	// modifié par Jim le 13/5/2016
	public function annulerInscription($idInscription)
	{	// préparation de la requête
		$txt_req = "Update ae_inscriptions SET inscriptionAnnulee = 1 where id = :idInscription;";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de son paramètre
		$req->bindValue("idInscription",  utf8_decode($idInscription), PDO::PARAM_STR);
		// exécution de la requête
		$ok = $req->execute();
		return $ok;
	}	
	
	// fournit la liste de toutes les adresses mails des élèves inscrits à la soirée
	// le résultat est fourni sous forme d'une collection d'adresses mails
	// créé par Nicolas Esteve le XX/01/2016
	// modifié par Jim le 13/5/2016
	function getLesAdressesMailsDesInscrits()
	{	// préparation de la requête
		$txt_req = "SELECT adrMail FROM ae_eleves, ae_inscriptions WHERE ae_eleves.id = ae_inscriptions.idEleve ORDER BY adrMail";
		$req = $this->cnx->prepare($txt_req);
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		
		// construction d'une collection d'adresses mails
		$lesAdressesMails = array();
		// tant qu'une ligne est trouvée :
		while ($uneLigne)
		{	$uneAdrMail = utf8_encode($uneLigne->adrMail);
			$lesAdressesMails[] = $uneAdrMail;
			
			// extrait la ligne suivante
			$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		}
		// libère les ressources du jeu de données
		$req->closeCursor();
		// retourne la collection
		return $lesAdressesMails;
	}	
	
	
	
	
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// fonction qui sert a s'inscrire à la soirée
	// fournit la valeur null si le paramètre n'existe pas ou est incorrect
	// créé par Nicolas Esteve le XX/01/2016
	// ATTENTION : cette fonction est à priori inutile ; utiliser de préférence creerInscription et modifierInscription ? (Jim)
	function inscription($dateInscription,$nbPersonnes,$montant,$montantRembourse,$idEleve,$idSoiree)
	{
		$txt_req ="Select * from ae_inscriptions where id = :idEleve";
		$req = $this->cnx->prepare($txt_req);
		$req->bindValue("idEleve",  utf8_decode($idEleve), PDO::PARAM_STR);
		$ok = $req->execute();
		//creation de la requete
		if(!empty ($ok))
		{
			$txt_req ="Update ae_inscriptions SET nbrePersonnes = :nbPersonnes where idEleve=:idEleve;";
			//preparation de la requete
			$req = $this->cnx->prepare($txt_req);
			//remplissage de la variable
			$req->bindValue("nbPersonnes",  utf8_decode($nbPersonnes), PDO::PARAM_STR);
			$req->bindValue("idEleve",  utf8_decode($idEleve), PDO::PARAM_STR);
		}
		else
		{
			$txt_req = "Insert Into ae_inscriptions(dateInscription,nbrePersonnes,montantRegle,montantRembourse,idEleve,idSoiree) values (:dateInscription,:nbPersonnes,:montant,:montantRembourse,:idEleve,:idSoiree);";
			//preparation de la requete
			$req = $this->cnx->prepare($txt_req);
			//remplissage de la variable
			$req->bindValue("dateInscription",  utf8_decode($dateInscription), PDO::PARAM_STR);
			$req->bindValue("nbPersonnes",  utf8_decode($nbPersonnes), PDO::PARAM_STR);
			$req->bindValue("montant",  utf8_decode($montant), PDO::PARAM_STR);
			$req->bindValue("montantRembourse",  utf8_decode($montantRembourse), PDO::PARAM_STR);
			$req->bindValue("idEleve",  utf8_decode($idEleve), PDO::PARAM_STR);
			$req->bindValue("idSoiree",  utf8_decode($idSoiree), PDO::PARAM_STR);
		}
	
		$ok = $req->execute();
		return $ok;
	}
	
	// fonction qui permet a un utilisateur de modifier les donnée d'un compte utilisateur
	// fournit la valeur null si le paramètre n'existe pas ou est incorrect
	// créé par Nicolas Esteve  le XX/01/2016
	// ATTENTION : cette fonction est-elle vraiment utile car elle est presque identique à la fonction modifierCompteEleve ? (Jim)
	public function modifierFicheUser($nom,$prenom,$anneeDebutBTS,$mail,$telephone,$rue,$ville,$cp,$etudes,$entreprise,$fonction,$oldMail)
	{
		// mise en forme des variables
		$telephone = Outils::corrigerTelephone($telephone);
		$nom = strtoupper($nom);
		$prenom = Outils::corrigerPrenom($prenom);
		$ville = Outils::corrigerVille($ville);
	
		
		// préparations de la requete
		$txt_req = "UPDATE ae_eleves SET ";
		$txt_req .= " nom = :nom,";
		$txt_req .= " prenom = :prenom,";
		$txt_req .= " anneeDebutBTS = :anneeDebutBTS,";
		$txt_req .= " tel = :tel,";
		$txt_req .= " codePostal = :cp,";
		$txt_req .= " ville = :ville,";
		$txt_req .= " rue = :rue,";
		$txt_req .= " entreprise = :entreprise,";
		$txt_req .= " idFonction = :fonction,";
		$txt_req .= " etudesPostBTS = :etudes,";
		$txt_req .= " adrMail = :mail";
		$txt_req .= " WHERE adrMail = :oldMail;";
	
	
	
		$req = $this->cnx->prepare($txt_req);
	
		//remplissage des variables
		$req->bindValue("nom", utf8_decode($nom), PDO::PARAM_STR);
		$req->bindValue("prenom", utf8_decode($prenom), PDO::PARAM_STR);
		$req->bindValue("anneeDebutBTS", utf8_decode($anneeDebutBTS), PDO::PARAM_STR);
		$req->bindValue("tel", utf8_decode($telephone), PDO::PARAM_STR);
		$req->bindValue("cp", utf8_decode($cp), PDO::PARAM_STR);
		$req->bindValue("ville", utf8_decode($ville), PDO::PARAM_STR);
		$req->bindValue("rue", utf8_decode($rue), PDO::PARAM_STR);
		$req->bindValue("entreprise", utf8_decode($entreprise), PDO::PARAM_STR);
		$req->bindValue("fonction", utf8_decode($fonction), PDO::PARAM_INT);
		$req->bindValue("etudes", utf8_decode($etudes), PDO::PARAM_STR);
		$req->bindValue("mail", utf8_decode($mail), PDO::PARAM_STR);
		$req->bindValue("oldMail", utf8_decode($oldMail), PDO::PARAM_STR);
		
	
		$ok = $req->execute();//execution de la requete
	
		if($ok)
		{
			$txt_req = "Update ae_eleves SET dateDerniereMAJ = :date where adrMail = :mail";
			$req = $this->cnx->prepare($txt_req);
			$date = date('Y-m-d H:i:s', time());
			$req->bindValue("mail", $mail, PDO::PARAM_STR);//remplissage de la variable
			$req->bindValue("date", $date, PDO::PARAM_STR);//remplissage de la variable
			$ok = $req->execute();//execution de la requete
		}
		return $ok;
	
	}

	// fournit un objet Inscription à partir de l'identifiant de l'élève
	// fournit l'objet null si aucune inscription ou si l'identifiant élève n'existe pas
	// créé par Nicolas Esteve  le XX/01/2016
	// modifié par Jim le 13/5/2016
	// ATTENTION : cette fonction est à priori inutile ; utiliser de préférence getIdInscription suivi de getInscription ? (Jim)
	function detailsInscription($idEleve)
	{	// préparation de la requête
		$txt_req = "Select * FROM ae_inscriptions where idEleve = :idEleve;";
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de son paramètre
		$req->bindValue("idEleve",  utf8_decode($idEleve), PDO::PARAM_STR);
		// exécution de la requête
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		// libère les ressources du jeu de données
		$req->closeCursor();
		if( ! $uneLigne )
			return null;
		else 
			{	// création d'un objet Inscription
			$unId = utf8_encode($uneLigne->id);
			$dateInscription = utf8_encode(Outils::convertirEnDateFR($uneLigne->dateInscription));
			$unNbrePersonnes = utf8_encode($uneLigne->nbrePersonnes);
			$montantRegle = utf8_encode($uneLigne->montantRegle);
			$montantRembourse = utf8_encode($uneLigne->montantRembourse);
			$idEleve = utf8_encode($uneLigne->idEleve);
			$idSoiree = utf8_encode($uneLigne->idSoiree);
			$inscriptionAnnulee = utf8_encode($uneLigne->inscriptionAnnulee);
							
			$uneInscription = new Inscription($unId, $dateInscription, $unNbrePersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee);
			return $uneInscription;
		}
	}
			
} // fin de la classe DAO

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!