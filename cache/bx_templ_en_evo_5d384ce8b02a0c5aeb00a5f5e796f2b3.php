<div class="sys_file_search_pic bx_photos_file_search_pic">
    <?php if($a['bx_if:admin']['condition']){ ?>
        <div class="bx_sys_unit_checkbox">
            <input type="checkbox" name="entry[]" value="<?=$a['bx_if:admin']['content']['id'];?>"/>
        </div>
    <?php } ?>
    <a class="sys_file_search_pic_link" href="<?=$a['fileLink'];?>"><img class="bx-img-retina" src="<?=$a['imgUrl'];?>" src-2x="<?=$a['imgUrl_2x'];?>" /></a>
</div>