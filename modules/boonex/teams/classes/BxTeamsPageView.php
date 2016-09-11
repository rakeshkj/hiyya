<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolTwigPageView');

class BxTeamsPageView extends BxDolTwigPageView
{
    function BxTeamsPageView(&$oMain, &$aDataEntry)
    {
        parent::BxDolTwigPageView('bx_teams_view', $oMain, $aDataEntry);
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
        bx_teams_import('Voting');
        $o = new BxTeamsVoting ('bx_teams', (int)$this->aDataEntry['id']);
        if (!$o->isEnabled()) return '';
        return array($o->getBigVoting ($this->_oMain->isAllowedRate($this->aDataEntry)));
    }

    function getBlockCode_Comments()
    {
        bx_teams_import('Cmts');
        $o = new BxTeamsCmts ('bx_teams', (int)$this->aDataEntry['id']);
        if (!$o->isEnabled()) return '';
        return $o->getCommentsFirst ();
    }

    function getBlockCode_Actions()
    {
        global $oFunctions;

        if ($this->_oMain->_iProfileId || $this->_oMain->isAdmin()) {

            $oSubscription = new BxDolSubscription();
            $aSubscribeButton = $oSubscription->getButton($this->_oMain->_iProfileId, 'bx_teams', '', (int)$this->aDataEntry['id']);

            $isFan = $this->_oDb->isFan((int)$this->aDataEntry['id'], $this->_oMain->_iProfileId, 0) || $this->_oDb->isFan((int)$this->aDataEntry['id'], $this->_oMain->_iProfileId, 1);

            $aInfo = array (
                'BaseUri' => $this->_oMain->_oConfig->getBaseUri(),
                'iViewer' => $this->_oMain->_iProfileId,
                'ownerID' => (int)$this->aDataEntry['author_id'],
                'ID' => (int)$this->aDataEntry['id'],
                'URI' => $this->aDataEntry['uri'],
                'ScriptSubscribe' => $aSubscribeButton['script'],
                'TitleSubscribe' => $aSubscribeButton['title'],
                'TitleEdit' => $this->_oMain->isAllowedEdit($this->aDataEntry) ? _t('_bx_teams_action_title_edit') : '',
                'TitleDelete' => $this->_oMain->isAllowedDelete($this->aDataEntry) ? _t('_bx_teams_action_title_delete') : '',
                'TitleJoin' => $this->_oMain->isAllowedJoin($this->aDataEntry) ? ($isFan ? _t('_bx_teams_action_title_leave') : _t('_bx_teams_action_title_join')) : '',
                'IconJoin' => $isFan ? 'signout' : 'signin',
                'TitleInvite' => $this->_oMain->isAllowedSendInvitation($this->aDataEntry) ? _t('_bx_teams_action_title_invite') : '',
                'TitleShare' => $this->_oMain->isAllowedShare($this->aDataEntry) ? _t('_bx_teams_action_title_share') : '',
                'TitleBroadcast' => $this->_oMain->isAllowedBroadcast($this->aDataEntry) ? _t('_bx_teams_action_title_broadcast') : '',
                'AddToFeatured' => $this->_oMain->isAllowedMarkAsFeatured($this->aDataEntry) ? ($this->aDataEntry['featured'] ? _t('_bx_teams_action_remove_from_featured') : _t('_bx_teams_action_add_to_featured')) : '',
                'TitleManageFans' => $this->_oMain->isAllowedManageFans($this->aDataEntry) ? _t('_bx_teams_action_manage_fans') : '',
                'TitleUploadPhotos' => $this->_oMain->isAllowedUploadPhotos($this->aDataEntry) ? _t('_bx_teams_action_upload_photos') : '',
                'TitleUploadVideos' => $this->_oMain->isAllowedUploadVideos($this->aDataEntry) ? _t('_bx_teams_action_upload_videos') : '',
                'TitleUploadSounds' => $this->_oMain->isAllowedUploadSounds($this->aDataEntry) ? _t('_bx_teams_action_upload_sounds') : '',
                'TitleUploadFiles' => $this->_oMain->isAllowedUploadFiles($this->aDataEntry) ? _t('_bx_teams_action_upload_files') : '',
            );

            if (!$aInfo['TitleEdit'] && !$aInfo['TitleDelete'] && !$aInfo['TitleJoin'] && !$aInfo['TitleInvite'] && !$aInfo['TitleShare'] && !$aInfo['TitleBroadcast'] && !$aInfo['AddToFeatured'] && !$aInfo['TitleManageFans'] && !$aInfo['TitleUploadPhotos'] && !$aInfo['TitleUploadVideos'] && !$aInfo['TitleUploadSounds'] && !$aInfo['TitleUploadFiles'])
                return '';

            return $oSubscription->getData() . $oFunctions->genObjectsActions($aInfo, 'bx_teams');
        }

        return '';
    }

    function getBlockCode_Fans()
    {
        return parent::_blockFans ($this->_oDb->getParam('bx_teams_perpage_view_fans'), 'isAllowedViewFans', 'getFans');
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
		$cat = $this->_oTemplate->parseCategories($aData['categories']);
		$category = ($cat==0)?'5aside':'11aside';
		$category = $this->_oMain->getIconFromText($category);
		$join_type =  ($aData['join_confirmation'] == 0)?'open_icon':'invite_only';
		$range_in_km = $aData['city'];
		$team_locations = $aData['zip'];
		$member_count = $aData['fans_count'];
		$team_max_capacity = $this->_oDb->getParam('bx_teams_team_max_capacity');
		$team_min_capacity = $this->_oDb->getParam('bx_teams_team_min_capacity');
		if($member_count >= $team_max_capacity) {
			$team_status = 'status_team_max_capacity_reached';
			
		} elseif($member_count >= $team_min_capacity) {
			$team_status = 'status_team_Complete';
			
		} else {
			$team_status = 'status_team_Incomplete';
		}
		$team_status = $this->_oMain->getIconFromText($team_status);
		//Gender
		if($aData['gender']==0) {
			$gender = 'Male';
			
		} elseif($aData['gender']==1) {
			$gender = 'Female';
		} elseif($aData['gender']==2) {
			$gender = '';
		}
		if($gender!='') {
			$gender = $this->_oMain->getIconFromText($gender);
			$gender = '<img class="team-class" src="'.$gender.'" alt="">';
		}
		$player_icon = $this->_oMain->getIconFromText('Player-Icon');
        $aVars = array (
            'author_unit' => get_member_thumbnail($aAuthor['ID'], 'none', true),
            'date' => getLocaleDate($aData['created'], BX_DOL_LOCALE_DATE_SHORT),
            'date_ago' => defineTimeInterval($aData['created']),
            'cats' => $category,
            'tags' => $this->_oTemplate->parseTags($aData['tags']),
            'fields' => $sFields,
            'author_unit' => $GLOBALS['oFunctions']->getMemberThumbnail($aAuthor['ID'], 'none', true),
            'location' => $sLocation,
			'team-name' => $aData['title'],
			'gender' => $gender,
			'player_icon' => $player_icon,
			'join_type_icon'  => $this->_oMain->getIconFromText($join_type),
			'fans_cont' => $member_count,
			'range' => $range_in_km,
			'team_locations' => $team_locations,
			'team_status' => $team_status,
        );
        return $this->_oTemplate->parseHtmlByName('entry_view_block_info', $aVars);
    }
}
