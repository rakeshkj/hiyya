<?php $mixedData=array (
  'alerts' => 
  array (
    'system' => 
    array (
      'begin' => 
      array (
        0 => '1',
      ),
    ),
    'profile' => 
    array (
      'before_join' => 
      array (
        0 => '2',
      ),
      'join' => 
      array (
        0 => '2',
        1 => '3',
        2 => '4',
      ),
      'before_login' => 
      array (
        0 => '2',
      ),
      'login' => 
      array (
        0 => '2',
      ),
      'logout' => 
      array (
        0 => '2',
      ),
      'edit' => 
      array (
        0 => '2',
        1 => '3',
        2 => '4',
      ),
      'delete' => 
      array (
        0 => '3',
        1 => '4',
        2 => '6',
        3 => '7',
        4 => '10',
        5 => '16',
      ),
      'change_status' => 
      array (
        0 => '4',
      ),
      'commentRemoved' => 
      array (
        0 => '5',
      ),
    ),
    'bx_photos' => 
    array (
      'delete' => 
      array (
        0 => '8',
        1 => '11',
        2 => '17',
      ),
    ),
    'bx_videos' => 
    array (
      'delete' => 
      array (
        0 => '8',
        1 => '11',
        2 => '17',
      ),
    ),
    'bx_sounds' => 
    array (
      'delete' => 
      array (
        0 => '8',
        1 => '11',
        2 => '17',
      ),
    ),
    'bx_files' => 
    array (
      'delete' => 
      array (
        0 => '8',
        1 => '11',
        2 => '17',
      ),
    ),
    'module' => 
    array (
      'install' => 
      array (
        0 => '9',
        1 => '12',
        2 => '18',
      ),
    ),
  ),
  'handlers' => 
  array (
    1 => 
    array (
      'class' => 'BxDolAlertsResponseSystem',
      'file' => 'inc/classes/BxDolAlertsResponseSystem.php',
      'eval' => '',
    ),
    2 => 
    array (
      'class' => 'BxDolAlertsResponseProfile',
      'file' => 'inc/classes/BxDolAlertsResponseProfile.php',
      'eval' => '',
    ),
    3 => 
    array (
      'class' => 'BxDolUpdateMembersCache',
      'file' => 'inc/classes/BxDolUpdateMembersCache.php',
      'eval' => '',
    ),
    4 => 
    array (
      'class' => 'BxDolAlertsResponceMatch',
      'file' => 'inc/classes/BxDolAlertsResponceMatch.php',
      'eval' => '',
    ),
    5 => 
    array (
      'class' => 'BxDolVideoDeleteResponse',
      'file' => 'flash/modules/video_comments/inc/classes/BxDolVideoDeleteResponse.php',
      'eval' => '',
    ),
    6 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'photos\', \'response_profile_delete\', array($this));',
    ),
    7 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'groups\', \'response_profile_delete\', array($this));',
    ),
    8 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'groups\', \'response_media_delete\', array($this));',
    ),
    9 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'if (\'wmap\' == $this->aExtras[\'uri\'] && $this->aExtras[\'res\'][\'result\']) BxDolService::call(\'groups\', \'map_install\');',
    ),
    10 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'teams\', \'response_profile_delete\', array($this));',
    ),
    11 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'teams\', \'response_media_delete\', array($this));',
    ),
    12 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'if (\'wmap\' == $this->aExtras[\'uri\'] && $this->aExtras[\'res\'][\'result\']) BxDolService::call(\'teams\', \'map_install\');',
    ),
    16 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'matches\', \'response_profile_delete\', array($this));',
    ),
    17 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'BxDolService::call(\'matches\', \'response_media_delete\', array($this));',
    ),
    18 => 
    array (
      'class' => '',
      'file' => '',
      'eval' => 'if (\'wmap\' == $this->aExtras[\'uri\'] && $this->aExtras[\'res\'][\'result\']) BxDolService::call(\'matches\', \'map_install\');',
    ),
  ),
); ?>