<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
	//generic php function to send GCM push notification
   function sendPushNotificationToGCM($registatoin_ids, $message) {
		//Google cloud messaging GCM-API url
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );

		// Google Cloud Messaging GCM API Key
		define("GOOGLE_API_KEY", "AIzaSyA3TlVB03QIQcd0mUyDI3VeZvBTuYmrrDw");
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
?>
<?php

	$GCM_ID = $_REQUEST['gcm_id'];
	$message = $_REQUEST['message'];
  $time = $_REQUEST['time'];
  $pushStatus = "";
  if($time == "Time" ){
    $gcmRegID=$GCM_ID;
		$pushMessage = $time. ':' .$message;
    //echo $pushMessage;
  }
  else if($time == "Remote Work"){
    $gcmRegID=$GCM_ID;
		$pushMessage = "kron". ':' .$message;
    //echo $pushMessage;
  }
  else {
                  $gcmRegID=$GCM_ID;
  		$pushMessage = $message;
  	}
	//this block is to post message to GCM on-click
		if (isset($gcmRegID) && isset($pushMessage)) {
			$gcmRegIds = array($gcmRegID);
			$message = array("message" => $pushMessage);
			$pushStatus = sendPushNotificationToGCM($gcmRegIds, $message);
		}

?>
