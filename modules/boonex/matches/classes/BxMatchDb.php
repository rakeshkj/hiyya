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
}
