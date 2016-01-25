<?php
$classes = array();

$locations_response = wp_remote_get( 'http://localhost/wp-json/wp/v2/people/' . $person->id . '/terms/wsuwp_university_location', array( 'sslverify' => false ) );

if ( is_wp_error( $locations_response ) ) {
	return '<!-- error -->';
}

$locations_data = wp_remote_retrieve_body( $locations_response );

if ( empty( $locations_data ) ) {
	return '<!-- error -->';
}

$locations = json_decode( $locations_data );

if ( $locations ) {
	foreach ( $locations as $location ) {
		$classes[] = ' location-' . esc_attr( $location->slug );
	}
}
?>
<article class="wsuwp-person-container<?php foreach( $classes as $class ) { echo $class; } ?>">

	<div class="person">

		<div>
			<a class="profile-link" href="<?php echo esc_url( $person->link ); ?>" data-name="<?php echo esc_html( $person->title->rendered ); ?>" data-id="<?php echo esc_html( $person->id ); ?>"><img src="<?php echo plugins_url( 'images/placeholder.jpg', dirname( __FILE__ ) ); ?>" <?php
				if ( isset( $person->profile_photo ) && $person->profile_photo ) {
    			echo ' data-photo="' . esc_url( $person->profile_photo ) . '"';
				}
			?> /></a>
		</div>

		<header class="card">
			<div class="wsuwp-person-name">
				<a class="profile-link" href="<?php echo esc_url( $person->link ); ?>" data-name="<?php echo esc_html( $person->title->rendered ); ?>" data-id="<?php echo esc_html( $person->id ); ?>"><?php echo esc_html( $person->title->rendered ); ?></a>
			</div>
			<div class="wsuwp-person-position"><?php echo esc_html( $title ); ?></div>
		</header>

	</div>

</article>