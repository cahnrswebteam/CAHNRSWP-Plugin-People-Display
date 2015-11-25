<?php
$classes = array();
foreach ( $actions as $action ) {
	$classes[] = ' ' .  $action;
}
?>
<div class="people-actions<?php foreach ( $classes as $class ) { echo $class; } ?>">

	<div class="people-actions-inner">

		<?php if ( in_array( 'search', $actions ) ) : ?>
		<div><input type="search" class="cahnrs-search-field people-search" value="" placeholder="Search" autocomplete="off"></div>
		<?php endif; ?>

		<?php
  	if ( in_array( 'location', $actions ) ) :

			$locations_sortable_items = array();

			foreach ( $people as $person ) {
				
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
						if ( ! in_array( array( 'slug' => esc_attr( $location->slug ), 'name' => esc_attr( $location->name ) ), $locations_sortable_items ) ) {
							array_push( $locations_sortable_items, array( 'slug'=>esc_attr( $location->slug ), 'name'=>esc_attr( $location->name ) ) );
						}
					}
				}

			}

			if ( ! empty( $locations_sortable_items ) ) :
			?>
				<h2>Locations</h2>
				<div class="filter locations-container">
					<ul class="browse-terms locations">
					<?php foreach ( $locations_sortable_items as $item ) { ?>
						<li class="wsuwp_university_location-<?php echo $item['slug']; ?>">
            	<label><input type="checkbox" data-filter="location" value="<?php echo $item['slug']; ?>" /><span><?php echo $item['name']; ?></span></label>
						</li>
					<?php } ?>
					</ul>
				</div>
			<?php
			endif;

  	endif;
		?>

	</div>

</div>