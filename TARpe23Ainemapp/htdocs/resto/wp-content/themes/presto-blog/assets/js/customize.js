jQuery(document).ready(function($){

   	//Scroll to front page section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        prestoblogScrollToSection( section_id );
    });

    $('body').on('click', '#accordion-section-footer_settings .accordion-section-title', function(event) {
        var section_id = $(this).parent().attr('id');
        prestoblogScrollToFooterSection( section_id );
    });

    $('body').on('click', '.flush-it', function(event) {
        $.ajax ({
            url     : presto_blog_data.ajax_url,  
            type    : 'post',
            data    : 'action=flush_local_google_fonts',    
            nonce   : presto_blog_data.nonce,
            success : function(results){
                //results can be appended in needed
                $( '.flush-it' ).val(presto_blog_data.flushit);
            },
        });
    });

});

function prestoblogScrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-about_home_section':
        preview_section_id = "about_section";
        break;
        
        case 'accordion-section-featured_section':
        preview_section_id = "featured_section";
        break;
        
        case 'accordion-section-header_image':
        preview_section_id = "banner_section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

function prestoblogScrollToFooterSection( section_id ){
    var preview_section_id = "colophon";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-footer_settings':
        preview_section_id = "colophon";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}