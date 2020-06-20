<?php
       session_start();
       include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   
	    if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../login/");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
				$info['table']    = "ATTENDANCE";
				$data['ATT_USER_ID']   = $_REQUEST['ATT_USER_ID'];
                $data['ATT_STR_DATE']   = $_REQUEST['ATT_STR_DATE'];
                $data['ATT_END_DATE']   = $_REQUEST['ATT_END_DATE'];
                $data['ATT_WORKING']   = $_REQUEST['ATT_WORKING'];
                $data['ATT_LB_DATE']   = $_REQUEST['ATT_LB_DATE'];
                $data['ATT_UI_DEVICE']   = $_REQUEST['ATT_UI_DEVICE'];
                $data['ATT_UI_BEACON']   = $_REQUEST['ATT_UI_BEACON'];
				$info['data']     =  $data;
				
				if(empty($_REQUEST['ATT_ID']))
				{
					 $db->insert($info);
				}
				else
				{
					$ATT_ID            = $_REQUEST['ATT_ID'];
					$info['where'] = "ATT_ID=".$ATT_ID;
					
					$db->update($info);
				}
				include("attendance_list.php");						   
				break;    
		case "edit":      
				$ATT_ID               = $_REQUEST['ATT_ID'];
				if( !empty($ATT_ID ))
				{
					$info['table']    = "ATTENDANCE";
					$info['fields']   = array("*");   	   
					$info['where']    =  "ATT_ID=".$ATT_ID;
				   
					$res  =  $db->select($info);
				   
					$ATT_ID        = $res[0]['ATT_ID'];  
					$ATT_USER_ID    = $res[0]['ATT_USER_ID'];
					$ATT_STR_DATE    = $res[0]['ATT_STR_DATE'];
					$ATT_END_DATE    = $res[0]['ATT_END_DATE'];
					$ATT_WORKING    = $res[0]['ATT_WORKING'];
					$ATT_LB_DATE    = $res[0]['ATT_LB_DATE'];
					$ATT_UI_DEVICE    = $res[0]['ATT_UI_DEVICE'];
					$ATT_UI_BEACON    = $res[0]['ATT_UI_BEACON'];
				 }
						   
				include("attendance_editor.php");						  
				break;
						   
         case 'delete': 
				$ATT_ID               = $_REQUEST['ATT_ID'];
				
				$info['table']    = "ATTENDANCE";
				$info['where']    = "ATT_ID='$ATT_ID'";
				
				if($ATT_ID)
				{
					$db->delete($info);
				}
				include("attendance_list.php");						   
				break; 
						   
         case "list" :    	 
			  if(!empty($_REQUEST['page'])&&$_SESSION["search"]=="yes")
				{
				  $_SESSION["search"]="yes";
				}
				else
				{
				   $_SESSION["search"]="no";
					unset($_SESSION["search"]);
					unset($_SESSION['field_name']);
					unset($_SESSION["field_value"]); 
				}
				include("attendance_list.php");
				break; 
        case "search_attendance":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("attendance_list.php");
				break;  								   
						
	     default :    
		       include("attendance_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'ATTENDANCE'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
