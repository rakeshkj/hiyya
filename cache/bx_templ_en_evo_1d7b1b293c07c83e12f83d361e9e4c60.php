<div class="bx-form-element <?=$a['element_type'];?> bx-def-margin-top clearfix<?=$a['element_class'];?>" <?=$a['element_attrs'];?>>
	<div class="bx-form-caption bx-def-font-inputs-captions"><?=$a['required'];?><?=$a['caption'];?><?=$a['info_icon'];?><?=$a['error_icon'];?></div>
	<div class="bx-form-value clearfix<?=$a['class_add'];?>">
		<?=$a['input_code'];?><?=$a['input_code_extra'];?>
		<?php if($a['bx_if:show_toggle_html']['condition']){ ?>
			<div class="form_input_toggle_html">
				<a href="javascript:void(0);" onclick="$('#<?=$a['bx_if:show_toggle_html']['content']['attrs_id'];?>').formsToggleHtmlEditor()">Toggle HTML Editor</a>
			</div>
		<?php } ?>
	</div>
</div>