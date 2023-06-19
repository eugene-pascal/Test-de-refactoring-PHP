<?php

/*
 * Nom : UnIndex
 * Date : 11.09.2006/ET
 * But : Index d'UniSciences, affiche la page principale, les résultats de recherches
 * ainsi que la liste complète des unités et des personnes
 * Modifié par : Elvis P., le 14.10.2010 Ajout test sur SY_TEST pour Telux
 *               Marilyn M., le 21.02.2011 Ajout cache
 * Auteur : Johnny C.
 */

// Nous ajoutons une classe pour travailler avec des tableaux globaux
// tels que: $GLOBALS, $_REQUEST
require_once("../Bo/lib/BoUtil.php");

// Nous ajoutons une classe de simulation de requête SQL
require_once(dirname(__FILE__) . "/../Sy/lib/SySQLStmt.php");

// Obtenir le code de la langue si manqué que défini 37 (Français)
$LanCode = BoUtil::getRequest('LanCode', 37);
$LanCode = (int)$LanCode;

// Nous ajoutons une classe de texte multi-langues
require_once("../Sy/lib/SyGetTexte.php");

// Afficher le bloc html d'en-tête
require(dirname(__FILE__) . "/lib/Header.php");

// Nous ajoutons une classe de templates
require(dirname(__FILE__) . "/lib/SimpleTemplate.php");

// Nous ajoutons une classe to manage the Botext table
require_once("../Bo/lib/BoTexte.php");

// Ecran d'entrée dans UniSciences
if (($listAlias = BoUtil::getRequest('list')) === null || empty($listAlias)) {
    // exécuter les modèles de Page d'accueil
    $output = (new SimpleTemplate('index', []))->setLang($LanCode)->output();
    echo $output;
} // Affichage de la petite photo avec le bandeau à gauche
elseif (!empty($listAlias)) {
    $listAlias = strtolower($listAlias);
    // Unil en bref
    if ($listAlias === "bref") {
        // exécuter les modèles de Page d'Unisciences en bref
        $output = (new SimpleTemplate($listAlias, []))->setLang($LanCode)->output();
        echo $output;
    } // Affichage de la liste des personnes
    elseif ($listAlias === "pers") {
        // Obtenir des données de la requête SQL
        $myPers = (new SySQLStmt("./data/unpers.json"))->GetArray();
        // exécuter les modèles de Page de Liste de personnes
        $output = (new SimpleTemplate($listAlias, $myPers))->setLang($LanCode)->output();
        echo $output;
    } // Affichage de la liste des unités
    elseif ($listAlias === "unit") {
        // Obtenir des données de la requête SQL
        $myFacultArray = (new SySQLStmt("./data/facs.json"))->GetArray();
        // exécuter les modèles de Page de Liste des unités
        $output = (new SimpleTemplate($listAlias, $myFacultArray))->setLang($LanCode)->output();
        echo $output;
    }
    // Aide Unisciences
    if ($listAlias === "aide") {
        // exécuter les modèles de Page d'Aide
        $output = (new SimpleTemplate($listAlias, []))->setLang($LanCode)->output();
        echo $output;
    }
}

// Afficher le bloc HTML du pied de page
require(dirname(__FILE__) . "/lib/Footer.php");

