(function ($) {

    // Metabox Tab
    $('.metabox-navbar a').click(function () {
        var tabid = $(this).attr('id');
        $('.metabox-navbar a').removeClass('metabox-navbar-active');
        $(this).addClass('metabox-navbar-active');
        $('.twp-tab-content .metabox-content-wrap').hide();
        $('.twp-tab-content #' + tabid + '-content').show();
        $('.twp-tab-content .metabox-content-wrap').removeClass('metabox-content-wrap-active');
        $('.twp-tab-content #' + tabid + '-content').addClass('metabox-content-wrap-active');
    });

}(jQuery));