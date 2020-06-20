<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
@ob_start();
@session_start();
@error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
ini_set('display_errors', '1');

$USER_ID = $_REQUEST['USER_ID'];
$STR_DATE = $_REQUEST['STR_DATE'] ;
$END_DATE = $_REQUEST['END_DATE'] ;
$END_DATE1 = date ("Y-m-d", strtotime("+1 day", strtotime($END_DATE)));

$ATT_ID = array();
$ATT_USER_ID = array();
$ATT_DATE = array();
$ATT_STR_DATE = array();
$ATT_END_DATE = array();
$starttime = array();
$endtime = array();
$timediff = 0;
$beacon = array();
$beacon_desc = array();
$DEFECT_ID = array();
$DEFECT_DESCRIPTION=array();

$date = array();
$beacon = array();
$street_number = array();
$route = array();
$postal_code = array();
$country = array();

$att_s_date;
$att_e_date;
if (!empty($USER_ID) && !empty($STR_DATE) && !empty($END_DATE))
{

  $whereD = array();
  $whereS = array();
  $whereY = array();

  $whereD[] = "D_USER_ID ='" . $USER_ID . "'";
  $whereS[] = "SAL_USER_ID ='" . $USER_ID . "'";


  if (!empty($STR_DATE) && !empty($END_DATE))
  {
    $STR_DATE = date('Y-m-d', strtotime($STR_DATE));
    $END_DATE = date('Y-m-d', strtotime($END_DATE));

    if (strtotime($STR_DATE) >= strtotime($END_DATE))
    {
      $STR_DATE_TEMP = $STR_DATE;
      $STR_DATE = $END_DATE;
      $END_DATE = $STR_DATE_TEMP;
    }

    $whereD[] = "D_STR_DATE BETWEEN '" . $STR_DATE . "' AND '" . $END_DATE . "'";
    $whereD[] = "D_END_DATE BETWEEN '" . $STR_DATE . "' AND '" . $END_DATE . "'";

    $whereS[] = "SAP_STR_DATE BETWEEN '" . $STR_DATE . "' AND '" . $END_DATE1 . "'";
    $whereS[] = "SAP_END_DATE BETWEEN '" . $STR_DATE . "' AND '" . $END_DATE1. "'";
  }
  else if (!empty($STR_DATE))
  {
    $STR_DATE = date('Y-m-d', strtotime($STR_DATE));

    $whereD[] = "D_STR_DATE ='" . $STR_DATE . "'";
    $whereD[] = "D_END_DATE ='" . $STR_DATE . "'";

    $whereS[] = "SAP_STR_DATE ='" . $STR_DATE . "'";
    $whereS[] = "SAP_END_DATE ='" . $STR_DATE . "'";
  }
  else if (!empty($END_DATE))
  {
    $END_DATE = date('Y-m-d', strtotime($END_DATE));

    $whereD[] = "D_STR_DATE ='" . $END_DATE . "'";
    $whereD[] = "D_END_DATE ='" . $END_DATE . "'";

    $whereS[] = "SAP_STR_DATE ='" . $END_DATE1 . "'";
    $whereS[] = "SAP_END_DATE ='" . $END_DATE1 . "'";
  }
    $STR_DATE1=$STR_DATE;
    $END_DATE1=$END_DATE;

  $conn = getConnection();

$i= 0;
$j=0;
$n=0;
$sqlAtt = "select ATT_STR_DATE as startdate, ATT_END_DATE as enddate, ATT_UI_BEACON as beacon, street_number as street, route as route, postal_code as postal, country as country from ATTENDANCE where (CAST(ATT_STR_DATE as date) between '".$STR_DATE."' and '".$END_DATE."' AND ATT_USER_ID=".$USER_ID.") OR (CAST(ATT_END_DATE as date) between '".$STR_DATE."' and '".$END_DATE."' AND ATT_USER_ID=".$USER_ID.")";

$resultAtt = $conn->query($sqlAtt);
  if ($resultAtt->num_rows > 0) {

while($row = $resultAtt->fetch_assoc()){
    $i=$i+1;
  $ATT_STR_DATE[$i] = $row["startdate"];
  $ATT_END_DATE[$i] = $row["enddate"];
  $beacon[$i] = $row["beacon"];
  $street_number[$i] = $row["street"];
  $route[$i] =  $row["route"];
  $postal_code[$i] = $row["postal"];
  $country[$i] =  $row["country"];



}

}
$length= count($ATT_STR_DATE);
$n=1;
while($n<=$length){
  $k=$n+1;
    if($ATT_STR_DATE[$k]==$ATT_END_DATE[$n]){
      $final_start = $ATT_STR_DATE[$n];
      $final_end = $ATT_END_DATE[$k];
      $sqlD = "SELECT timediff('".$final_end."','".$final_start."') as timeDiff FROM dual";
      $resultDiff = $conn->query($sqlD);
      while($row = $resultDiff->fetch_assoc()) {
            $timediff = $row["timeDiff"];
        }

        if($street_number[$n] == '' && $route[$n] == '' && $postal_code[$n] == 0 && $country[$n] == ''){

          $sqlB= "SELECT BE_UI_DESCRIPTION as description FROM BEACON_MASTER where BE_UI_ID='".$beacon[$n]."'";

          $result_beacon = $conn->query($sqlB);
           if ($result_beacon->num_rows > 0) {
              // output data of each row
            while($row = $result_beacon->fetch_assoc()) {
                $beacon_desc[$n]= $row["description"];
           }
            }else{
              $beacon_desc[$n]= null;
            }
        }
        else{

          $temp = $street_number[$n] . ' ' . $route[$n] . ' ' . $postal_code[$n] . ' ' . $country[$n];
          $beacon_desc[$n]= str_replace("null","",$temp);
          $beacon_desc[$n]= str_replace("0","",$beacon_desc[$n]);
        }
        $whereA[] = array("ATT_DATE" => date_format(date_create($final_start),"Y-m-d"),"ATT_STR_DATE" => $final_start,
        "ATT_END_DATE" => $final_end ,"ATT_WORKING" => $timediff,"BEACON_DESCRIPTION" => $beacon_desc[$n]);
        $n= $n+2;
    }else{
      $n=$n+1;
    }
  }
  $sqlMax = "select MAX(ATT_END_DATE) as maxend ,MAX(ATT_STR_DATE) as maxatt from ATTENDANCE where (CAST(ATT_STR_DATE as date) between '".$STR_DATE."' and '".$END_DATE."' AND ATT_USER_ID=".$USER_ID.") OR (CAST(ATT_END_DATE as date) between '".$STR_DATE."' and '".$END_DATE."' AND ATT_USER_ID=".$USER_ID.")";
  $resultMax = $conn->query($sqlMax);
  while($row = $resultMax->fetch_assoc()) {
      $startdatemax = $row['maxatt'];
      $enddatemax = $row['maxend'];
      if($startdatemax>$enddatemax){
        $sqlGetid = "select ATT_STR_DATE as startdate, ATT_END_DATE as enddate, ATT_UI_BEACON as beacon, street_number as street, route as route, postal_code as postal, country as country from ATTENDANCE where ATT_USER_ID=".$USER_ID." AND ATT_STR_DATE='".$startdatemax."'";
$resultGetid = $conn->query($sqlGetid);
while($row = $resultGetid->fetch_assoc()) {
  $i=$i+1;
        $ATT_STR_DATE[$i] = $row["startdate"];
        $ATT_END_DATE[$i] = $row["enddate"];
        $beacon[$i] = $row["beacon"];
        $street_number[$i] = $row["street"];
        $route[$i] =  $row["route"];
        $postal_code[$i] = $row["postal"];
        $country[$i] =  $row["country"];
     
        if($street_number[$i] == '' && $route[$i] == '' && $postal_code[$i] == 0 && $country[$i] == ''){

          $sqlB= "SELECT BE_UI_DESCRIPTION as description FROM BEACON_MASTER where BE_UI_ID='".$beacon[$i]."'";

          $result_beacon = $conn->query($sqlB);
           if ($result_beacon->num_rows > 0) {
              // output data of each row
            while($row = $result_beacon->fetch_assoc()) {
          
            
                $beacon_desc[$i]= $row["description"];
           }
            }else{
              $beacon_desc[$i]= null;
            }
        }
        else{

          $temp = $street_number[$i] . ' ' . $route[$i] . ' ' . $postal_code[$i] . ' ' . $country[$i];
          $beacon_desc[$i]= str_replace("null","",$temp);
          $beacon_desc[$i]= str_replace("0","",$beacon_desc[$i]);
        }
      }
      $whereA[] = array("ATT_DATE" => date_format(date_create($ATT_STR_DATE[$i]),"Y-m-d"),"ATT_STR_DATE" => $ATT_STR_DATE[$i],
      "ATT_END_DATE" => "" ,"ATT_WORKING" => "","BEACON_DESCRIPTION" => $beacon_desc[$i]);
      }
 }

    $whereA = array_reverse($whereA);

    while (strtotime($STR_DATE1) <= strtotime($END_DATE1)) {

        $j=$j+ 1;
        $sqlA = "SELECT DEFECT as defect, D_DESCRIPTION as description FROM DEFECTS where D_USER_ID = ".$USER_ID." AND CAST(D_STR_DATE as DATE)='".$STR_DATE1."'";
        $STR_DATE1 = date ("Y-m-d", strtotime("+1 day", strtotime($STR_DATE1)));
        $result = $conn->query($sqlA);

        if ($result->num_rows > 0) {

            // output data of each row
            while($row = $result->fetch_assoc()) {
                $DEFECT_ID[$j] = $row["defect"];

                $DEFECT_DESCRIPTION[$j] = $row["description"];

            $whereY[] = array("DEFECT" => $DEFECT_ID[$j],"D_DESCRIPTION" => $DEFECT_DESCRIPTION[$j]);

            }
        }
    }
    $sqlG = "SELECT GCM_ID as gcm_id FROM USERS WHERE USER_ID = ".$USER_ID;
    $resultG = $conn->query($sqlG);
    if($resultG->num_rows > 0){
      while ($row = $resultG->fetch_assoc()) {
          $GCM_ID = $row["gcm_id"];
          $whereG = array("GCMID" => $GCM_ID);
        }
      }

 /* $sqlD = "SELECT * FROM `DEFECTS` WHERE  " . implode(' AND ', $whereD);
  $deffectsData = getDataFromQuery($conn, $sqlD);
*/

  //$sqlS = "SELECT * FROM `SAP_ACTIVITY_LOG` WHERE  " . implode(' AND ', $whereS);
  $sqlS = "SELECT * FROM AvraQuality.SAP_ACTIVITY_LOG where (CAST(SAP_STR_DATE as date) between '".$STR_DATE."' and '".$END_DATE."' AND SAL_USER_ID=".$USER_ID.") OR (CAST(SAP_END_DATE as date) between '".$STR_DATE."' and '".$END_DATE."' AND SAL_USER_ID=".$USER_ID.")";
  $sap_activity_logData = getDataFromQuery($conn, $sqlS);


  $allReturnData = array();
  $allReturnData['ATTENDANCE'] = $whereA;
  $allReturnData['DEFECTS'] = $whereY;
  $allReturnData['SAP_ACTIVITY_LOG'] = $sap_activity_logData;
  $allReturnData['GCM_ID'] = $whereG;
  if (!empty($allReturnData) && (count($whereA) || count($whereY) || count($sap_activity_logData) || count($whereG)))
  {
    jsonResponce(array('status' => 1, 'msg' => "Records found", 'data' => $allReturnData));
  }
  else
  {
    jsonResponce(array('status' => 0, 'msg' => "Records not found", 'data' => $allReturnData));
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