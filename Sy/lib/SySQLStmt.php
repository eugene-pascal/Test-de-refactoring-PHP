<?php
// Couche d'abstraction pour interrogation/mise-à-jour de la base de données
// Création: Elvis, le 20.10.2004
/**
 * *** SIMULATED SQL QUERY ***
 *
 * @version 1.0
 * @author Elvis
 */
class SySQLStmt
{
    public $SQLStmtText;
    public $Results;

    function __construct(
        $SQLStmtText
    ) {
        $this->SQLStmtText = $SQLStmtText;
        $this->Results = json_decode(file_get_contents($this->SQLStmtText), true);
    }

    function GetArray() {
        return $this->Results;
    }

    function GetAttr($colname) {
        return $this->Results[0]->$colname;
    }
}
