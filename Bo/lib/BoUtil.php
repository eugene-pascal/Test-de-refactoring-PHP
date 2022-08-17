<?php

/**
 * Classe qui offre plusieurs petits outils pratiques
 */
class BoUtil
{
    /**
     * Retourne la valeur $_REQUEST de la clé $name ou null si elle n'existe pas.
     *
     * @param $name
     * @return mixed|null
     */
    public static function getRequest($name = null, $value = null)
    {
        $val = null;
        if (is_null($name)) {
            $val = $_REQUEST;
        } else {
            if (isset($_REQUEST[$name])) {
                $val = $_REQUEST[$name];
            } else {
                if (!is_null($value)) {
                    $val = $value;

                }
            }
        }

        return $val;
    }

    /**
     * Modifie la valeur de la clé $name dans le tableau $_REQUEST
     *
     * @param $name
     * @param null $value
     */
    public static function setRequest($name, $value = null)
    {
        if (is_null($name)) {
            if (is_array($value)) {
                $_REQUEST = $value;
            } elseif (is_null($value)) {
                $_REQUEST = null;
            }
        } else {
            if (is_array($name)) {
                $_REQUEST = array_merge($_REQUEST, $name);
            } elseif (!empty($name)) {
                if ($value === null) {
                    unset($_REQUEST[$name]);
                } else {
                    $_REQUEST[$name] = $value;
                }
            }
        }
    }

    public static function getServer($name, $value = null)
    {
        $val = null;
        if (isset($_SERVER[$name])) {
            $val = $_SERVER[$name];
        }else{
            if (!is_null($value)) {
                $val = $value;
            }
        }

        return $val;
    }

    /**
     * Retourne la valeur $GLOBALS de la clé $name ou null si elle n'existe pas.
     *
     * @param $name
     * @param $defaultvalue
     * @return mixed|null
     */
    public static function getGlobal($name, $defaultvalue = null)
    {
        $val = null;
        if (isset($GLOBALS[$name]))
            $val = $GLOBALS[$name];
        elseif (!is_null($defaultvalue))
            $val = $defaultvalue;


        return $val;
    }

    /**
     * Ajoute une valeur au tableau associatif contenant les références sur toutes les variables globales
     * actuellement définies dans le contexte d'exécution global du script.
     *
     * @param $name string
     * @param $value mixed
     */
    public static function setGlobal($name, $value = null)
    {
        if ($value === null) { unset ($GLOBALS[$name]); } else {$GLOBALS[$name] = $value;}
    }



}

?>
