<?php
 include("../template/header.php");
?>
<script language="javascript" src="user_confirmation.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

<a href="index.php?cmd=list" class="btn green">List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","user_confirmation"))?></b>
          </div>
          <div class="tools">
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a>
          </div>
      </div>
	   <div class="portlet-body">
		         <div class="table-responsive">	
	                <table class="table">
							 <tr>
							  <td>  

								 <form name="frm_user_confirmation" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
						 <td>UC DATE</td>
						 <td>
						    <input type="text" name="UC_DATE" id="UC_DATE"  value="<?=$UC_DATE?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>UC USER ID</td>
						 <td>
						    <input type="text" name="UC_USER_ID" id="UC_USER_ID"  value="<?=$UC_USER_ID?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>UC TIME DELTA</td>
						 <td>
						    <input type="text" name="UC_TIME_DELTA" id="UC_TIME_DELTA"  value="<?=$UC_TIME_DELTA?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>UC ATT WORKING</td>
						 <td>
						    <input type="text" name="UC_ATT_WORKING" id="UC_ATT_WORKING"  value="<?=$UC_ATT_WORKING?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>UC ACTION</td>
						 <td>
						    <input type="text" name="UC_ACTION" id="UC_ACTION"  value="<?=$UC_ACTION?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>UC ACTION CODE</td>
						 <td>
						    <input type="text" name="UC_ACTION_CODE" id="UC_ACTION_CODE"  value="<?=$UC_ACTION_CODE?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>UC DESCRIPTION</td>
						 <td>
						    <input type="text" name="UC_DESCRIPTION" id="UC_DESCRIPTION"  value="<?=$UC_DESCRIPTION?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>UC REACTION TIME</td>
						 <td>
						    <input type="text" name="UC_REACTION_TIME" id="UC_REACTION_TIME"  value="<?=$UC_REACTION_TIME?>" class="textbox">
						 </td>
				     </tr>
										 <tr> 
											 <td align="right"></td>
											 <td>
												<input type="hidden" name="cmd" value="add">
												<input type="hidden" name="UC_ID" value="<?=$UC_ID?>">			
												<input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
											 </td>     
										 </tr>
										</table>
										</div>
										</div>
								</form>
							  </td>
							 </tr>
							</table>
			      </div>
			</div>
  </div>			
<?php
 include("../template/footer.php");
?>

