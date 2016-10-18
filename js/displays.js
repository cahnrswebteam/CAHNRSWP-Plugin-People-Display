// JavaScript Document
jQuery(document).ready(function($){
	
	var default_title = document.title;
	

	/*
	jQuery('a.next').on( 'click' , function( event ) {
		var	nc = jQuery('nav a.active' ).index();  
			nc++;
		var curr = jQuery('nav a.active');
			curr.next('nav a').css({"background-color": "red"});
	var nxt = curr.next('nav a');
		change_set_by_a( jQuery( nxt ) );

		});
		
	jQuery('nav a.previous').click( function() {
		
		});	
	*/	
	
	/*** pagination by Danial method *****/
	
	jQuery('nav a').click( function(){
			
		var active_index = jQuery('nav a.active' ).index();
		
		var last_index = jQuery('.pagination > nav a').length - 1;
		
		alert(active_index);
		
		if ( ( jQuery( this ).hasClass('next') ) && ( active_index < last_index )  ) {
				var nxt = jQuery('nav a.active').next();
				jQuery('nav a').removeClass('active');	
				change_set_by_a( nxt );		

			} else if ( jQuery( this ).hasClass('previous') )  {
				var prv = jQuery('nav a.active').prev();
				jQuery('nav a').removeClass('active');	
				change_set_by_a( prv );		

			}	else {
			//	alert('in else');
			jQuery('nav a').removeClass('active');	
    		change_set_by_a( jQuery( this ) );
			}
	});
	

	

	var change_set_by_a = function( ic ){
		
		ic.addClass('active');
		var items = jQuery('.wsuprofileTableRowData');
		var inc = ic.closest('nav').data('inc');
		var index = ic.index();
		
		
		index = index - 1;
	//	alert(index);
		
		var start = index * inc;
		var end = (start + inc)-1;
	//	alert(start);
	//	alert(end);
				
		var i = 0;
		items.each( function() {
			if (( i >= start ) && ( i <= end ) ) {
				
				jQuery( this ).addClass('row-display');
				
				} else {
					
				jQuery( this ).removeClass('row-display');
				} // end if 
	
				i++;
			})	
		
	} //end change_set_by_a 
	
	/* used .slice to display table rows for pagination */
/*	
	var row_Count = jQuery( ".wsuprofileTableRowData").length;
	var per_page = jQuery(".wsuprofileTableRowHeader").data( 'id' );
	var number_of_pages = Math.ceil( row_Count/per_page );
	var start_count = 0;
	
	var end_count = per_page;
	
	var limit = (per_page * number_of_pages);

	jQuery( ".wsuprofileTableRowData").slice( start_count, end_count ).addClass("row-display");
	
	jQuery( "a.paging_button.next").on( 'click' , function() {
		jQuery("a.paging_button").removeClass("disabled");
		
		
		start_count = start_count + per_page;
		end_count = end_count + per_page;
		
		
		if ( end_count > limit ){ 
			start_count = limit - per_page;
			end_count = limit;
	       jQuery("a.paging_button.next").addClass("disabled");			
		  }	


		jQuery( ".wsuprofileTableRowData").removeClass("row-display");
		jQuery( ".wsuprofileTableRowData").slice( start_count, end_count ).addClass("row-display");
		
		
		});
		
	jQuery( "a.paging_button.previous").on( 'click' , function() {
		jQuery("a.paging_button").removeClass("disabled");
		
			
			start_count = start_count - per_page;
			end_count = end_count - per_page;
			
			if (start_count < 0) { 
					start_count = 0;
					end_count = per_page;
					jQuery("a.paging_button.previous").addClass("disabled");
					}
			
			jQuery( ".wsuprofileTableRowData").removeClass("row-display");
			jQuery( ".wsuprofileTableRowData").slice( start_count, end_count ).addClass("row-display");
		
		});
*/	
	
// Show a full profile. - Phil's code

	jQuery( '.wsuprofileTable' ).on( 'click', '.profile-link', function(e) {
		e.preventDefault();
		
	//	var name = $(this).data( 'name' );
	//	var id = $(this).data( 'id' );
	//	alert(id);
		

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
				$( 'html,body').animate({scrollTop: 0}, 'fast');
					
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
	
	
	
	/****sort by column ************/
	var headerdiv = $("div.wsuprofileTableRowHeader");
	//alert(headerdiv.wsuprofileTableHead);
	
	var $divs = $("div.wsuprofileTableRowData");

	jQuery('.wsuprofileTableHead').bind("click", function(){
		var idString = $( this ).attr( "id");
		
		jqidString = "#" + idString;
	// alert( idString );
		
	
		
//	jQuery('#tbname').on('click', function() {
	jQuery( jqidString,  function() {	
		var o = $( jqidString + '.wsuprofileTableHead').hasClass('asc') ? 'desc' : 'asc';
			$( jqidString + '.wsuprofileTableHead').removeClass( 'asc' ).removeClass( 'desc');
			$( jqidString + '.wsuprofileTableHead' ).addClass(o);
			
		var alphabeticalOrderDivs = $divs.sort(function (a, b) {
			
//		var findiclasscode = ".wsuprofileTableCell.name a";

		var findiclasscode = ".wsuprofileTableCell." + idString;
		
		if ( idString == 'name') { findiclasscode + " a"} ;
		
		
			if ( o == 'asc' ) {
					
				return $(a).find( findiclasscode ).text().toLowerCase().localeCompare($(b).find( findiclasscode ).text().toLowerCase());
			} else {
				
				return $(b).find( findiclasscode ).text().toLowerCase().localeCompare($(a).find( findiclasscode ).text().toLowerCase());
			}
		
			});
			$(".wsuprofileTableRowData").remove();
			$(".wsuprofileTable").append( alphabeticalOrderDivs );
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
	        var search = $(this).val();
    	    $(".wsuprofileTableRowData").show();
        if (search) $(".wsuprofileTableRowData").not(":containsNoCase(" + search + ")").hide();
       });	
	
});