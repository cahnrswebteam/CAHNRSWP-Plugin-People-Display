<a class="profile-link" data-id="<?php echo $profile->profile_ID;?>" data-name="<?php echo $profile->profile_title->rendered;?>" href="#"><img src="<?php  echo $profile->profile_photo == '' ?  plugins_url('CAHNRSWP-Plugin-People-Display/images/placeholder.png') : $profile->profile_photo  ?>" /></a>