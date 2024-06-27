<?php
    include('Payment.php');
    include('tripleDES.php');
    
    $data = file_get_contents('php://input');
    $requestObj = json_decode($data, true);

    if($requestObj == null) {
    	echo json_encode(array('success' => false, 'mes' => 'Invalid request data!'));
    }

    $amount = '';
    $payOption = '';
    $userId = "";

    if(array_key_exists("amount", $requestObj) && !empty($requestObj['amount'])){
	    $amount = $requestObj['amount'];
    } else {
    	echo json_encode(array('success' => false, 'mes' => 'Invalid amount: '.$amount));
    }

    if(array_key_exists("payOption", $requestObj) && !empty($requestObj['payOption'])){
	    $payOption = $requestObj['payOption'];
    }

	$payment = new Payment();

    $timeStamp = date('YmdHis');
    $merTrxId = 'MERTRXID'.$timeStamp.'_'.rand(100,10000);
    $invoiceNo = 'Order_'.$timeStamp.'_'.rand(100,10000);
    $description = 'TT Hoa Don: ' . $invoiceNo;
    
    if($payOption == 'PAY_CREATE_TOKEN' || $payOption == ''){
    	$plainTxtToken = $timeStamp . $merTrxId . $payment::MER_ID . $amount . $payment::ENCODE_KEY;
        // echo $plainTxtToken;
    	$token = hash('sha256', $plainTxtToken);

    	$result = json_encode(array('success' => true, 'description' => $description, 'amount' => $amount, 'merchantToken' => $token, 'timeStamp' => $timeStamp, 'merId' => $payment::MER_ID, 'invoiceNo' => $invoiceNo, 'merTrxId' => $merTrxId, 'domain' => $payment::DOMAIN));
        
    	if ($payOption != ''){
    		if(array_key_exists("userId", $requestObj) && !empty($requestObj['userId'])){
				$userId = $requestObj["userId"];
			} else {
		    	echo json_encode(array('success' => false, 'mes' => 'Invalid userId'));
		    }
			$data = json_encode(
				array(
					'userId' => $userId,
					'payToken' => ''
				)
			);
			file_put_contents("userinfo/".$merTrxId.'.txt', $data);
    	}
    	echo $result;
    } else if($payOption == 'PAY_WITH_TOKEN'){
    	if(array_key_exists("userId", $requestObj) && !empty($requestObj['userId'])){
		    $userId = $requestObj['userId'];
		    $path = "userinfo/".$userId.'.txt';
			$tripdes = new TripleDES();

			//get payToken:
			$payToken = json_decode(file_get_contents($path), true)['payToken'];
			$clearPayToken = $tripdes -> decrypt3DES($payToken, $payment::KEY3DES_DECRYPT);
			$encryptedPayToken = $tripdes -> encrypt3DES($clearPayToken, $payment::KEY3DES_ENCRYPT);

			//create merchantToken:
			$plainTxtToken = $timeStamp . $merTrxId . $payment::MER_ID . $amount . $encryptedPayToken . $payment::ENCODE_KEY;
			$token = hash('sha256', $plainTxtToken);

			$result = json_encode(array('success' => true, 'description' => $description, 'amount' => $amount, 'merchantToken'  => $token, 'timeStamp' => $timeStamp, 'merId' => $payment::MER_ID, 'invoiceNo' => $invoiceNo, 'merTrxId' => $merTrxId, 'domain' => $payment::DOMAIN, 'payToken' => $encryptedPayToken));

			echo $result;
	    } else {
	    	echo json_encode(array('success' => false, 'mes' => 'Error!! check userId.'));
	    }
    }
?>