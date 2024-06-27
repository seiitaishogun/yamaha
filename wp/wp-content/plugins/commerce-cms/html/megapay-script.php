<script type="text/javascript"> 
window.addEventListener('message', function(e) {
    if (e.data.closeLayer == 'close') {
        window.top.closeLayer();
    }
});

// Function Payment
function payment(userId, payOpt,orderId) {
    $.ajax({
        // url : "process.php",
        url : ajaxurl,
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'megapay_process',
            // amount: amount,
            // userFee: '',
            userId: userId,
            orderId: orderId
            // payOption: ''
        },
        // contentType: "application/json",

        success : function(res) {
            console.log(res);
            if (res.success) {
                var domain = res.domain;
                paymentForm = document.getElementById('megapayForm');

                paymentForm.elements["description"].value = res.description;
                paymentForm.elements["amount"].value = res.amount;
                paymentForm.elements["timeStamp"].value = res.timeStamp;
                paymentForm.elements['invoiceNo'].value = res.invoiceNo;
                paymentForm.elements['merTrxId'].value = res.merTrxId;
                paymentForm.elements['merId'].value = res.merId;
                paymentForm.elements["merchantToken"].value = res.merchantToken;
                paymentForm.elements["payType"].value = $('input[name=payments]:checked', '.payments').val();
                if (res.payToken) {
                    paymentForm.elements["payToken"].value = res.payToken;
                }
                console.log(paymentForm);

                openPayment(1, domain);
            } else {
                alert(res.mes);
            }
        },
        error : function() {
            alert('Có lỗi trong quá trình xử lý!');
        }
    });
}
</script>