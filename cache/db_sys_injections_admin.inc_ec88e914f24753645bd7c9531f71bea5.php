<?php $mixedData=array (
  'page_0' => 
  array (
    'injection_header' => 
    array (
      0 => 
      array (
        'page_index' => '0',
        'name' => 'flash_integration',
        'key' => 'injection_header',
        'type' => 'php',
        'data' => 'return getRayIntegrationJS();',
        'replace' => '0',
      ),
      1 => 
      array (
        'page_index' => '0',
        'name' => 'lfa',
        'key' => 'injection_header',
        'type' => 'php',
        'data' => 'return lfa();',
        'replace' => '0',
      ),
    ),
    'injection_footer' => 
    array (
      0 => 
      array (
        'page_index' => '0',
        'name' => 'sys_confirm_popup',
        'key' => 'injection_footer',
        'type' => 'php',
        'data' => 'return $GLOBALS[\'oSysTemplate\']->parseHtmlByName(\'transBoxConfirm.html\', array());',
        'replace' => '0',
      ),
    ),
  ),
); ?>