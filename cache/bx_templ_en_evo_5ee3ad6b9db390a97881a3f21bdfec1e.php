<div class="sys-sm-item-submenu-cnt clearfix">
	<div class="sys-service-menu-profile">
		<?php if($a['bx_if:show_thumbail']['condition']){ ?><?=$a['bx_if:show_thumbail']['content']['thumbnail'];?><?php } ?>
		<bx_if:show_profile_link>
			<div class="profile_block"><a href="<?=$this->parseSystemKey('link', $mixedKeyWrapperHtml);?>"><?=$this->parseSystemKey('title', $mixedKeyWrapperHtml);?></a></div>
		</bx_if:show_profile_link>
	</div>
	<?=$a['content'];?>
</div>