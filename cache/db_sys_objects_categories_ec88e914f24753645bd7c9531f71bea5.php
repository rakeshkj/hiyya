<?php $mixedData=array (
  'bx_photos' => 
  array (
    'ID' => '1',
    'ObjectName' => 'bx_photos',
    'Query' => 'SELECT `Categories` FROM `bx_photos_main` WHERE `ID`  = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_photos_permalinks',
    'EnabledPermalink' => 'm/photos/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=photos/browse/category/{tag}',
    'LangKey' => '_bx_photos',
  ),
  'bx_groups' => 
  array (
    'ID' => '2',
    'ObjectName' => 'bx_groups',
    'Query' => 'SELECT `Categories` FROM `bx_groups_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_groups_permalinks',
    'EnabledPermalink' => 'm/groups/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=groups/browse/category/{tag}',
    'LangKey' => '_bx_groups',
  ),
  'bx_teams' => 
  array (
    'ID' => '3',
    'ObjectName' => 'bx_teams',
    'Query' => 'SELECT `Categories` FROM `bx_teams_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_teams_permalinks',
    'EnabledPermalink' => 'm/teams/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=teams/browse/category/{tag}',
    'LangKey' => '_bx_teams',
  ),
  'bx_matches' => 
  array (
    'ID' => '5',
    'ObjectName' => 'bx_matches',
    'Query' => 'SELECT `Categories` FROM `bx_matches_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_matches_permalinks',
    'EnabledPermalink' => 'm/matches/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=matches/browse/category/{tag}',
    'LangKey' => '_bx_matches',
  ),
); ?>