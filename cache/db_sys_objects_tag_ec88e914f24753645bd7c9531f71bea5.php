<?php $mixedData=array (
  'profile' => 
  array (
    'ID' => '1',
    'ObjectName' => 'profile',
    'Query' => 'SELECT `Tags` FROM `Profiles` WHERE `ID` = {iID} AND `Status` = \'Active\'',
    'PermalinkParam' => 'enable_modrewrite',
    'EnabledPermalink' => 'search/tag/{tag}',
    'DisabledPermalink' => 'search.php?Tags={tag}',
    'LangKey' => '_Profiles',
  ),
  'bx_photos' => 
  array (
    'ID' => '2',
    'ObjectName' => 'bx_photos',
    'Query' => 'SELECT `Tags` FROM `bx_photos_main` WHERE `ID` = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_photos_permalinks',
    'EnabledPermalink' => 'm/photos/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=photos/browse/tag/{tag}',
    'LangKey' => '_bx_photos',
  ),
  'bx_groups' => 
  array (
    'ID' => '3',
    'ObjectName' => 'bx_groups',
    'Query' => 'SELECT `Tags` FROM `bx_groups_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_groups_permalinks',
    'EnabledPermalink' => 'm/groups/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=groups/browse/tag/{tag}',
    'LangKey' => '_bx_groups',
  ),
  'bx_teams' => 
  array (
    'ID' => '4',
    'ObjectName' => 'bx_teams',
    'Query' => 'SELECT `Tags` FROM `bx_teams_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_teams_permalinks',
    'EnabledPermalink' => 'm/teams/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=teams/browse/tag/{tag}',
    'LangKey' => '_bx_teams',
  ),
  'bx_matches' => 
  array (
    'ID' => '6',
    'ObjectName' => 'bx_matches',
    'Query' => 'SELECT `Tags` FROM `bx_matches_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_matches_permalinks',
    'EnabledPermalink' => 'm/matches/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=matches/browse/tag/{tag}',
    'LangKey' => '_bx_matches',
  ),
); ?>