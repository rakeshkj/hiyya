<div class="bx-form-block-header bx-def-margin-top-auto bx-def-font-inputs clearfix<?=$a['element_class'];?>">
	<div class="bx-form-caption<?=$a['class'];?>" <?=$a['attrs'];?>><?=$a['caption'];?></div>
	<?php if($a['bx_if:show_collapse']['condition']){ ?>
		<div class="bx-form-block-header-collapse">
			<i class="sys-icon <?=$a['bx_if:show_collapse']['content']['icon_name'];?>"></i>
		</div>
	<?php } ?>
</div>