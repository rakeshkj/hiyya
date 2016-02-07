<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_matches_import ('PlaygroundFormAdd');

class BxMatchPlaygroundFormEdit extends BxMatchPlaygroundFormAdd
{
    function BxMatchPlaygroundFormEdit ($oMain, $iProfileId, $iEntryId, &$aDataEntry)
    {
        parent::BxMatchPlaygroundFormAdd ($oMain, $iProfileId, $iEntryId, $aDataEntry['thumb']);

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
