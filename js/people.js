jQuery(document).ready(function($){

	var default_title = document.title;

	// Sort according to selected filter options.
	$( '.filter .items li label' ).on( 'change', 'input:checkbox', function() {

		var sort_class = new Array(),
				profiles = $( '.wsuwp-people-wrapper' ).find( '.wsuwp-person-container' );

		$( '.filter .items input:checkbox:checked' ).each( function() {
			sort_class.push( '.' + $(this).data('filter') + '-' + $(this).attr('value') );
		});

		if ( '' != sort_class ) {
			profiles.not( sort_class.join( ',' ) ).hide('fast');
			profiles.filter( sort_class.join( ',' ) ).show('fast');
		} else {
			profiles.show('fast');
		}

	})

	// Search.
	$( '.people-actions' ).on( 'keyup', '#people-search', function() {

		var	searchval = $( '#people-search' ).val(),
				profiles = $( '.wsuwp-people-wrapper' ).find( '.wsuwp-person-container' );

		if ( searchval.length > 0 ) {
			profiles.each( function() {
				var c = $(this);
				if ( c.text().toLowerCase().indexOf( searchval.toLowerCase() ) > 0 ) {
					c.show('fast');
				} else {
					c.hide('fast');
				}
			});
		} else {
			profiles.show('fast');
		}

	})

	// Show or hide a profile.
	$( '.wsuwp-people-wrapper' ).on( 'click', '.profile-link', function(e) {

		e.preventDefault();

		var p_link  = $(this),
				name    = p_link.text(),
				profile = p_link.parents( '.wsuwp-person-container' ),
				others  = profile.siblings( '.wsuwp-person-container' ),
				actions = $( '.people-actions' );

		if ( p_link.hasClass( 'close' ) ) {
			$( '.cahnrs-profile-background' ).remove();
			document.title = default_title;
		} else {
			$.ajax({
				url: personnel.ajaxurl,
				type: 'post',
				data: {
					action: 'profile_request',
					profile: $(this).data( 'id' )
				},
				success: function( html ) {
					document.title = name + ' | ' + default_title;
					//profile.append( html );
					$( html ).appendTo( '.wsuwp-people-wrapper' ).fadeIn(500);
				}
			})
		}

	})

	$( '.wsuwp-person-container img' ).filter( '[data-photo]' ).each( function() {
		$(this).attr( 'src', $(this).data( 'photo' ) );
		/*if(lsrc.length > 0){
			 var img = new Image();
			 img.src = lsrc;
			 $(img).load(function() {
					 this_image.src = this.src;
			 });
	 }*/
	})

});