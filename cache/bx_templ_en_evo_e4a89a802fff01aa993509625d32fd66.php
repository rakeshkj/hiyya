<br>
<div class="bx-twig-unit bx_groups_unit bx-def-margin-top-auto">
	<?php if(is_array($a['bx_repeat:playground'])) for($i=0; $i<count($a['bx_repeat:playground']); $i++){ ?>
    <div class="bx-twig-unit-thumb-cont bx-def-margin-sec-right">
        <a href="<?=$a['bx_repeat:playground'][$i]['palyground_url'];?>"><img class="bx-twig-unit-thumb bx-def-round-corners bx-def-shadow" src="<?=$a['bx_repeat:playground'][$i]['image_playgrpund'];?>"></a>
    </div>

    <div class="bx-twig-unit-info">

        <div class="bx-twig-unit-title bx-def-font-h2">
            <a href="<?=$a['bx_repeat:playground'][$i]['palyground_url'];?>"><?=$a['bx_repeat:playground'][$i]['palyground_title'];?></a>
        </div>

		<div class="bx-twig-unit-line bx-twig-unit-desc"><?=$a['bx_repeat:playground'][$i]['pg_status'];?></div>

        


            <div class="bx-twig-unit-line bx-def-font-small bx-def-font-grayed">
                <?=$a['bx_repeat:playground'][$i]['created'];?> <span class="bullet">&#183;</span> From <a href="<?=$a['bx_repeat:playground'][$i]['author_url'];?>"><?=$a['bx_repeat:playground'][$i]['author_username'];?></a>
            </div>

    </div>
	<br><br>

<?php } else if(is_string($a['bx_repeat:playground'])) echo $a['bx_repeat:playground']; ?>    

</div>

