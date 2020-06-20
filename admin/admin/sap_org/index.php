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
				$info['table']    = "SAP_ORG";
				$data['SO_COMPANY']   = $_REQUEST['SO_COMPANY'];
                $data['SO_DESC']   = $_REQUEST['SO_DESC'];
                $data['SO_PERSON']   = $_REQUEST['SO_PERSON'];
                $data['SO_ORG_LEVEL']   = $_REQUEST['SO_ORG_LEVEL'];
                $data['SO_PERSON_REPORT_TO']   = $_REQUEST['SO_PERSON_REPORT_TO'];
                $data['SO_FIRST_NAME']   = $_REQUEST['SO_FIRST_NAME'];
                $data['SO_LAST_NAME']   = $_REQUEST['SO_LAST_NAME'];
                $data['SO_DEFECTS']   = $_REQUEST['SO_DEFECTS'];
                $data['SO_ACTIVITY']   = $_REQUEST['SO_ACTIVITY'];
                $data['SO_ATTENDANCE']   = $_REQUEST['SO_ATTENDANCE'];
                
				
				$info['data']     =  $data;
				
				if(empty($_REQUEST['SO_ID']))
				{
					 $db->insert($info);
				}
				else
				{
					$SO_ID            = $_REQUEST['SO_ID'];
					$info['where'] = "SO_ID=".$SO_ID;
					
					$db->update($info);
				}
				
				include("sap_org_list.php");						   
				break;    
		case "edit":      
				$SO_ID               = $_REQUEST['SO_ID'];
				if( !empty($SO_ID ))
				{
					$info['table']    = "SAP_ORG";
					$info['fields']   = array("*");   	   
					$info['where']    =  "SO_ID=".$SO_ID;
				   
					$res  =  $db->select($info);
				   
					$SO_ID        = $res[0]['SO_ID'];  
					$SO_COMPANY    = $res[0]['SO_COMPANY'];
					$SO_DESC    = $res[0]['SO_DESC'];
					$SO_PERSON    = $res[0]['SO_PERSON'];
					$SO_ORG_LEVEL    = $res[0]['SO_ORG_LEVEL'];
					$SO_PERSON_REPORT_TO    = $res[0]['SO_PERSON_REPORT_TO'];
					$SO_FIRST_NAME    = $res[0]['SO_FIRST_NAME'];
					$SO_LAST_NAME    = $res[0]['SO_LAST_NAME'];
					$SO_DEFECTS    = $res[0]['SO_DEFECTS'];
					$SO_ACTIVITY    = $res[0]['SO_ACTIVITY'];
					$SO_ATTENDANCE    = $res[0]['SO_ATTENDANCE'];
					
				 }
						   
				include("sap_org_editor.php");						  
				break;
						   
         case 'delete': 
				$SO_ID               = $_REQUEST['SO_ID'];
				
				$info['table']    = "SAP_ORG";
				$info['where']    = "SO_ID='$SO_ID'";
				
				if($SO_ID)
				{
					$db->delete($info);
				}
				include("sap_org_list.php");						   
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
				include("sap_org_list.php");
				break; 
        case "search_sap_org":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("sap_org_list.php");
				break;  								   
						
	     default :    
		       include("sap_org_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'SAP_ORG'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
