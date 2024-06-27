$(function() {
    var quantity = $(".quantity");
	if(quantity.text() == '' || quantity.text() == 'NaN'){
		quantity.text('1');
	}
    //
    $(document).on("click", ".btn-plus", function() {
        let currentE = $(this).parent().find(quantity);
        let count = parseInt(currentE.text());
        count++;
        currentE.text(count);
    });

    $(document).on("click", ".btn-mins", function() {
        let currentE = $(this).parent().find(quantity);
        let count = parseInt(currentE.text());
        if(count>1)count--;
        currentE.text(count);
    });

    $(document).on("click", ".quantity", function() {
        let tempDiv = $(this);
        let input = $('<input />', {
            'type': 'number',
            'name' : 'quantity',
            'min' : '1',
            'max' : '99'
        });
        $(this).replaceWith(input);
        $('input[name=quantity]').focus();
        $('input[name=quantity]').val($(this).text());
        $('input[name=quantity]').focusout(function() {
            $(this).replaceWith(tempDiv);
            let count = parseInt($(this).val());
            if(isNaN(count) || count<1)count = 1;
            tempDiv.text(count);
        });
    });
});