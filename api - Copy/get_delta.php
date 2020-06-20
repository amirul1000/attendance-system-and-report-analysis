<?php

$SAL_USER_ID = $_REQUEST['SAL_USER_ID'];
$SAP_OBJECT = $_REQUEST['SAP_OBJECT'];
$base = $_REQUEST['BASE'];
$head = $_REQUEST['HEAD'];
$reponame = $_REQUEST['REPO_NAME'];
$userauthor = $_REQUEST['USER_AUTHOR'];
$useremail = $_REQUEST['USER_EMAIL'];
     
$url = str_replace("+++","...","https://api.github.com/repos/AvraGitHub/$reponame/compare/$base+++$head");

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch,CURLOPT_USERAGENT,'$userauthor'); // Set a user agent
  $response =curl_exec($ch);

  curl_close($ch);
  $res = json_decode($response);

  if(json_encode($res) == '{"message":"Not Found","documentation_url":"https:\/\/developer.github.com\/v3"}')
  {
      jsonResponce(array('status' => 0, 'msg' => "User Repository Not on GitHub"));
  }
  else
  {

      $sd = json_encode($res->base_commit->commit->committer->date);
      $str = str_replace('"', " ",$sd);
      $strdt = str_replace('T', " ",$str);
      $strdate =  str_replace('Z', " ",$strdt);

      $f = json_encode($res->files[0]->filename);
      $file = str_replace('"', " ",$f);

      $s = json_encode($res->files[0]->status);
      $status = str_replace('"', "", $s);
      $st = "modified";


      if(strcmp($st,$status)==0){
            $sta = "UPDATED";
      }
        
      $conn = getConnection();   
      $p = json_encode($res->files[0]->patch);
      
      $patch = str_replace('"', " ",$p);
      $patch = GetBetween("@@","@@",$patch);
      $diffstart = GetBetween(",","+",$patch);
      $diffend = substr($patch, strpos($patch, ",") + 1);
      $diffend = substr($diffend, strpos($diffend, ",") + 1);
      $result = $sta . ': ' . $patch . '-' . $diffstart . '-' . $diffend;
      if ($diffend > $diffstart) 
         { $lineadd = $diffend - $diffstart;
           $result = 'ADDED: ' . $lineadd . ' lines';
         }
      elseif ($diffend < $diffstart) 
         { $linedel = $diffstart - $diffend;
           $result = 'DELETED: ' . $linedel . ' lines';
         }
      else 
         { $result = 'CHANGED';
         }
      $result = mysqli_real_escape_string($conn,$result);
      
      $ed = json_encode($res->commits[0]->commit->committer->date);
      $end = str_replace('"', " ",$ed);
      $enddt =  str_replace('T', " ",$end);
      $enddate =  str_replace('Z', " ",$enddt);

      $comid = json_encode($res->commits[0]->sha);
      $commitid = str_replace('"', "",$comid);

    if(empty($SAL_USER_ID)){

        if(!empty($useremail)){
            
            $sqlquery = "SELECT USER_ID FROM USERS WHERE USER_EMAIL='$useremail'";
             
            $res = $conn->query($sqlquery);
                
            $resultobj = $res->fetch_assoc();  
             
            if($res->num_rows>0){
             
                if(!empty($resultobj['USER_ID'])){
                    
                   $SAL_USER_ID = $resultobj['USER_ID'];
                }
            }
            
        }
    }

     
     if (!empty($SAL_USER_ID) && !empty($SAP_OBJECT) && !empty($base) && !empty($head) && !empty($reponame) && !empty($userauthor))
     {

            $sqlAtt = "INSERT INTO SAP_ACTIVITY_LOG (`SAL_USER_ID`,`SAP_OBJECT`, `SAP_OBJECT_NAME`, `SAP_OBJECT_DESC`, `SAP_STR_DATE`,
                           `SAP_END_DATE`,`COMMIT_ID`)VALUES ('$SAL_USER_ID','$SAP_OBJECT', '$file', '$result', '$strdate', '$enddate', '$commitid')";
            
          if ($conn->query($sqlAtt) === TRUE)
          {
            $last_id = $conn->insert_id;
            jsonResponce(array('status' => 1, 'msg' => "Record has been saved successfully", 'data' => $last_id,
                               "SAL_USER_ID" => $SAL_USER_ID, "SAP_OBJECT" => $SAP_OBJECT,
                               "SAP_OBJECT_NAME" => $file, "SAP_OBJECT_DESC" =>  $result,
                               "SAP_STR_DATE" => $strdate, "SAP_END_DATE" => $enddate, "COMMIT_ID" => $commitid));
          }else{
           jsonResponce(array('status' => 0, 'msg' => "Record not saved!"));
          }
      }
      else
      {
        jsonResponce(array('status' => 0, 'msg' => "Error in call api or some paramitter missing"));
      }
  }

  function jsonResponce($array = array())
  {
    echo json_encode($array);
    exit;
  }

  function GetBetween($var1="",$var2="",$pool)
  {
    $temp1 = strpos($pool,$var1)+strlen($var1);
    $result = substr($pool,$temp1,strlen($pool));
    $dd=strpos($result,$var2);
    if($dd == 0){
         $dd = strlen($result);
                }
    return substr($result,0,$dd);
  }


  function getConnection()
  {

    $servername = "localhost:3306";
    /*$username = "root";
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
?>
