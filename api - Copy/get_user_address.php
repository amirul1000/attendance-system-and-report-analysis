<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
@ob_start();
@session_start();
@error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
ini_set('display_errors', '1');

$USER_ID = $_REQUEST['USER_ID'];
$street= "";
$streetno="";
$zipcode="";
$country="";
$whereADD = "";

if (!empty($USER_ID))
{

    $conn = getConnection();

    $sqlAdd = "SELECT STREET as street,STREETNO as streetno,ZIPCODE as zipcode,COUNTRY as country FROM AvraQuality.USERS WHERE USER_ID=".$USER_ID;
    $resultAdd = $conn->query($sqlAdd);
      if ($resultAdd->num_rows > 0) {
        // output data of each row
        while($row = $resultAdd->fetch_assoc()) {
          $street = $row["street"];
          $streetno = $row["streetno"];
          $zipcode = $row["zipcode"];
          $country = $row["country"];
        }
      }
      $whereADD = array("STREET" => $street,"STREETNO" => $streetno,"ZIPCODE" => $zipcode,"COUNTRY" => $country);

      $allReturnData = array();
      $allReturnData['ADDRESS'] = $whereADD;
      if (!empty($allReturnData) && (count($whereADD)))
      {
        jsonResponce(array('status' => 1, 'msg' => "Records found", 'data' => $allReturnData));
      }
      else
      {
        jsonResponce(array('status' => 0, 'msg' => "Records not found"));
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
