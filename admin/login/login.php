<?php
       session_start();
	   include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   	   
	   $cmd = $_REQUEST['cmd'];
	 
		switch($cmd)
		{
		
		  case "login":
				$info["table"]     = "users";
				$info["fields"]   = array("*");
				$info["where"]    = " 1=1 AND email='".clean($_REQUEST["email"])."' AND password='".clean($_REQUEST["password"])."' AND type='super'";
				$res  = $db->select($info);
			
				if(count($res)>0)
				{
					$_SESSION["users_id"]   = $res[0]["USER_ID"];
					$_SESSION["USER_NAME"]      = $res[0]["USER_NAME"];
					$_SESSION["USER_COMPANY_NAME"] = $res[0]["USER_COMPANY_NAME"];
					
					Header("Location: ../login/login_enter.php");
				
				}							 
				else
				{
					$message="Login fail,Please verify your userid or password";
					include("login_editor.php");
				}	
				break;	
		case "logout":
				session_destroy();
				unset($_SESSION["users_id"]);
				unset($_SESSION["email"]);
				unset($_SESSION["first_name"]);
				unset($_SESSION["last_name"]);
				unset($_SESSION["type"]);
				
				include("login_editor.php");
				break;	   	 
		default :					 
				session_destroy();
				unset($_SESSION["users_id"]);
				unset($_SESSION["email"]);
				unset($_SESSION["first_name"]);
				unset($_SESSION["last_name"]);
				unset($_SESSION["type"]);
							
				include("login_editor.php");
		}	
 function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	$str = stripslashes($str);
	$str = str_replace("'","",$str);
	$str = str_replace('"',"",$str);
	$str = str_replace("-","",$str);
	$str = str_replace(";","",$str);
	$str = str_replace("or 1","",$str);
	$str = str_replace("drop","",$str);
	
	return mysql_real_escape_string($str);
}					
?>