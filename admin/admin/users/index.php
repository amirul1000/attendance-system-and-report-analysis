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
				$info['table']    = "USERS";
				//$data['USER_ID']   = $_REQUEST['USER_ID'];
                $data['USER_NAME']   = $_REQUEST['USER_NAME'];
                $data['USER_PASS']   = $_REQUEST['USER_PASS'];
                $data['USER_COMPANY_NAME']   = $_REQUEST['USER_COMPANY_NAME'];
                
				
				$info['data']     =  $data;
				
				if(empty($_REQUEST['USER_ID']))
				{
					 $db->insert($info);
				}
				else
				{
					$USER_ID            = $_REQUEST['USER_ID'];
					$info['where'] = "USER_ID=".$USER_ID;
					
					$db->update($info);
				}
				
				include("users_list.php");						   
				break;    
		case "edit":      
				$USER_ID               = $_REQUEST['USER_ID'];
				if( !empty($USER_ID ))
				{
					$info['table']    = "USERS";
					$info['fields']   = array("*");   	   
					$info['where']    =  "USER_ID=".$USER_ID;
				   
					$res  =  $db->select($info);
				   
					$USER_ID    = $res[0]['USER_ID'];
					$USER_NAME    = $res[0]['USER_NAME'];
					$USER_PASS    = $res[0]['USER_PASS'];
					$USER_COMPANY_NAME    = $res[0]['USER_COMPANY_NAME'];
					
				 }
						   
				include("users_editor.php");						  
				break;
						   
         case 'delete': 
				$USER_ID               = $_REQUEST['USER_ID'];
				
				$info['table']    = "USERS";
				$info['where']    = "USER_ID='$USER_ID'";
				
				if($USER_ID)
				{
					$db->delete($info);
				}
				include("users_list.php");						   
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
				include("users_list.php");
				break; 
        case "search_users":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("users_list.php");
				break;  								   
						
	     default :    
		       include("users_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'users'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
