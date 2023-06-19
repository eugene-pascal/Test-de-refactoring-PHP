<?php

if (!isset($LanCode)) {
    $LanCode = BoUtil::getRequest('LanCode', 37);
    $LanCode = (int)$LanCode;
}

if (!in_array($LanCode,array(37,8))) {
    $redirectUrl = preg_replace('|LanCode=\w+$|', 'LanCode=37', BoUtil::getServer('REQUEST_URI'));
    header('Status: 301 Moved permamently', false, 301);
    header('Location:' . $redirectUrl);
    exit();
}

$titre_page = 'Unisciences - UNIL';

$menus = [
    "UnIndex.php?" => "<span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span>",
    "UnIndex.php?list=bref&" => SyGetTexte::GetLibelle(5),
    "UnIndex.php?list=pers&" => SyGetTexte::GetLibelle(6),
    "UnIndex.php?list=unit&" => SyGetTexte::GetLibelle(7),
    "UnIndex.php?list=aide&" => SyGetTexte::GetLibelle(3)
];
$menusHideMobile = array();
$menusHideMobile[] = "../Un/UnIndex.php?";

$unil_links = array(
    "https://www.unil.ch" => [
        8 => "UNIL",
        37 => "UNIL"
    ],
    "https://www.unil.ch/actu" => [
        8 => "News",
        37 => "L'Actu"
    ],
    "https://agenda.unil.ch/" => [
        8 => "Events",
        37 => "L'Agenda"
    ],
    "https://www.unil.ch/central/home/menuinst/campus/campus-pratique.html" => [
        8 => "Campus life",
        37 => "Campus pratique"
    ],
    "https://my.unil.ch/" => "MyUNIL",
    "#fac" => [
        8 => [
            "label" => "Faculties",
            "sub" => [
                "https://www.unil.ch/ftsr/home/menuinst/faculte/english.html" => "Faculty of Theology and Sciences of Religions",
                "https://www.unil.ch/fdca" => "Faculty of Law, Criminal Justice and Public Administration <em>in French</em>",
                "https://www.unil.ch/lettres" => "Faculty of Arts <em>in French</em>",
                "https://www.unil.ch/ssp/home/menuinst/faculte/english.html" => "Faculty of Social and Political Sciences",
                "https://www.unil.ch/hec/en/home.html" => "Faculty of Business and Economics",
                "https://www.unil.ch/fbm" => "Faculty of Biology and Medicine <em>in French</em>",
                "https://www.unil.ch/gse/home/menuinst/faculte/english.html" => "Faculty of Geosciences and Environment",

            ],
        ],
        37 => [
            "label" => "Facultés",
            "sub" => [
                "https://www.unil.ch/ftsr" => "Faculté de théologie et de sciences des religions",
                "https://www.unil.ch/fdca" => "Faculté de droit, des sciences criminelles et d'administration publique",
                "https://www.unil.ch/lettres" => "Faculté des lettres",
                "https://www.unil.ch/ssp" => "Faculté des sciences sociales et politiques",
                "https://www.unil.ch/hec" => "Faculté des hautes études commerciales",
                "https://www.unil.ch/fbm" => "Faculté de biologie et de médecine",
                "https://www.unil.ch/gse" => "Faculté des géosciences et de l'environnement",

            ]
        ]
    ],
    "https://www.unil.ch/central/home/menuinst/organisation/centres-interdisciplinaires.html" => [
        8 => "Centres",
        37 => "Centres"
    ]
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $titre_page; ?></title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/unil.css"/>
    <link rel="stylesheet" href="css/font-unil.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html;charset= 'utf-8'"/>
    <meta name="keywords"
          content="Universit&eacute;, facult&eacute;s, Suisse, recherche, enseignement, acad&eacute;mie, campus, formation, &eacute;coles, &eacute;tudes, Switzerland, &eacute;tudiants, professeurs, Schweiz"/>
    <meta name="description"
          content="L'Universit&eacute; de Lausanne - Suisse - Unisciences présentation de la recherche"/>
</head>

<body>
<div class="container">

    <!--  logo - unilinks - langues - recherche -->
    <div class="row">
        <div class="row">
            <div class="col-md-10 col-md-push-2" id="linkstop">
                <div class="row">
                    <!-- unilinks -->
                    <div class="col-xs-10 col-sm-pull-2">
                        <div id="unilinksblock">
                            <div data-toggle="collapse" data-target="#unilinks1" id="liensunil"
                                 style="padding-top: 0; text-align: center;">Liens UNIL&nbsp;<span
                                        class="glyphicon glyphicon-menu-down" style="font-size: 80%;"></span></div>
                            <div class="collapse" id="unilinks1">
                                <ul class="nav nav-tabs" id="unilinks">
                                    <?php
                                    foreach ($unil_links as $link => $labels):
                                        if (is_array($labels)):
                                            if (is_array($labels[$LanCode])) : ?>
                                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                                        href="#"
                                                                        style="background: transparent;"><?= $labels[$LanCode]["label"] ?>
                                                        <span class="caret"></span></a>
                                                    <ul class="dropdown-menu facs">
                                                        <?php foreach ($labels[$LanCode]["sub"] as $sublink => $sublabel): ?>
                                                            <li><a href="<?= $sublink ?>"
                                                                   title="<?= $sublabel ?>"><?= $sublabel ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </li>
                                            <?php else: ?>
                                                <li><a href="<?= $link ?>"><?= $labels[$LanCode] ?></a></li>
                                            <?php endif;
                                        else: ?>
                                            <li><a href="<?= $link ?>"><?= $labels ?></a></li>
                                        <?php endif;
                                    endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- langues -->
                    <?php
                    // nous prenons tous les paramètres sauf LanCode
                    $params = [];
                    foreach (BoUtil::getRequest() as $k => $v) {
                        if ($k != "LanCode") {
                            $params[$k] = $v;
                        }
                    }
                    ?>
                    <div class="col-xs-2">
                        <div id="v14lang" style="">
                            <div id="langint"><span class="glyphicon glyphicon glyphicon-globe"></span>&nbsp;
                                <span class="">&nbsp;
                                    <?php
                                    $langues = [
                                        37 => "FR",
                                        8 => "EN"
                                    ];
                                    foreach ($langues as $lc => $l):
                                        if ($lc == $LanCode) :?>
                                            <span class="lienon"><?= $l ?></span>
                                        <?php else: ?>
                                            <a class="lienns" href="?<?= http_build_query(array_merge($params, ["LanCode" => $lc])) ?>"><?= $l ?></a>
                                        <?php endif;
                                    endforeach;
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- logo -->
            <div class="col-md-2 col-md-pull-10">
                <div class="row">
                    <div class="col-md-12">
                        <div id="emet_logo"><a href="https://www.unil.ch" title="Université de Lausanne"><img
                                        src="images/logo_unil.svg" alt="Logo Université de Lausanne"></a></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- emetteur -->

        <div class="row">
            <div class="col-md-12">
                <div id="emet_unit" style="">
                    <div id="emet_unit2"><strong><a href="https://www.unil.ch/unisciences">Unisciences</a></strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- navigation niv 1 -->

        <div class="row">
            <div class="col-md-12 no-padding-desktop">
                <div id="nav_hor_cont">
                    <nav class="navbar navbar-inverse navbar-static-top">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                        data-target="#myNavbar">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand visible-xs" href="../Un/UnIndex.php?" style="color: #FFF"><span
                                            class="glyphicon glyphicon-home" id="home"></span></a>
                            </div>
                            <div class="collapse navbar-collapse" id="myNavbar">
                                <ul class="nav navbar-nav">
                                    <?php
                                    foreach ($menus as $link => $label):
                                        $class_visible = (in_array($link, $menusHideMobile)) ? "hidden-xs " : "";
                                        $class_active = (($listParamValue = BoUtil::getRequest('list')) === null && empty(strip_tags($label))) ||
                                        (!empty($listParamValue) && strpos($link, $listParamValue) !== false) ? "active " : "";
                                        $class = "";
                                        if ($class_active != "" || $class_visible != "") {
                                            $class = 'class="' . $class_visible . $class_active . '"';
                                        }
                                        ?>
                                        <li <?= $class; ?>>
                                            <a href="<?= $link . (strpos($link, "UnIndex.php") !== false ? "LanCode={$LanCode}" : "#") ?>"><?= $label ?></a>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

        </div>

        <!--path -->

        <div class="row hidden-xs">
            <div class="col-md-12">
                <div id="path">
                    <a name="navigation" id="navigation"></a>
                    <span style="vertical-align: middle"><em><?= SyGetTexte::GetLibelle(3319) //Vous êtes ici     ?></em>:&nbsp;<a
                                class="liens" href="http://www.unil.ch/central" title="UNIL">UNIL</a>&nbsp;&gt;&nbsp;
                        <?php
                        $linkAsKey = ltrim(substr(BoUtil::getServer('REQUEST_URI'), 0, strpos(BoUtil::getServer('REQUEST_URI'), 'LanCode')), '/');
                        $homeLinkArr = array(
                            'link' => key($menus),
                            'name' => reset($menus)
                        );
                        ?>
                        <?= (isset($menus[$linkAsKey]) ? "<a href=\"{$homeLinkArr['link']}LanCode={$LanCode}\" class=\"liens\">{$homeLinkArr['name']}</a>&nbsp;&gt;&nbsp;<span class=\"lienon\">{$menus[$linkAsKey]}</span>" : '<span class="lienon">Unisciences</span>') ?>
                </span>
                </div>
            </div>
        </div>

        <!--content -->

        <div class="row">
            <!-- col left nav -->
            <div class="col-md-3">
                <div id="v14colleft">
                    <div class="row">
                        <div class="col-md-12">
                            <ul id="menu0">
                                <li><span>&nbsp;<a href="#menu_0" data-toggle="collapse" data-parent="#menu0"><span
                                                    class="glyphicon glyphicon-menu-down"></span>&nbsp;<strong><?= SyGetTexte::GetLibelle(2536)/*Rechercher*/ ?></strong></a></span>
                                    <div id="menu_0" class="panel-collapse collapse">
                                        <div id="navinst">
                                            <ul class="ulmenu" style="margin-bottom: 0;">
                                                <li class="limenu">
                                                    <div data-target="#rech_site"><span
                                                                class="glyphicon glyphicon-search"></span>&nbsp;<span
                                                                class="hidden-xs"><?= SyGetTexte::GetLibelle(2536)/*Rechercher*/ ?></span>
                                                    </div>

                                                    <form name="search" method="get"
                                                          action="https://www.google.ch/search" target="_self"
                                                          class="search_box">
                                                        <input name="q" value="site:www.unil.ch/unisciences"
                                                               type="hidden"/>
                                                        <input name="q" maxlength="255" value="" size="18"
                                                               alt="Recherche" type="text"/>
                                                        <button type="submit" class="btn btn-default btn-sidebar"
                                                                style="margin-right: 5px;">Go
                                                        </button>
                                                    </form>
                                                    <br/>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            // Equivalent à vérifier si on est sur la HomePage
            if (is_null(BoUtil::getRequest('list'))) {
                $hideBorderClass = " hide-border-top";
            }
            ?>
            <div class="col-md-9 col-principal<?= !empty($hideBorderClass) ? $hideBorderClass : '' ; ?>">