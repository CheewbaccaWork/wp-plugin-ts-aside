<?php 

class TopPanelClass{ 
    const table = 'wp_tradesmarter_top_panel';
    const version = '1.0';
    const titleName = 'Tradesmarter plugin';

    public static function install()
    {
        global $wpdb;
        global $wp_summary_db_version;
        $ptbd_table_name = 'wp_tradesmarter_top_panel';

        $wp_summary_db_version = self::version;

        if ($wpdb->get_var("SHOW TABLES LIKE '". $ptbd_table_name . "'"  ) != $ptbd_table_name  ) {
            $sql  = 'CREATE TABLE ' . 'wp_tradesmarter_top_panel' .  ' (
                id INT(20) AUTO_INCREMENT,
                lang_id text,
                my_acc VARCHAR(255),
                my_acc_link VARCHAR(255),
                menu_items text,
                menu_links VARCHAR(255),
                deposit VARCHAR(255),
                deposit_link VARCHAR(255),
                real_name VARCHAR(255),
                real_name_link VARCHAR(255),    
                logout VARCHAR(255),
                logout_link VARCHAR(255),
                login VARCHAR(255),
                login_link VARCHAR(255),
                open VARCHAR(255),
                open_link VARCHAR(255),
                languages_img VARCHAR(255),
                language VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id))';
            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            
            dbDelta($sql);

            update_option('wp_tradesmarter_aside_tables_created', true);    

            add_option('wp_tradesmarter_aside_db_version', $wp_summary_db_version);

            $lang_temp = (string) 'en';

            $wpdb->insert(
                "wp_tradesmarter_top_panel", 
                array(
                    'lang_id' => $lang_temp,
                    'my_acc' => 'Accounts',
                    'my_acc_link' => 'wowMain.dashboard.container',
                    'menu_items' => json_encode(['Trade', 'Simple']),
                    'menu_links' => json_encode([get_site_url() , get_site_url() . '/simple']),
                    'deposit' => 'Deposit',
                    'real_name' => 'Open Real Account',
                    'logout' => 'logout',
                    'logout_link' => 'https://bpw.brokers-domain.com/index/sign-out?redirectUrl=https://client.brokers-domain.com',
                    'login' => 'Login',
                    'login_link' => 'wowMain.login',
                    'open' => 'Open an Account',
                    'open_link' => 'wowMain.register',
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
                    '%s',
                    '%s',
                    '%s'         
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
            'Top Panel settings',
            'Top Panel settings',
            'manage_options',
            'TopPanel',
            array('TopPanelClass', 'renderTopPanelSetting')
        );
    }

    public static function renderTopPanelSetting()
    {
        include('admin/top_panel-admin.php');

        self::sendData();
    }

    public static function sendData(){
        global $wpdb;
        $ptbd_table_name = 'wp_tradesmarter_top_panel';

        $menu_items = array();
        $menu_links = array();
        $my_acc = $_POST['my_acc'];
        $my_acc_link = $_POST['my_acc_link'];
        $deposit = $_POST['deposit'];
        $real = $_POST['real'];
        $deposit_link = $_POST['deposit_link'];
        $real_link = $_POST['real_name_link'];
        $login = $_POST['login'];
        $login_link = $_POST['login_link'];
        $open = $_POST['open'];
        $open_link = $_POST['open_link'];
        $logout = $_POST['logout'];
        $logout_link = $_POST['logout_link'];

        if ( isset($_POST['menu-item']) ){
            foreach($_POST['menu-item'] as $key=>$value){
                array_push($menu_items, $value);
            }
        }

        if ( isset($_POST['menu-link']) ){
            foreach($_POST['menu-link'] as $key=>$value){
                array_push($menu_links, $value);
            }
        }

        $currentLanguage = $_REQUEST['language'] ? $_REQUEST['language'] : 'en' ;

        if ( isset($_GET['submit_lang']) ){
            $isExists = $wpdb->get_var("SELECT `id` FROM `wp_tradesmarter_top_panel` WHERE `lang_id` = '" . $currentLanguage . "'");

            if(!$isExists){
                $wpdb->insert(
                    "wp_tradesmarter_top_panel", 
                    array(
                        'lang_id' => $currentLanguage,
                        'my_acc' => 'Accounts',
                        'my_acc_link' => 'wowMain.dashboard.container',
                        'menu_items' => json_encode(['Trade', 'Simple']),
                        'menu_links' => json_encode([get_site_url() , get_site_url() . '/simple']),
                        'deposit' => 'Deposit',
                        'real_name' => 'Open Real Account',
                        'logout' => 'logout',
                        'logout_link' => 'https://bpw.brokers-domain.com/index/sign-out?redirectUrl=https://client.brokers-domain.com',
                        'login' => 'Login',
                        'login_link' => 'wowMain.login',
                        'open' => 'Open an Account',
                        'open_link' => 'wowMain.register',
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
                        '%s',
                        '%s',
                        '%s'         
                    )
                );
            }
        }

        if (isset($_POST['submit'])){
            $isExists = $wpdb->get_var("SELECT `id` FROM `wp_tradesmarter_top_panel` WHERE `lang_id` = '" . $currentLanguage . "'");
            if(!$isExists){
                $wpdb->insert(
                    "wp_tradesmarter_top_panel", 
                    array(
                        'lang_id' => $currentLanguage,
                        'my_acc' => $my_acc,
                        'my_acc_link' => $my_acc_link,
                        'menu_items' => json_encode( $menu_items ),
                        'menu_links' => json_encode( $menu_links ),
                        'deposit' => $deposit,
                        'deposit_link' => $deposit_link,
                        'real_name_link' => $real_link,
                        'real_name' => $real,
                        'login' => $login,
                        'login_link' => $login_link,
                        'open' => $open,
                        'open_link' => $open_link,
                        'logout' => $logout,
                        'logout_link' => $logout_link
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
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                    )
                );
            } else {
                $wpdb->update(
                    "wp_tradesmarter_top_panel", 
                    array(
                        'menu_items' => json_encode( $menu_items ),
                        'menu_links' => json_encode( $menu_links ),
                        'my_acc' => $my_acc,
                        'my_acc_link' => $my_acc_link,
                        'deposit' => $deposit,
                        'real_name' => $real,
                        'deposit_link' => $deposit_link,
                        'real_name_link' => $real_link,
                        'login' => $login,
                        'login_link' => $login_link,
                        'open' => $open,
                        'open_link' => $open_link,
                        'logout' => $logout,
                        'logout_link' => $logout_link
                    ),
                    array(
                        'id' => $isExists
                    )
                );
            }
        }
    }

}