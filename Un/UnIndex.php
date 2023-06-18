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

require_once("../Bo/lib/BoUtil.php");
require_once(dirname(__FILE__) . "/../Sy/lib/SySQLStmt.php");

$LanCode = BoUtil::getRequest('LanCode', 37);
$LanCode = (int)$LanCode;

$Env = "&amp;LanCode=$LanCode";

require(dirname(__FILE__) . "/lib/Header.php");
require(dirname(__FILE__) . "/lib/SimpleTemplate.php");
require_once("../Bo/lib/BoTexte.php");

// Ecran d'entrée dans UniSciences
if (($listAlias = BoUtil::getRequest('list')) === null || empty($listAlias)) {
    $output = (new SimpleTemplate('index', []))->setLang($LanCode)->output();
    echo $output;
} // Affichage de la petite photo avec le bandeau à gauche
elseif (!empty($listAlias)) {
    $listAlias = strtolower($listAlias);
    // Unil en bref
    if ($listAlias === "bref") {
        $output = (new SimpleTemplate($listAlias, []))->setLang($LanCode)->output();
        echo $output;
    } // Affichage de la liste des personnes
    elseif ($listAlias === "pers") {
        $myPers = (new SySQLStmt("./data/unpers.json"))->GetArray();
        $output = (new SimpleTemplate($listAlias, $myPers))->setLang($LanCode)->output();
        echo $output;
    } // Affichage de la liste des unités
    elseif ($listAlias === "unit") {
        $myFacultArray = (new SySQLStmt("./data/facs.json"))->GetArray();
        $output = (new SimpleTemplate($listAlias, $myFacultArray))->setLang($LanCode)->output();
        echo $output;
    }
    // Aide Unisciences
    if ($listAlias === "aide") {
        $output = (new SimpleTemplate($listAlias, []))->setLang($LanCode)->output();
        echo $output;
    }
    echo "</td>\n";
}
echo "</tr>\n";
echo "</table>\n";

require(dirname(__FILE__) . "/lib/Footer.php");
?>
