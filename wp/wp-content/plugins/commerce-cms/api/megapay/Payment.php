<?php

class Payment
{
    // Check Token Response
    const MER_ID = 'EPAY000001';
    const ENCODE_KEY = 'rf8whwaejNhJiQG2bsFubSzccfRc/iRYyGUn6SPmT6y/L7A2XABbu9y4GvCoSTOTpvJykFi6b1G0crU8et2O0Q==';
    const CANCEL_PASSWORD = 'WfP7i2r/lMbcW6JyL6H6p8jnF7EiTUu3mCf2KDELqieic3JwT99M3TrBqlFjdg5v2oBXED9XcILVSxalBIexhg==';
    const DOMAIN = 'https://sandbox.megapay.vn:2810';
    const CHECKTRANS_URL = 'https://sandbox.megapay.vn:2810/pg_was/order/trxStatus.do';
    const CACELTRANS_URL = 'https://sanbox.megapay.vn:2810/pg_was/cancel/paymentCancel.do';
    const KEY3DES_ENCRYPT = 'pvJykFi6b1G0crU8et2O0Q==';
    const KEY3DES_DECRYPT = 'rf8whwaejNhJiQG2bsFubSzc';

    public function checkToken($data)
    {
        $resultCd = $data['resultCd'];
        $timeStamp = $data['timeStamp'];
        $merTrxId = $data['merTrxId'];
        $trxId = $data['trxId'];
        $amount = $data['amount'];

        if(array_key_exists("payToken", $data)){
            $str = $resultCd . $timeStamp . $merTrxId . $trxId . self::MER_ID . $amount . $data['payToken'] . self::ENCODE_KEY;
        } else {
            $str = $resultCd . $timeStamp . $merTrxId . $trxId . self::MER_ID . $amount . self::ENCODE_KEY;
        }
        
        $token = hash('sha256', $str);
        
        $tokenResponse = $data['merchantToken'];

        if ($token != $tokenResponse) {
            return false;
        }

        return true;
    }

    public function randomString($length, $chars){
        $size = strlen( $chars );
        $str = '';
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
    }

    public function checkTransStatus($merTrxId){
        $timeStamp = date('YmdHis');
        $dataToken = $timeStamp . $merTrxId . self::MER_ID . self::ENCODE_KEY;
        $merchantToken = hash('sha256', $dataToken);
        // $reqStr = 'merId=' . self::MER_ID . '&merTrxId=' . $merTrxId . '&merchantToken=' . $merchantToken
        //         . '&timeStamp=' . $timeStamp;

        $data = array('merId' => self::MER_ID,
                'merTrxId' => $merTrxId,
                'timeStamp' => $timeStamp,
                'merchantToken' => $merchantToken);

        echo http_build_query($data);

        $transResult = self::sendRequest(http_build_query($data), self::CHECKTRANS_URL);
        // var_dump($transResult); die();
        $resultToJson = json_decode($transResult, true);
        // print_r($resultToJson);
        $data = $resultToJson['data'];
        // echo '</br></br>';print_r($data); die();
        $checkToken = self::checkToken($data);
        if ($checkToken) {
            return $transResult;
        } else {
            return 'Invalid Merchant Token.';
        }
    }

    public function cancelTrans($trxId, $refundAmount, $payType, $cancelMsg){
        $timeStamp = date('YmdHis');
        $merTrxId = 'REFUND_ID'.$timeStamp.'_'.rand(100,10000);
        $dataToken = $timeStamp . $merTrxId . $trxId . self::MER_ID . $refundAmount . self::ENCODE_KEY;
        $merchantToken = hash('sha256', $dataToken);
        $reqStr = 'trxId='.$trxId.'&merId='.self::MER_ID.'&merTrxId='.$merTrxId.'&amount=' .$refundAmount.'&payType='.$payType.'&cancelMsg='.$cancelMsg.'&timeStamp='.$timeStamp.'&merchantToken='.$merchantToken.'&cancelPw='.self::CANCEL_PASSWORD;

        $cancelResult = self::sendRequest($reqStr, self::CACELTRANS_URL);
        
        $resultToJson = json_decode($cancelResult, true);
        if ($resultToJson['resultCd'] == '00_000') {
            $checkToken = self::checkToken($resultToJson);
            if ($checkToken) {
                return $cancelResult;
            } else {
                return 'Invalid Merchant Token.';
            }
        } else {
            return 'REFUND FAIL: ' . $cancelResult;
        }
    }

    public function updateUserInfoWithPayToken($fileNm, $userId, $payToken, $newFileNm){
        $fileExists = file_exists($fileNm);
        if($fileExists){
            $fileData = file_get_contents($fileNm);
            if(json_decode($fileData, true)['userId'] == $userId){
                $newData = json_encode(array('userId' => $userId, 'payToken' => $payToken));

                $originFile = fopen($fileNm, 'w');
                fwrite($originFile, $newData);
                fclose($originFile);
                rename($fileNm, $newFileNm);
            }
        }
    }

    private function sendRequest($dataRequest, $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        try {
            $result = curl_exec($ch);
            $curlErrno = curl_errno($ch);
            $curlError = curl_error($ch);
            if($result === false || $curlErrno > 0 || $curlError){
                return $curlErrno;
            }else{
                return $result;
            }
            curl_close($ch);
        } catch (Exception $e) {
            return $e;
        }
    }
}

?>