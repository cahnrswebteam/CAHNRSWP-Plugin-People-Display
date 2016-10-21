	
	/****sort by column tabular list view - display=list ************/
	var headerdiv = $("div.wsuprofileTableRowHeader");
	//alert(headerdiv.wsuprofileTableHead);
	
	var $divs = $("div.wsuprofileTableRowData");

	jQuery('.wsuprofileTableHead').bind("click", function(){
		var idString = $( this ).attr( "id");
		
		jqidString = "#" + idString;
	// alert( idString );
		
//	jQuery('#tbname').on('click', function() {
	jQuery( jqidString,  function() {	
		var frst = $( jqidString + '.wsuprofileTableHead').hasClass('both') ? 'asc' : 'desc';
			$( jqidString + '.wsuprofileTableHead').addClass(frst);	
		var o = $( jqidString + '.wsuprofileTableHead').hasClass('asc') ? 'desc' : 'asc';
			$( '.wsuprofileTableHead').removeClass('both');	
			$( jqidString ).siblings().not('.photo').addClass('both').removeClass('asc').removeClass('desc');
			$( jqidString + '.wsuprofileTableHead').removeClass( 'asc' ).removeClass( 'desc').removeClass('both');			
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
			