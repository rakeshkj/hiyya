<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import ('BxDolProfileFields');
bx_import ('BxDolFormMedia');

class BxMatchFormAdd extends BxDolFormMedia
{
    var $_oMain, $_oDb;

    function BxMatchFormAdd ($oMain, $iProfileId, $iEntryId = 0, $iThumb = 0)
    {
        $this->_oMain = $oMain;
        $this->_oDb = $oMain->_oDb;

        $this->_aMedia = array ();
        if (BxDolRequest::serviceExists('photos', 'perform_photo_upload', 'Uploader'))
            $this->_aMedia['images'] = array (
                'post' => 'ready_images',
                'upload_func' => 'uploadPhotos',
                'tag' => BX_MATCHES_PHOTOS_TAG,
                'cat' => BX_MATCHES_PHOTOS_CAT,
                'thumb' => 'thumb',
                'module' => 'photos',
                'title_upload_post' => 'images_titles',
                'title_upload' => _t('_bx_matches_form_caption_file_title'),
                'service_method' => 'get_photo_array',
            );

        if (BxDolRequest::serviceExists('videos', 'perform_video_upload', 'Uploader'))
            $this->_aMedia['videos'] = array (
                'post' => 'ready_videos',
                'upload_func' => 'uploadVideos',
                'tag' => BX_MATCHES_VIDEOS_TAG,
                'cat' => BX_MATCHES_VIDEOS_CAT,
                'thumb' => false,
                'module' => 'videos',
                'title_upload_post' => 'videos_titles',
                'title_upload' => _t('_bx_matches_form_caption_file_title'),
                'service_method' => 'get_video_array',
            );

        if (BxDolRequest::serviceExists('sounds', 'perform_music_upload', 'Uploader'))
            $this->_aMedia['sounds'] = array (
                'post' => 'ready_sounds',
                'upload_func' => 'uploadSounds',
                'tag' => BX_MATCHES_SOUNDS_TAG,
                'cat' => BX_MATCHES_SOUNDS_CAT,
                'thumb' => false,
                'module' => 'sounds',
                'title_upload_post' => 'sounds_titles',
                'title_upload' => _t('_bx_matches_form_caption_file_title'),
                'service_method' => 'get_music_array',
            );

        if (BxDolRequest::serviceExists('files', 'perform_file_upload', 'Uploader'))
            $this->_aMedia['files'] = array (
                'post' => 'ready_files',
                'upload_func' => 'uploadFiles',
                'tag' => BX_MATCHES_FILES_TAG,
                'cat' => BX_MATCHES_FILES_CAT,
                'thumb' => false,
                'module' => 'files',
                'title_upload_post' => 'files_titles',
                'title_upload' => _t('_bx_matches_form_caption_file_title'),
                'service_method' => 'get_file_array',
            );

        bx_import('BxDolCategories');
        $oCategories = new BxDolCategories();

        $oProfileFields = new BxDolProfileFields(0);
        $aCountries = $oProfileFields->convertValues4Input('#!Country');
        asort($aCountries);

        // generate templates for custom form's elements
        $aCustomMediaTemplates = $this->generateCustomMediaTemplates ($oMain->_iProfileId, $iEntryId, $iThumb);

        // privacy

        $aInputPrivacyCustom = array ();
        $aInputPrivacyCustom[] = array ('key' => '', 'value' => '----');
        $aInputPrivacyCustom[] = array ('key' => 'f', 'value' => _t('_bx_matches_privacy_fans_only'));
        $aInputPrivacyCustomPass = array (
            'pass' => 'Preg',
            'params' => array('/^([0-9f]+)$/'),
        );

        $aInputPrivacyCustom2 = array (
            array('key' => 'f', 'value' => _t('_bx_matches_privacy_fans')),
            array('key' => 'a', 'value' => _t('_bx_matches_privacy_admins_only'))
        );
        $aInputPrivacyCustom2Pass = array (
            'pass' => 'Preg',
            'params' => array('/^([fa]+)$/'),
        );

        $aInputPrivacyViewFans = $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'view_fans');
        $aInputPrivacyViewFans['values'] = array_merge($aInputPrivacyViewFans['values'], $aInputPrivacyCustom);

        $aInputPrivacyComment = $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'comment');
        $aInputPrivacyComment['values'] = array_merge($aInputPrivacyComment['values'], $aInputPrivacyCustom);
        $aInputPrivacyComment['db'] = $aInputPrivacyCustomPass;

        $aInputPrivacyRate = $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'rate');
        $aInputPrivacyRate['values'] = array_merge($aInputPrivacyRate['values'], $aInputPrivacyCustom);
        $aInputPrivacyRate['db'] = $aInputPrivacyCustomPass;

        $aInputPrivacyForum = $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'post_in_forum');
        $aInputPrivacyForum['values'] = array_merge($aInputPrivacyForum['values'], $aInputPrivacyCustom);
        $aInputPrivacyForum['db'] = $aInputPrivacyCustomPass;

        $aInputPrivacyUploadPhotos = $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'upload_photos');
        $aInputPrivacyUploadPhotos['values'] = $aInputPrivacyCustom2;
        $aInputPrivacyUploadPhotos['db'] = $aInputPrivacyCustom2Pass;

        $aInputPrivacyUploadVideos = $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'upload_videos');
        $aInputPrivacyUploadVideos['values'] = $aInputPrivacyCustom2;
        $aInputPrivacyUploadVideos['db'] = $aInputPrivacyCustom2Pass;

        $aInputPrivacyUploadSounds = $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'upload_sounds');
        $aInputPrivacyUploadSounds['values'] = $aInputPrivacyCustom2;
        $aInputPrivacyUploadSounds['db'] = $aInputPrivacyCustom2Pass;

        $aInputPrivacyUploadFiles = $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'upload_files');
        $aInputPrivacyUploadFiles['values'] = $aInputPrivacyCustom2;
        $aInputPrivacyUploadFiles['db'] = $aInputPrivacyCustom2Pass;
		$playgroundlist = array();
		$hrs = array();
		$pglists = $this->_oDb->getPalgroundListByUser();
		$start_date = date('Y-m-d');
		foreach($pglists as $pglist) {
			
			$playgroundlist[$pglist['id']] = $pglist['title'];
		}
		$hrs[""] = "Select Time";
		for($i=0;$i<=23;$i++) {
			
			$hrs[$i] = $i.":00";
		}
		
		//applicable team list
		$aTeamList = $oMain->_oDb->getPublicTeam($oMain->_iProfileId);
		//echo '<pre>';print_r($aTeamList);
		$team_max_capacity = $oMain->_oDb->getParam('bx_teams_team_max_capacity');
		$team_min_capacity = $oMain->_oDb->getParam('bx_teams_team_min_capacity');
		foreach ($aTeamList as $key => $val) {
			$team_player_count = $oMain->_oDb->getTeamPlayersCount($val['id']);
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
			if(!empty($user_check) || $match_eligibility_team==0)
				continue;
			if($team_player_count[0]['player_count'] <= $team_max_capacity && $team_player_count[0]['player_count']>=$pgdetails[0]['min_players'] && $team_player_count[0]['player_count']>=$team_min_capacity) {
				//$aTeams[$val['id']] = '<a target="_blank" href="m/teams/view/'.$val['uri'].'">'.$val['title'].'</a>';
				$aTeams[$val['id']] = $val['title'];
				
				/*array (
                'title' => $val['title'],
                'link' => "m/teams/view/".$val['uri'],
				'ID' => $val['author_id'].'_'.$val['id'],
				); */ 
			}	
        }
		//echo '<pre>';print_r($aTeams);
		//
        $aCustomForm = array(

            'form_attrs' => array(
                'name'     => 'form_match',
                'action'   => '',
                'method'   => 'post',
                'enctype' => 'multipart/form-data',
            ),

            'params' => array (
                'db' => array(
                    'table' => 'bx_matches_main',
                    'key' => 'id',
                    'uri' => 'uri',
                    'uri_title' => 'title',
                    'submit_name' => 'submit_form',
                ),
            ),

            'inputs' => array(

                'header_info' => array(
                    'type' => 'block_header',
                    'caption' => _t('_bx_matches_form_header_info')
                ),

                'title' => array(
                    'type' => 'text',
                    'name' => 'title',
                    'caption' => _t('_bx_matches_form_caption_title'),
                    'required' => true,
                    'checker' => array (
                        'func' => 'length',
                        'params' => array(3,100),
                        'error' => _t ('_bx_matches_form_err_title'),
                    ),
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
                'match_type' => array(
                    'type' => 'radio_set',
                    'name' => 'match_type',
                    'caption' => _t('_bx_matches_form_caption_type'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_practice'),
                    1 => _t('_bx_matches_form_caption_teams')
					),
                    'required' => true,
					'attrs' =>array (
					'id' => 'matchtype',
					),
					'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_form_err_match_type'),
                    ),
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
				'max_subtitude' => array(
                    'type' => 'text',
                    'name' => 'max_subtitude',
                    'caption' => _t('_bx_matches_form_caption_max_subtitude'),
                    //'required' => false,
                    /*'checker' => array (
                        'func' => 'length',
                        'params' => array(3,100),
                        'error' => _t ('_bx_matches_form_err_max_subtitude'),
                    ),*/
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
				/*'place' => array(
                    'type' => 'text',
                    'name' => 'place',
                    'caption' => _t('_bx_matches_form_caption_place'),
                    'required' => true,
					'checker' => array (
                        'func' => 'avail',
                        'error' => _t ('_bx_matches_form_err_place'),
                    ),
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),*/
				
				'block_booking' => array(
                    'type' => 'radio_set',
                    'name' => 'block_booking',
                    'caption' => _t('_bx_matches_form_caption_block_booking'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_no'),
                    1 => _t('_bx_matches_form_caption_daily'),
					2 => _t('_bx_matches_form_caption_weekly'),
					//3 => _t('_bx_matches_form_caption_monthly')
					),
                    'required' => true,
					'attrs' =>array (
					'id' => 'blockbooking',
					),
					'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_form_err_match_size'),
                    ),
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
				'permanent_team' => array(
                    'type' => 'select',
                    'name' => 'permanent_team',
                    'caption' => _t('_bx_matches_form_caption_team_permanent'),
					'values' => $aTeams,
                    'required' => false,
					'attrs' =>array (
					'id' => 'permanentteam',
					),
					
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
				'current_time' => array (
                    'type' => 'hidden',
                    'name' => 'current_time',
                    'caption' => _t('_bx_matches_menu_match_time'),
                    'value' => date('Y-m-d H:i:s'),
					'attrs' =>array (
					'id' => 'current_time',
					),
                ),
				'start_date' => array (
                    'type' => 'date',
                    'name' => 'start_date',
                    'caption' => _t('_bx_matches_menu_start_date'),
					//'value' => $start_date,
					'required' => true,
					'attrs' =>array (
					'id' => 'startdate',
					),
                    'checker' => array (
                        'func' => 'Date',
                        'error' => _t ('_bx_matches_err_match_start'),
                    ),
                    'db' => array (
                        'pass' => 'Date',
                    ),
                    
                ),
				'match_time' => array (
                    'type' => 'select',
                    'name' => 'match_time',
                    'caption' => _t('_bx_matches_menu_match_time'),
					'required' => true,
					'attrs' =>array (
					'id' => 'starttime',
					),
                    'values' => $hrs,
                    'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_form_err_match_time'),
                    ),
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
				'end_date' => array (
                    'type' => 'date',
                    'name' => 'end_date',
                    'caption' => _t('_bx_matches_menu_end_date'),
					//'value' => $start_date,
                    'required' => true,
					'attrs' =>array (
					'id' => 'enddate',
					),
					'checker' => array (
                        'func' => 'Date',
                        'error' => _t ('_bx_matches_err_match_end'),
                    ),
                    'db' => array (
                        'pass' => 'Date',
                    ),
                    
                    
                ),
				'playground' => array(
                    'type' => 'select',
                    'name' => 'playground',
                    'caption' => _t('_bx_matches_form_caption_playground'),
					'values' => $playgroundlist,
                    //'required' => false,
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
				'max_age' => array(
                    'type' => 'text',
                    'name' => 'max_age',
                    'caption' => _t('_bx_matches_form_caption_max_age'),
                    'required' => true,
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
				'gender' => array(
                    'type' => 'radio_set',
                    'name' => 'gender',
                    'caption' => _t('_bx_matches_form_caption_gender'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_male'),
                    1 => _t('_bx_matches_form_caption_female'),
					2 => _t('_bx_matches_form_caption_any')
					),
                    'required' => true,
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
				'payment' => array(
                    'type' => 'text',
                    'name' => 'payment',
                    'caption' => _t('_bx_matches_form_caption_payment'),
                    //'required' => false,
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
            
                

                // privacy

                'header_privacy' => array(
                    'type' => 'block_header',
                    'caption' => _t('_bx_matches_form_header_privacy'),
                ),

                'allow_view_match_to' => $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'view_match'),

                //'allow_view_fans_to' => $aInputPrivacyViewFans,

                'allow_comment_to' => $aInputPrivacyComment,

                'allow_rate_to' => $aInputPrivacyRate,

                'allow_post_in_forum_to' => $aInputPrivacyForum,

                'allow_join_to' => $this->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'join'),

                'join_confirmation' => array (
                    'type' => 'select',
                    'name' => 'join_confirmation',
                    'caption' => _t('_bx_matches_form_caption_join_confirmation'),
                    'info' => _t('_bx_matches_form_info_join_confirmation'),
                    'values' => array(
                        0 => _t('_bx_matches_form_join_confirmation_disabled'),
                        1 => _t('_bx_matches_form_join_confirmation_enabled'),
                    ),
                    'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_form_err_join_confirmation'),
                    ),
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),

                //'allow_upload_photos_to' => $aInputPrivacyUploadPhotos,

                //'allow_upload_videos_to' => $aInputPrivacyUploadVideos,

                //'allow_upload_sounds_to' => $aInputPrivacyUploadSounds,

                //'allow_upload_files_to' => $aInputPrivacyUploadFiles,

                'Submit' => array (
                    'type' => 'submit',
                    'name' => 'submit_form',
                    'value' => _t('_Submit'),
                    'colspan' => false,
                ),
            ),
        );

        if (!$aCustomForm['inputs']['images_choice']['content']) {
            unset ($aCustomForm['inputs']['thumb']);
            unset ($aCustomForm['inputs']['images_choice']);
        }

        if (!$aCustomForm['inputs']['videos_choice']['content'])
            unset ($aCustomForm['inputs']['videos_choice']);

        if (!$aCustomForm['inputs']['sounds_choice']['content'])
            unset ($aCustomForm['inputs']['sounds_choice']);

        if (!$aCustomForm['inputs']['files_choice']['content'])
            unset ($aCustomForm['inputs']['files_choice']);

        if (!isset($this->_aMedia['images'])) {
            unset ($aCustomForm['inputs']['header_images']);
            unset ($aCustomForm['inputs']['thumb']);
            unset ($aCustomForm['inputs']['images_choice']);
            unset ($aCustomForm['inputs']['images_upload']);
            unset ($aCustomForm['inputs']['allow_upload_photos_to']);
        }

        if (!isset($this->_aMedia['videos'])) {
            unset ($aCustomForm['inputs']['header_videos']);
            unset ($aCustomForm['inputs']['videos_choice']);
            unset ($aCustomForm['inputs']['videos_upload']);
            unset ($aCustomForm['inputs']['allow_upload_videos_to']);
        }

        if (!isset($this->_aMedia['sounds'])) {
            unset ($aCustomForm['inputs']['header_sounds']);
            unset ($aCustomForm['inputs']['sounds_choice']);
            unset ($aCustomForm['inputs']['sounds_upload']);
            unset ($aCustomForm['inputs']['allow_upload_sounds_to']);
        }

        if (!isset($this->_aMedia['files'])) {
            unset ($aCustomForm['inputs']['header_files']);
            unset ($aCustomForm['inputs']['files_choice']);
            unset ($aCustomForm['inputs']['files_upload']);
            unset ($aCustomForm['inputs']['allow_upload_files_to']);
        }

        $this->processMembershipChecksForMediaUploads ($aCustomForm['inputs']);
	
        parent::BxDolFormMedia ($aCustomForm);
    }

}
