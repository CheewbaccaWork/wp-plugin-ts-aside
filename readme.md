=== Tradesmarter Aside ===

Contributors: https://profiles.wordpress.org/ivantymoshenko/
Tags: comments, spam
Requires at least: 5.1
Tested up to: 5.2
Requires PHP: 7.2
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

# Plugin`s documentation
 
> This is a privat plugin to create cfd and simple trading platforms for site.
> Use schortocde [aside] for implementing on the page

## Instalation: 

1. You need to install on wordpress site WP Pusher plugin. 
> https://wppusher.com/

2. Then go to WP pusher "install plugin" section and add all credentials for github, 
where located plugin. **Note** that is important to check 'Push-to-Deploy' option

3. When the plugin is already installed and activated he already is ready to use

4. Install 'Head and foot' plugin and put in head scripts: 

```
<script>  
  function getCookie(name) { 
        var nameEQ = name + "="; 
        var ca = document.cookie.split(';'); 
        for(var i=0 ;i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return 0; // if user hasn`t visit site, return false to set cookies
    }
    
    // This function set cookies for 1 year
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/"; // setting cookie
    }

    if (!getCookie('userLanguage')){
      setCookie('userLanguage', 'en', 360);
    } 

</script>
<script src="https://trading.XXXXXXXX.com/options-fe/embed/options-iframe.js"></script>
<script src="https://bpw.XXXXXXXX.com/BPWidgets/embed/widgets-iframe.js"></script>
<script type="text/javascript" src="https://d2vl6u6wrj3tgq.cloudfront.net/assets/v5/js/json2.js"></script>
<script type="text/javascript" src="https://d2vl6u6wrj3tgq.cloudfront.net/assets/v5/js/promos-cookies-2.js"></script>
<script src="https://fx-trading.XXXXXXXX.com/bpFxCfd/embed/bpfxcfd-iframe.js"></script>
```

> Instead of XXXXXXXX paste api host name, eg tradesmarter, w-options ....

5. Create all necessary pages (You can just export them from another site, eg http://client.tradesmarter.com/)

6. In wordpress settings field go to Settings->Reading and choose homepage page

7. If you use default Wordpress theme, be careful to disable all widgets

8. Read the documentation.

## Settings:

Aside tag has only 1 parameter **state**
By default **state** = null 

For example: 

> empty [aside] tag will generate FX&CFD platform on page 

Another use cases: 

- [aside] tag will generate FX&CFD platform on page 
- [aside state="options"] will generate Simple platform on page 
- [aside state="options"] will generate Simple platform on page 
- [aside state="text"] will generate text page, where user can add headings, paragraphs, images, videos ..
- [aside state="faq"] will FAQ page with questions and answers. Content for this page is taken from  
Faq simple and Faq FX settings pages in Tradesmarter settings (wp-admin)
- [aside state="__platform_state_name__"] will generate page in accordance to platform state parameter

## Platform patameters: 

1. Login : [aside state="wowMain.login"]
2. Register : [aside state="wowMain.register"]
3. Forgot Password : [aside state="wowMain.forgotPassword"]
4. Dashboard : [aside state="wowMain.dashboard.container"]
5. Transactions : [aside state="wowMain.reports.transactions"]
6. Account Container : [aside state="wowMain.account.container"]
7. Settings : [aside state="wowMain.settings"]
8. Change Password : [aside state="wowMain.changePassword"]
9. Deposit : [aside state="wowMain.banking.deposit"]
10. Withdrawal Request : [aside state="wowMain.banking.withdrawal"]
11. Privacy Center : [aside state="wowMain.privacyCenter"]
12. Safety and Security : [aside state="wowMain.safetySecurity"]

## How to use: 

In left panel of wordpress admin-panel will appear 'Tradesmarter setting' option 
Here you can find: 

### Tradesmarter setting (general settings) 

Use it if you need to change some properties that apply to the entire site

> Colors, images, default theme, hide panel/hide top panel ... 

### Left panel settings 

Specify settings for left panel on site. 
Here you can create new navigation item with link, change previous settings, add new language 
or remove language. Also you can add download block with image and text and login/logout buttons

### Top panel settings 

Specify settings for top panel on site. 
Here you can create new navigation item with link, change previous settings, add new language.
**Note** new language will automatically appear if this language is added for left and top panels.

### FAQ Simple and FAQ FX 

This page developed for FAQ page on the site. You can add new pair question + answer or remove already added pairs

## Plugins Architecture: 

Main file is called **aside.php** and you can find it here : "__wp-plugin-ts-aside/aside.php__" in plugin`s root

This file contains short description about plugin for Wordpress. Here included all files, that plugin use
Also here is included css (public/main.css), js (public/main.js), image.js, colors.js and short-code generation.


AsideClass.php contains main logic for left panel. In admin side use admin/aside-admin.php as view. 
GeneralClass.php contains main logic all pages. View for general settings: general-admin.php
TopPanelClass.php contains main logic for top panel. View for general settings: general-admin.php
FaqClass.php contains main logic for faq pages. View for general settings: faq_fx_admin.php, faq-admin.php

Styles for back-end you can find in admin/aside-admin.css
Scripts in admin/admin.js
