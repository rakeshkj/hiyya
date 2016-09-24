<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

function bx_matches_import ($sClassPostfix, $aModuleOverwright = array())
{
    global $aModule;
    $a = $aModuleOverwright ? $aModuleOverwright : $aModule;
    if (!$a || $a['uri'] != 'matches') {
        $oMain = BxDolModule::getInstance('BxMatchModule');
        $a = $oMain->_aModule;
    }
    bx_import ($sClassPostfix, $a) ;
}

bx_import('BxDolPaginate');
bx_import('BxDolAlerts');
bx_import('BxDolTwigModule');

define ('BX_MATCHES_PHOTOS_CAT', 'Matches');
define ('BX_MATCHES_PHOTOS_TAG', 'matches');

define ('BX_MATCHES_VIDEOS_CAT', 'Matches');
define ('BX_MATCHES_VIDEOS_TAG', 'matches');

define ('BX_MATCHES_SOUNDS_CAT', 'Matches');
define ('BX_MATCHES_SOUNDS_TAG', 'matches');

define ('BX_MATCHES_FILES_CAT', 'Matches');
define ('BX_MATCHES_FILES_TAG', 'matches');

define ('BX_GROUPS_MAX_FANS', 1000);

/**
 * Matches module
 *
 * This module allow users to create user's matches,
 * users can rate, comment and discuss match.
 * Match can have photos, videos, sounds and files, uploaded
 * by match's fans and/or admins.
 *
 *
 *
 * Profile's Wall:
 * 'add match' event is displayed in profile's wall
 *
 *
 *
 * Spy:
 * The following activity is displayed for content_activity:
 * add - new match was created
 * change - match was changed
 * join - somebody joined match
 * rate - somebody rated match
 * commentPost - somebody posted comment in match
 *
 *
 *
 * Memberships/ACL:
 * matches view match - BX_MATCHES_VIEW_MATCH
 * matches browse - BX_MATCHES_BROWSE
 * matches search - BX_MATCHES_SEARCH
 * matches add match - BX_MATCHES_ADD_MATCHE
 * matches comments delete and edit - BX_MATCHES_COMMENTS_DELETE_AND_EDIT
 * matches edit any match - BX_MATCHES_EDIT_ANY_GROUP
 * matches delete any match - BX_MATCHES_DELETE_ANY_GROUP
 * matches mark as featured - BX_MATCHES_MARK_AS_FEATURED
 * matches approve matches - BX_MATCHES_APPROVE_GROUPS
 * matches broadcast message - BX_MATCHES_BROADCAST_MESSAGE
 *
 *
 *
 * Service methods:
 *
 * Homepage block with different matches
 * @see BxMatchModule::serviceHomepageBlock
 * BxDolService::call('matches', 'homepage_block', array());
 *
 * Profile block with user's matches
 * @see BxMatchModule::serviceProfileBlock
 * BxDolService::call('matches', 'profile_block', array($iProfileId));
 *
 * Match's forum permissions (for internal usage only)
 * @see BxMatchModule::serviceGetForumPermission
 * BxDolService::call('matches', 'get_forum_permission', array($iMemberId, $iForumId));
 *
 * Member menu item for my matches (for internal usage only)
 * @see BxMatchModule::serviceGetMemberMenuItem
 * BxDolService::call('matches', 'get_member_menu_item');
 *
 * Member menu item for match adding (for internal usage only)
 * @see BxMatchModule::serviceGetMemberMenuItemAddContent
 * BxDolService::call('matches', 'get_member_menu_item_add_content');
 *
 *
 *
 * Alerts:
 * Alerts type/unit - 'bx_matches'
 * The following alerts are rised
 *
 *  join - user joined a match
 *      $iObjectId - match id
 *      $iSenderId - joined user
 *
 *  join_request - user want to join a match
 *      $iObjectId - match id
 *      $iSenderId - user id which want to join a match
 *
 *  join_reject - user was rejected to join a match
 *      $iObjectId - match id
 *      $iSenderId - regected user id
 *
 *  fan_remove - fan was removed from a match
 *      $iObjectId - match id
 *      $iSenderId - fan user if which was removed from admins
 *
 *  fan_become_admin - fan become match's admin
 *      $iObjectId - match id
 *      $iSenderId - nerw match's fan user id
 *
 *  admin_become_fan - match's admin become regular fan
 *      $iObjectId - match id
 *      $iSenderId - match's admin user id which become regular fan
 *
 *  join_confirm - match's admin confirmed join request
 *      $iObjectId - match id
 *      $iSenderId - condirmed user id
 *
 *  add - new match was added
 *      $iObjectId - match id
 *      $iSenderId - creator of a match
 *      $aExtras['Status'] - status of added match
 *
 *  change - match's info was changed
 *      $iObjectId - match id
 *      $iSenderId - editor user id
 *      $aExtras['Status'] - status of changed match
 *
 *  delete - match was deleted
 *      $iObjectId - match id
 *      $iSenderId - deleter user id
 *
 *  mark_as_featured - match was marked/unmarked as featured
 *      $iObjectId - match id
 *      $iSenderId - performer id
 *      $aExtras['Featured'] - 1 - if match was marked as featured and 0 - if match was removed from featured
 *
 */
class BxMatchModule extends BxDolTwigModule
{
    var $_oPrivacy;
    var $_aQuickCache = array ();

    function BxMatchModule(&$aModule)
    {
        parent::BxDolTwigModule($aModule);
        $this->_sFilterName = 'bx_matches_filter';
        $this->_sPrefix = 'bx_matches';

        bx_import ('Privacy', $aModule);
        $this->_oPrivacy = new BxMatchPrivacy($this);
		$this -> _oTemplate -> addJs('main.js');
        $GLOBALS['oBxMatchModule'] = &$this;
    }

    function actionHome ()
    {
        parent::_actionHome(_t('_bx_matches_page_title_home'));
    }

    function actionFiles ($sUri)
    {
        parent::_actionFiles ($sUri, _t('_bx_matches_page_title_files'));
    }

    function actionSounds ($sUri)
    {
        parent::_actionSounds ($sUri, _t('_bx_matches_page_title_sounds'));
    }

    function actionVideos ($sUri)
    {
        parent::_actionVideos ($sUri, _t('_bx_matches_page_title_videos'));
    }

    function actionPhotos ($sUri)
    {
        parent::_actionPhotos ($sUri, _t('_bx_matches_page_title_photos'));
    }

    function actionComments ($sUri)
    {
        parent::_actionComments ($sUri, _t('_bx_matches_page_title_comments'));
    }

    function actionBrowseFans ($sUri)
    {
        parent::_actionBrowseFans ($sUri, 'isAllowedViewFans', 'getFansBrowse', $this->_oDb->getParam('bx_matches_perpage_browse_fans'), 'browse_fans/', _t('_bx_matches_page_title_fans'));
    }

    function actionView ($sUri)
    {
        parent::_actionView ($sUri, _t('_bx_matches_msg_pending_approval'));
    }
	function actionPgview ($sUri)
    {
        parent::_actionPgview ($sUri, _t('_bx_matches_msg_pending_approval'));
    }
    function actionUploadPhotos ($sUri)
    {
        parent::_actionUploadMedia ($sUri, 'isAllowedUploadPhotos', 'images', array ('images_choice', 'images_upload'), _t('_bx_matches_page_title_upload_photos'));
    }

    function actionUploadVideos ($sUri)
    {
        parent::_actionUploadMedia ($sUri, 'isAllowedUploadVideos', 'videos', array ('videos_choice', 'videos_upload'), _t('_bx_matches_page_title_upload_videos'));
    }

    function actionUploadSounds ($sUri)
    {
        parent::_actionUploadMedia ($sUri, 'isAllowedUploadSounds', 'sounds', array ('sounds_choice', 'sounds_upload'), _t('_bx_matches_page_title_upload_sounds'));
    }

    function actionUploadFiles ($sUri)
    {
        parent::_actionUploadMedia ($sUri, 'isAllowedUploadFiles', 'files', array ('files_choice', 'files_upload'), _t('_bx_matches_page_title_upload_files'));
    }

    function actionBroadcast ($iEntryId)
    {
        parent::_actionBroadcast ($iEntryId, _t('_bx_matches_page_title_broadcast'), _t('_bx_matches_msg_broadcast_no_recipients'), _t('_bx_matches_msg_broadcast_message_sent'));
    }
	function actionInviteTeamPlayers ($iEntryId,$teamId)
    {
        $this->_InviteTeamPlayers ($iEntryId, 'bx_matches_invitation', $this->_oDb->getParam('bx_matches_max_email_invitations'), _t('_bx_matches_msg_invitation_sent'), _t('_bx_matches_msg_no_users_to_invite'), _t('_bx_matches_page_title_invite'), $teamId);
    }
	
	function _InviteTeamPlayers ($iEntryId, $sEmailTemplate, $iMaxEmailInvitations, $sMsgInvitationSent, $sMsgNoUsers, $sTitle, $teamId)
    {
        $iEntryId = (int)$iEntryId;
		
		$team_details = $this->_oDb->getTeamDetails($teamId);
		
        if (!($aDataEntry = $this->_oDb->getEntryById($iEntryId, 0, $this->isAdmin()))) {
            $this->_oTemplate->displayPageNotFound ();
            return;
        }
		//Check match capacity
		$pgdetails = $this->_oDb->getPalgroundDetails($aDataEntry['playground']);
		$player_count = $this->_oDb->getMatchPlayersCount($aDataEntry['id'], $aDataEntry['match_type']);
		$min_player_match = $pgdetails[0]['min_players'];
		$max_player_match = $pgdetails[0]['max_players'];
		$matchPath = BX_DOL_URL_ROOT .  $this->_oConfig->getBaseUri().'view/'.$aDataEntry['uri'];
		if($max_player_match==$player_count) {
			echo '<script type="text/javascript" language="javascript">
                           alert("Match max capacity reached, you can not invite more");
						   window.location = "'.$matchPath.'";
                        </script>';
            exit;
			
		}
		//end here
        $this->_oTemplate->pageStart();

        $GLOBALS['oTopMenu']->setCustomSubHeader($aDataEntry[$this->_oDb->_sFieldTitle]);
        $GLOBALS['oTopMenu']->setCustomVar($this->_sPrefix.'_view_uri', $aDataEntry[$this->_oDb->_sFieldUri]);
        $GLOBALS['oTopMenu']->setCustomBreadcrumbs(array(
            _t('_'.$this->_sPrefix) => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'home/',
            $aDataEntry[$this->_oDb->_sFieldTitle] => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'view/' . $aDataEntry[$this->_oDb->_sFieldUri],
            $sTitle . $aDataEntry[$this->_oDb->_sFieldTitle] => '',
        ));

        bx_import('BxDolMatchFormInviter');
        $oForm = new BxDolMatchFormInviter ($this, $sMsgNoUsers, $aDataEntry);
        $oForm->initChecker();
			
        if ($oForm->isSubmittedAndValid ()) {

            $aInviter = getProfileInfo($this->_iProfileId);
            $aPlusOriginal = $this->_getInviteParams ($aDataEntry, $aInviter);

            $oEmailTemplate = new BxDolEmailTemplates();
            $aTemplate = $oEmailTemplate->getTemplate($sEmailTemplate);
            $iSuccess = 0;
            // send invitation to registered members
			
            if (false !== bx_get('inviter_users') && is_array(bx_get('inviter_users')))  {	
				$time = time();
				$aInviteUsers = bx_get('inviter_users');
				foreach($aInviteUsers as $team){
					$sQuery =
					"
						INSERT IGNORE INTO
							`bx_matches_fans`
						SET
							`id_entry` = '{$iEntryId}',
							`id_profile` = '{$team}',
							`team_id` = '{$teamId}',
							`when` = '{$time}',
							`confirmed`  = 0,
							`type`  = 'p'
					";
					db_res($sQuery); 
				}
				
					
				
				//echo '<pre>';print_r($aInviteUsers);die;
                foreach ($aInviteUsers as $iRecipient) {
                    $aRecipient = getProfileInfo($iRecipient);
                    //$aPlus = array_merge (array ('NickName' => ' ' . getNickName($aRecipient['ID'])), $aPlusOriginal);
                    //$iSuccess += sendMail(trim($aRecipient['Email']), $aTemplate['Subject'], $aTemplate['Body'], '', $aPlus) ? 1 : 0;
					// Send message into the member's site personal mailbox;
					$aRepl = array (
                '<MatchName>' => $aDataEntry['title'],
                '<MatchLocation>' => _t($GLOBALS['aPreValues']['Country'][$aDataEntry['country']]['LKey']) . (trim($aDataEntry['city']) ? ', '.$aDataEntry['city'] : '') . ', ' . $aDataEntry['zip'],
                '<MatchUrl>' => $this->_oConfig->getBaseUri() . 'view/' . $aDataEntry['uri'],
                '<InviterUrl>' => $aInviter ? getProfileLink($aInviter['ID']) : 'javascript:void(0);',
                '<InviterNickName>' => $aInviter ? getNickName($aInviter['ID']) : _t('_bx_matches_user_unknown'),
                '<InvitationText>' => nl2br(process_pass_data(strip_tags($_POST['inviter_text']))),
				'<NickName>' => getNickName($aRecipient['ID']),
            );
			$aTemplateBodyInternal = str_replace(array_keys($aRepl), array_values($aRepl), $aTemplate['Body']);
			$aTemplateSubjectInternal = str_replace(array_keys($aRepl), array_values($aRepl), $aTemplate['Subject']);
					$sQuery =
					"
						INSERT INTO
							`sys_messages`
						SET
							`Date` = NOW(),
							`Sender` = '{$this->_iProfileId}',
							`Recipient` = '{$aRecipient['ID']}',
							`Subject` = '{$aTemplateSubjectInternal}',
							`Text`  = '{$aTemplateBodyInternal}',
							`New` = '1',
							`Type` = 'letter'
					";
					db_res($sQuery);
					$iSuccess++;
                }
				}

            // send invitation to additional emails
            $iMaxCount = $iMaxEmailInvitations;
            $aEmails = preg_split ("#[,\s\\b]+#", bx_get('inviter_emails'));
            $aPlus = array_merge (array ('NickName' => ''), $aPlusOriginal);
            if ($aEmails && is_array($aEmails)) {
                foreach ($aEmails as $sEmail) {
                    if (strlen($sEmail) < 5)
                        continue;
                    $iRet = sendMail(trim($sEmail), $aTemplate['Subject'], $aTemplate['Body'], '', $aPlus) ? 1 : 0;
                    $iSuccess += $iRet;
                    if ($iRet && 0 == --$iMaxCount)
                        break;
                }
            }

            $sMsg = sprintf($sMsgInvitationSent, $iSuccess);
            echo MsgBox($sMsg);
            $this->_oTemplate->addCss ('main.css');
            $this->_oTemplate->pageCode ($sMsg, true, false);
            return;
	}
        echo $oForm->getCode ();
        $this->_oTemplate->addCss ('main.css');
        $this->_oTemplate->addCss ('inviter.css');
        $this->_oTemplate->pageCode($sTitle . $aDataEntry[$this->_oDb->_sFieldTitle]);
    }
    function actionInvite ($iEntryId)
    {
        $this->_actionInvite ($iEntryId, 'bx_matches_invitation', $this->_oDb->getParam('bx_matches_max_email_invitations'), _t('_bx_matches_msg_invitation_sent'), _t('_bx_matches_msg_no_users_to_invite'), _t('_bx_matches_page_title_invite'));
    }
	function _actionInvite ($iEntryId, $sEmailTemplate, $iMaxEmailInvitations, $sMsgInvitationSent, $sMsgNoUsers, $sTitle)
    {
        $iEntryId = (int)$iEntryId;
        if (!($aDataEntry = $this->_oDb->getEntryByIdAndOwner($iEntryId, $this->_iProfileId, $this->isAdmin()))) {
            $this->_oTemplate->displayPageNotFound ();
            return;
        }
		//Check match capacity
		$pgdetails = $this->_oDb->getPalgroundDetails($aDataEntry['playground']);
		$player_count = $this->_oDb->getMatchPlayersCount($aDataEntry['id'], $aDataEntry['match_type']);
		$min_player_match = $pgdetails[0]['min_players'];
		$max_player_match = $pgdetails[0]['max_players'];
		$matchPath = BX_DOL_URL_ROOT .  $this->_oConfig->getBaseUri().'view/'.$aDataEntry['uri'];
		if($max_player_match==$player_count) {
			echo '<script type="text/javascript" language="javascript">
                           alert("Match max capacity reached, you can not invite more");
						   window.location = "'.$matchPath.'";
                        </script>';
            exit;
			
		}
		
		//end here
        $this->_oTemplate->pageStart();

        $GLOBALS['oTopMenu']->setCustomSubHeader($aDataEntry[$this->_oDb->_sFieldTitle]);
        $GLOBALS['oTopMenu']->setCustomVar($this->_sPrefix.'_view_uri', $aDataEntry[$this->_oDb->_sFieldUri]);
        $GLOBALS['oTopMenu']->setCustomBreadcrumbs(array(
            _t('_'.$this->_sPrefix) => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'home/',
            $aDataEntry[$this->_oDb->_sFieldTitle] => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'view/' . $aDataEntry[$this->_oDb->_sFieldUri],
            $sTitle . $aDataEntry[$this->_oDb->_sFieldTitle] => '',
        ));

        bx_import('BxDolTwigFormInviter');
        $oForm = new BxDolTwigFormInviter ($this, $sMsgNoUsers, $aDataEntry);
        $oForm->initChecker();
			//print_r($aDataEntry['match_type']);
        if ($oForm->isSubmittedAndValid ()) {

            $aInviter = getProfileInfo($this->_iProfileId);
            $aPlusOriginal = $this->_getInviteParams ($aDataEntry, $aInviter);

            $oEmailTemplate = new BxDolEmailTemplates();
            $aTemplate = $oEmailTemplate->getTemplate($sEmailTemplate);
            $iSuccess = 0;
            // send invitation to registered members
            if ((false !== bx_get('inviter_users') && is_array(bx_get('inviter_users'))) || (false !== bx_get('inviter_teams') && is_array(bx_get('inviter_teams')))) {
				$time = time();
				if (false !== bx_get('inviter_teams') && is_array(bx_get('inviter_teams'))) {
					$invite_count = $this->_oDb->getMatchInvitationCount($iEntryId);
					if($invite_count>=2){
					echo '<script type="text/javascript" language="javascript">
                           alert("You can not invite more than two teams, please delete to invite more");
						   window.location = "'.$matchPath.'";
                        </script>';
					exit;
					}
					if(!empty(bx_get('inviter_users'))){
						$aInviteUsers = array_merge(bx_get('inviter_users'), bx_get('inviter_teams'));
					} else {
						$aInviteUsers = bx_get('inviter_teams');
					}
					
				
				$team_users = bx_get('inviter_teams');
			
				foreach($team_users as $team_user) {
					$teamuser = explode('_', $team_user);
					$teams[] = $teamuser;
				}
				
				if($aDataEntry['match_type'] == 0) {
					
					foreach ($teams as $team) {
						$team_fans = $this->_oDb->getTeamFans($team[1],1);
						foreach ($team_fans as $team_fan){
							$individual_players[$team_fan['ID']] = $team_fan['ID'];
						}
						  
					}
					
					foreach ($individual_players as $individual_player) {
					$sQuery =
					"
						INSERT IGNORE INTO
							`bx_matches_fans`
						SET
							`id_entry` = '{$iEntryId}',
							`id_profile` = '{$individual_player}',
							`when` = '{$time}',
							`confirmed`  = 0,
							`type`  = '0'
					";
					db_res($sQuery); 
					}	
				} else {
				foreach($teams as $team){
					
					$sQuery =
					"
						INSERT IGNORE INTO
							`bx_matches_fans`
						SET
							`id_entry` = '{$iEntryId}',
							`id_profile` = '{$team[0]}',
							`team_id` = '{$team[1]}',
							`when` = '{$time}',
							`confirmed`  = 0,
							`type`  = 't'
					";
					db_res($sQuery); 

					
					
				}
				}
				} else {
					$aInviteUsers = bx_get('inviter_users');
					foreach ($aInviteUsers as $iRecipient) {
					$sQuery =
					"
						INSERT IGNORE INTO
							`bx_matches_fans`
						SET
							`id_entry` = '{$iEntryId}',
							`id_profile` = '{$iRecipient}',
							`when` = '{$time}',
							`confirmed`  = 0,
							`type`  = '0'
					";
					db_res($sQuery); 
					}	
				}
				//echo '<pre>';print_r($aInviteUsers);die;
                foreach ($aInviteUsers as $iRecipient) {
                    $aRecipient = getProfileInfo($iRecipient);
                    //$aPlus = array_merge (array ('NickName' => ' ' . getNickName($aRecipient['ID'])), $aPlusOriginal);
                    //$iSuccess += sendMail(trim($aRecipient['Email']), $aTemplate['Subject'], $aTemplate['Body'], '', $aPlus) ? 1 : 0;
					// Send message into the member's site personal mailbox;
					$aRepl = array (
                '<MatchName>' => $aDataEntry['title'],
                '<MatchLocation>' => _t($GLOBALS['aPreValues']['Country'][$aDataEntry['country']]['LKey']) . (trim($aDataEntry['city']) ? ', '.$aDataEntry['city'] : '') . ', ' . $aDataEntry['zip'],
                '<MatchUrl>' => $this->_oConfig->getBaseUri() . 'view/' . $aDataEntry['uri'],
                '<InviterUrl>' => $aInviter ? getProfileLink($aInviter['ID']) : 'javascript:void(0);',
                '<InviterNickName>' => $aInviter ? getNickName($aInviter['ID']) : _t('_bx_matches_user_unknown'),
                '<InvitationText>' => nl2br(process_pass_data(strip_tags($_POST['inviter_text']))),
				'<NickName>' => getNickName($aRecipient['ID']),
            );
			$aTemplateBodyInternal = str_replace(array_keys($aRepl), array_values($aRepl), $aTemplate['Body']);
			$aTemplateSubjectInternal = str_replace(array_keys($aRepl), array_values($aRepl), $aTemplate['Subject']);
					$sQuery =
					"
						INSERT INTO
							`sys_messages`
						SET
							`Date` = NOW(),
							`Sender` = '{$this->_iProfileId}',
							`Recipient` = '{$aRecipient['ID']}',
							`Subject` = '{$aTemplateSubjectInternal}',
							`Text`  = '{$aTemplateBodyInternal}',
							`New` = '1',
							`Type` = 'letter'
					";
					db_res($sQuery);
					$iSuccess++;
                }
				
            }

            // send invitation to additional emails
            $iMaxCount = $iMaxEmailInvitations;
            $aEmails = preg_split ("#[,\s\\b]+#", bx_get('inviter_emails'));
            $aPlus = array_merge (array ('NickName' => ''), $aPlusOriginal);
            if ($aEmails && is_array($aEmails)) {
                foreach ($aEmails as $sEmail) {
                    if (strlen($sEmail) < 5)
                        continue;
                    $iRet = sendMail(trim($sEmail), $aTemplate['Subject'], $aTemplate['Body'], '', $aPlus) ? 1 : 0;
                    $iSuccess += $iRet;
                    if ($iRet && 0 == --$iMaxCount)
                        break;
                }
            }

            $sMsg = sprintf($sMsgInvitationSent, $iSuccess);
            echo MsgBox($sMsg);
            $this->_oTemplate->addCss ('main.css');
            $this->_oTemplate->pageCode ($sMsg, true, false);
            return;
        }

        echo $oForm->getCode ();
        $this->_oTemplate->addCss ('main.css');
        $this->_oTemplate->addCss ('inviter.css');
        $this->_oTemplate->pageCode($sTitle . $aDataEntry[$this->_oDb->_sFieldTitle]);
    }
    function _getInviteParams ($aDataEntry, $aInviter)
    {
        return array (
                'MatchName' => $aDataEntry['title'],
                'MatchLocation' => _t($GLOBALS['aPreValues']['Country'][$aDataEntry['country']]['LKey']) . (trim($aDataEntry['city']) ? ', '.$aDataEntry['city'] : '') . ', ' . $aDataEntry['zip'],
                'MatchUrl' => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'view/' . $aDataEntry['uri'],
                'InviterUrl' => $aInviter ? getProfileLink($aInviter['ID']) : 'javascript:void(0);',
                'InviterNickName' => $aInviter ? getNickName($aInviter['ID']) : _t('_bx_matches_user_unknown'),
                'InvitationText' => nl2br(process_pass_data(strip_tags($_POST['inviter_text']))),
            );
    }

    function actionCalendar ($iYear = '', $iMonth = '')
    {
        parent::_actionCalendar ($iYear, $iMonth, _t('_bx_matches_page_title_calendar'));
    }

    function actionSearch ($sKeyword = '', $sCategory = '')
    {
        parent::_actionSearch ($sKeyword, $sCategory, _t('_bx_matches_page_title_search'));
    }

    function actionAdd ()
    {
        parent::_actionAdd (_t('_bx_matches_page_title_add'));
    }

    function actionEdit ($iEntryId)
    {
        parent::_actionEdit ($iEntryId, _t('_bx_matches_page_title_edit'));
    }
	function actionEditPlayground ($iEntryId)
    {
        parent::_actionEditPlayground ($iEntryId, _t('_bx_matches_page_playground_title_edit'));
    }
	function actionMatchResult ($iEntryId)
    {
        parent::_actionMatchResult ($iEntryId, _t('_bx_matches_page_match_result'));
    }
	function actionEditMatchResult ($iEntryId)
    {
        parent::_actionEditMatchResult ($iEntryId, _t('_bx_matches_page_match_result'));
    }
    function actionDelete ($iEntryId)
    {
        parent::_actionDelete ($iEntryId, _t('_bx_matches_msg_match_was_deleted'));
    }
	function actionCancel ($iEntryId)
    {
        parent::_actionCancel ($iEntryId, _t('_bx_matches_msg_match_was_cancelled'));
    }
	function actionDeletePlayground ($iEntryId)
    {
        parent::_actionDeletePlayground ($iEntryId, _t('_bx_matches_msg_match_was_deleted'));
    }
    function actionMarkFeatured ($iEntryId)
    {
        parent::_actionMarkFeatured ($iEntryId, _t('_bx_matches_msg_added_to_featured'), _t('_bx_matches_msg_removed_from_featured'));
    }

    function actionJoin ($iEntryId, $iProfileId)
    {
		
        $this->_actionJoin ($iEntryId, $iProfileId, _t('_bx_matches_msg_joined_already'), _t('_bx_matches_msg_joined_request_pending'), _t('_bx_matches_msg_join_success'), _t('_bx_matches_msg_join_success_pending'), _t('_bx_matches_msg_leave_success'));
    }
	
	function _actionJoin ($iEntryId, $iProfileId, $sMsgAlreadyJoined, $sMsgAlreadyJoinedPending, $sMsgJoinSuccess, $sMsgJoinSuccessPending, $sMsgLeaveSuccess)
    {
        header('Content-type:text/html;charset=utf-8');

        $iEntryId = (int)$iEntryId;
        if (!($aDataEntry = $this->_oDb->getEntryByIdAndOwner($iEntryId, 0, true))) {
            echo MsgBox(_t('_sys_request_page_not_found_cpt')) . genAjaxyPopupJS($iEntryId, 'ajaxy_popup_result_div');
            exit;
        }

        if (!$this->isAllowedJoin($aDataEntry) || 0 != strcasecmp($_SERVER['REQUEST_METHOD'], 'POST')) {
            echo MsgBox(_t('_Access denied')) . genAjaxyPopupJS($iEntryId, 'ajaxy_popup_result_div');
            exit;
        }
		$userInfo = getProfileInfo($iProfileId);
		$userDOB = $userInfo['DateOfBirth'];
		$userAge = $this->getAge($userDOB);
		$userGender = $userInfo['Sex'];
		$match_person_age = $aDataEntry['max_age'];
		$match_person_gender = $aDataEntry['gender'];
		if($match_person_gender==0) {
			$mGender = 'male';
		} elseif($match_person_gender==1) {
			$mGender = 'female';
		} elseif($match_person_gender==2) {
			$mGender = 'any';
		}
		//Check match capacity
		$pgdetails = $this->_oDb->getPalgroundDetails($aDataEntry['playground']);
		$player_count = $this->_oDb->getMatchPlayersCount($aDataEntry['id'], $aDataEntry['match_type']);
		$min_player_match = $pgdetails[0]['min_players'];
		$max_player_match = $pgdetails[0]['max_players'];
		if($max_player_match == $player_count) {
			echo '<script type="text/javascript" language="javascript">
                           alert("Match max capacity reached, you can not join match");
                        </script>';
            exit;
			
		}
		//end here
		
		//check gender and age 
		if(!(($userAge < $match_person_age) && ($mGender == $userGender || $mGender == 'any'))) {
			echo '<script type="text/javascript" language="javascript">
                           alert("You are not eligible to join this match, please check your age and gender");
                        </script>';
            exit;
		}	
        $isFan = $this->_oDb->isFan ($iEntryId, $this->_iProfileId, true) || $this->_oDb->isFan ($iEntryId, $this->_iProfileId, false);

        if ($isFan) {

            if ($this->_oDb->leaveEntry($iEntryId, $this->_iProfileId)) {
                $sRedirect = BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'view/' . $aDataEntry[$this->_oDb->_sFieldUri];
                echo MsgBox($sMsgLeaveSuccess) . genAjaxyPopupJS($iEntryId, 'ajaxy_popup_result_div', $sRedirect);
                exit;
            }

        } else {

            $isConfirmed = ($this->isEntryAdmin($aDataEntry) || !$aDataEntry[$this->_oDb->_sFieldJoinConfirmation] ? true : false);

            if ($this->_oDb->joinEntry($iEntryId, $this->_iProfileId, $isConfirmed)) {
                if ($isConfirmed) {
                    $this->onEventJoin ($iEntryId, $this->_iProfileId, $aDataEntry);
                    $sRedirect = BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'view/' . $aDataEntry[$this->_oDb->_sFieldUri];
                } else {
                    $this->onEventJoinRequest ($iEntryId, $this->_iProfileId, $aDataEntry);
                    $sRedirect = '';
                }
                echo MsgBox($isConfirmed ? $sMsgJoinSuccess : $sMsgJoinSuccessPending) . genAjaxyPopupJS($iEntryId, 'ajaxy_popup_result_div', $sRedirect);
                exit;
            }
        }

        echo MsgBox(_t('_Error Occured')) . genAjaxyPopupJS($iEntryId, 'ajaxy_popup_result_div');
        exit;
    }
    function actionSharePopup ($iEntryId)
    {
        parent::_actionSharePopup ($iEntryId, _t('_bx_matches_caption_share_match'));
    }

    function actionManageFansPopup ($iEntryId)
    {
        parent::_actionManageFansPopup ($iEntryId, _t('_bx_matches_caption_manage_fans'), 'getFans', 'isAllowedManageFans', 'isAllowedManageAdmins', BX_GROUPS_MAX_FANS);
    }

    function actionTags()
    {
        parent::_actionTags (_t('_bx_matches_page_title_tags'));
    }

    function actionCategories()
    {
        parent::_actionCategories (_t('_bx_matches_page_title_categories'));
    }

    function actionDownload ($iEntryId, $iMediaId)
    {
        $aFileInfo = $this->_oDb->getMedia ((int)$iEntryId, (int)$iMediaId, 'files');

        if (!$aFileInfo || !($aDataEntry = $this->_oDb->getEntryByIdAndOwner((int)$iEntryId, 0, true))) {
            $this->_oTemplate->displayPageNotFound ();
            exit;
        }

        if (!$this->isAllowedView ($aDataEntry)) {
            $this->_oTemplate->displayAccessDenied ();
            exit;
        }

        parent::_actionDownload($aFileInfo, 'media_id');
    }

    // ================================== external actions

    /**
     * Homepage block with different matches
     * @return html to display on homepage in a block
     */
    function serviceHomepageBlock ()
    {
        if (!$this->_oDb->isAnyPublicContent())
            return '';

        bx_import ('PageMain', $this->_aModule);
        $o = new BxMatchPageMain ($this);
        $o->sUrlStart = BX_DOL_URL_ROOT . '?';

        $sDefaultHomepageTab = $this->_oDb->getParam('bx_matches_homepage_default_tab');
        $sBrowseMode = $sDefaultHomepageTab;
        switch ($_GET['bx_matches_filter']) {
            case 'featured':
            case 'recent':
            case 'top':
            case 'popular':
            case $sDefaultHomepageTab:
                $sBrowseMode = $_GET['bx_matches_filter'];
                break;
        }

        return $o->ajaxBrowse(
            $sBrowseMode,
            $this->_oDb->getParam('bx_matches_perpage_homepage'),
            array(
                _t('_bx_matches_tab_featured') => array('href' => BX_DOL_URL_ROOT . '?bx_matches_filter=featured', 'active' => 'featured' == $sBrowseMode, 'dynamic' => true),
                _t('_bx_matches_tab_recent') => array('href' => BX_DOL_URL_ROOT . '?bx_matches_filter=recent', 'active' => 'recent' == $sBrowseMode, 'dynamic' => true),
                _t('_bx_matches_tab_top') => array('href' => BX_DOL_URL_ROOT . '?bx_matches_filter=top', 'active' => 'top' == $sBrowseMode, 'dynamic' => true),
                _t('_bx_matches_tab_popular') => array('href' => BX_DOL_URL_ROOT . '?bx_matches_filter=popular', 'active' => 'popular' == $sBrowseMode, 'dynamic' => true),
            )
        );
    }

    /**
     * Profile block with user's matches
     * @param $iProfileId profile id
     * @return html to display on homepage in a block
     */
    function serviceProfileBlock ($iProfileId)
    {
        $iProfileId = (int)$iProfileId;
        $aProfile = getProfileInfo($iProfileId);
        bx_import ('PageMain', $this->_aModule);
        $o = new BxMatchPageMain ($this);
        $o->sUrlStart = getProfileLink($aProfile['ID']) . '?';

        return $o->ajaxBrowse(
            'user',
            $this->_oDb->getParam('bx_matches_perpage_profile'),
            array(),
            process_db_input ($aProfile['NickName'], BX_TAGS_NO_ACTION, BX_SLASHES_NO_ACTION),
            true,
            false
        );
    }

    /**
     * Profile block with matches user joined
     * @param $iProfileId profile id
     * @return html to display on homepage in a block
     */
    function serviceProfileBlockJoined ($iProfileId)
    {
        $iProfileId = (int)$iProfileId;
        $aProfile = getProfileInfo($iProfileId);
        bx_import ('PageMain', $this->_aModule);
        $o = new BxMatchPageMain ($this);
        $o->sUrlStart = getProfileLink($aProfile['ID']) . '?';

        return $o->ajaxBrowse(
            'joined',
            $this->_oDb->getParam('bx_matches_perpage_profile'),
            array(),
            process_db_input ($aProfile['NickName'], BX_TAGS_NO_ACTION, BX_SLASHES_NO_ACTION),
            true,
            false
        );
    }

    function serviceGetMemberMenuItem ()
    {
        return parent::_serviceGetMemberMenuItem (_t('_bx_matches'), _t('_bx_matches'), 'match');
    }

    function serviceGetMemberMenuItemAddContent ()
    {
        if (!$this->isAllowedAdd())
            return '';
        return parent::_serviceGetMemberMenuItem (_t('_bx_matches_match_single'), _t('_bx_matches_match_single'), 'match', false, '&bx_matches_filter=add_match');
    }

    function serviceGetWallPost ($aEvent)
    {
        $aParams = array(
            'txt_object' => '_bx_matches_wall_object',
            'txt_added_new_single' => '_bx_matches_wall_added_new',
            'txt_added_new_plural' => '_bx_matches_wall_added_new_items',
            'txt_privacy_view_event' => 'view_match',
            'obj_privacy' => $this->_oPrivacy
        );
        return parent::_serviceGetWallPost ($aEvent, $aParams);
    }

    function serviceGetWallPostComment($aEvent)
    {
        $aParams = array(
            'txt_privacy_view_event' => 'view_match',
            'obj_privacy' => $this->_oPrivacy
        );
        return parent::_serviceGetWallPostComment($aEvent, $aParams);
    }

    function serviceGetWallPostOutline($aEvent)
    {
        $aParams = array(
            'txt_privacy_view_event' => 'view_match',
            'obj_privacy' => $this->_oPrivacy,
            'templates' => array(
                'matched' => 'wall_outline_matched'
            )
        );
        return parent::_serviceGetWallPostOutline($aEvent, 'match', $aParams);
    }

    function serviceGetSpyPost($sAction, $iObjectId = 0, $iSenderId = 0, $aExtraParams = array())
    {
        return parent::_serviceGetSpyPost($sAction, $iObjectId, $iSenderId, $aExtraParams, array(
            'add' => '_bx_matches_spy_post',
            'change' => '_bx_matches_spy_post_change',
            'join' => '_bx_matches_spy_join',
            'rate' => '_bx_matches_spy_rate',
            'commentPost' => '_bx_matches_spy_comment',
        ));
    }

    function serviceGetSubscriptionParams ($sAction, $iEntryId)
    {
        $a = array (
            'change' => _t('_bx_matches_sbs_change'),
            'commentPost' => _t('_bx_matches_sbs_comment'),
            'rate' => _t('_bx_matches_sbs_rate'),
            'join' => _t('_bx_matches_sbs_join'),
        );

        return parent::_serviceGetSubscriptionParams ($sAction, $iEntryId, $a);
    }

    /**
     * Install map support
     */
    function serviceMapInstall()
    {
        if (!BxDolModule::getInstance('BxWmapModule'))
            return false;

        return BxDolService::call('wmap', 'part_install', array('matches', array(
            'part' => 'matches',
            'title' => '_bx_matches',
            'title_singular' => '_bx_events_single',
            'icon' => 'modules/boonex/matches/|map_marker.png',
            'icon_site' => 'match',
            'join_table' => 'bx_matches_main',
            'join_where' => "AND `p`.`status` = 'approved'",
            'join_field_id' => 'id',
            'join_field_country' => 'country',
            'join_field_city' => 'city',
            'join_field_state' => '',
            'join_field_zip' => 'zip',
            'join_field_address' => '',
            'join_field_title' => 'title',
            'join_field_uri' => 'uri',
            'join_field_author' => 'author_id',
            'join_field_privacy' => 'allow_view_match_to',
            'permalink' => 'modules/?r=matches/view/',
        )));
    }

    // ================================== admin actions

    function actionAdministration ($sUrl = '')
    {
        if (!$this->isAdmin()) {
            $this->_oTemplate->displayAccessDenied ();
            return;
        }

        $this->_oTemplate->pageStart();

        $aMenu = array(
            'pending_approval' => array(
                'title' => _t('_bx_matches_menu_admin_pending_approval'),
                'href' => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'administration/pending_approval',
                '_func' => array ('name' => 'actionAdministrationManage', 'params' => array(false, 'administration/pending_approval')),
            ),
            'admin_entries' => array(
                'title' => _t('_bx_matches_menu_admin_entries'),
                'href' => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'administration/admin_entries',
                '_func' => array ('name' => 'actionAdministrationManage', 'params' => array(true, 'administration/admin_entries')),
            ),
            'create' => array(
                'title' => _t('_bx_matches_menu_admin_add_entry'),
                'href' => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'administration/create',
                '_func' => array ('name' => 'actionAdministrationCreateEntry', 'params' => array()),
            ),
            'settings' => array(
                'title' => _t('_bx_matches_menu_admin_settings'),
                'href' => BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'administration/settings',
                '_func' => array ('name' => 'actionAdministrationSettings', 'params' => array()),
            ),
        );

        if (empty($aMenu[$sUrl]))
            $sUrl = 'pending_approval';

        $aMenu[$sUrl]['active'] = 1;
        $sContent = call_user_func_array (array($this, $aMenu[$sUrl]['_func']['name']), $aMenu[$sUrl]['_func']['params']);

        echo $this->_oTemplate->adminBlock ($sContent, _t('_bx_matches_page_title_administration'), $aMenu);
        $this->_oTemplate->addCssAdmin (array('admin.css', 'unit.css', 'twig.css', 'main.css', 'forms_extra.css', 'forms_adv.css'));
        $this->_oTemplate->pageCodeAdmin (_t('_bx_matches_page_title_administration'));
    }

    function actionAdministrationSettings ()
    {
        return parent::_actionAdministrationSettings ('Matches');
    }

    function actionAdministrationManage ($isAdminEntries = false, $sUrl = '')
    {
        return parent::_actionAdministrationManage ($isAdminEntries, '_bx_matches_admin_delete', '_bx_matches_admin_activate', $sUrl);
    }

    // ================================== events


    function onEventJoinRequest ($iEntryId, $iProfileId, $aDataEntry)
    {
        parent::_onEventJoinRequest ($iEntryId, $iProfileId, $aDataEntry, 'bx_matches_join_request', BX_GROUPS_MAX_FANS);
    }

    function onEventJoinReject ($iEntryId, $iProfileId, $aDataEntry)
    {
        parent::_onEventJoinReject ($iEntryId, $iProfileId, $aDataEntry, 'bx_matches_join_reject');
    }

    function onEventFanRemove ($iEntryId, $iProfileId, $aDataEntry)
    {
        parent::_onEventFanRemove ($iEntryId, $iProfileId, $aDataEntry, 'bx_matches_fan_remove');
    }

    function onEventFanBecomeAdmin ($iEntryId, $iProfileId, $aDataEntry)
    {
        parent::_onEventFanBecomeAdmin ($iEntryId, $iProfileId, $aDataEntry, 'bx_matches_fan_become_admin');
    }

    function onEventAdminBecomeFan ($iEntryId, $iProfileId, $aDataEntry)
    {
        parent::_onEventAdminBecomeFan ($iEntryId, $iProfileId, $aDataEntry, 'bx_matches_admin_become_fan');
    }

    function onEventJoinConfirm ($iEntryId, $iProfileId, $aDataEntry)
    {
        parent::_onEventJoinConfirm ($iEntryId, $iProfileId, $aDataEntry, 'bx_matches_join_confirm');
    }

    // ================================== permissions

    function isAllowedView ($aDataEntry, $isPerformAction = false)
    {
        // admin and owner always have access
        if ($this->isAdmin() || $aDataEntry['author_id'] == $this->_iProfileId)
            return true;
		
        // check admin acl
		
        $this->_defineActions();
        $aCheck = checkAction($this->_iProfileId, BX_MATCHES_VIEW_MATCH, $isPerformAction);
		
        if ($aCheck[CHECK_ACTION_RESULT] != CHECK_ACTION_RESULT_ALLOWED)
            return false;

        // check user match
        return $aCheck[CHECK_ACTION_RESULT] == CHECK_ACTION_RESULT_ALLOWED;
    }

    function isAllowedBrowse ($isPerformAction = false)
    {
        if ($this->isAdmin())
            return true;
        $this->_defineActions();
        $aCheck = checkAction($this->_iProfileId, BX_MATCHES_BROWSE, $isPerformAction);
        return $aCheck[CHECK_ACTION_RESULT] == CHECK_ACTION_RESULT_ALLOWED;
    }

    function isAllowedSearch ($isPerformAction = false)
    {
        if ($this->isAdmin())
            return true;
        $this->_defineActions();
        $aCheck = checkAction($this->_iProfileId, BX_MATCHES_SEARCH, $isPerformAction);
        return $aCheck[CHECK_ACTION_RESULT] == CHECK_ACTION_RESULT_ALLOWED;
    }

    function isAllowedAdd ($isPerformAction = false)
    {
        if ($this->isAdmin())
            return true;
        if (!$GLOBALS['logged']['member'])
            return false;
        $this->_defineActions();
        $aCheck = checkAction($this->_iProfileId, BX_MATCHES_ADD_MATCH, $isPerformAction);
        return $aCheck[CHECK_ACTION_RESULT] == CHECK_ACTION_RESULT_ALLOWED;
    }

    function isAllowedEdit ($aDataEntry, $isPerformAction = false)
    {
        if ($this->isAdmin() || ($GLOBALS['logged']['member'] && $aDataEntry['author_id'] == $this->_iProfileId && isProfileActive($this->_iProfileId)))
            return true;

        // check acl
        $this->_defineActions();
        $aCheck = checkAction($this->_iProfileId, BX_MATCHES_EDIT_ANY_MATCH, $isPerformAction);
        return $aCheck[CHECK_ACTION_RESULT] == CHECK_ACTION_RESULT_ALLOWED;
    }

    function isAllowedMarkAsFeatured ($aDataEntry, $isPerformAction = false)
    {
        if ($this->isAdmin())
            return true;
        $this->_defineActions();
        $aCheck = checkAction($this->_iProfileId, BX_MATCHES_MARK_AS_FEATURED, $isPerformAction);
        return $aCheck[CHECK_ACTION_RESULT] == CHECK_ACTION_RESULT_ALLOWED;
    }

    function isAllowedBroadcast ($aDataEntry, $isPerformAction = false)
    {
        if ($this->isAdmin() || $this->isEntryAdmin($aDataEntry))
            return true;
        $this->_defineActions();
        $aCheck = checkAction($this->_iProfileId, BX_MATCHES_BROADCAST_MESSAGE, $isPerformAction);
        return $aCheck[CHECK_ACTION_RESULT] == CHECK_ACTION_RESULT_ALLOWED;
    }

    function isAllowedDelete (&$aDataEntry, $isPerformAction = false)
    {
        if ($this->isAdmin() || ($GLOBALS['logged']['member'] && $aDataEntry['author_id'] == $this->_iProfileId && isProfileActive($this->_iProfileId)))
            return true;
        $this->_defineActions();
        $aCheck = checkAction($this->_iProfileId, BX_MATCHES_DELETE_ANY_MATCH, $isPerformAction);
        return $aCheck[CHECK_ACTION_RESULT] == CHECK_ACTION_RESULT_ALLOWED;
    }

    function isAllowedJoin (&$aDataEntry)
    {
        if (!$this->_iProfileId)
            return false;
        return $this->_oPrivacy->check('join', $aDataEntry['id'], $this->_iProfileId);
    }

    function isAllowedSendInvitation (&$aDataEntry)
    {
        return $this->isAdmin() || $this->isEntryAdmin($aDataEntry) ? true : false;
    }

    function isAllowedShare (&$aDataEntry)
    {
    	if($aDataEntry['allow_view_match_to'] != BX_DOL_PG_ALL)
    		return false;

        return true;
    }

    function isAllowedPostInForum(&$aDataEntry, $iProfileId = -1)
    {
        if (-1 == $iProfileId)
            $iProfileId = $this->_iProfileId;
        return $this->isAdmin() || $this->isEntryAdmin($aDataEntry) || $this->_oPrivacy->check('post_in_forum', $aDataEntry['id'], $iProfileId);
    }

    function isAllowedReadForum(&$aDataEntry, $iProfileId = -1)
    {
        return $this->isAllowedPostInForum($aDataEntry, $iProfileId);
    }

    function isAllowedRate(&$aDataEntry)
    {
        if ($this->isAdmin())
            return true;
        return $this->_oPrivacy->check('rate', $aDataEntry['id'], $this->_iProfileId);
    }

    function isAllowedComments(&$aDataEntry)
    {
        if ($this->isAdmin())
            return true;
        return $this->_oPrivacy->check('comment', $aDataEntry['id'], $this->_iProfileId);
    }

    function isAllowedViewFans(&$aDataEntry)
    {
        if ($this->isAdmin())
            return true;
        return $this->_oPrivacy->check('view_fans', $aDataEntry['id'], $this->_iProfileId);
    }

    function isAllowedUploadPhotos(&$aDataEntry)
    {
        if (!BxDolRequest::serviceExists('photos', 'perform_photo_upload', 'Uploader'))
            return false;
        if (!$this->_iProfileId)
            return false;
        if ($this->isAdmin())
            return true;
        if (!$this->isMembershipEnabledForImages())
            return false;
        return $this->_oPrivacy->check('upload_photos', $aDataEntry['id'], $this->_iProfileId);
    }

    function isAllowedUploadVideos(&$aDataEntry)
    {
        if (!BxDolRequest::serviceExists('videos', 'perform_video_upload', 'Uploader'))
            return false;
        if (!$this->_iProfileId)
            return false;
        if ($this->isAdmin())
            return true;
        if (!$this->isMembershipEnabledForVideos())
            return false;
        return $this->_oPrivacy->check('upload_videos', $aDataEntry['id'], $this->_iProfileId);
    }

    function isAllowedUploadSounds(&$aDataEntry)
    {
        if (!BxDolRequest::serviceExists('sounds', 'perform_music_upload', 'Uploader'))
            return false;
        if (!$this->_iProfileId)
            return false;
        if ($this->isAdmin())
            return true;
        if (!$this->isMembershipEnabledForSounds())
            return false;
        return $this->_oPrivacy->check('upload_sounds', $aDataEntry['id'], $this->_iProfileId);
    }

    function isAllowedUploadFiles(&$aDataEntry)
    {
        if (!BxDolRequest::serviceExists('files', 'perform_file_upload', 'Uploader'))
            return false;
        if (!$this->_iProfileId)
            return false;
        if ($this->isAdmin())
            return true;
        if (!$this->isMembershipEnabledForFiles())
            return false;
        return $this->_oPrivacy->check('upload_files', $aDataEntry['id'], $this->_iProfileId);
    }

    function isAllowedCreatorCommentsDeleteAndEdit (&$aDataEntry, $isPerformAction = false)
    {
        if ($this->isAdmin())
            return true;
        if (getParam('bx_matches_author_comments_admin') && $this->isEntryAdmin($aDataEntry))
            return true;
        $this->_defineActions();
        $aCheck = checkAction($this->_iProfileId, BX_MATCHES_COMMENTS_DELETE_AND_EDIT, $isPerformAction);
        return $aCheck[CHECK_ACTION_RESULT] == CHECK_ACTION_RESULT_ALLOWED;
    }

    function isAllowedManageAdmins($aDataEntry)
    {
        if (($GLOBALS['logged']['member'] || $GLOBALS['logged']['admin']) && $aDataEntry['author_id'] == $this->_iProfileId && isProfileActive($this->_iProfileId))
            return true;
        return false;
    }

    function isAllowedManageFans($aDataEntry)
    {
        return $this->isEntryAdmin($aDataEntry);
    }

    function isFan($aDataEntry, $iProfileId = 0, $isConfirmed = true)
    {
        if (!$iProfileId)
            $iProfileId = $this->_iProfileId;
        return $this->_oDb->isFan ($aDataEntry['id'], $iProfileId, $isConfirmed) ? true : false;
    }

    function isEntryAdmin($aDataEntry, $iProfileId = 0)
    {
        if (!$iProfileId)
            $iProfileId = $this->_iProfileId;
        if (($GLOBALS['logged']['member'] || $GLOBALS['logged']['admin']) && $aDataEntry['author_id'] == $iProfileId && isProfileActive($iProfileId))
            return true;
        return $this->_oDb->isGroupAdmin ($aDataEntry['id'], $iProfileId) && isProfileActive($iProfileId);
    }

    function _defineActions ()
    {
        defineMembershipActions(array('matches view match', 'matches browse', 'matches search', 'matches add match', 'matches comments delete and edit', 'matches edit any match', 'matches delete any match', 'matches mark as featured', 'matches approve matches', 'matches broadcast message'));
    }

    function _browseMy (&$aProfile)
    {
        parent::_browseMy ($aProfile, _t('_bx_matches_page_title_my_matches'));
    }

    function _formatLocation (&$aDataEntry, $isCountryLink = false, $isFlag = false)
    {
        $sFlag = $isFlag ? ' ' . genFlag($aDataEntry['country']) : '';
        $sCountry = _t($GLOBALS['aPreValues']['Country'][$aDataEntry['country']]['LKey']);
        if ($isCountryLink)
            $sCountry = '<a href="' . $this->_oConfig->getBaseUri() . 'browse/country/' . strtolower($country['Country']) . '">' . $sCountry . '</a>';
        return (trim($aDataEntry['city']) ? $aDataEntry['city'] . ', ' : '') . $sCountry . $sFlag;
    }

    function _formatSnippetTextForOutline($aEntryData)
    {
        return $this->_oTemplate->parseHtmlByName('wall_outline_extra_info', array(
            'desc' => $this->_formatSnippetText($aEntryData, 200),
            'location' => $this->_formatLocation($aEntryData, false, false),
            'fans_count' => $aEntryData['fans_count'],
        ));
    }
	
	function getAge($dob){
		if(!empty($dob)){
			$birthdate = new DateTime($dob);
			$today   = new DateTime('today');
			$age = $birthdate->diff($today)->y;
			return $age;
		}else{
			return 0;
		}
	}
}
