jQuery(function($){
    $(document).ready(function(){

        var removeImg = $('.remove_img');

        removeImg.on('click', function(e){
            e.preventDefault();
            $(this).parent().parent().siblings('td').children('input').val(' ');
            $(this).parent().parent().siblings('td').children('a').children('img').attr('src', ' ');
        });

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

        var select = $('select[name="language"]');

        var regex = /[?&]([^=#]+)=([^&#]*)/g,
            url = window.location.href,
            params = {},
            match;
        while(match = regex.exec(url)) {
            params[match[1]] = match[2];
        }

        select.children(`option[value="${params['language']}"]`).attr('selected', 'selected');

        if (getCookie('language_switcher') == 'yes'){
            window.location = window.location;
            setCookie('language_switcher', 'no', 360);
        }

        $('input[name="submit_lang"]').on('click', function(){
            setCookie('language_switcher', 'yes', 360);
        });

        $(document).on('click', '.addMenu' , function(e){
            e.preventDefault();
            $(this).parent().parent().after(
                `<tr data-num="${$(this).parent().parent().data('num') + 1}">
                    <th scope="row">
                        <label for="blogname">Menu item</label>
                    </th>
                    <td>
                        <a href="#" class="img-upl previewIcon"> Add icon </a>
                        <input type="hidden" class="hidden_icon" name="icon[]" value=" ">
                        <input placeholder="Menu" name="menu-item[]" type="text">
                        <input placeholder="Link (if submenu is empty)" type="text" class="menu_link" name="menu-link[${$(this).parent().parent().data('num') + 1}]">
                        <a href="#" title="Add Submenu Item" class="addSubmenu">+</a>
                        <a href="#" title="Remove Menu Item" class="minus">-</a>
                        <input type="hidden" name="submenu-item[][]" value=" ">
                        <input type="hidden" name="submenu-link[][]" value=" ">
                    </td>
                </tr>`
            );

            $(this).parent().parent().next().children('td').children('.addSubmenu').before('<a href="#" title="Add Submenu Item" class="addMenu">+</div>');

            $(this).remove();
        });

        if ($('.wrap h1').text() == 'Faq simple'){

            $(document).on('click', '.addQuestion' , function(e){
                e.preventDefault();
                $(this).parent().parent().after(
                    `<tr class="faq" data-num="${$(this).parent().parent().data('num') + 1}">
                        <th scope="row">
                            <label >Question and answer</label>
                        </th>
                        <td>
                            <input type="text" name="questions[${$(this).parent().parent().data('num') + 1}]" class="questions" placeholder="Question">
                            <textarea name="answers[${$(this).parent().parent().data('num') + 1}]" cols="30" rows="10"></textarea>
                            <a href="#" title="Add Menu Item" class="addQuestion">+</a>
                            <a href="#" title="Remove Menu Item" class="minusQuestion">-</a>
                        </td>
                    </tr>`
                );
    
                $(this).remove();
            });

            $(document).on('click', '.minusQuestion', function(e){
                e.preventDefault();
    
                $(this).parent().parent().remove();
            });

        }else if ($('.wrap h1').text() == 'Faq FX'){
            $(document).on('click', '.addQuestion' , function(e){
                e.preventDefault();
                $(this).parent().parent().after(
                    `<tr class="faq" data-num="${$(this).parent().parent().data('num') + 1}">
                        <th scope="row">
                            <label >Question and answer</label>
                        </th>
                        <td>
                            <input type="text" name="questions_fx[${$(this).parent().parent().data('num') + 1}]" class="questions" placeholder="Question">
                            <textarea name="answers_fx[${$(this).parent().parent().data('num') + 1}]" cols="30" rows="10"></textarea>
                            <a href="#" title="Add Menu Item" class="addQuestion">+</a>
                            <a href="#" title="Remove Menu Item" class="minusQuestion">-</a>
                        </td>
                    </tr>`
                );
    
                $(this).remove();
            });

            $(document).on('click', '.minusQuestion', function(e){
                e.preventDefault();

                $(this).parent().parent().remove();
                
            });
        }

        $(document).on('click', '.addMenuTopPanel' , function(e){
            e.preventDefault();
            $(this).parent().parent().after(
                `<tr data-num="${$(this).parent().parent().data('num') + 1}">
                    <th scope="row">
                        <label for="blogname">Menu item</label>
                    </th>
                    <td>
                        <input placeholder="Menu" name="menu-item[]" type="text">
                        <input placeholder="Link" type="text" class="menu_link" name="menu-link[]">
                        <a href="#" title="Remove Menu Item" class="minus">-</a>
                    </td>   
                </tr>`
            );

            $(this).parent().parent().next().children('td').children('.minus').before('<a href="#" title="Add Submenu Item" class="addMenuTopPanel">+</div>');

            $(this).remove();
        });

        $(document).on('click', '.addSubmenu' , function(e){
            e.preventDefault();
            $(this).parent().children('.menu_link').remove();
            $(this).parent().parent().append(
                `<td class="submenu">   
                    <div class="submenu__th">
                        <label>Submenu item</label>
                    </div>
                    <div class="submenu__content">
                        <input required placeholder="Submenu" value=" " type="text" name="submenu-item[${$(this).parent().parent().closest("tr").data('num')}][]">
                        <input required placeholder="Link" type="text" name="submenu-link[${$(this).parent().parent().closest("tr").data('num')}][]">
                        <a href="#" title="Remove Submenu Item" class="minus">-</a>
                    </div>
                </td>`
            );
            $(this).parent().children('input[name="submenu-item[][]"]').remove();
            $(this).parent().children('input[name="submenu-link[][]"]').remove();
            $(this).parent().parent('').children('input[name="sub-icon[][]"]').remove();
        });

        $(document).on('click', '.minus', function(e){
            e.preventDefault();

            $(this).parent().parent().remove();
        });

        $(document).on('click', '.hide_panels', function(e){
            $(this).val($(this).val() == 0 ? 1 : 0);
            $(this).prop( "checked", $(this).val() == 0 ? false : true );
        });

        

    });
});