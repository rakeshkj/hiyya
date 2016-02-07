<?php $mixedData=array (
  'bx_teams_title' => 
  array (
    0 => 
    array (
      'Caption' => '{evalResult}',
      'Icon' => 'plus',
      'Url' => '{BaseUri}browse/my&bx_teams_filter=add_team',
      'Script' => '',
      'Eval' => 'return ($GLOBALS[\'logged\'][\'member\'] && BxDolModule::getInstance(\'BxTeamsModule\')->isAllowedAdd()) || $GLOBALS[\'logged\'][\'admin\'] ? _t(\'_bx_teams_action_add_team\') : \'\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    1 => 
    array (
      'Caption' => '{evalResult}',
      'Icon' => 'team',
      'Url' => '{BaseUri}browse/my',
      'Script' => '',
      'Eval' => 'return $GLOBALS[\'logged\'][\'member\'] || $GLOBALS[\'logged\'][\'admin\'] ? _t(\'_bx_teams_action_my_teams\') : \'\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
  ),
  'bx_teams' => 
  array (
    0 => 
    array (
      'Caption' => '{TitleEdit}',
      'Icon' => 'edit',
      'Url' => '{evalResult}',
      'Script' => '',
      'Eval' => '$oConfig = $GLOBALS[\'oBxTeamsModule\']->_oConfig; return  BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'edit/{ID}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    1 => 
    array (
      'Caption' => '{TitleDelete}',
      'Icon' => 'remove',
      'Url' => '',
      'Script' => 'getHtmlData( \'ajaxy_popup_result_div_{ID}\', \'{evalResult}\', false, \'post\', true); return false;',
      'Eval' => '$oConfig = $GLOBALS[\'oBxTeamsModule\']->_oConfig; return  BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'delete/{ID}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    2 => 
    array (
      'Caption' => '{TitleShare}',
      'Icon' => 'share',
      'Url' => '',
      'Script' => 'showPopupAnyHtml (\'{BaseUri}share_popup/{ID}\');',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
    3 => 
    array (
      'Caption' => '{TitleBroadcast}',
      'Icon' => 'envelope',
      'Url' => '{BaseUri}broadcast/{ID}',
      'Script' => '',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
    4 => 
    array (
      'Caption' => '{TitleJoin}',
      'Icon' => '{IconJoin}',
      'Url' => '',
      'Script' => 'getHtmlData( \'ajaxy_popup_result_div_{ID}\', \'{evalResult}\', false, \'post\');return false;',
      'Eval' => '$oConfig = $GLOBALS[\'oBxTeamsModule\']->_oConfig; return BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'join/{ID}/{iViewer}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    5 => 
    array (
      'Caption' => '{TitleInvite}',
      'Icon' => 'plus-sign',
      'Url' => '{evalResult}',
      'Script' => '',
      'Eval' => '$oConfig = $GLOBALS[\'oBxTeamsModule\']->_oConfig; return BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'invite/{ID}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    6 => 
    array (
      'Caption' => '{AddToFeatured}',
      'Icon' => 'star-empty',
      'Url' => '',
      'Script' => 'getHtmlData( \'ajaxy_popup_result_div_{ID}\', \'{evalResult}\', false, \'post\');return false;',
      'Eval' => '$oConfig = $GLOBALS[\'oBxTeamsModule\']->_oConfig; return BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'mark_featured/{ID}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    7 => 
    array (
      'Caption' => '{TitleManageFans}',
      'Icon' => 'team',
      'Url' => '',
      'Script' => 'showPopupAnyHtml (\'{BaseUri}manage_fans_popup/{ID}\');',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
  ),
  'bx_matches_title' => 
  array (
    0 => 
    array (
      'Caption' => '{evalResult}',
      'Icon' => 'plus',
      'Url' => '{BaseUri}browse/my&bx_matches_filter=add_match',
      'Script' => '',
      'Eval' => 'return ($GLOBALS[\'logged\'][\'member\'] && BxDolModule::getInstance(\'BxMatchModule\')->isAllowedAdd()) || $GLOBALS[\'logged\'][\'admin\'] ? _t(\'_bx_matches_action_add_match\') : \'\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    1 => 
    array (
      'Caption' => '{evalResult}',
      'Icon' => 'match',
      'Url' => '{BaseUri}browse/my',
      'Script' => '',
      'Eval' => 'return $GLOBALS[\'logged\'][\'member\'] || $GLOBALS[\'logged\'][\'admin\'] ? _t(\'_bx_matches_action_my_matches\') : \'\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
  ),
  'bx_matches' => 
  array (
    0 => 
    array (
      'Caption' => '{TitleEdit}',
      'Icon' => 'edit',
      'Url' => '{evalResult}',
      'Script' => '',
      'Eval' => '$oConfig = $GLOBALS[\'oBxMatchModule\']->_oConfig; return  BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'edit/{ID}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    1 => 
    array (
      'Caption' => '{TitleDelete}',
      'Icon' => 'remove',
      'Url' => '',
      'Script' => 'getHtmlData( \'ajaxy_popup_result_div_{ID}\', \'{evalResult}\', false, \'post\', true); return false;',
      'Eval' => '$oConfig = $GLOBALS[\'oBxMatchModule\']->_oConfig; return  BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'delete/{ID}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    2 => 
    array (
      'Caption' => '{TitleShare}',
      'Icon' => 'share',
      'Url' => '',
      'Script' => 'showPopupAnyHtml (\'{BaseUri}share_popup/{ID}\');',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
    3 => 
    array (
      'Caption' => '{TitleBroadcast}',
      'Icon' => 'envelope',
      'Url' => '{BaseUri}broadcast/{ID}',
      'Script' => '',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
    4 => 
    array (
      'Caption' => '{TitleJoin}',
      'Icon' => '{IconJoin}',
      'Url' => '',
      'Script' => 'getHtmlData( \'ajaxy_popup_result_div_{ID}\', \'{evalResult}\', false, \'post\');return false;',
      'Eval' => '$oConfig = $GLOBALS[\'oBxMatchModule\']->_oConfig; return BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'join/{ID}/{iViewer}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    5 => 
    array (
      'Caption' => '{TitleInvite}',
      'Icon' => 'plus-sign',
      'Url' => '{evalResult}',
      'Script' => '',
      'Eval' => '$oConfig = $GLOBALS[\'oBxMatchModule\']->_oConfig; return BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'invite/{ID}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    6 => 
    array (
      'Caption' => '{AddToFeatured}',
      'Icon' => 'star-empty',
      'Url' => '',
      'Script' => 'getHtmlData( \'ajaxy_popup_result_div_{ID}\', \'{evalResult}\', false, \'post\');return false;',
      'Eval' => '$oConfig = $GLOBALS[\'oBxMatchModule\']->_oConfig; return BX_DOL_URL_ROOT . $oConfig->getBaseUri() . \'mark_featured/{ID}\';',
      'bDisplayInSubMenuHeader' => '0',
    ),
    7 => 
    array (
      'Caption' => '{TitleManageFans}',
      'Icon' => 'match',
      'Url' => '',
      'Script' => 'showPopupAnyHtml (\'{BaseUri}manage_fans_popup/{ID}\');',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
    8 => 
    array (
      'Caption' => '{TitleUploadPhotos}',
      'Icon' => 'picture',
      'Url' => '{BaseUri}upload_photos/{URI}',
      'Script' => '',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
    9 => 
    array (
      'Caption' => '{TitleUploadVideos}',
      'Icon' => 'film',
      'Url' => '{BaseUri}upload_videos/{URI}',
      'Script' => '',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
    10 => 
    array (
      'Caption' => '{TitleUploadSounds}',
      'Icon' => 'music',
      'Url' => '{BaseUri}upload_sounds/{URI}',
      'Script' => '',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
    11 => 
    array (
      'Caption' => '{TitleUploadFiles}',
      'Icon' => 'save',
      'Url' => '{BaseUri}upload_files/{URI}',
      'Script' => '',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
    12 => 
    array (
      'Caption' => '{TitleSubscribe}',
      'Icon' => 'paper-clip',
      'Url' => '',
      'Script' => '{ScriptSubscribe}',
      'Eval' => '',
      'bDisplayInSubMenuHeader' => '0',
    ),
  ),
); ?>