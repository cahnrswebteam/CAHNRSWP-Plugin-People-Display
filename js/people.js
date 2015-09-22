jQuery(document).ready(function($){

	var default_title = document.title;

	// Show/hide profiles according to selected filter options.
	$( '.filter .browse-terms li label' ).on( 'change', 'input:checkbox', function() {

		var sort_class = new Array(),
				profiles = $(this).parents( '.wsuwp-people-wrapper' ).find( '.wsuwp-person-container' );

		$( '.filter .browse-terms input:checkbox:checked' ).each( function() {
			sort_class.push( '.' + $(this).data( 'filter' ) + '-' + $(this).attr( 'value' ) );
		});

		if ( '' != sort_class ) {
			profiles.not( sort_class.join( ',' ) ).hide( 'fast' );
			profiles.filter( sort_class.join( ',' ) ).show( 'fast' );
		} else {
			profiles.show( 'fast' );
		}

	})

	// Search.
	$( '.people-actions' ).on( 'keyup', '.people-search', function() {

		var	searchval = $(this).val(),
				profiles = $(this).parents( '.wsuwp-people-wrapper' ).find( '.wsuwp-person-container' );

		if ( searchval.length > 0 ) {
			profiles.each( function() {
				var c = $(this);
				if ( c.text().toLowerCase().indexOf( searchval.toLowerCase() ) > 0 ) {
					c.show( 'fast' );
				} else {
					c.hide( 'fast' );
				}
			});
		} else {
			profiles.show( 'fast' );
		}

	})

	// Show a full profile.
	$( '.wsuwp-people-wrapper' ).on( 'click', '.profile-link', function(e) {

		e.preventDefault();

		$( '<div class="cahnrs-profile-background close-profile"></div>' ).appendTo( '.wsuwp-people-wrapper' ).fadeIn(500);

		$.ajax({
			url: personnel.ajaxurl,
			type: 'post',
			data: {
				action: 'profile_request',
				profile: $(this).data( 'id' )
			},
			success: function( html ) {
				document.title = name + ' | ' + default_title;
				$( '.cahnrs-profile-background' ).html( html );
			}
		})

	})

	// Close a profile.
	$( '.wsuwp-people-wrapper' ).on( 'click', '.close-profile', function(e) {

		e.preventDefault();

		if ( e.target == this ) {
			$( '.cahnrs-profile-background' ).remove();
			document.title = default_title;
		}

	})

	// Load images asynchronously.
	$( '.wsuwp-person-container img' ).filter( '[data-photo]' ).each( function() {

		$(this).attr( 'src', $(this).data( 'photo' ) );
		
		/*var image = $(this),
				new_src = image.data( 'photo' );
		if ( new_src.length > 0 ) {
			var img = new Image();
			img.src = new_src;
			$(img).load(function() {
				image.attr( 'src', new_src );
			});
		}*/
		
	})

});