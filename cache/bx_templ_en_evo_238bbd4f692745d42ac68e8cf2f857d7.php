<div class="actionsContainer">
    <div class="actionsBlock clearfix">
    	<div class="actionItems clearfix"><?php if(is_array($a['bx_repeat:actions'])) for($i=0; $i<count($a['bx_repeat:actions']); $i++){ ?><div class="actionItem <?=$a['bx_repeat:actions'][$i]['action_link_class'];?>"><?=$a['bx_repeat:actions'][$i]['action_link'];?></div><?php } else if(is_string($a['bx_repeat:actions'])) echo $a['bx_repeat:actions']; ?></div>
        <?=$a['responce_block'];?>
    </div>
</div>