<div class="close">X</div>
<img src="<?php  echo $one_profile->profile_photo == '' ?  plugins_url('CAHNRSWP-Plugin-People-Display/images/placeholder.png') : $one_profile->profile_photo  ?>" align="left" />

<?php  echo $one_profile->first_name; ?> <?php  echo $one_profile->last_name; ?><br />
<?php  echo $one_profile->office; ?><br />
<?php  echo $one_profile->office_alt; ?><br />
<?php  echo $one_profile->phone; ?><br />
<a href="mailto:<?php echo $one_profile->email;?>"><?php echo $one_profile->email;?></a><br />
<a href="<?php  echo $one_profile->website; ?>">Website</a><br />
<?php  echo $one_profile->position_title; ?><p />
<?php // echo implode("," ,$one_profile->working_title); ?>
<?php //  echo implode("," , $one_profile->degree); ?>
<?php // echo  implode("," ,$one_profile->college_bio); ?>
<?php // echo implode("," ,$one_profile->dept_bio); ?>
<div class="profile-content">
<?php echo $one_profile->content->rendered; ?>
</div>

