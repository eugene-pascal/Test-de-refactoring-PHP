</div>


<!-- share -->
<?php

$share_link = BoUtil::getServer("REQUEST_SCHEME") . "://" . BoUtil::getServer("HTTP_HOST") . urlencode(BoUtil::getServer("REQUEST_URI"));

?>
<div class="row">
    <div class="col-md-3 col-md-offset-9">
        <div id="share-home">
            <em><?= _("Partagez:") ?></em>
            <a title="partager cette page sur Facebook"
               href="https://www.facebook.com/sharer.php?s=100&url=<?= urlencode($share_link) ?>&title=<?= urlencode($titre_page) ?>"
               target="_blank"
               onclick="window.open('https://www.facebook.com/sharer.php?s=100&url=<?= urlencode($share_link) ?>&title=<?= urlencode($titre_page) ?>'); return false;">
                <span class="fa gray-icon unilicon-facebook"></span>
            </a>
            <a title="partager cette page sur Twitter"
               href="https://twitter.com/intent/tweet?source=<?= urlencode($share_link) ?>&text=<?= urlencode($titre_page . ": " . $share_link) ?>&via=unil"
               target="_blank"
               onclick="window.open('https://twitter.com/intent/tweet?source=<?= urlencode($share_link) ?>&text=<?= urlencode($titre_page . ": " . $share_link) ?>&via=unil');) return false;">
                <span class="fa gray-icon unilicon-twitter"></span>
            </a>
            <a title="partager cette page sur LinkedIn"
               href="https://www.linkedin.com/shareArticle?url=<?= urlencode($share_link) ?>&title=<?= urlencode($titre_page) ?>&mini=true"
               target="_blank"
               onclick="window.open('https://www.linkedin.com/shareArticle?url=<?= urlencode($share_link) ?>&title=<?= urlencode($titre_page) ?>&mini=true'); return false;">
                <span class="fa gray-icon unilicon-linkedin"></span>
            </a>
            <a title="envoyer cette page par email"
               href="mailto:?subject=<?= urlencode($titre_page) ?>&body=<?= urlencode($share_link) ?>" target="_blank"
               onclick="window.open('mailto:?subject=<?= urlencode($titre_page) ?>&body=<?= urlencode($share_link) ?>'); return false;">
                <span class="fa gray-icon unilicon-mail"></span>
            </a>
            <a title="imprimer la page courante"
               onclick="if(typeof (ga) !== 'undefined'){ga('send', 'event', 'Toolbar', 'Print')} window.print(); return false;"
               href="#">
                <span class="fa gray-icon unilicon-print"></span>
            </a>
        </div>
    </div>

</div>

<!-- footer -->

<div class="row">

    <div class="col-md-12">
        <div id="footer1">

            <div class="row">

                <div class="col-xs-12 col-sm-4">
                    <div id="v14linksbottoma" class="postaddress1"> Unicentre - CH-1015 Lausanne<br>
                        Suisse<br>
                        Tél.&nbsp;+41 21 692&nbsp;11 11<br>
                        Fax.&nbsp;+41 21 692&nbsp;26 15<br>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-8">

                    <div class="row">

                        <div class="col-xs-4 col-sm-5">
                            <div id="v14linksbottom1">
                                <a href="mailto:unisciences@unil.ch" class="liens">Contact</a><br>
                                <a href="https://www.unil.ch/central/home/directories.html"
                                   class="liens">Annuaires</a><br>
                            </div>
                        </div>

                        <div class="col-xs-5 col-sm-5">
                            <div id="v14linksbottom1" style="margin-left: 3px;">
                                <a href="https://www.unil.ch/central/home/legalinformation.html" class="liens">Informations
                                    légales</a><br>
                                <a href="UnSitemap.php" class="liens">Plan du site</a><br>
                                <a href="https://applications.unil.ch/intra/auth/php/Sy/SyMenu.php?Tri=07&TriMenu=07"
                                   class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-log-in"></span> Edition
                                </a><br>
                            </div>
                        </div>

                        <div class="col-xs-3 col-sm-2">
                            <div id="vd">
                                <a href="http://www.vd.ch"><img src="images/etat-vaud-logo.svg" alt="Canton de Vaud"
                                                                border="0" width="39" height="60"></a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

<!-- swissuniversity-->

<div class="row">

    <div class="col-md-12">
        <div id="swissu1">
            <a href="http://www.swissuniversities.ch"><img src="images/swissuniversities-logo.svg"
                                                           alt="Swiss University" border="0" width="96" height="11"></a>
        </div>
    </div>

</div>

</div>

<script type="text/javascript">
<?php
if (BoUtil::getGlobal('SY_JAVASCRIPT_FUNCTIONS')) {
    print BoUtil::getGlobal('SY_JAVASCRIPT_FUNCTIONS');
}

// Méthode de démarrage de jQuery:
if (BoUtil::getGlobal('SY_JQUERY_DOCUMENT_LOADS') && is_array(BoUtil::getGlobal('SY_JQUERY_DOCUMENT_LOADS'))) {
    // On appelle jQuery par son nom complet pour �viter les conflits avec d'autres librairies JS:
    print 'jQuery(document).ready(function($){' . "\n";
    foreach (BoUtil::getGlobal('SY_JQUERY_DOCUMENT_LOADS') as $documentLoad) {
        print $documentLoad . "\n";
    }
    print '});' . "\n";
}
?>
</script>
</body>
</html>
