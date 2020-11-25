<?php 

// Footer class for bottom panel logic

class FooterClass{ 

    // DB table name 
    const table = 'wp_tradesmarter_footer';
    const version = '1.0';
    const titleName = 'Tradesmarter plugin';

    // Install method 
    // Creates table in DB if not exists and insert default values

    public static function install()
    {
        global $wpdb;
        global $wp_summary_db_version;
        $ptbd_table_name = 'wp_tradesmarter_footer';

        $wp_summary_db_version = self::version;

        // Create table if not exists, 
        // Here you can add new table rows

        if ($wpdb->get_var("SHOW TABLES LIKE '". $ptbd_table_name . "'"  ) != $ptbd_table_name  ) {
            $sql  = 'CREATE TABLE ' . 'wp_tradesmarter_footer' .  ' (
                id INT(20) AUTO_INCREMENT,
                lang_id text,
                footer_content text,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id))';
            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            
            dbDelta($sql);

            update_option('wp_tradesmarter_aside_tables_created', true);    

            add_option('wp_tradesmarter_aside_db_version', $wp_summary_db_version);

            // set default language

            $lang_temp = (string) 'en';

            // Insert default values

            $wpdb->insert(
                "wp_tradesmarter_footer", 
                array(
                    'lang_id' => $lang_temp,
                    'footer_content' => ''
                ),
                array(
                    '%s',
                    '%s',
                )
            );

        }

        // Check plugin`s version and updates plugin

        if ( self::my_plugin_is_current_version() ){
            self::upgrade();
        }
    }

    public static function upgrade()
    {
        // Put here logic for new plugin version
        // If you want to update table for top panel settings

        update_option( 'my_plugin_version', self::version );
    }

    public static function my_plugin_is_current_version(){
        $version = get_option( 'my_plugin_version' );
        return version_compare( $version, self::version, '=') ? false : true;
    }

    // Add menu item Top panel settings in WP admin left menu

    public static function addMenuItem()
    {
        add_submenu_page(
            'aside',
            'Footer settings',
            'Footer settings',
            'manage_options',
            'Footer',
            array('FooterClass', 'renderBottomPanelSetting')
        );
    }

    // render top_panel-admin.php

    public static function renderBottomPanelSetting()
    {
        include('admin/footer-admin.php');

        self::sendData();
    }

    // sendData function catch 'save' button and write fields values into DB table

    public static function sendData(){
        global $wpdb;
        $ptbd_table_name = 'wp_tradesmarter_footer';
        
        $content = $_POST['footer_content'];

        // Get current language setted in admin as 'Current language'

        $currentLanguage = $_REQUEST['language'] ? $_REQUEST['language'] : 'en' ;

        // If changed current language

        if ( isset($_GET['submit_lang']) ){
            $isExists = $wpdb->get_var("SELECT `id` FROM `wp_tradesmarter_footer` WHERE `lang_id` = '" . $currentLanguage . "'");

            // Create information about new language if this language doesn`t exists

            if(!$isExists){
                $wpdb->insert(
                    "wp_tradesmarter_footer", 
                    array(
                        'lang_id' => $currentLanguage,
                        'footer_content' => '',
                    ),
                    array(
                        '%s',
                        '%s', 
                    )
                );
            }
        }

        // if language is new you insert data into it

        if (isset($_POST['submit'])){
            $isExists = $wpdb->get_var("SELECT `id` FROM `wp_tradesmarter_footer` WHERE `lang_id` = '" . $currentLanguage . "'");
            if(!$isExists){
                $wpdb->insert(
                    "wp_tradesmarter_footer", 
                    array(
                        'lang_id' => $currentLanguage,
                        'footer_content' => html_entity_decode(stripslashes($content),ENT_QUOTES,'UTF-8'),
                    ),
                    array(  
                        '%s',
                        '%s',
                    )
                );
            } else {
                // Else if language is old update values 
                $wpdb->update(
                    "wp_tradesmarter_footer", 
                    array(
                        'footer_content' => html_entity_decode(stripslashes($content),ENT_QUOTES,'UTF-8'),
                    ),
                    array(
                        'id' => $isExists
                    )
                );
            }
        }
    }

}