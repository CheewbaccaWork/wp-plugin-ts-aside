<?php
  // Left panel settings page 

  global $wpdb;
  $ptbd_table_name = 'wp_tradesmarter_aside_test';

  // Get language from select or get English as default
  $language = $_REQUEST['language'] ? $_REQUEST['language'] : 'en' ;
  // Get all rows from left panel table for current language
  $result = $wpdb->get_results('SELECT * FROM ' . $ptbd_table_name . ' WHERE `lang_id` = "' . $language . '" ORDER BY `id` desc limit 1');

  // refresh page after submit

  if(isset($_POST['submit']) or isset($_POST['remove_lang']))
    {
        echo "<meta http-equiv='refresh' content='0'>";
    }

?>

<div class="wrap">
    <h1>General Settings</h1>
    <!-- Form for choosing language -->
    <!-- Send to server information adbout language select -->
    <!-- Cretes new html with English settings or just switch language if exists -->
    <form method="get" action="">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="language">Choose language
                            <span class="dashicons dashicons-translation" aria-hidden="true"></span>
                        </label>
                    </th>
                    <td>
                        <input type="hidden" value="Settings" name="page">
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

    <!-- This form send information to server to delete current language -->
    
    <form method="post" action="<?php echo admin_url('admin.php?page=Settings'); ?>" style="margin-top: 25px;">
       <table>
            <tbody>
                <button type="submit" value="<?php echo $language ? $language : "en" ?>" name="remove_lang" id="remove_lang" class="button button-secondary" value="Remove current language" style="border-color: red; color: red;">Delete current language </button>  
            </tbody>
       </table>
    </form>

    <!-- This form send information to server to update current language options -->

    <form method="post" action="" class="tradesmarter-aside-admin">
        <table class="form-table" role="presentation">
            <tbody> 
                <?php 
                    // Menu item name
                    $name = json_decode($result[0]->menu, true);
                    // Menu item link
                    $menu_link = json_decode($result[0]->menu_link, true);
                    // Menu item sub item name
                    $subname = json_decode($result[0]->submenu, true);
                    // Menu item sub item link
                    $links = json_decode($result[0]->link, true);
                    // Menu item icon
                    $icons = json_decode($result[0]->icon, true);
                    // Menu item sub item icon
                    $sub_icons = json_decode($result[0]->sub_icon, true);
                    $code = json_decode($result[0]->dark_iframe, true);
                    // Count uses for making array of names, links, icons
                    $count = 1;
                    // If table is not empty show page with stored information
                    if ($name[0]){
                        // Get all menu items
                        for($i = 0; $i < count($name); $i++){
                            ?>
                                <tr data-num="<?php echo $count ?>">
                                    <th scope="row">
                                        <label>Menu item</label>        
                                    </th>
                                    <td>
                                        <?php

                                            if( $icons[$i] ) {
    
                                                echo '<a href="#" class="img-upl previewIcon"><img src="' . $icons[$i] . '" /></a>
                                                        <input type="hidden" class="hidden_icon" name="icon[]" value="' . $icons[$i] . '">';
                                            } else {
                                                
                                                echo '<a href="#" class="img-upl previewIcon"> Add icon </a>
                                                    <input type="hidden" class="hidden_icon" name="icon[]" value=" ">';
                                            }
                                        ?>
                                        <input placeholder="Tools" type="text" name="menu-item[]" value="<?php echo $name[$i]; ?>">
                                        <input class="menu_link" placeholder="Link (if submenu is empty)" type="text" name="menu-link[<?php echo $count ?>]" value="<?php echo ($menu_link[$i] || $menu_link[$i] == " " ? $menu_link[$i] : ' ' ); ?>">
                                        <!-- Output 'Add Menu Item' only for last Menu item -->
                                        <?php if ($i == count($name) - 1) {  ?><a href="#" title="Add Menu Item" class="addMenu">+</div> <?php } ?>
                                        <a href="#" title="Add Submenu Item" class="addSubmenu">+</a>
                                        <a href="#" title="Remove Menu Item" class="minus">-</a>
                                        <!-- Create empty submenu item if this item doesn`t exists. It is used to push empty string in array and keep order -->
                                        <?php if($subname[$i][0] == " " || !$subname[$i][0]){ ?>
                                            <input type="hidden" name="submenu-item[][]" value=" ">
                                            <input type="hidden" name="submenu-link[][]" value=" "> 
                                        <?php } ?>
                                    </td>
                                    <?php 
                                    // if Menu item has sub menu item
                                    if ($subname[$i]){
                                        for($j = 0; $j < count($subname[$i]); $j++){
                                            ?>
                                            <!-- if subemnu item exists, get it -->
                                            <?php if ($subname[$i][$j] != " "){ ?>
                                            <td class="submenu"> 
                                                <div class="submenu__th">
                                                    <label>Submenu item</label>
                                                </div>
                                                <div class="submenu__content">
                                                    <input placeholder="Tools" type="text" name="submenu-item[<?php echo $count ?>][]" value="<?php echo $subname[$i][$j] ?>">
                                                    <input placeholder="Link" type="text" name="submenu-link[<?php echo $count ?>][]" value="<?php echo $links[$i][$j] ?>">
                                                    <a href="#" title="Remove Submenu Item" class="minus">-</a>
                                                </div>
                                            </td>
                                            <?php
                                            } else { ?>
                                            <!-- Create empty submenu item icon if this item doesn`t exists. It is used to push empty string in array and keep order -->
                                                <input type="hidden" name="sub-icon[][]" value=" ">
                                        <?php 
                                            }
                                        }
                                    }
                                ?>
                                </tr>
                            <?php
                            $count = $count + 1;
                        }
                    // if DB table is empty create create first item with default language
                    }else {
                        ?>
                        <tr data-num="<?php echo $count ?>">
                            <th scope="row">
                                <label>Menu item</label>    
                            </th>
                            <td>
                                <?php
                                    if( $icons[$key] ) {

                                        echo '<a href="#" class="img-upl previewIcon"><img src="' . wp_get_attachment_image_url( $icons[$key] ) . '" /></a>
                                                <input type="hidden" name="icon[]" value="' . $icons[$key] . '">';
                                    } else {
                                        
                                        echo '<a href="#" class="img-upl previewIcon"> Add icon </a>
                                            <input type="hidden" name="icon[]" value="">';
                                    }
                                ?>
                                <input placeholder="Tools" type="text" name="menu-item[]" value="<?php echo $value ?>">
                                <input placeholder="Link (if submenu is empty)" type="text" name="menu-link[<?php echo $count ?>]" value="<?php echo ($menu_link ? $menu_link : '' ); ?>">
                                <a href="#" title="Add Menu Item" class="addMenu">+</a>
                                <a href="#" title="Add Submenu Item" class="addSubmenu">+</a>
                                <a href="#" title="Remove Menu Item" class="minus">-</a>
                                <input type="hidden" name="submenu-item[][]" value=" ">
                                <input type="hidden" name="submenu-link[][]" value=" ">
                            </td>
                        </tr>
                        <?php
                    }
                ?>
                <!-- Download block --> 
                <tr class="big-tr">
                    <th scope="row">
                        <label>Download block</label>
                    </th>
                    <td style="display: flex; flex-wrap: wrap; flex-direction: column; align-items: flex-start">        
                        <input value="<?php echo ($result[0]->dwnld_title ? $result[0]->dwnld_title : ''); ?>" type="text" name="dwnld_title" placeholder="Title">
                        <?php wp_editor( $result[0]->dwnld_text , 'download_content', $settings = array('textarea_name'=>'dwnld_text', 'media_buttons'=>'0', 'buttons'=>'0') ); ?> 
                    </td>
                </tr>
                <!-- Login --> 
                <tr class="big-tr">
                    <th scope="row">
                        <label>Login</label>
                    </th>
                    <td>        
                        <input value="<?php echo ($result[0]->login_text ? $result[0]->login_text : ""); ?>" type="text" name="login_text" placeholder="Title">
                    </td>
                </tr>
                <!-- Logout --> 
                <tr class="big-tr">
                    <th scope="row">
                        <label>Logout</label>
                    </th>
                    <td>        
                        <input value="<?php echo ($result[0]->log_text ? $result[0]->log_text : ""); ?>" type="text" name="log_text" placeholder="Title">
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button('Save changes') ?>
        
    </form>
</div>
