<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?=$this->parseSystemKey('page_charset', $mixedKeyWrapperHtml);?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<title><?=$this->parseSystemKey('page_header', $mixedKeyWrapperHtml);?></title>
	<base href="http://localhost/hiyya/" />	
    <?=$this->parseSystemKey('meta_info', $mixedKeyWrapperHtml);?>
	<meta http-equiv="Content-Style-Type" content="text/css" />

    <?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_head_begin'); ?>

	<bx_include_css_styles />
	<bx_include_css />
	<link href='//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900' rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css' />

	<bx_include_js />
    <?=$this->parseSystemKey('dol_images', $mixedKeyWrapperHtml);?>
    <?=$this->parseSystemKey('dol_lang', $mixedKeyWrapperHtml);?>
    <?=$this->parseSystemKey('dol_options', $mixedKeyWrapperHtml);?>
    <script type="text/javascript" language="javascript">
		var site_url = 'http://localhost/hiyya/';
        var aUserInfoTimers = new Array();

        // make logo text to not overflow
        var fResizeCallback = function () {
            var iSize = $('.sys_ml_wrapper').innerWidth() - $('.sys_search_wrapper').outerWidth() - $('.sys_menu_wrapper').outerWidth() - 20;
            $('.mainLogoText, .mainLogo').css('max-width', iSize + 'px');
        };
        $(window).resize(fResizeCallback);

        $(document).ready(function() {
			/*--- Init RSS Feed Support ---*/
			$('div.RSSAggrCont').dolRSSFeed();

			/*--- Init Retina Support ---*/
			$('img.bx-img-retina').dolRetina();

			/*--- Init Embedly Support ---*/
			$('a.bx-link').dolEmbedly();

			/*--- Init Scrollr ---*/
			var oSkrollr = skrollr.init({
				forceHeight: false
			});
			if(oSkrollr.isMobile())
				oSkrollr.destroy();

            fResizeCallback();
		});

        /*--- Init User Status ---*/
        var oBxUserStatus = new BxUserStatus();
        oBxUserStatus.userStatusInit('http://localhost/hiyya/', <?=$this->parseSystemKey('is_profile_page', $mixedKeyWrapperHtml);?>);
	</script>
    <?=$this->parseSystemKey('extra_js', $mixedKeyWrapperHtml);?>
	<?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_head'); ?>
</head>
<?=$this->parseSystemKey('flush_header', $mixedKeyWrapperHtml);?>
<body <?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_body'); ?> class="bx-def-font">
    <?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_header'); ?>
    <div id="notification_window" class="notifi_window"></div>
	<div id="FloatDesc" style="position:absolute;display:none;z-index:100;"></div>
