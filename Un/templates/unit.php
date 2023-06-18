<?php
echo "<h1>" . SyGetTexte::GetLibelle(7) . "</h1>\n";
?>
<div class="show-hide-all">
    <a class="open-all" title="Afficher tout">Afficher tout</a>
    <span class="caret"></span>
    <a class="close-all" title="Masquer tout">Masquer tout</a>
    <span class="dropup"><span class="caret"></span></span>
</div>
<div class="panel-group unil-accordeon" role="tablist" aria-multiselectable="true">
<?php
    foreach ($this->data as $myFacult) {
        $myUnitArray = (new SySQLStmt('./data/u'.$myFacult["tri"].'.json'))->GetArray();

        foreach ($myUnitArray as $key => $myUnit) {
            // définir des variables par défaut pour chaque itération
            $UrNom = $myUnit['urnom'];
            $Abrege = ' (' . $myUnit['urlalias'] . ')';
            $hierarchie = '';
            $displayUnit = true;
            $isParent = false;
            if ($myUnit['majf'] === 'f') {
                $triParent = $myUnit['tri'];
            }

            // le premier pas
            if ($key === 0 && ($key_id = md5($myUnit['unid']))) {
                echo '
                    <div class="faq collapsed" id="acchead-'.$key_id.'" data-toggle="collapse"
                         data-target="#acc-'.$key_id.'" aria-expanded="false">
                        <span class="nothing"><span class="caret"></span></span>
                        '.$myFacult["urnom"].'
                    </div>
                    <div id="acc-'.$key_id.'" class="collapse" aria-expanded="false" style="height: 0px;">
                    <div class="content-faq">
                    <div class="content">
                    <div>';
            }

            if (!empty($triParent) && strstr($myUnit['tri'], $triParent) !== false) {
                if ($myUnit['tri'] !== $triParent) {
                    $displayUnit = false;
                    $hierarchie = str_repeat('&nbsp;',4);
                } else {
                    $isParent = true;
                }
            }
            echo '<p'.((!$displayUnit) ? ' class="'.$triParent.'" style="display:none;"' : "").'>';
            if (!$isParent) {
                echo "$hierarchie<span>$UrNom.$Abrege</span>";
            } else {
                echo '
                    <span class="clickable" data-parent-id="'.$triParent.'" onclick="myFunctionText('.$triParent.')">
                        <span class="nothing"><span class="caret"></span></span> '.$hierarchie.$UrNom.$Abrege.'
                    </span><br>';
            }
            echo '</p>';

            if ($key === count($myUnitArray) - 1) {
                echo '
                    </div>
                    </div>
                    </div>
                    </div>';
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
            var _panelGroup = $(this).parent().next(".panel-group");
            _panelGroup.find(".faq").next(".in").collapse("hide");
            _panelGroup.find(".faq").find("span:first").removeClass("dropup");

            _panelGroup.find("span.clickable").each(function(index) {
                var _parentCaret = $(this).find(".nothing");
                var _classNameParent = $(this).data("parent-id");
                _parentCaret.removeClass("dropup");
                _panelGroup.find("." + _classNameParent)
                    .removeClass("show")
                    .hide();
            });
        });
        $(".open-all").click(function () {
            var _panelGroup = $(this).parent().next(".panel-group");
            _panelGroup.find(".faq").next("div:not('.in')").collapse("show");
            _panelGroup.find(".faq").find("span:first").removeClass("dropup").addClass("dropup");

            _panelGroup.find("span.clickable").each(function(index) {
                var _parentCaret = $(this).find(".nothing");
                var _classNameParent = $(this).data("parent-id");
                _parentCaret.removeClass("dropup").addClass("dropup");
                _panelGroup.find("." + _classNameParent)
                    .removeClass("show")
                    .addClass("show")
                    .show();
            });
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
