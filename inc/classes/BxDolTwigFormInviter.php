<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolProfileFields');

/**
 * Base invite form class for modules like events/groups/store
 */
class BxDolTwigFormInviter extends BxTemplFormView
{
    function BxDolTwigFormInviter ($oMain, $sMsgNoUsers, $aDataEntry = null)
    {
        $aVisitorsPreapare = $oMain->_oDb->getPotentialVisitors ($oMain->_iProfileId);
		$aTeamList = $oMain->_oDb->getPublicTeam($oMain->_iProfileId);
		$pgdetails = $oMain->_oDb->getPalgroundDetails($aDataEntry['playground']);
		
        $aVisitors = array ();
		$userAge = '';
		$match_person_age = '';
		$mGender = '';
		$userGender = '';
		$team_inviter['inviter_teams'] = '';
		$current_match_time = $oMain->_oDb->matchDuration($aDataEntry['id']);
		$match_eligibility_team = 0;
		$match_eligibility_player = 0;
        foreach ($aVisitorsPreapare as $k => $r) {
			$sechudle_check_players = $oMain->_oDb->isScheduled(0,$r['ID']);
			if($sechudle_check_players==0){
				$match_eligibility_player = 1;
			} else {
				
				foreach ($sechudle_check_players as $sechudle_check_player) {
					
					$previous_match_player_time = $oMain->_oDb->matchDuration($sechudle_check_player['id_entry']);
					if($current_match_time>$previous_match_player_time){
						$match_eligibility_player = 1;
					}
				}
			}    
			$user_check  = $oMain->_oDb->checkUserMatch($aDataEntry['id'],$r['ID'],0,0);
			if(!empty($user_check) && $match_eligibility_player==0)
				continue;
			if($aDataEntry){
				$userInfo = getProfileInfo($r['ID']);
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
				
				if((($userAge < $match_person_age) && ($mGender == $userGender || $mGender == 'any'))) {
					
				$aVisitors[] = array (
                'Icon' => $GLOBALS['oFunctions']->getMemberIcon($r['ID'], 'left'),
                'Link' => getProfileLink($r['ID']),
                'NickName' => getNickName($r['ID']),
                'ID' => $r['ID'],
				);
				}
			} else {
				
				$aVisitors[] = array (
                'Icon' => $GLOBALS['oFunctions']->getMemberIcon($r['ID'], 'left'),
                'Link' => getProfileLink($r['ID']),
                'NickName' => getNickName($r['ID']),
                'ID' => $r['ID'],
				);
			}
			
            
        }
        $aVars = array (
            'bx_repeat:rows' => $aVisitors,
            'msg_no_users' => $aVisitors ? '' : $sMsgNoUsers,
        );
		if($oMain->_aModule['uri'] == 'matches'){
			$team_max_capacity = $oMain->_oDb->getParam('bx_teams_team_max_capacity');
			$team_min_capacity = $oMain->_oDb->getParam('bx_teams_team_min_capacity');
		foreach ($aTeamList as $key => $val) {
			$user_check  = $oMain->_oDb->checkUserMatch($aDataEntry['id'],$val['author_id'],$val['id'],'t');
			$sechudle_check_teams = $oMain->_oDb->isScheduled($val['id'],0);
			if($sechudle_check_teams==0){
				$match_eligibility_team = 1;
			} else {
				
				foreach ($sechudle_check_teams as $sechudle_check_team) {
					
					$previous_match_team_time = $oMain->_oDb->matchDuration($sechudle_check_team['id_entry']);
					if($current_match_time>$previous_match_team_time){
						$match_eligibility_team = 1;
					}
				}
			}    
			if(!empty($user_check) && $match_eligibility_team==0)
				continue;
			if($val['fans_count'] <= $team_max_capacity && $val['fans_count']>=$pgdetails[0]['min_players'] && $val['fans_count']>=$team_min_capacity) {
				$aTeams[] = array (
                'title' => $val['title'],
                'link' => "m/teams/view/".$val['uri'],
				'ID' => $val['author_id'].'_'.$val['id'],
				);  
			}	
        }
		$aVarsTeam = array (
            'bx_repeat:rows' => $aTeams,
            'msg_no_users' => $aTeams ? '' : $sMsgNoUsers,
        );
				
		$aCustomForm = array(

            'form_attrs' => array(
                'name'     => 'form_inviter',
                'action'   => '',
                'method'   => 'post',
            ),

            'params' => array (
                'db' => array(
                    'submit_name' => 'submit_form',
                ),
            ),
     
            'inputs' => array(
                'inviter_users' => array(
                    'type' => 'custom',
                    'content' => $oMain->_oTemplate->parseHtmlByName('inviter', $aVars),
                    'name' => 'inviter_users',
                    'caption' => _t('_sys_invitation_step_select_users'),
                    'info' => _t('_sys_invitation_step_select_users_info'),
                    'required' => false,
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
                'inviter_teams' => array(
                    'type' => 'custom',
                    'content' => $oMain->_oTemplate->parseHtmlByName('team', $aVarsTeam),
                    'name' => 'inviter_teams',
                    'caption' => _t('_sys_invitation_step_select_teams'),
                    'info' => _t('_sys_invitation_step_select_teams_info'),
                    'required' => false,
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
                'inviter_text' => array(
                    'type' => 'textarea',
                    'name' => 'inviter_text',
                    'caption' => _t('_sys_invitation_step_invitation_text'),
                    'info' => _t('_sys_invitation_step_invitation_text_info'),
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),

                'Submit' => array (
                    'type' => 'submit',
                    'name' => 'submit_form',
                    'value' => _t('_Submit'),
                ),
            ),
        );		
		} else {
        $aCustomForm = array(

            'form_attrs' => array(
                'name'     => 'form_inviter',
                'action'   => '',
                'method'   => 'post',
            ),

            'params' => array (
                'db' => array(
                    'submit_name' => 'submit_form',
                ),
            ),
     
            'inputs' => array(
                'inviter_users' => array(
                    'type' => 'custom',
                    'content' => $oMain->_oTemplate->parseHtmlByName('inviter', $aVars),
                    'name' => 'inviter_users',
                    'caption' => _t('_sys_invitation_step_select_users'),
                    'info' => _t('_sys_invitation_step_select_users_info'),
                    'required' => false,
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
                /*'inviter_emails' => array(
                    'type' => 'textarea',
                    'name' => 'inviter_emails',
                    'caption' => _t('_sys_invitation_step_additional_emails'),
                    'info' => _t('_sys_invitation_step_additional_emails_info'),
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),*/

                'inviter_text' => array(
                    'type' => 'textarea',
                    'name' => 'inviter_text',
                    'caption' => _t('_sys_invitation_step_invitation_text'),
                    'info' => _t('_sys_invitation_step_invitation_text_info'),
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),

                'Submit' => array (
                    'type' => 'submit',
                    'name' => 'submit_form',
                    'value' => _t('_Submit'),
                ),
            ),
        );
		}
        parent::BxTemplFormView ($aCustomForm);
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
