// JavaScript Document
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
				  data: $(this).data('id'),				
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
