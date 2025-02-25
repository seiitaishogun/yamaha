jQuery( document ).ready( function() { 
    var _ymh_media = true;
    var _ymh_send_attachment = wp.media.editor.send.attachment;
    jQuery( '.avatar-image' ).click( function() {
        var button = jQuery( this ),
                textbox_id = jQuery( this ).attr( 'data-id' ),
                image_id = jQuery( this ).attr( 'data-src' ),
                _shr_media = true;
        wp.media.editor.send.attachment = function( props, attachment ) {
            if ( _shr_media && ( attachment.type === 'image' ) ) {
                if ( image_id.indexOf( "," ) !== -1 ) {
                    image_id = image_id.split( "," );
                    $image_ids = '';
                    jQuery.each( image_id, function( key, value ) {
                        if ( $image_ids )
                            $image_ids = $image_ids + ',#' + value;
                        else
                            $image_ids = '#' + value;
                    } );
                    var current_element = jQuery( $image_ids );
                } else {
                    var current_element = jQuery( '#' + image_id );
                }
                jQuery( '#' + textbox_id ).val( attachment.id );
                    console.log(textbox_id)
                current_element.attr( 'src', attachment.url ).show();
            } else {
                alert( 'Vui lòng chọn một tập tin hình ảnh hợp lệ.' );
                return false;
            }
        }
        wp.media.editor.open( button );
        return false;
    } );
} );