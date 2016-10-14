<div class="wsuprofileTableRowData"> 
	<div class="wsuprofileTableCell"><a class="profile-link" data-id="<?php echo $profile->profile_ID;?>" data-name="<?php echo $profile->profile_title->rendered;?>" href="#"><img src="<?php  echo $profile->profile_photo == '' ?  plugins_url('CAHNRSWP-Plugin-People-Display/images/placeholder.png') : $profile->profile_photo  ?>" width="62" /></a></div>  	
   	<div class="wsuprofileTableCell name"><a href="mailto:<?php echo $profile->profile_email;?>"><?php  echo $profile->profile_last_name;?>, <?php  echo $profile->profile_first_name;?></a></div>
   <div class="wsuprofileTableCell title"><?php  echo implode(",", $profile->profile_working_title); ?></div> 
    <div class="wsuprofileTableCell department"><?php ?></div> 
    <div class="wsuprofileTableCell work-group"><?php  ?></div>
</div>
