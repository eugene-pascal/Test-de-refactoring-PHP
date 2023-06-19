<?php

/**
 * Modèle pour la page d'Aide
 */

?>
<?php
if ($this->getLang() == 37) {
    $Titre1 = "Aide";
    $Ligne1 = "La base de données Unisciences regroupe des informations scientifiques sur l'ensemble des unités et des collaborateurs rattachés à l'Université de Lausanne.";
    $Ligne2 = "La saisie est décentralisée et de l'entière responsabilité des utilisateurs UNIL. Ceci explique l'hétérogénéité des informations mises à disposition.";
} else {
    $Titre1 = "Help";
    $Ligne1 = "UniScience data-base contains scientific information relating to all disciplines and collaborators connected with the University of Lausanne.";
    $Ligne2 = "Data entry is decentralised and entirely the responsibility of UNIL users. This explains the heterogenous nature of the entries.";
}
echo "<h1>$Titre1</h1>\n";
echo "<p>$Ligne1</p>\n";
echo "<p>$Ligne2</p>\n";
echo "<br /><img src=\"/images/unisciences.png\" border=\"0\" alt=\"Unisciences\" />\n";
echo "</table>\n";