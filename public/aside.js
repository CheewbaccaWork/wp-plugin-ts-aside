
function ready(callbackFunc) {
    if (document.readyState !== 'loading') {
        // Document is already ready, call the callback directly
        callbackFunc();
    } else if (document.addEventListener) {
        // All modern browsers to register DOMContentLoaded
        document.addEventListener('DOMContentLoaded', callbackFunc);
    } else {
        // Old IE browsers
        document.attachEvent('onreadystatechange', function() {
            if (document.readyState === 'complete') {
                callbackFunc();
            }
        });
    }
}

document.getElementsByTagName('html')[0].style.marginTop = "0px !important";

ready(function() {

    var aside_wrapper = document.getElementsByClassName("aside_wrapper")[0];
    var els = [];
    while (aside_wrapper) {
        els.push(aside_wrapper);
        aside_wrapper = aside_wrapper.parentElement;
    }

    els.forEach(function(element, index){
        if (index) { 
            element.style.position = "static";
        }
    });

    var downloadWindow = document.getElementsByClassName('download')[0]; 

    try{
        document.getElementById('closeDownload').addEventListener('click', function(){
            downloadWindow.style.opacity = '0';
            setTimeout(function(){ downloadWindow.style.display = 'none'; }, 1000);
        });
    }catch(e){
        console.log('No download block detected');
    }

    var toggleAside = document.getElementById('toggle_aside');
    var aside = document.getElementsByClassName('ts-aside')[0];

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

    var languagesDropdown = document.querySelectorAll('.languages_dropdown li');

    var langArr = {
        'English' : 'en',
        'Deutsch' : 'de',
        'Español' : 'es',
        'Français' : 'fr',
        'Italiano' : 'it',  
        '日本語' : 'ja',
        '한국어' : 'ko',
        'Dutch' : 'nl', 
        'Português' : 'pt',
        'Русский' : 'ru',
        '简体中文' : 'zh_cn',
        '繁體中文' : 'zh_tw',
        'العربية' : 'ar',
        'Indonesian' : 'id',
        'Malay' : 'ms',
        'Vietnamese' : 'vi',
        'ภาษาไทย' : 'th',
        'Polski' : 'pl'
    };

    languagesDropdown.forEach(function(language){
        language.addEventListener('click', function(e){
            e.preventDefault();
            setCookie('userLanguage', langArr[ this.children[1].innerHTML ], 360 );
            window.location = window.location;
        });
    });


    var isLight = false;
    
    if (!getCookie('theme')){
        setCookie('theme', 'dark', 360);
        isLight = false;
    } else if ( getCookie('theme') == 'light'){
        document.getElementById('aside').classList.add('light');
        document.getElementById('top_panel').classList.add('light');
        document.getElementsByClassName('aside_wrapper')[0].classList.add('light_content');
        try{
            document.getElementById('bpfxcfd').classList.add('light_container');
        }catch(e){
            
        }
        try{
            document.getElementById('bpwidgets').classList.add('light_container');
        }catch(e){
            
        }
        try{
            document.getElementById('bpwidgets_popup').classList.add('bpwidgets_popup');
        }catch(e){
            
        }
        isLight = true;
    }
    
    try{
        var switch_theme = document.getElementById('switch_theme');
    
        switch_theme.addEventListener('click', function(){
            if (isLight){
                setCookie('theme', 'dark', 360);
            } else {
                setCookie('theme', 'light', 360);
            }

            isLight = !isLight;
            window.location.href=window.location.href;
        }); 
    }catch(e){
        console.log('Only 1 theme is installed');
    }

    var aside_imgs = document.querySelectorAll('nav ul li ul li img');

    if ( !getCookie('closedLeftPanel') ){
        setCookie('closedLeftPanel', 'no', 360);
    }

    aside_imgs.forEach(img => {
        img.addEventListener('click', function(){
            toggleAside.classList.remove('closed');
            toggleAside.classList.add('opened');
            aside.classList.remove('aside__hide');
            aside.classList.add('aside__show');
            document.getElementsByClassName('aside_wrapper')[0].classList.remove('closet_left_panel');
            var closedLeftPanel = getCookie('closedLeftPanel');
            if (closedLeftPanel == 'yes'){
                setCookie('closedLeftPanel', 'no' , 360);   
            } else if (closedLeftPanel == 'no'){
                setCookie('closedLeftPanel', 'yes' , 360);
            }  
            document.querySelectorAll('nav ul li ul li.target_li').forEach(element => {
                element.classList.toggle('li__with_items');
            });
        });
    });

    var menuItems = document.querySelectorAll('nav ul li');
    var menuItemsMobile = document.querySelectorAll('.left_burger-content ul li');

    menuItems.forEach( function(element){

        if (element.querySelectorAll('ul li').length > 1){
            element.querySelectorAll('ul li')[0].classList.add('li__with_items');
            element.querySelectorAll('ul li')[0].classList.add('target_li');
        }

    });

    menuItemsMobile.forEach( function(element){

        if (element.querySelectorAll('ul li').length > 1){
            element.querySelectorAll('ul li')[0].classList.add('li__with_items');
            element.querySelectorAll('ul li')[0].classList.add('target_li');
        }

    });

    var li_with_items = document.querySelectorAll('.target_li');

    try{
        if (li_with_items.length > 0){
            li_with_items.forEach(function(element){
    
                var visible = false;
                var visible_inside = false;
    
                element.addEventListener('click', function() {

                    visible_inside = false;

                    if (window.innerWidth > 501){
                        for(var i = 1; i < this.parentElement.children.length ; i++){
                            if ( this.parentElement.children[i].classList.contains('active') && !document.getElementById('aside').classList.contains('aside__hide')){
                                visible_inside = true;
                            }
                        }
                    }

                    if ( !document.getElementById('aside').classList.contains('aside__hide') ){
                        this.classList.toggle('li__with_items');
                        this.classList.toggle('li__with_items_opened');
                        
                        for(var i = 1; i < this.parentElement.children.length ; i++){
        
                            if (visible || visible_inside){
                                this.parentElement.children[i].style.display = 'none';
                            }else{
                                this.parentElement.children[i].style.display = 'inline-flex';
                            }  
                        }
        
                        visible = !visible;
                        if (visible_inside == true){
                            visible = false;
                        }
                    }
    
                });
    
            });
        }
    }catch(e){
        console.log("List item do not have children");
    }

    var asideMenuButtons = document.querySelectorAll('.aside-frame-button');

    asideMenuButtons.forEach(function(item){
        item.addEventListener('click', function(){
            var iframeURL = this.dataset.frame;
            var style = this.dataset.style;
            document.getElementById('aside-main').setAttribute('src', iframeURL);
            if(style){
                document.getElementById('aside-main').setAttribute('style', style);
            }
        });
    });

    document.querySelectorAll('a[href^="wow"]').forEach(function(element){
        element.parentElement.classList.add('getLoginPopUp');
    });

    // XXX: popup

    function createCross(){
        var cross = document.createElement('a');
        cross.setAttribute('href', '#');
        cross.setAttribute('id', 'widget_popup_cross');

        return cross;
    }

    function loginAndSignUpPopUp(target, another){
        document.getElementById('bpwidgets_popup').style.display = 'none';
        another.style.display = 'none';
        document.getElementById('loginPopUp__wrapper').style.display = "flex";
        target.style.display = 'block';
        target.childNodes[0].childNodes[0].style.width = "100%";
        var cross = createCross();
        target.append(cross);
    }

    try{
        var LoginPopUp = document.getElementsByClassName('getLoginPopUp');
        for(var i = 0; i < LoginPopUp.length; i++){
            LoginPopUp[i].addEventListener('click', function (e){
                e.preventDefault();

                if ( this.children[0].getAttribute('id') == 'LoginPopUp' ){
                    loginAndSignUpPopUp(document.getElementById('bpwidgets_popup_login'), document.getElementById('bpwidgets_popup_signup'));
                } else if (this.children[0].getAttribute('id') == 'OpenPopUp'){
                    loginAndSignUpPopUp(document.getElementById('bpwidgets_popup_signup'), document.getElementById('bpwidgets_popup_login') );
                }else{
                    document.getElementById('bpwidgets_popup_login').style.display = 'none';
                    document.getElementById('bpwidgets_popup_signup').style.display = 'none';
                    var currentState = this.querySelector('a').getAttribute('href').toString().trim().replace(/[\u200B-\u200D\uFEFF]/g, '');
                    var script = document.createElement('script');
                    script.className = "createdScript";
                    script.innerHTML = "bpApp({apiHost: 'https://bpw." + getCookie('apiHost') + "',themeSet: getCookie('theme') == 'light' ? widget_color_light : widget_color_dark, lang: getCookie('userLanguage').split('_').join('-'),state: '" + currentState + "', redirectSuccess: '" + document.location.href + "',redirectFailure: '" + document.location.href + "'}).render('#bpwidgets_popup');";
                    var cross = createCross();
                    document.getElementById('loginPopUp__wrapper').append(script);
                    document.getElementById('bpwidgets_popup').append(cross);
                    document.getElementById('widget_popup_cross').addEventListener('click', function(e){
                        e.preventDefault();
                        document.getElementById('loginPopUp__wrapper').style.display = "none";
                        document.getElementsByClassName('createdScript')[0].remove();
                        document.getElementById('bpwidgets_popup').innerHTML = "";
                    });
                    document.getElementById('loginPopUp__wrapper').style.display = "flex";
                    document.getElementById('bpwidgets_popup').style.display = 'block';
                    document.getElementById('bpwidgets_popup').childNodes[0].childNodes[0].style.width = "100%";
                }
            });
        }

        document.getElementById('loginPopUp__wrapper').addEventListener('click', function(){
            document.getElementById('loginPopUp__wrapper').style.display = "none";
            document.getElementsByClassName('createdScript')[0].remove();
            document.getElementById('bpwidgets_popup').innerHTML = "";
        });
        
    }catch(e){
        console.log("PopUp hidden");
    }

    // try{
    //     [...document.getElementsByClassName('text__page')[0].children].forEach(p => {
    //         if (p.children.item(0)){
    //             console.log(p.children.item(0));
    //             console.log(p.children.item(0))
    //         };
    //     });
    // }catch(e){
    //     console.log(e)
    // }


    var offset = new Date().toString().match(/([A-Z]+[\+-][0-9]+)/)[1];
    document.getElementById('timeZone').innerHTML = offset;

    function getCurrentTime(){
        var date = new Date();
        var hh = date.getHours();
        var mm = date.getMinutes();
        var ss = date.getSeconds();
    
        hh = hh < 10 ? '0'+hh : hh; 
        mm = mm < 10 ? '0'+mm : mm;
        ss = ss < 10 ? '0'+ss : ss;
    
        curr_time = hh+':'+mm+':'+ss;
        return curr_time;
    }

    var timer = setInterval(() => {
        document.getElementById('time').innerHTML = getCurrentTime();
    }, 1000);

    var burger_wrapper = document.getElementsByClassName('top-section__burger')[0];

    if(window.innerWidth <= 1000){
        burger_wrapper.classList.add('top-section__burger-closed');
    }

    window.addEventListener('resize', function(){
        if(window.innerWidth <= 1000){
            burger_wrapper.classList.add('top-section__burger-closed');
        } else {
            burger_wrapper.classList.remove('top-section__burger-closed');
        }
    });

    document.getElementById('top_section_burger').addEventListener('click', function(){
        burger_wrapper.classList.remove('top-section__burger-closed');
    });

    document.getElementById('top_section_cross').addEventListener('click', function(){
        burger_wrapper.classList.add('top-section__burger-closed');
    });

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    try{
        document.getElementById('bpwidgets').childNodes[0].style.height = '100%';
        document.getElementById('bpwidgets').childNodes[0].childNodes[0].style.width = '100%';
    }catch(e){  

    }
    try{
        document.getElementById('bpfxcfd').childNodes[0].style.height = '100%';
        document.getElementById('bpfxcfd').childNodes[0].childNodes[0].style.width = '100%';
    }catch(e){  

    }
    try{
        document.getElementById('optionsContainer').childNodes[0].style.height = '100%';
        document.getElementById('optionsContainer').childNodes[0].childNodes[0].style.width = '100%';
    }catch(e){  

    }

    if ( getCookie('closedLeftPanel') == 'no' ){
        toggleAside.classList.remove('closed');
        toggleAside.classList.add('opened');
        aside.classList.remove('aside__hide');
        aside.classList.add('aside__show');
        document.getElementsByClassName('aside_wrapper')[0].classList.remove('closet_left_panel');
    }

    if (document.getElementsByClassName('top_section')[0].childElementCount == 1){
        document.getElementsByClassName('top_section')[0].style.justifyContent = 'flex-end';
    }

    try{
        document.querySelector('input[name=test]').setAttribute('value', (document.querySelector('input[name=test]').getAttribute('value').trim()));
    }catch(e){
        console.log(e);
    }

    try{
        document.querySelector('input[name=switcher]').setAttribute('value', (document.querySelector('input[name=switcher]').getAttribute('value').trim()));
    }catch(e){
        console.log(e);
    }

    var navMenuItems = document.querySelectorAll('nav ul li ul li');
    var isPanelClosed = false;

    if (navMenuItems.length > 0){
        if ( document.getElementById('aside').classList.contains('aside__hide') ){
            isPanelClosed = true; 
        }
        navMenuItems.forEach(function(item){
            item.addEventListener('click', function(){
                navMenuItems.forEach(function(item){
                    item.classList.remove('active');
                });
                this.classList.add('active');
            });
            if ( isPanelClosed ){
                item.classList.remove('li__with_items');
            }
        });
    }

    try{
        var navMenuLists = document.querySelectorAll('nav ul li ul');

        navMenuLists.forEach(function(list){
            if (list.childElementCount == 1){
                list.querySelector('li a').style.margin = '0';
            }
        });
    }catch(e){
        console.log(e);
    }

    toggleAside.addEventListener('click', function(){
        this.classList.toggle('opened');
        this.classList.toggle('closed');
        aside.classList.toggle('aside__show');
        aside.classList.toggle('aside__hide');
        document.getElementsByClassName('aside_wrapper')[0].classList.toggle('closet_left_panel');
        document.querySelectorAll('nav ul li ul li.target_li').forEach(element => {
            element.classList.toggle('li__with_items');
        });
        if ( document.getElementById('aside').classList.contains('aside__hide') ){
            document.querySelectorAll('nav ul li ul li.target_li').forEach(element => {
                element.classList.remove('li__with_items_opened');
                element.classList.remove('active');
                element.classList.remove('li__with_items');
                for(var i = 1; i < element.parentElement.children.length ; i++){
                    element.parentElement.children[i].style.display = 'none';
                }
            });
        }
        var closedLeftPanel = getCookie('closedLeftPanel');
        if (closedLeftPanel == 'yes'){
            setCookie('closedLeftPanel', 'no' , 360);   
        } else if (closedLeftPanel == 'no'){
            setCookie('closedLeftPanel', 'yes' , 360);
        }  
    });

    var browserLanguage = navigator.language;

    if(browserLanguage.slice(0, 2) == 'en'){
        browserLanguage = browserLanguage.slice(0, 2);
    }

    // document.querySelectorAll('.languages_dropdown li a').forEach(element => {
    //     if (langArr[element.innerHTML] == browserLanguage){
    //         setCookie('userLanguage', browserLanguage, 360);
    //     }
    // });

    try{
        var left_burger = document.getElementsByClassName('left_burger')[0];
        var left_burger_content = document.getElementsByClassName('left_burger-content')[0];
        var right_burger = document.getElementsByClassName('right_burger')[0];
        var right_burger_content = document.getElementsByClassName('right_burger-content')[0];
        
        left_burger.addEventListener('click', function(){
            left_burger_content.classList.add('opened_left_burger-content');
        });

        right_burger.addEventListener('click', function(){
            right_burger_content.classList.add('opened_right_burger-content');
        });

        var left_burger_content_top_cross = document.getElementsByClassName('left_burger-content-top_cross')[0];
        var right_burger_content_top_cross = document.getElementsByClassName('left_burger-content-top_cross')[1];

        left_burger_content_top_cross.addEventListener('click', function(){
            left_burger_content.classList.remove('opened_left_burger-content');
        });

        right_burger_content_top_cross.addEventListener('click', function(){
            right_burger_content.classList.remove('opened_right_burger-content');
        });
    }catch(e){
        console.log('Not a mobile view');
    }

    var temp_window_link = window.location.href;

    if (window.location.href.substr(-1) == '/'){
        temp_window_link = window.location.href.slice(0, -1);
    }
    

    // XXX: FAQ section

    try{
        var switcher = document.querySelectorAll('.faq__page-navigation ul li');

        function removeSwitcher(){
            switcher.forEach( element => {
                element.classList.remove('active');
            });
        }

        switcher.forEach( element => {
            element.addEventListener('click', function(e){
                e.preventDefault();
                removeSwitcher();
                this.classList.add('active');
                if (this.getAttribute('id') == 'fx_faq'){
                    document.getElementById('simple_content').classList.add('hidded');
                    document.getElementById('fx_content').classList.remove('hidded');
                } else {
                    document.getElementById('simple_content').classList.remove('hidded');
                    document.getElementById('fx_content').classList.add('hidded');
                }
            });
        } );

        var answer_toggler = document.querySelectorAll('.answer_toggler');

        answer_toggler.forEach(element => {
            element.addEventListener('click', function(e){
                this.parentElement.classList.toggle('with_answer');
            });
        });
    }catch(e){
        console.log("this is not FAQ page");
    }

    if (window.innerWidth > 500){
        document.querySelectorAll('a[href="' + temp_window_link + '"]').forEach(element => {
            element.parentElement.classList.toggle('active');
            if (element.parentElement.parentElement.children[0].classList.contains('target_li') && !document.getElementById('aside').classList.contains('aside__hide') ){
                element.parentElement.parentElement.children[0].classList.remove('li__with_items');
                element.parentElement.parentElement.children[0].classList.add('li__with_items_opened');
                for(var i = 1; i < element.parentElement.parentElement.children.length ; i++){
                    element.parentElement.parentElement.children[i].style.display = 'inline-flex';
                }
            }
        } );
    }

});

