<?php

/**
 * Modèle pour la page Liste de personnes
 */

$alpha = array(
    "A",
    "B",
    "C",
    "D",
    "E",
    "F",
    "G",
    "H",
    "I",
    "J",
    "K",
    "L",
    "M",
    "N",
    "O",
    "P",
    "Q",
    "R",
    "S",
    "T",
    "U",
    "V",
    "W",
    "X",
    "Y",
    "Z"
);

$accent_min = array(
    'é',
    'è',
    'ê',
    'ë',
    'É',
    'È',
    'Ê',
    'Ë',
    'à',
    'â',
    'ä',
    'À',
    'Â',
    'Ä',
    'î',
    'ï',
    'Î',
    'Ï',
    'ô',
    'ö',
    'Ô',
    'Ö',
    'ù',
    'û',
    'ü',
    'Ù',
    'Û',
    'Ü'
);

$accent_maj = array(
    'E',
    'E',
    'E',
    'E',
    'E',
    'E',
    'E',
    'E',
    'A',
    'A',
    'A',
    'A',
    'A',
    'A',
    'I',
    'I',
    'I',
    'I',
    'O',
    'O',
    'O',
    'O',
    'U',
    'U',
    'U',
    'U',
    'U',
    'U'
);

$display = "<h1>" . SyGetTexte::GetLibelle(6) . "</h1>\n";
$largSecTab = "345";

// liens alphabétiques rapides
foreach ($alpha as $i => $lettre) {
    if ($i !== 0) {
        $display .= " | ";
    }
    $display .= "<a href=\"#" . $lettre . "\" class=\"abc\">" . trim($lettre) . "</a>\n";
}

$prevPersonalNumber = -1;
$carac_old = '';
foreach ($this->data as $key => $pers) {
    // Ignorer la même personne
    if ($prevPersonalNumber == $pers['pernum']) {
        continue;
    }
    $personalNumer = $pers['pernum'];
    $prevPersonalNumber = $personalNumer;
    $personalNom = $pers['pernom'];
    $personalPrenom = $pers['perprenom'];

    // Selon le faux alphabet de la langue française si la première lettre est une lettre avec un accent
    // alors nous la remplaçons par une lettre sans accent
    $carac = str_replace($accent_min, $accent_maj, mb_substr($personalNom, 0, 1, 'utf-8'));

    if (strtolower($carac) !== strtolower($carac_old)) {
        // lien vers le haut
        if (!empty($carac_old)) {
            $display .= "</table>\n";
            $display .= "<p align=\"right\"><a href=\"#Top\"><img src=\"/images/up_button.gif\" width=\"25\" height=\"23\" border=\"0\" alt=\"Pour remonter\"/></a></p>\n";
        }
        // titre avant le début d'une nouvelle lettre
        $display .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" style=\"margin-top: 8px; \" summary=\"Liste de personnes dont le nom commence par la lettre " . $carac . "\">\n";
        $display .= "<tr>\n";
        $display .= "<td valign=\"top\" class=\"table_first_title\" width=\"209\">" . SyGetTexte::GetLibelle(8) . "<a name=\"" . $carac . "\"></a></td>\n";
        $display .= "<td valign=\"top\" class=\"table_second_title\" width=\"" . $largSecTab . "\">" . SyGetTexte::GetLibelle(9) . "</td>\n";
        $display .= "</tr>\n";
    }
    $display .= "<tr>\n";
    $display .= "<td valign=\"top\" class=\"bottomdashed2\">" . $personalNom . ' ' . $personalPrenom . "</td>\n";
    $display .= "<td valign=\"top\" class=\"bottomdashed2\">";

    $currKey = $key;
    $existNext = true;
    $tableauDeFonnom = array();
    // passez le tableau pour obtenir toutes les valeurs "fonnom" du même person 
    while ($existNext) {
        if (isset($this->data[$currKey]) && $this->data[$currKey]['pernum'] == $personalNumer) {
            $tableauDeFonnom[] = $this->data[$currKey++]['fonnom'];
        } else {
            $existNext = false;
        }
    }
    $display .= implode(', ', $tableauDeFonnom);
    $display .= "</td>\n";
    $display .= "</tr>\n";
    $carac_old = $carac;
}
$display .= "</table>\n";
$display .= "<br />\n";

echo $display;
echo "<p>&nbsp;</p>\n";