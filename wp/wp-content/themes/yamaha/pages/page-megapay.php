<?php
/**
 * @author HUNG VO
 * created Date: 10/12/2021
 * project: yamaha-revzone-website
 *
 * Template Name: MEGAPAY
 *
 */

get_header();
?>
<?php 
	
	$result = $_GET;
	$plugin_dir = ABSPATH . 'wp-content/plugins/commerce-cms/';
	include($plugin_dir.'api/megapay/Payment.php');
	$payment = new Payment();

	// verify merchantToken
	$check = $payment->checkToken($result);
	$error = '';
	if (!$check) {
	    $error = 'Invalid Merchant Token';
	}	

	global $wpdb ;
	$payment_historyTable = $wpdb->prefix.'payment_history';
	if(array_key_exists("merchantToken", $result)) {
		$str = "SELECT * FROM $payment_historyTable WHERE merTrxId ='". $result['merTrxId'] ."' LIMIT 1";
		$payment_history = $wpdb->get_results( $str);
		var_dump($result['merchantToken']);die();
		if ( ! empty( $payment_history ) ) {
			$rs = $payment_history[0];
			if($rs->status == 0){
				$data_payment_history = array(
					'ID' => $rs->ID,
					'trxId' => $result['trxId']??'',
					'merId' => $result['merId']??'',
					'merTrxId' => $result['merTrxId']??'',
					'resultCd' => $result['resultCd']??'',
					'resultMsg' => $result['resultMsg']??'',
					'invoiceNo' => $result['invoiceNo']??'',
					'currency' => $result['currency']??'',
					'goodsNm' => $result['goodsNm']??'',
					'payType' => $result['payType']??'',
					'payToken' => $result['payToken']??'',
					'userId' => $result['userId']??'',
					'transDt' => $result['transDt']??'',
					'transTm' => $result['transTm']??'',
					'buyerFirstNm' => $result['buyerFirstNm']??'',
					'buyerLastNm' => $result['buyerLastNm']??'',
					// 'timeStamp' => $result['timeStamp']??'',
					'bankId' => $result['bankId']??'',
					'bankName' => $result['bankName']??'',
					'cardNo' => $result['cardNo']??'',
					'date_updated' => current_time( $type='mysql', $gmt = true),
				);
				if($error == ''){
					//ss
					$data_payment_history['status'] = 1;
					
					if(! empty( $rs->order_id )){
						$order_ID = $wpdb->update($wpdb->prefix.'orders', array('ID'=>$rs->order_id,'order_status'=>'3'), array('ID'=>$rs->order_id));
					}
				}else{
					//error
					$data_payment_history['status'] = 2;
				}

				$payment_historyID = $wpdb->update($wpdb->prefix.'payment_history', $data_payment_history, array('ID'=>$rs->ID));
			}else{
				$error = 'Phiên Giao dịch đã hết hạn!';
			}


			// $userID = $wpdb->update($wpdb->prefix.'users', $dataus, $where = array('ID'=>$dataus['ID'])); 
			// var_dump($payment_historyID);
			// var_dump($wpdb->last_query);
			// die();  			

		}
	}
	
 ?>
    <div class="tab-content current">
        <?php if ($error == '') { ?>
            <h3>PAYMENT RESULT: <span><?php echo $result['resultMsg'] ?></span></h3>
            <div class="row">
                <table>
                    <tr>
                        <td class="column_left">trxId</td>
                        <td class="column_right">
                            <?php echo $result['trxId'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">merId</td>
                        <td class="column_right">
                            <?php echo $result['merId'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">merTrxId</td>
                        <td class="column_right">
                            <?php echo $result['merTrxId'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">resultCd</td>
                        <td class="column_right">
                            <?php echo $result['resultCd'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">resultMsg</td>
                        <td class="column_right">
                            <?php echo $result['resultMsg'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">invoiceNo</td>
                        <td class="column_right">
                            <?php echo $result['invoiceNo'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">amount</td>
                        <td class="column_right">
                            <?php echo $result['amount'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">currency</td>
                        <td class="column_right">
                            <?php echo $result['currency'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">goodsNm</td>
                        <td class="column_right">
                            <?php echo $result['goodsNm'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">payType</td>
                        <td class="column_right">
                            <?php echo $result['payType'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">payToken</td>
                        <td class="column_right">
                            <?php if(array_key_exists("payToken", $result)) echo $result['payToken'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">merchantToken</td>
                        <td class="column_right">
                            <?php echo $result['merchantToken'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">userId</td>
                        <td class="column_right">
                            <?php echo $result['userId'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">transDt</td>
                        <td class="column_right">
                            <?php echo $result['transDt'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">transTm</td>
                        <td class="column_right">
                            <?php echo $result['transTm'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">buyerFirstNm</td>
                        <td class="column_right">
                            <?php echo $result['buyerFirstNm'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">buyerLastNm</td>
                        <td class="column_right">
                            <?php echo $result['buyerLastNm'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">timeStamp</td>
                        <td class="column_right">
                            <?php echo $result['timeStamp'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">bankId</td>
                        <td class="column_right">
                            <?php echo $result['bankId'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">bankName</td>
                        <td class="column_right">
                            <?php echo $result['bankName'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="column_left">cardNo</td>
                        <td class="column_right">
                            <?php echo $result['cardNo'] ?>
                        </td>
                    </tr>
                </table>
            </div>
        <?php } else { ?>
            <h3>PAYMENT RESULT: <span style="color: red;"><?= $error?></span></h3>
        <?php } ?>
    </div>

<?php
get_footer();
?>
