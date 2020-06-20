<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
@ob_start();
@session_start();
@error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
ini_set('display_errors', '1');

$USER_ID= array();
$ATT_USER_ID = array();
$GCM_ID =  array();
$date = date("Y-m-d");
$final_user = array();
$final_gcm = array();

$i=0;
$conn = getConnection();
$s=0;
$sqlA="select USER_ID as userid, GCM_ID as gcmid from USERS";

$resultA = $conn->query($sqlA);
if ($resultA->num_rows > 0)
{
while ($row = $resultA->fetch_assoc()){
$s=$s+1;
$ATT_USER_ID[$s]=$row["userid"];
$GCM_ID[$s]= $row["gcmid"];
$sqlV = "select ATT_USER_ID as attuserid from ATTENDANCE where date(ATT_STR_DATE)='".$date."' and cast(ATT_STR_DATE as time)<='10:00:00' and ATT_USER_ID=".$ATT_USER_ID[$s];
$resultV = $conn->query($sqlV);
if ($resultV->num_rows == 0)
{
$i=$i+1;
$final_user[$i]= $ATT_USER_ID[$s];
$final_gcm[$i]=$GCM_ID[$s];
sendPushNotificationToGCM($final_gcm[$i],"kron: Where the hell are you?");
/*$method = 'GET';
$url = 'http://demoavra.eu/api/sendgcm.php';
$data= array("gcmid" =>$final_gcm[$i], "message" => "Where the hell are you?" );
$s=CallAPI($method, $url, $data);
echo $s;*/
/*
$response = file_get_contents('http://demoavra.eu/api/sendgcm.php?gcmid='.$final_gcm[$i].'&message=where the hell are you?');
*/
}
}
}

/*$sqlU = "SELECT ATT_USER_ID as att_user_id FROM ATTENDANCE where ATT_USER_ID in(select USER_ID from USERS) and date(ATT_STR_DATE)='".$date."' and cast(ATT_STR_DATE as time)>'10:00:00'";

$resultU = $conn->query($sqlU);

if ($resultU->num_rows > 0)
{
  // Fetch one and one row
  while ($row = $resultU->fetch_assoc())
  {
      $ATT_USER_IDS[$s] = $row["att_user_id"];
      $s++;
  }
}

$sqlB = "select USER_ID AS att_user_id from USERS where user_id not in (SELECT att_user_id FROM AvraQuality.ATTENDANCE
where att_user_id in(select user_id from USERS)
and date(att_str_date)='".$date."' and cast(att_str_date as time) >= '10:00:00')";
$resultB = $conn->query($sqlB);
if ($resultB->num_rows > 0)
{  // Fetch one and one row
  while ($row = $resultB->fetch_assoc())
  {
      $ATT_USER_IDS[$s] = $row["att_user_id"];
      $s++;

  }
}

print_r($ATT_USER_IDS);
*/
/*$s=0;
$sqlU = "Select USER_ID as user from USERS";
$resultU = $conn->query($sqlU);
 if ($resultU->num_rows > 0)
  {
    // Fetch one and one row
    while ($row = $resultU->fetch_assoc())
    {
        $s=$s+ 1;
        $USER_ID[$s] = $row["user"];
    }
  }
foreach ($USER_ID as &$value) {
//$r=0;
echo "value :".$value;
echo "<br/>";
$sqlU = "SELECT distinct ATT_USER_ID AS att_user_id FROM ATTENDANCE where CAST(ATT_STR_DATE AS TIME) > '10:00:00' AND ATT_STR_DATE != '0000-00-00 00:00:00' AND ATT_USER_ID=".$value." AND CAST(ATT_STR_DATE AS DATE)='".$date."'";

//$sqlU = "SELECT count(ATT_USER_ID) as att_user_id FROM ATTENDANCE where CAST(ATT_STR_DATE AS TIME) <= '10:00:00' AND ATT_STR_DATE != '0000-00-00 00:00:00' AND ATT_USER_ID=".$value." AND CAST(ATT_STR_DATE AS DATE)='".$date."'";
$resultU = $conn->query($sqlU);
 if ($resultU->num_rows > 0)
 {
    // Fetch one and one row
    while ($row = $resultU->fetch_assoc())
    {
        $ATT_USER_ID[$r] = $row["att_user_id"];
        echo "User Id : ".$ATT_USER_ID[$r];
        echo "<br/>";
        /*if($ATT_USER_ID[$s]==0){
            $sqlG = "SELECT GCM_ID as gcm_id FROM USERS WHERE USER_ID = ".$value;
            $resultG = $conn->query($sqlG);
            if($resultG->num_rows > 0){
              while ($row = $resultG->fetch_assoc()) {
                  $GCM_ID[$s] = $row["gcm_id"];
                  echo "GCM_ID : " .$GCM_ID[$s];
                  echo "<br/>";
              }
            }
        }
    }
  }
  }
/*$s=0;
$sqlU = "SELECT count(ATT_USER_ID) as att_user_id FROM ATTENDANCE where CAST(ATT_STR_DATE AS TIME) <= '10:00:00' AND ATT_STR_DATE != '0000-00-00 00:00:00' AND ATT_USER_ID=".$USER_ID." AND CAST(ATT_STR_DATE AS DATE)='".$date."'";
$resultU = $conn->query($sqlU);
 if ($resultU->num_rows > 0)
 {
    // Fetch one and one row
    while ($row = $resultU->fetch_assoc())
    {
        $s=$s+ 1;
        $ATT_USER_ID[$s] = $row["att_user_id"];
        if($ATT_USER_ID[$s]==0){
            $sqlG = "SELECT GCM_ID as gcm_id FROM USERS WHERE USER_ID = ".$USER_ID;
            $resultG = $conn->query($sqlG);
            if($resultG->num_rows > 0){
              while ($row = $resultG->fetch_assoc()) {
                  $GCM_ID = $row["gcm_id"];
                  echo "GCM_ID : " .$GCM_ID;
              }
            }
        }
    }
  }
}*/
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

function jsonResponce($array = array())
{
  echo json_encode($array);
  exit;
}


function getConnection()
{

  $servername = "localhost:3306";
  $username = "root";
  $password = "root";
  $dbname = "AvraQuality";

  /*$servername = "localhost";
  $username = "dev_avra";
  $password = "green123$";
  $dbname = "AvraQuality";*/

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
  {
    jsonResponce(array('status' => 0, 'msg' => "Connection failed: " . $conn->connect_error));
  }
  return $conn;
}
?>
