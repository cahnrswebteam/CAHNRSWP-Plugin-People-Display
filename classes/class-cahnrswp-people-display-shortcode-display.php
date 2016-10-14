<?php

class CAHNRSWP_People_Displays_Shorcode_Display extends CAHNRSWP_People_Displays_Shortcode {
	
	protected $shortcode_name = 'people_list';	
	
 	protected $default_atts = array(
		'display' => 'list',
		'classification' => 'faculty',	
	 );	
	 
   public function display_content( $atts, $content ) {
 
	$one_profile = new CAHNRSWP_People_Displays_Profiles();
	$display_profiles = $one_profile->get_profiles( $atts );
	
	$number_of_profiles = count($display_profiles);
	
	$profiles_per_page = 10;
		
	   
	   $html = '';
	   
	  extract($atts);
	   
	   switch( $display ){
		   
		   case 'list':
	
			//	$html = '<div class="wsuprofileTable">';
				$html = $this->get_list_html( $display_profiles , $atts , $content );
			//	$html = '</div>';
				
				break;
				
			case 'gallery':


				break;
				
			case 'small-list':


				break;	
	   } // end switch
	   
	   return $html;
	   
	   
	   }// display_contents
	
	
	
	
		 	



	 protected function get_list_html( $display_profiles , $atts , $content )
		 {
		 
	   $results = '';
		$results .= $this->search_form();
		 		   
		$results .= '<div class="wsuprofileTable">';
	    $results .= '<div class="wsuprofileTableRowHeader">';
	   	$results .= '<div class="wsuprofileTableHead"></div>';	
	   	$results .= '<div class="wsuprofileTableHead asc" id="name">Name</div>';		
	   	$results .= '<div class="wsuprofileTableHead asc" id="title">Title</div>';		
	   	$results .= '<div class="wsuprofileTableHead asc" id="deparment">Department</div>';		
	   	$results .= '<div class="wsuprofileTableHead asc" id="work-group">Work Group</div>';	
		$results .= '</div>';							
		  			  
	     
		  foreach ($display_profiles as $profile ) {					
				
				ob_start();
				
				 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-list-display.php';
				
				$results .= ob_get_clean();
				
		  } // end foreach

			 $results .= '</div>';			  
		  return $results;
		 
				 
	 } // end get_list_html 
		 
	public function search_form (){
		
		$html = '';
		
		$html .= '<div class="search-toolbar">';
		$html .= 'Search: <input id="txtSearchPage" type="search" placeholder="Search" /><br/>';
//        $html .= '<input id="txtSearchPagePlugin" type="search" placeholder="Search list" />';
		$html .= '</div>';
		
		return $html;
		
		} //search_form
	
	public function pagination() {
		
		
		}

	 
	 
		 


	 
} //end CAHNRSWP_People_Displays_Shortcode_Displays	 