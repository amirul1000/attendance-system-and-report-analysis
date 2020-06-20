<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
@ob_start();
@session_start();
@error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
ini_set('display_errors', '1');

$USER_ID = $_REQUEST['USER_ID'];
$msg="";
$aa="";
$beacon="";
$street_number="";
$route="";
$postal_code="";
$country="";
$a = "";
if (!empty($USER_ID))
{

    $conn = getConnection();

    $sqlAdd = "select max(ATT_STR_DATE) AS ENTRY, max(ATT_END_DATE) AS EX FROM ATTENDANCE WHERE ATT_USER_ID =".$USER_ID;

    $resultAdd = $conn->query($sqlAdd);
      if ($resultAdd->num_rows > 0) {
        // output data of each row
        while($row = $resultAdd->fetch_assoc()) {
          $entry = $row["ENTRY"];
          $exit = $row["EX"];
          if($entry>$exit){
            $sqlC = "select street_number as str_num, route as rout, postal_code as post_code, country as countr, ATT_UI_BEACON as BEACON FROM ATTENDANCE WHERE ATT_USER_ID =".$USER_ID." AND ATT_STR_DATE='".$entry."'";
            $resultC = $conn->query($sqlC);
            if ($resultC->num_rows > 0) {
              while($row = $resultC->fetch_assoc()) {
                $msg = "Entered";
                $aa = "at";
                $beacon = $row["BEACON"];
                $street_number = $row["str_num"];
                $route = $row["rout"];
                $postal_code = $row["post_code"];
                $country = $row["countr"];
              }
            }
            if($street_number == 'null' && $route == 'null' && $postal_code == 0 && $country == 'null'){

              $sqlB= "SELECT BE_UI_DESCRIPTION as description FROM BEACON_MASTER where BE_UI_ID='".$beacon."'";

              $result_beacon = $conn->query($sqlB);
               if ($result_beacon->num_rows > 0) {
                  // output data of each row
                while($row = $result_beacon->fetch_assoc()) {
                  $beacon_desc= $row["description"];
               }
                }else{
                  $beacon_desc= null;
                }
            }
            else{
              $temp = $street_number . ' ' . $route . ' ' . $postal_code . ' ' . $country;
              $beacon_desc= str_replace("null","",$temp);
              $beacon_desc= str_replace("0","",$beacon_desc);
            }
            echo $entry;
            echo "<br/>";
            echo $exit;
            echo "<br/>";
            $a = $msg . ' ' . $beacon_desc . ' ' . $aa . ' ' . $entry;
          }
          else if ($entry<$exit){
            $sqlC = "select street_number as str_num, route as rout, postal_code as post_code, country as countr, ATT_UI_BEACON as BEACON FROM ATTENDANCE WHERE ATT_USER_ID =".$USER_ID." AND ATT_END_DATE='".$exit."'";
            $resultC = $conn->query($sqlC);
            if ($resultC->num_rows > 0) {
              while($row = $resultC->fetch_assoc()) {
                  $msg = "Last Detected";
                  $aa = "at";
                  $beacon = $row["BEACON"];
                  $street_number = $row["str_num"];
                  $route = $row["rout"];
                  $postal_code = $row["post_code"];
                  $country = $row["countr"];
                }
              }
                  if($street_number == 'null' && $route == 'null' && $postal_code == 0 && $country == 'null'){
                    $sqlB= "SELECT BE_UI_DESCRIPTION as description FROM BEACON_MASTER where BE_UI_ID='".$beacon."'";
                    $result_beacon = $conn->query($sqlB);
               if ($result_beacon->num_rows > 0) {
                  // output data of each row
                while($row = $result_beacon->fetch_assoc()) {
                  $beacon_desc= $row["description"];
               }
                }else{
                  $beacon_desc= null;
                }
            }
            else{
              $temp = $street_number . ' ' . $route . ' ' . $postal_code . ' ' . $country;
              $beacon_desc= str_replace("null","",$temp);
              $beacon_desc= str_replace("0","",$beacon_desc);
            }
            $a = $msg . ' ' . $beacon_desc . ' ' . $aa . ' ' . $exit;
          }
          else{
            $a = "NOT FOUND";
          }
        }
      }
      $whereADD =  $a;

      $allReturnData = array();
      $allReturnData['Location'] = $whereADD;
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
