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
			
				$type = $aDataEntry['type'];
				$pitch_type = $aDataEntry['pitch_type'];
				$indoor_type = $aDataEntry['indoor'];
				
				$ball_hire = $aDataEntry['ballhire'];
				if($ball_hire==1) {
				$ball_hire_icon_url = $this->oMain->getIconFromText('Ball-hire');
				$ball_hire_icon = '<img src="'.$ball_hire_icon_url.'" alt="">';
				} else {
					$ball_hire_icon = '';
				}
				$ball_bump = $aDataEntry['ballbump'];
				if($ball_bump==1) {	
				$ball_bump_icon_url = $this->oMain->getIconFromText('Ball-pump');
				$ball_bump_icon = '<img  src="'.$ball_bump_icon_url.'" alt="">';
				} else {
					$ball_bump_icon = '';
				}
				$netted = $aDataEntry['netted'];
				if($netted==1) {	
				$netted_icon_url = $this->oMain->getIconFromText('Netted');
				$netted_icon = '<img src="'.$netted_icon_url.'" alt="">';
				} else {
					$netted_icon = '';
				}
				$with_lines = $aDataEntry['withlines'];
				if($with_lines==1) {	
				$with_lines_url = $this->oMain->getIconFromText('With');
				$with_lines_icon = '<img src="'.$with_lines_url.'" alt="">';
				} else {
					$with_lines_icon = '';
				}
				$shop = $aDataEntry['shop'];
				if($shop==1) {	
				$shop_url = $this->oMain->getIconFromText('Shop');
				$shop_icon = '<img  src="'.$shop_url.'" alt="">';
				} else {
					$shop_icon = '';
				}
				$wc = $aDataEntry['WC'];
				if($wc==1) {	
				$wc_url = $this->oMain->getIconFromText('Toilets');
				$wc_icon = '<img src="'.$wc_url.'" alt="">';
				} else {
					$wc_icon = '';
				}
				$water = $aDataEntry['water'];
				if($water==1) {	
				$water_url = $this->oMain->getIconFromText('Water');
				$water_icon = '<img src="'.$water_url.'" alt="">';
				} else {
					$water_icon = '';
				}
				
				if($type ==0 ){
					$matchtype ='5aside';
				} elseif($type ==1) {
					
					$matchtype ='7aside';
					
				} elseif ($type ==2) {
					
					$matchtype ='11aside';
				}
				$matchtype = $this->oMain->getIconFromText($matchtype);
				if($pitch_type ==0 ){
					$pitchtype ='Real-grass';
				} elseif($pitch_type ==1) {
					
					$pitchtype ='Artificial';
					
				} elseif ($pitch_type ==2) {
					
					$pitchtype ='Hard-floor';
				} elseif ($pitch_type ==3) {
					
					$pitchtype ='Sand';
				} elseif ($pitch_type ==4) {
					
					$pitchtype ='';
				}
				if($pitchtype!='') {
				$pitchtype_url = $this->oMain->getIconFromText($pitchtype);
				$pitchtype_icon = '<img src="'.$pitchtype_url.'" alt="">';
				} else {
					$pitchtype_icon = '';
				}
				if($indoor_type ==0 ){
					$indoor ='Outdoor';
				} elseif($indoor_type ==1) {
					
					$indoor ='Indoor';
				}
				$indoor = $this->oMain->getIconFromText($indoor);	
				$playground_icon = $this->oMain->getIconFromText('Playground-Icon');
				$price_icon = $this->oMain->getIconFromText('Price-Icon');	
				if(!empty($aDataEntry['price_per_hour'])) {
					$price_per_hrs = '<img src="'.$price_icon.'" alt=""><b>='.$aDataEntry['price_per_hour'].'</b>';
				} else {
					$price_per_hrs = '';
				}
				if($aDataEntry['author_id']==1) {
					$status_url = $this->oMain->getIconFromText('Verified');	
					$status = '<img src="'.$status_url.'" alt="">'; 
				} else {
					
					$status = ''; 
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
					'created' => defineTimeInterval($aDataEntry['created'],true,true),
					'match_type' => $matchtype,
					'pitch_type' => $pitchtype_icon,
					'indoor' => $indoor,
					'price_per_hour' => $price_per_hrs,
					'author_unit' => $GLOBALS['oFunctions']->getMemberThumbnail($aAuthor['ID'], 'none', true),
					'location' => $sLocation,
					'pg_name' => $aDataEntry['title'],
					'pg_icon' => $playground_icon,
					'ball_hire' => $ball_hire_icon,
					'ball_bump' => $ball_bump_icon,
					'netted' => $netted_icon,
					'with_lines' => $with_lines_icon,
					'shop' => $shop_icon,
					'wc' => $wc_icon,
					'water' => $water_icon,
					'status' => $status,
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
