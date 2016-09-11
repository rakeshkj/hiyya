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
		
		$ball_hire = $aData['ballhire'];
		if($ball_hire==1) {
		$ball_hire_icon_url = $this->_oMain->getIconFromText('Ball-hire');
		$ball_hire_icon = '<img src="'.$ball_hire_icon_url.'" alt="">';
		} else {
			$ball_hire_icon = '';
		}
		$ball_bump = $aData['ballbump'];
		if($ball_bump==1) {	
		$ball_bump_icon_url = $this->_oMain->getIconFromText('Ball-pump');
		$ball_bump_icon = '<img  src="'.$ball_bump_icon_url.'" alt="">';
		} else {
			$ball_bump_icon = '';
		}
		$netted = $aData['netted'];
		if($netted==1) {	
		$netted_icon_url = $this->_oMain->getIconFromText('Netted');
		$netted_icon = '<img src="'.$netted_icon_url.'" alt="">';
		} else {
			$netted_icon = '';
		}
		$with_lines = $aData['withlines'];
		if($with_lines==1) {	
		$with_lines_url = $this->_oMain->getIconFromText('With');
		$with_lines_icon = '<img src="'.$with_lines_url.'" alt="">';
		} else {
			$with_lines_icon = '';
		}
		$shop = $aData['shop'];
		if($shop==1) {	
		$shop_url = $this->_oMain->getIconFromText('Shop');
		$shop_icon = '<img  src="'.$shop_url.'" alt="">';
		} else {
			$shop_icon = '';
		}
		$wc = $aData['WC'];
		if($wc==1) {	
		$wc_url = $this->_oMain->getIconFromText('wc');
		$wc_icon = '<img src="'.$wc_url.'" alt="">';
		} else {
			$wc_icon = '';
		}
		$water = $aData['water'];
		if($water==1) {	
		$water_url = $this->_oMain->getIconFromText('Water');
		$water_icon = '<img src="'.$water_url.'" alt="">';
		} else {
			$water_icon = '';
		}
		
		if($type ==0 ){
			$matchtype ='5aside';
		} elseif($type ==1) {
			
			$matchtype ='7aside';
			
		} elseif ($type ==2) {
			
			$matchtype ='11aside';
		}
		$matchtype = $this->_oMain->getIconFromText($matchtype);
		if($pitch_type ==0 ){
			$pitchtype ='Real-grass';
		} elseif($pitch_type ==1) {
			
			$pitchtype ='Artificial';
			
		} elseif ($pitch_type ==2) {
			
			$pitchtype ='Hard-floor';
		} elseif ($pitch_type ==3) {
			
			$pitchtype ='Sand';
		} elseif ($pitch_type ==4) {
			
			$pitchtype ='No-field';
		}
		$pitchtype = $this->_oMain->getIconFromText($pitchtype);
		if($indoor_type ==0 ){
			$indoor ='Outdoor';
		} elseif($indoor_type ==1) {
			
			$indoor ='Indoor';
		}
		$indoor = $this->_oMain->getIconFromText($indoor);	
		$playground_icon = $this->_oMain->getIconFromText('Playground-Icon');
		$price_icon = $this->_oMain->getIconFromText('Price-Icon');	
		if(!empty($aData['price_per_hour'])) {
			$price_per_hrs = '<img src="'.$price_icon.'" alt=""><b>='.$aData['price_per_hour'].'</b>';
		} else {
			$price_per_hrs = '';
		}
		if($aData['author_id']==1) {
			$status_url = $this->_oMain->getIconFromText('Verified');	
			$status = '<img src="'.$status_url.'" alt="">'; 
		} else {
			
			$status = ''; 
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
			'price_per_hour' => $price_per_hrs,
            'author_unit' => $GLOBALS['oFunctions']->getMemberThumbnail($aAuthor['ID'], 'none', true),
            'location' => $sLocation,
			'pg_name' => $aData['title'],
			'pg_icon' => $playground_icon,
			'ball_hire' => $ball_hire_icon,
			'ball_bump' => $ball_bump_icon,
			'netted' => $netted_icon,
			'with_lines' => $with_lines_icon,
			'shop' => $shop_icon,
			'wc' => $wc_icon,
			'water' => $water_icon,
			'status' => $status,
        );
        return $this->_oTemplate->parseHtmlByName('entry_view_block_pg_info', $aVars);
    }
}
