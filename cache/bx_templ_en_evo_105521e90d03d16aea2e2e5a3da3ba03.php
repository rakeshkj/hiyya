<div class="sys_main_menu">
    <div class="sys_mm sys_main_page_width">
        <div class="sys_mm_cnt bx-def-margin-sec-leftright clearfix">
        	<?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_top_menu_before'); ?>
            <table class="topMenu" cellpadding="0" cellspacing="0">
                <tr><?=$a['main_menu'];?></tr>
            </table>
            <?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_top_menu_after'); ?>
        </div>
    </div>
</div>