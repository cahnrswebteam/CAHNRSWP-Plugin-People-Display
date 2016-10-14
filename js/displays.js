// JavaScript Document
jQuery(document).ready(function($){
	
	var default_title = document.title;
	
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
	
	/******************** pagination ***********************/
//	https://premium.wpmudev.org/blog/load-posts-ajax/?nhp=b&utm_expid=3606929-87.FQUx5sKvRhKbhK_8_C59WQ.1&utm_referrer=https%3A%2F%2Fwww.google.com%2F
	

	function find_page_number( element ) {
		element.find('span').remove();
		return parseInt( element.html() );
	}

	jQuery('.nav-links a' ).on( 'click', function( event ) {
		event.preventDefault();
		
		page = find_page_number( $(this).clone() );
		
		$.ajax({
			url: ajaxpagination.ajaxurl,
			type: 'post',
			data: {
				action: 'ajax_pagination',				
			},
			success: function( html ) {
				$('#main').find( 'article' ).remove();
				$('#main nav').remove();
				$('#main').append( html );
//				alert( result );
			}
		})
	})
	
/***** http://stackoverflow.com/questions/13852782/how-can-i-do-pagination-without-reaload-page-in-wordpress ****/
/*
	$('.page').click(function(e) {
		e.preventDefault();
		$.ajax({url: $(this).prop('href'), success: function(d) {
			var page = $(d).find('.pagination').html();
			$('.pagination').html(page);
		}});
	});
*/
	
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