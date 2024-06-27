jQuery(document).ready(function($) {

    jQuery( ".ccmsuserot" ).each(function() {
        var ccmsuserot = jQuery( this );
        var ccmsdata = {
            'action': 'ccms_caluot',
            'customer_id': jQuery( this ).data( "user" )
        };
        jQuery.post(ccms_ajax_object.ajax_url, ccmsdata, function(response) {
            ccmsuserot.html(response);
        });
    });

    jQuery( ".ccmsuseros" ).each(function() {
        var ccmsuseros = jQuery( this );
        var ccmsdata = {
            'action': 'ccms_caluos',
            'customer_id': jQuery( this ).data( "user" )
        };
        jQuery.post(ccms_ajax_object.ajax_url, ccmsdata, function(response) {
            ccmsuseros.html(response);
        });
    });
});
