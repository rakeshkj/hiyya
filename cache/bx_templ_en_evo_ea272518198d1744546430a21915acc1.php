<div id="dbTopMenu<?=$a['id'];?>" class="dbTopMenu">
    <div class="dbTmActive" onclick="javascript:dbTopMenuSubmenu(this, '<?=$a['id'];?>')">
        <span class="dbTmaTitle"><?=$a['title'];?></span>
        <span class="dbTmaSubmenu bx-def-margin-thd-left">
			<i class="sys-icon chevron-down"></i>
		</span>
    </div>
    <div id="dbTopMenuPopup<?=$a['id'];?>" class="dbTopMenuPopup"><?=$a['popup'];?></div>
</div>
