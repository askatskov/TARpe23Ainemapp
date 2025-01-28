//tab js
jQuery(document).ready(function($) {
    $('.st-gs-tab-holder ul li .st-gs-tab').on( 'click', function() {
        var uniqueClass = $(this).attr('class').split(' ')[1];
        $('.st-gs-tab').removeClass('active');
        $(this).addClass('active');
        $('.st-gs-tab-content-holder .st-gs-tab-content').removeClass('show');
        $('#' + uniqueClass).addClass('show');
        setTimeout(function(){
            $('.st-gs-tab-content-holder .st-gs-tab-content').removeClass('active');
            $('#' + uniqueClass).addClass('active');
        },400);
    });
});