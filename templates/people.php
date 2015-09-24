<?php
$classes = array();
if ( $person->terms->wsuwp_university_location ) {
	foreach ( $person->terms->wsuwp_university_location as $locations ) {
		$classes[] = ' location-' . esc_attr( $locations->slug );
	}
}
?>
<article class="wsuwp-person-container <?php foreach( $classes as $class ) { echo $class; } ?>">

	<div class="person">

		<div>
			<a class="profile-link" href="<?php echo esc_url( $person->link ); ?>" data-name="<?php echo esc_html( $person->title ); ?>" data-id="<?php echo esc_html( $person->ID ); ?>"><img src="<?php echo plugins_url( 'images/placeholder.jpg', dirname( __FILE__ ) ); ?>" <?php
				if ( isset( $person->profile_photo ) && $person->profile_photo ) {
    			echo ' data-photo="' . esc_url( $person->profile_photo ) . '"';
				}
			?> /></a>
		</div>

		<header class="card">
			<div class="wsuwp-person-name">
				<a class="profile-link" href="<?php echo esc_url( $person->link ); ?>" data-name="<?php echo esc_html( $person->title ); ?>" data-id="<?php echo esc_html( $person->ID ); ?>"><?php echo esc_html( $person->title ); ?></a>
			</div>
			<div class="wsuwp-person-position"><?php echo esc_html( $title ); ?></div>
		</header>

	</div>

</article>