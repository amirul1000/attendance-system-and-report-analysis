<?php
 include("../template/header.php");
?>
<script language="javascript" src="attendance.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

<a href="index.php?cmd=list" class="btn green">List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","attendance"))?></b>
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

								 <form name="frm_attendance" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
                                             <td>ATT USER ID</td>
                                             <td>
                                                <input type="text" name="ATT_USER_ID" id="ATT_USER_ID"  value="<?=$ATT_USER_ID?>" class="textbox">
                                             </td>
                                         </tr><tr>
                                             <td>ATT STR DATE</td>
                                             <td>
                                                <input type="text" name="ATT_STR_DATE" id="ATT_STR_DATE"  value="<?=$ATT_STR_DATE?>" class="textbox">
                                             </td>
                                         </tr><tr>
                                             <td>ATT END DATE</td>
                                             <td>
                                                <input type="text" name="ATT_END_DATE" id="ATT_END_DATE"  value="<?=$ATT_END_DATE?>" class="textbox">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>ATT WORKING</td>
                                             <td>
                                                <input type="text" name="ATT_WORKING" id="ATT_WORKING"  value="<?=$ATT_WORKING?>" class="textbox">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>ATT LB DATE</td>
                                             <td>
                                                <input type="text" name="ATT_LB_DATE" id="ATT_LB_DATE"  value="<?=$ATT_LB_DATE?>" class="textbox">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>ATT UI DEVICE</td>
                                             <td>
                                                <input type="text" name="ATT_UI_DEVICE" id="ATT_UI_DEVICE"  value="<?=$ATT_UI_DEVICE?>" class="textbox">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>ATT UI BEACON</td>
                                             <td>
                                                <input type="text" name="ATT_UI_BEACON" id="ATT_UI_BEACON"  value="<?=$ATT_UI_BEACON?>" class="textbox">
                                             </td>
                                         </tr>
										 <tr> 
											 <td align="right"></td>
											 <td>
												<input type="hidden" name="cmd" value="add">
												<input type="hidden" name="ATT_ID" value="<?=$ATT_ID?>">			
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

