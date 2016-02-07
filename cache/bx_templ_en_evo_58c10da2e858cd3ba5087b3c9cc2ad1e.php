<div class="subMenu bx-def-border" id="subMenu_<?=$a['submenu_id'];?>" style="display:<?=$a['display_value'];?>;">
	<div class="subMenuCnt bx-def-padding-leftright clearfix">
		<div class="sys_page_icon bx-def-padding-right bx-phone-hide"><?=$a['picture'];?></div>
		<?php if($a['bx_if:show_caption']['condition']){ ?>
			<div class="sys_page_header bx-def-padding-right"><?=$a['bx_if:show_caption']['content']['caption'];?><?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_title_zone'); ?></div>
		<?php } ?>
        <?php if($a['bx_if:show_submenu']['condition']){ ?>
	        <div class="sys_page_header_divider bx-def-padding-right bx-phone-hide">
				<i class="sys-icon angle-right"></i>
			</div>
            <div class="sys_page_submenu bx-def-padding-right clearfix"><?=$a['bx_if:show_submenu']['content']['submenu'];?></div>
        <?php } ?>
        <?php if($a['bx_if:show_submenu_bottom']['condition']){ ?>
        	<div class="sys_page_header_divider bx-def-padding-right">
				<i class="sys-icon angle-right"></i>
			</div>
            <div class="sys_page_submenu_bottom bx-def-padding-right"><?=$a['bx_if:show_submenu_bottom']['content']['submenu'];?></div>
        <?php } ?>
        <?php if($a['bx_if:show_empty']['condition']){ ?>
            <div class="sys_page_empty"></div>
        <?php } ?>
        <div class="sys_page_actions clearfix"><?=$a['profile_actions'];?><?=$a['login_section'];?></div>
	</div>
</div>
