<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_teams_import ('FormAdd');

class BxTeamsFormEdit extends BxTeamsFormAdd
{
    function BxTeamsFormEdit ($oMain, $iProfileId, $iEntryId, &$aDataEntry)
    {
        parent::BxTeamsFormAdd ($oMain, $iProfileId, $iEntryId, $aDataEntry['thumb']);

        $aFormInputsId = array (
            'id' => array (
                'type' => 'hidden',
                'name' => 'id',
                'value' => $iEntryId,
            ),
        );

        bx_import('BxDolCategories');
        $oCategories = new BxDolCategories();
        $oCategories->getTagObjectConfig ();
        //$this->aInputs['categories'] = $oCategories->getGroupChooser ('bx_teams', (int)$iProfileId, true, $aDataEntry['categories']);

        $this->aInputs = array_merge($this->aInputs, $aFormInputsId);
    }

}
