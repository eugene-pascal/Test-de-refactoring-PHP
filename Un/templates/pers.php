<?php

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

foreach ($alpha as $i => $lettre) {
    if ($i !== 0) {
        $display .= " | ";
    }
    $display .= "<a href=\"#" . $lettre . "\" class=\"abc\">" . trim($lettre) . "</a>\n";
}

$previousPernum = -1;
$carac_old = '';
foreach ($this->data as $key => $pers) {
    if ($previousPernum == $pers['pernum']) {
        continue;
    }

    $PerNum = $pers['pernum'];
    $previousPernum = $PerNum;
    $PerNom = $pers['pernom'];
    $PerPrenom = $pers['perprenom'];
    $carac = str_replace($accent_min, $accent_maj, mb_substr($PerNom, 0, 1, 'utf-8'));

    if (strtolower($carac) != strtolower($carac_old)) {
        if (!empty($carac_old)) {
            $display .= "</table>\n";
            $display .= "<p align=\"right\"><a href=\"#Top\"><img src=\"/images/up_button.gif\" width=\"25\" height=\"23\" border=\"0\" alt=\"Pour remonter\"/></a></p>\n";
        }
        $display .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" style=\"margin-top: 8px; \" summary=\"Liste de personnes dont le nom commence par la lettre " . $carac . "\">\n";
        $display .= "<tr>\n";
        $display .= "<td valign=\"top\" class=\"table_first_title\" width=\"209\">" . SyGetTexte::GetLibelle(8) . "<a name=\"" . $carac . "\"></a></td>\n";
        $display .= "<td valign=\"top\" class=\"table_second_title\" width=\"" . $largSecTab . "\">" . SyGetTexte::GetLibelle(9) . "</td>\n";
        $display .= "</tr>\n";
    }

    $display .= "<tr>\n";
    $display .= "<td valign=\"top\" class=\"bottomdashed2\">" . $PerNom . ' ' . $PerPrenom . "</td>\n";

    $display .= "<td valign=\"top\" class=\"bottomdashed2\">";

    $currKey = $key;
    $existNext = true;
    $arrayFonnom = array();
    while ($existNext) {
        if (isset($this->data[$currKey]) && $this->data[$currKey]['pernum'] == $PerNum) {
            $arrayFonnom[] = $this->data[$currKey++]['fonnom'];
        } else {
            $existNext = false;
        }
    }

    $display .= implode(', ', $arrayFonnom);
    $display .= "</td>\n";
    $display .= "</tr>\n";
    $carac_old = $carac;

}
$display .= "</table>\n";
$display .= "<br />\n";

echo $display;
echo "<p>&nbsp;</p>\n";