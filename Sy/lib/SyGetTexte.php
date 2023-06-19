<?php
// Classes pour l'affichage des texte multi-langues (nom d'attribut de table, libellé, erreurs)
// Création: Marilyn, le 12.12.2006

class SyGetTexte
{
    public $TabName;
    public $ColLib;
    public $ColAbr;
    public $ColDesc;

    public $Projet;
    public $TitreLib;
    public $TitreDesc;

    public $ErrorLib;
    public $ErrorDesc;

    /**
     * Recherche du libellé d'un champ d'une table selon la langue voulue
     *
     * @param string $ColName Nom du champ de la table
     * @param integer $LanCode Code langue
     * @param string $FieldToGet Les valeurs possibles sont (ColLib, ColAbr, ColDesc) = champs de SyAttribut
     * @param string $TabName Nom de la table
     * @param boolean $Tooltip True -> affiche un tooltip avec le cooldesc au rollover du libellé
     * @return string            retourne la valeur du champ sélectionné par $FieldToGet
     */
    public static function GetAttribut(
        $ColName,
        $FieldToGet,
        $TabName,
        $Tooltip = false,
        $jqueryTooltypePath = "../Bo/js/jquery-tooltip/"
    )
    {

        if (is_null(BoUtil::getRequest('LanCode')) || empty(BoUtil::getRequest('LanCode', ''))) {
            BoUtil::setRequest('LanCode', 37);
        }


        return SyGetTexte::GetLibelle(101);
    } // Fin GetAttribut

    /**
     * Recherche d'un libellé
     *
     * Modifié par : Ibonatti, le 20.10.2008 Mettre le message aucun libellé en dur afin d'éviter
     *                                       que la procédure ne boucle sur elle-même lorsque la
     *                                         table est vide.
     *
     * @param integer $TitreId
     * @param integer $LanCode
     * @param String $Project
     * @param boolean $Tooltip True -> affiche un tooltip avec le cooldesc au rollover du libellé
     * @return string retourne le libellé du texte sélectionné par $TitreId
     */
    public static function GetLibelle($TitreId, $Project = null, $LanCode = null, $Tooltip = false)
    {
        // *** SIMULATED SQL QUERY ***
        $labels = [
            3 => 'Aide',
            5 => 'Unisciences en bref',
            6 => 'Liste de personnes',
            7 => 'Liste des unités',
            8 => 'Nom',
            9 => 'Fonction(s)',
            20 => 'Afficher',
            3319 => 'Vous êtes ici:',
            2536 => 'Recherche',
            3320 => 'Savoirs & Performances'
        ];

        if (key_exists($TitreId, $labels)) {
            $label = $labels[$TitreId];
        } else {
            $label = $TitreId;
        }
        return $label;
        // *** SIMULATED SQL QUERY ***
    } // Fin GetLibelle

    /**
     * Recherche d'un message d'erreur
     *
     * @param integer $ErrorId
     * @param integer $LanCode
     */
    public static function GetError($ErrorId, $affdesc = false)
    {
        if (is_null(BoUtil::getRequest('LanCode')) || empty(BoUtil::getRequest('LanCode',
                ''))) {
            BoUtil::setRequest('LanCode', 37);
        }


        return SyGetTexte::GetLibelle(101);
    } // Fin GetError
}