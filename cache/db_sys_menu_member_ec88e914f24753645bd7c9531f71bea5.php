<?php $mixedData=array (
  'top' => 
  array (
    1 => 
    array (
      'ID' => '1',
      'Caption' => '{evalResult}',
      'Name' => 'MemberBlock',
      'Icon' => '',
      'Link' => '{ProfileLink}',
      'Script' => '',
      'Eval' => 'return \'<b class="menu_item_username">\' . getNickName({ID}) . \'</b>\';',
      'PopupMenu' => 'bx_import(\'BxDolUserStatusView\');
$oStatusView = new BxDolUserStatusView();
return $oStatusView->getMemberMenuStatuses();',
      'Order' => '1',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '1',
      'Editable' => '0',
      'Deletable' => '0',
      'Target' => '',
      'Position' => 'top',
      'Type' => 'link',
      'Parent' => '0',
      'Bubble' => '',
      'Description' => '_Presence',
      'linked_items' => 
      array (
      ),
    ),
    11 => 
    array (
      'ID' => '11',
      'Caption' => '',
      'Name' => 'bx_teams',
      'Icon' => '',
      'Link' => '',
      'Script' => '',
      'Eval' => 'return BxDolService::call(\'teams\', \'get_member_menu_item_add_content\');',
      'PopupMenu' => '',
      'Order' => '3',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '1',
      'Editable' => '1',
      'Deletable' => '1',
      'Target' => '',
      'Position' => 'top',
      'Type' => 'linked_item',
      'Parent' => '6',
      'Bubble' => '',
      'Description' => '',
      'linked_items' => 
      array (
      ),
    ),
    13 => 
    array (
      'ID' => '13',
      'Caption' => '',
      'Name' => 'bx_matches',
      'Icon' => '',
      'Link' => '',
      'Script' => '',
      'Eval' => 'return BxDolService::call(\'matches\', \'get_member_menu_item_add_content\');',
      'PopupMenu' => '',
      'Order' => '4',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '1',
      'Editable' => '1',
      'Deletable' => '1',
      'Target' => '',
      'Position' => 'top',
      'Type' => 'linked_item',
      'Parent' => '6',
      'Bubble' => '',
      'Description' => '',
      'linked_items' => 
      array (
      ),
    ),
  ),
  'top_extra' => 
  array (
    2 => 
    array (
      'ID' => '2',
      'Caption' => '_Mail',
      'Name' => 'Mail',
      'Icon' => 'envelope',
      'Link' => 'mail.php?mode=inbox',
      'Script' => '',
      'Eval' => '',
      'PopupMenu' => 'bx_import( \'BxTemplMailBox\' );
// return list of messages ;
return BxTemplMailBox::get_member_menu_messages_list({ID});',
      'Order' => '1',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '1',
      'Editable' => '0',
      'Deletable' => '0',
      'Target' => '',
      'Position' => 'top_extra',
      'Type' => 'link',
      'Parent' => '0',
      'Bubble' => 'bx_import( \'BxTemplMailBox\' );
// return list of new messages ;
$aRetEval= BxTemplMailBox::get_member_menu_bubble_new_messages({ID}, {iOldCount});',
      'Description' => '_Mail',
      'linked_items' => 
      array (
      ),
    ),
    9 => 
    array (
      'ID' => '9',
      'Caption' => '',
      'Name' => 'bx_photos',
      'Icon' => '',
      'Link' => '',
      'Script' => '',
      'Eval' => 'return BxDolService::call(\'photos\', \'get_member_menu_item_add_content\');',
      'PopupMenu' => '',
      'Order' => '1',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '1',
      'Editable' => '1',
      'Deletable' => '1',
      'Target' => '',
      'Position' => 'top_extra',
      'Type' => 'linked_item',
      'Parent' => '6',
      'Bubble' => '',
      'Description' => '',
      'linked_items' => 
      array (
      ),
    ),
    10 => 
    array (
      'ID' => '10',
      'Caption' => '',
      'Name' => 'bx_groups',
      'Icon' => '',
      'Link' => '',
      'Script' => '',
      'Eval' => 'return BxDolService::call(\'groups\', \'get_member_menu_item_add_content\');',
      'PopupMenu' => '',
      'Order' => '2',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '1',
      'Editable' => '1',
      'Deletable' => '1',
      'Target' => '',
      'Position' => 'top_extra',
      'Type' => 'linked_item',
      'Parent' => '6',
      'Bubble' => '',
      'Description' => '',
      'linked_items' => 
      array (
      ),
    ),
    3 => 
    array (
      'ID' => '3',
      'Caption' => '_Friends',
      'Name' => 'Friends',
      'Icon' => 'users',
      'Link' => 'viewFriends.php?iUser={ID}',
      'Script' => '',
      'Eval' => '',
      'PopupMenu' => 'bx_import( \'BxDolFriendsPageView\' );
return BxDolFriendsPageView::get_member_menu_friends_list({ID});',
      'Order' => '3',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '1',
      'Editable' => '0',
      'Deletable' => '0',
      'Target' => '',
      'Position' => 'top_extra',
      'Type' => 'link',
      'Parent' => '0',
      'Bubble' => 'bx_import( \'BxDolFriendsPageView\' );
$aRetEval = BxDolFriendsPageView::get_member_menu_bubble_friend_requests( {ID}, {iOldCount});',
      'Description' => '_Friends',
      'linked_items' => 
      array (
      ),
    ),
    4 => 
    array (
      'ID' => '4',
      'Caption' => '_sys_pmt_shopping_cart_caption',
      'Name' => 'ShoppingCart',
      'Icon' => 'shopping-cart',
      'Link' => 'cart.php',
      'Script' => '',
      'Eval' => '',
      'PopupMenu' => 'bx_import(\'BxDolPayments\');
return BxDolPayments::getInstance()->getCartItems();',
      'Order' => '4',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '1',
      'Editable' => '0',
      'Deletable' => '0',
      'Target' => '',
      'Position' => 'top_extra',
      'Type' => 'link',
      'Parent' => '0',
      'Bubble' => 'bx_import(\'BxDolPayments\');
$oPayment = BxDolPayments::getInstance();
if($oPayment->isActive()) $aRetEval = $oPayment->getCartItemCount({ID}, {iOldCount}); else $isSkipItem = true;',
      'Description' => '_sys_pmt_shopping_cart_description',
      'linked_items' => 
      array (
      ),
    ),
    5 => 
    array (
      'ID' => '5',
      'Caption' => '_Admin Panel',
      'Name' => 'AdminPanel',
      'Icon' => 'wrench',
      'Link' => '{evalResult}',
      'Script' => '',
      'Eval' => 'return isAdmin() ? $GLOBALS[\'site\'][\'url_admin\'] : \'\';',
      'PopupMenu' => '',
      'Order' => '5',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '1',
      'Editable' => '1',
      'Deletable' => '1',
      'Target' => '',
      'Position' => 'top_extra',
      'Type' => 'link',
      'Parent' => '0',
      'Bubble' => '',
      'Description' => '_Go admin panel',
      'linked_items' => 
      array (
      ),
    ),
    6 => 
    array (
      'ID' => '6',
      'Caption' => '_sys_add_content',
      'Name' => 'AddContent',
      'Icon' => 'plus',
      'Link' => 'javascript:void(0);',
      'Script' => '',
      'Eval' => '',
      'PopupMenu' => 'bx_import( \'BxDolUserStatusView\' );
$oStatusView = new BxDolUserStatusView();
return $oStatusView -> getStatusField({ID});',
      'Order' => '6',
      'Active' => '1',
      'Movable' => '3',
      'Clonable' => '0',
      'Editable' => '0',
      'Deletable' => '0',
      'Target' => '',
      'Position' => 'top_extra',
      'Type' => 'link',
      'Parent' => '0',
      'Bubble' => '$isSkipItem = $aReplaced[$sPosition][$iKey][\'linked_items\'] ? false : true;
$aRetEval = false;',
      'Description' => '_sys_add_content',
      'linked_items' => 
      array (
        0 => 
        array (
          'code' => 'return BxDolService::call(\'photos\', \'get_member_menu_item_add_content\');',
        ),
        1 => 
        array (
          'code' => 'return BxDolService::call(\'groups\', \'get_member_menu_item_add_content\');',
        ),
        2 => 
        array (
          'code' => 'return BxDolService::call(\'teams\', \'get_member_menu_item_add_content\');',
        ),
        3 => 
        array (
          'code' => 'return BxDolService::call(\'matches\', \'get_member_menu_item_add_content\');',
        ),
      ),
    ),
  ),
); ?>