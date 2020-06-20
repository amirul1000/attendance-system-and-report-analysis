<?php
 include("../template/header.php");
?>
<script language="javascript" src="defects.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

<a href="index.php?cmd=list" class="btn green">List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","defects"))?></b>
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

								 <form name="frm_defects" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
						 <td>D USER ID</td>
						 <td>
						    <input type="text" name="D_USER_ID" id="D_USER_ID"  value="<?=$D_USER_ID?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>DEFECT</td>
						 <td>
						    <input type="text" name="DEFECT" id="DEFECT"  value="<?=$DEFECT?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>D ACTION</td>
						 <td>
						    <input type="text" name="D_ACTION" id="D_ACTION"  value="<?=$D_ACTION?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>D DESCRIPTION</td>
						 <td>
						    <input type="text" name="D_DESCRIPTION" id="D_DESCRIPTION"  value="<?=$D_DESCRIPTION?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>D STR DATE</td>
						 <td>
						    <input type="text" name="D_STR_DATE" id="D_STR_DATE"  value="<?=$D_STR_DATE?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('D_STR_DATE');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
						 <td>D END DATE</td>
						 <td>
						    <input type="text" name="D_END_DATE" id="D_END_DATE"  value="<?=$D_END_DATE?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('D_END_DATE');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr>
										 <tr> 
											 <td align="right"></td>
											 <td>
												<input type="hidden" name="cmd" value="add">
												<input type="hidden" name="DEFECT_ID" value="<?=$DEFECT_ID?>">			
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

