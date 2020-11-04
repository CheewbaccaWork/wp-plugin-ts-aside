<?php 

// Aside class for left panel logic

class FaqClass{

    // DB table name 
    const table = 'wp_tradesmarter_aside';
    const version = '1.0';
    const titleName = 'Tradesmarter plugin';

    // Install method 
    // Creates table in DB if not exists and insert default values

    public static function install()
    {
        global $wpdb;
        global $wp_summary_db_version;

        $ptbd_table_name = "wp_aside_faq";

        $wp_summary_db_version = self::version;

        // Create table if not exists, 
        // Here you can add new table rows

        // questions - Question for FAQ simple page
        // questions_fx - Question for FAQ FX page

        if ($wpdb->get_var("SHOW TABLES LIKE 'wp_aside_faq'" ) != $ptbd_table_name ) {
            $sql  = 'CREATE TABLE '. 'wp_aside_faq' .' (
                id INT(20) AUTO_INCREMENT,
                lang_id VARCHAR(255),
                questions text,
                answers text,  
                questions_fx text,
                answers_fx text,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id))';
            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            
            dbDelta($sql);

            update_option('wp_tradesmarter_aside_tables_created', true);

            add_option('wp_tradesmarter_aside_db_version', $wp_summary_db_version);

        }

        // Call to upgrade function if you need to update plugin and add new rows in table

        self::upgrade();
    }

    public static function upgrade()
    {   

        // Put here logic for new plugin version
        // If you want to update table for FAQ page settings

        update_option( 'my_plugin_version', self::version );
    }

    public static function my_plugin_is_current_version(){
        $version = get_option( 'my_plugin_version' );
        return version_compare( $version, self::version, '=') ? false : true;
    }

    public static function uninstall()
    {
      
    }

    // Add menu item FAQ simple and FAQ FX settings in WP admin left menu

    public static function addMenuItem()
    {
        add_submenu_page(
            'aside',
            'FAQ simple',
            'FAQ simple',
            'manage_options',
            'FAQSimple',
            array('FaqClass', 'renderFaqSetting')
        );

        add_submenu_page(
            'aside',
            'FAQ FX',
            'FAQ FX',
            'manage_options',
            'FAQFX',
            array('FaqClass', 'renderFaqSettingFx')
        );
    }
    
    // render FAQ simple page

    public static function renderFaqSetting()
    {
        include('admin/faq-admin.php');

        self::sendData();
    }

    // render FAQ FX page

    public static function renderFaqSettingFx()
    {
        include('admin/faq_fx_admin.php');

        self::sendData();
    }

    // sendData function catch 'save' button and write fields values into DB table

    public static function sendData(){

        global $wpdb;
        $ptbd_table_name = 'wp_aside_faq';

        $temp = array();
        $temp_answ = array();

        $temp_fx = array();
        $temp_answ_fx = array();

        if ($_POST['questions']){
            foreach($_POST['questions'] as $key=>$value){
                if ($value !== ""){
                    array_push($temp, $value);
                }else{
                    $temp = null;
                }
            }
        }

        if ($_POST['answers']){
            foreach($_POST['answers'] as $key=>$value){
                if ($value !== ""){
                    array_push($temp_answ, $value);
                }else{
                    $temp_answ = null;
                }
            }
        }

        if ($_POST['questions_fx']){
            foreach($_POST['questions_fx'] as $key=>$value){
                if ($value !== ""){
                    array_push($temp_fx, $value);
                }else{
                    $temp_fx = null;
                }
            }
        }

        if ($_POST['answers_fx']){
            foreach($_POST['answers_fx'] as $key=>$value){
                if ($value !== ""){
                    array_push($temp_answ_fx, $value);
                }else{
                    $temp_answ_fx = null;
                }
            }
        }

        $arr = json_encode($temp);
        $arr2 = json_encode($temp_answ);

        $arr_fx = json_encode($temp_fx);
        $arr2_fx = json_encode($temp_answ_fx);

        // Get current language from page

        $currentLanguage = $_REQUEST['language'] ? $_REQUEST['language'] : 'en' ;

        // Insert new row for new language if this language doesn`t exists

        // For Simple page

        if ( isset($_POST['submit']) && $_POST['questions']){
            $isExists = $wpdb->get_var("SELECT `id` FROM `wp_aside_faq` WHERE `lang_id` = '" . $currentLanguage . "'");
            if(!$isExists){
                $wpdb->insert(
                    "wp_aside_faq", 
                    array(
                        'lang_id' => strval( $currentLanguage ),
                        'questions' => $arr,
                        'answers' => $arr2, 
                    ),
                    array(  
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                    )
                );
            } else {
                // If this language already exists just update values
                $wpdb->update(
                    "wp_aside_faq", 
                    array(
                        'questions' => $arr,
                        'answers' => $arr2, 
                    ),
                    array(
                        'id' => $isExists
                    )
                );
            }
            // For FX page
        }else if ( isset($_POST['submit']) && $_POST['questions_fx']){
            $isExists = $wpdb->get_var("SELECT `id` FROM `wp_aside_faq` WHERE `lang_id` = '" . $currentLanguage . "'");
            if(!$isExists){
                $wpdb->insert(
                    "wp_aside_faq", 
                    array(
                        'lang_id' => strval( $currentLanguage ),
                        'questions_fx' => $arr_fx,
                        'answers_fx' => $arr2_fx, 
                    ),
                    array(  
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                    )
                );
            } else {
                $wpdb->update(
                    "wp_aside_faq", 
                    array(
                        'questions_fx' => $arr_fx,
                        'answers_fx' => $arr2_fx, 
                    ),
                    array(
                        'id' => $isExists
                    )
                );
            }
        }
    }
}