//Load Image on Widget
jQuery( document ).ready( function($) {
     function media_upload( button_class ) {
        var _custom_media = false,
        _orig_send_attachment = wp.media.editor.send.attachment;
        $( 'body' ).on( 'click', button_class, function(e) {
            var button_id ='#'+$( this ).attr( 'id' );
            var self = $( button_id );
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $( button_id );
            var id = button.attr( 'id' ).replace( '_button', '' );
            _custom_media = true;
            wp.media.editor.send.attachment = function( props, attachment ){
                if ( _custom_media  ) {
                    $( '.custom_media_id' ).val( attachment.id );
                    $( '.custom_media_url' ).val( attachment.url );
                    $( '.custom_media_image' ).attr( 'src', attachment.url ).css( 'display','block' );
                } else {
                    return _orig_send_attachment.apply( button_id, [props, attachment] );
                }
            }
            wp.media.editor.open( button );
                return false;
        });
     }

     media_upload( '.custom_media_button' );

    $( '.restochef-install-plugins' ).click( function (e) {
        e.preventDefault();
        $( this ).addClass( 'updating-message' );
        $( this ).text( restochef_adi_install.btn_text );

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action     : 'restochef_getting_started',
                security : restochef_adi_install.nonce,
                slug : 'demo-import-kit',
                request : 1
            },
            success:function( response ) {
                setTimeout( function(){
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action     : 'restochef_getting_started',
                            security : restochef_adi_install.nonce,
                            slug : 'themeinwp-import-companion',
                            request : 2
                        },
                        success:function( response ) {
                            setTimeout( function(){
                                $.ajax({
                                    type: "POST",
                                    url: ajaxurl,
                                    data: {
                                        action     : 'restochef_getting_started',
                                        security : restochef_adi_install.nonce,
                                        slug : 'mailchimp-for-wp',
                                        request : 3
                                    },
                                    success:function( response ) {
                                        var extra_uri, redirect_uri, dismiss_nonce;
                                        redirect_uri         = restochef_adi_install.adminurl+'/themes.php?page=demo-import-kit&browse=all';
                                        window.location.href = redirect_uri;
                                    },
                                    error: function( xhr, ajaxOptions, thrownError ){
                                        console.log( thrownError );
                                    }
                                });
                            }, 500);
                        },
                        error: function( xhr, ajaxOptions, thrownError ){
                            console.log( thrownError );
                        }
                    });
                }, 500);
            },
            error: function( xhr, ajaxOptions, thrownError ){
                console.log( thrownError );
            }
        });
    } );

});

