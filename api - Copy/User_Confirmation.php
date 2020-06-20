<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
@ob_start();
@session_start();
@error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
ini_set('display_errors', '1');

$UC_USER_ID = $_REQUEST['UC_USER_ID'];
$UC_TIME_DELTA = $_REQUEST['UC_TIME_DELTA'];
$UC_ATT_WORKING = $_REQUEST['UC_ATT_WORKING'];
$UC_ACTION = $_REQUEST['UC_ACTION'];
$UC_ACTION_CODE = $_REQUEST['UC_ACTION_CODE'];
$UC_DESCRIPTION = $_REQUEST['UC_DESCRIPTION'];
$UC_REACTION_TIME = $_REQUEST['UC_REACTION_TIME'];
$date_from = $_REQUEST['datefrom'];
$date_to = $_REQUEST['dateto'];

if (!empty($UC_USER_ID) && !empty($UC_TIME_DELTA) && !empty($UC_ATT_WORKING) && !empty($UC_ACTION) && !empty($UC_ACTION_CODE)
    && !empty($UC_DESCRIPTION) && !empty($UC_REACTION_TIME) && !empty($date_from) && !empty($date_to))
{

    $conn = getConnection();

    $date = date_create();
    $timestamp = date_format($date, 'Y-m-d H:i:s');

    $sql = "INSERT INTO USER_CONFIRMATION(`UC_DATE`, `UC_USER_ID`, `UC_TIME_DELTA`, `UC_ATT_WORKING`, `UC_ACTION`,
            `UC_ACTION_CODE`, `UC_DESCRIPTION`, `UC_REACTION_TIME`, `datefrom`, `dateto`) VALUES ('$timestamp','$UC_USER_ID',
            '$UC_TIME_DELTA','$UC_ATT_WORKING', '$UC_ACTION', '$UC_ACTION_CODE', '$UC_DESCRIPTION', '$UC_REACTION_TIME',
            '$date_from', '$date_to')";

    if ($conn->query($sql) === TRUE)
    {
        $last_id = $conn->insert_id;
        jsonResponce(array('status' => 1, 'msg' => "Record has been saved successfully", 'data' => $last_id));
    }
    else
    {
        jsonResponce(array('status' => 0, 'msg' => "Record not saved!"));
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
