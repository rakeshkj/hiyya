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

<div class="sys_root_bg"></div>
<div class="sys_root">
    <?=$this->processInjection($GLOBALS['_page']['name_index'], 'banner_left'); ?>
    <?=$this->processInjection($GLOBALS['_page']['name_index'], 'banner_right'); ?>
    <?=$this->parseSystemKey('extra_top_menu', $mixedKeyWrapperHtml);?>
    <div class="sys_main_logo">
		<div class="sys_ml sys_main_page_width">
            <div class="sys_ml_wrapper bx-def-margin-sec-leftright bx-def-padding-sec-topbottom">
                <?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_logo_before'); ?>
                <table cellpadding="0" cellspacing="0">
                	<tr>
                		<td class="sys_search_wrapper"><?=$this->parseSystemKey('main_search', $mixedKeyWrapperHtml);?></td>
                		<td class="sys_logo_wrapper">
                			<div class="sys_logo_wrapper_cnt bx-def-padding-sec-leftright"><?=$this->parseSystemKey('main_logo', $mixedKeyWrapperHtml);?></div>
                		</td>
                		<td class="sys_menu_wrapper"><?=$this->parseSystemKey('service_menu', $mixedKeyWrapperHtml);?></td>
    				</tr>
    			</table>
    			<?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_logo_after'); ?>
            </div>
		</div>
		<?=$this->processInjection($GLOBALS['_page']['name_index'], 'banner_top'); ?>
	</div>
	<?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_between_logo_top_menu'); ?>
    <?=$this->parseSystemKey('top_menu', $mixedKeyWrapperHtml);?>
    <?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_between_top_menu_content'); ?>
	<!-- end of top -->

	<div class="sys_main_content sys_main_page_width">
        <div class="sys_mc_wrapper bx-def-margin-sec-leftright">
            <div class="sys_mc clearfix">
                <!--[if lt IE 8]>
                <div style="background-color:#fcc" class="bx-def-border bx-def-margin-top bx-def-padding bx-def-font-large">
                    <b>You are using a subprime browser.</b> <br />
                    It may render this site incorrectly. <br />
                    Please upgrade to a modern web browser: 
                    <a href="http://www.google.com/chrome" target="_blank">Google Chrome</a> | 
                    <a href="http://www.firefox.com" target="_blank">Firefox</a> | 
                    <a href="http://www.apple.com/safari/download/" target="_blank">Safari</a>
                </div>
                <![endif]-->

                <!-- body -->
                <?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_splash_before'); ?>
                <?=$this->parseSystemKey('main_splash', $mixedKeyWrapperHtml);?>
                <?=$this->processInjection($GLOBALS['_page']['name_index'], 'injection_content_before'); ?>