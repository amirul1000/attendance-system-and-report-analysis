<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
@ob_start();
@session_start();
@error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
ini_set('display_errors', '1');

$STR_DATE = $_REQUEST['STR_DATE'];
$END_DATE = $_REQUEST['END_DATE'];
//$USER_ID= array();
$USER_NAME= array();
$DEFECT_COUNT=0;
$USER_ID_DEFECT= array();
$USER_ID_DEFECT1= array();
$USER_DEFECT_VALUE= array();

if(!empty($STR_DATE) && !empty($END_DATE)){
$conn = getConnection();
$s=0;
$sqlU = "Select USER_NAME AS user_name,USER_ID as user from USERS";
$resultU = $conn->query($sqlU);
 if ($resultU->num_rows > 0)
  {
    // Fetch one and one row
    while ($row = $resultU->fetch_assoc())
    {
        $s=$s+ 1;
      //  $USER_ID[$s] = $row["user"];
        $USER_NAME[$s] = $row["user_name"];
    }
  }
//$count = sizeof($USER_ID);
$count = sizeof($USER_NAME);
$sqlA = "select count(D_USER_ID) as count from DEFECTS where D.D_ACTION='R' AND CAST(D.D_STR_DATE as DATE) between '".$STR_DATE."' and '".$END_DATE."'" ;
$resultA = $conn->query($sqlA);
if ($resultA->num_rows > 0)
{
 while ($row = $resultA->fetch_assoc())
    {
            $DEFECT_COUNT = $row["count"];
    }
}
$MINUS_POINT = 10/$count;
$POINT = 0;
$i=0;

$sqlD = "select U.USER_NAME as user_name,count(U.USER_ID) as count, U.USER_ID as userid from USERS U LEFT JOIN DEFECTS D ON D.D_USER_ID=U.USER_ID where D.D_ACTION='R' AND CAST(D.D_STR_DATE as DATE) between '".$STR_DATE."' and '".$END_DATE."' group by U.USER_ID order by count(U.USER_ID) DESC";
$resultD = $conn->query($sqlD);
if ($resultD->num_rows > 0)
  {
    // Fetch one and one row
    while ($row = $resultD->fetch_assoc())
    {
         $i=$i+1;
         $USER_ID_DEFECT[$i] = $row["user_name"];
         $USER_DEFECT_VALUE[$i]= 10-$POINT;
         $POINT= $POINT+ $MINUS_POINT;
        $whereA [] = array("D_USER_ID" =>  $USER_ID_DEFECT[$i], "D_USER_POINT" =>  $USER_DEFECT_VALUE[$i]);
    }
  }
foreach ($USER_NAME as &$value){
$k=0;
    foreach($USER_ID_DEFECT as &$value1){
      if($value==$value1){
        $k=1;
      }
    }
if($k==0){
             $i=$i+1;
         $USER_ID_DEFECT1[$i] = $value;
         $USER_DEFECT_VALUE[$i]= 10-$POINT;
         $POINT= $POINT+ $MINUS_POINT;
          $whereA [] = array("D_USER_ID" =>  $USER_ID_DEFECT1[$i], "D_USER_POINT" =>  $USER_DEFECT_VALUE[$i]);
}

}
//Sap
$SAP_MINUS_POINT = 10/$count;
$SAP_POINT = 0;
$j=0;

$sqlS = "select count(SAL_USER_ID) AS count FROM AvraQuality.SAP_ACTIVITY_LOG where CAST(SAP_STR_DATE as DATE) between '".$STR_DATE."' and '".$END_DATE."'" ;
$resultS = $conn->query($sqlS);
if ($resultS->num_rows > 0)
{
 while ($row = $resultS->fetch_assoc())
    {
            $DEFECT_COUNT = $row["count"];
    }
}
$sqlSAP = "select U.USER_NAME as user_name,count(U.USER_ID) as count, U.USER_ID as userid from USERS U LEFT JOIN SAP_ACTIVITY_LOG S ON S.SAL_USER_ID=U.USER_ID where CAST(S.SAP_STR_DATE as DATE) between '".$STR_DATE."' and '".$END_DATE."' group by U.USER_ID order by count(U.USER_ID) DESC";
$resultSAP = $conn->query($sqlSAP);
if ($resultD->num_rows > 0)
{
    // Fetch one and one row
    while ($row = $resultSAP->fetch_assoc())
    {
         $j=$j+1;
         $USER_ID_DEFECT[$j] = $row["user_name"];
         $USER_DEFECT_VALUE[$j]= 10-$SAP_POINT;
         $SAP_POINT= $SAP_POINT + $SAP_MINUS_POINT;
        $whereSAP [] = array("SAP_USER_ID" =>  $USER_ID_DEFECT[$j], "SAP_USER_POINT" =>  $USER_DEFECT_VALUE[$j]);
    }
  }
foreach ($USER_NAME as &$value2){
$l=0;
    foreach($USER_ID_DEFECT as &$value3){

      if($value2==$value3){
        $l=1;
      }
    }
if($l==0){
             $j=$j+1;
         $USER_ID_DEFECT1[$i] = $value2;
         $USER_DEFECT_VALUE[$i]= 10-$SAP_POINT;
         $SAP_POINT= $SAP_POINT+ $SAP_MINUS_POINT;
         $whereSAP [] = array("SAP_USER_ID" =>  $USER_ID_DEFECT1[$j], "SAP_USER_POINT" =>  $USER_DEFECT_VALUE[$j]);
}

}
//Attandance

/*$ATT_MINUS_POINT = 10/$count;
$ATT_POINT = 0;
$a=0;

$sqlATT = "select count(ATT_USER_ID) AS count FROM AvraQuality.ATTENDANCE where CAST(ATT_STR_DATE as DATE) between '".$STR_DATE."' and '".$END_DATE."'" ;
$resultATT = $conn->query($sqlATT);
if ($resultATT->num_rows > 0)
{
 while ($row = $resultATT->fetch_assoc())
    {
            $DEFECT_COUNT = $row["count"];
    }
}
$sqlATTE = "select U.USER_NAME as user_name,count(U.USER_ID) as count, U.USER_ID as userid from USERS U LEFT JOIN ATTENDANCE A ON A.ATT_USER_ID=U.USER_ID where CAST(A.ATT_STR_DATE as DATE) between '".$STR_DATE."' and '".$END_DATE."' group by U.USER_ID order by count(U.USER_ID) DESC";
$resultATTE = $conn->query($sqlATTE);
if ($resultATTE->num_rows > 0)
{
    // Fetch one and one row
    while ($row = $resultATTE->fetch_assoc())
    {
         $a=$a+1;
         $USER_ID_DEFECT[$j] = $row["user_name"];
         $USER_DEFECT_VALUE[$j]= 10-$SAP_POINT;
         $SAP_POINT= $SAP_POINT + $SAP_MINUS_POINT;
        $whereATT [] = array("ATT_USER_ID" =>  $USER_ID_DEFECT[$a], "ATT_USER_POINT" =>  $USER_DEFECT_VALUE[$a]);
    }
  }
foreach ($USER_NAME as &$value4){
$l=0;
    foreach($USER_ID_DEFECT as &$value5){

      if($value4==$value5){
        $l=1;
      }
    }
if($l==0){
             $a=$a+1;
         $USER_ID_DEFECT1[$i] = $value4;
         $USER_DEFECT_VALUE[$i]= 10-$SAP_POINT;
         $SAP_POINT= $SAP_POINT+ $SAP_MINUS_POINT;
         $whereATT [] = array("ATT_USER_ID" =>  $USER_ID_DEFECT1[$a], "ATT_USER_POINT" =>  $USER_DEFECT_VALUE[$a]);
}

}*/


 $allReturnData = array();
          $allReturnData['DEFFECTS'] = $whereA;
          $allReturnData['SAP_ACTIVITY_LOG'] = $whereSAP;
          //$allReturnData['ATTENDANCE'] = $whereATT;
          if (!empty($allReturnData))
          {
              jsonResponce(array('status' => 1, 'msg' => "Records found", 'data' => $allReturnData));
          }
          else
          {
             jsonResponce(array('status' => 0, 'msg' => "Records not found"));
          }
}else{
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

/*  $servername = "localhost";
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
