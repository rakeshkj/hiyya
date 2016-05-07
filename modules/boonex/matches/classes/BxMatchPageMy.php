<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolPageView');

class BxMatchPageMy extends BxDolPageView
{
    var $_oMain;
    var $_oTemplate;
    var $_oDb;
    var $_oConfig;
    var $_aProfile;

    function BxMatchPageMy(&$oMain, &$aProfile)
    {
        $this->_oMain = &$oMain;
        $this->_oTemplate = $oMain->_oTemplate;
        $this->_oDb = $oMain->_oDb;
        $this->_oConfig = $oMain->_oConfig;
        $this->_aProfile = $aProfile;
		$this->_aModule = $oMain->_aModule;
        parent::BxDolPageView('bx_matches_my');
    }

    function getBlockCode_Owner()
    {
        if (!$this->_oMain->_iProfileId || !$this->_aProfile)
            return '';

        $sContent = '';
        switch (bx_get('bx_matches_filter')) {
        case 'add_match':
            $sContent = $this->getBlockCode_Add ();
            break;
		case 'add_playground':
            $sContent = $this->getBlockCode_playground ();
            break;	
        case 'manage_matches':
            $sContent = $this->getBlockCode_My ();
            break;
        case 'pending_matches':
            $sContent = $this->getBlockCode_Pending ();
            break;
        default:
            $sContent = $this->getBlockCode_Main ();
        }

        $sBaseUrl = BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . "browse/my";
        $aMenu = array(
            _t('_bx_matches_block_submenu_main') => array('href' => $sBaseUrl, 'active' => !bx_get('bx_matches_filter')),
            _t('_bx_matches_block_submenu_add_match') => array('href' => $sBaseUrl . '&bx_matches_filter=add_match', 'active' => 'add_match' == bx_get('bx_matches_filter')),
			_t('_bx_matches_block_submenu_add_playground') => array('href' => $sBaseUrl . '&bx_matches_filter=add_playground', 'active' => 'add_playground' == bx_get('bx_matches_filter')),
            _t('_bx_matches_block_submenu_manage_matches') => array('href' => $sBaseUrl . '&bx_matches_filter=manage_matches', 'active' => 'manage_matches' == bx_get('bx_matches_filter')),
            _t('_bx_matches_block_submenu_pending_matches') => array('href' => $sBaseUrl . '&bx_matches_filter=pending_matches', 'active' => 'pending_matches' == bx_get('bx_matches_filter')),
        );
        return array($sContent, $aMenu, '', '');
    }

    function getBlockCode_Browse()
    {
        bx_matches_import ('SearchResult');
        $o = new BxMatchSearchResult('user', process_db_input ($this->_aProfile['NickName'], BX_TAGS_NO_ACTION, BX_SLASHES_NO_ACTION));
        $o->aCurrent['rss'] = 0;

        $o->sBrowseUrl = "browse/my";
        $o->aCurrent['title'] = _t('_bx_matches_page_title_my_matches');

        if ($o->isError) {
            return DesignBoxContent(_t('_bx_matches_block_users_matches'), MsgBox(_t('_Empty')), 1);
        }

        if ($s = $o->processing()) {
            $this->_oTemplate->addCss (array('unit.css', 'twig.css', 'main.css'));
            return $s;
        } else {
            return DesignBoxContent(_t('_bx_matches_block_users_matches'), MsgBox(_t('_Empty')), 1);
        }
    }

    function getBlockCode_Main()
    {
        $iActive = $this->_oDb->getCountByAuthorAndStatus($this->_aProfile['ID'], 'approved');
        $iPending = $this->_oDb->getCountByAuthorAndStatus($this->_aProfile['ID'], 'pending');
        $sBaseUrl = BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . "browse/my";
        $aVars = array ('msg' => '');
        if ($iPending)
            $aVars['msg'] = sprintf(_t('_bx_matches_msg_you_have_pending_approval_matches'), $sBaseUrl . '&bx_matches_filter=pending_matches', $iPending);
        elseif (!$iActive)
            $aVars['msg'] = sprintf(_t('_bx_matches_msg_you_have_no_matches'), $sBaseUrl . '&bx_matches_filter=add_match');
        else
            $aVars['msg'] = sprintf(_t('_bx_matches_msg_you_have_some_matches'), $sBaseUrl . '&bx_matches_filter=manage_matches', $iActive, $sBaseUrl . '&bx_matches_filter=add_match');
        return $this->_oTemplate->parseHtmlByName('my_matches_main', $aVars);
    }

    function getBlockCode_Add()
    {
        if (!$this->_oMain->isAllowedAdd()) {
            return MsgBox(_t('_Access denied'));
        }
        ob_start();
        $this->_oMain->_addForm(BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'browse/my');
        $aVars = array ('form' => ob_get_clean(), 'id' => '');
        $this->_oTemplate->addCss ('forms_extra.css');
        return $this->_oTemplate->parseHtmlByName('my_matches_create_match', $aVars);
    }
	function getBlockCode_playground()
    {
        if (!$this->_oMain->isAllowedAdd()) {
            return MsgBox(_t('_Access denied'));
        }
        ob_start();
        $this->_addPlaygroundForm(BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'browse/my');
        $aVars = array ('form' => ob_get_clean(), 'id' => '');
        $this->_oTemplate->addCss ('forms_extra.css');
        return $this->_oTemplate->parseHtmlByName('my_pg_create_pg', $aVars);
    }
    function getBlockCode_Pending()
    {
        $sForm = $this->_oMain->_manageEntries ('my_pending', '', false, 'bx_matches_pending_user_form', array(
            'action_delete' => '_bx_matches_admin_delete',
        ), 'bx_matches_my_pending', false, 7);
        if (!$sForm)
            return MsgBox(_t('_Empty'));
        $aVars = array ('form' => $sForm, 'id' => 'bx_matches_my_pending');
        return $this->_oTemplate->parseHtmlByName('my_matches_manage', $aVars);
    }

    function getBlockCode_My()
    {
        $sForm = $this->_oMain->_manageEntries ('user', process_db_input ($this->_aProfile['NickName'], BX_TAGS_NO_ACTION, BX_SLASHES_NO_ACTION), false, 'bx_matches_user_form', array(
            'action_delete' => '_bx_matches_admin_delete',
        ), 'bx_matches_my_active', true, 7);
        $aVars = array ('form' => $sForm, 'id' => 'bx_matches_my_active');
        return $this->_oTemplate->parseHtmlByName('my_matches_manage', $aVars);
    }
	
	function _addPlaygroundForm ($sRedirectUrl)
    {
        bx_import ('PlaygroundFormAdd',$this->_aModule);
        $sClass = 'BxMatchPlaygroundFormAdd';
		//echo '<pre>';print_r($oForm);die;
        $oForm = new $sClass ($this, $this->_aProfile['ID']);
        $oForm->initChecker();

        if ($oForm->isSubmittedAndValid ()) {

           $sStatus = $this->_oDb->getParam($this->_sPrefix.'_autoapproval') == 'on' || $this->isAdmin() ? 'approved' : 'pending';
            $aValsAdd = array (
                $this->_oDb->_sFieldCreated => time(),
                $this->_oDb->_sFieldUri => $oForm->generateUri(),
                $this->_oDb->_sFieldStatus => $sStatus,
            );
            $aValsAdd[$this->_oDb->_sFieldAuthorId] = $this->_aProfile['ID'];
            $iEntryId = $oForm->insert ($aValsAdd);
			
            if ($iEntryId) {

                //$this->isAllowedAdd(true); // perform action

                $oForm->processMedia($iEntryId, $this->_aProfile['ID']);

                $aDataEntry = $this->_oDb->getEntryByIdAndOwner($iEntryId, $this->_aProfile['ID'], $this->isAdmin());

                $this->_oDb->updatePgPhoto($iEntryId);
                if (!$sRedirectUrl)
                    $sRedirectUrl = BX_DOL_URL_ROOT . $this->_oConfig->getBaseUri() . 'view/' . $aDataEntry[$this->_oDb->_sFieldUri];
                header ('Location:' . $sRedirectUrl);
                exit;

            } else {

                MsgBox(_t('_Error Occured'));
            }

        } else {

            echo $oForm->getCode ();

        }
    }
	function isAdmin ()
    {
        return $GLOBALS['logged']['admin'] && isProfileActive($this->_aProfile['ID']);
    }
}
