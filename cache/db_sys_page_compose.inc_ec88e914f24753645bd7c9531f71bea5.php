<?php $mixedData=array (
  'browse_page' => 
  array (
    'Title' => 'All Members',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          36 => 
          array (
            'Func' => 'SearchedMembersBlock',
            'Content' => '',
            'Caption' => '_People',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          35 => 
          array (
            'Func' => 'SettingsBlock',
            'Content' => '',
            'Caption' => '_Browse',
            'Visible' => 'non,memb',
            'DesignBox' => 0,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_groups_main' => 
  array (
    'Title' => 'Groups Home',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          130 => 
          array (
            'Func' => 'LatestFeaturedGroup',
            'Content' => '',
            'Caption' => '_bx_groups_block_latest_featured_group',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          131 => 
          array (
            'Func' => 'Recent',
            'Content' => '',
            'Caption' => '_bx_groups_block_recent',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          132 => 
          array (
            'Func' => 'PHP',
            'Content' => 'return BxDolService::call(\'wmap\', \'homepage_part_block\', array (\'groups\'));',
            'Caption' => '_Map',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          133 => 
          array (
            'Func' => 'Categories',
            'Content' => '',
            'Caption' => '_bx_groups_block_categories',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_groups_my' => 
  array (
    'Title' => 'Groups My',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          134 => 
          array (
            'Func' => 'Owner',
            'Content' => '',
            'Caption' => '_bx_groups_block_administration_owner',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          135 => 
          array (
            'Func' => 'Browse',
            'Content' => '',
            'Caption' => '_bx_groups_block_users_groups',
            'Visible' => 'non,memb',
            'DesignBox' => 0,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_groups_view' => 
  array (
    'Title' => 'Group View',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          123 => 
          array (
            'Func' => 'Desc',
            'Content' => '',
            'Caption' => '_bx_groups_block_desc',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          124 => 
          array (
            'Func' => 'Photo',
            'Content' => '',
            'Caption' => '_bx_groups_block_photo',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          125 => 
          array (
            'Func' => 'Video',
            'Content' => '',
            'Caption' => '_bx_groups_block_video',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          126 => 
          array (
            'Func' => 'Sound',
            'Content' => '',
            'Caption' => '_bx_groups_block_sound',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          127 => 
          array (
            'Func' => 'Files',
            'Content' => '',
            'Caption' => '_bx_groups_block_files',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          128 => 
          array (
            'Func' => 'Comments',
            'Content' => '',
            'Caption' => '_bx_groups_block_comments',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          129 => 
          array (
            'Func' => 'ForumFeed',
            'Content' => '',
            'Caption' => '_sys_block_title_forum_feed',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          115 => 
          array (
            'Func' => 'Info',
            'Content' => '',
            'Caption' => '_bx_groups_block_info',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          116 => 
          array (
            'Func' => 'Actions',
            'Content' => '',
            'Caption' => '_bx_groups_block_actions',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          117 => 
          array (
            'Func' => 'Rate',
            'Content' => '',
            'Caption' => '_bx_groups_block_rate',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          118 => 
          array (
            'Func' => 'SocialSharing',
            'Content' => '',
            'Caption' => '_sys_block_title_social_sharing',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          119 => 
          array (
            'Func' => 'Fans',
            'Content' => '',
            'Caption' => '_bx_groups_block_fans',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          120 => 
          array (
            'Func' => 'FansUnconfirmed',
            'Content' => '',
            'Caption' => '_bx_groups_block_fans_unconfirmed',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          121 => 
          array (
            'Func' => 'PHP',
            'Content' => 'return BxDolService::call(\'wmap\', \'location_block\', array(\'groups\', $this->aDataEntry[$this->_oDb->_sFieldId]));',
            'Caption' => '_Location',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          122 => 
          array (
            'Func' => 'PHP',
            'Content' => 'return BxDolService::call(\'shoutbox\', \'get_shoutbox\', array(\'bx_groups\', $this->aDataEntry[$this->_oDb->_sFieldId]));',
            'Caption' => '_Chat',
            'Visible' => 'non,memb',
            'DesignBox' => 11,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_matches_main' => 
  array (
    'Title' => 'Matches Home',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          202 => 
          array (
            'Func' => 'LatestFeaturedMatch',
            'Content' => '',
            'Caption' => '_bx_matches_block_latest_featured_match',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          203 => 
          array (
            'Func' => 'Recent',
            'Content' => '',
            'Caption' => '_bx_matches_block_recent',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          204 => 
          array (
            'Func' => 'PHP',
            'Content' => 'return BxDolService::call(\'wmap\', \'homepage_part_block\', array (\'matches\'));',
            'Caption' => '_Map',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          216 => 
          array (
            'Func' => 'PlaygroundListByUser',
            'Content' => '',
            'Caption' => '_bx_matches_block_playground',
            'Visible' => 'non,memb',
            'DesignBox' => 11,
            'Cache' => 0,
          ),
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          205 => 
          array (
            'Func' => 'Categories',
            'Content' => '',
            'Caption' => '_bx_matches_block_categories',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_matches_my' => 
  array (
    'Title' => 'Matches My',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          206 => 
          array (
            'Func' => 'Owner',
            'Content' => '',
            'Caption' => '_bx_matches_block_administration_owner',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          207 => 
          array (
            'Func' => 'Browse',
            'Content' => '',
            'Caption' => '_bx_matches_block_users_matches',
            'Visible' => 'non,memb',
            'DesignBox' => 0,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_matches_pgview' => 
  array (
    'Title' => '',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          214 => 
          array (
            'Func' => 'Desc',
            'Content' => '',
            'Caption' => '_bx_matches_pg_block_desc',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          215 => 
          array (
            'Func' => 'Photo',
            'Content' => '',
            'Caption' => '_bx_matches_pg_block_photo',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          212 => 
          array (
            'Func' => 'Info',
            'Content' => '',
            'Caption' => '_bx_matches_pg_block_info',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          213 => 
          array (
            'Func' => 'Actions',
            'Content' => '',
            'Caption' => '_bx_matches_pg_block_actions',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_matches_view' => 
  array (
    'Title' => 'Match View',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          195 => 
          array (
            'Func' => 'Desc',
            'Content' => '',
            'Caption' => '_bx_matches_block_desc',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          196 => 
          array (
            'Func' => 'Photo',
            'Content' => '',
            'Caption' => '_bx_matches_block_photo',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          197 => 
          array (
            'Func' => 'Video',
            'Content' => '',
            'Caption' => '_bx_matches_block_video',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          198 => 
          array (
            'Func' => 'Sound',
            'Content' => '',
            'Caption' => '_bx_matches_block_sound',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          199 => 
          array (
            'Func' => 'Files',
            'Content' => '',
            'Caption' => '_bx_matches_block_files',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          200 => 
          array (
            'Func' => 'Comments',
            'Content' => '',
            'Caption' => '_bx_matches_block_comments',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          201 => 
          array (
            'Func' => 'ForumFeed',
            'Content' => '',
            'Caption' => '_sys_block_title_forum_feed',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          188 => 
          array (
            'Func' => 'Info',
            'Content' => '',
            'Caption' => '_bx_matches_block_info',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          189 => 
          array (
            'Func' => 'Actions',
            'Content' => '',
            'Caption' => '_bx_matches_block_actions',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          190 => 
          array (
            'Func' => 'Rate',
            'Content' => '',
            'Caption' => '_bx_matches_block_rate',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          191 => 
          array (
            'Func' => 'SocialSharing',
            'Content' => '',
            'Caption' => '_sys_block_title_social_sharing',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          192 => 
          array (
            'Func' => 'Fans',
            'Content' => '',
            'Caption' => '_bx_matches_block_fans',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          193 => 
          array (
            'Func' => 'FansUnconfirmed',
            'Content' => '',
            'Caption' => '_bx_matches_block_fans_unconfirmed',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          194 => 
          array (
            'Func' => 'PHP',
            'Content' => 'return BxDolService::call(\'wmap\', \'location_block\', array(\'matches\', $this->aDataEntry[$this->_oDb->_sFieldId]));',
            'Caption' => '_Location',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_photos_albums_my' => 
  array (
    'Title' => '',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          90 => 
          array (
            'Func' => 'add',
            'Content' => '',
            'Caption' => '_bx_photos_albums_add',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          89 => 
          array (
            'Func' => 'adminShort',
            'Content' => '',
            'Caption' => '_bx_photos_albums_admin',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          91 => 
          array (
            'Func' => 'adminFull',
            'Content' => '',
            'Caption' => '_bx_photos_albums_admin',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          92 => 
          array (
            'Func' => 'adminFullDisapproved',
            'Content' => '',
            'Caption' => '_bx_photos_albums_disapproved',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          93 => 
          array (
            'Func' => 'edit',
            'Content' => '',
            'Caption' => '_bx_photos_album_edit',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          94 => 
          array (
            'Func' => 'delete',
            'Content' => '',
            'Caption' => '_bx_photos_album_delete',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          95 => 
          array (
            'Func' => 'organize',
            'Content' => '',
            'Caption' => '_bx_photos_album_organize',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          96 => 
          array (
            'Func' => 'addObjects',
            'Content' => '',
            'Caption' => '_bx_photos_album_add_objects',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          97 => 
          array (
            'Func' => 'manageObjects',
            'Content' => '',
            'Caption' => '_bx_photos_album_manage_objects',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          98 => 
          array (
            'Func' => 'manageObjectsDisapproved',
            'Content' => '',
            'Caption' => '_bx_photos_album_manage_objects_disapproved',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          99 => 
          array (
            'Func' => 'manageObjectsPending',
            'Content' => '',
            'Caption' => '_bx_photos_album_manage_objects_pending',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          100 => 
          array (
            'Func' => 'adminAlbumShort',
            'Content' => '',
            'Caption' => '_bx_photos_album_main_objects',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          101 => 
          array (
            'Func' => 'albumObjects',
            'Content' => '',
            'Caption' => '_bx_photos_album_objects',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          102 => 
          array (
            'Func' => 'my',
            'Content' => '',
            'Caption' => '_bx_photos_albums_my',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_photos_albums_owner' => 
  array (
    'Title' => 'Photos Profile Albums',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          103 => 
          array (
            'Func' => 'ProfilePhotos',
            'Content' => '',
            'Caption' => '_bx_photos_photo_album_block',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          104 => 
          array (
            'Func' => 'Browse',
            'Content' => '',
            'Caption' => '_bx_photos_albums_owner',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          105 => 
          array (
            'Func' => 'Favorited',
            'Content' => '',
            'Caption' => '_bx_photos_favorited',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_photos_album_view' => 
  array (
    'Title' => 'Photos View Album',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          85 => 
          array (
            'Func' => 'Objects',
            'Content' => '',
            'Caption' => '',
            'Visible' => 'non,memb',
            'DesignBox' => 0,
            'Cache' => 0,
          ),
          86 => 
          array (
            'Func' => 'Comments',
            'Content' => '',
            'Caption' => '_bx_photos_comments',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          87 => 
          array (
            'Func' => 'Author',
            'Content' => '',
            'Caption' => '_bx_photos_author',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          88 => 
          array (
            'Func' => 'Actions',
            'Content' => '',
            'Caption' => '_bx_photos_actions',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_photos_crop' => 
  array (
    'Title' => 'Photos Crop Photo',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          108 => 
          array (
            'Func' => 'Crop',
            'Content' => '',
            'Caption' => '_bx_photos_crop',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_photos_home' => 
  array (
    'Title' => 'Photos Home',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          78 => 
          array (
            'Func' => 'Cover',
            'Content' => '',
            'Caption' => '_bx_photos_cover',
            'Visible' => 'non,memb',
            'DesignBox' => 0,
            'Cache' => 0,
          ),
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          81 => 
          array (
            'Func' => 'LatestFile',
            'Content' => '',
            'Caption' => '_bx_photos_latest_file',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          82 => 
          array (
            'Func' => 'All',
            'Content' => '',
            'Caption' => '_bx_photos_public',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          83 => 
          array (
            'Func' => 'Calendar',
            'Content' => '',
            'Caption' => '_bx_photos_top_menu_calendar',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          79 => 
          array (
            'Func' => 'Albums',
            'Content' => '',
            'Caption' => '_bx_photos_albums',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          84 => 
          array (
            'Func' => 'Tags',
            'Content' => '',
            'Caption' => '_bx_photos_top_menu_tags',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_photos_rate' => 
  array (
    'Title' => 'Photos Rate',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          106 => 
          array (
            'Func' => 'RatedSet',
            'Content' => '',
            'Caption' => '_bx_photos_previous_rated',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          107 => 
          array (
            'Func' => 'RateObject',
            'Content' => '',
            'Caption' => '_bx_photos_rate_header',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_photos_view' => 
  array (
    'Title' => 'Photos View Photo',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          70 => 
          array (
            'Func' => 'ViewFile',
            'Content' => '',
            'Caption' => '_bx_photos_view',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          71 => 
          array (
            'Func' => 'ViewComments',
            'Content' => '',
            'Caption' => '_bx_photos_comments',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          72 => 
          array (
            'Func' => 'FileAuthor',
            'Content' => '',
            'Caption' => '_bx_photos_author',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          73 => 
          array (
            'Func' => 'MainFileInfo',
            'Content' => '',
            'Caption' => '_bx_photos_info_main',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          74 => 
          array (
            'Func' => 'ActionList',
            'Content' => '',
            'Caption' => '_bx_photos_actions',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          75 => 
          array (
            'Func' => 'SocialSharing',
            'Content' => '',
            'Caption' => '_sys_block_title_social_sharing',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          76 => 
          array (
            'Func' => 'ViewAlbum',
            'Content' => '',
            'Caption' => '_bx_photos_album_photos_rest',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_teams_main' => 
  array (
    'Title' => 'Teams Home',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          154 => 
          array (
            'Func' => 'LatestFeaturedTeam',
            'Content' => '',
            'Caption' => '_bx_teams_block_latest_featured_team',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          155 => 
          array (
            'Func' => 'Recent',
            'Content' => '',
            'Caption' => '_bx_teams_block_recent',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          156 => 
          array (
            'Func' => 'PHP',
            'Content' => 'return BxDolService::call(\'wmap\', \'homepage_part_block\', array (\'teams\'));',
            'Caption' => '_Map',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          157 => 
          array (
            'Func' => 'Categories',
            'Content' => '',
            'Caption' => '_bx_teams_block_categories',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_teams_my' => 
  array (
    'Title' => 'Teams My',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          158 => 
          array (
            'Func' => 'Owner',
            'Content' => '',
            'Caption' => '_bx_teams_block_administration_owner',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          159 => 
          array (
            'Func' => 'Browse',
            'Content' => '',
            'Caption' => '_bx_teams_block_users_teams',
            'Visible' => 'non,memb',
            'DesignBox' => 0,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'bx_teams_view' => 
  array (
    'Title' => 'Team View',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          147 => 
          array (
            'Func' => 'Desc',
            'Content' => '',
            'Caption' => '_bx_teams_block_desc',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          148 => 
          array (
            'Func' => 'Photo',
            'Content' => '',
            'Caption' => '_bx_teams_block_photo',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          149 => 
          array (
            'Func' => 'Video',
            'Content' => '',
            'Caption' => '_bx_teams_block_video',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          150 => 
          array (
            'Func' => 'Sound',
            'Content' => '',
            'Caption' => '_bx_teams_block_sound',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          151 => 
          array (
            'Func' => 'Files',
            'Content' => '',
            'Caption' => '_bx_teams_block_files',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          152 => 
          array (
            'Func' => 'Comments',
            'Content' => '',
            'Caption' => '_bx_teams_block_comments',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          153 => 
          array (
            'Func' => 'ForumFeed',
            'Content' => '',
            'Caption' => '_sys_block_title_forum_feed',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          140 => 
          array (
            'Func' => 'Info',
            'Content' => '',
            'Caption' => '_bx_teams_block_info',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          141 => 
          array (
            'Func' => 'Actions',
            'Content' => '',
            'Caption' => '_bx_teams_block_actions',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          142 => 
          array (
            'Func' => 'Rate',
            'Content' => '',
            'Caption' => '_bx_teams_block_rate',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          143 => 
          array (
            'Func' => 'SocialSharing',
            'Content' => '',
            'Caption' => '_sys_block_title_social_sharing',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          144 => 
          array (
            'Func' => 'Fans',
            'Content' => '',
            'Caption' => '_bx_teams_block_fans',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          145 => 
          array (
            'Func' => 'FansUnconfirmed',
            'Content' => '',
            'Caption' => '_bx_teams_block_fans_unconfirmed',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'categ_calendar' => 
  array (
    'Title' => 'Categories Calendar',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          59 => 
          array (
            'Func' => 'Calendar',
            'Content' => '',
            'Caption' => '_categ_caption_calendar',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          60 => 
          array (
            'Func' => 'CategoriesDate',
            'Content' => '',
            'Caption' => '_categ_caption_day',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'categ_module' => 
  array (
    'Title' => 'Categories Module',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          63 => 
          array (
            'Func' => 'Common',
            'Content' => '',
            'Caption' => '_categ_caption_common',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          64 => 
          array (
            'Func' => 'All',
            'Content' => '',
            'Caption' => '_categ_caption_all',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'categ_search' => 
  array (
    'Title' => 'Categories Search',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          61 => 
          array (
            'Func' => 'Form',
            'Content' => '',
            'Caption' => '_categ_caption_search_form',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 86400,
          ),
          62 => 
          array (
            'Func' => 'Founded',
            'Content' => '',
            'Caption' => '_categ_caption_founded',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'communicator_page' => 
  array (
    'Title' => 'Communicator',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          49 => 
          array (
            'Func' => 'Connections',
            'Content' => '',
            'Caption' => '_sys_cnts_bcpt_connections',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          50 => 
          array (
            'Func' => 'FriendRequests',
            'Content' => '',
            'Caption' => '_sys_cnts_bcpt_friend_requests',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'friends' => 
  array (
    'Title' => 'Friends',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          32 => 
          array (
            'Func' => 'Friends',
            'Content' => '',
            'Caption' => '_Member Friends',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          33 => 
          array (
            'Func' => 'FriendsRequests',
            'Content' => '',
            'Caption' => '_Member Friends Requests',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          34 => 
          array (
            'Func' => 'FriendsMutual',
            'Content' => '',
            'Caption' => '_Member Friends Mutual',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'index' => 
  array (
    'Title' => 'Homepage',
    'Width' => '1185px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          11 => 
          array (
            'Func' => 'RSS',
            'Content' => 'http://www.boonex.com/notes/featured_posts/?rss=1#4',
            'Caption' => '_BoonEx News',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 86400,
          ),
          109 => 
          array (
            'Func' => 'PHP',
            'Content' => 'require_once(BX_DIRECTORY_PATH_MODULES . \'boonex/photos/classes/BxPhotosSearch.php\');
 $oMedia = new BxPhotosSearch();
 $aVisible[] = BX_DOL_PG_ALL;
 if ($this->iMemberID > 0)
 $aVisible[] = BX_DOL_PG_MEMBERS;
 $aCode = $oMedia->getBrowseBlock(array(\'allow_view\'=>$aVisible), array(\'menu_top\'=>true, \'sorting\' => getParam(\'bx_photos_mode_index\'), \'per_page\'=>(int)getParam(\'bx_photos_number_index\')));
 return array($aCode[\'code\'], $aCode[\'menu_top\'], $aCode[\'menu_bottom\'], $aCode[\'wrapper\']);',
            'Caption' => '_bx_photos_public',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          9 => 
          array (
            'Func' => 'Members',
            'Content' => '',
            'Caption' => '_Members',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          4 => 
          array (
            'Func' => 'Subscribe',
            'Content' => '',
            'Caption' => '_Subscribe_block_caption',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          3 => 
          array (
            'Func' => 'SiteStats',
            'Content' => '',
            'Caption' => '_Site Stats',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 3600,
          ),
        ),
      ),
    ),
  ),
  'join' => 
  array (
    'Title' => 'Join Page',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          47 => 
          array (
            'Func' => 'JoinForm',
            'Content' => '',
            'Caption' => '_Join_now',
            'Visible' => 'non',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'mail_page' => 
  array (
    'Title' => 'Mail messages',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          37 => 
          array (
            'Func' => 'MailBox',
            'Content' => '',
            'Caption' => '_Mail box',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          38 => 
          array (
            'Func' => 'Contacts',
            'Content' => '',
            'Caption' => '_My contacts',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'mail_page_compose' => 
  array (
    'Title' => 'Mail compose message',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          41 => 
          array (
            'Func' => 'ComposeMessage',
            'Content' => '',
            'Caption' => '_COMPOSE_H',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          42 => 
          array (
            'Func' => 'Contacts',
            'Content' => '',
            'Caption' => '_My contacts',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'mail_page_view' => 
  array (
    'Title' => 'Mail view message',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          39 => 
          array (
            'Func' => 'ViewMessage',
            'Content' => '',
            'Caption' => '_Mail box',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          40 => 
          array (
            'Func' => 'Archives',
            'Content' => '',
            'Caption' => '_Archive',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'member' => 
  array (
    'Title' => 'Account',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 74.099999999999994,
        'Blocks' => 
        array (
          13 => 
          array (
            'Func' => 'QuickLinks',
            'Content' => '',
            'Caption' => '_Quick Links',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 25.899999999999999,
        'Blocks' => 
        array (
          14 => 
          array (
            'Func' => 'FriendRequests',
            'Content' => '',
            'Caption' => '_sys_bcpt_member_friend_requests',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          15 => 
          array (
            'Func' => 'NewMessages',
            'Content' => '',
            'Caption' => '_sys_bcpt_member_new_messages',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          16 => 
          array (
            'Func' => 'AccountControl',
            'Content' => '',
            'Caption' => '_sys_bcpt_member_account_control',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'pedit' => 
  array (
    'Title' => 'Profile Edit',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          65 => 
          array (
            'Func' => 'Info',
            'Content' => '',
            'Caption' => '_edit_profile_info',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          66 => 
          array (
            'Func' => 'Privacy',
            'Content' => '',
            'Caption' => '_edit_profile_privacy',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          67 => 
          array (
            'Func' => 'Membership',
            'Content' => '',
            'Caption' => '_edit_profile_membership',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'profile' => 
  array (
    'Title' => 'Profile',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          18 => 
          array (
            'Func' => 'Cover',
            'Content' => '',
            'Caption' => '_sys_bcpt_profile_cover',
            'Visible' => 'non,memb',
            'DesignBox' => 0,
            'Cache' => 0,
          ),
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          111 => 
          array (
            'Func' => 'PHP',
            'Content' => 'return BxDolService::call(\'photos\', \'get_profile_album_block\', array($this->oProfileGen->_iProfileID), \'Search\');',
            'Caption' => '_bx_photos_photo_album_block',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          19 => 
          array (
            'Func' => 'ActionsMenu',
            'Content' => '',
            'Caption' => '_Actions',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          20 => 
          array (
            'Func' => 'FriendRequest',
            'Content' => '',
            'Caption' => '_FriendRequest',
            'Visible' => 'memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          22 => 
          array (
            'Func' => 'PFBlock',
            'Content' => '21',
            'Caption' => '_FieldCaption_Admin Controls_View',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          23 => 
          array (
            'Func' => 'PFBlock',
            'Content' => '17',
            'Caption' => '_FieldCaption_General Info_View',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          24 => 
          array (
            'Func' => 'RateProfile',
            'Content' => '',
            'Caption' => '_rate profile',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          21 => 
          array (
            'Func' => 'Description',
            'Content' => '',
            'Caption' => '_Description',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'profile_info' => 
  array (
    'Title' => 'Profile Info',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          29 => 
          array (
            'Func' => 'GeneralInfo',
            'Content' => '',
            'Caption' => '_FieldCaption_General Info_View',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          31 => 
          array (
            'Func' => 'Description',
            'Content' => '',
            'Caption' => '_Description',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          30 => 
          array (
            'Func' => 'AdditionalInfo',
            'Content' => '',
            'Caption' => '_Additional information',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'profile_private' => 
  array (
    'Title' => 'Profile Private',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          68 => 
          array (
            'Func' => 'ActionsMenu',
            'Content' => '',
            'Caption' => '_Actions',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          69 => 
          array (
            'Func' => 'PrivacyExplain',
            'Content' => '',
            'Caption' => '_sys_profile_private_text_title',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'search' => 
  array (
    'Title' => 'Search Profiles',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          43 => 
          array (
            'Func' => 'Results',
            'Content' => '',
            'Caption' => '_Search result',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          44 => 
          array (
            'Func' => 'SearchForm',
            'Content' => '',
            'Caption' => '_Search profiles',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'search_home' => 
  array (
    'Title' => 'Search Home',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          45 => 
          array (
            'Func' => 'Keyword',
            'Content' => '',
            'Caption' => '_sys_box_title_search_keyword',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 86400,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          46 => 
          array (
            'Func' => 'People',
            'Content' => '',
            'Caption' => '_sys_box_title_search_people',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'tags_calendar' => 
  array (
    'Title' => 'Tags Search',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          53 => 
          array (
            'Func' => 'Calendar',
            'Content' => '',
            'Caption' => '_tags_calendar',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
          54 => 
          array (
            'Func' => 'TagsDate',
            'Content' => '',
            'Caption' => '_Tags',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'tags_home' => 
  array (
    'Title' => 'Tags Home',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          51 => 
          array (
            'Func' => 'Recent',
            'Content' => '',
            'Caption' => '_tags_recent',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          52 => 
          array (
            'Func' => 'Popular',
            'Content' => '',
            'Caption' => '_popular_tags',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'tags_module' => 
  array (
    'Title' => 'Tags Module',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 28.100000000000001,
        'Blocks' => 
        array (
          57 => 
          array (
            'Func' => 'Recent',
            'Content' => '',
            'Caption' => '_tags_recent',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
      3 => 
      array (
        'Width' => 71.900000000000006,
        'Blocks' => 
        array (
          58 => 
          array (
            'Func' => 'All',
            'Content' => '',
            'Caption' => '_all_tags',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
  'tags_search' => 
  array (
    'Title' => 'Tags Calendar',
    'Width' => '1140px',
    'Columns' => 
    array (
      1 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
        ),
      ),
      2 => 
      array (
        'Width' => 100,
        'Blocks' => 
        array (
          55 => 
          array (
            'Func' => 'Form',
            'Content' => '',
            'Caption' => '_tags_search_form',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 86400,
          ),
          56 => 
          array (
            'Func' => 'Founded',
            'Content' => '',
            'Caption' => '_tags_founded_tags',
            'Visible' => 'non,memb',
            'DesignBox' => 1,
            'Cache' => 0,
          ),
        ),
      ),
    ),
  ),
); ?>