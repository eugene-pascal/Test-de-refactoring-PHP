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

$LanCode = BoUtil::getRequest('LanCode');

if ($LanCode) {
    $LanCode = (int)$LanCode;
} else {
    $LanCode = 37;
}

$Env = "&amp;LanCode=$LanCode";

include("../Sy/lib/SyCacheInc.php"); // Le cache n'est plus utilisé depuis 2015 !

require(dirname(__FILE__) . "/lib/Header.php");
require_once("../Bo/lib/BoTexte.php");

// Ecran d'entrée dans UniSciences
if (is_null(BoUtil::getRequest('list'))) { ?>
    <td valign="top" width="100%">
        <img src="/images/image_unisciences_homepage.jpg" border="0" width="100%"
             alt="Photo ambiance"/>
        <div style='font-size:15pt; color:#b6b6b6; font-weight: bold;width:100%;text-align:center'><?= SyGetTexte::GetLibelle(3320); //Savoirs & Performances ?></div>
    </td>
    <?php
} // Affichage de la petite photo avec le bandeau à gauche
elseif (!is_null(BoUtil::getRequest('list'))) {
    // Unil en bref
    if (BoUtil::getRequest('list') == "bref") {
        echo BoTexte::getTexte(511, $LanCode);
    } // Affichage de la liste des personnes
    elseif (BoUtil::getRequest('list') == "pers") {
        // gestion cache des personnes
        if (!is_null(BoUtil::getRequest('cache')) && BoUtil::getRequest('cache') == 'clear') {
            apc_clear_cache('user');
        }
        if (apc_exists('listePersonnes') && is_null(BoUtil::getRequest('LanCode'))) {
            $display = apc_fetch('listePersonnes');
        } else {
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

            $i = 0;
            foreach ($alpha as $lettre) {
                if ($i != 0) {
                    $display .= " | ";
                }
                $display .= "<a href=\"#" . $lettre . "\" class=\"abc\">" . trim($lettre) . "</a>\n";
                $i++;
            }

            $myPers = (new SySQLStmt("./data/unpers.json"))->GetArray();

            $previousPernum = -1;
            $carac_old = 'é';
            foreach ($myPers as $key => $pers) {
                if ($previousPernum == $pers['pernum']) {
                    continue;
                }
                $PerNum = $pers['pernum'];
                $previousPernum = $PerNum;
                $PerNom = $pers['pernom'];
                $PerPrenom = $pers['perprenom'];
                $carac = str_replace($accent_min, $accent_maj, mb_substr($PerNom, 0, 1, 'utf-8'));
                if ($carac_old != "é" && strtolower($carac) != strtolower($carac_old)) {
                    $display .= "</table>\n";
                    $display .= "<p align=\"right\"><a href=\"#Top\"><img src=\"/images/up_button.gif\" width=\"25\" height=\"23\" border=\"0\" alt=\"Pour remonter\"/></a></p>\n";
                }
                if (strtolower($carac) != strtolower($carac_old)) {
                    $display .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" style=\"margin-top: 8px; \" summary=\"Liste de personnes dont le nom commence par la lettre " . $carac . "\">\n";
                    $display .= "<tr>\n";
                    $display .= "<td valign=\"top\" class=\"table_first_title\" width=\"209\">" . SyGetTexte::GetLibelle(8) . "<a name=\"" . $carac . "\"></a></td>\n";
                    $display .= "<td valign=\"top\" class=\"table_second_title\" width=\"" . $largSecTab . "\">" . SyGetTexte::GetLibelle(9) . "</td>\n";
                    $display .= "</tr>\n";
                }
                $display .= "<tr>\n";
                $display = "<td valign=\"top\" class=\"bottomdashed2\">" . $PerNom . ' ' . $PerPrenom . "</td>\n";


                $display .= "<td valign=\"top\" class=\"bottomdashed2\">";
                $i = $key;
                $existNext = true;
                $arrayFonnom = array();
                while ($existNext) {
                    if (isset($myPers[$i]) && $myPers[$i]['pernum'] == $PerNum) {
                        $arrayFonnom[] = $myPers[$i]['fonnom'];
                    } else {
                        $existNext = false;
                    }
                    $i++;
                }
                $display .= implode(', ', $arrayFonnom);
                $display .= "</td>\n";
                $display .= "</tr>\n";
                $carac_old = $carac;
            }
            $display .= "</table>\n";
            $display .= "<br />\n";

            // mise en cache pour 30 minutes
            apc_store('listePersonnes', $display, 1800);
        }
        echo $display;

        $Afficher = SyGetTexte::GetLibelle(20);
        print "<p>&nbsp;</p>\n";
    } // Affichage de la liste des unités
    elseif ($_REQUEST['list'] == "unit") {
        print "<h1>" . SyGetTexte::GetLibelle(7) . "</h1>\n";
        $largFirstTab = "100%";

        if (!BoUtil::getRequest('clickedTris')) {
            $clickedTris = array();
        } else {
            $clickedTris = explode('|', BoUtil::getRequest('clickedTris'));
        }

        if (isset($_REQUEST['hideTri'])) {
            unset($clickedTris[array_search($_REQUEST['hideTri'], $clickedTris)]);
            $clickedTris = array_merge($clickedTris);
        }

        $myFacultStmt = new SySQLStmt("./data/facs.json");
        $myFacultArray = $myFacultStmt->GetArray();


        ?>
        <div class="show-hide-all">
            <a class="open-all" title="Afficher tout">Afficher tout</a>
            <span class="caret"></span>
            <a class="close-all" title="Masquer tout">Masquer tout</a>
            <span class="dropup"><span class="caret"></span></span>
        </div>
        <div class="panel-group unil-accordeon" role="tablist" aria-multiselectable="true">
            <?php
            foreach ($myFacultArray as $myFacult) {
                $FacTri = $myFacult["tri"];
                $FacNom = $myFacult["urnom"];

                // Ticket #12453322 - corrigé SQL query
                $sqlQuery = file_get_contents('./data/u'.$FacTri.'.json');
                $myUnitArray = json_decode($sqlQuery, true);

                $triParent = 'aa';
                foreach ($myUnitArray as $key => $myUnit) {
                    if ($key == 0) {
                        $key_id = md5($myUnit['unid']);
                        ?>
                        <div class="faq collapsed" id="acchead-<?= $key_id; ?>" data-toggle="collapse"
                             data-target="#acc-<?= $key_id; ?>" aria-expanded="false">
                            <span class="nothing"><span class="caret"></span></span>
                            <?= $FacNom; ?>
                        </div>
                        <div id="acc-<?= $key_id; ?>" class="collapse" aria-expanded="false" style="height: 0px;">
                        <div class="content-faq">
                        <div class="content">
                        <div>
                        <?php
                    }
                    $UnId = $myUnit['unid'];
                    $UrNom = $myUnit['urnom'];
                    $Abrege = ' (' . $myUnit['urlalias'] . ')';
                    $hierarchie = '';
                    $DisplayUnit = true;
                    if ($myUnit['majf'] == 'f') {
                        // Second niveau
                        $triParent = $myUnit['tri'];
                    }
                    $isParent = false;
                    if (isset($triParent) && strstr($myUnit['tri'], $triParent) != false) {
                        if ($myUnit['tri'] != $triParent) {
                            $DisplayUnit = false;
                            $hierarchie = '&nbsp;&nbsp;&nbsp;&nbsp;';
                        } else {
                            $isParent = true;
                        }
                    }
                    ?>
                    <p
                        <?= (!$DisplayUnit) ? 'class="' . $triParent . '" style="display:none;"' : ""; ?>
                    >
                        <?php
                        if (!$isParent) {
                            echo $hierarchie;
                            ?>
                            <span>
                                <?= $UrNom . $Abrege; ?>
                            </span>
                            <?php
                        } else {
                            ?>
                            <span class="clickable" onclick="myFunctionText(<?= $triParent; ?>)">
                            <span class="nothing"><span
                                        class="caret"></span></span> <?= $hierarchie . $UrNom . $Abrege; ?>
                        </span><br>
                            <?php
                        }
                        ?>
                    </p>

                    <?php
                    if ($key == count($myUnitArray) - 1) {
                        ?>
                        </div>
                        </div>
                        </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
        <script>
            $(document).ready(function () {
                $("a[data-toggle=collapse]").click(function () {
                    $(this).find("span:first").toggleClass("glyphicon-menu-down glyphicon-menu-up")
                });
                $(".close-all").click(function () {
                    $(this).parent().next(".panel-group").find(".faq").next(".in").collapse("hide");
                    $(this).closest(".content").find(".faq").find("span:first").removeClass("dropup").addClass("nothing")
                });
                $(".open-all").click(function () {
                    $(this).parent().next(".panel-group").find(".faq").next("div:not('.in')").collapse("show");
                    $(this).closest(".content").find(".faq").find("span:first").removeClass("nothing").addClass("dropup")
                });
                $(".faq").click(function () {
                    changeCarret($(this));
                });
                $(".clickable").click(function () {
                    changeCarret($(this));
                });

            });

            function changeCarret(that) {
                var elem = that.find(".nothing");
                if (elem.hasClass("dropup")) {
                    elem.removeClass("dropup");
                } else {
                    elem.addClass("dropup");
                }
            }

            function myFunctionText(id) {
                if ($("." + id).hasClass("show")) {
                    $("." + id).hide();
                    $("." + id).removeClass("show");
                } else {
                    $("." + id).show();
                    $("." + id).addClass("show");
                }
            }
        </script>
        <?php
    }
    // Aide Unisciences
    if (BoUtil::getRequest('list') == "aide") {
        if ($LanCode == 37) {
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
    }
    echo "</td>\n";
}
echo "</tr>\n";
echo "</table>\n";

function notPrivateEmail($email)
{
    $mySQL = new SySQLStmt("SELECT emaildomain from email where '" . $email . "' like '%' || emaildomain");
    if ($mySQL->GetAttr('emaildomain') != "") {
        return true;
    } else {
        return false;
    }
}

require(dirname(__FILE__) . "/lib/Footer.php");
?>
