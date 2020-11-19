<?php
  // see description in aside-admin.php
  global $wpdb;
  $ptbd_table_name = 'wp_tradesmarter_footer';
  $language = $_REQUEST['language'] ? $_REQUEST['language'] : 'en' ;
  $result = $wpdb->get_results('SELECT * FROM ' . $ptbd_table_name . ' WHERE `lang_id` = "' . $language . '" ORDER BY `id` desc limit 1');

  if(isset($_POST['submit']) or isset($_POST['remove_lang']))
    {
        echo "<meta http-equiv='refresh' content='0'>";
    }

?>

<div class="wrap">  
    <h1>Footer</h1>
    <form method="get" action="">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="language"> Choose language
                            <span class="dashicons dashicons-translation" aria-hidden="true"></span>
                        </label>
                    </th>
                    <td>
                        <input type="hidden" value="Footer" name="page">
                        <select name="language" id="WPLANG">
                            <option value="en" lang="en">English</option>
                            <option value="de" lang="de">Deutsch</option>
                            <option value="es" lang="es">Español</option>
                            <option value="fr" lang="fr">Français</option>
                            <option value="it" lang="it">Italiano</option>
                            <option value="ja" lang="ja">日本語</option>
                            <option value="ko" lang="ko">한국어</option>
                            <option value="nl" lang="nl">Dutch</option>
                            <option value="pt" lang="pt">Português</option>
                            <option value="ru" lang="ru">Русский</option>
                            <option value="zh_cn" lang="zh_cn" >简体中文</option>
                            <option value="zh_tw" lang="zh_tw" >繁體中文</option>
                            <option value="ar" lang="ar" >العربية</option>
                            <option value="id" lang="id" >Indonesian</option>
                            <option value="ms" lang="ms" >Malay</option>
                            <option value="vi" lang="vi" >Vietnamese</option>
                            <option value="th" lang="th" >ภาษาไทย</option>
                            <option value="pl" lang="pl" >Polski</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="language">Current language: 
                        </label>
                    </th>
                    <td>
                        <?php 
                            $arr = [
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
                            echo $arr[$language] ? $arr[$language] : "en" ;
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" name="submit_lang" id="submit_lang" class="button button-primary" value="Choose language">    
    </form>

    <form method="post" action="" class="tradesmarter-aside-admin">
        <table class="form-table" role="presentation">
            <tbody> 
                <?php 
                    $content = $result[0]->footer_content;
                    ?>
                    <tr class="big-tr">
                        <th scope="row">
                            <label>Footer content</label>    
                        </th>
                        <td>
                            <?php wp_editor( $content , 'footer_content', $settings = array('textarea_name'=>'footer_content', 'media_buttons'=>'0', 'buttons'=>'0') ); ?> 
                        </td>
                    </tr>
                    <?php
                ?>
            </tbody>
        </table>

        <?php submit_button('Save changes') ?>
        
    </form>
</div>
