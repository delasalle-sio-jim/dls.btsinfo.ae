<?php
// -------------------------------------------------------------------------------------------------------------------------
//                                          Projet DLS - BTS Info - Anciens élèves
//                                                 DAO : Data Access Object
//                             Cette classe fournit des méthodes d'accès à la bdd anciensEtudiants
//                                                 Elle utilise l'objet PDO
//                       Auteur : JM Cartron                       Dernière modification : 11/01/2016
//						 Participation de : Nicolas Esteve
// -------------------------------------------------------------------------------------------------------------------------

// liste des méthodes de cette classe (dans l'ordre d'apparition dans la classe) :

// __construct                   : le constructeur crée la connexion $cnx à la base de données
// __destruct                    : le destructeur ferme la connexion $cnx à la base de données
// getTypeUtilisateur ($uneAdrMail, $unMdp) : String			// retourne 'inconnu' ou 'eleve' ou 'administrateur'
// creerCompteEleve ($unEleve) : bool
// getEleve ($uneAdrMail) : Eleve
// existeAdrMail ($uneAdrMail) : bool
// envoyerNouveauMdp ($uneAdrMail, $unNouveauMdp) : bool
// modifierMdp ($uneAdrMail, $unNouveauMdp) : bool
// modifierCompteEleve ($unEleve) : bool
// supprimerCompteEleve ($unEleve) : bool
// validerCreationCompte ($uneAdrMail) : bool
// rejeterCreationCompte ($uneAdrMail) : bool
// estInscritAlaProchaineSoiree ($uneAdrMail) : bool
// getLesFonctions () : collection d'objets Fonction






// listeReservations             : fournit la liste des réservations à venir d'un utilisateur ($nomUser)
// existeReservation             : fournit true si la réservation ($idReservation) existe, false sinon
// estLeCreateur                 : teste si un utilisateur ($nomUser) est le créateur d'une réservation ($idReservation)
// getReservation                : fournit un objet Reservation à partir de son identifiant $idReservation
// getUtilisateur                : fournit un objet Utilisateur à partir de son nom $nomUser
// confirmerReservation          : enregistre la confirmation de réservation dans la bdd
// annulerReservation            : enregistre l'annulation de réservation dans la bdd
// existeUtilisateur             : fournit true si l'utilisateur ($nomUser) existe, false sinon
// modifierMdpUser               : enregistre le nouveau mot de passe de l'utilisateur dans la bdd après l'avoir hashé en MD5
// envoyerMdp                    : envoie un mail à l'utilisateur avec son nouveau mot de passe
// testerDigicodeSalle           : teste si le digicode saisi ($digicodeSaisi) correspond bien à une réservation
// testerDigicodeBatiment        : teste si le digicode saisi ($digicodeSaisi) correspond bien à une réservation de salle quelconque
// enregistrerUtilisateur        : enregistre l'utilisateur dans la bdd
// aPasseDesReservations         : recherche si l'utilisateur ($name) a passé des réservations à venir
// supprimerUtilisateur          : supprime l'utilisateur dans la bdd
//supprimerAdministrateur		 : supprime un administrateur dans la bdd a partir de son adresse mail
// creerAdministrateur			 : crée un administrateur dans la bdd


// listeSalles                   : fournit la liste des salles disponibles à la réservation

// certaines méthodes nécessitent les fichiers Fonction.class.php, Eleve.class.php, Administrateur.class.php et Outils.class.php
include_once ('Fonction.class.php');
include_once ('Eleve.class.php');
include_once ('Administrateur.class.php');
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
	
	public function __destruct() {
		unset($this->cnx);
	}

	// ------------------------------------------------------------------------------------------------------
	// -------------------------------------- Méthodes d'instances ------------------------------------------
	// ------------------------------------------------------------------------------------------------------

	// fournit la liste des fonctions que peut occuper un ancien élève
	// le résultat est fourni sous forme d'une collection d'objets Fonction
	// modifié par Jim le 9/11/2015
	function getLesFonctions()
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
	
	function getLesEleves()
	{	// préparation de la requete de recherche
	$dao = new dao();
	$txt_req = "Select id, adrMail from ae_eleves order by id";
	
	$req = $this->cnx->prepare($txt_req);
	// extraction des données
	$req->execute();
	$uneLigne = $req->fetch(PDO::FETCH_OBJ);
	
	// construction d'une collection d'objets Fonction
	$lesEleves = array();
	// tant qu'une ligne est trouvée :
	while ($uneLigne)
	{	// création d'un objet Fonction
		$unId = utf8_encode($uneLigne->id);
		$uneAdrMail = utf8_encode($uneLigne->adrMail);
		$unEleve = $dao->getEleve($unId);
			
		
		// ajout de la fonction à la collection
		$lesEleves[] = $unEleve;
		// extrait la ligne suivante
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
	}
	// libère les ressources du jeu de données
	$req->closeCursor();
	// fourniture de la collection
	return $lesEleves;
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

	// fournit un objet Eleve à partir de son identifiant ou de son adresse mail
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
	
	// enregistre l'élève dans la bdd
	// modifié par Jim le 15/11/2015
	public function creerCompteEleve ($unEleve)
	{	// préparation de la requete
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
		// exécution de la requete
		$ok = $req->execute();
		return $ok;
	}
	
	public function supprimerCompteEleve($parametre){
		//if ( ! Outils::estUnEntierValide($parametre) && ! Outils::estUneAdrMailValide($parametre) ) return null;
		
		// préparation de la requete de recherche
		//if (Outils::estUnEntierValide($parametre)) $txt_req = "Delete from ae_eleves where id = :parametre";
		if (Outils::estUneAdrMailValide($parametre)) $txt_req = "Delete from ae_eleves where adrMail = :parametre";
		
		$req = $this->cnx->prepare($txt_req);
		// liaison de la requête et de son paramètre
		//if (Outils::estUnEntierValide($parametre)) $req->bindValue("parametre", $parametre, PDO::PARAM_INT);
		if (Outils::estUneAdrMailValide($parametre)) $req->bindValue("parametre", $parametre, PDO::PARAM_STR);
		
		// extraction des données
		$ok =$req->execute();
		
		return $ok; 
	}
	
	// enregistre dans la bdd l'acceptation ou le rejet d'une demande de création de compte élève
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
	
	// enregistre le nouveau mot de passe de l'utilisateur dans la bdd après l'avoir hashé en SHA1
	// modifié par Jim le 24/11/2015
	public function modifierMdp($adrMail, $nouveauMdp)
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
	// modifié par Jim le 24/11/2015
	public function envoyerMdp($adrMail, $nouveauMdp)
	{	global $ADR_MAIL_EMETTEUR;
		// si l'adresse mail n'est pas dans la table mrbs_users :
		if ( ! $this->existeAdrMail($adrMail) ) return false;
		
		// envoie un mail à l'utilisateur avec son nouveau mot de passe
		$sujet = "Modification de votre mot de passe d'accès à l'annuaire des anciens élèves du Lycée De La Salle";
		$message = "Votre mot de passe d'accès à l'annuaire des anciens élèves du Lycée De La Salle a été modifié.\n\n";
		$message .= "Votre nouveau mot de passe est : " . $nouveauMdp;
		$ok = Outils::envoyerMail ($adrMail, $sujet, $message, $ADR_MAIL_EMETTEUR);
		return $ok;
	}	
	
	
	
	public function supprimerAdministrateur($adrMailAdmin)
	{
		if($adrMailAdmin == 'delasalle.sio.profs@gmail.com')
		{
			$ok='indestructible';
		}
		else{
		//préparation d'une requete de suppression s'un administrater en fonction de l'adresse mail mise en paramètre
	$txt_req = "DELETE from ae_administrateurs where adrMail = :adrMailAdmin";
	$req = $this->cnx->prepare($txt_req);
	$req->bindValue("adrMailAdmin", $adrMailAdmin, PDO::PARAM_STR);//remplissage de la variable
	$ok = $req->execute();//execution de la requete
		}
	return $ok;
	
	}
	
	public function creerAdministrateur($adrMailAdmin, $MdpAdmin,$nomAdmin,$prenomAdmin)
	{ 
		$txt_req = "INSERT INTO ae_administrateurs(adrMail,motDePasse ,prenom,nom) VALUES(:adrMail,:mdp,:prenom,:nom)";
		$req = $this->cnx->prepare($txt_req);
		$req->bindValue("adrMail", $adrMailAdmin, PDO::PARAM_STR);//remplissage de la variable
		$req->bindValue("prenom", $prenomAdmin, PDO::PARAM_STR);
		$req->bindValue("mdp", $MdpAdmin, PDO::PARAM_STR);
		$req->bindValue("nom", strtoupper($nomAdmin), PDO::PARAM_STR);
		$ok = $req->execute();//execution de la requete
		return $ok;
	}
	
	public function modifierMdpAdmin($adrMail, $nouveauMdp)
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
	
	public function modifierFichePerso($nom,$prenom,$anneeDebutBTS,$mail,$telephone,$rue,$ville,$cp,$etudes,$entreprise,$fonction)
	{
		$telephone = Outils::corrigerTelephone($telephone);
		$nom = strtoupper($nom);	
		$prenom = Outils::corrigerPrenom($prenom);
		$ville = Outils::corrigerVille($ville);
		
		//$txt_req = "UPDATE ae_eleves SET nom = :nom, prenom = :prenom, anneeDebutBTS = :anneeDebutBTS, tel = :tel, codePostal = :cp, ville = :ville, rue = :rue, entreprise = :entreprise, idFonction = :fonction, etudesPostBTS = :etudes WHERE adrMail = :mail;";
		

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
		$txt_req .= " etudesPostBTS = :etudes";
		$txt_req .= " WHERE adrMail = :mail;";
		

		
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
	// le parapetre fait la diffférence enter le Html et le Jquery mobile
	// la variable utilisée est le chemin dsevues
	function RechercheLesEleves()
	{	// préparation de la requete de recherche
	//	if($parametre == 'vues.jquery/')
	//	{
		$dao = new dao();
		$txt_req = "Select id, adrMail from ae_eleves order by id";
		
		$req = $this->cnx->prepare($txt_req);
		// extraction des données
		$req->execute();
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		
		// construction d'une collection d'objets Fonction
		$lesEleves = '"';
		// tant qu'une ligne est trouvée :
		while ($uneLigne)
	{	// création d'un objet Fonction
		
		$uneAdrMail = utf8_encode($uneLigne->adrMail);
	
		// ajout de la fonction à la collection
		$lesEleves .= $uneAdrMail.'","';
		// extrait la ligne suivante
		$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		}
		$lesEleves .= '"';
		// libère les ressources du jeu de données
		$req->closeCursor();
		// fourniture de la collection
		return $lesEleves;
	//	}
		//else {
		//	$dao = new dao();
		//	$txt_req = "Select id, adrMail from ae_eleves order by id";
			
		//	$req = $this->cnx->prepare($txt_req);
			// extraction des données
		//	$req->execute();
		//	$uneLigne = $req->fetch(PDO::FETCH_OBJ);
			
			// construction d'une collection d'objets Fonction
		//	$lesEleves = '"';
			// tant qu'une ligne est trouvée :
		//	while ($uneLigne)
		//	{	// création d'un objet Fonction
				
			//	$uneAdrMail = utf8_encode($uneLigne->adrMail);
				
				// ajout de la fonction à la collection
			//	$lesEleves .= '<li><a value="'.$uneAdrMail.'" onclick="submit()">'.$uneAdrMail.'</a></li>';
				// extrait la ligne suivante
			//	$uneLigne = $req->fetch(PDO::FETCH_OBJ);
		//	}
			// libère les ressources du jeu de données
		//$req->closeCursor();
			// fourniture de la collection
		//	return $lesEleves;
		//}
	}
	

	
} // fin de la classe DAO

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!