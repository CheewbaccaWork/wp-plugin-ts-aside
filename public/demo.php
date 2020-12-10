<div class="bg_wrap">
    <div class="guest_form">
        <p class="guest_form_head">
            guest demo
        </p>
        <p class="guest_form_text">
            With platform guest demo you can practice<br>trading anonymously
            with $10,000 demo money<br>allowing you yo open & close positions,<br>
            experiencing all features of the platform.
        </p>
        <p class="guest_form_text green_text">
            Free Preview - No need to register
            <?php // echo $GLOBALS['getDemoResponseJson']; ?>
        </p>
        <div class="btn_wrapper">
            <a class="btn_dark" href="<?php echo get_site_url( ); ?>">cancel</a>
            <?php 
            function getDemo(){
                $handle = curl_init();
                $login = $GLOBALS['login'];
                $password = $GLOBALS['password'];

                $url = "http://admin-api.tradesmarter.com/crm/rest/create-demo-account?siteID=23";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
                $getDemoResponse = curl_exec($ch);
                curl_close($ch);  
                $GLOBALS['getDemoResponseJson'] = json_decode($getDemoResponse);
                }
                if ($GLOBALS['getDemoResponseJson']){
                ?> 
                    <script>
                        console.log('<?php $GLOBALS['getDemoResponseJson'] ?>');
                    </script>
                <?php
            } ?>
            <script>
                console.log('<?php $GLOBALS['getDemoResponseJson'] ?>');
            </script>
            <form method="post" >
                <input class="btn_light" type="submit" name="getDemo" id="getDemo" value="guest demo" />
            </form>
            <?php 
                if( isset( $_POST['getDemo'] )){
                    getDemo();
                    unset($_POST);
                    //header("Location: ".$_SERVER['PHP_SELF'] . "/guest-demo");
                    exit;
                }
            ?>
        </div>
    </div>
</div>