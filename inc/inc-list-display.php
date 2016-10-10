<!-- list display -->

<div class="wsuprofileTableRow"> 
	<div class="wsuprofileTableCell"><img src="<?php  echo $profile->profile_photo;?>" width="62" /></div>  	
   	<div class="wsuprofileTableCell"><a href="mailto:<?php  echo $profile->profile_email;?>"><?php  echo $profile->profile_last_name;?>, <?php  echo $profile->profile_first_name;?></a></div>
   <div class="wsuprofileTableCell"><?php  echo implode(",", $profile->profile_working_title); ?></div> 
    <div class="wsuprofileTableCell"><?php   ?></div> 
    <div class="wsuprofileTableCell"><?php  ?></div>
</div>
