<?php
$classes = array();
foreach ( $actions as $action ) {
	$classes[] = ' ' .  $action;
}
?>
<div class="people-actions<?php foreach ( $classes as $class ) { echo $class; } ?>">

	<div class="people-actions-inner">

		<?php if ( in_array( 'search', $actions ) ) : ?>
		<div><input type="search" id="people-search" class="cahnrs-search-field" value="" placeholder="Search" autocomplete="off"></div>
		<?php endif; ?>

		<?php
  	if ( in_array( 'location', $actions ) ) :
			$locations_sortable_items = array();
			foreach ( $people as $person ) {
				if ( $person->terms->wsuwp_university_location ) {
					foreach ( $person->terms->wsuwp_university_location as $item ) {
						if ( ! in_array( array( 'slug' => esc_attr( $item->slug ), 'name' => esc_attr( $item->name ) ), $locations_sortable_items ) ) {
							array_push( $locations_sortable_items, array( 'slug'=>esc_attr( $item->slug ), 'name'=>esc_attr( $item->name ) ) );
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