<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_matches_import ('FormAdd');

class BxMatchFormEdit extends BxMatchFormAdd
{
    function BxMatchFormEdit ($oMain, $iProfileId, $iEntryId, &$aDataEntry)
    {
        parent::BxMatchFormAdd ($oMain, $iProfileId, $iEntryId, $aDataEntry['thumb']);

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
        //$this->aInputs['categories'] = $oCategories->getGroupChooser ('bx_matches', (int)$iProfileId, true, $aDataEntry['categories']);

        $this->aInputs = array_merge($this->aInputs, $aFormInputsId);
    }

}
