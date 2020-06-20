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
				$info['table']    = "SAP_ACTIVITY_LOG";
				$data['SAL_USER_ID']   = $_REQUEST['SAL_USER_ID'];
                $data['SAP_OBJECT']   = $_REQUEST['SAP_OBJECT'];
                $data['SAP_OBJECT_NAME']   = $_REQUEST['SAP_OBJECT_NAME'];
                $data['SAP_OBJECT_DESC']   = $_REQUEST['SAP_OBJECT_DESC'];
                $data['SAP_STR_DATE']   = $_REQUEST['SAP_STR_DATE'];
                $data['SAP_END_DATE']   = $_REQUEST['SAP_END_DATE'];
                
				
				$info['data']     =  $data;
				
				if(empty($_REQUEST['SAL_ID']))
				{
					 $db->insert($info);
				}
				else
				{
					$SAL_ID            = $_REQUEST['SAL_ID'];
					$info['where'] = "SAL_ID=".$SAL_ID;
					
					$db->update($info);
				}
				
				include("sap_activity_log_list.php");						   
				break;    
		case "edit":      
				$SAL_ID               = $_REQUEST['SAL_ID'];
				if( !empty($SAL_ID ))
				{
					$info['table']    = "SAP_ACTIVITY_LOG";
					$info['fields']   = array("*");   	   
					$info['where']    =  "SAL_ID=".$SAL_ID;
				   
					$res  =  $db->select($info);
				   
					$SAL_ID        = $res[0]['SAL_ID'];  
					$SAL_USER_ID    = $res[0]['SAL_USER_ID'];
					$SAP_OBJECT    = $res[0]['SAP_OBJECT'];
					$SAP_OBJECT_NAME    = $res[0]['SAP_OBJECT_NAME'];
					$SAP_OBJECT_DESC    = $res[0]['SAP_OBJECT_DESC'];
					$SAP_STR_DATE    = $res[0]['SAP_STR_DATE'];
					$SAP_END_DATE    = $res[0]['SAP_END_DATE'];
					
				 }
						   
				include("sap_activity_log_editor.php");						  
				break;
						   
         case 'delete': 
				$SAL_ID               = $_REQUEST['SAL_ID'];
				
				$info['table']    = "SAP_ACTIVITY_LOG";
				$info['where']    = "SAL_ID='$SAL_ID'";
				
				if($SAL_ID)
				{
					$db->delete($info);
				}
				include("sap_activity_log_list.php");						   
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
				include("sap_activity_log_list.php");
				break; 
        case "search_sap_activity_log":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("sap_activity_log_list.php");
				break;  								   
						
	     default :    
		       include("sap_activity_log_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'SAP_ACTIVITY_LOG'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
