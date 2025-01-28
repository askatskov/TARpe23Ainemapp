( function( $ ) {
	"use strict";

	/*
	 * Change Tabs.
	 */
	$( document ).on( 'click', '.dashboard-panel-tabs .dashboard-panel-tab a', function( e ) {

		let $index = $( this ).closest( '.dashboard-panel-tab' ).index();

		// Nav Tabs.
		$( this ).closest( '.dashboard-panel-tab' ).addClass( 'dashboard-panel-tab-active' ).siblings().removeClass( 'dashboard-panel-tab-active' );

		// Content Tabs.
		$( '.dashboard-panel-content-tabs .dashboard-panel-tab' ).eq( $index ).addClass( 'dashboard-panel-tab-active' ).siblings().removeClass( 'dashboard-panel-tab-active' );

		e.preventDefault();
	} );

	/*
	 * Help toggle
	 */
	$( document ).on( 'click', '.feature-help-icon', function( e ) {
		$( this ).toggleClass( 'is-active' );
		$( this ).next( '.feature-help-info' ).fadeToggle( 'fast' );
	} );	

    // Remove image.
    jQuery(document).on('click', 'input.btn-image-remove', function (e) {

        e.preventDefault();
        var $this = $(this);
        var image_field = $this.siblings('.img');
        image_field.val('');
        var image_preview_wrap = $this.siblings('.image-preview-wrap');
        image_preview_wrap.html('');
        $this.css('display', 'none');
        image_field.trigger('change');

    });

    $('.twp-img-upload-button').click(function () {

        event.preventDefault();
        var imgContainer = $(this).closest('.twp-img-fields-wrap').find('.twp-thumbnail-image .twp-img-container'),
            removeimg = $(this).closest('.twp-img-fields-wrap').find('.twp-img-delete-button'),
            imgIdInput = $(this).siblings('.upload-id');
        var frame;

        // Create a new media frame
        frame = wp.media({
            title: restochef_localize.upload_image,
            button: {
                text: restochef_localize.use_image
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
            // Send the attachment URL to our custom image input field.
            imgContainer.html('<img src="' + attachment.url + '" style="width:200px;height:auto;" />');
            removeimg.addClass('twp-img-show');
            // Send the attachment id to our hidden input
            imgIdInput.val(attachment.url).trigger('change');

        });

        // Finally, open the modal on click
        frame.open();

    });

    // DELETE IMAGE LINK
    $('.twp-img-delete-button').click(function () {

        event.preventDefault();
        var imgContainer = $(this).closest('.twp-img-fields-wrap').find('.twp-thumbnail-image .twp-img-container');
        var removeimg = $(this).closest('.twp-img-fields-wrap').find('.twp-img-delete-button');
        var imgIdInput = $(this).closest('.twp-img-fields-wrap').find('.upload-id');
        // Clear out the preview image
        imgContainer.find('img').remove();
        removeimg.removeClass('twp-img-show');
        // Delete the image id from the hidden input
        imgIdInput.val('').trigger('change');

    });


} )( jQuery );
