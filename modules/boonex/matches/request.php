<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

require_once(BX_DIRECTORY_PATH_INC . 'profiles.inc.php');

check_logged();

bx_import('BxDolRequest');

class BxMatchRequest extends BxDolRequest
{
    function BxMatchRequest()
    {
        parent::BxDolRequest();
    }

    function processAsAction($aModule, &$aRequest, $sClass = "Module")
    {
        $sClassRequire = $aModule['class_prefix'] . $sClass;
        $oModule = BxDolRequest::_require($aModule, $sClassRequire);
        $aVars = array ('BaseUri' => $oModule->_oConfig->getBaseUri());
        $GLOBALS['oTopMenu']->setCustomSubActions($aVars, 'bx_matches_title', false);

        return BxDolRequest::processAsAction($aModule, $aRequest, $sClass);
    }
}

BxMatchRequest::processAsAction($GLOBALS['aModule'], $GLOBALS['aRequest']);
