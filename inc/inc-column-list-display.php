<!-- columen small list view -->
<div class="column-list-profile <?php echo $class; ?>">
	<div class="clphoto">
		<img src="<?php  echo $profile->profile_photo == '' ?  plugins_url('CAHNRSWP-Plugin-People-Display/images/placeholder.png') : $profile->profile_photo  ?>" align="left" />
    </div>
    <div class="cldata">
    <div class="clname"><?php  echo $profile->profile_first_name; ?> <?php  echo $profile->profile_last_name; ?></div>
    <div class="cltitle">	<?php  echo $profile->profile_position_title; ?></div>
    <div class="clemail">
    	<a href="mailto:<?php echo $profile->profile_email;?>"><?php echo $profile->profile_email;?></a>
     </div>   
    <div class="clphone">
	    <?php  echo $profile->profile_phone; ?>
    </div>
	<?php  echo $profile->profile_office; ?>
	<?php  echo $profile->profile_office_alt; ?>
    </div>
</div>



