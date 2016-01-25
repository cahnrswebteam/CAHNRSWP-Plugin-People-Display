<?php
$classes = array();

/*$locations_response = wp_remote_get( 'http://localhost/wp-json/wp/v2/people/' . $person->id . '/terms/wsuwp_university_location', array( 'sslverify' => false ) );

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
}*/

$photo = $person->profile_photo;
?>
<tr class="wsuwp-person-container<?php foreach( $classes as $class ) { echo $class; } ?>">
	<td class="photo">
		<a class="profile-link" href="<?php echo esc_url( $person->link ); ?>" data-name="<?php echo esc_html( $person->title->rendered ); ?>" data-id="<?php echo esc_html( $person->id ); ?>"><img src="<?php echo plugins_url( 'images/placeholder.jpg', dirname( __FILE__ ) ); ?>" <?php
		if ( isset( $person->profile_photo ) && $person->profile_photo ) {
    	echo ' data-photo="' . esc_url( $person->profile_photo ) . '"';
		}
		?> /></a>
	</td>
	<td class="card">
		<strong><a class="profile-link" href="<?php echo esc_url( $person->link ); ?>" data-name="<?php echo esc_html( $person->title->rendered ); ?>" data-id="<?php echo esc_html( $person->id ); ?>"><?php echo esc_html( $person->title->rendered ); ?></a></strong><br />
		<?php if ( $title ) { echo esc_html( $title ) . '<br />'; } ?>
    <?php if ( $email ) { ?><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a><br /><?php } ?>
		<?php if ( $phone ) { echo esc_html( $phone ) . '<br />'; } ?>
		<?php if ( $office ) { echo esc_html( $office ); } ?>
	</td>
  <td class="about">
		<?php if ( $person->content->rendered ) { echo substr( wp_kses_post( $person->content->rendered ), 0, 200 ) . '... '; } ?>
	</td>
</tr>