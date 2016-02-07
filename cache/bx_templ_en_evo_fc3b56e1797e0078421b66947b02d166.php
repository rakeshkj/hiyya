
<div class="bx_sys_file_upload_wrapper">

    <div class="bx_sys_file_upload_line">

        <div class="input_wrapper input_wrapper_file">
            <input class="form_input_file bx-def-font" type="file" name="<?=$a['file'];?>[]" size="12" />
        </div>
        <i title="Add" alt="Add" class="multiply_add_button sys-icon plus-circle" onclick="$(this).parent().parent().append($(this).parent().clone().find('.multiply_add_button').remove().end().find('.multiply_remove_button').show().end().hide()).find('.bx_sys_file_upload_line').slideDown();"></i>
        <i title="Remove" alt="Remove" class="multiply_remove_button sys-icon minus-circle" onclick="var $this = this; $(this).parent().slideUp(function () { $($this).parent().remove(); });" style="display:none;"></i>
        <div class="clear_both"></div>
        <div class="bx_sys_file_upload_title">        
            <?=$a['file_upload_title'];?>
        </div>
        <div class="input_wrapper input_wrapper_text bx-def-round-corners-with-border">
            <input class="form_input_text bx-def-font" type="text" name="<?=$a['title'];?>[]"/>
        </div>
        <div class="clear_both"></div>

        <?php if($a['bx_if:price']['condition']){ ?>
            <div class="bx_sys_file_upload_title">
                <?=$a['bx_if:price']['content']['file_price_title'];?>
            </div>    
            <div class="input_wrapper input_wrapper_text bx-def-round-corners-with-border">
                <input class="form_input_text bx-def-font" type="text" name="<?=$a['bx_if:price']['content']['price'];?>[]"/>
            </div>
            <div class="clear_both"></div>
        <?php } ?>

        <?php if($a['bx_if:privacy']['condition']){ ?>
            <div class="bx_sys_file_upload_title">
                <?=$a['bx_if:privacy']['content']['file_permission_title'];?>
            </div>    
            <?=$a['bx_if:privacy']['content']['select'];?>
            <div class="clear_both"></div>
        <?php } ?>

        <div class="clear_both"></div>

    </div>

</div>
