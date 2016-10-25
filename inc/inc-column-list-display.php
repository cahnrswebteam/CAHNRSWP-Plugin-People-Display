<div class="column-list-profile <?php echo $class; ?>"><div class="clphoto"><a class="profile-link" data-id="<?php echo $profile->profile_ID;?>" data-name="<?php echo $profile->profile_title->rendered;?> href="#"><img src="<?php  echo $profile->profile_photo == '' ?  plugins_url('CAHNRSWP-Plugin-People-Display/images/placeholder.png') : $profile->profile_photo  ?>" align="left" /></a></div>
 <div class="cldata">
    <div class="clname"><a class="profile-link" data-id="<?php echo $profile->profile_ID;?>" data-name="<?php echo $profile->profile_title->rendered;?> href="#"><?php  echo $profile->profile_first_name; ?> <?php  echo $profile->profile_last_name; ?></a>
</div>
    <div class="cltitle"><?php  echo $title; ?></div>
    <div class="clemail">
    	<a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
     </div>   
    <div class="clphone"><?php  echo $phone; ?></div><?php  echo $office; ?></div>
</div>

