// JavaScript Document
jQuery(document).ready(function($){
	
	var default_title = document.title;
	
// Show a full profile. - Phil's code
//	jQuery( '.wsuwp-people-wrapper' ).on( 'click', '.profile-link', function(e) {
	jQuery( '.wsuprofileTable' ).on( 'click', '.profile-link', function(e) {
		e.preventDefault();
		
		
		
		var name = $(this).data( 'name' );
	//	alert(name);
	//	var id = $(this).data( 'id' );
	//	alert(id);
		
	//	jQuery( '<div class="cahnrs-profile-background close-profile"></div>' ).appendTo( jQuery(this).parents('.wsuwp-people-wrapper') ).fadeIn(500);
		jQuery('<div class="cahnrswp-people-single-profile"></div>').appendTo( jQuery(this).parents('.wsuprofileTable')).fadeIn(500);
				
		jQuery.ajax( {
				url: profiles.ajaxurl,
				type: 'post',
				data: {
						action: 'single_profile_display',
						oneprofile: $(this).data( 'id' )
				},
				success: function( html ) {
				 document.title = name + ' | ' + default_title;
				$( '.cahnrswp-people-single-profile' ).html ( html );	
					
				}
		})

	}) // click
	
	jQuery( 'div' ).on( 'click' , '.close', function(e) {
				if (e.target == this) {
					e.preventDefault();
					jQuery( '.cahnrswp-people-single-profile' ).remove();
					document.title = default_title; 
					}
		});
		
	/* text search on page */
	/* Resource: https://weblog.west-wind.com/posts/2014/May/12/Filtering-List-Data-with-a-jQuerysearchFilter-Plugin#WrappingitupinajQueryPlug-in */	
	
	jQuery.expr[":"].containsNoCase = function(el, i, m) {
		var search = m[3];
		if (!search) return false;
		return new RegExp(search, "i").test($(el).text());
	};
	
		
	  jQuery("#txtSearchPage").keyup(function() {
	        var search = $(this).val();
    	    $(".wsuprofileTableRowData").show();
        if (search) $(".wsuprofileTableRowData").not(":containsNoCase(" + search + ")").hide();
       });	
	
});