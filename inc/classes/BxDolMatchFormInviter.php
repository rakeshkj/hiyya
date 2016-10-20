<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolProfileFields');

/**
 * Base invite form class for modules like events/groups/store
 */
class BxDolMatchFormInviter extends BxTemplFormView
{
    function BxDolMatchFormInviter ($oMain, $sMsgNoUsers, $aDataEntry = null)
    {
		$params= explode('/', $_GET['r']);
        $aVisitorsPreapare = $oMain->_oDb->getTeamFans ($params[3],1);
        $aVisitors = array ();
		$user_check = '';
		//echo '<pre>';print_r($aVisitorsPreapare);
		$current_match_time = $oMain->_oDb->matchDuration($params[2]);
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
			$user_check  = $oMain->_oDb->checkUserMatch($params[2],$r['ID'],$params[3],'p');
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
				
			if(!empty($user_check) || $match_eligibility_player==0)
				continue;
			if(($userAge < $match_person_age) && ($mGender == $userGender || $mGender == 'any')) {
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
                'Submit' => array (
                    'type' => 'submit',
                    'name' => 'submit_form',
                    'value' => _t('_Submit'),
                ),
            ),
        );

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
