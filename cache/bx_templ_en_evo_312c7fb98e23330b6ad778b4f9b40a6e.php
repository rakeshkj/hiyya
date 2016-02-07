
<div class="bx-twig-unit bx_groups_unit bx-def-margin-top-auto">

    <div class="bx-twig-unit-thumb-cont bx-def-margin-sec-right">
        <a href="<?=$a['team_url'];?>"><img class="bx-twig-unit-thumb bx-def-round-corners bx-def-shadow" src="<?=$a['thumb_url'];?>"></a>
    </div>

    <div class="bx-twig-unit-info">

        <div class="bx-twig-unit-title bx-def-font-h2">
            <a href="<?=$a['team_url'];?>"><?=$a['team_title'];?></a>
        </div>

        <div class="bx-twig-unit-line bx-twig-unit-desc"><?=$a['snippet_text'];?></div>

        <div class="bx-twig-unit-line bx-twig-unit-special"><?=$a['fans_count'];?> members</div>

        <div class="bx-twig-unit-line"><?=$a['country_city'];?></div>        

        <?php if($a['bx_if:full']['condition']){ ?>

            <div class="bx-twig-unit-line bx-twig-unit-rate">
                <?=$a['bx_if:full']['content']['rate'];?>
            </div>

            <div class="bx-twig-unit-line bx-def-font-small bx-def-font-grayed">
                <?=$a['bx_if:full']['content']['created'];?> <span class="bullet">&#183;</span> From <a href="<?=$a['bx_if:full']['content']['author_url'];?>"><?=$a['bx_if:full']['content']['author'];?></a>
            </div>

        <?php } ?>

    </div>    

</div>

