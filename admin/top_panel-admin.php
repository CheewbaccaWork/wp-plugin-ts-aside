<?php
  // see description in aside-admin.php
  global $wpdb;
  $ptbd_table_name = $wpdb->prefix . 'tradesmarter_top_panel';
  $language = $_REQUEST['language'] ? $_REQUEST['language'] : 'en' ;
  $result = $wpdb->get_results('SELECT * FROM `wp_tradesmarter_top_panel` WHERE `lang_id` = "' . $language . '" ORDER BY `id` desc limit 1');

  if(isset($_POST['submit']))
    {
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>

<div class="wrap">
    <h1>Top Panel Settings</h1>
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
                        <input type="hidden" value="TopPanel" name="page">
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
                <tr>
                    <th scope="row">
                        <label for="logo">My Accounts link</label>
                    </th>
                    <td>
                        <input type="text" placeholder="Name" name="my_acc" value="<?php echo $result[0]->my_acc ? $result[0]->my_acc : "" ?>">
                        <input type="text" placeholder="Link" name="my_acc_link" value="<?php echo $result[0]->my_acc_link ? $result[0]->my_acc_link : "" ?>">
                    </td>
                </tr>
                <tr>
                <?php 
                    $menu_items = json_decode($result[0]->menu_items, true);
                    $menu_links = json_decode($result[0]->menu_links, true);

                    if ($menu_items && $menu_items != " "){
                        for($i = 0; $i < count($menu_items); $i++){
                            ?>
                                 <tr data-num="<?php echo $count ?>">
                                    <th scope="row">
                                        <label>Menu item</label>        
                                    </th>
                                    <td>
                                        <input placeholder="Menu item" type="text" name="menu-item[]" value="<?php echo $menu_items[$i]; ?>">
                                        <input class="menu_link" placeholder="Link" type="text" name="menu-link[<?php echo $count ?>]" value="<?php echo ($menu_links[$i] || $menu_links[$i] == " " ? $menu_links[$i] : ' ' ); ?>">
                                        <?php if ($i == count($menu_items) - 1) {  ?><a href="#" title="Add Menu Item" class="addMenuTopPanel">+</div> <?php } ?>
                                        <a href="#" title="Remove Menu Item" class="minus">-</a>
                                    </td>
                            <?php
                        }
                    }else { 
                        ?>
                        <tr data-num="<?php echo $count ?>">
                            <th scope="row">
                                <label>Menu item</label>    
                            </th>
                            <td>
                                <input placeholder="Menu item" type="text" name="menu-item[]" value="">
                                <input placeholder="Link" type="text" name="menu-link[<?php echo $count ?>]" value="">
                                <a href="#" title="Add Menu Item" class="addMenuTopPanel">+</a>
                                <a href="#" title="Remove Menu Item" class="minus">-</a>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Deposit</label>
                    </th>
                    <td>
                        <input type="text" placeholder="Deposit" name="deposit" value="<?php echo $result[0]->deposit ? $result[0]->deposit : "" ?>">
                        <input type="text" placeholder="Link" name="deposit_link" value="<?php echo $result[0]->deposit_link ? $result[0]->deposit_link : "" ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Login</label>
                    </th>
                    <td>
                        <input type="text" placeholder="Login" name="login" value="<?php echo $result[0]->login ? $result[0]->login : "" ?>">
                        <input type="text" placeholder="Link" name="login_link" value="<?php echo $result[0]->login_link ? $result[0]->login_link : "" ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Open and account</label>
                    </th>
                    <td>
                        <input type="text" placeholder="Open and account" name="open" value="<?php echo $result[0]->open ? $result[0]->open : "" ?>">
                        <input type="text" placeholder="Link" name="open_link" value="<?php echo $result[0]->open_link ? $result[0]->open_link : "" ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Logout</label>
                    </th>
                    <td>
                        <input type="text" placeholder="Logout" name="logout" value="<?php echo $result[0]->logout ? $result[0]->logout : " " ?>">
                        <input type="text" placeholder="Logout link" name="logout_link" value="<?php echo $result[0]->logout_link ? $result[0]->logout_link : "" ?>">
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button('Save changes') ?>
        
    </form>
</div>
