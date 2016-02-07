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
		$aTeamList = $oMain->_oDb->getPublicTeam();
		//echo $oMain->_aModule;
		//echo '<pre>';print_r($oMain->_aModule['uri']);
        $aVisitors = array ();
		$userAge = '';
		$match_person_age = '';
		$mGender = '';
		$userGender = '';
		$team_inviter['inviter_teams'] = '';
        foreach ($aVisitorsPreapare as $k => $r) {
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
			$team_capacity = $oMain->_oDb->getParam('bx_teams_team_max_capacity');
		foreach ($aTeamList as $key => $val) {
			if($val['fans_count'] <= $team_capacity) {
				$aTeams[] = array (
                'title' => $val['title'],
                'link' => "m/teams/view/".$val['uri'],
				'ID' => $val['author_id'],
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
