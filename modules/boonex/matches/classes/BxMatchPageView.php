<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolTwigPageView');

class BxMatchPageView extends BxDolTwigPageView
{
    function BxMatchPageView(&$oMain, &$aDataEntry)
    {
        parent::BxDolTwigPageView('bx_matches_view', $oMain, $aDataEntry);
    }

    function getBlockCode_Info()
    {
        return array($this->_blockInfo ($this->aDataEntry, $this->_oTemplate->blockFields($this->aDataEntry), $this->_oMain->_formatLocation($this->aDataEntry, false, true)));
    }

    function getBlockCode_Desc()
    {
        return array($this->_oTemplate->blockDesc ($this->aDataEntry));
    }

    function getBlockCode_Photo()
    {
        return $this->_blockPhoto ($this->_oDb->getMediaIds($this->aDataEntry['id'], 'images'), $this->aDataEntry['author_id']);
    }

    function getBlockCode_Video()
    {
        return $this->_blockVideo ($this->_oDb->getMediaIds($this->aDataEntry['id'], 'videos'), $this->aDataEntry['author_id']);
    }

    function getBlockCode_Sound()
    {
        return $this->_blockSound ($this->_oDb->getMediaIds($this->aDataEntry['id'], 'sounds'), $this->aDataEntry['author_id']);
    }

    function getBlockCode_Files()
    {
        return $this->_blockFiles ($this->_oDb->getMediaIds($this->aDataEntry['id'], 'files'), $this->aDataEntry['author_id']);
    }

    function getBlockCode_Rate()
    {
        bx_matches_import('Voting');
        $o = new BxMatchVoting ('bx_matches', (int)$this->aDataEntry['id']);
        if (!$o->isEnabled()) return '';
        return array($o->getBigVoting ($this->_oMain->isAllowedRate($this->aDataEntry)));
    }

    function getBlockCode_Comments()
    {
        bx_matches_import('Cmts');
        $o = new BxMatchCmts ('bx_matches', (int)$this->aDataEntry['id']);
        if (!$o->isEnabled()) return '';
        return $o->getCommentsFirst ();
    }

    function getBlockCode_Actions()
    {
        global $oFunctions;

        if ($this->_oMain->_iProfileId || $this->_oMain->isAdmin()) {

            $oSubscription = new BxDolSubscription();
            $aSubscribeButton = $oSubscription->getButton($this->_oMain->_iProfileId, 'bx_matches', '', (int)$this->aDataEntry['id']);

            $isFan = $this->_oDb->isFan((int)$this->aDataEntry['id'], $this->_oMain->_iProfileId, 0) || $this->_oDb->isFan((int)$this->aDataEntry['id'], $this->_oMain->_iProfileId, 1);
			$match_type = $this->aDataEntry['match_type'];
			$match_status = $this->_oDb->getMatchStatus($this->aDataEntry);
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
				'TitleCancel' => $this->_oMain->isAllowedDelete($this->aDataEntry) ? _t('_bx_matches_action_title_cancel') : '',
				'TitleSubmit' => ($this->_oMain->isAllowedDelete($this->aDataEntry) && $match_status == 'Time Up/Waiting for Results') ? _t('_bx_matches_action_title_submit') : '',
                'TitleJoin' => $this->_oMain->isAllowedJoin($this->aDataEntry) ? ($isFan ? _t('_bx_matches_action_title_leave') : _t('_bx_matches_action_title_join')) : '',
                'IconJoin' => $isFan ? 'signout' : 'signin',
                'TitleInvite' => $this->_oMain->isAllowedSendInvitation($this->aDataEntry) ? _t('_bx_matches_action_title_invite') : '',
                'TitleShare' => $this->_oMain->isAllowedShare($this->aDataEntry) ? _t('_bx_matches_action_title_share') : '',
                'TitleBroadcast' => $this->_oMain->isAllowedBroadcast($this->aDataEntry) ? _t('_bx_matches_action_title_broadcast') : '',
                'AddToFeatured' => $this->_oMain->isAllowedMarkAsFeatured($this->aDataEntry) ? ($this->aDataEntry['featured'] ? _t('_bx_matches_action_remove_from_featured') : _t('_bx_matches_action_add_to_featured')) : '',
                'TitleManageFans' => $this->_oMain->isAllowedManageFans($this->aDataEntry) ? _t('_bx_matches_action_manage_fans') : '',
                'TitleUploadPhotos' => $this->_oMain->isAllowedUploadPhotos($this->aDataEntry) ? _t('_bx_matches_action_upload_photos') : '',
                'TitleUploadVideos' => $this->_oMain->isAllowedUploadVideos($this->aDataEntry) ? _t('_bx_matches_action_upload_videos') : '',
                'TitleUploadSounds' => $this->_oMain->isAllowedUploadSounds($this->aDataEntry) ? _t('_bx_matches_action_upload_sounds') : '',
                'TitleUploadFiles' => $this->_oMain->isAllowedUploadFiles($this->aDataEntry) ? _t('_bx_matches_action_upload_files') : '',
            );

            if (!$aInfo['TitleEdit'] && !$aInfo['TitleDelete'] && !$aInfo['TitleJoin'] && !$aInfo['TitleInvite'] && !$aInfo['TitleShare'] && !$aInfo['TitleBroadcast'] && !$aInfo['AddToFeatured'] && !$aInfo['TitleManageFans'] && !$aInfo['TitleUploadPhotos'] && !$aInfo['TitleUploadVideos'] && !$aInfo['TitleUploadSounds'] && !$aInfo['TitleUploadFiles'])
                return '';

            return $oSubscription->getData() . $oFunctions->genObjectsActions($aInfo, 'bx_matches');
        }

        return '';
    }

    function getBlockCode_Fans()
    {
        return $this->_blockFans ($this->_oDb->getParam('bx_matches_perpage_view_fans'), 'isAllowedViewFans', 'getFans');
		
    }
	
    function getBlockCode_FansUnconfirmed()
    {
        return $this->_blockFansUnconfirmed (BX_GROUPS_MAX_FANS);
    }

    function getCode()
    {
        $this->_oMain->_processFansActions ($this->aDataEntry, BX_GROUPS_MAX_FANS);

        return parent::getCode();
    }
	function _blockInfo ($aData, $sFields = '', $sLocation = '')
    {
        $aAuthor = getProfileInfo($aData['author_id']);
		$type = $aData['match_type'];
		$size = $aData['max_players'];
		$match_type_additional = '';
		$additional_image = '';
		$teams = '';$payment = '';
		$join_conf = $aData['join_confirmation'];
		if($join_conf == 0) {
			$join_type = $this->_oMain->getIconFromText('open_icon');
		} elseif($join_conf == 1) {
			$join_type = $this->_oMain->getIconFromText('invite_only');
		}
		$playground_details = $this->_oDb->getPalgroundDetails($aData['playground']);
		if($playground_details[0]['type'] == 0) {
			$pg_type = $this->_oMain->getIconFromText('5aside');
			$pg_count = 5;
		} elseif ($playground_details[0]['type'] == 1) {
			$pg_type = $this->_oMain->getIconFromText('7aside');
			$pg_count = 7;
		} elseif ($playground_details[0]['type'] == 2) {
			$pg_type = $this->_oMain->getIconFromText('11aside');
			$pg_count = 11;
		}
		$join_type = '<img class="pgicon" src="'.$join_type.'" alt="">';
		$playground_type = 	'<img class="pgicon" src="'.$pg_type.'" alt="">';
		$match_time = $aData['match_time'].":00";
		if($aData['match_type'] == 0){
			//$confirmed_player = 0;
			if($aData['block_booking']==0) {
				$match_type = 'practice_match';
			}else{ 
				if($aData['block_booking']==1) {
					$match_type = 'practice_match';
					$match_type_additional = 'Repeated-Match_daily';
				} elseif($aData['block_booking']==2) {
					$match_type = 'practice_match';
					$match_type_additional = 'Repeated-Match_weekly';
				}
				
			$end_date = date('Y-m-d',$aData['end_date']);
			
			}
			$confirmed_player = $this->_oDb->getConfirmedPlayersPractice($aData['id']);
			$pg_count = 2*$pg_count;
			$match_type_icon = $this->_oMain->getIconFromText($match_type);
			$match_type_icon = '<img class="pgicon"  src="'.$match_type_icon.'" alt="">';
			$teams = $match_type_icon .'<b>('.$confirmed_player.'/'.$pg_count.')</b>';
			//end date
		} else {
			$team_id = $this->_oDb->getMatchTeamId($aData['id']);
		    $match_team1 = $this->_oDb->getTeamDetails($team_id[0]);
			$match_team2 = $this->_oDb->getTeamDetails($team_id[1]);
			$confirmed_player1 = $this->_oDb->getConfirmedPlayersTeam($aData['id'],$team_id[0]);
			$confirmed_player2 = $this->_oDb->getConfirmedPlayersTeam($aData['id'],$team_id[1]);
			//echo '<pre>';print_r($team_id);
			$match_type = 'team_match';
			$match_type_icon = $this->_oMain->getIconFromText($match_type);
			$match_type_icon = '<img class="pgicon matchtypem"  src="'.$match_type_icon.'" alt="">';
			$teams = '['.$match_team1[0]['title'] .'<b>('.$confirmed_player1.'/'.$pg_count.')</b>&nbsp;'.$match_type_icon.'&nbsp;'. $match_team2[0]['title'].'<b>('.$confirmed_player2.'/'.$pg_count.')</b>]';
			$end_date = '';
			//$match_time = '';
		}
		$match_type = $this->_oMain->getIconFromText($match_type);
		if($match_type_additional!='') {
		$match_type_additional = $this->_oMain->getIconFromText($match_type_additional);
		$additional_image = '<img class="pgicon" src="'.$match_type_additional.'" alt="">';
		}
		$pg_id = $aData['playground'];
		$pgdetails = $this->_oDb->getPalgroundDetails($pg_id);
		$pglink = $this->_oMain->_oConfig->getBaseUri().'pgview/'.$pgdetails[0]['uri'];
		$pg_block_booking  = $aData['block_booking'];
		$gender_type = $aData['gender'];
		$match_status = $this->_oDb->getMatchStatus($aData);
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
		
		if($pg_type ==0 ){
			$playground ='Grass';
		} elseif($pg_type ==1) {
			
			$playground ='Artificial';
			
		} elseif ($pg_type ==2) {
			
			$playground ='Hard';
		} elseif ($pg_type ==3) {
			
			$playground ='Sand';
		} elseif ($pg_type ==4) {
			
			$playground ='Other';
		}
		
		if($pg_block_booking ==0 ){
			$block_booking ='No';
		} elseif($pg_block_booking ==1) {
			
			$block_booking ='Daily';
			
		} elseif ($pg_block_booking ==2) {
			
			$block_booking ='Weekly';
		} elseif ($pg_block_booking ==3) {
			
			$block_booking ='Monthly';
		}	
		
		if($indoor_type ==0 ){
			$indoor ='No';
		} elseif($indoor_type ==1) {
			
			$indoor ='Yes';
		}	
		
		if($gender_type ==0 ){
			$gender ='Male';
		} elseif($gender_type ==1) {
			
			$gender ='Female';
		} elseif ($gender_type == 2) {
			
			$gender ='';
		}
		if($gender!='') {
			$gender = $this->_oMain->getIconFromText($gender);
			$gender = '<img class="pgicon" src="'.$gender.'" alt="">';	
		} 
		$pgicon = $this->_oMain->getIconFromText('Playground-Icon');
		$pgicon = '<img class="pgicon" src="'.$pgicon.'" alt="">';	
		$price_icon = $this->_oMain->getIconFromText('Price-Icon');
		$price_icon = '<img class="pgicon" src="'.$price_icon.'" alt="">';
		$clock_icon = $this->_oMain->getIconFromText('clock_icon');
		$clock_icon = '<img class="pgicon" src="'.$clock_icon.'" alt="">';
		if(!empty($aData['payment'])) {
			
			$payment = $price_icon . $aData['payment'];
		}
        $aVars = array (
            'author_unit' => get_member_thumbnail($aAuthor['ID'], 'none', true),
            'date' => getLocaleDate($aData['created'], BX_DOL_LOCALE_DATE_SHORT),
            'date_ago' => defineTimeInterval($aData['created']),
            'match_type' => $match_type,
			'additional_image' => $additional_image,
			'match_name' => $aData['title'],
			'max_subtitude' => $aData['max_subtitude'],
			'place' => $aData['place'],
			'start_date' => date('Y-m-d',$aData['start_date']),
			'end_date' => $end_date,
			'match_time' => $match_time,
			'block_booking' => $block_booking,
			'playground' => $pglink,
			'pgtitle' => $pgdetails[0]['title'],
			'pgicon'  => $pgicon,
			'join_type' => $join_type,
			'max_age' => $aData['max_age'],
			'gender' => $gender,
			'payment' => $payment,
            'author_unit' => $GLOBALS['oFunctions']->getMemberThumbnail($aAuthor['ID'], 'none', true),
			'match_status' => $match_status_icon,
			'teams' => $teams,
			'clock_icon' => $clock_icon,
            'location' => $sLocation,
			'pg_type' => $playground_type,
        );
        return $this->_oTemplate->parseHtmlByName('entry_view_block_info', $aVars);
    }
	
	function _blockFansOld($iPerPage, $sFuncIsAllowed = 'isAllowedViewFans', $sFuncGetFans = 'getFans')
    {
        //if (!$this->_oMain->$sFuncIsAllowed($this->aDataEntry))
           // return '';

        $iPage = (int)$_GET['page'];
        if( $iPage < 1)
            $iPage = 1;
        $iStart = ($iPage - 1) * $iPerPage;

        $aProfiles = array ();
        $iNum = $this->_oDb->getFans($aProfiles, $this->aDataEntry[$this->_oDb->_sFieldId], true, 0, 2, '', 't');
        if (!$iNum || !$aProfiles)
            return MsgBox(_t("_Empty"));
		
        $sActionsUrl = BX_DOL_URL_ROOT . $this->_oMain->_oConfig->getBaseUri() . "view/" . $this->aDataEntry[$this->_oDb->_sFieldUri] . '?ajax_action=';
        $aButtons = array (
            array (
                'type' => 'submit',
                'name' => 'player_delete',
                'value' => _t('_sys_btn_players_delete'),
                'onclick' => "onclick=\"getHtmlData('sys_manage_items_delete_players_content', '{$sActionsUrl}delete&ids=' + sys_manage_items_get_unconfirmed_fans_ids(), false, 'post'); return false;\"",
            ),
            /*array (
                'type' => 'submit',
                'name' => 'fans_confirm',
                'value' => _t('_sys_btn_fans_confirm'),
                'onclick' => "onclick=\"getHtmlData('sys_manage_items_unconfirmed_fans_content', '{$sActionsUrl}confirm&ids=' + sys_manage_items_get_unconfirmed_fans_ids(), false, 'post'); return false;\"",
            ),*/
        );
        bx_import ('BxTemplSearchResult');
        $sControl = BxTemplSearchResult::showAdminActionsPanel('sys_manage_items_unconfirmed_fans', $aButtons, 'sys_fan_unit');
        bx_import('BxTemplSearchProfile');
        $oBxTemplSearchProfile = new BxTemplSearchProfile();
        $sMainContent = '';
		$i=0;
        foreach ($aProfiles as $aProfile) {

			if($i==0) {
			$sMainContent .= '<div><b>Home</b></div>';
			} elseif($i==1) {
				
				$sMainContent .= '<div><b>Away</b></div>';
			} 
            $sMainContent .= $this->displaySearchUnit($aProfile, array ('ext_css_class' => 'bx-def-margin-sec-top-auto'));
			$i++;
        }
        $ret .= $sMainContent;
        $ret .= '<div class="clear_both"></div>';

        /*$oPaginate = new BxDolPaginate(array(
            'page_url' => 'javascript:void(0);',
            'count' => $iNum,
            'per_page' => $iPerPage,
            'page' => $iPage,
            'on_change_page' => 'return !loadDynamicBlock({id}, \'' . bx_append_url_params(BX_DOL_URL_ROOT . $this->_oMain->_oConfig->getBaseUri() . "view/" . $this->aDataEntry[$this->_oDb->_sFieldUri], 'page={page}&per_page={per_page}') . '\');',
        ));
        $sAjaxPaginate = $oPaginate->getSimplePaginate('', -1, -1, false);*/
		$aVars = array(
            'suffix' => 'confirmed_fans',
            'content' => $sMainContent,
            'control' => $sControl,
        );
        return $this->_oMain->_oTemplate->parseHtmlByName('manage_items_form_match', $aVars);
        //return array($ret, array(), $sAjaxPaginate);
    }
	
	function displaySearchUnit($aData, $aExtendedCss = array())
    {
		
        $sCode = '';
        $sOutputMode = (isset ($_GET['search_result_mode']) && $_GET['search_result_mode']=='ext') ? 'ext' : 'sim';

        $sTemplateName = 'match_team_list.html';

        if ($sTemplateName) {
                $sCode .= $this->PrintSearhResult( $aData, array(), $aExtendedCss, $sTemplateName );
        }
        return $sCode;
    }
	function PrintSearhResult($aProfileInfo, $aCoupleInfo = '', $aExtendedKey = null, $sTemplateName = '', $oCustomTemplate = null)
    {
        

        $sProfileThumb = get_member_thumbnail( $aProfileInfo['ID'], 'none', ! $bExtMode, 'visitor' );
        
        $team_details = $this->_oDb->getTeamDetails($aProfileInfo['team_id']);
		
		$aPlayersProfiles = array ();
        $iNum = $this->_oDb->getTeamPlayers($aPlayersProfiles, $this->aDataEntry[$this->_oDb->_sFieldId], true, 'p',$aProfileInfo['team_id']);
		//echo '<pre>';print_r($aPlayersProfiles);
		foreach ($aPlayersProfiles as $aPlayersProfile) {
			
			$sProfileThumbPlayer[] = array ( 'thumbplayer' => get_member_thumbnail( $aPlayersProfile['ID'], 'none', ! $bExtMode, 'visitor' ), 'input_check_player' => '<div class="bx_sys_unit_checkbox bx-def-round-corners">
            <input type="checkbox" name="sys_players_unit[]" value="'.$aPlayersProfile['team_id'].'" /></div>');
		}
		
        $aKeys = array(
            'thumbnail' => $sProfileThumb,
			'input_check' => '
            <input type="checkbox" name="sys_fan_unit[]" value="'.$aProfileInfo['team_id'].'" />',
			'team_name' => $team_details[0]['title'],
			'link' => "m/teams/view/".$team_details[0]['uri'],
			'bx_if:teamadmin' => array (
                    'condition' => $aProfileInfo['id_profile'] == $this->_oMain->_iProfileId,
                    'content' => array (
						'invite_link'=> 'm/matches/inviteteamplayers/'.$this->aDataEntry[$this->_oDb->_sFieldId].'/'.$aProfileInfo['team_id']
					)
                ),
			'bx_if:teamPlayer' => array (
                    'condition' => !empty($aPlayersProfiles),
                    'content' => array (
						'bx_repeat:team_player' => $sProfileThumbPlayer,
						
						
					)
                ),
            
        );

        if ( $aExtendedKey and is_array($aExtendedKey) and !empty($aExtendedKey) ) {
            foreach($aExtendedKey as $sKey => $sValue )
                $aKeys[$sKey] = $sValue;
        } else {
            $aKeys['ext_css_class'] = '';
        }

        return ($oCustomTemplate) ? $oCustomTemplate->parseHtmlByName($sTemplateName, $aKeys) : $GLOBALS['oSysTemplate']->parseHtmlByName($sTemplateName, $aKeys);
    }
	
	function _blockFansUnconfirmed($iFansLimit = 1000)
    {
        $aProfiles = array ();
		if($this->aDataEntry['match_type'] == 0){
			$iNum = $this->_oDb->getMatchTeamUnconfirmedPractice($aProfiles, $this->aDataEntry[$this->_oDb->_sFieldId], 0, 20, '', '0',0);
		} else {
			$iNum = $this->_oDb->getMatchTeamUnconfirmed($aProfiles, $this->aDataEntry[$this->_oDb->_sFieldId], 0, 2, '', 't');
		}
        if (!$iNum)
            return MsgBox(_t('_Empty'));
	
        $match_team_owner = $this->_oDb->getMatchTeamOwnerId($this->aDataEntry[$this->_oDb->_sFieldId]);
        $sActionsUrl = BX_DOL_URL_ROOT . $this->_oMain->_oConfig->getBaseUri() . "view/" . $this->aDataEntry[$this->_oDb->_sFieldUri] . '?ajax_action=';
        $aButtons = array (
            array (
                'type' => 'submit',
                'name' => 'player_delete',
                'value' => _t('_sys_btn_players_delete'),
                'onclick' => "onclick=\"getHtmlData('sys_manage_items_delete_players_content', '{$sActionsUrl}deletetmatch&ids=' + sys_manage_items_get_unconfirmed_fans_ids(), false, 'post',true); return false;\"",
            )
        );
        bx_import ('BxTemplSearchResult');
		if($this->aDataEntry['author_id'] == $this->_oMain->_iProfileId || @in_array($this->_oMain->_iProfileId,$match_team_owner)) {
        $sControl = BxTemplSearchResult::showAdminActionsPanel('sys_manage_items_unconfirmed_fans', $aButtons, 'sys_fan_unit', false);
		}
		//echo '<pre>';print_r($aProfiles);
        $aVars = array(
            'suffix' => 'unconfirmed_fans',
            'content' => $this->_profilesEdit($aProfiles),
            'control' => $sControl,
        );
        return $this->_oMain->_oTemplate->parseHtmlByName('manage_items_form_match', $aVars);
    }
	
	function _profilesEdit(&$aProfiles, $isCenterContent = false, $aDataEntry = array())
    {
        $sResult = "";
		$i=0;
        foreach($aProfiles as $aProfile) {
			$sProfileThumbPlayer = array ();
			$iNum = $this->_oDb->getTeamPlayers($aPlayersProfiles, $this->aDataEntry[$this->_oDb->_sFieldId], 0, 'p',$aProfile['team_id']);
			
			foreach ($aPlayersProfiles as $aPlayersProfile) {
				
				if($this->_oMain->_iProfileId==$aProfile['id_profile']) {
					
					$checkbox = '<div class="bx_sys_unit_checkbox bx-def-round-corners">
            <input type="checkbox" name="sys_players_unit[]" value="'.$aPlayersProfile['team_id'].'-'.$aPlayersProfile['id_profile'].'" /></div>';
				}
				$sProfileThumbPlayer[] = array ( 'thumbplayer' => get_member_thumbnail( $aPlayersProfile['ID'], 'none', ! $bExtMode, 'visitor' ), 'input_check_player' => $checkbox, 'player_response' => '' );
			}
			$team_details = $this->_oDb->getTeamDetails($aProfile['team_id']);
			
            $aVars = array(
                'id' => $aProfile['ID'],
                'thumb' => get_member_thumbnail($aProfile['ID'], 'none', true),
				'team_name' => $team_details[0]['title'],
				'link' => "m/teams/view/".$team_details[0]['uri'],
                'bx_if:admin' => array (
                    'condition' => $this->aDataEntry && ($this->aDataEntry['author_id'] == $this->_oMain->_iProfileId),
                    'content' => array ('id' => $aProfile['ID'], 'team_id' => $aProfile['team_id']),
                ),
				'bx_if:confirmed' => array (
                    'condition' => $aProfile['confirmed'] == 0 ,
                    'content' => array ('id' => $aProfile['ID']),
                ),
				'bx_if:teamPlayer' => array (
                    'condition' => !empty($sProfileThumbPlayer),
                    'content' => array (
						'bx_repeat:team_player' => $sProfileThumbPlayer
						
					)
                ),
				
				'bx_if:teamadmin' => array (
                    'condition' => false,//$aProfile['id_profile'] == $this->_oMain->_iProfileId,
                    'content' => array (
						'invite_link'=> 'm/matches/inviteteamplayers/'.$this->aDataEntry[$this->_oDb->_sFieldId].'/'.$aProfile['team_id']
					)
                ),
				'bx_if:pmatch' => array (
                    'condition' => false,
                    'content' => array (
						'player_response_practice'=> $player_response
					)
                ),
            );
			if($this->aDataEntry['match_type'] == 1){
				if($i==0) {
				$sResult .= '<div><b>Home</b></div>';
				} elseif($i==1) {
					
					$sResult .= '<div><b>Away</b></div>';
				} 
			$i++;	
			$sResult .= $this->_oTemplate->parseHtmlByName('unit_fan_match', $aVars);	
			} else {
            $sResult .= $this->_oTemplate->parseHtmlByName('unit_fan_match_practice', $aVars);
			}
			

        }

        return $isCenterContent ? $GLOBALS['oFunctions']->centerContent ($sResult, '.sys_fan_unit') : $sResult;
    }
	function _blockFans($iFansLimit = 1000)
    {
        $aProfiles = array ();
		if($this->aDataEntry['match_type'] == 0){ 
		$iNum = $this->_oDb->getMatchTeam($aProfiles, $this->aDataEntry[$this->_oDb->_sFieldId], 0, 20, '', '0',1);
		} else {
        $iNum = $this->_oDb->getMatchTeam($aProfiles, $this->aDataEntry[$this->_oDb->_sFieldId], 0, 2, '', 't',1);
		}
        if (!$iNum)
            return MsgBox(_t('_Empty'));
		
		$match_team_owner = $this->_oDb->getMatchTeamOwnerId($this->aDataEntry[$this->_oDb->_sFieldId]);
        $sActionsUrl = BX_DOL_URL_ROOT . $this->_oMain->_oConfig->getBaseUri() . "view/" . $this->aDataEntry[$this->_oDb->_sFieldUri] . '?ajax_action=';
        $aButtons = array (
            array (
                'type' => 'submit',
                'name' => 'player_delete',
                'value' => _t('_sys_btn_players_delete'),
                'onclick' => "onclick=\"getHtmlData('sys_manage_items_delete_players_content', '{$sActionsUrl}deletetmatch&ids=' + sys_manage_items_get_unconfirmed_fans_ids(), false, 'post',true); return false;\"",
            )
        );
        bx_import ('BxTemplSearchResult');
		if($this->aDataEntry['author_id'] == $this->_oMain->_iProfileId || @in_array($this->_oMain->_iProfileId,$match_team_owner)) {
        $sControl = BxTemplSearchResult::showAdminActionsPanel('sys_manage_items_unconfirmed_fans', $aButtons, 'sys_fan_unit', false);
		}
        $aVars = array(
            'suffix' => 'unconfirmed_fans',
            'content' => $this->_profilesEditFanConfirm($aProfiles),
            'control' => $sControl,
        );
        return $this->_oMain->_oTemplate->parseHtmlByName('manage_items_form_match', $aVars);
    }
	
	function _profilesEditFanConfirm(&$aProfiles, $isCenterContent = false, $aDataEntry = array())
    {
        $sResult = "";
		$i=0;
		$home_score = '';
		$away_score = '';
		$team_result = $this->_oDb->teamResult($this->aDataEntry[$this->_oDb->_sFieldId]);
		$match_status = $this->_oDb->getMatchStatus($this->aDataEntry);
		$match_uri = 'm/matches/view/'.$this->aDataEntry['uri'];
		$image_icon = 'templates/base/images/icons/delete.png';
		if($team_result['home_team_score'] && $team_result['away_team_score']){
			
			$home_score = 'Score  '. $team_result['home_team_score'];
			$away_score = 'Score  '. $team_result['away_team_score'];
		}
		
		if(!empty($team_result)){ //&& $match_status == 'Waiting for Result Confirmation'
		    if($aDataEntry['match_type'] == '1') {
				$home_players = $team_result['home_team_players'];
				$away_players = $team_result['away_team_players'];
				
					$home_players_array = explode(',', $home_players);
				
					$away_players_array = explode(',', $away_players);
								
				if(isset($home_players_array) && isset($away_players_array)) {
				$players = array_merge($home_players_array,$away_players_array);
				} elseif(isset($home_players_array)) {
					$players = $home_players_array;
				} elseif(isset($away_players_array)) { 
					$players = $away_players_array;
				}
			} else {
				
				$home_players = $team_result['home_team_players'];
				$home_players_array = explode(',', $home_players);
				$players = $home_players_array;
			}
		}
		//echo '<pre>';print_r($aProfiles);
        foreach($aProfiles as $aProfile) {
			$sProfileThumbPlayer = array ();
			$player_response = '';
			$checkbox = '';
			$iNum = $this->_oDb->getTeamPlayers($aPlayersProfiles, $this->aDataEntry[$this->_oDb->_sFieldId], 1, 'p',$aProfile['team_id']);
			//echo '<pre>';print_r($aPlayersProfiles);
			foreach ($aPlayersProfiles as $aPlayersProfile) {
				if($this->_oMain->_iProfileId==$aProfile['id_profile']) {
					
					$checkbox = '<div class="bx_sys_unit_checkbox bx-def-round-corners">
            <input type="checkbox" name="sys_players_unit[]" value="'.$aPlayersProfile['team_id'].'-'.$aPlayersProfile['id_profile'].'" /></div>';
			}
			       if(!empty($players)) {      
				   //$this->_oDb->maxApprovalTime($this->aDataEntry[$this->_oDb->_sFieldId])
					   if(in_array($aPlayersProfile['id_profile'], $players)) {
						if($this->_oDb->maxApprovalTime($this->aDataEntry) && $aPlayersProfile['id_profile'] == $this->_oMain->_iProfileId) {  
						   
$player_response = <<<EOR

<button onclick="getHtmlData('sys_manage_items_player_response_content', '{$match_uri}?ajax_action=reject_score&amp;ids={$aProfile['id_profile']}', false, 'post',true); return false;" name="fans_reject" value="Reject" type="submit">Reject</button>

EOR;
						} else {
							$player_response = "";
						}

					   } else {
						  $player_response =  '<img src="'.$image_icon.'" alt="Result not submitted">'; //'strikethrough';//   
					   }
					} 
					
				$sProfileThumbPlayer[] = array ( 'thumbplayer' => get_member_thumbnail( $aPlayersProfile['ID'], 'none', ! $bExtMode, 'visitor' ), 'input_check_player' => $checkbox, 'player_response' => $player_response);
				
				//$sProfileThumbPlayerPractice[] = array ('player_response' => $player_response);
			}
			//practice match response
			if($this->aDataEntry['match_type'] == 0){ 
			
				if(!empty($players)) {      
				   //$this->_oDb->maxApprovalTime($this->aDataEntry[$this->_oDb->_sFieldId])
					   if(in_array($aProfile['id_profile'], $players)) {
						if($this->_oDb->maxApprovalTime($this->aDataEntry) && $aProfile['id_profile'] == $this->_oMain->_iProfileId) {  
						   
$player_response_practice = <<<EOR

<button onclick="getHtmlData('sys_manage_items_player_response_content', '{$match_uri}?ajax_action=reject_score&amp;ids={$aProfile['id_profile']}', false, 'post',true); return false;" name="fans_reject" value="Reject" type="submit">Reject</button>

EOR;
						} else {
							$player_response_practice = " ";
						}

					   } else {
						  $player_response_practice =  '<img src="'.$image_icon.'" alt="Result not submitted">';//'strikethrough';//    
					   }
					} 
			}
			//end here
			$team_details = $this->_oDb->getTeamDetails($aProfile['team_id']);
            $aVars = array(
                'id' => $aProfile['ID'],
                'thumb' => get_member_thumbnail($aProfile['ID'], 'none', true),
				'team_name' => $team_details[0]['title'],
				'link' => "m/teams/view/".$team_details[0]['uri'],
                'bx_if:admin' => array (
                    'condition' => $this->aDataEntry && ($this->aDataEntry['author_id']==$this->_oMain->_iProfileId),
                    'content' => array ('id' => $aProfile['ID'], 'team_id' => $aProfile['team_id']),
                ),
				'bx_if:confirmed' => array (
                    'condition' => $aProfile['confirmed'] == 0 ,
                    'content' => array ('id' => $aProfile['ID']),
                ),
				'bx_if:teamPlayer' => array (
                    'condition' => !empty($sProfileThumbPlayer),
                    'content' => array (
						'bx_repeat:team_player' => $sProfileThumbPlayer
						
					)
                ),
				
				'bx_if:teamadmin' => array (
                    'condition' => $aProfile['id_profile'] == $this->_oMain->_iProfileId,
                    'content' => array (
						'invite_link'=> 'm/matches/inviteteamplayers/'.$this->aDataEntry[$this->_oDb->_sFieldId].'/'.$aProfile['team_id']
					)
                ),
				
				'bx_if:match_submitted' => array (
                    'condition' => $aProfile['id_profile'] == $this->_oMain->_iProfileId,
                    'content' => array (
						'invite_link'=> 'm/matches/inviteteamplayers/'.$this->aDataEntry[$this->_oDb->_sFieldId].'/'.$aProfile['team_id']
					)
                ),
				'bx_if:pmatch' => array (
                    'condition' => !empty($player_response_practice),
                    'content' => array (
						'player_response_practice'=> $player_response_practice
					)
                ),
            );
			if($this->aDataEntry['match_type'] == 1){ 
				if($i==0) {
				$sResult .= '<div><b>Home</b>  <div>' .$home_score.'</div></div>';
				} elseif($i==1) {
					
					$sResult .= '<div><b>Away</b>   <div>'.   $away_score.'</div></div>';
				} 
				$sResult .= $this->_oTemplate->parseHtmlByName('unit_fan_match', $aVars);
			} else {
				
				$sResult .= $this->_oTemplate->parseHtmlByName('unit_fan_match_practice', $aVars);
			}	
			$i++;
        
	}
        return $isCenterContent ? $GLOBALS['oFunctions']->centerContent ($sResult, '.sys_fan_unit') : $sResult;
    
	
	}
}
