<?php

/**
 * Classe qui offre plusieurs petits outils pratiques
 */
class BoUtil
{
    /**
     * Retourne la valeur $_REQUEST de la clé $name ou null si elle n'existe pas.
     * Si la clé $name est manquante ou null, on  retourne $_REQUEST comme un tableau
     *
     * @param string|null $name
     * @param mixed $defaulted
     * @return mixed|null
     */
    public static function getRequest($name = null, $defaulted = null)
    {
        $val = null;
        if (is_null($name)) {
            return $_REQUEST;
        } else {
            if (isset($_REQUEST[$name])) {
                $val = $_REQUEST[$name];
            } else {
                if (!is_null($defaulted)) {
                    $val = $defaulted;
                }
            }
        }
        return $val;
    }

    /**
     * Modifie la valeur de la clé $name dans le tableau $_REQUEST
     *
     * @param string $name
     * @param mixed $value
     */
    public static function setRequest($name, $value = null)
    {
        if (!empty($name)) {
            if (is_array($value)) {
                $_REQUEST = array_merge($_REQUEST, array($name => $value));
            } else {
                if (is_null($value)) {
                    if (isset($_REQUEST[$name])) {
                        unset($_REQUEST[$name]);
                    }
                } else {
                    $_REQUEST[$name] = is_numeric($value) ? (int)$value : $value ;
                }
            }
        }
    }

    /**
     * Retourne la valeur %_SERVER de la clé $name ou null si elle n'existe pas.
     *
     * @param string $name
     * @param mixed $defaulted
     * @return mixed|null
     */
    public static function getServer($name, $defaulted = null)
    {
        $val = null;
        if (isset($_SERVER[$name])) {
            $val = $_SERVER[$name];
        } else {
            if (isset($defaulted)) {
                $val = $defaulted;
            }
        }
        return $val;
    }

    /**
     * Retourne la valeur $GLOBALS de la clé $name ou null si elle n'existe pas.
     *
     * @param string $name
     * @param mixed $defaulted
     * @return mixed|null
     */
    public static function getGlobal($name, $defaulted = null)
    {
        $val = null;
        if (isset($GLOBALS[$name])) {
            $val = $GLOBALS[$name];
        }
        elseif (isset($defaulted)) {
            $val = $defaulted;
        }
        return $val;
    }

    /**
     * Ajoute une valeur au tableau associatif contenant les références sur toutes les variables globales
     * actuellement définies dans le contexte d'exécution global du script.
     *
     * @param string $name
     * @param mixed $value
     */
    public static function setGlobal($name, $value = null)
    {
        if (!empty($name) && is_string($name)) {
            if (is_null($value)) {
                if (isset($GLOBALS[$name])) {
                    unset($GLOBALS[$name]);
                }
            } else {
                $GLOBALS[$name] = is_numeric($value) ? (int)$value : $value;
            }
        }
    }
}