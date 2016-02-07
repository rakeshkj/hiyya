<?php $mixedData=array (
  'all' => 
  array (
    'capt' => 'Members',
    'query' => 'SELECT COUNT(`ID`) FROM `Profiles` WHERE `Status`=\'Active\' AND (`Couple`=\'0\' OR `Couple`>`ID`)',
    'link' => 'browse.php',
    'icon' => 'user',
    'adm_query' => 'SELECT COUNT(`ID`) FROM `Profiles` WHERE `Status`=\'Approval\' AND (`Couple`=\'0\' OR `Couple`>`ID`)',
    'adm_link' => '{admin_url}profiles.php?action=browse&by=status&value=approval',
  ),
  'phs' => 
  array (
    'capt' => 'bx_photos',
    'query' => 'SELECT COUNT(`ID`) FROM `bx_photos_main` WHERE `Status`=\'approved\'',
    'link' => 'm/photos/browse/all',
    'icon' => 'picture-o',
    'adm_query' => 'SELECT COUNT(*) FROM `bx_photos_main` as a left JOIN `sys_albums_objects` as b ON b.`id_object`=a.`ID` left JOIN `sys_albums` as c ON c.`ID`=b.`id_album` WHERE a.`Status` =\'pending\' AND c.`AllowAlbumView` NOT IN(8) AND c.`Type`=\'bx_photos\'',
    'adm_link' => 'm/photos/administration/home/pending',
  ),
  'bx_groups' => 
  array (
    'capt' => 'bx_groups',
    'query' => 'SELECT COUNT(`id`) FROM `bx_groups_main` WHERE `status`=\'approved\'',
    'link' => 'm/groups/browse/recent',
    'icon' => 'users',
    'adm_query' => 'SELECT COUNT(`id`) FROM `bx_groups_main` WHERE `status`=\'pending\'',
    'adm_link' => 'm/groups/administration',
  ),
  'bx_teams' => 
  array (
    'capt' => 'bx_teams',
    'query' => 'SELECT COUNT(`id`) FROM `bx_teams_main` WHERE `status`=\'approved\'',
    'link' => 'm/teams/browse/recent',
    'icon' => 'team',
    'adm_query' => 'SELECT COUNT(`id`) FROM `bx_teams_main` WHERE `status`=\'pending\'',
    'adm_link' => 'm/teams/administration',
  ),
  'bx_matches' => 
  array (
    'capt' => 'bx_matches',
    'query' => 'SELECT COUNT(`id`) FROM `bx_matches_main` WHERE `status`=\'approved\'',
    'link' => 'm/matches/browse/recent',
    'icon' => 'match',
    'adm_query' => 'SELECT COUNT(`id`) FROM `bx_matches_main` WHERE `status`=\'pending\'',
    'adm_link' => 'm/matches/administration',
  ),
); ?>