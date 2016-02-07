<div class="bx-form-element <?=$a['element_type'];?> bx-def-margin-top clearfix<?=$a['element_class'];?>" <?=$a['element_attrs'];?>>
	<div class="bx-form-combined clearfix<?=$a['class_add'];?>">
		<?=$a['required'];?><?=$a['caption'];?><?=$a['info_icon'];?><?=$a['error_icon'];?><?=$a['input_code'];?><?=$a['input_code_extra'];?>
		<?php if($a['bx_if:show_toggle_html']['condition']){ ?>
			<div class="form_input_toggle_html">
				<a href="javascript:void(0);" onclick="$('#<?=$a['bx_if:show_toggle_html']['content']['attrs_id'];?>').formsToggleHtmlEditor()">Toggle HTML Editor</a>
			</div>
		<?php } ?>
	</div>
</div>