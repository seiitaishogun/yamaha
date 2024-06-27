<link rel="stylesheet" href="https://sandbox.megapay.vn:2810/pg_was/css/payment/layer/paymentClient.css" type="text/css" media="screen">
<script type="text/javascript" src="https://sandbox.megapay.vn:2810/pg_was/js/payment/layer/paymentClient.js"></script>
<div>
	<h5>PHƯƠNG THỨC THANH TOÁN</h5> 
	<div class="payments">
		<input type="radio" name="payments" value="DC" class="checkbox chkpayments" id="chkPTTT2" >
			<label for="chkPTTT2"> Domestic Card (ATM/NAPAS) </label><br>
		<input type="radio" name="payments" value="IC" class="checkbox chkpayments" id="chkPTTT3" >
		<label for="chkPTTT3"> Credit/Debit Card </label><br>
		<input type="radio" name="payments" value="IS" class="checkbox chkpayments" id="chkPTTT4" >
		<label for="chkPTTT4"> Installment </label> 
		<br>
			<input type="radio" name="payments" value="Showroom" class="checkbox chkpayments" id="chkPTTT1" checked="checked">
				<label for="chkPTTT1"> Showroom YMH </label>
		
	</div>
</div>
<?php 
	include_once(WP_PLUGIN_DIR.'/commerce-cms/html/megapay-script.php') ; 
?>