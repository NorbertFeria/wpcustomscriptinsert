jQuery(document).ready(function() {
    document.getElementById("defaultbtn").click();

    jQuery( document ).on( "click", ".rd_check", function() {
        if( jQuery(this).val() == "page" ){
            jQuery(this).parent().find('.text_selection').val('page');
            jQuery(this).parent().find('.select_input').show();
            jQuery(this).parent().find('.text_input').hide();
        }

        if( jQuery(this).val() == "contain" ){
            jQuery(this).parent().find('.text_selection').val('contain');
            jQuery(this).parent().find('.select_input').hide();
            jQuery(this).parent().find('.text_input').show();
        }
    });
    
    jQuery('#wpcs_hs_btn').on('click', function(e){
        e.preventDefault();
        var newelement = jQuery(".wpcsi_hs_blank").clone();

        newelement.addClass('wpcsi_hs');
        newelement.removeClass('wpcsi_hs_blank');
        let r = Math.random().toString(36).slice(2, 7);

        newelement.html(function(index,html){
            return html.replace(/header_scripts_visibilty_selection/,'header_select_'+r);
        });

        newelement.html(function(index,html){
            return html.replace(/header_scripts_visibilty_selection2/,'header_select_'+r);
        });

        newelement.html(function(index,html){
            return html.replace(/header_scripts_visibilty_selection_text/,'csi_settings[header_scripts_visibilty_selection][]');
        });
                
        newelement.html(function(index,html){
            return html.replace(/header_script_textarea/,'csi_settings[header_scripts][]');
        });

        newelement.html(function(index,html){
            return html.replace(/header_script_visibility/,'csi_settings[header_scripts_visibilty][]');
        });

        newelement.html(function(index,html){
            return html.replace(/header_scripts_contain/,'csi_settings[header_scripts_contain][]');
        });

        newelement.insertAfter("div.wpcsi_hs:last");
    });

    jQuery('#wpcs_abs_btn').on('click', function(e){
        e.preventDefault();
        var newelement = jQuery(".wpcsi_ab_blank").clone();

        newelement.addClass('wpcsi_ab');
        newelement.removeClass('wpcsi_ab_blank');

        let r = Math.random().toString(36).slice(2, 7);

        newelement.html(function(index,html){
            return html.replace(/after_body_visibilty_selection/,'after_body_select_'+r);
        });

        newelement.html(function(index,html){
            return html.replace(/after_body_visibilty_selection2/,'after_body_select_'+r);
        });

        newelement.html(function(index,html){
            return html.replace(/after_body_visibilty_selection_text/,'csi_settings[after_body_visibilty_selection][]');
        });
                
        newelement.html(function(index,html){
            return html.replace(/after_body_textarea/,'csi_settings[after_body][]');
        });

        newelement.html(function(index,html){
            return html.replace(/after_body_visibility/,'csi_settings[after_body_visibilty][]');
        });

        newelement.html(function(index,html){
            return html.replace(/after_body_contain/,'csi_settings[after_body_contain][]');
        });

        newelement.insertAfter("div.wpcsi_ab:last");
    });

    
    jQuery('#wpcs_sc_btn').on('click', function(e){
        e.preventDefault();
        var newelement = jQuery(".wpcsi_sc_blank").clone();

        newelement.addClass('wpcsi_sc');
        newelement.removeClass('wpcsi_sc_blank');

        newelement.html(function(index,html){
            return html.replace(/shortcode_scripts/,'csi_settings[shortcode_scripts][]');
        });

        newelement.html(function(index,html){
            return html.replace(/shortcode_text/,'csi_settings[shortcode_text][]');
        });

        newelement.insertAfter("div.wpcsi_sc:last");
    });
    

    jQuery('#wpcs_fs_btn').on('click', function(e){
        e.preventDefault();
        var newelement = jQuery(".wpcsi_fs_blank").clone();

        newelement.addClass('wpcsi_fs');
        newelement.removeClass('wpcsi_fs_blank');

        let r = Math.random().toString(36).slice(2, 7);

        newelement.html(function(index,html){
            return html.replace(/footer_scripts_visibilty_selection/,'footer_select_'+r);
        });

        newelement.html(function(index,html){
            return html.replace(/footer_scripts_visibilty_selection2/,'footer_select_'+r);
        });

        newelement.html(function(index,html){
            return html.replace(/footer_scripts_visibilty_selection_text/,'csi_settings[footer_scripts_visibilty_selection][]');
        });
                
        newelement.html(function(index,html){
            return html.replace(/footer_script_textarea/,'csi_settings[footer_scripts][]');
        });

        newelement.html(function(index,html){
            return html.replace(/footer_script_visibility/,'csi_settings[footer_scripts_visibilty][]');
        });

        newelement.html(function(index,html){
            return html.replace(/footer_script_contain/,'csi_settings[footer_scripts_contain][]');
        });

        newelement.insertAfter("div.wpcsi_fs:last");
    });

    jQuery( document ).on( "click", ".removescript", function(e) {
        e.preventDefault();
        jQuery(this).parent().parent().remove();
    });
   
});

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    evt.preventDefault();
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}