<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolTwigPageView');

class BxMatchPagePgview extends BxDolTwigPageView
{
    function BxMatchPagePgview(&$oMain, &$aDataEntry)
    {
        parent::BxDolTwigPageView('bx_matches_pgview', $oMain, $aDataEntry);
    }

    function getBlockCode_Info()
    {
        return array($this->_blockInfo ($this->aDataEntry, $this->_oTemplate->blockFields($this->aDataEntry), $this->_oMain->_formatLocation($this->aDataEntry, false, true)));
    }

    function getBlockCode_Desc()
    {
        return array($this->_oTemplate->blockDescPg ($this->aDataEntry));
    }

    function getBlockCode_Photo()
    {
        return $this->_blockPhoto ($this->_oDb->getMediaIds($this->aDataEntry['id'], 'images'), $this->aDataEntry['author_id']);
    }
    function getBlockCode_Actions()
    {
        global $oFunctions;

        if ($this->_oMain->_iProfileId || $this->_oMain->isAdmin()) {

            $oSubscription = new BxDolSubscription();
            $aSubscribeButton = $oSubscription->getButton($this->_oMain->_iProfileId, 'bx_matches_pg', '', (int)$this->aDataEntry['id']);
            $aInfo = array (
                'BaseUri' => $this->_oMain->_oConfig->getBaseUri(),
                'iViewer' => $this->_oMain->_iProfileId,
                'ownerID' => (int)$this->aDataEntry['author_id'],
                'ID' => (int)$this->aDataEntry['id'],
                'URI' => $this->aDataEntry['uri'],
                'ScriptSubscribe' => $aSubscribeButton['script'],
                'TitleSubscribe' => $aSubscribeButton['title'],
                'TitleEdit' => $this->_oMain->isAllowedEdit($this->aDataEntry) ? _t('_bx_matches_action_title_edit') : '',
                'TitleDelete' => $this->_oMain->isAllowedDelete($this->aDataEntry) ? _t('_bx_matches_action_title_delete') : '',
                'TitleUploadPhotos' => $this->_oMain->isAllowedUploadPhotos($this->aDataEntry) ? _t('_bx_matches_action_upload_photos') : '',
            );

            if (!$aInfo['TitleEdit'] && !$aInfo['TitleDelete'] &&  !$aInfo['TitleUploadPhotos'])
                return '';

            return $oSubscription->getData() . $oFunctions->genObjectsActions($aInfo, 'bx_matches_pg');
        }

        return '';
    }
	function _blockInfo ($aData, $sFields = '', $sLocation = '')
    {
        $aAuthor = getProfileInfo($aData['author_id']);
		$type = $aData['type'];
		$pitch_type = $aData['pitch_type'];
		$indoor_type = $aData['indoor'];
		if($type ==0 ){
			$matchtype ='5-a-side';
		} elseif($type ==1) {
			
			$matchtype ='7-a-side';
			
		} elseif ($type ==1) {
			
			$matchtype ='7-a-side';
		}
		if($pitch_type ==0 ){
			$pitchtype ='Grass';
		} elseif($pitch_type ==1) {
			
			$pitchtype ='Artificial';
			
		} elseif ($pitch_type ==2) {
			
			$pitchtype ='Hard';
		} elseif ($pitch_type ==3) {
			
			$pitchtype ='Sand';
		} elseif ($pitch_type ==4) {
			
			$pitchtype ='Other';
		}
		
		if($indoor_type ==0 ){
			$indoor ='No';
		} elseif($indoor_type ==1) {
			
			$indoor ='Yes';
		}	
        $aVars = array (
            'author_unit' => get_member_thumbnail($aAuthor['ID'], 'none', true),
            'date' => getLocaleDate($aData['created'], BX_DOL_LOCALE_DATE_SHORT),
            'date_ago' => defineTimeInterval($aData['created']),
			'match_type' => $matchtype,
            'min_player' => $aData['min_players'],
            'max_player' => $aData['max_players'],
            'address' => $aData['address'],
			'gps_location' => $aData['gps_location'],
			'pitch_type' => $pitchtype,
			'indoor' => $indoor,
			'price_per_hour' => $aData['price_per_hour'],
            'author_unit' => $GLOBALS['oFunctions']->getMemberThumbnail($aAuthor['ID'], 'none', true),
            'location' => $sLocation,
        );
        return $this->_oTemplate->parseHtmlByName('entry_view_block_pg_info', $aVars);
    }
}
