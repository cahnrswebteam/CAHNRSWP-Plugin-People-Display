// JavaScript Document
jQuery(document).ready(function($){
	
	var default_title = document.title;

		
	/*** pagination by Danial method *****/
	
	jQuery('nav a').click( function(){
		
		var directory = jQuery( this ).closest( '.cahnrswp-people-display-wrapper');

	//	directory.css({"background-color":"yellow"});
			
		var active_index = directory.find('nav a.active' ).index();
		
	//	var last_index_length = directory.find('.pagination > nav a').length;
		
		var last_index = directory.find('.pagination > nav a').length - 2;

		var prv1 = directory.find('nav a.active').prev();
		var nxt1 = directory.find('nav a.active').next();
		
		var nxt_index = nxt1.index();
		var prv_index = prv1.index();

				
		if ( ( jQuery( this ).hasClass('next') ) ) {
			//	var nxt = directory.find('nav a.active').next();
				
				if ( nxt_index <= last_index) {
					directory.find('nav a').removeClass('active');
					change_set_by_a( nxt1 );		
				}

			} else if ( jQuery( this ).hasClass('previous') )  {
			//	var prv = directory.find('nav a.active').prev();
				
				if ( prv_index > 0 ) {		
					directory.find('nav a').removeClass('active');	
					change_set_by_a( prv1 );
				}
		
			}	else {
			directory.find('nav a').removeClass('active');	
    		change_set_by_a( jQuery( this ) );
			}
	});
	

	

	var change_set_by_a = function( ic ){
		
		ic.addClass('active');
//		ic.closest('.column-list-profiles').closest('.column-list-profile').css({"background-color":"green"});
		
		var closedir = ic.closest('.column-list-profiles'); 
	
			
		
		if (  closedir.find('.column-list-profile').length ) { 
				var items = closedir.find('.column-list-profile');
		//		alert('inside c l profile class');
			
		} else if ( jQuery('.profile-gallery article').length ) {
				var items = jQuery('.profile-gallery article');
		} 
		 
		 if ( jQuery('.profile-table-row-data').length) {
				var items = jQuery('.profile-table-row-data');	
			}
		
								
		var inc = ic.closest('nav').data('inc');	
		var index = ic.index();
		index = index - 1;
		var start = index * inc;
		var end = (start + inc)-1;
				
		var i = 0;
		
		
		items.each( function() {
			if (( i >= start ) && ( i <= end ) ) {
				
				jQuery( this ).removeClass('hidden');
								
				
				} else {
				
				jQuery( this ).addClass('hidden');
				} // end if 
	
				i++;
			}) 
			
			if ( jQuery('.column-list-profile').length ) { 
				$( 'html,body').animate({scrollTop: 0}, 'fast');	
			} //Scroll to top for column-list
			

	
	
	} //end change_set_by_a 
	
	
// Show a full profile. - Phil's code

//	jQuery( '.wsuprofileTable' ).on( 'click', '.profile-link', function(e) {
//	jQuery( '.profile-link' ).click(function(e) {
	jQuery( '.profile-table, .column-list-profiles, .profile-gallery' ).on("click", '.profile-link',  function( e ) {
		e.preventDefault();
		
//		var display_type = jQuery( this ).parents();
		
	//	var name = $(this).data( 'name' );
	//	var id = $(this).data( 'id' );
	//	alert(id);

		
	//	jQuery('<div class="cahnrswp-people-single-profile"></div>').appendTo( jQuery(this).parents('.wsuprofileTable')).fadeIn(500);
	//cahnrswp-people-single-profile-background 
	//$( '<div class="cahnrs-profile-background close-profile"></div>' ).appendTo( $(this).parents('.wsuwp-people-wrapper') ).fadeIn(500);	-- Phil's 
	//cahnrswp-people-display-wrapper
	jQuery( '<div class="cahnrswp-people-single-profile-background close-profile"></div>' ).appendTo( $(this).parents('.cahnrswp-people-display-wrapper') ).fadeIn(500);
//	jQuery('<div class="cahnrswp-people-single-profile"></div>').appendTo( jQuery(this).parents( objclass )).fadeIn(500);
		jQuery('<div class="cahnrswp-people-single-profile"></div>').appendTo( jQuery('.cahnrswp-people-single-profile-background')).fadeIn(500);
		
		
				
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
				$( 'html,body').animate({scrollTop: 0}, 'fast');
					
				}
		})

	}) // click profile-link
	
	jQuery( 'div' ).on( 'click' , '.close', function(e) {
				if (e.target == this) {
					e.preventDefault();
					jQuery( '.cahnrswp-people-single-profile-background' ).remove();
					jQuery( '.cahnrswp-people-single-profile' ).remove();
					
					document.title = default_title; 
					}
		});
	
	
	
	/****sort by column tabular list view - display=list ************/
//	var headerdiv = $("div.wsuprofileTableRowHeader");
	var headerdiv = $("div.profile-table-row-header");
	//alert(headerdiv.wsuprofileTableHead);
	
//	var $divs = $("div.wsuprofileTableRowData");
	var $divs = $("div.profile-table-row-data");

	jQuery('.profile-table-head').on("click", function(){
//		var idString = $( this ).attr( "id");
		var idString = $(this).attr("class").split(' ')[1];
	//	alert ( idString );
	//	jqidString = "#" + idString;
		jqidString = "." + idString;
	
		
//	jQuery('#tbname').on('click', function() {
	jQuery( jqidString,  function() {	
		var frst = $( jqidString ).find('.arrows').hasClass('both') ? 'asc' : 'desc';
			$( jqidString ).find('.arrows').addClass(frst);	
		var o = $( jqidString ).find('.arrows').hasClass('asc') ? 'desc' : 'asc';
			//	$( '.arrows').removeClass('both');	
			$( jqidString ).siblings().find('.arrows').not('.photo').removeClass('asc').removeClass('desc').addClass('both');
			$( jqidString ).find('.arrows').removeClass( 'asc' ).removeClass( 'desc').removeClass('both');			
			$( jqidString ).find('.arrows' ).addClass(o);
			
		var alphabeticalOrderDivs = $divs.sort(function (a, b) {
			
//		var findiclasscode = ".wsuprofileTableCell.name a";

		var findiclasscode = ".profile-table-cell." + idString;
		
	
		
		if ( idString == 'name') { findiclasscode + " a"} ;

			
			if ( o == 'asc' ) {
					
				return $(a).find( findiclasscode ).text().toLowerCase().localeCompare($(b).find( findiclasscode ).text().toLowerCase());
			} else {
				
				return $(b).find( findiclasscode ).text().toLowerCase().localeCompare($(a).find( findiclasscode ).text().toLowerCase());
			}
		
			});
			$(".profile-table-row-data").remove();
			$(".profile-table").append( alphabeticalOrderDivs );
			//$(".wsuprofileTable").html(alphabeticalOrderDivs);
			//$(".wsuprofileTable").prepend('<div class="wsuprofileTableRowHeader"><div class="wsuprofileTableHead"></div><div class="wsuprofileTableHead desc" id="tbname">Name</div><div class="wsuprofileTableHead" id="tbtitle">Title</div><div class="wsuprofileTableHead" id="tbdeparment">Department</div><div class="wsuprofileTableHead" id="tbwork-group">Work Group</div></div>');

		});
		
	}); //	idString
			
		
		
	/* text search on page */
	/* Resource: https://weblog.west-wind.com/posts/2014/May/12/Filtering-List-Data-with-a-jQuerysearchFilter-Plugin#WrappingitupinajQueryPlug-in */	
	
	jQuery.expr[":"].containsNoCase = function(el, i, m) {
		var search = m[3];
		if (!search) return false;
		return new RegExp(search, "i").test($(el).text());
	};
		
		
	  jQuery("#txtSearchPage").keyup(function() {
		  	var searchclass = '';
			
			if ( jQuery('.column-list-profile').length ) { 
				searchclass = ".column-list-profile";
				}
			
			if ( jQuery('article').length ) {
					searchclass = "article";
				} 
		 
			 if ( jQuery('.profile-table-row-data').length) {
					searchclass = ".profile-table-row-data";	
				}
			
//			searchclass = ".wsuprofileTableRowData";
			
			
	        var search = $(this).val();
//    	    $(".wsuprofileTableRowData").show();
    	    $( searchclass ).addClass('hidden');
			$( searchclass ).removeClass('hidden');

//        if (search) $(".wsuprofileTableRowData").not(":containsNoCase(" + search + ")").hide();
		  if (search) $( searchclass ).not(":containsNoCase(" + search + ")").addClass('hidden');
//		  $(change_set_by_a( jQuery('nav a.active') ));
		  if ((search).length == 0) $(change_set_by_a( jQuery('nav a.active') ));
       });	
	
});