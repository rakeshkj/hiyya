<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxTemplVotingView');

class BxTeamsVoting extends BxTemplVotingView
{
    /**
     * Constructor
     */
    function BxTeamsVoting($sSystem, $iId)
    {
        parent::BxTemplVotingView($sSystem, $iId);
    }

    function getMain()
    {
        return BxDolModule::getInstance('BxTeamsModule');
    }

    function checkAction ()
    {
        if (!parent::checkAction())
            return false;
        $oMain = $this->getMain();
        $aDataEntry = $oMain->_oDb->getEntryById($this->getId ());
        return $oMain->isAllowedRate($aDataEntry);
    }
}
