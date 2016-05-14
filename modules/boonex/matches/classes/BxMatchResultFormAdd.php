<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import ('BxDolProfileFields');
bx_import ('BxDolFormMedia');

class BxMatchResultFormAdd extends BxDolFormMedia
{
    var $_oMain, $_oDb;

    function BxMatchResultFormAdd ($oMain, $iProfileId, $iEntryId = 0, $iThumb = 0)
    {
		$this->_oMain = $oMain;
        $this->_oDb = $oMain->_oDb;
		$iNum = $this->_oDb->getMatchTeam($aProfiles, $iEntryId, 0, 2, '', 't',1);
		$i = 0;
		$match_type = $this->_oDb->getMatchDetails($iEntryId);
		foreach ($aProfiles as $aProfile) {
			
			$team_players[] = $this->_oDb->getTeamPlayers($aPlayersProfiles, $iEntryId, true, 'p',$aProfile['team_id']);
			$side = ($i==0) ? 'home' : 'away';
			foreach ($aPlayersProfiles as $aPlayersProfile) {
				
				$sProfileThumbPlayer[$side][$aPlayersProfile['ID']] = get_member_thumbnail( $aPlayersProfile['ID'], 'none', ! $bExtMode, 'visitor' );
			}
			$i++;
		}
        $aCustomForm = array(

            'form_attrs' => array(
                'name'     => 'form_matches_result',
                'action'   => '',
                'method'   => 'post',
                'enctype' => 'multipart/form-data',
            ),

            'params' => array (
                'db' => array(
                    'table' => 'bx_match_result',
                    'key' => 'id',
                    'uri' => 'uri',
                    'uri_title' => 'title',
                    'submit_name' => 'submit_form',
                ),
            ),

            'inputs' => array(

                'header_info' => array(
                    'type' => 'block_header',
                    'caption' => _t('_bx_matches_result_form_header_info')
                ),

                'match_played' => array(
                    'type' => 'radio_set',
                    'name' => 'match_played',
                    'caption' => _t('_bx_matches_result_form_caption_match_played'),
					'value' =>  1,
					'values' => array(
                    0 => _t('_bx_matches_form_caption_match_played_no'),
                    1 => _t('_bx_matches_form_caption_match_played_yes')
					),
                    'required' => true,
                    'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_result_form_err_match_played'),
                    ),
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
                'home_team_score' => array(
                    'type' => 'text',
                    'name' => 'home_team_score',
                    'caption' => _t('_bx_matches_result_form_caption_home_team_score'),
                    'required' => true,
					'checker' => array (
                        'func' => 'preg',
						'params' => array('/^[1-9][1-9]*$/'),
                        'error' => _t ('_bx_matches_result_form_err_match_home_score'),
                    ),
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
				'away_team_score' => array(
                    'type' => 'text',
                    'name' => 'away_team_score',
                    'caption' => _t('_bx_matches_result_form_caption_away_team_score'),
                    'required' => true,
					'checker' => array (
                        'func' => 'preg',
						'params' => array('/^[1-9][1-9]*$/'),
                        'error' => _t ('_bx_matches_result_form_err_match_away_score'),
                    ),
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'home_team_players' => array(
					'type' => 'checkbox_set',
					'name' => 'home_team_players',
					'caption' => _t('_home_team_players'),
					'value' => true,
					'values' => $sProfileThumbPlayer['home'],
					'attrs' => array()
				),
				'away_team_players' => array(
					'type' => 'checkbox_set',
					'name' => 'away_team_players',
					'caption' => _t('_away_team_players'),
					'value' => true,
					'values' => $sProfileThumbPlayer['away'],
					'attrs' => array()
				),

                
                'Submit' => array (
                    'type' => 'submit',
                    'name' => 'submit_form',
                    'value' => _t('_Submit'),
                    'colspan' => false,
                ),
            ),
        );
		if($match_type['match_type'] == 0){
		unset ($aCustomForm['inputs']['away_team_score']);
		unset ($aCustomForm['inputs']['home_team_score']);
		}
        parent::BxDolFormMedia ($aCustomForm);
    }

}
