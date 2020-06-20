<style>
	  .btn + .btn {
	   margin-left: 0px; 
	}
	
	.btn-block+.btn-block {
	     margin-top: 1px; 
	}
</style>
<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<?php
			  $b_name_file = basename($_SERVER['SCRIPT_FILENAME']);
			  $b_name_arr  = explode(".",$b_name_file);
			  $b_name      = $b_name_arr[0];
			?>
            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				
              
            <li class="start">
					<a href="../home">
					<i class="icon-home"></i>
					<span class="title">Home</span>
					</a>
				</li>
              
				<li class="start active open">
					<a href="javascript:;">
					<i class="fa fa-cogs"></i>
					<span class="title">Menu</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>					
				</li>
				
				<li  <?php if(
				               $b_name=="change_profile" ||
							     $b_name=="change_password" 
							   ) { ?> class="active open" <?php } ?>>   
					<a href="javascript:;">
					<i class="icon-rocket"></i>
					<span class="title">My Info</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
					         <li <?php if($b_name=="change_profile") { echo 'class="active"'; } ?>><a href="../change_profile">Change Profile</a></li>
                        <li <?php if($b_name=="change_password") { echo 'class="active"'; } ?>><a href="../change_password">Change password</a></li>
              </ul>          
				</li>
				
            <li class="start">
					<a href="../company">
					<i class="icon-rocket"></i>
					<span class="title">Company</span>
					</a>
				</li>
				
				<li class="start">
					<a href="../products">
					<i class="icon-rocket"></i>
					<span class="title">Products</span>
					</a>
				</li>
			
                 
			</ul>
			<!-- END SIDEBAR MENU -->
           
	
          
			
		</div>
	</div>