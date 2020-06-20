<?php
 include("../templates/header.php");
 ?>
 <div class="g3" align="center">
 <link rel="stylesheet" href="../../css/admin_style.css" >
<form method="post">
<table align="center" cellspacing="3" cellpadding="3">
        <tr>
		 <td colspan="2">
		 <span align="center"><font color="#FF0000"><?=$message?></font></span>
		 </td>
		</tr>   
		<tr>
			<td>Userid(Email)</td>
			<td><input type="text" name="email" id="email" value="" class="textbox" /></td>
		</tr>
		<tr><td colspan="2" align="center"><a href="../login/login.php">Back</a></td></tr>
		<tr> 
		   <td>
		   </td>		
		   <td>
			<input type="hidden" name="cmd" value="forget_pass"/> 
			<input type="submit" name="submit" value="submit" /> 
			</td>
		</tr>
</table>
</form>
</div>
<?php
 include("../templates/footer.php");
?>