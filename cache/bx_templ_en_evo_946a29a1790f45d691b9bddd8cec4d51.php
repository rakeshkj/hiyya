<div class="sys-service-menu">
    <?php if(is_array($a['bx_repeat:items'])) for($i=0; $i<count($a['bx_repeat:items']); $i++){ ?>
        <div class="sys-sm-link">
            <a class="sys-sm-link" href="<?=$a['bx_repeat:items'][$i]['link'];?>" <?=$a['bx_repeat:items'][$i]['script'];?> <?=$a['bx_repeat:items'][$i]['target'];?> title="<?=$a['bx_repeat:items'][$i]['caption_attr'];?>">
            	<i class="sys-icon <?=$a['bx_repeat:items'][$i]['icon'];?>"></i><span><?=$a['bx_repeat:items'][$i]['caption'];?></span>
            </a>
        </div>
    <?php } else if(is_string($a['bx_repeat:items'])) echo $a['bx_repeat:items']; ?>
</div>