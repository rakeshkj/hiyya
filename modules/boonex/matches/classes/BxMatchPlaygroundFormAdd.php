<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import ('BxDolProfileFields');
bx_import ('BxDolFormMedia');

class BxMatchPlaygroundFormAdd extends BxDolFormMedia
{
    var $_oMain, $_oDb;

    function BxMatchPlaygroundFormAdd ($oMain, $iProfileId, $iEntryId = 0, $iThumb = 0)
    {
        $this->_oMain = $oMain;
        $this->_oDb = $oMain->_oDb;

        $this->_aMedia = array ();
        if (BxDolRequest::serviceExists('photos', 'perform_photo_upload', 'Uploader'))
            $this->_aMedia['images'] = array (
                'post' => 'ready_images',
                'upload_func' => 'uploadPhotos',
                'tag' => BX_MATCHES_PHOTOS_TAG,
                'cat' => BX_MATCHES_PHOTOS_CAT,
                'thumb' => 'thumb',
                'module' => 'photos',
                'title_upload_post' => 'images_titles',
                'title_upload' => _t('_bx_matches_form_caption_file_title'),
                'service_method' => 'get_photo_array',
            );

        
        // generate templates for custom form's elements
        $aCustomMediaTemplates = $this->generateCustomMediaTemplates ($oMain->_iProfileId, $iEntryId, $iThumb);

        // privacy

        $aInputPrivacyCustom = array ();
        $aInputPrivacyCustom[] = array ('key' => '', 'value' => '----');
        $aInputPrivacyCustom[] = array ('key' => 'f', 'value' => _t('_bx_matches_privacy_fans_only'));
        $aInputPrivacyCustomPass = array (
            'pass' => 'Preg',
            'params' => array('/^([0-9f]+)$/'),
        );

        $aInputPrivacyCustom2 = array (
            array('key' => 'f', 'value' => _t('_bx_matches_privacy_fans')),
            array('key' => 'a', 'value' => _t('_bx_matches_privacy_admins_only'))
        );
        $aInputPrivacyCustom2Pass = array (
            'pass' => 'Preg',
            'params' => array('/^([fa]+)$/'),
        );

        

        //$aInputPrivacyUploadPhotos = $this->_oMain->_oMain->_oPrivacy->getGroupChooser($iProfileId, 'matches', 'upload_photos');
        $aInputPrivacyUploadPhotos['values'] = $aInputPrivacyCustom2;
        $aInputPrivacyUploadPhotos['db'] = $aInputPrivacyCustom2Pass;

        

        $aCustomForm = array(

            'form_attrs' => array(
                'name'     => 'form_matches_playground',
                'action'   => '',
                'method'   => 'post',
                'enctype' => 'multipart/form-data',
            ),

            'params' => array (
                'db' => array(
                    'table' => 'bx_matches_pg_main',
                    'key' => 'id',
                    'uri' => 'uri',
                    'uri_title' => 'title',
                    'submit_name' => 'submit_form',
                ),
            ),

            'inputs' => array(

                'header_info' => array(
                    'type' => 'block_header',
                    'caption' => _t('_bx_matches_pg_form_header_info')
                ),

                'title' => array(
                    'type' => 'text',
                    'name' => 'title',
                    'caption' => _t('_bx_matches_pg_form_caption_title'),
                    'required' => true,
                    'checker' => array (
                        'func' => 'length',
                        'params' => array(3,12),
                        'error' => _t ('_bx_matches_pg_form_err_title'),
                    ),
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
                'type' => array(
                    'type' => 'radio_set',
                    'name' => 'type',
                    'caption' => _t('_bx_matches_pg_form_caption_type'),
					'values' => array(
                    0 => _t('_5-a-side'),
                    1 => _t('_7-a-side'),
					2 => _t('_11-a-side')
					),
                    'required' => true,
					'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_pg_form_err_match_type'),
                    ),
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'min_players' => array(
                    'type' => 'text',
                    'name' => 'min_players',
                    'caption' => _t('_bx_matches_pg_form_caption_min_players'),
                    'required' => true,
					'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_pg_form_err_min_players'),
                    ),
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'max_players' => array(
                    'type' => 'text',
                    'name' => 'max_players',
                    'caption' => _t('_bx_matches_pg_form_caption_max_players'),
                    'required' => true,
                    'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_pg_form_err_max_players'),
                    ),
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
				'address' => array(
                    'type' => 'text',
                    'name' => 'address',
                    'caption' => _t('_bx_matches_pg_form_caption_address'),
                    'required' => true,
                    'checker' => array (
                        'func' => 'length',
                        'params' => array(3,100),
                        'error' => _t ('_bx_matches_pg_form_err_address'),
                    ),
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
				'gps_location' => array(
                    'type' => 'text',
                    'name' => 'gps_location',
                    'caption' => _t('_bx_matches_pg_form_caption_gps_location'),
                    'required' => false,
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
				
				'description' => array(
                    'type' => 'text',
                    'name' => 'description',
                    'caption' => _t('_bx_matches_pg_form_caption_description'),
                    'required' => false,
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
				'pitch_type' => array(
                    'type' => 'radio_set',
                    'name' => 'pitch_type',
                    'caption' => _t('_bx_matches_pg_form_caption_pitch_type'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_grass'),
                    1 => _t('_bx_matches_form_caption_artificial'),
					2 => _t('_bx_matches_form_caption_hard'),
					3 => _t('_bx_matches_form_caption_sand'),
					4 => _t('_bx_matches_form_caption_other')
					),
                    'required' => true,
					'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_pg_form_err_pitch_type'),
                    ),
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'indoor' => array(
                    'type' => 'radio_set',
                    'name' => 'indoor',
                    'caption' => _t('_bx_matches_form_caption_indoor'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_no'),
                    1 => _t('_bx_matches_form_caption_yes')
					),
                    'required' => true,
					'checker' => array (
                        'func' => 'int',
                        'error' => _t ('_bx_matches_pg_form_err_indoor'),
                    ),
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'ballhire' => array(
                    'type' => 'radio_set',
                    'name' => 'ballhire',
                    'caption' => _t('_bx_matches_form_caption_ballhire'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_no'),
                    1 => _t('_bx_matches_form_caption_yes')
					),
					'value' => 0,
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'ballbump' => array(
                    'type' => 'radio_set',
                    'name' => 'ballbump',
                    'caption' => _t('_bx_matches_form_caption_ballbump'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_no'),
                    1 => _t('_bx_matches_form_caption_yes')
					),
					'value' => 0,
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'netted' => array(
                    'type' => 'radio_set',
                    'name' => 'netted',
                    'caption' => _t('_bx_matches_form_caption_netted'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_no'),
                    1 => _t('_bx_matches_form_caption_yes')
					),
					'value' => 0,
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'withlines' => array(
                    'type' => 'radio_set',
                    'name' => 'withlines',
                    'caption' => _t('_bx_matches_form_caption_withlines'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_no'),
                    1 => _t('_bx_matches_form_caption_yes')
					),
					'value' => 0,
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'shop' => array(
                    'type' => 'radio_set',
                    'name' => 'shop',
                    'caption' => _t('_bx_matches_form_caption_shop'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_no'),
                    1 => _t('_bx_matches_form_caption_yes')
					),
					'value' => 0,
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'WC' => array(
                    'type' => 'radio_set',
                    'name' => 'WC',
                    'caption' => _t('_bx_matches_form_caption_WC'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_no'),
                    1 => _t('_bx_matches_form_caption_yes')
					),
					'value' => 0,
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'water' => array(
                    'type' => 'radio_set',
                    'name' => 'water',
                    'caption' => _t('_bx_matches_form_caption_water'),
					'values' => array(
                    0 => _t('_bx_matches_form_caption_no'),
                    1 => _t('_bx_matches_form_caption_yes')
					),
					'value' => 0,
                    'db' => array (
                        'pass' => 'XssHtml',
                    ),
                ),
				'price_per_hour' => array(
                    'type' => 'text',
                    'name' => 'price_per_hour',
                    'caption' => _t('_bx_matches_pg_form_caption_price_per_hour'),
                    'required' => false,
                    'db' => array (
                        'pass' => 'Xss',
                    ),
                ),
            
                // images

                'header_images' => array(
                    'type' => 'block_header',
                    'caption' => _t('_bx_matches_form_header_images'),
                    'collapsable' => true,
                    'collapsed' => false,
                ),
                'thumb' => array(
                    'type' => 'custom',
                    'content' => $aCustomMediaTemplates['images']['thumb_choice'],
                    'name' => 'thumb',
                    'caption' => _t('_bx_matches_form_caption_thumb_choice'),
                    'info' => _t('_bx_matches_form_info_thumb_choice'),
                    'required' => false,
                    'db' => array (
                        'pass' => 'Int',
                    ),
                ),
                'images_choice' => array(
                    'type' => 'custom',
                    'content' => $aCustomMediaTemplates['images']['choice'],
                    'name' => 'images_choice[]',
                    'caption' => _t('_bx_matches_form_caption_images_choice'),
                    'info' => _t('_bx_matches_form_info_images_choice'),
                    'required' => false,
                ),
                'images_upload' => array(
                    'type' => 'custom',
                    'content' => $aCustomMediaTemplates['images']['upload'],
                    'name' => 'images_upload[]',
                    'caption' => _t('_bx_matches_form_caption_images_upload'),
                    'info' => _t('_bx_matches_form_info_images_upload'),
                    'required' => false,
                ),

                

                //'allow_upload_photos_to' => $aInputPrivacyUploadPhotos,
                'Submit' => array (
                    'type' => 'submit',
                    'name' => 'submit_form',
                    'value' => _t('_Submit'),
                    'colspan' => false,
                ),
            ),
        );

        if (!$aCustomForm['inputs']['images_choice']['content']) {
            unset ($aCustomForm['inputs']['thumb']);
            unset ($aCustomForm['inputs']['images_choice']);
        }
        if (!isset($this->_aMedia['images'])) {
            unset ($aCustomForm['inputs']['header_images']);
            unset ($aCustomForm['inputs']['thumb']);
            unset ($aCustomForm['inputs']['images_choice']);
            unset ($aCustomForm['inputs']['images_upload']);
            unset ($aCustomForm['inputs']['allow_upload_photos_to']);
        }
        $this->processMembershipChecksForMediaUploads ($aCustomForm['inputs']);

        parent::BxDolFormMedia ($aCustomForm);
    }

}
