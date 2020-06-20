<?php
 include("../template/header.php");
?>
<script language="javascript" src="sap_org.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

<a href="index.php?cmd=list" class="btn green">List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","sap_org"))?></b>
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

								 <form name="frm_sap_org" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
						 <td>SO COMPANY</td>
						 <td>
						    <input type="text" name="SO_COMPANY" id="SO_COMPANY"  value="<?=$SO_COMPANY?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SO DESC</td>
						 <td>
						    <input type="text" name="SO_DESC" id="SO_DESC"  value="<?=$SO_DESC?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SO PERSON</td>
						 <td>
						    <input type="text" name="SO_PERSON" id="SO_PERSON"  value="<?=$SO_PERSON?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SO ORG LEVEL</td>
						 <td>
						    <input type="text" name="SO_ORG_LEVEL" id="SO_ORG_LEVEL"  value="<?=$SO_ORG_LEVEL?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SO PERSON REPORT TO</td>
						 <td>
						    <input type="text" name="SO_PERSON_REPORT_TO" id="SO_PERSON_REPORT_TO"  value="<?=$SO_PERSON_REPORT_TO?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SO FIRST NAME</td>
						 <td>
						    <input type="text" name="SO_FIRST_NAME" id="SO_FIRST_NAME"  value="<?=$SO_FIRST_NAME?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SO LAST NAME</td>
						 <td>
						    <input type="text" name="SO_LAST_NAME" id="SO_LAST_NAME"  value="<?=$SO_LAST_NAME?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SO DEFECTS</td>
						 <td>
						    <input type="text" name="SO_DEFECTS" id="SO_DEFECTS"  value="<?=$SO_DEFECTS?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SO ACTIVITY</td>
						 <td>
						    <input type="text" name="SO_ACTIVITY" id="SO_ACTIVITY"  value="<?=$SO_ACTIVITY?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>SO ATTENDANCE</td>
						 <td>
						    <input type="text" name="SO_ATTENDANCE" id="SO_ATTENDANCE"  value="<?=$SO_ATTENDANCE?>" class="textbox">
						 </td>
				     </tr>
										 <tr> 
											 <td align="right"></td>
											 <td>
												<input type="hidden" name="cmd" value="add">
												<input type="hidden" name="SO_ID" value="<?=$SO_ID?>">			
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

