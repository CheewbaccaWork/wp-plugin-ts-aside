<?php 

// General class include all general settings

class GeneralClass{

    // Table name for general settings
    const table = 'wp_tradesmarter_aside';
    const version = '1.0';
    const titleName = 'Tradesmarter plugin';

    // Install method 
    // Creates table in DB if not exists and insert default values

    public static function install()
    {
        global $wpdb;
        global $wp_summary_db_version;

        $ptbd_table_name = "wp_aside_general";

        $wp_summary_db_version = self::version;

        $row = $wpdb->get_row("SELECT * FROM wp_aside_general");

        // Create table if not exists, 
        // Here you can add new table rows

        // !Current rows: 

        // api_host - Api host
        // logo_link - link for top panel logo
        // img - Logo for dark theme
        // img_white - Logo for light theme
        // img_top - Top panel logo for dark theme
        // img_top_white - Top panel logo for light theme
        // img_top_mobile - Top panel mobile view row for dark theme
        // img_top_white_mobile - Top panel mobile view row for light theme
        // switch_btn_color - Background-color for deposit and open an account buttons dark theme
        // switch_btn_color_light - Background-color for deposit and open an account buttons light theme
        // switch_btn_color_text - Top panel deposit and open an account buttons dark theme text color
        // switch_btn_color_text_light - Top panel deposit and open an account buttons light theme text color
        // active_link - Active link / Hover color for dark theme
        // active_link_light - Active link / Hover color for light theme
        // color_dark - text color for dark theme
        // color_light - text color for light theme
        // dark_bg - general background-color for dark theme
        // light_bg - general background-color for light theme
        // .... 
        // dwnld_img - image for download block
        // log_img - icon near logout button in left panel
        // log_link - link for logout button in left panel
        // login_img - icon near login button in left panel
        // login_link - link for login button in left panel
        // ... 
        // show_documents - show or hide label if user do not confiremt documents
        // show_account - show or hide label of user account level
        // default_theme - dark / light
        // ...  


        if ($wpdb->get_var("SHOW TABLES LIKE 'wp_aside_general'" ) != $ptbd_table_name ) {
            $sql  = 'CREATE TABLE '. 'wp_aside_general' .' (
                id INT(20) AUTO_INCREMENT,
                api_host VARCHAR(255), 
                logo_link VARCHAR(255),
                img VARCHAR(255),
                img_white VARCHAR(255),
                img_top VARCHAR(255),
                img_top_white VARCHAR(255),
                img_top_mobile VARCHAR(255),
                img_top_white_mobile VARCHAR(255),
                switch_btn_color VARCHAR(255),
                switch_btn_color_light VARCHAR(255),
                switch_btn_color_text VARCHAR(255),
                switch_btn_color_text_light VARCHAR(255),
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
                footer_text_color VARCHAR(255),
                footer_link_color VARCHAR(255),
                footer_light_text_color VARCHAR(255),
                footer_light_link_color VARCHAR(255),
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
                hide_bottom_panel TINYINT(1),
                hide_languages TINYINT(1),
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

            // Insert default values in table rows 

            $wpdb->insert(
                "wp_aside_general", 
                array(
                    'logo_link' => get_site_url(),
                    'img' => plugin_dir_url( __FILE__ ) . '/public/img/logo.png',
                    'img_white' => plugin_dir_url( __FILE__ ) . '/public/img/logo.png',
                    'img_top' => plugin_dir_url( __FILE__ ) . '/public/img/trade-Logo.png',
                    'img_top_white' => plugin_dir_url( __FILE__ ) . '/public/img/trade-Logo.png',
                    'img_top_mobile' => plugin_dir_url( __FILE__ ) . '/public/img/logo.png',
                    'img_top_white_mobile' => plugin_dir_url( __FILE__ ) . '/public/img/logo.png',
                    'switch_btn_color' => "#07fe76",
                    'switch_btn_color_light' => "#07fe76",
                    'switch_btn_color_text' => "#ffffff",
                    'switch_btn_color_text_light' => "#000000",
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
                    'hide_bottom_panel' => '0',
                    'hide_languages' => '0',
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

        // Call to upgrade function if you need to update plugin and add new rows in table

        self::upgrade();
    }

    // Upgrade function to update tables and add new rows, or change existing

    public static function upgrade()
    {   
        //TODO: Don`t forget to remove this  

        global $wpdb;
        
        // if (!isset($row->hide_languages)) {
        //     $wpdb->query("ALTER TABLE wp_aside_general ADD hide_languages TINYINT");
        // }

        // if (!isset($row->footer_link_color)) {
        //     $wpdb->query("ALTER TABLE wp_aside_general ADD footer_link_color VARCHAR(255)");
        // }

        // if (!isset($row->footer_light_text_color)) {
        //     $wpdb->query("ALTER TABLE wp_aside_general ADD footer_light_text_color VARCHAR(255)");
        // }

        // if (!isset($row->footer_light_link_color)) {
        //     $wpdb->query("ALTER TABLE wp_aside_general ADD footer_light_link_color VARCHAR(255)");
        // } 

        if (!isset($row->hide_languages)) {
            $wpdb->query("ALTER TABLE wp_aside_general ADD hide_languages TINYINT(1) ");
        }

        // $wpdb->query("UPDATE wp_aside_general SET footer_text_color = '#ffffff'");
        // $wpdb->query("UPDATE wp_aside_general SET footer_link_color = '#07fe76'");
        // $wpdb->query("UPDATE wp_aside_general SET footer_light_text_color = '#000000'");
        // $wpdb->query("UPDATE wp_aside_general SET footer_light_link_color = '#07fe76'");
        // $wpdb->query("UPDATE wp_aside_general SET hide_bottom_panel = 0 ");
    }

    // Check plugins version

    public static function my_plugin_is_current_version(){
        $version = get_option( 'my_plugin_version' );
        return version_compare( $version, self::version, '=') ? false : true;
    }

    // Here you can add logic on "uninstall" wordpress event

    public static function uninstall()
    {
      
    }

    // addMenuItem function add Tradesmarter setting option in WP left menu
    // Render general-admin view for general settings

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
    
    // add plugins view to shortocode

    public static function shortcodeHandler( $atts, $content = null )
    {
        ob_start();

        $html_string = include('public/aside.php');

        $html_string = ob_get_clean();

        return $html_string;
    }

    // Render general-admin view for general settings 

    public static function renderGeneralSettings()
    {
        include('admin/general-admin.php');

        self::sendData();
    }

    // sendData function catch 'save' button and write fields values into DB table

    public static function sendData(){

        global $wpdb;

        $API_host = $_POST['api_host'];
        $Logo_link = $_POST['logo_link'];
        $DBP_logo = $_POST['logo'];
        $DBP_logo_white = $_POST['logo_white'];
        $DBP_logo_top = $_POST['logo_top'];
        $DBP_logo_top_white = $_POST['logo_top_white'];
        $logo_top_mobile = $_POST['logo_top_mobile'];
        $logo_top_mobile_white = $_POST['logo_top_mobile_white'];
        $switch_btn_color = $_POST['switch_btn_color'];
        $switch_btn_color_light = $_POST['switch_btn_color_light'];
        $switch_btn_color_text = $_POST['switch_btn_color_text'];
        $switch_btn_color_text_light = $_POST['switch_btn_color_text_light'];
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
        $footer_text_color = $_POST['footer_text_color'];
        $footer_link_color = $_POST['footer_link_color'];
        $footer_light_text_color = $_POST['footer_light_text_color'];
        $footer_light_link_color = $_POST['footer_light_link_color'];
        $img_with_link = $_POST['img_with_link'];
        $img_with_link_link = $_POST['img_with_link_link'];
        $hide_left_panel = $_POST['hide_left_panel'];
        $hide_top_panel = $_POST['hide_top_panel'];
        $hide_bottom_panel = $_POST['hide_bottom_panel'];
        $hide_theme_switcher = $_POST['hide_theme_switcher'];
        $hide_languages = $_POST['hide_languages'];
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

        // If click on submit button in general-admin.php updates default values

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
                    'img_top_mobile' => $logo_top_mobile,
                    'img_top_white_mobile' => $logo_top_mobile_white,
                    'switch_btn_color' => $switch_btn_color,
                    'switch_btn_color_light' => $switch_btn_color_light,
                    'switch_btn_color_text' => $switch_btn_color_text,
                    'switch_btn_color_text_light' => $switch_btn_color_text_light,
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
                    'footer_text_color' => $footer_text_color,
                    'footer_link_color' => $footer_link_color,
                    'footer_light_text_color' => $footer_light_text_color,
                    'footer_light_link_color' => $footer_light_link_color,
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
                    'hide_bottom_panel' => $hide_bottom_panel,
                    'hide_languages' => $hide_languages,
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