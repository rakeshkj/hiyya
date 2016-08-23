<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolTwigTemplate');

/*
 * matches module View
 */
class BxMatchTemplate extends BxDolTwigTemplate
{
    var $_iPageIndex = 500;

    /**
     * Constructor
     */
    function BxMatchTemplate(&$oConfig, &$oDb)
    {
        parent::BxDolTwigTemplate($oConfig, $oDb);
    }

    function unit ($aData, $sTemplateName, &$oVotingView, $isShort = false)
    {
		
		if (null == $this->_oMain)
            $this->_oMain = BxDolModule::getInstance('BxMatchModule');

        if (!$this->_oMain->isAllowedView ($aData)) {
            $aVars = array ('extra_css_class' => 'bx_matches_unit');
            return $this->parseHtmlByName('twig_unit_private', $aVars);
        }
		$match_type_additional = '';
		$additional_image = '';
		$match_players_counts = 0;	
		$match_detail = $this->_oDb->getMatchDetails($aData['id']);
		$match_detail['id'] = $aData['id'];
		//$match_type =  ($match_detail['match_type'] == 0)?'practice_match':'team_match';
		if($match_detail['match_type'] == 0){
			
			if($match_detail['block_booking']==0) {
				$match_type = 'practice_match';
			}else{ 
				if($match_detail['block_booking']==1) {
					$match_type = 'practice_match';
					$match_type_additional = 'Repeated-Match_daily';
				} elseif($match_detail['block_booking']==2) {
					$match_type = 'practice_match';
					$match_type_additional = 'Repeated-Match_weekly';
				}
			}
			
		} else {
			
			$match_type = 'team_match';
		}
		$match_status = $this->_oDb->getMatchStatus($match_detail);
		if($match_status == 'Waiting for players') {
			$match_status_icon = 'Waiting';
		} elseif($match_status == 'Scheduled') {
			$match_status_icon = 'status_match_scheduled';
		} elseif($match_status == 'Cancelled') {
			$match_status_icon = 'Status_Cancelled';
		} elseif($match_status == 'Kick off') {
			$match_status_icon = 'status_match_Kickoff';
		} elseif($match_status == 'Time Up/Waiting for Results') {
			$match_status_icon = 'status_match_Timeup';
		} elseif($match_status == 'Waiting for Result Confirmation') {
			$match_status_icon = 'status_waitingConfirmation';
		} elseif($match_status == 'No Match Result') {
			$match_status_icon = 'no_match_result';
		} elseif($match_status == 'Played') {
			$match_status_icon = 'status_match_Played';
		}
		
		$match_status_icon = $this->_oMain->getIconFromText($match_status_icon);
		$match_type = $this->_oMain->getIconFromText($match_type);
		if($match_type_additional!='') {
		$match_type_additional = $this->_oMain->getIconFromText($match_type_additional);
		$additional_image = '<img src="'.$match_type_additional.'" alt="">';
		}
		$join_type =  ($match_detail['join_confirmation'] == 0)?'open_icon':'invite_only';
		$join_type = $this->_oMain->getIconFromText($join_type);
		$match_players_count = $this->_oDb->getMatchPlayersCount($aData['id'], $match_detail['match_type']);
		foreach ($match_players_count as $match_players_cont) {
			
			$match_players_counts +=$match_players_cont['player_count'];
		}
		//Gender
		if($match_detail['gender']==0) {
			$gender = 'Male';
			
		} elseif($match_detail['gender']==1) {
			$gender = 'Female';
		} elseif($match_detail['gender']==2) {
			$gender = '';
		}
		//$gender = $this->_oMain->getIconFromText($gender);
		if($gender!='') {
			$gender = $this->_oMain->getIconFromText($gender);
			$gender = '<img src="'.$gender.'" alt="">';
		}
        $sImage = '';
        if ($aData['thumb']) {
            $a = array ('ID' => $aData['author_id'], 'Avatar' => $aData['thumb']);
            $aImage = BxDolService::call('photos', 'get_image', array($a, 'browse'), 'Search');
            $sImage = $aImage['no_image'] ? '' : $aImage['file'];
        }

        $aVars = array (
            'id' => $aData['id'],
            'thumb_url' => $sImage ? $sImage : $this->getImageUrl('no-image-thumb.png'),
            'match_url' => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'view/' . $aData['uri'],
            'match_title' => $aData['title'],
			'match_type' => $match_type,
			'additional_image' => $additional_image,
			'gender' => $gender,
			'join_type' => $join_type,
            'created' => defineTimeInterval($aData['created']),
            'fans_count' => $match_players_counts,
			'match_status' => $match_status_icon,
            'country_city' => $this->_oMain->_formatLocation($aData),
            'snippet_text' => $this->_oMain->_formatSnippetText($aData),
            'bx_if:full' => array (
                'condition' => !$isShort,
                'content' => array (
                    'author' => getNickName($aData['author_id']),
                    'author_url' => $aData['author_id'] ? getProfileLink($aData['author_id']) : 'javascript:void(0);',
                    'created' => defineTimeInterval($aData['created']),
                    'rate' => $oVotingView ? $oVotingView->getJustVotingElement(0, $aData['id'], $aData['rate']) : '&#160;',
                ),
            ),
        );

        return $this->parseHtmlByName($sTemplateName, $aVars);
    }

    // ======================= ppage compose block functions

    function blockDesc (&$aDataEntry)
    {
        $aVars = array (
            'description' => $aDataEntry['desc'],
        );
        return $this->parseHtmlByName('block_description', $aVars);
    }
	function blockDescPg (&$aDataEntry)
    {
        $aVars = array (
            'description' => $aDataEntry['description'],
        );
        return $this->parseHtmlByName('block_description', $aVars);
    }
    function blockFields (&$aDataEntry)
    {
        $sRet = '<table class="bx_matches_fields">';
        bx_matches_import ('FormAdd');
        $oForm = new BxMatchFormAdd ($GLOBALS['oBxMatchModule'], getLoggedId());
        foreach ($oForm->aInputs as $k => $a) {
            if (!isset($a['display']) || !$aDataEntry[$k]) continue;
            $sRet .= '<tr><td class="bx_matches_field_name bx-def-font-grayed bx-def-padding-sec-right" valign="top">' . $a['caption'] . '</td><td class="bx_matches_field_value">';
            if (is_string($a['display']) && is_callable(array($this, $a['display'])))
                $sRet .= call_user_func_array(array($this, $a['display']), array($aDataEntry[$k]));
            else if (0 == strcasecmp($k, 'country'))
                $sRet .= _t($GLOBALS['aPreValues']['Country'][$aDataEntry[$k]]['LKey']);
            else
                $sRet .= $aDataEntry[$k];
            $sRet .= '</td></tr>';
        }
        $sRet .= '</table>';
        return $sRet;
    }
}
