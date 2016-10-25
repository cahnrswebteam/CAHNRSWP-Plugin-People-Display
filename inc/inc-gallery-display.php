<article class="<?php echo $class; ?>">
 <ul>
   	<li class="gallery-photo"><a class="profile-link" data-id="<?php echo $profile->profile_ID;?>" data-name="<?php echo $profile->profile_title->rendered;?>" href="#"><img src="<?php  echo $profile->profile_photo == '' ?  plugins_url('CAHNRSWP-Plugin-People-Display/images/placeholder.png') : $profile->profile_photo  ?>" align="left" /></a></li>
        <li class="gallery-name">
		   <a class="profile-link" data-id="<?php echo $profile->profile_ID;?>" data-name="<?php echo $profile->profile_title->rendered;?> href="#"><?php  echo $profile->profile_last_name; ?>, <?php  echo $profile->profile_first_name; ?></a>        
        </li>
        <li class="gallery-title">
	        <?php  echo $title; ?>
        </li>
        <li class="gallery-link">
          <a class="profile-link" data-id="<?php echo $profile->profile_ID;?>" data-name="<?php echo $profile->profile_title->rendered;?> href="#">View Full Profile</a>
        </li>
   </ul>    
</article>