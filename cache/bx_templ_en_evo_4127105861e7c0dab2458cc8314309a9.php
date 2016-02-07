<div class="dbTopMenuPopupCnt">
	<?php if(is_array($a['bx_repeat:items'])) for($i=0; $i<count($a['bx_repeat:items']); $i++){ ?>
	    <?php if($a['bx_repeat:items'][$i]['bx_if:item_act']['condition']){ ?>
	        <div class="active bx-def-margin-sec-top-auto">
	            <?php if($a['bx_repeat:items'][$i]['bx_if:item_act']['content']['bx_if:icon_act']['condition']){ ?><img class="<?=$a['bx_repeat:items'][$i]['bx_if:item_act']['content']['bx_if:icon_act']['content']['class'];?>" src="<?=$a['bx_repeat:items'][$i]['bx_if:item_act']['content']['bx_if:icon_act']['content']['src'];?>" /><?php } ?>
	            <?php if($a['bx_repeat:items'][$i]['bx_if:item_act']['content']['bx_if:texticon_act']['condition']){ ?><i class="sys-icon <?=$a['bx_repeat:items'][$i]['bx_if:item_act']['content']['bx_if:texticon_act']['content']['icon'];?>"></i><?php } ?>
	            <span><?=$a['bx_repeat:items'][$i]['bx_if:item_act']['content']['title'];?></span>
	        </div>
	    <?php } ?>
	    <?php if($a['bx_repeat:items'][$i]['bx_if:item_pas']['condition']){ ?>
	        <div class="notActive bx-def-margin-sec-top-auto">
	            <?php if($a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['bx_if:icon_pas']['condition']){ ?><img class="<?=$a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['bx_if:icon_pas']['content']['class'];?>" src="<?=$a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['bx_if:icon_pas']['content']['src'];?>" /><?php } ?>
	            <?php if($a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['bx_if:texticon_pas']['condition']){ ?><i class="sys-icon <?=$a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['bx_if:texticon_pas']['content']['icon'];?>"></i><?php } ?>
	            <a <?=$a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['id'];?> href="<?=$a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['href'];?>" class="<?=$a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['class'];?>" <?=$a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['target'];?> <?=$a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['on_click'];?>><?=$a['bx_repeat:items'][$i]['bx_if:item_pas']['content']['title'];?></a>
	        </div>
	    <?php } ?>
	<?php } else if(is_string($a['bx_repeat:items'])) echo $a['bx_repeat:items']; ?>
</div>