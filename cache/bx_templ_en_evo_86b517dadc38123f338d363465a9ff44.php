<?php if(is_array($a['bx_repeat:items'])) for($i=0; $i<count($a['bx_repeat:items']); $i++){ ?>
	<li<?php if($a['bx_repeat:items'][$i]['bx_if:show_class']['condition']){ ?> class="<?=$a['bx_repeat:items'][$i]['bx_if:show_class']['content']['class'];?>"<?php } ?>>
		<div class="menu_item <?=$a['bx_repeat:items'][$i]['indent'];?>" onmouseover="membermenu.show_description('descr_<?=$a['bx_repeat:items'][$i]['menu_id'];?>')" onmouseout="membermenu.hide_description('descr_<?=$a['bx_repeat:items'][$i]['menu_id'];?>')">
			<?=$a['bx_repeat:items'][$i]['bubble_box'];?>
			<a href="<?=$a['bx_repeat:items'][$i]['menu_link'];?>" class="<?=$a['bx_repeat:items'][$i]['item_link_indent'];?>" <?=$a['bx_repeat:items'][$i]['extended_action'];?> <?=$a['bx_repeat:items'][$i]['target'];?>><?=$a['bx_repeat:items'][$i]['menu_image'];?><?=$a['bx_repeat:items'][$i]['menu_caption'];?></a>
			<?php if($a['bx_repeat:items'][$i]['bx_if:menu_desc']['condition']){ ?>
				<div class="description <?=$a['bx_repeat:items'][$i]['bx_if:menu_desc']['content']['desc_indent'];?>" id="descr_<?=$a['bx_repeat:items'][$i]['bx_if:menu_desc']['content']['menu_id'];?>"><?=$a['bx_repeat:items'][$i]['bx_if:menu_desc']['content']['desc_window'];?></div>    
			<?php } ?>
		</div>
		<?php if($a['bx_repeat:items'][$i]['bx_if:sub_menu']['condition']){ ?>
			<ul id="extra_menu_popup_<?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['menu_id'];?>" class="extra_menu_popup">
				<li>
					<table class="popup" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td class="html_data">
									<div class="popup_content bx-def-border bx-def-round-corners">
										<?php if($a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_top']['condition']){ ?>
											<div class="extra_data <?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_top']['content']['cover'];?> bx-def-padding-sec-leftright bx-def-padding-thd-topbottom">
												<?php if($a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_top']['content']['bx_if:part_image']['condition']){ ?>
													<div class="part_img bx-def-padding-thd-right"><?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_top']['content']['bx_if:part_image']['content']['item_img'];?></div>
												<?php } ?>
												<div class="part_name"><a href="<?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_top']['content']['item_link'];?>" <?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_top']['content']['extended_action'];?> class="item_block"><?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_top']['content']['item_name'];?></a></div>
												<div class="part_reduce">
													<div class="part_reduce_cnt">
														<i class="sys-icon times" alt="minimize"  title="minimize" onclick="membermenu.close_popup('extra_menu_popup_<?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_top']['content']['menu_id'];?>')"></i>
													</div>
													<div class="part_reduce_indent bx-def-padding-sec-right"></div>
												</div>
											</div>
										<?php } ?>
										<div class="html_data bx-def-padding-leftright clearfix" id="menu_content_<?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['menu_id'];?>"></div>
										<?php if($a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_bottom']['condition']){ ?>
											<div class="extra_data <?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_bottom']['content']['cover'];?> bx-def-padding-sec-leftright bx-def-padding-thd-topbottom">
												<?php if($a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_bottom']['content']['bx_if:part_image']['condition']){ ?>
													<div class="part_img bx-def-padding-thd-right"><?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_bottom']['content']['bx_if:part_image']['content']['item_img'];?></div>
												<?php } ?>
												<div class="part_name"><a href="<?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_bottom']['content']['item_link'];?>" class="item_block"><?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_bottom']['content']['item_name'];?></a></div>
												<div class="part_reduce">
													<div class="part_reduce_cnt">
														<i class="sys-icon times" alt="minimize"  title="minimize" onclick="membermenu.close_popup('extra_menu_popup_<?=$a['bx_repeat:items'][$i]['bx_if:sub_menu']['content']['bx_if:reduce_element_bottom']['content']['menu_id'];?>')"></i>
													</div>
													<div class="part_reduce_indent bx-def-padding-sec-right"></div>
												</div>
											</div>
										<?php } ?>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</li>
			</ul>
		<?php } ?>
	</li>
<?php } else if(is_string($a['bx_repeat:items'])) echo $a['bx_repeat:items']; ?>