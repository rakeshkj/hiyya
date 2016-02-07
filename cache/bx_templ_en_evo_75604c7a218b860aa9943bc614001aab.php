<div class="paginate_per_page">
	<span><?=$a['per_page_caption'];?></span>
	<div class="input_wrapper input_wrapper_select bx-def-margin-sec-leftright clearfix">
		<select class="form_input_select bx-def-font-inputs" name="per_page" onchange="<?=$a['per_page_on_change'];?>">
		    <?php if(is_array($a['bx_repeat:options'])) for($i=0; $i<count($a['bx_repeat:options']); $i++){ ?>
		        <option value="<?=$a['bx_repeat:options'][$i]['opt_value'];?>" <?=$a['bx_repeat:options'][$i]['opt_selected'];?>><?=$a['bx_repeat:options'][$i]['opt_caption'];?></option>
		    <?php } else if(is_string($a['bx_repeat:options'])) echo $a['bx_repeat:options']; ?>
		</select>
	</div>
</div>