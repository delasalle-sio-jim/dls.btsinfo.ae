<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlMenu.php : traiter la demande d'accès au menu
// Ecrit le 11/11/2015 par Jim

// Ce contrôleur charge simplement la vue VueMenu.php

if ($typeUtilisateur == "eleve") include_once ($cheminDesVues . 'VueMenuEleve.php');
if ($typeUtilisateur == "administrateur") include_once ($cheminDesVues . 'VueMenuAdministrateur.php');