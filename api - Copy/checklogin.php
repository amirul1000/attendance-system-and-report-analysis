<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
@ob_start();
@session_start();
@error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
ini_set('display_errors', '1');

$USER_NAME = $_REQUEST['USER_NAME'];
$USER_PASS = $_REQUEST['USER_PASS'];
$USER_COMPANY_NAME = $_REQUEST['USER_COMPANY_NAME'];

if (!empty($USER_NAME) && !empty($USER_PASS)  && !empty($USER_COMPANY_NAME))
{

  $conn = getConnection();
  
  $sql = "SELECT * FROM `USERS` WHERE `USER_NAME` = '" . $USER_NAME . "' AND `USER_PASS` = '" . $USER_PASS . "' AND `USER_COMPANY_NAME` = '" . $USER_COMPANY_NAME . "' LIMIT 1";
  $loginData = getDataFromQuery($conn, $sql);
  if (!empty($loginData) && !empty($loginData[0]))
  {
    jsonResponce(array('status' => 1, 'msg' => "Login successfully", 'data' => $loginData[0]));
  }
  else
  {
    jsonResponce(array('status' => 0, 'msg' => "Invalid login credentials"));
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

  /*$servername = "localhost:3306";
  $username = "root";
  $password = "root";
  $dbname = "AvraQuality";*/

  $servername = "localhost";
  $username = "dev_avra";
  $password = "green123$";
  $dbname = "AvraQuality";


  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
  {
    jsonResponce(array('status' => 0, 'msg' => "Connection failed: " . $conn->connect_error));
  }
  return $conn;
}

function getDataFromQuery($mysqli, $query)
{
  $row = array();
  if ($result = $mysqli->query($query))
  {
    /* fetch object array */
    while ($rowTemp = $result->fetch_assoc())
    {
      $row[] = $rowTemp;
    }
  }
  $result->free();
  return $row;
}
