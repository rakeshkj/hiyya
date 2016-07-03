<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolTwigModuleDb');

/*
 * Match module Data
 */
class BxMatchDb extends BxDolTwigModuleDb
{
    /*
     * Constructor.
     */
    function BxMatchDb(&$oConfig)
    {
        parent::BxDolTwigModuleDb($oConfig);

        $this->_sTableMain = 'main';
        $this->_sTableMediaPrefix = '';
        $this->_sFieldId = 'id';
        $this->_sFieldAuthorId = 'author_id';
        $this->_sFieldUri = 'uri';
        $this->_sFieldTitle = 'title';
        $this->_sFieldDescription = 'desc';
        $this->_sFieldTags = 'tags';
        $this->_sFieldThumb = 'thumb';
        $this->_sFieldStatus = 'status';
        $this->_sFieldFeatured = 'featured';
        $this->_sFieldCreated = 'created';
        $this->_sFieldJoinConfirmation = 'join_confirmation';
        $this->_sFieldFansCount = 'fans_count';
        $this->_sTableFans = 'fans';
        $this->_sTableAdmins = 'admins';
        $this->_sFieldAllowViewTo = 'allow_view_match_to';
    }

    function deleteEntryByIdAndOwner ($iId, $iOwner, $isAdmin)
    {
        if ($iRet = parent::deleteEntryByIdAndOwner ($iId, $iOwner, $isAdmin)) {
            $this->query ("DELETE FROM `" . $this->_sPrefix . "fans` WHERE `id_entry` = $iId");
            $this->query ("DELETE FROM `" . $this->_sPrefix . "admins` WHERE `id_entry` = $iId");
            $this->deleteEntryMediaAll ($iId, 'images');
            $this->deleteEntryMediaAll ($iId, 'videos');
            $this->deleteEntryMediaAll ($iId, 'sounds');
            $this->deleteEntryMediaAll ($iId, 'files');
        }
        return $iRet;
    }
	
	function updatePgPhoto ($id) {
		
		//$imageid = $this->getOne("SELECT ID FROM `bx_photos_main` WHERE ID = {$id}");
		//$this->query("UPDATE {$this->_sPrefix}pg_main SET `thumb`={$imageid}"
						//. "WHERE id = {$id}");
	}
	
	function getPalgroundListByUser ()
    {
        return $this->getAll ("SELECT * FROM `" . $this->_sPrefix . 'pg_'.$this->_sTableMain . "` WHERE `author_id` = '" . $_COOKIE['memberID'] . "' || `author_id` = 1 ORDER BY `{$this->_sFieldCreated}`");
    }
	
	function getPalgroundDetails ($id)
    {
        return $this->getAll ("SELECT * FROM `" . $this->_sPrefix . 'pg_'.$this->_sTableMain . "` WHERE  `id` = '" . $id . "'");
    }
	function getMatchDetails ($id)
    {
        return $this->getRow ("SELECT match_type,join_confirmation,match_status,start_date,match_time,playground FROM `" . $this->_sPrefix .$this->_sTableMain . "` WHERE  `id` = '" . $id . "'");
    }
	
	function getFans(&$aProfiles, $iEntryId, $isConfirmed, $iStart, $iMaxNum, $aFilter = array(), $type='')
    {
        $isConfirmed = $isConfirmed ? 1 : 0;
        $sFilter = '';
        if ($aFilter) {
            $s = implode (' OR `f`.`id_profile` = ', $aFilter);
            $sFilter = ' AND (`f`.`id_profile` = ' . $s . ') ';
        }
        $aProfiles = $this->getAll ("SELECT SQL_CALC_FOUND_ROWS `p`.*,`f`.* FROM `Profiles` AS `p` INNER JOIN `" . $this->_sPrefix . $this->_sTableFans . "` AS `f` ON (`f`.`id_entry` = '$iEntryId' AND `f`.`id_profile` = `p`.`ID` AND `f`.`confirmed` = $isConfirmed AND `f`.`type` = '$type' AND `p`.`Status` = 'Active' $sFilter) ORDER BY `f`.`when` DESC LIMIT $iStart, $iMaxNum");
        return $this->getOne("SELECT FOUND_ROWS()");
    }
	function getTeamPlayers(&$aProfiles, $iEntryId, $isConfirmed, $type, $team_id)
    {
        $isConfirmed = $isConfirmed ? 1 : 0;
        $aProfiles = $this->getAll ("SELECT SQL_CALC_FOUND_ROWS `p`.*,`f`.* FROM `Profiles` AS `p` INNER JOIN `" . $this->_sPrefix . $this->_sTableFans . "` AS `f` ON (`f`.`id_entry` = '$iEntryId' AND `f`.`id_profile` = `p`.`ID` AND `f`.`confirmed` = $isConfirmed AND `f`.`type` = '$type' AND `f`.`team_id` = '$team_id' AND `p`.`Status` = 'Active') GROUP BY `f`.`id_profile` ORDER BY  `f`.`when` DESC ");
        return $this->getOne("SELECT FOUND_ROWS()");
    }
	
	function getMatchTeam(&$aProfiles, $iEntryId, $iStart, $iMaxNum, $aFilter = array(), $type, $isConfirmed)
    {
        $isConfirmed = $isConfirmed ? 1 : 0;
        $sFilter = '';
        if ($aFilter) {
            $s = implode (' OR `f`.`id_profile` = ', $aFilter);
            $sFilter = ' AND (`f`.`id_profile` = ' . $s . ') ';
        }
        $aProfiles = $this->getAll ("SELECT SQL_CALC_FOUND_ROWS `p`.*,`f`.* FROM `Profiles` AS `p` INNER JOIN `" . $this->_sPrefix . $this->_sTableFans . "` AS `f` ON (`f`.`id_entry` = '$iEntryId' AND `f`.`id_profile` = `p`.`ID` AND `f`.`confirmed` = '$isConfirmed' AND `f`.`type` = '$type' AND `p`.`Status` = 'Active' $sFilter) GROUP BY `f`.`id_profile` ORDER BY `f`.`when` DESC LIMIT $iStart, $iMaxNum");
        return $this->getOne("SELECT FOUND_ROWS()");
    }
	
	function getMatchTeamUnconfirmed(&$aProfiles, $iEntryId, $iStart, $iMaxNum, $aFilter = array(), $type)
    {
        $isConfirmed = $isConfirmed ? 1 : 0;
        $sFilter = '';
        if ($aFilter) {
            $s = implode (' OR `f`.`id_profile` = ', $aFilter);
            $sFilter = ' AND (`f`.`id_profile` = ' . $s . ') ';
        }
        $aProfiles = $this->getAll ("SELECT SQL_CALC_FOUND_ROWS `p`.*,`f`.* FROM `Profiles` AS `p` INNER JOIN `" . $this->_sPrefix . $this->_sTableFans . "` AS `f` ON (`f`.`id_entry` = '$iEntryId' AND `f`.`id_profile` = `p`.`ID`  AND `f`.`type` = '$type' AND `p`.`Status` = 'Active' $sFilter) ORDER BY `f`.`when` DESC LIMIT $iStart, $iMaxNum");
        return $this->getOne("SELECT FOUND_ROWS()");
    }
	function getMatchTeamUnconfirmedPractice(&$aProfiles, $iEntryId, $iStart, $iMaxNum, $aFilter = array(), $type, $isConfirmed)
    {
        $isConfirmed = $isConfirmed ? 1 : 0;
        $sFilter = '';
        if ($aFilter) {
            $s = implode (' OR `f`.`id_profile` = ', $aFilter);
            $sFilter = ' AND (`f`.`id_profile` = ' . $s . ') ';
        }
        $aProfiles = $this->getAll ("SELECT SQL_CALC_FOUND_ROWS `p`.*,`f`.* FROM `Profiles` AS `p` INNER JOIN `" . $this->_sPrefix . $this->_sTableFans . "` AS `f` ON (`f`.`id_entry` = '$iEntryId' AND `f`.`id_profile` = `p`.`ID`  AND `f`.`type` = '$type' AND `f`.`confirmed` = '$isConfirmed' AND `p`.`Status` = 'Active' $sFilter) GROUP BY `f`.`id_profile` ORDER BY `f`.`when` DESC LIMIT $iStart, $iMaxNum");
        return $this->getOne("SELECT FOUND_ROWS()");
    }
	function getTeamDetails($id) {
		return $this->getAll ("SELECT * FROM `bx_teams_main` WHERE id='".$id."' ");	
	}
	
	function getMatchInvitationCount($matchid) {
		
		return $this->getOne ("SELECT count(*) as count FROM `bx_matches_fans` WHERE id_entry='".$matchid."' AND `type`='t'");	
	}
	
	function getMatchPlayersCount($matchid, $type) {    
		$match_type = ($type == 0) ? 0 : 'p';
		//return $this->getOne ("SELECT count(*) as count FROM `bx_matches_fans` WHERE id_entry='".$matchid."' AND `type`='".$match_type."' AND `confirmed`=1");	
		$team_players =  $this->getAll ("SELECT count(id_profile) as player_count FROM `bx_matches_fans` WHERE id_entry='".$matchid."' AND `type`='".$match_type."' AND `confirmed`=1 GROUP BY team_id" );	
		return $team_players;
	}
	function getMatchResult($matchid) {
		return $this->getOne ("SELECT count(*) as count FROM `bx_match_result` WHERE match_id='".$matchid."'");	
	}
	function getMatchResultPlayed($matchid) {
		return $this->getOne ("SELECT count(*) as count FROM `bx_match_result` WHERE match_id='".$matchid."' AND match_played = '1'");
	}
	function getMatchResultNotPlayed($matchid) {
		return $this->getOne ("SELECT count(*) as count FROM `bx_match_result` WHERE match_id='".$matchid."' AND match_played = '0'");
	}
	function getMatchStatus($aData) {
		$player_team = $this->getMatchPlayersCount($aData['id'], $aData['match_type']);
		$match_result = $this->getMatchResult($aData['id']);
		//echo '<pre>';print_r($match_result);
		$match_result_played = $this->getMatchResultPlayed($aData['id']);
		$pgdetails = $this->getPalgroundDetails($aData['playground']);
		$match_not_played = $this->getMatchResultNotPlayed($aData['id']);
		$min_player_match = $pgdetails[0]['min_players'];
		$max_player_match = $pgdetails[0]['max_players'];
		$match_max_result_time = $this->getParam('bx_matches_max_result_time');
		$match_start_time_min = $this->getParam('bx_matches_start_mins');
		$start_date = explode(' ', date('Y-m-d H:i:s',$aData['start_date']));
-		$start_time = strtotime($start_date[0])+($aData['match_time']*60*60)+($match_start_time_min*60);
		$current_time = time();
		$time_after_hour = $this->matchDuration($aData['id']);
		$submit_result_duraion = $time_after_hour+($match_max_result_time*60);
		$match_status = 'Waiting for players';
		if($aData['match_type']=='1') {
			if(($max_player_match == $player_team[0]['player_count']) && ($max_player_match == $player_team[1]['player_count'])) {
				$match_status = 'Match Max players capacity reached';
			} elseif(($player_team[0]['player_count'] >=$min_player_match) && ($player_team[1]['player_count'] >=$min_player_match)) {
				$match_status = 'Scheduled';
			} elseif(($player_team[0]['player_count'] < $min_player_match) && ($player_team[1]['player_count'] < $min_player_match)) {      
				$match_status = 'Waiting for players';
			}
		} else {
			if(($max_player_match == $player_team[0]['player_count'])) {
				$match_status = 'Match Max players capacity reached';
			} elseif(($player_team[0]['player_count'] >=$min_player_match)) {
				$match_status = 'Scheduled';
			} elseif(($player_team[0]['player_count'] < $min_player_match)) {      
				$match_status = 'Waiting for players';
			}
			
		}
		if($current_time>=$start_time) {
			if($match_status == 'Waiting for players'){
				$match_status = 'Cancelled';
			} else {
			$match_status = 'Kick off';
			}
		}
		if($current_time>=$time_after_hour) {
			$match_status = 'Time Up/Waiting for Results';
		}
		if($match_result_played>=1){
			
			$match_status = 'Waiting for Result Confirmation';
		}
		if($current_time>=$submit_result_duraion) {
			if($match_result<=0) {
				$match_status = 'No Match Result';
			} elseif($match_result_played>=1) {
				if(!$this->maxApprovalTime($aData)) {
					$match_min_per = $this->getParam('bx_matches_min_percentage');
					$total_count = $this->getTotalPlayerCount($aData['id']);
					$approved_count = $this->getPlayersApprovalCount($aData['id']);
					$percentage = $approved_count/$total_count*100;
					if($percentage>$match_min_per) {
						$match_status = 'Played';
					} else {
						$match_status = 'No Match Result';
					}
				}
			}      
		}
		if($match_not_played>=1) {
			$match_status = 'Cancelled';
		}
		if($aData['match_status']==0) {
			$match_status = 'Cancelled';
		}
		
		return $match_status;
		
	}
	
	function teamResult($matchid) {
		return $this->getRow ("SELECT * FROM `bx_match_result` where `match_id`= '".$matchid."' AND `match_played`='1' ORDER BY date_created LIMIT 1");
	}
	
	function maxApprovalTime($data) {
		$current_time = time();
		
		if($data['match_type'] == '0') {
			if($data['match_type'] == '1') {
				$match_max_result_time = $this->getParam('bx_matches_max_approval_time_daily')*60;
			} elseif ($data['match_type'] == '2') {
				$match_max_result_time = $this->getParam('bx_matches_max_approval_time_weekly')*60;
			} elseif($data['match_type'] == '0') {
				
				$match_max_result_time = $this->getParam('bx_matches_max_approval_time')*60;
			}
		} else {
			
			$match_max_result_time = $this->getParam('bx_matches_max_approval_time')*60;
		}
		$max_approval_time = $this->matchDuration($data['id'])+$match_max_result_time;
		if($current_time>$max_approval_time){
			return false;
		} else {
			return true;
		}	
		
	}
	
	function getTotalPlayerCount($matchid) {
		
		$res = $this->teamResult($matchid);
		$home_player = explode(',', $res['home_team_players']);
		$away_player = explode(',', $res['away_team_players']);
		$players = count(array_merge($home_player,$away_player));
		
		return $players;
	}
	
	function getPlayersApprovalCount($matchid) {
		
		return $this->getOne ("SELECT count(*) as count FROM `bx_match_approval_players` WHERE match_id='".$matchid."' AND `approved`='1'");	
	}
	
	function getMatchTeamOwnerId($matchid) {
		
		$team_owners = $this->getAll("SELECT `id_profile` FROM `bx_matches_fans` WHERE id_entry='".$matchid."' AND `type`='t' ORDER BY `when` DESC LIMIT 0,2");
		foreach ($team_owners as $team_owner) {
			$team_owner_id[] = $team_owner['id_profile'];
		}
		return $team_owner_id;
	}
}
