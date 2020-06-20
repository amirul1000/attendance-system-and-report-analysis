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
				$info['table']    = "DEFECTS";
				$data['D_USER_ID']   = $_REQUEST['D_USER_ID'];
                $data['DEFECT']   = $_REQUEST['DEFECT'];
                $data['D_ACTION']   = $_REQUEST['D_ACTION'];
                $data['D_DESCRIPTION']   = $_REQUEST['D_DESCRIPTION'];
                $data['D_STR_DATE']   = $_REQUEST['D_STR_DATE'];
                $data['D_END_DATE']   = $_REQUEST['D_END_DATE'];
                
				
				$info['data']     =  $data;
				
				if(empty($_REQUEST['DEFECT_ID']))
				{
					 $db->insert($info);
				}
				else
				{
					$DEFECT_ID            = $_REQUEST['DEFECT_ID'];
					$info['where'] = "DEFECT_ID=".$DEFECT_ID;
					
					$db->update($info);
				}
				
				include("defects_list.php");						   
				break;    
		case "edit":      
				$DEFECT_ID               = $_REQUEST['DEFECT_ID'];
				if( !empty($DEFECT_ID ))
				{
					$info['table']    = "DEFECTS";
					$info['fields']   = array("*");   	   
					$info['where']    =  "DEFECT_ID=".$DEFECT_ID;
				   
					$res  =  $db->select($info);
				   
					$DEFECT_ID        = $res[0]['DEFECT_ID'];  
					$D_USER_ID    = $res[0]['D_USER_ID'];
					$DEFECT    = $res[0]['DEFECT'];
					$D_ACTION    = $res[0]['D_ACTION'];
					$D_DESCRIPTION    = $res[0]['D_DESCRIPTION'];
					$D_STR_DATE    = $res[0]['D_STR_DATE'];
					$D_END_DATE    = $res[0]['D_END_DATE'];
					
				 }
						   
				include("defects_editor.php");						  
				break;
						   
         case 'delete': 
				$DEFECT_ID               = $_REQUEST['DEFECT_ID'];
				
				$info['table']    = "DEFECTS";
				$info['where']    = "DEFECT_ID='$DEFECT_ID'";
				
				if($DEFECT_ID)
				{
					$db->delete($info);
				}
				include("defects_list.php");						   
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
				include("defects_list.php");
				break; 
        case "search_defects":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("defects_list.php");
				break;  								   
						
	     default :    
		       include("defects_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'DEFECTS'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
