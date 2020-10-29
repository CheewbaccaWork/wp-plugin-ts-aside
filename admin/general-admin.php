<?php
  global $wpdb;
  $result = $wpdb->get_results('SELECT * FROM `wp_aside_general` ' . " ORDER BY `id` desc limit 1");

  if(isset($_POST['submit']))
    {
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>

<div class="wrap">
    <h1>General Settings</h1>
    <form method="post" action="" class="tradesmarter-aside-admin">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label>API host: </label>
                    </th>
                    <td>
                        <input placeholder="brokers-domain.com" name="api_host" type="text" value="<?php echo ($result[0]->api_host ? $result[0]->api_host : ""); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Top section logo link: </label>
                    </th>
                    <td>
                        <input placeholder="brokers-domain.com" name="logo_link" type="text" value="<?php echo ($result[0]->logo_link ? $result[0]->logo_link : ""); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Choose please logo image for aside or <a class="remove_img" href="#">remove</a></label>
                    </th>
                    <td>
                    <?php   
                        if( $result[0]->img ) {

                            echo '<a id="removedImg" href="#" class="img-upl previewImg"><img src="' . $result[0]->img . '" /></a>
                                    <input id="logo" type="hidden" name="logo" value="' . $result[0]->img . '">'; 
                        } else {
                            
                            echo '<a id="removedImg" href="#" class="img-upl previewImg">Upload image</a>
                                <input id="logo" type="hidden" name="logo" value="">';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Choose please logo image for aside white-theme or <a class="remove_img" href="#">remove</a></label>
                    </th>
                    <td>
                    <?php   
                        if( $result[0]->img_white ) {

                            echo '<a id="removedImg" href="#" class="img-upl previewImg"><img src="' . $result[0]->img_white . '" /></a>
                                    <input id="logo_white" type="hidden" name="logo_white" value="' . $result[0]->img_white . '">'; 
                        } else {
                            
                            echo '<a id="removedImg" href="#" class="img-upl previewImg">Upload image</a>
                                <input id="logo_white" type="hidden" name="logo_white" value="">';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Choose please logo image for top panel or <a class="remove_img" href="#">remove</a></label>
                    </th>
                    <td>
                    <?php
                        if( $result[0]->img_top ) {

                            echo '<a id="removedImg" href="#" class="img-upl previewImg"><img src="' . $result[0]->img_top . '" /></a>
                                    <input id="logo_top" type="hidden" name="logo_top" value="' . $result[0]->img_top . '">'; 
                        } else {
                            
                            echo '<a id="removedImg" href="#" class="img-upl previewImg">Upload image</a>
                                <input id="logo_top" type="hidden" name="logo_top" value="">';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Choose please logo image for top panel white-theme or <a class="remove_img" href="#">remove</a></label>
                    </th>
                    <td>
                    <?php
                        if( $result[0]->img_top_white ) {

                            echo '<a id="removedImg" href="#" class="img-upl previewImg"><img src="' . $result[0]->img_top_white . '" /></a>
                                    <input id="logo_top_white" type="hidden" name="logo_top_white" value="' . $result[0]->img_top_white . '">'; 
                        } else {
                            
                            echo '<a id="removedImg" href="#" class="img-upl previewImg">Upload image</a>
                                <input id="logo_top_white" type="hidden" name="logo_top_white" value="">';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Choose please logo image for top panel mobile view or <a class="remove_img" href="#">remove</a></label>
                    </th>
                    <td>
                    <?php
                        if( $result[0]->img_top_mobile ) {

                            echo '<a id="removedImg" href="#" class="img-upl previewImg"><img src="' . $result[0]->img_top_mobile . '" /></a>
                                    <input id="img_top_mobile" type="hidden" name="img_top_mobile" value="' . $result[0]->img_top_mobile . '">'; 
                        } else {
                            
                            echo '<a id="removedImg" href="#" class="img-upl previewImg">Upload image</a>
                                <input id="img_top_mobile" type="hidden" name="img_top_mobile" value="">';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="logo">Choose please logo image for top panel mobile view white theme or <a class="remove_img" href="#">remove</a></label>
                    </th>
                    <td>
                    <?php
                        if( $result[0]->img_top_white_mobile ) {

                            echo '<a id="removedImg" href="#" class="img-upl previewImg"><img src="' . $result[0]->img_top_white_mobile . '" /></a>
                                    <input id="img_top_white_mobile" type="hidden" name="img_top_white_mobile" value="' . $result[0]->img_top_white_mobile . '">'; 
                        } else {
                            
                            echo '<a id="removedImg" href="#" class="img-upl previewImg">Upload image</a>
                                <input id="img_top_white_mobile" type="hidden" name="img_top_white_mobile" value="">';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Background color for Deposit button dark theme</label>
                    </th>
                    <td>                
                        <input name="switch_btn_color" type="text" value="<?php echo ($result[0]->switch_btn_color ? $result[0]->switch_btn_color : "#008000"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Background color for Deposit button light theme</label>
                    </th>
                    <td>                
                        <input name="switch_btn_color_light" type="text" value="<?php echo ($result[0]->switch_btn_color_light ? $result[0]->switch_btn_color_light : "#008000"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Text color for Deposit button dark theme</label>
                    </th>
                    <td>                
                        <input name="switch_btn_color_text" type="text" value="<?php echo ($result[0]->switch_btn_color_text ? $result[0]->switch_btn_color_text : "#008000"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Text color for Deposit button light theme</label>
                    </th>
                    <td>                
                        <input name="switch_btn_color_text_light" type="text" value="<?php echo ($result[0]->switch_btn_color_text_light ? $result[0]->switch_btn_color_text_light : "#008000"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Link color for dark theme</label>
                    </th>
                    <td>                
                        <input name="color-dark" type="text" value="<?php echo ($result[0]->color_dark ? $result[0]->color_dark : "#000000"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Link color for light theme</label>
                    </th>
                    <td>             
                        <input name="color-light" type="text" value="<?php echo ($result[0]->color_light ? $result[0]->color_light : "#000000"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Active link color for dark theme</label> 
                    </th>
                    <td>                 
                        <input name="color-active" type="text" value="<?php echo ($result[0]->active_link ? $result[0]->active_link : "#008000"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Active link color for light theme</label>
                    </th>
                    <td>               
                        <input name="color-active-light" type="text" value="<?php echo ($result[0]->active_link_light ? $result[0]->active_link_light : "#000000"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Background color for light theme</label>
                    </th>
                    <td>               
                        <input name="color-bg-light" type="text" value="<?php echo ($result[0]->light_bg ? $result[0]->light_bg : "#ffffff"); ?>" />  
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Background color for dark theme</label>
                    </th>
                    <td>                 
                        <input name="color-bg-dark" type="text" value="<?php echo ($result[0]->dark_bg ? $result[0]->dark_bg : "#0a141c"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Title color for dark text page</label>
                    </th>
                    <td>               
                        <input name="title_color_text_page" type="text" value="<?php echo ($result[0]->title_color_text_page ? $result[0]->title_color_text_page : "#ffffff"); ?>" />  
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Paragraph color for dark text page</label>
                    </th>
                    <td>                 
                        <input name="paragraph_color_text_page" type="text" value="<?php echo ($result[0]->paragraph_color_text_page ? $result[0]->paragraph_color_text_page : "#0a141c"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Title color for light text page</label>
                    </th>
                    <td>               
                        <input name="title_color_text_page_light" type="text" value="<?php echo ($result[0]->title_color_text_page_light ? $result[0]->title_color_text_page_light : "#ffffff"); ?>" />  
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Paragraph color for light text page</label>
                    </th>
                    <td>                 
                        <input name="paragraph_color_text_page_light" type="text" value="<?php echo ($result[0]->paragraph_color_text_page_light ? $result[0]->paragraph_color_text_page_light : "#0a141c"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Background color for light download block</label>
                    </th>
                    <td>                 
                        <input name="dwnld_block_backgorund_color" type="text" value="<?php echo ($result[0]->dwnld_block_backgorund_color ? $result[0]->dwnld_block_backgorund_color : "#0a141c"); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Background color for dark download block</label>
                    </th>
                    <td>                 
                        <input name="dwnld_block_backgorund_dark_color" type="text" value="<?php echo ($result[0]->dwnld_block_backgorund_dark_color ? $result[0]->dwnld_block_backgorund_dark_color : "#0a141c"); ?>" />
                    </td>
                </tr>
                <tr class="big-tr">
                    <th scope="row">
                        <label>Download block img</label>
                    </th>
                    <td style="display: flex; flex-wrap: wrap; flex-direction: column; align-items: flex-start">        
                        <?php
                            if( $result[0]->dwnld_img ) {

                                echo '<a href="#" class="img-upl previewIcon"><img src="' . wp_get_attachment_image_url( $result[0]->dwnld_img ) . '" /></a>
                                        <input type="hidden" name="dwnld_img" value="' . $result[0]->dwnld_img . '">';
                            } else {
                                
                                echo '<a href="#" class="img-upl previewIcon"> Add icon </a>
                                    <input type="hidden" name="dwnld_img" value="">';
                            }
                        ?>
                    </td>
                </tr>
                <tr class="big-tr">
                    <th scope="row">
                        <label>Login</label>
                    </th>
                    <td>        
                        <?php
                            if( $result[0]->login_img ) {

                                echo '<a href="#" class="img-upl previewIcon"><img src="' . wp_get_attachment_image_url( $result[0]->login_img ) . '" /></a>
                                        <input type="hidden" name="login_img" value="' . $result[0]->login_img . '">';
                            } else {
                                
                                echo '<a href="#" class="img-upl previewIcon"> Add icon </a>
                                    <input type="hidden" name="login_img" value="">';
                            }
                        ?>
                        <input value="<?php echo ($result[0]->login_link ? $result[0]->login_link : ""); ?>" type="text" name="login_link" placeholder="Link">
                    </td>
                </tr>
                <tr class="big-tr">
                    <th scope="row">
                        <label>Logout</label>
                    </th>
                    <td>        
                        <?php
                            if( $result[0]->log_img ) {

                                echo '<a href="#" class="img-upl previewIcon"><img src="' . wp_get_attachment_image_url( $result[0]->log_img ) . '" /></a>
                                        <input type="hidden" name="log_img" value="' . $result[0]->log_img . '">';
                            } else {
                                
                                echo '<a href="#" class="img-upl previewIcon"> Add icon </a>
                                    <input type="hidden" name="log_img" value="">';
                            }
                        ?>
                        <input value="<?php echo ($result[0]->log_link ? $result[0]->log_link : ""); ?>" type="text" name="log_link" placeholder="Link">
                    </td>
                </tr>
                <tr class="big-tr">
                    <th scope="row">
                        <label>Img with link</label>
                    </th>
                    <td>        
                        <?php
                            if( $result[0]->img_with_link ) {

                                echo '<a href="#" class="img-upl previewIcon"><img src="' . wp_get_attachment_image_url( $result[0]->img_with_link ) . '" /></a>
                                        <input type="hidden" name="img_with_link" value="' . $result[0]->img_with_link . '">';
                            } else {
                                
                                echo '<a href="#" class="img-upl previewIcon"> Add img </a>
                                    <input type="hidden" name="img_with_link" value="">';
                            }
                        ?>
                        <input value="<?php echo ($result[0]->img_with_link_link ? $result[0]->img_with_link_link : ""); ?>" type="text" name="img_with_link_link" placeholder="Link">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Left panel: </label>
                    </th>
                    <td> 
                        <input <?php echo ($result[0]->hide_left_panel == '1' ? 'checked' : ''); ?> class="hide_panels" name="hide_left_panel" type="checkbox" id="hide_left_panel" value="<?php echo ($result[0]->hide_left_panel ? $result[0]->hide_left_panel : "0"); ?>">
                    Hide left panel</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Top panel: </label>
                    </th>
                    <td> 
                        <input <?php echo ($result[0]->hide_top_panel == '1' ? 'checked' : ''); ?> class="hide_panels" name="hide_top_panel" type="checkbox"  value="<?php echo ($result[0]->hide_top_panel ? $result[0]->hide_top_panel : "0"); ?>">
                            Hide top panel</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Theme switcher: </label>
                    </th>
                    <td> 
                        <input <?php echo ($result[0]->hide_theme_switcher == '1' ? 'checked' : ''); ?> class="hide_panels" name="hide_theme_switcher" type="checkbox"  value="<?php echo ($result[0]->hide_theme_switcher ? $result[0]->hide_theme_switcher : "0"); ?>">
                            Hide theme switcher</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Documents status badge: </label>
                    </th>
                    <td> 
                        <input <?php echo ($result[0]->show_documents == '1' ? 'checked' : ''); ?> class="hide_panels" name="show_documents" type="checkbox" id="show_documents" value="<?php echo ($result[0]->show_documents ? $result[0]->show_documents : "0"); ?>">
                        Show</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Account level: </label>
                    </th>
                    <td> 
                        <input <?php echo ($result[0]->show_account == '1' ? 'checked' : ''); ?> class="hide_panels" name="show_account" type="checkbox" id="show_account" value="<?php echo ($result[0]->show_account ? $result[0]->show_account : "0"); ?>">
                    Show</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Default theme: </label>
                    </th>
                    <td>
                        <select name="default_theme">
                            <option value="dark">Dark</option>
                            <option <?php echo ( $result[0]->default_theme == 'light' ? "selected" : '' ) ?>  value="light">Light</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Light theme for platform: </label>
                    </th>
                    <td>
                        <input value="<?php echo ($result[0]->light_theme_platform ? $result[0]->light_theme_platform : ""); ?>" type="text" name="light_theme_platform" placeholder="Theme name">  
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Dark theme for platform: </label>
                    </th>
                    <td>
                        <input value="<?php echo ($result[0]->dark_theme_platform ? $result[0]->dark_theme_platform : ""); ?>" type="text" name="dark_theme_platform" placeholder="Theme name">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Light theme for widgets: </label>
                    </th>
                    <td>
                        <input value="<?php echo ($result[0]->light_theme_widget ? $result[0]->light_theme_widget : ""); ?>" type="text" name="light_theme_widget" placeholder="Theme name">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label>Dark theme for widgets: </label>
                    </th>
                    <td>
                        <input value="<?php echo ($result[0]->dark_theme_widget ? $result[0]->dark_theme_widget : ""); ?>" type="text" name="dark_theme_widget" placeholder="Theme name">
                    </td>
                </tr>
                <?php 
                    $choosed_lang;
                    $result[0]->default_language ? $choosed_lang = $result[0]->default_language : $choosed_lang = 0;
                ?>
                <tr>
                    <th scope="row">
                        <label for="language">Choose default language
                            <span class="dashicons dashicons-translation" aria-hidden="true"></span>
                        </label>
                    </th>
                    <td>
                        <input type="hidden" value="Settings" name="page">
                        <select name="default_language" id="WPLANG">
                            <option <?php echo selected($choosed_lang, "en"); ?>  value="en" lang="en">English</option>
                            <option <?php echo selected($choosed_lang, "de"); ?>  value="de" lang="de">Deutsch</option>
                            <option <?php echo selected($choosed_lang, "es"); ?>  value="es" lang="es">Español</option>
                            <option <?php echo selected($choosed_lang, "fr"); ?>  value="fr" lang="fr">Français</option>
                            <option <?php echo selected($choosed_lang, "it"); ?>  value="it" lang="it">Italiano</option>
                            <option <?php echo selected($choosed_lang, "ja"); ?>  value="ja" lang="ja">日本語</option>
                            <option <?php echo selected($choosed_lang, "ko"); ?>  value="ko" lang="ko">한국어</option>
                            <option <?php echo selected($choosed_lang, "nl"); ?>  value="nl" lang="nl">Dutch</option>
                            <option <?php echo selected($choosed_lang, "pt"); ?>  value="pt" lang="pt">Português</option>
                            <option <?php echo selected($choosed_lang, "ru"); ?>  value="ru" lang="ru">Русский</option>
                            <option <?php echo selected($choosed_lang, "zh_cn"); ?>  value="zh_cn" lang="zh_cn" >简体中文</option>
                            <option <?php echo selected($choosed_lang, "zh_tw"); ?>  value="zh_tw" lang="zh_tw" >繁體中文</option>
                            <option <?php echo selected($choosed_lang, "ar"); ?>  value="ar" lang="ar" >العربية</option>
                            <option <?php echo selected($choosed_lang, "id"); ?>  value="id" lang="id" >Indonesian</option>
                            <option <?php echo selected($choosed_lang, "ms"); ?>  value="ms" lang="ms" >Malay</option>
                            <option <?php echo selected($choosed_lang, "vi"); ?>  value="vi" lang="vi" >Vietnamese</option>
                            <option <?php echo selected($choosed_lang, "th"); ?>  value="th" lang="th" >ภาษาไทย</option>
                            <option <?php echo selected($choosed_lang, "pl"); ?>  value="pl" lang="pl" >Polski</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button('Save changes') ?>
        
    </form>
</div>
