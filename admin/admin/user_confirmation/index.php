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
				$info['table']    = "USER_CONFIRMATION";
				$data['UC_DATE']   = $_REQUEST['UC_DATE'];
                $data['UC_USER_ID']   = $_REQUEST['UC_USER_ID'];
                $data['UC_TIME_DELTA']   = $_REQUEST['UC_TIME_DELTA'];
                $data['UC_ATT_WORKING']   = $_REQUEST['UC_ATT_WORKING'];
                $data['UC_ACTION']   = $_REQUEST['UC_ACTION'];
                $data['UC_ACTION_CODE']   = $_REQUEST['UC_ACTION_CODE'];
                $data['UC_DESCRIPTION']   = $_REQUEST['UC_DESCRIPTION'];
                $data['UC_REACTION_TIME']   = $_REQUEST['UC_REACTION_TIME'];
                
				
				$info['data']     =  $data;
				
				if(empty($_REQUEST['UC_ID']))
				{
					 $db->insert($info);
				}
				else
				{
					$UC_ID            = $_REQUEST['UC_ID'];
					$info['where'] = "UC_ID=".$UC_ID;
					
					$db->update($info);
				}
				
				include("user_confirmation_list.php");						   
				break;    
		case "edit":      
				$UC_ID               = $_REQUEST['UC_ID'];
				if( !empty($UC_ID ))
				{
					$info['table']    = "user_confirmation";
					$info['fields']   = array("*");   	   
					$info['where']    =  "UC_ID=".$UC_ID;
				   
					$res  =  $db->select($info);
				   
					$UC_ID        = $res[0]['UC_ID'];  
					$UC_DATE    = $res[0]['UC_DATE'];
					$UC_USER_ID    = $res[0]['UC_USER_ID'];
					$UC_TIME_DELTA    = $res[0]['UC_TIME_DELTA'];
					$UC_ATT_WORKING    = $res[0]['UC_ATT_WORKING'];
					$UC_ACTION    = $res[0]['UC_ACTION'];
					$UC_ACTION_CODE    = $res[0]['UC_ACTION_CODE'];
					$UC_DESCRIPTION    = $res[0]['UC_DESCRIPTION'];
					$UC_REACTION_TIME    = $res[0]['UC_REACTION_TIME'];
					
				 }
						   
				include("user_confirmation_editor.php");						  
				break;
						   
         case 'delete': 
				$UC_ID               = $_REQUEST['UC_ID'];
				
				$info['table']    = "USER_CONFIRMATION";
				$info['where']    = "UC_ID='$UC_ID'";
				
				if($UC_ID)
				{
					$db->delete($info);
				}
				include("user_confirmation_list.php");						   
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
				include("user_confirmation_list.php");
				break; 
        case "search_user_confirmation":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("user_confirmation_list.php");
				break;  								   
						
	     default :    
		       include("user_confirmation_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'USER_CONFIRMATION'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
