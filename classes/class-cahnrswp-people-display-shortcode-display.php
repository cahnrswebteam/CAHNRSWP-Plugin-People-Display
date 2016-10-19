<?php

class CAHNRSWP_People_Displays_Shorcode_Display extends CAHNRSWP_People_Displays_Shortcode {
	
	protected $shortcode_name = 'people_list';	
	
 	protected $default_atts = array(
		'display' => 'list',
		'organization' => 'cahnrs',
		'directory_title'  => 'Directory Title',
		'classification' => '',
		'location' => '',
		'university_category' => '',
		'tag' => '',
		'count' => '10',	
		'show_search' => 'no',
	 );	
	 
   public function display_content( $atts, $content ) {
 
	$one_profile = new CAHNRSWP_People_Displays_Profiles();
	$display_profiles = $one_profile->get_profiles( $atts );
	
	
		
	   
	   $html = '';
	   
	  extract($atts);
	   
	//   var_dump($count);
	   
	   switch( $display ){
		   
		   case 'list':
	
				$html = $this->get_list_html( $display_profiles , $atts , $content );
				
				break;
				
			case 'gallery':
			
				$html = $this->get_gallery_html( $display_profiles , $atts , $content );
				
				break;
				
			case 'column-list':
			
				$html = $this->get_column_list_html( $display_profiles , $atts , $content );


				break;	
	   } // end switch
	   
	   return $html;
	   
	   
	   }// display_contents
	   
	    protected function get_gallery_html( $display_profiles , $atts , $content ){
		 
		extract($atts);
		
		$number_of_profiles = count($display_profiles);

		//var_dump($display_profiles);
		
		//var_dump($show_search);
		
	    $results = '';
		$results .= '<div class="gallery">';
		$results .= '<div class="gallery-people-header">';
		
        $results .= $this->directory_heading( $directory_title );

		if ( $show_search == 'yes' ) {
	 		$results .= $this->search_form();
		}
			
			$results .= '</div>';		

		
		  			  
		 $i = 0;
		 	     
		  foreach ($display_profiles as $profile ) {					
				
				$class = ( $i < $count ) ? '' : 'hidden';
						
				ob_start();
								
				 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-gallery-display.php';

				
				$results .= ob_get_clean();
				
				$i++;
				
		  } // end foreach
			 
			 $results .= $this->pagination( $count,  $number_of_profiles );		  
			 $results .= '</div>';		
		  return $results;
		 
		 
		 } //end get_column_list_html
	
	
	
	 protected function get_column_list_html( $display_profiles , $atts , $content ){
		 
		extract($atts);
		
		$number_of_profiles = count($display_profiles);

		//var_dump($display_profiles);
		
		//var_dump($show_search);
		
	    $results = '';
		$results .= '<div class="column-list-profiles">';
	//	$results .= $this->pagination( $count,  $number_of_profiles );
		 		
		$results .= '<div class="column-list-people-header">';
        $results .= $this->directory_heading( $directory_title );

		if ( $show_search == 'yes' ) {
	 		$results .= $this->search_form();
		}
			
			$results .= '</div>';		

		
		  			  
		 $i = 0;
		 	     
		  foreach ($display_profiles as $profile ) {					
				
			//	$class = ( $i < $count ) ? 'display' : '';
			
				$class = ( $i < $count ) ? '' : 'hidden';
						
				ob_start();
								
				 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-column-list-display.php';

				
				$results .= ob_get_clean();
				
				$i++;
				
		  } // end foreach
			 
			 $results .= $this->pagination( $count,  $number_of_profiles );		  
			 $results .= '</div>';		
		  return $results;
		 
		 
		 } //end get_column_list_html
		 	



	 protected function get_list_html( $display_profiles , $atts , $content )
		 {
		
		extract($atts);
		//var_dump($count);
		
		$number_of_profiles = count($display_profiles);
		
		//var_dump($number_of_profiles);
		 
	   $results = '';
	   $results .= '<div class="people-header">';
	   $results .= $this->directory_heading( $directory_title );
	   if ( $show_search == 'yes' ) {
	 		$results .= $this->search_form();
		}
	
		$results .= '</div>';
		 		   
		$results .= '<div class="wsuprofileTable">';
	    $results .= '<div class="wsuprofileTableRowHeader" data-id="' . $count . '">';
	   	$results .= '<div class="wsuprofileTableHead photo"></div>';	
	   	$results .= '<div class="wsuprofileTableHead both" id="name">Name</div>';		
	   	$results .= '<div class="wsuprofileTableHead both" id="title">Title</div>';		
	   	$results .= '<div class="wsuprofileTableHead both" id="deparment">Department</div>';		
	   	$results .= '<div class="wsuprofileTableHead both" id="work-group">Workgroup</div>';	
		$results .= '</div>';							
		  			  
		 $i = 0;
		 	     
		  foreach ($display_profiles as $profile ) {					
				
		//		$class = ( $i < $count ) ? 'row-display' : '';
		
				$class = ( $i < $count ) ? '' : 'hidden';
		
						
				ob_start();
				
			//		'<div class="wsuprofileTableRowData">';
				
				 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-list-display.php';
				
				$results .= ob_get_clean();
				
				$i++;
				
		  } // end foreach

			 $results .= '</div>';	
			 
			 $results .= $this->pagination( $count,  $number_of_profiles );		  
			 
		  return $results;
		 
				 
	 } // end get_list_html 
	 
	 public function directory_heading ( $directory_title ){
		
		$html = '';
		
		
		$html .= '<h3 class="dir-heading">'; 
		$html .= $directory_title;
		$html .= '</h3>';
		
		return $html;
		
		} //directory_heading
		 
	public function search_form (){
		
		$html = '';
		
		$html .= '<div class="search-toolbar">'; 
		$html .= '<input id="txtSearchPage" type="search" placeholder="Search People" /><input type="button" id="b" value="S" />';
		$html .= '</div>';
		
		return $html;
		
		} //search_form
		
		
	
	public function pagination( $count, $number_of_profiles ) {
		
		$inc = $count;
	//	$number_of_profiles = count($display_profiles);
		
		//$page_nav = $number_of_profiles;
		$nav_html = '';
		
		$nav_html = '<nav data-inc="' . $inc . '">';
		$nav_html .= '<a class="previous disabled">Previous</a>';
		
		$nav_c = $number_of_profiles;
		$nav_i = 1;
		while( $nav_c > 0 ) {
			
			$active = ( $nav_i == 1 ) ? 'class="active"' : '';
			
			$nav_html .= '<a href="#"'. $active . '>' . $nav_i . '</a>';
			$nav_c = $nav_c - $inc;
			$nav_i++; 	
			
			} //end while
			$nav_html .= '<a class="next">Next</a>';
			$nav_html .= '</nav>';

		$html = '';
		
		$html .= '<div class="pagination">';
	//	$html .= '<a class="paging_button previous disabled"> < Previous</a>';
		$html .= $nav_html;
	//	$html .= '<a class="paging_button next">Next</a>';
		$html .= '</div>';
		
		return $html;
		
		}

	 
	 
		 


	 
} //end CAHNRSWP_People_Displays_Shortcode_Displays	 