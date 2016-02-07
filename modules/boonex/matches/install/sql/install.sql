-- create tables
CREATE TABLE IF NOT EXISTS `[db_prefix]main` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `uri` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `country` varchar(2) NOT NULL,
  `city` varchar(64) NOT NULL,
  `match_type` int(3) NOT NULL,
  `max_players` int(10) NOT NULL,
  `max_subtitude` int(10) NOT NULL,
  `place` varchar(255) NOT NULL,
  `match_time` varchar(20) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `block_booking` int(3) NOT NULL,
  `playground` int(3) NOT NULL,
  `indoor` int(3) NOT NULL,
  `max_age` int(3) NOT NULL,
  `gender` int(3) NOT NULL,
  `payment` varchar(25) NOT NULL,
  `status` enum('approved','pending') NOT NULL default 'approved',
  `thumb` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `author_id` int(10) unsigned NOT NULL default '0',
  `tags` varchar(255) NOT NULL default '',
  `categories` text NOT NULL,
  `views` int(11) NOT NULL,
  `rate` float NOT NULL,
  `rate_count` int(11) NOT NULL,
  `comments_count` int(11) NOT NULL,
  `fans_count` int(11) NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `allow_view_match_to` int(11) NOT NULL,
  `allow_view_fans_to` varchar(16) NOT NULL,
  `allow_comment_to` varchar(16) NOT NULL,
  `allow_rate_to` varchar(16) NOT NULL,  
  `allow_post_in_forum_to` varchar(16) NOT NULL,
  `allow_join_to` int(11) NOT NULL,
  `join_confirmation` tinyint(4) NOT NULL default '0',
  `allow_upload_photos_to` varchar(16) NOT NULL,
  `allow_upload_videos_to` varchar(16) NOT NULL,
  `allow_upload_sounds_to` varchar(16) NOT NULL,
  `allow_upload_files_to` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uri` (`uri`),
  KEY `author_id` (`author_id`),
  KEY `created` (`created`),
  FULLTEXT KEY `search` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `[db_prefix]fans` (
  `id_entry` int(10) unsigned NOT NULL,
  `id_profile` int(10) unsigned NOT NULL,
  `when` int(10) unsigned NOT NULL,
  `confirmed` tinyint(4) UNSIGNED NOT NULL default '0',
  PRIMARY KEY (`id_entry`, `id_profile`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `[db_prefix]admins` (
  `id_entry` int(10) unsigned NOT NULL,
  `id_profile` int(10) unsigned NOT NULL,
  `when` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_entry`, `id_profile`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `[db_prefix]images` (
  `entry_id` int(10) unsigned NOT NULL,
  `media_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `entry_id` (`entry_id`,`media_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `[db_prefix]videos` (
  `entry_id` int(10) unsigned NOT NULL,
  `media_id` int(11) NOT NULL,
  UNIQUE KEY `entry_id` (`entry_id`,`media_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `[db_prefix]sounds` (
  `entry_id` int(10) unsigned NOT NULL,
  `media_id` int(11) NOT NULL,
  UNIQUE KEY `entry_id` (`entry_id`,`media_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `[db_prefix]files` (
  `entry_id` int(10) unsigned NOT NULL,
  `media_id` int(11) NOT NULL,
  UNIQUE KEY `entry_id` (`entry_id`,`media_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `[db_prefix]rating` (
  `gal_id` smallint( 6 ) NOT NULL default '0',
  `gal_rating_count` int( 11 ) NOT NULL default '0',
  `gal_rating_sum` int( 11 ) NOT NULL default '0',
  UNIQUE KEY `gal_id` (`gal_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `[db_prefix]rating_track` (
  `gal_id` smallint( 6 ) NOT NULL default '0',
  `gal_ip` varchar( 20 ) default NULL,
  `gal_date` datetime default NULL,
  KEY `gal_ip` (`gal_ip`, `gal_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `[db_prefix]cmts` (
  `cmt_id` int( 11 ) NOT NULL AUTO_INCREMENT ,
  `cmt_parent_id` int( 11 ) NOT NULL default '0',
  `cmt_object_id` int( 12 ) NOT NULL default '0',
  `cmt_author_id` int( 10 ) unsigned NOT NULL default '0',
  `cmt_text` text NOT NULL ,
  `cmt_mood` tinyint( 4 ) NOT NULL default '0',
  `cmt_rate` int( 11 ) NOT NULL default '0',
  `cmt_rate_count` int( 11 ) NOT NULL default '0',
  `cmt_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `cmt_replies` int( 11 ) NOT NULL default '0',
  PRIMARY KEY ( `cmt_id` ),
  KEY `cmt_object_id` (`cmt_object_id` , `cmt_parent_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `[db_prefix]cmts_track` (
  `cmt_system_id` int( 11 ) NOT NULL default '0',
  `cmt_id` int( 11 ) NOT NULL default '0',
  `cmt_rate` tinyint( 4 ) NOT NULL default '0',
  `cmt_rate_author_id` int( 10 ) unsigned NOT NULL default '0',
  `cmt_rate_author_nip` int( 11 ) unsigned NOT NULL default '0',
  `cmt_rate_ts` int( 11 ) NOT NULL default '0',
  PRIMARY KEY (`cmt_system_id` , `cmt_id` , `cmt_rate_author_nip`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `[db_prefix]views_track` (
  `id` int(10) unsigned NOT NULL,
  `viewer` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  `ts` int(10) unsigned NOT NULL,
  KEY `id` (`id`,`viewer`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- create forum tables

CREATE TABLE `[db_prefix]forum` (
  `forum_id` int(10) unsigned NOT NULL auto_increment,
  `forum_uri` varchar(255) NOT NULL default '',
  `cat_id` int(11) NOT NULL default '0',
  `forum_title` varchar(255) default NULL,
  `forum_desc` varchar(255) NOT NULL default '',
  `forum_posts` int(11) NOT NULL default '0',
  `forum_topics` int(11) NOT NULL default '0',
  `forum_last` int(11) NOT NULL default '0',
  `forum_type` enum('public','private') NOT NULL default 'public',
  `forum_order` int(11) NOT NULL default '0',
  `entry_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`forum_id`),
  KEY `cat_id` (`cat_id`),
  KEY `forum_uri` (`forum_uri`),
  KEY `entry_id` (`entry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `[db_prefix]forum_cat` (
  `cat_id` int(10) unsigned NOT NULL auto_increment,
  `cat_uri` varchar(255) NOT NULL default '',
  `cat_name` varchar(255) default NULL,
  `cat_icon` varchar(32) NOT NULL default '',
  `cat_order` float NOT NULL default '0',
  `cat_expanded` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`cat_id`),
  KEY `cat_order` (`cat_order`),
  KEY `cat_uri` (`cat_uri`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `[db_prefix]forum_cat` (`cat_id`, `cat_uri`, `cat_name`, `cat_icon`, `cat_order`) VALUES 
(1, 'Matches', 'Matches', '', 64);

CREATE TABLE `[db_prefix]forum_flag` (
  `user` varchar(32) NOT NULL default '',
  `topic_id` int(11) NOT NULL default '0',
  `when` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user`,`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `[db_prefix]forum_post` (
  `post_id` int(10) unsigned NOT NULL auto_increment,
  `topic_id` int(11) NOT NULL default '0',
  `forum_id` int(11) NOT NULL default '0',
  `user` varchar(32) NOT NULL default '0',
  `post_text` mediumtext NOT NULL,
  `when` int(11) NOT NULL default '0',
  `votes` int(11) NOT NULL default '0',
  `reports` int(11) NOT NULL default '0',
  `hidden` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`post_id`),
  KEY `topic_id` (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `user` (`user`),
  KEY `when` (`when`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `[db_prefix]forum_topic` (
  `topic_id` int(10) unsigned NOT NULL auto_increment,
  `topic_uri` varchar(255) NOT NULL default '',
  `forum_id` int(11) NOT NULL default '0',
  `topic_title` varchar(255) NOT NULL default '',
  `when` int(11) NOT NULL default '0',
  `topic_posts` int(11) NOT NULL default '0',
  `first_post_user` varchar(32) NOT NULL default '0',
  `first_post_when` int(11) NOT NULL default '0',
  `last_post_user` varchar(32) NOT NULL default '',
  `last_post_when` int(11) NOT NULL default '0',
  `topic_sticky` int(11) NOT NULL default '0',
  `topic_locked` tinyint(4) NOT NULL default '0',
  `topic_hidden` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `forum_id_2` (`forum_id`,`when`),
  KEY `topic_uri` (`topic_uri`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `[db_prefix]forum_user` (
  `user_name` varchar(32) NOT NULL default '',
  `user_pwd` varchar(32) NOT NULL default '',
  `user_email` varchar(128) NOT NULL default '',
  `user_join_date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `[db_prefix]forum_user_activity` (
  `user` varchar(32) NOT NULL default '',
  `act_current` int(11) NOT NULL default '0',
  `act_last` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `[db_prefix]forum_user_stat` (
  `user` varchar(32) NOT NULL default '',
  `posts` int(11) NOT NULL default '0',
  `user_last_post` int(11) NOT NULL default '0',
  KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `[db_prefix]forum_vote` (
  `user_name` varchar(32) NOT NULL default '',
  `post_id` int(11) NOT NULL default '0',
  `vote_when` int(11) NOT NULL default '0',
  `vote_point` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`user_name`,`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `[db_prefix]forum_actions_log` (
  `user_name` varchar(32) NOT NULL default '',
  `id` int(11) NOT NULL default '0',
  `action_name` varchar(32) NOT NULL default '',
  `action_when` int(11) NOT NULL default '0',
  KEY `action_when` (`action_when`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `[db_prefix]forum_attachments` (
  `att_hash` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `att_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `att_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `att_when` int(11) NOT NULL,
  `att_size` int(11) NOT NULL,
  `att_downloads` int(11) NOT NULL,
  PRIMARY KEY (`att_hash`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `[db_prefix]forum_signatures` (
  `user` varchar(32) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `when` int(11) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- page compose pages
SET @iMaxOrder = (SELECT `Order` FROM `sys_page_compose_pages` ORDER BY `Order` DESC LIMIT 1);
INSERT INTO `sys_page_compose_pages` (`Name`, `Title`, `Order`) VALUES ('bx_matches_view', 'Match View', @iMaxOrder+1);
INSERT INTO `sys_page_compose_pages` (`Name`, `Title`, `Order`) VALUES ('bx_matches_celendar', 'Matches Calendar', @iMaxOrder+2);
INSERT INTO `sys_page_compose_pages` (`Name`, `Title`, `Order`) VALUES ('bx_matches_main', 'Matches Home', @iMaxOrder+3);
INSERT INTO `sys_page_compose_pages` (`Name`, `Title`, `Order`) VALUES ('bx_matches_my', 'Matches My', @iMaxOrder+4);

-- page compose blocks
INSERT INTO `sys_page_compose` (`Page`, `PageWidth`, `Desc`, `Caption`, `Column`, `Order`, `Func`, `Content`, `DesignBox`, `ColWidth`, `Visible`, `MinWidth`) VALUES 
    ('bx_matches_view', '1140px', 'Match''s info block', '_bx_matches_block_info', 2, 0, 'Info', '', '1', 28.1, 'non,memb', '0'),
    ('bx_matches_view', '1140px', 'Match''s actions block', '_bx_matches_block_actions', 2, 1, 'Actions', '', '1', 28.1, 'non,memb', '0'),    
    ('bx_matches_view', '1140px', 'Match''s rate block', '_bx_matches_block_rate', 2, 2, 'Rate', '', '1', 28.1, 'non,memb', '0'),    
    ('bx_matches_view', '1140px', 'Match''s social sharing block', '_sys_block_title_social_sharing', 2, 3, 'SocialSharing', '', 1, 28.1, 'non,memb', 0),
    ('bx_matches_view', '1140px', 'Match''s fans block', '_bx_matches_block_fans', 2, 4, 'Fans', '', '1', 28.1, 'non,memb', '0'),    
    ('bx_matches_view', '1140px', 'Match''s unconfirmed fans block', '_bx_matches_block_fans_unconfirmed', 2, 5, 'FansUnconfirmed', '', '1', 28.1, 'memb', '0'),
    ('bx_matches_view', '1140px', 'Match''s Location', '_Location', 2, 6, 'PHP', 'return BxDolService::call(''wmap'', ''location_block'', array(''matches'', $this->aDataEntry[$this->_oDb->_sFieldId]));', 1, 28.1, 'non,memb', 0),
    ('bx_matches_view', '1140px', 'Match''s description block', '_bx_matches_block_desc', 1, 0, 'Desc', '', '1', 71.9, 'non,memb', '0'),
    ('bx_matches_view', '1140px', 'Match''s photo block', '_bx_matches_block_photo', 1, 1, 'Photo', '', '1', 71.9, 'non,memb', '0'),
    ('bx_matches_view', '1140px', 'Match''s videos block', '_bx_matches_block_video', 1, 2, 'Video', '', '1', 71.9, 'non,memb', '0'),    
    ('bx_matches_view', '1140px', 'Match''s sounds block', '_bx_matches_block_sound', 1, 3, 'Sound', '', '1', 71.9, 'non,memb', '0'),    
    ('bx_matches_view', '1140px', 'Match''s files block', '_bx_matches_block_files', 1, 4, 'Files', '', '1', 71.9, 'non,memb', '0'),    
    ('bx_matches_view', '1140px', 'Match''s comments block', '_bx_matches_block_comments', 1, 5, 'Comments', '', '1', 71.9, 'non,memb', '0'),
    ('bx_matches_view', '1140px', 'Match''s forum feed', '_sys_block_title_forum_feed', 1, 6, 'ForumFeed', '', '1', 71.9, 'non,memb', '0'),

    ('bx_matches_main', '1140px', 'Latest Featured Match', '_bx_matches_block_latest_featured_match', '1', '0', 'LatestFeaturedMatch', '', '1', '71.9', 'non,memb', '0'),
    ('bx_matches_main', '1140px', 'Recent Matches', '_bx_matches_block_recent', '1', '1', 'Recent', '', '1', '71.9', 'non,memb', '0'),
    ('bx_matches_main', '1140px', 'Map', '_Map', '1', '2', 'PHP', 'return BxDolService::call(''wmap'', ''homepage_part_block'', array (''matches''));', 1, 71.9, 'non,memb', 0),
    ('bx_matches_main', '1140px', 'Matches Categories', '_bx_matches_block_categories', '2', '0', 'Categories', '', '1', '28.1', 'non,memb', '0'),

    ('bx_matches_my', '1140px', 'Administration Owner', '_bx_matches_block_administration_owner', '1', '0', 'Owner', '', '1', '100', 'non,memb', '0'),
    ('bx_matches_my', '1140px', 'User''s matches', '_bx_matches_block_users_matches', '1', '1', 'Browse', '', '0', '100', 'non,memb', '0'),

    ('index', '1140px', 'Matches', '_bx_matches_block_homepage', 0, 0, 'PHP', 'bx_import(''BxDolService''); return BxDolService::call(''matches'', ''homepage_block'');', 1, 71.9, 'non,memb', 0),
	('profile', '1140px', 'Joined Matches', '_bx_matches_block_my_matches_joined', 0, 0, 'PHP', 'bx_import(''BxDolService''); return BxDolService::call(''matches'', ''profile_block_joined'', array($this->oProfileGen->_iProfileID));', 1, 71.9, 'non,memb', 0),
    ('profile', '1140px', 'User Matches', '_bx_matches_block_my_matches', 0, 0, 'PHP', 'bx_import(''BxDolService''); return BxDolService::call(''matches'', ''profile_block'', array($this->oProfileGen->_iProfileID));', 1, 71.9, 'non,memb', 0),
    ('member', '1140px', 'Joined Matches', '_bx_matches_block_my_matches_joined', 0, 0, 'PHP', 'bx_import(''BxDolService''); return BxDolService::call(''matches'', ''profile_block_joined'', array($this->oProfileGen->_iProfileID));', 1, 71.9, 'non,memb', 0);

-- permalinkU
INSERT INTO `sys_permalinks` VALUES (NULL, 'modules/?r=matches/', 'm/matches/', 'bx_matches_permalinks');

-- settings
SET @iMaxOrder = (SELECT `menu_order` + 1 FROM `sys_options_cats` ORDER BY `menu_order` DESC LIMIT 1);
INSERT INTO `sys_options_cats` (`name`, `menu_order`) VALUES ('Matches', @iMaxOrder);
SET @iCategId = (SELECT LAST_INSERT_ID());
INSERT INTO `sys_options` (`Name`, `VALUE`, `kateg`, `desc`, `Type`, `check`, `err_text`, `order_in_kateg`, `AvailableValues`) VALUES
('bx_matches_permalinks', 'on', 26, 'Enable friendly permalinks in matches', 'checkbox', '', '', '0', ''),
('bx_matches_autoapproval', 'on', @iCategId, 'Activate all matches after creation automatically', 'checkbox', '', '', '0', ''),
('bx_matches_author_comments_admin', 'on', @iCategId, 'Allow match admin to edit and delete any comment', 'checkbox', '', '', '0', ''),
('bx_matches_max_email_invitations', '10', @iCategId, 'Max number of email invitation to send per one invite', 'digit', '', '', '0', ''),
('category_auto_app_bx_matches', 'on', @iCategId, 'Activate all categories after creation automatically', 'checkbox', '', '', '0', ''),
('bx_matches_perpage_view_fans', '6', @iCategId, 'Number of fans to show on match view page', 'digit', '', '', '0', ''),
('bx_matches_perpage_browse_fans', '30', @iCategId, 'Number of fans to show on browse fans page', 'digit', '', '', '0', ''),
('bx_matches_perpage_main_recent', '10', @iCategId, 'Number of recently added MATCHES to show on matches home', 'digit', '', '', '0', ''),
('bx_matches_perpage_browse', '14', @iCategId, 'Number of matches to show on browse pages', 'digit', '', '', '0', ''),
('bx_matches_perpage_profile', '4', @iCategId, 'Number of matches to show on profile page', 'digit', '', '', '0', ''),
('bx_matches_perpage_homepage', '5', @iCategId, 'Number of matches to show on homepage', 'digit', '', '', '0', ''),
('bx_matches_homepage_default_tab', 'featured', @iCategId, 'Default matches block tab on homepage', 'select', '', '', '0', 'featured,recent,top,popular'),
('bx_matches_max_rss_num', '10', @iCategId, 'Max number of rss items to provide', 'digit', '', '', '0', '');

-- search objects
INSERT INTO `sys_objects_search` VALUES(NULL, 'bx_matches', '_bx_matches', 'BxMatchSearchResult', 'modules/boonex/matches/classes/BxMatchSearchResult.php');

-- vote objects
INSERT INTO `sys_objects_vote` VALUES (NULL, 'bx_matches', '[db_prefix]rating', '[db_prefix]rating_track', 'gal_', '5', 'vote_send_result', 'BX_PERIOD_PER_VOTE', '1', '', '', '[db_prefix]main', 'rate', 'rate_count', 'id', 'BxMatchVoting', 'modules/boonex/matches/classes/BxMatchVoting.php');

-- comments objects
INSERT INTO `sys_objects_cmts` VALUES (NULL, 'bx_matches', '[db_prefix]cmts', '[db_prefix]cmts_track', '0', '1', '90', '5', '1', '-3', 'none', '0', '1', '0', 'cmt', '[db_prefix]main', 'id', 'comments_count', 'BxMatchCmts', 'modules/boonex/matches/classes/BxMatchCmts.php');

-- views objects
INSERT INTO `sys_objects_views` VALUES(NULL, 'bx_matches', '[db_prefix]views_track', 86400, '[db_prefix]main', 'id', 'views', 1);

-- tag objects
INSERT INTO `sys_objects_tag` VALUES (NULL, 'bx_matches', 'SELECT `Tags` FROM `[db_prefix]main` WHERE `id` = {iID} AND `status` = ''approved''', 'bx_matches_permalinks', 'm/matches/browse/tag/{tag}', 'modules/?r=matches/browse/tag/{tag}', '_bx_matches');

-- category objects
INSERT INTO `sys_objects_categories` VALUES (NULL, 'bx_matches', 'SELECT `Categories` FROM `[db_prefix]main` WHERE `id` = {iID} AND `status` = ''approved''', 'bx_matches_permalinks', 'm/matches/browse/category/{tag}', 'modules/?r=matches/browse/category/{tag}', '_bx_matches');

INSERT INTO `sys_categories` (`Category`, `ID`, `Type`, `Owner`, `Status`) VALUES 
('Matches', '0', 'bx_photos', '0', 'active'),
('Arts & Literature', '0', 'bx_matches', '0', 'active'),
('Animals & Pets', '0', 'bx_matches', '0', 'active'),
('Activities', '0', 'bx_matches', '0', 'active'),
('Automotive', '0', 'bx_matches', '0', 'active'),
('Business & Money', '0', 'bx_matches', '0', 'active'),
('Companies & Co-workers', '0', 'bx_matches', '0', 'active'),
('Cultures & Nations', '0', 'bx_matches', '0', 'active'),
('Dolphin Community', '0', 'bx_matches', '0', 'active'),
('Family & Friends', '0', 'bx_matches', '0', 'active'),
('Fan Clubs', '0', 'bx_matches', '0', 'active'),
('Fashion & Style', '0', 'bx_matches', '0', 'active'),
('Fitness & Body Building', '0', 'bx_matches', '0', 'active'),
('Food & Drink', '0', 'bx_matches', '0', 'active'),
('Gay, Lesbian & Bi', '0', 'bx_matches', '0', 'active'),
('Health & Wellness', '0', 'bx_matches', '0', 'active'),
('Hobbies & Entertainment', '0', 'bx_matches', '0', 'active'),
('Internet & Computers', '0', 'bx_matches', '0', 'active'),
('Love & Relationships', '0', 'bx_matches', '0', 'active'),
('Mass Media', '0', 'bx_matches', '0', 'active'),
('Music & Cinema', '0', 'bx_matches', '0', 'active'),
('Places & Travel', '0', 'bx_matches', '0', 'active'),
('Politics', '0', 'bx_matches', '0', 'active'),
('Recreation & Sports', '0', 'bx_matches', '0', 'active'),
('Religion', '0', 'bx_matches', '0', 'active'),
('Science & Innovations', '0', 'bx_matches', '0', 'active'),
('Sex', '0', 'bx_matches', '0', 'active'),
('Teens & Schools', '0', 'bx_matches', '0', 'active'),
('Other', '0', 'bx_matches', '0', 'active');

-- users actions
INSERT INTO `sys_objects_actions` (`Caption`, `Icon`, `Url`, `Script`, `Eval`, `Order`, `Type`) VALUES 
    ('{TitleEdit}', 'edit', '{evalResult}', '', '$oConfig = $GLOBALS[''oBxMatchModule'']->_oConfig; return  BX_DOL_URL_ROOT . $oConfig->getBaseUri() . ''edit/{ID}'';', '0', 'bx_matches'),
    ('{TitleDelete}', 'remove', '', 'getHtmlData( ''ajaxy_popup_result_div_{ID}'', ''{evalResult}'', false, ''post'', true); return false;', '$oConfig = $GLOBALS[''oBxMatchModule'']->_oConfig; return  BX_DOL_URL_ROOT . $oConfig->getBaseUri() . ''delete/{ID}'';', 1, 'bx_matches'),
    ('{TitleShare}', 'share', '', 'showPopupAnyHtml (''{BaseUri}share_popup/{ID}'');', '', '2', 'bx_matches'),
    ('{TitleBroadcast}', 'envelope', '{BaseUri}broadcast/{ID}', '', '', '3', 'bx_matches'),
    ('{TitleJoin}', '{IconJoin}', '', 'getHtmlData( ''ajaxy_popup_result_div_{ID}'', ''{evalResult}'', false, ''post'');return false;', '$oConfig = $GLOBALS[''oBxMatchModule'']->_oConfig; return BX_DOL_URL_ROOT . $oConfig->getBaseUri() . ''join/{ID}/{iViewer}'';', '4', 'bx_matches'),
    ('{TitleInvite}', 'plus-sign', '{evalResult}', '', '$oConfig = $GLOBALS[''oBxMatchModule'']->_oConfig; return BX_DOL_URL_ROOT . $oConfig->getBaseUri() . ''invite/{ID}'';', '5', 'bx_matches'),
    ('{AddToFeatured}', 'star-empty', '', 'getHtmlData( ''ajaxy_popup_result_div_{ID}'', ''{evalResult}'', false, ''post'');return false;', '$oConfig = $GLOBALS[''oBxMatchModule'']->_oConfig; return BX_DOL_URL_ROOT . $oConfig->getBaseUri() . ''mark_featured/{ID}'';', '6', 'bx_matches'),
    ('{TitleManageFans}', 'match', '', 'showPopupAnyHtml (''{BaseUri}manage_fans_popup/{ID}'');', '', '8', 'bx_matches'),
    ('{TitleUploadPhotos}', 'picture', '{BaseUri}upload_photos/{URI}', '', '', '9', 'bx_matches'),
    ('{TitleUploadVideos}', 'film', '{BaseUri}upload_videos/{URI}', '', '', '10', 'bx_matches'),
    ('{TitleUploadSounds}', 'music', '{BaseUri}upload_sounds/{URI}', '', '', '11', 'bx_matches'),
    ('{TitleUploadFiles}', 'save', '{BaseUri}upload_files/{URI}', '', '', '12', 'bx_matches'),
    ('{TitleSubscribe}', 'paper-clip', '', '{ScriptSubscribe}', '', '13', 'bx_matches'),
    ('{evalResult}', 'plus', '{BaseUri}browse/my&bx_matches_filter=add_match', '', 'return ($GLOBALS[''logged''][''member''] && BxDolModule::getInstance(''BxMatchModule'')->isAllowedAdd()) || $GLOBALS[''logged''][''admin''] ? _t(''_bx_matches_action_add_match'') : '''';', 1, 'bx_matches_title'),
    ('{evalResult}', 'match', '{BaseUri}browse/my', '', 'return $GLOBALS[''logged''][''member''] || $GLOBALS[''logged''][''admin''] ? _t(''_bx_matches_action_my_matches'') : '''';', '2', 'bx_matches_title');
    
-- top menu 
INSERT INTO `sys_menu_top`(`ID`, `Parent`, `Name`, `Caption`, `Link`, `Order`, `Visible`, `Target`, `Onclick`, `Check`, `Editable`, `Deletable`, `Active`, `Type`, `Picture`, `Icon`, `BQuickLink`, `Statistics`) VALUES
(NULL, 0, 'Matches', '_bx_matches_menu_root', 'modules/?r=matches/view/|modules/?r=matches/broadcast/|modules/?r=matches/invite/|modules/?r=matches/edit/|forum/matches/', '', 'non,memb', '', '', '', 1, 1, 1, 'system', 'match', '', '0', '');
SET @iCatRoot := LAST_INSERT_ID();
INSERT INTO `sys_menu_top`(`ID`, `Parent`, `Name`, `Caption`, `Link`, `Order`, `Visible`, `Target`, `Onclick`, `Check`, `Editable`, `Deletable`, `Active`, `Type`, `Picture`, `Icon`, `BQuickLink`, `Statistics`) VALUES
(NULL, @iCatRoot, 'Match View', '_bx_matches_menu_view_match', 'modules/?r=matches/view/{bx_matches_view_uri}', 0, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, ''),
(NULL, @iCatRoot, 'Match View Forum', '_bx_matches_menu_view_forum', 'forum/matches/forum/{bx_matches_view_uri}-0.htm|forum/matches/', 1, 'non,memb', '', '', '$oModuleDb = new BxDolModuleDb(); return $oModuleDb->getModuleByUri(''forum'') ? true : false;', 1, 1, 1, 'custom', '', '', 0, ''),
(NULL, @iCatRoot, 'Match View Fans', '_bx_matches_menu_view_fans', 'modules/?r=matches/browse_fans/{bx_matches_view_uri}', 2, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, ''),
(NULL, @iCatRoot, 'Match View Comments', '_bx_matches_menu_view_comments', 'modules/?r=matches/comments/{bx_matches_view_uri}', 3, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, '');


SET @iMaxMenuOrder := (SELECT `Order` + 1 FROM `sys_menu_top` WHERE `Parent` = 0 ORDER BY `Order` DESC LIMIT 1);
INSERT INTO `sys_menu_top`(`ID`, `Parent`, `Name`, `Caption`, `Link`, `Order`, `Visible`, `Target`, `Onclick`, `Check`, `Editable`, `Deletable`, `Active`, `Type`, `Picture`, `Icon`, `BQuickLink`, `Statistics`) VALUES
(NULL, 0, 'Matches', '_bx_matches_menu_root', 'modules/?r=matches/home/|modules/?r=matches/', @iMaxMenuOrder, 'non,memb', '', '', '', 1, 1, 1, 'top', 'match', 'match', 1, '');
SET @iCatRoot := LAST_INSERT_ID();
INSERT INTO `sys_menu_top`(`ID`, `Parent`, `Name`, `Caption`, `Link`, `Order`, `Visible`, `Target`, `Onclick`, `Check`, `Editable`, `Deletable`, `Active`, `Type`, `Picture`, `Icon`, `BQuickLink`, `Statistics`) VALUES
(NULL, @iCatRoot, 'Matches Main Page', '_bx_matches_menu_main', 'modules/?r=matches/home/', 0, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, ''),
(NULL, @iCatRoot, 'Recent Matches', '_bx_matches_menu_recent', 'modules/?r=matches/browse/recent', 2, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, ''),
(NULL, @iCatRoot, 'Top Rated Matches', '_bx_matches_menu_top_rated', 'modules/?r=matches/browse/top', 3, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, ''),
(NULL, @iCatRoot, 'Popular Matches', '_bx_matches_menu_popular', 'modules/?r=matches/browse/popular', 4, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, ''),
(NULL, @iCatRoot, 'Featured Matches', '_bx_matches_menu_featured', 'modules/?r=matches/browse/featured', 5, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, ''),
(NULL, @iCatRoot, 'Matches Tags', '_bx_matches_menu_tags', 'modules/?r=matches/tags', 8, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, 'bx_matches'),
(NULL, @iCatRoot, 'Matches Categories', '_bx_matches_menu_categories', 'modules/?r=matches/categories', 9, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, 'bx_matches'),
(NULL, @iCatRoot, 'Calendar', '_bx_matches_menu_calendar', 'modules/?r=matches/calendar', 10, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, ''),
(NULL, @iCatRoot, 'Search', '_bx_matches_menu_search', 'modules/?r=matches/search', 11, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, '');

SET @iCatProfileOrder := (SELECT MAX(`Order`)+1 FROM `sys_menu_top` WHERE `Parent` = 9 ORDER BY `Order` DESC LIMIT 1);
INSERT INTO `sys_menu_top`(`ID`, `Parent`, `Name`, `Caption`, `Link`, `Order`, `Visible`, `Target`, `Onclick`, `Check`, `Editable`, `Deletable`, `Active`, `Type`, `Picture`, `Icon`, `BQuickLink`, `Statistics`) VALUES
(NULL, 9, 'Matches', '_bx_matches_menu_my_matches_profile', 'modules/?r=matches/browse/user/{profileUsername}|modules/?r=matches/browse/joined/{profileUsername}', @iCatProfileOrder, 'non,memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, '');
SET @iCatProfileOrder := (SELECT MAX(`Order`)+1 FROM `sys_menu_top` WHERE `Parent` = 4 ORDER BY `Order` DESC LIMIT 1);
INSERT INTO `sys_menu_top`(`ID`, `Parent`, `Name`, `Caption`, `Link`, `Order`, `Visible`, `Target`, `Onclick`, `Check`, `Editable`, `Deletable`, `Active`, `Type`, `Picture`, `Icon`, `BQuickLink`, `Statistics`) VALUES
(NULL, 4, 'Matches', '_bx_matches_menu_my_matches_profile', 'modules/?r=matches/browse/my', @iCatProfileOrder, 'memb', '', '', '', 1, 1, 1, 'custom', '', '', 0, '');

-- member menu
SET @iMemberMenuParent = (SELECT `ID` FROM `sys_menu_member` WHERE `Name` = 'AddContent');
SET @iMemberMenuOrder = (SELECT MAX(`Order`) + 1 FROM `sys_menu_member` WHERE `Parent` = IFNULL(@iMemberMenuParent, -1));
INSERT INTO `sys_menu_member` SET `Name` = 'bx_matches', `Eval` = 'return BxDolService::call(''matches'', ''get_member_menu_item_add_content'');', `Type` = 'linked_item', `Parent` = IFNULL(@iMemberMenuParent, 0), `Order` = IFNULL(@iMemberMenuOrder, 1);

-- admin menu
SET @iMax = (SELECT MAX(`order`) FROM `sys_menu_admin` WHERE `parent_id` = '2');
INSERT IGNORE INTO `sys_menu_admin` (`parent_id`, `name`, `title`, `url`, `description`, `icon`, `order`) VALUES
(2, 'bx_matches', '_bx_matches', '{siteUrl}modules/?r=matches/administration/', 'Matches module by BoonEx','match', @iMax+1);

-- site stats
SET @iStatSiteOrder := (SELECT `StatOrder` + 1 FROM `sys_stat_site` WHERE 1 ORDER BY `StatOrder` DESC LIMIT 1);
INSERT INTO `sys_stat_site` VALUES(NULL, 'bx_matches', 'bx_matches', 'modules/?r=matches/browse/recent', 'SELECT COUNT(`id`) FROM `[db_prefix]main` WHERE `status`=''approved''', 'modules/?r=matches/administration', 'SELECT COUNT(`id`) FROM `[db_prefix]main` WHERE `status`=''pending''', 'match', @iStatSiteOrder);

-- PQ statistics
INSERT INTO `sys_stat_member` VALUES ('bx_matches', 'SELECT COUNT(*) FROM `[db_prefix]main` WHERE `author_id` = ''__member_id__'' AND `status`=''approved''');
INSERT INTO `sys_stat_member` VALUES ('bx_matchesp', 'SELECT COUNT(*) FROM `[db_prefix]main` WHERE `author_id` = ''__member_id__'' AND `Status`!=''approved''');
INSERT INTO `sys_account_custom_stat_elements` VALUES(NULL, '_bx_matches', '__bx_matches__ (<a href="modules/?r=matches/browse/my&bx_matches_filter=add_match">__l_add__</a>)');

-- email templates
INSERT INTO `sys_email_templates` (`Name`, `Subject`, `Body`, `Desc`, `LangID`) VALUES 
('bx_matches_broadcast', '<BroadcastTitle>', '<bx_include_auto:_email_header.html />\r\n\r\n<p>Hello <NickName>,</p> \r\n<p>Message from <a href="<EntryUrl>"><EntryTitle></a> match admin:</p> <pre><hr><BroadcastMessage></pre> <hr> \r\n\r\n<bx_include_auto:_email_footer.html />', 'Matches broadcast message', 0),

('bx_matches_join_request', 'Request To Join Your Match', '<bx_include_auto:_email_header.html />\r\n\r\n<p>Hello <NickName>,</p> \r\n\r\n<p>New request to join your match: <a href="<EntryUrl>"><EntryTitle></a>.</p> \r\n\r\n<bx_include_auto:_email_footer.html />', 'Join request to a match', 0),

('bx_matches_join_reject', 'Request To Join A Match Was Rejected', '<bx_include_auto:_email_header.html />\r\n\r\n <p>Hello <NickName>,</p> <p>Your request to join <a href="<EntryUrl>"><EntryTitle></a> match was rejected by match admin.</p> \r\n<bx_include_auto:_email_footer.html />', 'Join match request was rejected', 0),

('bx_matches_join_confirm', 'Your Request To Join A Match Was Confirmed', '<bx_include_auto:_email_header.html />\r\n\r\n<p>Hello <NickName>,</p> \r\n<p>Your request to join <a href="<EntryUrl>"><EntryTitle></a> match was confirmed by the match admin.</p> \r\n\r\n<bx_include_auto:_email_footer.html />', 'Join match request confirmed', 0),

('bx_matches_fan_remove', 'Your Profile Removed From Match Fans', '<bx_include_auto:_email_header.html /> \r\n\r\n<p>Hello <NickName>,</p> <p>Your profile was removed fans list of <a href="<EntryUrl>"><EntryTitle></a> match by the match admin.</p> \r\n\r\n<bx_include_auto:_email_footer.html />', 'Profile Removed From Match Fans', 0),

('bx_matches_fan_become_admin', 'You Are A Match Admin Now', '<bx_include_auto:_email_header.html />\r\n\r\n<p>Hello <NickName>,</p> \r\n\r\n<p>You are an admin of <a href="<EntryUrl>"><EntryTitle></a> match now.</p>\r\n\r\n<bx_include_auto:_email_footer.html />', 'Match admin status granted', 0),

('bx_matches_admin_become_fan', 'Your Match Admin Status Was Revoked', '<bx_include_auto:_email_header.html />\r\n\r\n<p>Hello <NickName>,</p> \r\n\r\n<p>Your admin status was revoked from <a href="<EntryUrl>"><EntryTitle></a> match by the match creator.</p> \r\n\r\n<bx_include_auto:_email_footer.html />', 'Match admin status revoked', 0),

('bx_matches_invitation', 'Invitation to <MatchName> Match', '<bx_include_auto:_email_header.html />\r\n\r\n<p>Hello <NickName>,</p> \r\n\r\n<p><a href="<InviterUrl>"><InviterNickName></a> invited you to <a href="<MatchUrl>"><MatchName> match</a>.</p> \r\n\r\n<p>\r\n<hr><InvitationText><hr> \r\n</p>\r\n\r\n<bx_include_auto:_email_footer.html />', 'Invitation to match', 0),

('bx_matches_sbs', 'Subscription: Match Details Changed', '<bx_include_auto:_email_header.html />\r\n\r\n<p>Hello <NickName>,</p> \r\n\r\n<p><a href="<ViewLink>"><EntryTitle></a> match details changed: <br /> <ActionName> </p> \r\n<hr>\r\n<p>Cancel this subscription: <a href="<UnsubscribeLink>"><UnsubscribeLink></a></p>\r\n\r\n<bx_include_auto:_email_footer.html />', 'Subscription: match changes', 0);


-- membership actions
SET @iLevelNonMember := 1;
SET @iLevelStandard := 2;
SET @iLevelPromotion := 3;

INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches view match', NULL);
SET @iAction := LAST_INSERT_ID();
INSERT INTO `sys_acl_matrix` (`IDLevel`, `IDAction`) VALUES 
    (@iLevelNonMember, @iAction), (@iLevelStandard, @iAction), (@iLevelPromotion, @iAction);

INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches browse', NULL);
SET @iAction := LAST_INSERT_ID();
INSERT INTO `sys_acl_matrix` (`IDLevel`, `IDAction`) VALUES 
    (@iLevelNonMember, @iAction), (@iLevelStandard, @iAction), (@iLevelPromotion, @iAction);

INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches search', NULL);
SET @iAction := LAST_INSERT_ID();
INSERT INTO `sys_acl_matrix` (`IDLevel`, `IDAction`) VALUES 
    (@iLevelNonMember, @iAction), (@iLevelStandard, @iAction), (@iLevelPromotion, @iAction);

INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches add match', NULL);
SET @iAction := LAST_INSERT_ID();
INSERT INTO `sys_acl_matrix` (`IDLevel`, `IDAction`) VALUES 
    (@iLevelStandard, @iAction), (@iLevelPromotion, @iAction);

INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches comments delete and edit', NULL);
INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches edit any match', NULL);
INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches delete any match', NULL);
INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches mark as featured', NULL);
INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches approve matches', NULL);
INSERT INTO `sys_acl_actions` VALUES (NULL, 'matches broadcast message', NULL);

-- alert handlers
INSERT INTO `sys_alerts_handlers` VALUES (NULL, 'bx_matches_profile_delete', '', '', 'BxDolService::call(''matches'', ''response_profile_delete'', array($this));');
SET @iHandler := LAST_INSERT_ID();
INSERT INTO `sys_alerts` VALUES (NULL , 'profile', 'delete', @iHandler);

INSERT INTO `sys_alerts_handlers` VALUES (NULL, 'bx_matches_media_delete', '', '', 'BxDolService::call(''matches'', ''response_media_delete'', array($this));');
SET @iHandler := LAST_INSERT_ID();
INSERT INTO `sys_alerts` VALUES (NULL , 'bx_photos', 'delete', @iHandler);
INSERT INTO `sys_alerts` VALUES (NULL , 'bx_videos', 'delete', @iHandler);
INSERT INTO `sys_alerts` VALUES (NULL , 'bx_sounds', 'delete', @iHandler);
INSERT INTO `sys_alerts` VALUES (NULL , 'bx_files', 'delete', @iHandler);

INSERT INTO `sys_alerts_handlers` VALUES (NULL, 'bx_matches_map_install', '', '', 'if (''wmap'' == $this->aExtras[''uri''] && $this->aExtras[''res''][''result'']) BxDolService::call(''matches'', ''map_install'');');
SET @iHandler := LAST_INSERT_ID();
INSERT INTO `sys_alerts` VALUES (NULL , 'module', 'install', @iHandler);

-- privacy
INSERT INTO `sys_privacy_actions` (`module_uri`, `name`, `title`, `default_group`) VALUES
('matches', 'view_match', '_bx_matches_privacy_view_match', '3'),
('matches', 'view_fans', '_bx_matches_privacy_view_fans', '3'),
('matches', 'comment', '_bx_matches_privacy_comment', 'f'),
('matches', 'rate', '_bx_matches_privacy_rate', 'f'),
('matches', 'post_in_forum', '_bx_matches_privacy_post_in_forum', 'f'),
('matches', 'join', '_bx_matches_privacy_join', '3'),
('matches', 'upload_photos', '_bx_matches_privacy_upload_photos', 'a'),
('matches', 'upload_videos', '_bx_matches_privacy_upload_videos', 'a'),
('matches', 'upload_sounds', '_bx_matches_privacy_upload_sounds', 'a'),
('matches', 'upload_files', '_bx_matches_privacy_upload_files', 'a');

-- subscriptions
INSERT INTO `sys_sbs_types` (`unit`, `action`, `template`, `params`) VALUES
('bx_matches', '', '', 'return BxDolService::call(''matches'', ''get_subscription_params'', array($arg2, $arg3));'),
('bx_matches', 'change', 'bx_matches_sbs', 'return BxDolService::call(''matches'', ''get_subscription_params'', array($arg2, $arg3));'),
('bx_matches', 'commentPost', 'bx_matches_sbs', 'return BxDolService::call(''matches'', ''get_subscription_params'', array($arg2, $arg3));'),
('bx_matches', 'join', 'bx_matches_sbs', 'return BxDolService::call(''matches'', ''get_subscription_params'', array($arg2, $arg3));');

-- sitemap
SET @iMaxOrderSiteMaps = (SELECT MAX(`order`)+1 FROM `sys_objects_site_maps`);
INSERT INTO `sys_objects_site_maps` (`object`, `title`, `priority`, `changefreq`, `class_name`, `class_file`, `order`, `active`) VALUES
('bx_matches', '_bx_matches', '0.8', 'auto', 'BxMatchSiteMaps', 'modules/boonex/matches/classes/BxMatchSiteMaps.php', @iMaxOrderSiteMaps, 1);

-- chart
SET @iMaxOrderCharts = (SELECT MAX(`order`)+1 FROM `sys_objects_charts`);
INSERT INTO `sys_objects_charts` (`object`, `title`, `table`, `field_date_ts`, `field_date_dt`, `query`, `active`, `order`) VALUES
('bx_matches', '_bx_matches', 'bx_matches_main', 'created', '', '', 1, @iMaxOrderCharts);

