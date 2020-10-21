<?php 

class GeneralClass{

    const table = 'wp_tradesmarter_aside';
    const version = '1.0';
    const titleName = 'Tradesmarter plugin';

    public static function install()
    {
        global $wpdb;
        global $wp_summary_db_version;

        $ptbd_table_name = "wp_aside_general";

        $wp_summary_db_version = self::version;

        if ($wpdb->get_var("SHOW TABLES LIKE 'wp_aside_general'" ) != $ptbd_table_name ) {
            $sql  = 'CREATE TABLE '. 'wp_aside_general' .' (
                id INT(20) AUTO_INCREMENT,
                api_host VARCHAR(255),
                logo_link VARCHAR(255),
                img VARCHAR(255),
                img_white VARCHAR(255),
                img_top VARCHAR(255),
                img_top_white VARCHAR(255),
                switch_btn_color VARCHAR(255),
                active_link VARCHAR(255),
                active_link_light VARCHAR(255),
                color_dark VARCHAR(255),    
                color_light VARCHAR(255),
                dark_bg VARCHAR(255),
                light_bg VARCHAR(255),
                title_color_text_page VARCHAR(255),
                paragraph_color_text_page VARCHAR(255),
                title_color_text_page_light VARCHAR(255),
                paragraph_color_text_page_light VARCHAR(255),
                dwnld_img VARCHAR(255),
                log_img VARCHAR(255),
                log_link VARCHAR(255),
                login_img VARCHAR(255),
                login_link VARCHAR(255),
                img_with_link VARCHAR(255),
                img_with_link_link VARCHAR(255),
                hide_left_panel TINYINT(1), 
                hide_top_panel TINYINT(1), 
                hide_theme_switcher TINYINT(1), 
                show_documents TINYINT(1), 
                show_account TINYINT(1), 
                default_theme VARCHAR(255),
                light_theme_platform VARCHAR(255),
                dark_theme_platform VARCHAR(255),
                light_theme_widget VARCHAR(255),
                dark_theme_widget VARCHAR(255),
                default_language VARCHAR(255),
                dwnld_block_backgorund_color VARCHAR(255),
                dwnld_block_backgorund_dark_color VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id))';
            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            
            dbDelta($sql);

            update_option('wp_tradesmarter_aside_tables_created', true);

            add_option('wp_tradesmarter_aside_db_version', $wp_summary_db_version);

            $wpdb->insert(
                "wp_aside_general", 
                array(
                    'logo_link' => get_site_url(),
                    'img' => plugin_dir_url( __FILE__ ) . '/public/img/logo.png',
                    'img_white' => plugin_dir_url( __FILE__ ) . '/public/img/logo.png',
                    'img_top' => plugin_dir_url( __FILE__ ) . '/public/img/trade-Logo.png',
                    'img_top_white' => plugin_dir_url( __FILE__ ) . '/public/img/trade-Logo.png',
                    'switch_btn_color' => "#07fe76",
                    'color_dark' => '#ffffff',
                    'color_light' => '#000000',
                    'active_link' => 'rgb(0, 128, 0)',	
                    'active_link_light' => 'rgb(0, 0, 0)',
                    'dark_bg' => 'rgb(10, 20, 28)', 
                    'light_bg' => '#ffffff',
                    'title_color_text_page' => '#90B550',
                    'paragraph_color_text_page' => '#808080',
                    'title_color_text_page_light' => '#90B550',
                    'paragraph_color_text_page_light' => '#808080',
                    'hide_left_panel' => '0',
                    'hide_top_panel' => '0',
                    'hide_theme_switcher' => '0',
                    'show_documents' => '1',
                    'show_account' => '1',
                    'light_theme_platform' => 'white-blue',
                    'dark_theme_platform' => 'black-green',
                    'light_theme_widget' => 'white-green',
                    'dark_theme_widget' => 'black-green',
                    'default_language' => 'en',
                    'dwnld_block_backgorund_color' => '#07fe76',
                    'dwnld_block_backgorund_dark_color' => '#3a4144'
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

    public static function uninstall()
    {
      
    }

    public static function addMenuItem()
    {
        add_menu_page(
            self::titleName,
            'Tradesmarter setting',
            'manage_options',
            'aside',
            array('GeneralClass', 'renderGeneralSettings')
        );
    }

    public static function shortcodeHandler( $atts, $content = null )
    {
        $html_string = include('public/aside.php');

        return $html_string;
    }


    public static function renderGeneralSettings()
    {
        include('admin/general-admin.php');

        self::sendData();
    }

    public static function sendData(){

        global $wpdb;

        $API_host = $_POST['api_host'];
        $Logo_link = $_POST['logo_link'];
        $DBP_logo = $_POST['logo'];
        $DBP_logo_white = $_POST['logo_white'];
        $DBP_logo_top = $_POST['logo_top'];
        $DBP_logo_top_white = $_POST['logo_top_white'];
        $switch_btn_color = $_POST['switch_btn_color'];
        $active_color = $_POST['color-active'];
        $active_color_light = $_POST['color-active-light'];
        $dark_bg = $_POST['color-bg-dark'];
        $light_bg = $_POST['color-bg-light'];
        $dwnld_img = $_POST['dwnld_img'];
        $log_img = $_POST['log_img'];
        $log_link = $_POST['log_link'];
        $login_img = $_POST['login_img'];
        $login_link = $_POST['login_link'];
        $color_dark = $_POST['color-dark'];
        $color_light = $_POST['color-light'];
        $title_color_text_page = $_POST['title_color_text_page'];
        $paragraph_color_text_page = $_POST['paragraph_color_text_page'];
        $title_color_text_page_light = $_POST['title_color_text_page_light'];
        $paragraph_color_text_page_light = $_POST['paragraph_color_text_page_light'];
        $img_with_link = $_POST['img_with_link'];
        $img_with_link_link = $_POST['img_with_link_link'];
        $hide_left_panel = $_POST['hide_left_panel'];
        $hide_top_panel = $_POST['hide_top_panel'];
        $hide_theme_switcher = $_POST['hide_theme_switcher'];
        $show_documents = $_POST['show_documents'];
        $show_account = $_POST['show_account'];
        $default_theme = $_POST['default_theme'];
        $light_theme_platform =  $_POST['light_theme_platform'];
        $dark_theme_platform = $_POST['dark_theme_platform'];
        $light_theme_widget = $_POST['light_theme_widget'];
        $dark_theme_widget = $_POST['dark_theme_widget'];
        $default_language = $_POST['default_language'];
        $dwnld_block_backgorund_color = $_POST['dwnld_block_backgorund_color'];
        $dwnld_block_backgorund_dark_color = $_POST['dwnld_block_backgorund_dark_color'];

        if (isset($_POST['submit'])){
            $wpdb->update(
                "wp_aside_general", 
                array(
                    'api_host' => $API_host,
                    'logo_link' => $Logo_link,
                    'img' => $DBP_logo,
                    'img_white' => $DBP_logo_white,
                    'img_top' => $DBP_logo_top,
                    'img_top_white' => $DBP_logo_top_white,
                    'switch_btn_color' => $switch_btn_color,
                    'color_dark' => $color_dark,
                    'color_light' => $color_light,
                    'active_link' => $active_color,	
                    'active_link_light' => $active_color_light,
                    'dark_bg' => $dark_bg,
                    'light_bg' => $light_bg,
                    'title_color_text_page' => $title_color_text_page,
                    'paragraph_color_text_page' => $paragraph_color_text_page,
                    'title_color_text_page_light' => $title_color_text_page_light,
                    'paragraph_color_text_page_light' => $paragraph_color_text_page_light,
                    'dwnld_img' => $dwnld_img,
                    'log_img' => $log_img,
                    'log_link' => $log_link,
                    'login_img' => $login_img,
                    'login_link' => $login_link,
                    'img_with_link' => $img_with_link,
                    'img_with_link_link' => $img_with_link_link,
                    'hide_left_panel' => $hide_left_panel,
                    'hide_top_panel' => $hide_top_panel,
                    'hide_theme_switcher' => $hide_theme_switcher,
                    'show_documents' => $show_documents,
                    'show_account' => $show_account,
                    'default_theme' => $default_theme,
                    'light_theme_platform' => $light_theme_platform,
                    'dark_theme_platform' => $dark_theme_platform,
                    'light_theme_widget' => $light_theme_widget,
                    'dark_theme_widget' => $dark_theme_widget,
                    'default_language' => $default_language,
                    'dwnld_block_backgorund_color' => $dwnld_block_backgorund_color,
                    'dwnld_block_backgorund_dark_color' => $dwnld_block_backgorund_dark_color
                ),
                array(
                    'id' => '1'
                )
            );
        }
    }
}