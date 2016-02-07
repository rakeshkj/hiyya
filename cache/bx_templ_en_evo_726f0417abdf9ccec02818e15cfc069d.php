<div class="actionsContainer actionsContainerSubmenu">
	<?php if(is_array($a['bx_repeat:actions'])) for($i=0; $i<count($a['bx_repeat:actions']); $i++){ ?>
        <?=$a['bx_repeat:actions'][$i]['action_link'];?>
    <?php } else if(is_string($a['bx_repeat:actions'])) echo $a['bx_repeat:actions']; ?>
    <a class="menuLink" href="javascript:void(0)" onclick="javascript:$('#sys-share-popup').dolPopup({pointer: {el:this}})" title="Share">
    <i class="sys-icon share-alt"></i>
</a>
<div id="sys-share-popup" class="sys-share-popup" style="display: none"><?=$this->parseSystemKey('popup', $mixedKeyWrapperHtml);?></div>
</div>