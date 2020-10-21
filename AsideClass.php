<?php 

class AsideClass{

    const table = 'wp_tradesmarter_aside';
    const version = '1.0';
    const titleName = 'Tradesmarter plugin';

    public static function install()
    {
        global $wpdb;
        global $wp_summary_db_version;

        $wp_summary_db_version = self::version;

        $ptbd_table_name = 'wp_tradesmarter_aside';

        if ($wpdb->get_var("SHOW TABLES LIKE '". $ptbd_table_name . "_test'"  ) != $ptbd_table_name . "_test" ) {
            $sql  = 'CREATE TABLE '. $ptbd_table_name . "_test" .' (
                id INT(20) AUTO_INCREMENT,
                lang_id VARCHAR(255),
                menu text,  
                menu_link VARCHAR(255),
                submenu text,   
                link text,
                icon text,
                dwnld_title VARCHAR(255),
                dwnld_text text,    
                log_text VARCHAR(255),
                login_text VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id))';
            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            dbDelta($sql);
            update_option('wp_tradesmarter_aside_tables_created', true);

            add_option('wp_tradesmarter_aside_db_version', $wp_summary_db_version);

            $imgArr = ['ico-dashboard.svg', 'ico-profile.svg', 'ico-accounts.svg', 'ico-trading.svg', 'ico-tools.svg', 'ico-education.svg', 'ico-terms.svg'];
            $defaultImages = [];

            foreach($imgArr as &$img){
                $defaultImages[] = plugin_dir_url( __FILE__ ) . '/public/img/' . $img ;
            }

            $link1 = preg_replace('/[^a-zA-Z0-9-]/', '', $string);

            $wpdb->insert(
                "wp_tradesmarter_aside_test", 
                array(
                    'lang_id' => 'en',
                    'menu' => json_encode(['Dashboard', 'Accounts', 'My Profile', 'Trading', 'Tools', 'Education', 'Terms & Privacy']),
                    'menu_link' => json_encode([get_site_url() . '/dashboard']),
                    'submenu' => json_encode(
                        [
                            [],
                            ['Trading Accounts', 'Add Funds', 'Withdrawal', 'Transfer funds', 'Add account', 'Transactions', 'Delete Account'], 
                            ['Edit Profile', 'Account Verification', 'Change Password', 'Mobile Verification', 'Privacy Center'],
                            ['Trades History', 'Trading Time'],  
                            ['News and updates'], 
                            ['How to videos'], 
                            ['Terms & conditions', 'Privacy'],
                        ]
                    ),
                    'link' => json_encode(
                        [
                            [],
                            [get_site_url() . '/trading-accounts', 'wowMain.banking.deposit' , 'wowMain.banking.withdrawal', 'wowMain.banking.transferFunds', 'wowMain.banking.addAccount', get_site_url() . '/transactions', get_site_url() . '/delete-account'],
                            [get_site_url() . '/edit-profile', get_site_url() . '/account-verification', get_site_url() . '/change-password', get_site_url() . '/mobile-verification', get_site_url() . '/privacy-center'],
                            [get_site_url() . '/#', get_site_url() . '/#'],
                            [get_site_url() . '/#'],
                            [get_site_url() . '/#'],
                            [get_site_url() . '/#', get_site_url() . '/#'],
                        ]
                    ),
                    'icon' => json_encode($defaultImages),
                    'dwnld_text' => '',
                ),
                array(  
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                )
            );
        }

        if ( self::my_plugin_is_current_version() ){
            self::upgrade();
        }
    }

    public static function upgrade()
    {
        

        update_option( 'my_plugin_version', self::version );
    }

    public static function my_plugin_is_current_version(){
        $version = get_option( 'my_plugin_version' );
        return version_compare( $version, self::version, '=') ? false : true;
    }

    public static function addMenuItem()
    {
        add_submenu_page(
            'aside',
            'Asside settings',
            'Left panel settings',
            'manage_options',
            'Settings',
            array('AsideClass', 'renderAsideSetting')
        );
    }

    public static function renderAsideSetting()
    {
        include('admin/aside-admin.php');

        self::sendData();
    }

    public static function sendData(){

        global $wpdb;
        $ptbd_table_name = 'wp_tradesmarter_aside';

        $temp = array();
        $temp_sub = array();
        $temp_menu_links = array();
        $temp_links = array();
        $temp_icon = array();
        $temp_sub_icon = array();
        $dwnld_title = $_POST['dwnld_title'];
        $dwnld_text = $_POST['dwnld_text'];
        $log_text = $_POST['log_text'];
        $login_text = $_POST['login_text'];

        if ($_POST['menu-item']){
            foreach($_POST['menu-item'] as $key=>$value){
                array_push($temp, $value);
            }
        }

        if ($_POST['menu-link']){
            foreach($_POST['menu-link'] as $key=>$value){
                array_push($temp_menu_links, $value);
            }
        }

        if ($_POST['submenu-item']){
            foreach($_POST['submenu-item'] as $key=>$value){
                array_push($temp_sub, $value);
            }
        }

        if ($_POST['submenu-link']){
            foreach($_POST['submenu-link'] as $key=>$value){
                array_push($temp_links, $value);
            }
        }

        if ($_POST['icon']){
            foreach($_POST['icon'] as $key=>$value){
                array_push($temp_icon, $value);
            }
        }

        $arr = json_encode($temp);
        $arr_menu_links = json_encode($temp_menu_links);
        $arr_sub = json_encode($temp_sub);
        $arr_icons = json_encode($temp_icon);
        $arr_sub_icons = json_encode($temp_sub_icon);
        $arr_links = json_encode($temp_links);

        $currentLanguage = $_REQUEST['language'] ? $_REQUEST['language'] : 'en' ;

        if ( isset($_GET['submit_lang'])){

            $isExists = $wpdb->get_var("SELECT `id` FROM `wp_tradesmarter_aside_test` WHERE `lang_id` = '" . $currentLanguage . "'");
            $maxID = $wpdb->get_var("SELECT MAX(ID) FROM `wp_tradesmarter_aside_test`");
            $maxID = $maxID + 1;

            if ( !$isExists ){
                $wpdb->query( "CREATE TEMPORARY TABLE `tmptable` SELECT * FROM `wp_tradesmarter_aside_test` WHERE `lang_id` = 'en' ");
                $wpdb->query( "UPDATE `tmptable` SET `id` = $maxID ");
                $wpdb->query( "UPDATE `tmptable` SET `lang_id` = '$currentLanguage' ");
                $wpdb->query( "INSERT INTO `wp_tradesmarter_aside_test` SELECT * FROM `tmptable` WHERE `id` = $maxID ");
                $wpdb->query( "DROP TEMPORARY TABLE IF EXISTS `tmptable`");
            }

        }

        if ( isset($_POST['remove_lang']) ){    
            $language_to_remove = $_POST['remove_lang'];
            $wpdb->query("DELETE FROM `wp_tradesmarter_aside_test` WHERE `lang_id` = '$language_to_remove'" );
        }   

        if ( isset($_POST['submit']) ){
            $isExists = $wpdb->get_var("SELECT `id` FROM `wp_tradesmarter_aside_test` WHERE `lang_id` = '" . $currentLanguage . "'");
            if(!$isExists){
                $wpdb->insert(
                    "wp_tradesmarter_aside_test", 
                    array(
                        'lang_id' => strval( $currentLanguage ),
                        'menu' => $arr,
                        'menu_link' => $arr_menu_links,
                        'submenu' => $arr_sub,
                        'link' => $arr_links,
                        'icon' => $arr_icons,
                        'dwnld_title' => $dwnld_title,
                        'dwnld_text' => html_entity_decode(stripslashes($dwnld_text),ENT_QUOTES,'UTF-8'),
                        'log_text' => $log_text,
                        'login_text' => $login_text,
                    ),
                    array(  
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                    )
                );
            } else {
                $wpdb->update(
                    "wp_tradesmarter_aside_test", 
                    array(
                        'menu' => $arr,
                        'menu_link' => $arr_menu_links,
                        'submenu' => $arr_sub,
                        'link' => $arr_links,
                        'icon' => $arr_icons,
                        'dwnld_title' => $dwnld_title,
                        'dwnld_text' => html_entity_decode(stripslashes($dwnld_text),ENT_QUOTES,'UTF-8'),
                        'log_text' => $log_text,
                        'login_text' => $login_text,
                    ),
                    array(
                        'id' => $isExists
                    )
                );
            }
        }
    }
}