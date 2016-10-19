<article class="<?php echo $class; ?>">
 <ul>
   	<li class="gallery-photo"><img src="<?php  echo $profile->profile_photo == '' ?  plugins_url('CAHNRSWP-Plugin-People-Display/images/placeholder.png') : $profile->profile_photo  ?>" align="left" />    	</li>
        <li class="gallery-name">
		    <?php  echo $profile->profile_last_name; ?>, <?php  echo $profile->profile_first_name; ?>        
        </li>
        <li class="gallery-title">
	        <?php  echo $profile->profile_position_title; ?>
        </li>
        <li class="gallery-link">
			    <a data-id="<?php echo $profile->profile_ID;?>" data-name="<?php echo $profile->profile_title->rendered;?> href="#">View Full Profile</a>        
        </li>
   </ul>    
</article>