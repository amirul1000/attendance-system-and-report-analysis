<?php
 include("../template/header.php");
?>
<script language="javascript" src="users.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

<a href="index.php?cmd=list" class="btn green">List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","users"))?></b>
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

								 <form name="frm_users" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										<!-- <tr>
                                             <td>USER ID</td>
                                             <td>
                                                <input type="text" name="USER_ID" id="USER_ID"  value="<?=$USER_ID?>" class="textbox">
                                             </td>
                                         </tr>-->
                                         <tr>
                                             <td>USER NAME</td>
                                             <td>
                                                <input type="text" name="USER_NAME" id="USER_NAME"  value="<?=$USER_NAME?>" class="textbox">
                                             </td>
                                         </tr><tr>
                                             <td>USER PASS</td>
                                             <td>
                                                <input type="text" name="USER_PASS" id="USER_PASS"  value="<?=$USER_PASS?>" class="textbox">
                                             </td>
                                         </tr><tr>
                                             <td>USER COMPANY NAME</td>
                                             <td>
                                                <input type="text" name="USER_COMPANY_NAME" id="USER_COMPANY_NAME"  value="<?=$USER_COMPANY_NAME?>" class="textbox">
                                             </td>
                                         </tr>
										 <tr> 
											 <td align="right"></td>
											 <td>
												<input type="hidden" name="cmd" value="add">
												<input type="hidden" name="USER_ID" value="<?=$USER_ID?>">			
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

