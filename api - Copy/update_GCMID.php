<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
@ob_start();
@session_start();
@error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
ini_set('display_errors', '1');

$USERID = $_REQUEST['USERID'];
$GCMID = $_REQUEST['GCMID'];


if (!empty($USERID) && !empty($GCMID))
{

    $conn = getConnection();

    $sql = "UPDATE USERS SET GCM_ID='$GCMID' WHERE USER_ID=".$USERID;
    
    if ($conn->query($sql) === TRUE)
    {
        jsonResponce(array('status' => 1, 'msg' => "Record has been Updated successfully"));
    }
    else
    {
        jsonResponce(array('status' => 0, 'msg' => "Record not updated!"));
    }
}
else
{
  jsonResponce(array('status' => 0, 'msg' => "Error in call api or some paramitter missing"));
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
