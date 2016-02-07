<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolTwigPageMain');

class BxMatchPageMain extends BxDolTwigPageMain
{
    function BxMatchPageMain(&$oMain)
    {
        $this->sSearchResultClassName = 'BxMatchSearchResult';
        $this->sFilterName = 'bx_matches_filter';
        parent::BxDolTwigPageMain('bx_matches_main', $oMain);
    }

    function getBlockCode_LatestFeaturedMatch()
    {
        $aDataEntry = $this->oDb->getLatestFeaturedItem ();
        if (!$aDataEntry)   
            return false;

        $aAuthor = getProfileInfo($aDataEntry['author_id']);

        $sImageUrl = '';
        $sImageTitle = '';
        $a = array ('ID' => $aDataEntry['author_id'], 'Avatar' => $aDataEntry['thumb']);
        $aImage = BxDolService::call('photos', 'get_image', array($a, 'file'), 'Search');

        bx_matches_import('Voting');
        $oRating = new BxMatchVoting ('bx_matches', $aDataEntry['id']);

        $aVars = array (
            'bx_if:image' => array (
                'condition' => !$aImage['no_image'] && $aImage['file'],
                'content' => array (
                    'image_url' => !$aImage['no_image'] && $aImage['file'] ? $aImage['file'] : '',
                    'image_title' => !$aImage['no_image'] && $aImage['title'] ? $aImage['title'] : '',
                    'match_url' => BX_DOL_URL_ROOT . $this->oConfig->getBaseUri() . 'view/' . $aDataEntry['uri'],
                ),
            ),
            'match_url' => BX_DOL_URL_ROOT . $this->oConfig->getBaseUri() . 'view/' . $aDataEntry['uri'],
            'match_title' => $aDataEntry['title'],
            'author_title' => _t('_From'),
            'author_username' => getNickName($aAuthor['ID']),
            'author_url' => getProfileLink($aAuthor['ID']),
            'rating' => $oRating->isEnabled() ? $oRating->getJustVotingElement (true, $aDataEntry['id']) : '',
            'fans_count' => $aDataEntry['fans_count'],
            'country_city' => $this->oMain->_formatLocation($aDataEntry, false, true),
        );
        return $this->oTemplate->parseHtmlByName('latest_featured_match', $aVars);
    }
	function getBlockCode_PlaygroundListByUser()
    {
        $aDataEntrys = $this->oDb->getPalgroundListByUser();
        if (!$aDataEntrys)
            return false;
		$status = '';
        $aAuthor = getProfileInfo($aDataEntrys['author_id']);
		$sImage = '';
		foreach ($aDataEntrys as $aDataEntry) {
				if($aDataEntry['author_id']==1) {
				
				$status = "Verified"; 
				} else {
					
					$status = "Not Verified"; 
				}
				$a = array ('ID' => $aDataEntry['author_id'], 'Avatar' => $aDataEntry['thumb']);
				$aImage = BxDolService::call('photos', 'get_image', array($a, 'browse'), 'Search');
				$sImage = $aImage['file'] ? $aImage['file'] : 'modules/boonex/matches/templates/base/images/no-image-thumb.png';
			
			$playgroundDetails[] = array(
		          'image_playgrpund' => $sImage,
				  'palyground_url' => BX_DOL_URL_ROOT . $this->oConfig->getBaseUri() . 'pgview/' . $aDataEntry['uri'],
				  'palyground_title' => $aDataEntry['title'],
				  'author_title' => _t('_From'),
				  'author_username' => getNickName($aDataEntry['author_id']),
				  'author_url' => getProfileLink($aDataEntry['author_id']),
				  'pg_status' => $status,
				  'created' => defineTimeInterval($aDataEntry['created'],true,true)
			);
		}
		
        $aVars = array (
            'bx_repeat:playground' => $playgroundDetails
        );
        return $this->oTemplate->parseHtmlByName('palygroundlist', $aVars);
    }
    function getBlockCode_Recent()
    {
        return $this->ajaxBrowse('recent', $this->oDb->getParam('bx_matches_perpage_main_recent'));
    }
}
