<div class="close">X</div>
<img src="<?php  echo $one_profile->profile_photo == '' ?  plugins_url('CAHNRSWP-Plugin-People-Display/images/placeholder.png') : $one_profile->profile_photo  ?>" align="left" />

<?php  echo $one_profile->first_name; ?> <?php  echo $one_profile->last_name; ?><br />
<?php  echo $office; ?><br />
<?php  echo $phone; ?><br />
<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a><br />
<?php echo $one_profile->website == '' ? '' : '<a href="' . $one_profile->website . '">Website</a><br />'; ?>
<?php echo $title; ?>
<?php // echo implode("," , $one_profile->degrees); ?><br />
<?php // echo  implode("," ,$one_profile->college_bio); ?>
<?php // echo implode("," ,$one_profile->dept_bio); ?><br />
<div class="profile-content">
<?php echo $one_profile->content->rendered; ?>
</div>

