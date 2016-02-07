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
        return parent::_blockFans ($this->_oDb->getParam('bx_matches_perpage_view_fans'), 'isAllowedViewFans', 'getFans');
    }

    function getBlockCode_FansUnconfirmed()
    {
        return parent::_blockFansUnconfirmed (BX_GROUPS_MAX_FANS);
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
		$match_type = ($type==0)?'Practice':'Team';
		//$match_size = ($cat==0)?'5-a-side':'10-a-side';
		$pg_id = $aData['playground'];
		$pgdetails = $this->_oDb->getPalgroundDetails($pg_id);
		$pglink = $this->_oMain->_oConfig->getBaseUri().'pgview/'.$pgdetails[0]['uri'];
		$pg_block_booking  = $aData['block_booking'];
		//$indoor_type = $aData['indoor'];
		$gender_type = $aData['gender'];
		$player_count = $aData['fans_count'];
		$min_player_match = $pgdetails[0]['min_players'];
		$max_player_match = $pgdetails[0]['max_players'];
		if($max_player_match == $player_count) {
			$match_status = 'Match Max players capacity reached';
			
		} elseif($min_player_match == $player_count) {
			
			$match_status = 'Scheduled';
		} else {
			
			$match_status = 'Waiting for players';
		}
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
			
			$gender ='Any';
		}
		
        $aVars = array (
            'author_unit' => get_member_thumbnail($aAuthor['ID'], 'none', true),
            'date' => getLocaleDate($aData['created'], BX_DOL_LOCALE_DATE_SHORT),
            'date_ago' => defineTimeInterval($aData['created']),
            'match_type' => $match_type,
			//'match_size' => $match_size,
			'max_subtitude' => $aData['max_subtitude'],
			'place' => $aData['place'],
			'start_date' => date('Y-m-d',$aData['start_date']),
			'end_date' => date('Y-m-d',$aData['end_date']),
			'match_time' => $aData['match_time'].":00",
			'block_booking' => $block_booking,
			'playground' => $pglink,
			'pgtitle' => $pgdetails[0]['title'],
			'max_age' => $aData['max_age'],
			'gender' => $gender,
			'payment' => $aData['payment'],
            'author_unit' => $GLOBALS['oFunctions']->getMemberThumbnail($aAuthor['ID'], 'none', true),
			'match_status' => $match_status,
            'location' => $sLocation,
        );
        return $this->_oTemplate->parseHtmlByName('entry_view_block_info', $aVars);
    }
}
