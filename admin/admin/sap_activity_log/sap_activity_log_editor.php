<?php
 include("../template/header.php");
?>
<script language="javascript" src="sap_activity_log.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

<a href="index.php?cmd=list" class="btn green">List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","sap_activity_log"))?></b>
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

								 <form name="frm_sap_activity_log" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
						 <td>SAL USER ID</td>
						 <td>
						    <input type="text" name="SAL_USER_ID" id="SAL_USER_ID"  value="<?=$SAL_USER_ID?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SAP OBJECT</td>
						 <td>
						    <input type="text" name="SAP_OBJECT" id="SAP_OBJECT"  value="<?=$SAP_OBJECT?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SAP OBJECT NAME</td>
						 <td>
						    <input type="text" name="SAP_OBJECT_NAME" id="SAP_OBJECT_NAME"  value="<?=$SAP_OBJECT_NAME?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SAP OBJECT DESC</td>
						 <td>
						    <input type="text" name="SAP_OBJECT_DESC" id="SAP_OBJECT_DESC"  value="<?=$SAP_OBJECT_DESC?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SAP STR DATE</td>
						 <td>
						    <input type="text" name="SAP_STR_DATE" id="SAP_STR_DATE"  value="<?=$SAP_STR_DATE?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('SAP_STR_DATE');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
						 <td>SAP END DATE</td>
						 <td>
						    <input type="text" name="SAP_END_DATE" id="SAP_END_DATE"  value="<?=$SAP_END_DATE?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('SAP_END_DATE');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr>
										 <tr> 
											 <td align="right"></td>
											 <td>
												<input type="hidden" name="cmd" value="add">
												<input type="hidden" name="SAL_ID" value="<?=$SAL_ID?>">			
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

