<?php

/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolInstaller');

class BxTeamsInstaller extends BxDolInstaller
{
    function BxTeamsInstaller($aConfig)
    {
        parent::BxDolInstaller($aConfig);
    }

    function install($aParams)
    {
        $aResult = parent::install($aParams);

        if (!$aResult['result'])
            return $aResult;

        if (BxDolRequest::serviceExists('wall', 'update_handlers'))
            BxDolService::call('wall', 'update_handlers', array($this->_aConfig['home_uri'], true));

        if (BxDolRequest::serviceExists('spy', 'update_handlers'))
            BxDolService::call('spy', 'update_handlers', array($this->_aConfig['home_uri'], true));

        if (BxDolRequest::serviceExists('shoutbox', 'update_objects'))
            BxDolService::call('shoutbox', 'update_objects', array($this->_aConfig['home_uri'], true));

        BxDolService::call($this->_aConfig['home_uri'], 'map_install');

        return $aResult;
    }

    function uninstall($aParams)
    {
        if(BxDolRequest::serviceExists('wall', 'update_handlers'))
            BxDolService::call('wall', 'update_handlers', array($this->_aConfig['home_uri'], false));

        if(BxDolRequest::serviceExists('spy', 'update_handlers'))
            BxDolService::call('spy', 'update_handlers', array($this->_aConfig['home_uri'], false));

        if (BxDolRequest::serviceExists('shoutbox', 'update_objects'))
            BxDolService::call('shoutbox', 'update_objects', array($this->_aConfig['home_uri'], false));

        $aResult = parent::uninstall($aParams);

        if ($aResult['result'] && BxDolModule::getInstance('BxWmapModule'))
            BxDolService::call('wmap', 'part_uninstall', array($this->_aConfig['home_uri']));

        return $aResult;
    }
}
