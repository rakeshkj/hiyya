<?php

/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

require_once( 'inc/header.inc.php' );
require_once( BX_DIRECTORY_PATH_INC . 'db.inc.php' );

   $insert =  db_res("INSERT INTO `sys_options` (`Name`, `VALUE`, `kateg`, `desc`, `Type`, `check`, `err_text`, `order_in_kateg`, `AvailableValues`) VALUES ('bx_teams_team_min_capacity', '4', 102, 'Team minimum capacity', 'digit', '', '', 0, '')", 0);
	if($insert) {
		echo "Query executed successfully.";
	} else {
		
		echo "There was some issue, please try after 5 mins";
	}