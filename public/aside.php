<?php
    global $wpdb;
    $ptbd_table_name = 'wp_tradesmarter_aside';
    $result_general = $wpdb->get_results('SELECT * FROM `wp_aside_general` ORDER BY `id` desc limit 1');

    // get user language from 'userLanguage' cookie or get default language
    if(!isset($_COOKIE['userLanguage'])){ setcookie('userLanguage', $result_general[0]->default_language , time()+31556926, '/'); $_COOKIE['userLanguage'] = $result_general[0]->default_language; $lang = result_general[0]->default_language; }
    if(isset($_COOKIE['userLanguage'])){ $lang = $_COOKIE['userLanguage']; }

    // get tables data for selected language
    $result_aside = $wpdb->get_results('SELECT * FROM `wp_tradesmarter_aside_test` WHERE `lang_id` = "' . $lang  . '" ORDER BY `id` desc limit 1');
    $result_top_panel = $wpdb->get_results('SELECT * FROM `wp_tradesmarter_top_panel` WHERE `lang_id` = "' . $lang . '" ORDER BY `id` desc limit 1');
    $result_footer = $wpdb->get_results('SELECT * FROM `wp_tradesmarter_footer` WHERE `lang_id` = "' . $lang . '" ORDER BY `id` desc limit 1');
    // get list of created language
    $readyLanguages = $wpdb->get_results('SELECT t1.lang_id from wp_tradesmarter_top_panel t1, wp_tradesmarter_aside_test t2 WHERE t1.lang_id = t2.lang_id ' );
    
    // set ApiHost in cookie
    if(!isset($_COOKIE['apiHost'])){ setcookie('apiHost', $result_general[0]->api_host , time()+31556926, '/'); }

    // set theme in cookie
    if (!isset($_COOKIE['theme'])){ setcookie('theme', $result_general[0]->default_theme , time()+31556926, '/'); $_COOKIE['theme'] = $result_general[0]->default_theme; };

    function getDemo(){
      $handle = curl_init();
      $login = $GLOBALS['login'];
      $password = $GLOBALS['password'];

      $url = "http://admin-api.tradesmarter.com/crm/rest/create-demo-account?siteID=23";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
      $getDemoResponse = curl_exec($ch);
      curl_close($ch);  
      $GLOBALS['getDemoResponseJson'] = json_decode($getDemoResponse);
      print_r(json_decode($getDemoResponse));
    }
  ?>

  


<!-- Here defined all styles, that are coming from admin side -->
<style>

  .aside__content nav ul{ 
    list-style: none; 
  }

  .aside__content nav ul li ul li span,
  .aside__content nav ul li ul li a{
    color: <?php echo $result_general[0]->color_dark ?> !important;
  } 
  .aside__content nav ul li ul li.active span{
    color: <?php echo $result_general[0]->active_link ?> !important;
  }
  .aside__content ul li a{
    color: <?php echo $result_general[0]->color_dark ?> !important;
  }
  .light .aside__content nav ul li ul li span,
  .light .aside__content nav ul li ul li a{
    color: <?php echo $result_general[0]->color_light ?> !important;
  }
  .active::after{
    background-color: <?php echo $result_general[0]->active_link ?> !important;
  }
  body .aside_wrapper .top-section__navigation li.active a::after{
    background-color: <?php echo $result_general[0]->active_link ?> !important;
  }
  .aside__content{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }
  .light .aside__content{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }
  .light .aside__content nav ul li ul li.active::after{
    background-color: <?php echo $result_general[0]->active_link_light ?> !important;
  }
  .light .aside__content nav ul li ul li.active a{
    color: <?php echo $result_general[0]->active_link_light ?> !important;
  }
  .aside__content nav ul li ul li.active a{
    color: <?php echo $result_general[0]->active_link ?> !important;
  }
  .logout a{
    color: <?php echo $result_general[0]->color_dark ?> !important;
  }
  .light .aside__content .logout a{
    color: <?php echo $result_general[0]->color_light ?> !important;
  }

  body .aside_wrapper{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  body .aside_wrapper .light_container {
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  .top-section__wrapper {
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  .top-section__wrapper.light{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  .top-section__wrapper.light .top-section__burger .top-section__navigation li a {
    color:  <?php echo $result_general[0]->color_light ?> !important;
  }

  .top-section__wrapper.light .top-section__burger .top-section__navigation li.top-section__navigation-current_page::after{
    background-color: <?php echo $result_general[0]->active_link_light ?> !important;
  }

  .top-section__wrapper.light .time_block span, 
  .top-section__wrapper.light .time_block small,
  .top-section__wrapper.light .languages li.li__with_items,
  .top-section__wrapper.light .languages li a,
  .top-section__wrapper.light .languages li .languages_dropdown li a,
  .top-section__wrapper.light .languages li .languages_dropdown li,
  .top-section__wrapper.light .user-block,
  .top-section__wrapper.light .user-block li span{
    color:  <?php echo $result_general[0]->color_light ?> !important;
  }   

  .top-section__wrapper.light .time_block svg{
    --clock-color: <?php echo $result_general[0]->color_light ?> !important;
  }

  .top-section__wrapper.light .user-block svg{
    --clock-color: <?php echo $result_general[0]->color_light ?> !important;
  }

  .left_burger{
    border-top: 1px solid <?php echo $result_general[0]->color_dark ?> !important;
    border-bottom: 1px solid <?php echo $result_general[0]->color_dark ?> !important;
  }

  .right_burger::after{
    color: <?php echo $result_general[0]->color_dark ?> !important;
  }

  .top-section__wrapper .right_burger svg{
    --clock-color: <?php echo $result_general[0]->color_dark ?> !important;
  }

  .top-section__wrapper.light .right_burger svg{
    --clock-color: <?php echo $result_general[0]->color_light ?> !important;
  }

  .top-section__wrapper .user-block svg{
    --clock-color: <?php echo $result_general[0]->color_dark ?> !important;
  }

  .top-section__wrapper .left_burger-content,
  .top-section__wrapper .right_burger-content{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  .top-section__wrapper.light .left_burger-content,
  .top-section__wrapper.light .right_burger-content{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  body .aside_wrapper .top-section__wrapper #top_section_burger::after,
  body .aside_wrapper .top-section__wrapper #top_section_burger::before,
  body .aside_wrapper .top-section__burger #top_section_cross::after, 
  body .aside_wrapper .top-section__burger #top_section_cross::before {
    border-bottom: 1px solid <?php echo $result_general[0]->color_dark ?> !important;
    border-top: 1px solid <?php echo $result_general[0]->color_dark ?> !important;
  }

  body .aside_wrapper .top-section__wrapper #top_section_burger::before{
    border-top: initial !important;
  }

  @media screen and (max-width: 1000px){
    body .aside_wrapper .top-section__wrapper .top-section__burger{
      background-color: <?php echo $result_general[0]->dark_bg ?> !important;
    }
  }

  body .aside_wrapper .top-section__wrapper.light .top-section__burger{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  body .aside_wrapper .top-section__navigation li a{ 
    color:  <?php echo $result_general[0]->color_dark ?> !important;
  }

  body .aside_wrapper.light_content .top-section__navigation li a{ 
    color:  <?php echo $result_general[0]->color_light ?> !important;
  }

  .aside_wrapper top-section__wrapper .top-section__burger{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  .aside_wrapper top-section__wrapper.light .top-section__burger{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  body .aside_wrapper .top-section__wrapper .languages li .languages_dropdown{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  .left_burger-content ul li ul li span,
  .left_burger-content ul li ul li a{
    color: <?php echo $result_general[0]->color_dark ?> !important;
  }

  body .aside_wrapper .top-section__wrapper.light .languages li .languages_dropdown{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  body .aside_wrapper .top-section__wrapper .login_block li a:not([class]){
    color: <?php echo $result_general[0]->color_dark ?> !important;
  }

  body .aside_wrapper.light_content .top-section__wrapper .login_block li a:not([class]){
    color: <?php echo $result_general[0]->color_light ?> !important;
  }

  body .aside_wrapper .top-section__navigation li:hover a{
	  color: <?php echo $result_general[0]->active_link ?> !important;
  }

  body .aside_wrapper .top-section__navigation li:hover a::after{
    content: ' ';
    position: absolute;
    width: 100%;
    height: 2px;
    background-color: <?php echo $result_general[0]->active_link ?> !important;
    bottom: -20px ; 
    left: 0;
  }

  body .aside_wrapper #bpwidgets{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  body .aside_wrapper #bpwidgets.light_container{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  body .aside_wrapper #bpfxcfd{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  .aside_wrapper .faq__page{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  .aside_wrapper.light_content .faq__page{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  body .aside_wrapper #bpfxcfd.light_container{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  .aside_wrapper .text__page{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  .aside_wrapper .text__page{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  .aside_wrapper.light_content .text__page{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  .aside_wrapper .text__page h1,
  .aside_wrapper .text__page h2,
  .aside_wrapper .text__page h3,
  .aside_wrapper .text__page h4,
  .aside_wrapper .text__page h5,
  .aside_wrapper .text__page h6{
    color: <?php echo $result_general[0]->title_color_text_page ?> !important;
  }
  .aside_wrapper .text__page p{ 
    color: <?php echo $result_general[0]->paragraph_color_text_page ?> !important;
  }

  .aside_wrapper .text__page p a{ 
    color: <?php echo $result_general[0]->paragraph_color_text_page ?> !important;
  }

  .aside_wrapper.light_content .text__page h1,
  .aside_wrapper.light_content .text__page h2,
  .aside_wrapper.light_content .text__page h3,
  .aside_wrapper.light_content .text__page h4,
  .aside_wrapper.light_content .text__page h5,
  .aside_wrapper.light_content .text__page h6{
    color: <?php echo $result_general[0]->title_color_text_page_light ?> !important;
  }
  .aside_wrapper.light_content .text__page p{ 
    color: <?php echo $result_general[0]->paragraph_color_text_page_light ?> !important;
  }

  .aside_wrapper #loginPopUp__wrapper #bpwidgets_popup #widget_popup_cross::after,
  .aside_wrapper #loginPopUp__wrapper #bpwidgets_popup #widget_popup_cross::before,
  .aside_wrapper .top-section__wrapper .top-section-align-block #time_lang .login_block .getLoginPopUp .sign_in, 
  .ts-aside > div .bpwidgets_popup #widget_popup_cross::after,
  .ts-aside > div .bpwidgets_popup #widget_popup_cross::before,
  .aside_wrapper #loginPopUp__wrapper #bpwidgets_popup_login #widget_popup_cross::after,
  .aside_wrapper #loginPopUp__wrapper #bpwidgets_popup_login #widget_popup_cross::before,
  .aside_wrapper #loginPopUp__wrapper #bpwidgets_popup_signup #widget_popup_cross::after,
  .aside_wrapper #loginPopUp__wrapper #bpwidgets_popup_signup #widget_popup_cross::before{
    background-color: <?php echo $result_general[0]->switch_btn_color ?> !important;
  }

  .aside_wrapper.light_content #loginPopUp__wrapper #bpwidgets_popup #widget_popup_cross::after,
  .aside_wrapper.light_content #loginPopUp__wrapper #bpwidgets_popup #widget_popup_cross::before,
  .ts-aside.light > div .bpwidgets_popup #widget_popup_cross::after,
  .ts-aside.light > div .bpwidgets_popup #widget_popup_cross::before,
  .aside_wrapper.light_content  #loginPopUp__wrapper #bpwidgets_popup_login #widget_popup_cross::after,
  .aside_wrapper.light_content  #loginPopUp__wrapper #bpwidgets_popup_login #widget_popup_cross::before,
  .aside_wrapper.light_content  #loginPopUp__wrapper #bpwidgets_popup_signup #widget_popup_cross::after,
  .aside_wrapper.light_content  #loginPopUp__wrapper #bpwidgets_popup_signup #widget_popup_cross::before{
    background-color: <?php echo $result_general[0]->switch_btn_color_light ?> !important;
  }

  .aside_wrapper .top-section__wrapper .top-section-align-block .top-section__burger .modes a,
  .aside_wrapper .top-section__wrapper .login_block li a#OpenPopUp{
    background-color: <?php echo $result_general[0]->switch_btn_color ?> !important;
    color: <?php echo $result_general[0]->switch_btn_color_text ?> !important;   
  }

  .aside_wrapper.light_content .top-section__wrapper .top-section-align-block .top-section__burger .modes a,
  .aside_wrapper .top-section__wrapper.light .login_block li a#OpenPopUp{
    background-color: <?php echo $result_general[0]->switch_btn_color_light ?> !important;
    color: <?php echo $result_general[0]->switch_btn_color_text_light ?> !important;  
  }

  .ts-aside.light .aside__content .download p {
    color: <?php echo $result_general[0]->color_light ?> !important;
  }

  .ts-aside .aside__content .download p {
    color: <?php echo $result_general[0]->color_dark ?> !important;
  }

  .ts-aside.light .aside__content .download {
    background-color: <?php echo $result_general[0]->dwnld_block_backgorund_color ?> !important;
  }

  .ts-aside .aside__content .download {
    background-color: <?php echo $result_general[0]->dwnld_block_backgorund_dark_color ?> !important;
  }

  .top-section__wrapper .right_burger-content .modes li a{
    background-color: <?php echo $result_general[0]->switch_btn_color ?> !important;
    color: <?php echo $result_general[0]->switch_btn_color_text ?> !important;   
  }

  .top-section__wrapper.light .right_burger-content .modes li a{
    background-color: <?php echo $result_general[0]->switch_btn_color_light ?> !important;
    color: <?php echo $result_general[0]->switch_btn_color_text_light ?> !important;  
  }

  .top-section__wrapper .left_burger{
    border-top: 1px solid <?php echo $result_general[0]->color_dark ?> !important;
    border-bottom: 1px solid <?php echo $result_general[0]->color_dark ?> !important;
  }

  .top-section__wrapper.light .left_burger{
    border-top: 1px solid <?php echo $result_general[0]->color_light ?> !important;
    border-bottom: 1px solid <?php echo $result_general[0]->color_light ?> !important;
  }

  .top-section__wrapper .left_burger-content-top_cross::after,
  .top-section__wrapper .left_burger-content-top_cross::before,
  .top-section__wrapper .left_burger::after
  {
    background-color: <?php echo $result_general[0]->color_dark ?> !important;
  }

  .top-section__wrapper.light .left_burger-content-top_cross::after,
  .top-section__wrapper.light .left_burger-content-top_cross::before,
  .top-section__wrapper.light .left_burger::after
  {
    background-color: <?php echo $result_general[0]->color_light ?> !important;
  }

  .top-section__wrapper .right_burger-content .languages li a, 
  .top-section__wrapper .right_burger-content .languages li ul li a,
  .top-section__wrapper .right_burger-content .languages li a::after,
  .top-section__wrapper .right_burger-content a,
  .top-section__wrapper .left_burger-content ul li a,
  .top-section__wrapper .left_burger-content ul li span,
  .top-section__wrapper .left_burger-content ul li ul li.li__with_items span::after,
  .top-section__wrapper .left_burger-content ul li ul li.li__with_items_opened span::after,
  .top-section__wrapper .right_burger::after{
    color: <?php echo $result_general[0]->color_dark ?> !important;
  }

  .top-section__wrapper.light .right_burger-content .languages li a, 
  .top-section__wrapper.light .right_burger-content .languages li ul li a,
  .top-section__wrapper.light .right_burger-content .languages li a::after,
  .top-section__wrapper.light .right_burger-content a,
  .top-section__wrapper.light .left_burger-content ul li a,
  .top-section__wrapper.light .left_burger-content ul li span,
  .top-section__wrapper.light .left_burger-content ul li ul li.li__with_items span::after,
  .top-section__wrapper.light .left_burger-content ul li ul li.li__with_items_opened span::after,
  .top-section__wrapper.light .right_burger::after{
    color: <?php echo $result_general[0]->color_light ?> !important;
  }

  .aside_wrapper footer.footer{
    background-color: <?php echo $result_general[0]->dark_bg ?> !important;
  }

  .aside_wrapper.light_content footer.footer{
    background-color: <?php echo $result_general[0]->light_bg ?> !important;
  }

  .aside_wrapper footer.footer .footer_content p {
    color: <?php echo $result_general[0]->footer_text_color ?> !important;
  }

  .aside_wrapper footer.footer .footer_content p a{
    color: <?php echo $result_general[0]->footer_link_color ?> !important;
  }

  .aside_wrapper.light_content footer.footer .footer_content p {
    color: <?php echo $result_general[0]->footer_light_text_color ?> !important;
  }

  .aside_wrapper.light_content footer.footer .footer_content p a{
    color: <?php echo $result_general[0]->footer_light_link_color ?> !important;
  }

</style>  

<!-- Template for site with hiden left panel or full template -->

<div class="aside_wrapper closet_left_panel <?php if ($result_general[0]->hide_top_panel){ echo ' hide_top_panel '; } ?> <?php if ($result_general[0]->hide_left_panel){ echo ' hide_left_panel '; } ?> <?php if ($result_general[0]->hide_bottom_panel){ echo ' hide_bottom_panel '; } ?>">


<?php
  // Get user ID from API

  $session = " ";
  if($_COOKIE['userID']){
    $handle = curl_init();
    if ( strcasecmp ( $result_general[0]->api_host , 'brokers-domain.com' ) == 0){
      $GLOBALS['login'] = 'bd-api';
      $GLOBALS['password'] = '5c5918d8';
      $GLOBALS['url'] = "https://platform-api.ap-b.tradesmarter.com/index/get-session?userID=" . $_COOKIE['userID'];
    } else if ($result_general[0]->api_host == 'tradesmarter.com'){
      $GLOBALS['login'] = 'tsdemoapi';
      $GLOBALS['password'] = 'redUzg2PgsfDW34V';
      $GLOBALS['url'] = "https://platform-api.tradesmarter.com/index/get-session?userID=" . $_COOKIE['userID'];
    } else if ($result_general[0]->api_host == 'w-options.com') {
      $GLOBALS['login'] = 'woptions-api';
      $GLOBALS['password'] = '79997219';
      $GLOBALS['url'] = "https://platform-api.ap-b.tradesmarter.com/index/get-session?userID=" . $_COOKIE['userID'];
    } else if ($result_general[0]->api_host == 'mintesamarkets.com') {
      $GLOBALS['login'] = 'mintesa-api';
      $GLOBALS['password'] = 'cec7a39d';
      $GLOBALS['url'] = "https://platform-api.ap-b.tradesmarter.com/index/get-session?userID=" . $_COOKIE['userID'];;
    } else if ($result_general[0]->api_host == 'wow-trader.com') {
      $GLOBALS['login'] = 'wow-trader-api';
      $GLOBALS['password'] = '83ddba02';
      $GLOBALS['url'] = "https://platform-api.ap-b.tradesmarter.com/index/get-session?userID=" . $_COOKIE['userID'];;
    } else if ($result_general[0]->api_host == 'upoptions.com') {
      $GLOBALS['login'] = 'upoptions-api';
      $GLOBALS['password'] = '7f9f177c';
      $GLOBALS['url'] = "https://Platform-api.hk-a.tradesmarter.com/index/get-session?userID=" . $_COOKIE['userID'];;
    } else if ($result_general[0]->api_host == 'fivestars-markets.com') {
      $GLOBALS['login'] = 'fsm-dash-api';
      $GLOBALS['password'] = 'a7819a57';
      $GLOBALS['url'] = "https://platform-api.ap-b.tradesmarter.com/index/get-session?userID=" . $_COOKIE['userID'];;
    }

    // Please, add here new statement for new site :

    // else if ($result_general[0]->api_host == NEW_SITE_API_HOST) {
    //   $GLOBALS['login'] = NEW_SITE_LOGIN;
    //   $GLOBALS['password'] = NEW_SITE_PASSWORD;
    //   $GLOBALS['url'] = NEW_SITE_API_ENDPOINT . $_COOKIE['userID'];;
    // }

    $ch = curl_init();

    $url = $GLOBALS['url'];
    $login = $GLOBALS['login']; 
    $password = $GLOBALS['password'];

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
    $sessionResponse = curl_exec($ch);
    curl_close($ch);  
    $sessionObj = json_decode($sessionResponse);
    $GLOBALS['session'] = $sessionObj->session;
  }
?>
<?php

$resultObj =  "";
$pracideMode = "";
$documentsVerified = "";
$accountLevel = "";

  if($_COOKIE['userID']){

    // Get user session from API
    $handle = curl_init();
    if ( strcasecmp ( $result_general[0]->api_host , 'brokers-domain.com' ) == 0){
      $GLOBALS['login'] = 'bd-api';
      $GLOBALS['password'] = '5c5918d8';
      $GLOBALS['url2'] = "https://platform-api.ap-b.tradesmarter.com/user/info?session=" . $GLOBALS['session'];
    } else if ($result_general[0]->api_host == 'tradesmarter.com'){
      $GLOBALS['login'] = 'tsdemoapi';
      $GLOBALS['password'] = 'redUzg2PgsfDW34V';
      $GLOBALS['url2'] = "https://platform-api.tradesmarter.com/user/info?session=" . $GLOBALS['session'];
    } else if ($result_general[0]->api_host == 'w-options.com') {
      $GLOBALS['login'] = 'woptions-api';
      $GLOBALS['password'] = '79997219';
      $GLOBALS['url2'] = "https://platform-api.ap-b.tradesmarter.com/user/info?session=" . $GLOBALS['session'];
    } else if ($result_general[0]->api_host == 'mintesamarkets.com') {
      $GLOBALS['login'] = 'mintesa-api';
      $GLOBALS['password'] = 'cec7a39d';
      $GLOBALS['url2'] = "https://platform-api.tradesmarter.com/user/info?session=" . $GLOBALS['session'];
    } else if ($result_general[0]->api_host == 'wow-trader.com') {
      $GLOBALS['login'] = 'wow-trader-api';
      $GLOBALS['password'] = '83ddba02';
      $GLOBALS['url2'] = "https://platform-api.ap-b.tradesmarter.com/user/info?session=" . $GLOBALS['session'];
    } else if ($result_general[0]->api_host == 'upoptions.com') {
      $GLOBALS['login'] = 'upoptions-api';
      $GLOBALS['password'] = '7f9f177c';
      $GLOBALS['url2'] = "https://Platform-api.hk-a.tradesmarter.com/user/info?session=" . $GLOBALS['session'];
    } else if ($result_general[0]->api_host == 'fivestars-markets.com') {
      $GLOBALS['login'] = 'fsm-dash-api';
      $GLOBALS['password'] = 'a7819a57';
      $GLOBALS['url2'] = "https://platform-api.ap-b.tradesmarter.com/user/info?session=" . $GLOBALS['session'];
    } 

    // Please, add here new statement for new site :

    // else if ($result_general[0]->api_host == NEW_SITE_API_HOST) {
    //   $GLOBALS['login'] = NEW_SITE_LOGIN;
    //   $GLOBALS['password'] = NEW_SITE_PASSWORD;
    //   $GLOBALS['url2'] = NEW_SITE_API_ENDPOINT . $GLOBALS['session'];
    // }

    $ch = curl_init();

    $url = $GLOBALS['url2'];
    $login = $GLOBALS['login']; 
    $password = $GLOBALS['password'];

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
    $result = curl_exec($ch);
    curl_close($ch);  
    $GLOBALS['resultObj'] = json_decode($result);
    $GLOBALS['pracideMode'] = $GLOBALS['resultObj']->practiceMode;
    $GLOBALS['documentsVerified'] = $GLOBALS['resultObj']->documentsVerified;
    $GLOBALS['accountLevel'] = $GLOBALS['resultObj']->accountLevel;
  }
?>

<div id="top_panel" class="top-section__wrapper">
    <div class="left_burger-content">
      <div class="left_burger-content-top">
        <a class="top_section__logo" href="<?php echo $result_general[0]->logo_link; ?>"><img src="<?php echo ( $_COOKIE['theme'] == 'dark' ? $result_general[0]->img_top : $result_general[0]->img_top_white); ?>" alt=""></a>
        <div class="left_burger-content-top_cross"></div>
      </div>
      <ul> 
        <?php
          $name = json_decode($result_aside[0]->menu, true);
          $menu_link = json_decode($result_aside[0]->menu_link, true);
          $subname = json_decode($result_aside[0]->submenu, true);
          $links = json_decode($result_aside[0]->link, true);
          $icons = json_decode($result_aside[0]->icon, true);
          $sub_icons = json_decode($result_aside[0]->sub_icon, true);

          for($i = 0; $i < count($name); $i++){
            ?>
              <?php if ($i > 2 || $_COOKIE['userID']) { ?>
              <li>
                <ul>
                  <li>
                      <img src="<?php echo $icons[$i] ?>" alt="">
                    <?php 
                      if($menu_link[$i] && $menu_link[$i] != " "){
                        ?>
                        <a href="<?php echo $menu_link[$i]?>"><?php echo $name[$i]; ?></a>
                        <?php
                      } else {
                        ?>
                          <span><?php echo $name[$i]; ?></span>
                        <?php
                      }
                    ?>
                  </li>
                  <?php 
                    if ($subname[$i]){
                      for($j = 0; $j < count($subname[$i]); $j++){
                        ?>
                        <?php  if ($subname[$i][$j] != " "){ ?>
                          <li>
                            <a href="<?php echo $links[$i][$j]; ?>"><?php echo $subname[$i][$j]; ?></a> 
                          </li>
                        <?php
                        }
                      }
                    }
                  ?>
                </ul>
              </li>
            <?php
             }
          } 
        ?>
      </ul>
    </div>
    <div class="left_burger">
    </div>
      <a class="mobile_logo" href="<?php echo $result_general[0]->logo_link; ?>"><img src="<?php echo ( $_COOKIE['theme'] == 'dark' ? $result_general[0]->img : $result_general[0]->img_white); ?>" alt=""></a>
      <div class="right_burger">
          <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 540.4 540.3">
            <g>
              <path fill="var(--clock-color)" d="M306,381.1A91.1,91.1,0,1,0,215,290,91.3,91.3,0,0,0,306,381.1Z" transform="translate(-35.8 -40.3)"/>
              <path fill="var(--clock-color)" d="M379.7,382.6c-20.5,16-46.3,25.8-73.6,25.8a117.6,117.6,0,0,1-72.9-25c-82,41.7-94.1,116.2-95.6,138.2,46.3,37.2,104.8,59.2,169.4,59.2a270.5,270.5,0,0,0,169.2-59.9C473.8,497.2,460.9,424.3,379.7,382.6Z" transform="translate(-35.8 -40.3)"/>
              <path fill="var(--clock-color)" d="M306,40.3C157.3,40.3,35.8,161.8,35.8,310.5A265,265,0,0,0,113.3,498c6.8-35.7,29.6-96.4,100.1-135.8-15.2-20.5-25-45.5-25-72.9a118.4,118.4,0,0,1,236.8,0c0,27.3-9.1,53.1-25,72.9C470,401.6,492.8,462.3,500.3,498a268.4,268.4,0,0,0,75.9-187.5C576.2,161.8,454.8,40.3,306,40.3Z" transform="translate(-35.8 -40.3)"/>
            </g>
          </svg>
      </div>
      <div class="right_burger-content">
        <div class="left_burger-content-top">
          <a class="top_section__logo" href="<?php echo $result_general[0]->logo_link; ?>"><img src="<?php echo ( $_COOKIE['theme'] == 'dark' ? $result_general[0]->img_top : $result_general[0]->img_top_white); ?>" alt=""></a>
          <div class="left_burger-content-top_cross"></div>
        </div>
          <?php if ($_COOKIE['userID']) { ?>
            <ul class="modes">
              <li class="getLoginPopUp">
                <a href="<?php echo $result_top_panel[0]->deposit_link; ?>"><?php echo $result_top_panel[0]->deposit; ?></a>
              </li>
            </ul>
          <?php } ?>
            
          <ul class="top-section__navigation">
            <?php if($_COOKIE['userID']){?>
              <li> 
                <a href="<?php echo $result_top_panel[0]->my_acc_link ?>"><?php echo $result_top_panel[0]->my_acc ?></a>
              </li>
            <?php }?>
            <?php
              $top_menu = json_decode($result_top_panel[0]->menu_items, true);
              $top_links = json_decode($result_top_panel[0]->menu_links, true);

              if ($top_menu && $top_menu != " "){
                for($i = 0; $i < count($top_menu); $i++ ){
                  ?>
                    <li> 
                      <a href="<?php echo $top_links[$i] ?>"><?php echo $top_menu[$i] ?></a>
                    </li>
                  <?php
                }
              }
            ?>
          </ul>
          <ul class="languages">
            <?php 
              $langArr = [
                'en' => 'English',
                'de' => 'Deutsch',
                'es' => 'Español',
                'fr' => 'Français',
                'it' => 'Italiano',  
                'ja' => '日本語',
                'ko' => '한국어',
                'nl' => 'Dutch', 
                'pt' => 'Português',
                'ru' => 'Русский',
                'zh_cn' => '简体中文',
                'zh_tw' => '繁體中文',
                'ar' => 'العربية',
                'id' => 'Indonesian',
                'ms' => 'Malay',
                'vi' => 'Vietnamese',
                'th' => 'ภาษาไทย',
                'pl' => 'Polski'
              ];
            ?>
            <li class="li__with_items current_language"> <img src="<?php echo plugin_dir_url( $file ) . 'wp-plugin-ts-aside/public/img/' .  ( $langArr[$_COOKIE['userLanguage']] ? $langArr[$_COOKIE['userLanguage']] : 'English') . '.svg' ?>" alt=""><a href="#"><?php echo $langArr[$_COOKIE['userLanguage']] ? $langArr[$_COOKIE['userLanguage']] : 'English' ?></a></li>
            <li> 
              <ul class="languages_dropdown">
                <?php
                  $langShort = json_decode(json_encode($readyLanguages), true);
                  for($i = 0; $i < count($langShort); $i++){
                    ?>
                    <li> 
                      <img src="<?php echo plugin_dir_url( $file ) . 'wp-plugin-ts-aside/public/img/' .  $langArr[ $langShort[$i]['lang_id'] ] . '.svg' ?>" alt="">
                      <a href="#"><?php echo $langArr[ $langShort[$i]['lang_id'] ] ?></a>
                    </li>
                <?php
                  }
                ?>
              </ul>
            </li>
          </ul>
          <?php if($_COOKIE['userID']){?>
            <a href="<?php echo $result_top_panel[0]->logout_link ?>"><?php echo $result_top_panel[0]->logout ?></a>
          <?php }else {?>
            <ul class="login_block">
              <li>
                <a id="LoginPopUp" href="<?php echo $result_top_panel[0]->login_link ?>"><?php echo $result_top_panel[0]->login ?></a>
              </li>
              <li>
                <a id="OpenPopUp" class="sign_in" href="<?php echo $result_top_panel[0]->open_link ?>"><?php echo $result_top_panel[0]->open ?></a>
              </li>
            </ul>
          <?php } ?>
      </div>
    <a class="top_section__logo" href="<?php echo $result_general[0]->logo_link; ?>"><img src="<?php echo ( $_COOKIE['theme'] == 'dark' ? $result_general[0]->img_top : $result_general[0]->img_top_white); ?>" alt=""></a>
      <div class="top-section-align-block">
        <div class="top-section__burger">
          <div id="top_section_cross"></div>
          <ul class="top-section__navigation">
            <?php if($_COOKIE['userID']){?>
              <li> 
                <a href="<?php echo $result_top_panel[0]->my_acc_link ?>"><?php echo $result_top_panel[0]->my_acc ?></a>
              </li>
            <?php }?>
            <?php
              $top_menu = json_decode($result_top_panel[0]->menu_items, true);
              $top_links = json_decode($result_top_panel[0]->menu_links, true);

              if ($top_menu && $top_menu != " "){
                for($i = 0; $i < count($top_menu); $i++ ){
                  ?>
                    <li> 
                      <a href="<?php echo $top_links[$i] ?>"><?php echo $top_menu[$i] ?></a>
                    </li>
                  <?php
                }
              }
            ?>
          </ul>
          <?php if ($_COOKIE['userID']) { ?>
            <ul class="modes">
              <li class="getLoginPopUp">
                <a href="<?php echo $result_top_panel[0]->deposit_link; ?>"><?php echo $result_top_panel[0]->deposit; ?></a>
              </li>
            </ul>
          <?php } ?>
        </div>
          <div id="time_lang" style="display: flex; align-items: center; justify-content: center;">  
              <div class="time_block">
              <svg id="Capa_1" enable-background="new 0 0 443.294 443.294" height="" viewBox="0 0 443.294 443.294" width="512" xmlns="http://www.w3.org/2000/svg">
                <path fill="var(--clock-color)" d="m221.647 0c-122.214 0-221.647 99.433-221.647 221.647s99.433 221.647 221.647 221.647 221.647-99.433 221.647-221.647-99.433-221.647-221.647-221.647zm0 415.588c-106.941 0-193.941-87-193.941-193.941s87-193.941 193.941-193.941 193.941 87 193.941 193.941-87 193.941-193.941 193.941z"/>
                <path fill="var(--clock-color)" d="m235.5 83.118h-27.706v144.265l87.176 87.176 19.589-19.589-79.059-79.059z"/>
              </svg>
              <span id="time">13:15:12</span><small id="timeZone">TIME ZONE </small>
            </div>
              <ul class="languages">
                <?php 
                  $langArr = [
                    'en' => 'English',
                    'de' => 'Deutsch',
                    'es' => 'Español',
                    'fr' => 'Français',
                    'it' => 'Italiano',  
                    'ja' => '日本語',
                    'ko' => '한국어',
                    'nl' => 'Dutch', 
                    'pt' => 'Português',
                    'ru' => 'Русский',
                    'zh_cn' => '简体中文',
                    'zh_tw' => '繁體中文',
                    'ar' => 'العربية',
                    'id' => 'Indonesian',
                    'ms' => 'Malay',
                    'vi' => 'Vietnamese',
                    'th' => 'ภาษาไทย',
                    'pl' => 'Polski'
                  ];
                ?>
                <li class="li__with_items current_language"> <img src="<?php echo plugin_dir_url( $file ) . 'wp-plugin-ts-aside/public/img/' .  ( $langArr[$_COOKIE['userLanguage']] ? $langArr[$_COOKIE['userLanguage']] : 'English') . '.svg' ?>" alt=""><a href="#"><?php echo $langArr[$_COOKIE['userLanguage']] ? $langArr[$_COOKIE['userLanguage']] : 'English' ?></a></li>
                <li> 
                  <ul class="languages_dropdown">
                    <?php
                      $langShort = json_decode(json_encode($readyLanguages), true);
                      for($i = 0; $i < count($langShort); $i++){
                        ?>
                        <li> 
                          <img src="<?php echo plugin_dir_url( $file ) . 'wp-plugin-ts-aside/public/img/' .  $langArr[ $langShort[$i]['lang_id'] ] . '.svg' ?>" alt="">
                          <a href="#"><?php echo $langArr[ $langShort[$i]['lang_id'] ] ?></a>
                        </li>
                    <?php
                      }
                    ?>
                  </ul>
                </li>
              </ul>
              <?php if($_COOKIE['userID']){ ?>
                <ul class="user-block">
                  <li>
                    <?php if ($GLOBALS['resultObj']){
                      ?>
                      <div class="user-info">
                        <span><?php echo $GLOBALS['resultObj']->firstName . ' ' . $GLOBALS['resultObj']->lastName ; ?></span>
                        <?php

                          $statusImg;

                          if ($GLOBALS['pracideMode'] == 1 && $result_general[0]->show_account == '1'){
                            $statusImg = 'badge-demo-practice.png';
                          }else if ($GLOBALS['pracideMode'] == 0){
                            if ($GLOBALS['documentsVerified'] == 1){
                              switch ($GLOBALS['accountLevel']) {
                                case 0:
                                  $statusImg = 'badge-none.png';
                                  break;
                                case 1:
                                  $statusImg = 'badge-blue.png';
                                  break;
                                case 2:
                                  $statusImg = 'badge-bronze.png';
                                  break;
                                case 3:
                                  $statusImg = 'badge-silver.png';
                                  break;
                                case 4:
                                  $statusImg = 'badge-gold.png';
                                  break;
                                case 5:
                                  $statusImg = 'badge-platinum.png';
                                  break;
                              }
                            }else if ($result_general[0]->show_documents == '1'){
                              $statusImg = 'badge-not-verified-grey.png';
                            }
                          }
                         ?>
                        <img src="<?php echo plugins_url("", __FILE__) . '/img/' . $statusImg ; ?>" alt="">
                      </div>
                      <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 540.4 540.3">
                        <g>
                          <path fill="var(--clock-color)" d="M306,381.1A91.1,91.1,0,1,0,215,290,91.3,91.3,0,0,0,306,381.1Z" transform="translate(-35.8 -40.3)"/>
                          <path fill="var(--clock-color)" d="M379.7,382.6c-20.5,16-46.3,25.8-73.6,25.8a117.6,117.6,0,0,1-72.9-25c-82,41.7-94.1,116.2-95.6,138.2,46.3,37.2,104.8,59.2,169.4,59.2a270.5,270.5,0,0,0,169.2-59.9C473.8,497.2,460.9,424.3,379.7,382.6Z" transform="translate(-35.8 -40.3)"/>
                          <path fill="var(--clock-color)" d="M306,40.3C157.3,40.3,35.8,161.8,35.8,310.5A265,265,0,0,0,113.3,498c6.8-35.7,29.6-96.4,100.1-135.8-15.2-20.5-25-45.5-25-72.9a118.4,118.4,0,0,1,236.8,0c0,27.3-9.1,53.1-25,72.9C470,401.6,492.8,462.3,500.3,498a268.4,268.4,0,0,0,75.9-187.5C576.2,161.8,454.8,40.3,306,40.3Z" transform="translate(-35.8 -40.3)"/>
                        </g>
                      </svg>
                    <?php } ?>
                  </li>
                  <li>
                    <ul class="dropdown"> 
                      <li> <a href="<?php echo $result_top_panel[0]->logout_link ?>"><?php echo $result_top_panel[0]->logout ?></a></li>  
                    </ul>
                  </li>
                </ul>
              <?php }else {
                ?>  
                  <ul class="login_block">
                    <li>
                      <a id="LoginPopUp" href="<?php echo $result_top_panel[0]->login_link ?>"><?php echo $result_top_panel[0]->login ?></a>
                    </li>
                    <li>
                      <a id="OpenPopUp" class="sign_in" href="<?php echo $result_top_panel[0]->open_link ?>"><?php echo $result_top_panel[0]->open ?></a>
                    </li>
                  </ul>
                <?php
              } ?>
          </div>
        <div id="top_section_burger"></div>
        </div>
      </div>
  <aside class="ts-aside aside__hide" id="aside">
      <div class="ts-aside aside__content">
        <div class="top_section"> 
          <?php if (!$result_general[0]->hide_theme_switcher){ ?>
            <div class="theme_switcher" id="switch_theme">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 45.16 45.16" style="enable-background:new 0 0 45.16 45.16;" xml:space="preserve">
              <g>
                <g>
                  <path d="M22.58,11.269c-6.237,0-11.311,5.075-11.311,11.312s5.074,11.312,11.311,11.312c6.236,0,11.311-5.074,11.311-11.312
                    S28.816,11.269,22.58,11.269z" fill="var(--theme-color)"/>
                  <g>
                    <g>
                      <path d="M22.58,7.944c-1.219,0-2.207-0.988-2.207-2.206V2.207C20.373,0.988,21.361,0,22.58,0c1.219,0,2.207,0.988,2.207,2.207
                        v3.531C24.787,6.956,23.798,7.944,22.58,7.944z" fill="var(--theme-color)"/>
                    </g>
                    <g>
                      <path d="M22.58,37.215c-1.219,0-2.207,0.988-2.207,2.207v3.53c0,1.22,0.988,2.208,2.207,2.208c1.219,0,2.207-0.988,2.207-2.208
                        v-3.53C24.787,38.203,23.798,37.215,22.58,37.215z" fill="var(--theme-color)"/>
                    </g>
                    <g>
                      <path d="M32.928,12.231c-0.861-0.862-0.861-2.259,0-3.121l2.497-2.497c0.861-0.861,2.259-0.861,3.121,0
                        c0.862,0.862,0.862,2.26,0,3.121l-2.497,2.497C35.188,13.093,33.791,13.093,32.928,12.231z" fill="var(--theme-color)"/>
                    </g>
                    <g>
                      <path d="M12.231,32.93c-0.862-0.863-2.259-0.863-3.121,0l-2.497,2.496c-0.861,0.861-0.862,2.26,0,3.121
                        c0.862,0.861,2.26,0.861,3.121,0l2.497-2.498C13.093,35.188,13.093,33.79,12.231,32.93z" fill="var(--theme-color)"/>
                    </g>
                    <g>
                      <path d="M37.215,22.58c0-1.219,0.988-2.207,2.207-2.207h3.531c1.219,0,2.207,0.988,2.207,2.207c0,1.219-0.988,2.206-2.207,2.206
                        h-3.531C38.203,24.786,37.215,23.799,37.215,22.58z" fill="var(--theme-color)"/>
                    </g>
                    <g>
                      <path d="M7.944,22.58c0-1.219-0.988-2.207-2.207-2.207h-3.53C0.988,20.373,0,21.361,0,22.58c0,1.219,0.988,2.206,2.207,2.206
                        h3.531C6.956,24.786,7.944,23.799,7.944,22.58z" fill="var(--theme-color)"/>
                    </g>
                    <g>
                      <path d="M32.928,32.93c0.862-0.861,2.26-0.861,3.121,0l2.497,2.497c0.862,0.86,0.862,2.259,0,3.12s-2.259,0.861-3.121,0
                        l-2.497-2.497C32.066,35.188,32.066,33.791,32.928,32.93z" fill="var(--theme-color)"/>
                    </g>
                    <g>
                      <path d="M12.231,12.231c0.862-0.862,0.862-2.259,0-3.121L9.734,6.614c-0.862-0.862-2.259-0.862-3.121,0
                        c-0.862,0.861-0.862,2.259,0,3.12l2.497,2.497C9.972,13.094,11.369,13.094,12.231,12.231z" fill="var(--theme-color)"/>
                    </g>
                  </g>
                </g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              </svg>
            </div>
          <?php } ?>
          <div class="aside_toggler closed" id="toggle_aside"></div>
        </div>
        <?php if (($result_general[0]->img && $result_general[0]->img != " " && $result_general[0]->img != "_") || $result_general[0]->img_white){ ?>
          <div class="logo"> <img src="<?php echo ( $_COOKIE['theme'] == 'dark' ? $result_general[0]->img : $result_general[0]->img_white); ?>" alt=""></div>
        <?php } ?> 
        <nav> 
          <ul> 
            <?php
              $name = json_decode($result_aside[0]->menu, true);
              $menu_link = json_decode($result_aside[0]->menu_link, true);
              $subname = json_decode($result_aside[0]->submenu, true);
              $links = json_decode($result_aside[0]->link, true);
              $icons = json_decode($result_aside[0]->icon, true);
              $sub_icons = json_decode($result_aside[0]->sub_icon, true);

              for($i = 0; $i < count($name); $i++){
                ?>
                  <?php if ($i > 2 || $_COOKIE['userID']) { ?>
                  <li>
                    <ul>
                      <li>
                          <img src="<?php echo $icons[$i] ?>" alt="">
                        <?php 
                          if($menu_link[$i] && $menu_link[$i] != " "){
                            ?>
                            <a href="<?php echo $menu_link[$i]?>"><?php echo $name[$i]; ?></a>
                            <?php
                          } else {
                            ?>
                              <span><?php echo $name[$i]; ?></span>
                            <?php
                          }
                        ?>
                      </li>
                      <?php 
                        if ($subname[$i]){
                          for($j = 0; $j < count($subname[$i]); $j++){
                            ?>
                            <?php  if ($subname[$i][$j] != " "){ ?>
                              <li>
                                <a href="<?php echo $links[$i][$j]; ?>"><?php echo $subname[$i][$j]; ?></a> 
                              </li>
                            <?php
                            }
                          }
                        }
                      ?>
                    </ul>
                  </li>
                <?php
                 }
              } 
            ?>
          </ul>
        </nav>
        <?php if ($result_aside[0]->dwnld_text){ ?>
          <div class="download">
            <div class="cross" id="closeDownload"></div>
            <p><?php echo $result_aside[0]->dwnld_title ?></p>
            <p><?php echo $result_aside[0]->dwnld_text ?>.</p><img src="<?php echo wp_get_attachment_image_url( $result_general[0]->dwnld_img ); ?>" alt="">
          </div>
        <?php } ?>
        <?php if ($result_general[0]->img_with_link){ ?>
          <div class="img_with_link">
            <?php if ($result_general[0]->img_with_link_link){ ?>
              <a target="_blanc" href="<?php echo $result_general[0]->img_with_link_link ?>"><img src="<?php echo wp_get_attachment_image_url( $result_general[0]->img_with_link ); ?>" alt=""></a>
            <?php }else{ ?>
              <img src="<?php echo wp_get_attachment_image_url( $result_general[0]->img_with_link ); ?>" alt="">
            <?php } ?>
          </div>
        <?php } ?>
        <?php if ($result_general[0]->login_link){ ?>
          <div class="logout">
            <?php if ($result_general[0]->login_img){ ?>
              <img src="<?php echo wp_get_attachment_image_url( $result_general[0]->login_img ); ?>" alt="">
            <?php } ?>
            <a href="<?php echo $result_general[0]->login_link ?>"><?php echo $result_aside[0]->login_text ?></a>
          </div>
        <?php } ?>
        <?php if ($result_general[0]->log_link){ ?>
          <div class="logout">
            <?php if ($result_general[0]->login_img){ ?>
              <img src="<?php echo wp_get_attachment_image_url( $result_general[0]->log_img ); ?>" alt="">
            <?php } ?>
            <a href="<?php echo $result_general[0]->log_link ?>"><?php echo $result_aside[0]->log_text ?></a>
          </div>
        <?php } ?>
    </aside>
    <!-- Login popup -->
    <div id="loginPopUp__wrapper" >
      <script>
        var widget_color_dark = '<?php echo $result_general[0]->dark_theme_widget; ?>';
        var widget_color_light = '<?php echo $result_general[0]->light_theme_widget; ?>';
      </script>
      <div id="bpwidgets_popup">
            
      </div>
      <div id="bpwidgets_popup_login"></div>
      <script>  
        var theme_widget_login; 
        if ( getCookie('theme') == 'light' ) { theme_widget_login = '<?php echo $result_general[0]->light_theme_widget; ?>' } else { theme_widget_login = '<?php echo $result_general[0]->dark_theme_widget; ?>' }
        bpApp({
          apiHost: 'https://bpw.<?php echo $result_general[0]->api_host;  ?>',
          themeSet: theme_widget_login, 
          lang: getCookie('userLanguage').split('_').join('-'),
          state: 'wowMain.login',
          redirectSuccess: '<?php echo get_site_url(); ?>',
          redirectFailure: '<?php echo get_site_url(); ?>'
        }).render('#bpwidgets_popup_login')
      </script>
      <!-- SignUp popup -->
      <div id="bpwidgets_popup_signup"></div>
      <script>  
          var theme_widget_login; 
          if ( getCookie('theme') == 'light' ) { theme_widget_login = '<?php echo $result_general[0]->light_theme_widget; ?>' } else { theme_widget_login = '<?php echo $result_general[0]->dark_theme_widget; ?>' }
          bpApp({
            apiHost: 'https://bpw.<?php echo $result_general[0]->api_host;  ?>',
            themeSet: theme_widget_login, 
            lang: getCookie('userLanguage').split('_').join('-'),
            state: 'wowMain.register',
            redirectSuccess: '<?php echo get_site_url(); ?>',
            redirectFailure: '<?php echo get_site_url(); ?>'
          }).render('#bpwidgets_popup_signup')
        </script>

    </div>

    <?php if ( $atts ) { 
        // text page
        if  ( $atts['state'] == 'text'){ ?>
          <div class="text__page">
            <?php echo $content; ?>
          </div>
      <?php } else
          // faq page
          if ( $atts['state'] == 'faq' ){ ?>
          <div class="faq__page">
          <?php 
            $FAQ_section = $wpdb->get_results('SELECT * FROM `wp_aside_faq` WHERE `lang_id` = "' . $lang  . '" ORDER BY `id` desc limit 1');
            $questions = json_decode($FAQ_section[0]->questions, true);
            $answers = json_decode($FAQ_section[0]->answers, true);

            $questions_fx = json_decode($FAQ_section[0]->questions_fx, true);
            $answers_fx = json_decode($FAQ_section[0]->answers_fx, true);
          ?>
            <div class="faq__page-navigation" >
              <ul>
                <?php if ($questions && $questions_fx){ ?>
                 <li class='active' id="simple_faq">
                  <a href="#">Simple trader</a>
                </li>
                <li id="fx_faq">
                  <a href="#">FX Trading</a>
                </li>
                <?php }else if ($questions){ ?>
                  <li class='active solo' id="simple_faq">
                    <a href="#">Simple trader</a>
                 </li>
                <?php }else if ($questions_fx){ ?>
                  <li id="fx_faq" class="solo active">
                  <a href="#">FX Trading</a>
                </li>
                <?php } ?>
              </ul>
            </div>

            <?php if ($questions){ ?>

            <div class="faq__page-content" <?php if ($questions && $questions_fx){ echo 'id="simple_content"'; } ?> >
                <?php for($i = 0; $i < count($questions); $i++){ ?>
                  <div class="faq__container-content-item <?php if ($i == 0){ echo 'with_answer'; } ?>">
                    <div class="answer_toggler"></div>
                    <h2 class="main-text"><?php echo $questions[$i] ?></h2>
                    <div class="faq__container-content-item_answer">
                        <p class="small-text"><?php echo $answers[$i] ?></p>
                    </div>
                  </div>
                <?php } ?>
            </div>

            <?php } ?>

            <?php if ($questions_fx){ ?>

              <div class="faq__page-content <?php if ($questions && $questions_fx){ echo 'hidded'; } ?>" <?php if ($questions && $questions_fx){ echo 'id="fx_content"'; } ?>>
                  <?php for($i = 0; $i < count($questions_fx); $i++){ ?>
                    <div class="faq__container-content-item <?php if ($i == 0){ echo 'with_answer'; } ?>">
                      <div class="answer_toggler"></div>
                      <h2 class="main-text"><?php echo $questions_fx[$i] ?></h2>
                      <div class="faq__container-content-item_answer">
                          <p class="small-text"><?php echo $answers_fx[$i] ?></p>
                      </div>  
                    </div>
                  <?php } ?>
              </div>

              <?php } ?>
          </div>
        <?php  } else 
          if  ( strpos($atts['state'], 'http') === 0){ ?>
            <div>
              <img style="width: 100%; height: 100%;" src="<?php echo $atts['state'] ?>" alt="img">
            </div>
         <?php } else
         // Simple platform page
          if ( $atts['state'] == "options" ){ ?>
            <div id="optionsContainer"></div>
            <script type="text/javascript">
              optionsApp({
                apiHost: 'https://trading.<?php echo $result_general[0]->api_host; ?>',
                lang: getCookie('userLanguage').split('_').join('-'),
                hideHeader: true,
              }).render('#optionsContainer');
            </script>
          <?php } 
          if ( $atts['state'] == "demo" ){ ?>
            <?php include 'demo.php' ?>
          <?php }
          else if ( $atts['state'] ) { ?>
          <!-- Widgets popups -->
            <div id="bpwidgets"></div>
            <script>
              var theme_widget; 
              if ( getCookie('theme') == 'light' ) { theme_widget = '<?php echo $result_general[0]->light_theme_widget; ?>' } else { theme_widget = '<?php echo $result_general[0]->dark_theme_widget; ?>' }
              bpApp({
                apiHost: 'https://bpw.<?php echo $result_general[0]->api_host;  ?>',
                themeSet: theme_widget, 
                lang: getCookie('userLanguage').split('_').join('-'),
                state: <?php echo "'" . $atts['state'] . "'"; ?>,
                redirectSuccess: '<?php echo get_site_url(); ?>',
                redirectFailure: '<?php echo get_site_url(); ?>'
              }).render('#bpwidgets');
            </script>
        <?php  }  ?>
        <?php } else {  ?>
        <!-- FX & CFD platform page -->
          <div id="bpfxcfd"></div>
          <script type="text/javascript">
            var theme; 
            if ( getCookie('theme') == 'light' ) { theme = '<?php echo $result_general[0]->light_theme_platform; ?>' } else { theme = '<?php echo $result_general[0]->dark_theme_platform; ?>' }
            tsApp({
              apiHost: 'https://fx-trading.<?php echo $result_general[0]->api_host;  ?>',
              themeSet: theme,
              lang: getCookie('userLanguage').split('_').join('-'),
            }).render('#bpfxcfd');
          </script>
        <?php } ?>
      
      <footer class="footer">
          <div class="footer_content">
            <p><?php echo $result_footer[0]->footer_content ?></p>
          </div>
      </footer>
  </div>  