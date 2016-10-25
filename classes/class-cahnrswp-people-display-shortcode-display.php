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
		'fields' => 'photo,name,title,department,workgroup',
		'exclude' => '',
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
		
			
		$profile_list_elements = array();	
		$profile_list_elements = explode("," , $fields);
		
		$excluded = explode(",", $exclude);
		
		$number_of_profiles = count($display_profiles);

		//var_dump($display_profiles);
		
		//var_dump($show_search);
		
	    $results = '';
	    $results .= '<div class="cahnrswp-people-display-wrapper">';
		$results .= '<div class="gallery">';
		$results .= '<div class="gallery-people-header">';
		
        $results .= $this->directory_heading( $directory_title );

		if ( $show_search == 'yes' ) {
	 		$results .= $this->search_form();
		}
			
			$results .= '</div>';		
			
		 $title = '';
		 $email = '';
		 $office = '';
		 $phone ='';
		
		  			  
		 $i = 0;
		 	     
		  foreach ($display_profiles as $profile ) {		
		  
		  	  if ( isset ($profile->profile_working_title[0]) ) {
					$title = $profile->profile_working_title[0];									  
				} else {
					$title = $profile->profile_position_title;
				}
			
			if ( !empty($profile->profile_email_alt) ) {
					$email = $profile->profile_email_alt;									  
				} else {
					$email = $profile->profile_email;
				}
				
			if ( !empty($profile->profile_office_alt) ) {
					$office = $profile->profile_office_alt;									  
				} else {
					$office = $profile->profile_office;
				}
				
			if ( !empty($profile->profile_phone_alt) ) {
					$phone = $profile->profile_phone_alt;									  
				} else {
					$phone = $profile->profile_phone;
				}					
	
			if (in_array("email", $excluded)) {
				 $email = '';
				}
				
			if (in_array("phone", $excluded)) {
				 $phone = '';
				}	
			if (in_array("profile", $excluded)) {
			//	 $profile-link = '';
				}		
				
			if (in_array("name", $excluded)) {
				
				}			
				
				$class = ( $i < $count ) ? '' : 'hidden';
						
				ob_start();
								
				 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-gallery-display.php';

				
				$results .= ob_get_clean();
				
				$i++;
				
		  } // end foreach
		  
		   if ($count > $number_of_profiles ) {

					 $results .= '';
				 } else {
					 
					 $results .= $this->pagination( $count,  $number_of_profiles );		  
				 }
			 
//			 $results .= $this->pagination( $count,  $number_of_profiles );		  
			 $results .= '</div>';	
 			 $results .= '</div>';	//close wrappter 			
		  return $results;
		 
		 
		 } //end get_column_gallery_html
	
	
	
	 protected function get_column_list_html( $display_profiles , $atts , $content ){
		 
		extract($atts);
		
		$number_of_profiles = count($display_profiles);
		
		$profile_list_elements = array();	
		$profile_list_elements = explode("," , $fields);
		
		$excluded = explode(",", $exclude);

		//var_dump($display_profiles);
		
		//var_dump($show_search);
		
	    $results = '';
	    $results .= '<div class="cahnrswp-people-display-wrapper">';
		$results .= '<div class="column-list-profiles">';

		 		
		$results .= '<div class="column-list-people-header">';
        $results .= $this->directory_heading( $directory_title );

		if ( $show_search == 'yes' ) {
	 		$results .= $this->search_form();
		}
			
			$results .= '</div>';		

		 $title = '';
		 $email = '';
		 $office = '';
		 $phone ='';
		  			  
		 $i = 0;
		 	     
		  foreach ($display_profiles as $profile ) {		
		  
		  
		  	  if ( isset ($profile->profile_working_title[0]) ) {
					$title = $profile->profile_working_title[0];									  
				} else {
					$title = $profile->profile_position_title;
				}
			
			if ( !empty($profile->profile_email_alt) ) {
					$email = $profile->profile_email_alt;									  
				} else {
					$email = $profile->profile_email;
				}
				
			if ( !empty($profile->profile_office_alt) ) {
					$office = $profile->profile_office_alt;									  
				} else {
					$office = $profile->profile_office;
				}
				
			if ( !empty($profile->profile_phone_alt) ) {
					$phone = $profile->profile_phone_alt;									  
				} else {
					$phone = $profile->profile_phone;
				}					
	
			if (in_array("email", $excluded)) {
				 $email = '';
				}
				
			if (in_array("phone", $excluded)) {
				 $phone = '';
				}	
			if (in_array("profile", $excluded)) {
			//	 $profile-link = '';
				}		
				
			if (in_array("name", $excluded)) {
				
				}			
				
			//	$class = ( $i < $count ) ? 'display' : '';
			
				$class = ( $i < $count ) ? '' : 'hidden';
						
				ob_start();
								
				 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-column-list-display.php';

				
				$results .= ob_get_clean();
				
				$i++;
				
		  } // end foreach
			 
			  if ($count > $number_of_profiles ) {

					 $results .= '';
				 } else {
					 
					 $results .= $this->pagination( $count,  $number_of_profiles );		  
				 }
			 
//			 $results .= $this->pagination( $count,  $number_of_profiles );		  
			 $results .= '</div>';
			 $results .= '</div>';	//close wrappter 		
		  return $results;
		 
		 
		 } //end get_column_list_html
		 	



	 protected function get_list_html( $display_profiles , $atts , $content )
		 {
		
		extract($atts);
	
		$number_of_profiles = count($display_profiles);
		
		$profile_list_elements = array();	
		$profile_list_elements = explode("," , $fields);
		
		$excluded = explode(",", $exclude);
		
		
 //   	$profile_list_elements = array( 'photo', 'name', 'title', 'department', 'workgroup' ); 
//		$profile_list_elements = array( 'name', 'title', 'photo', 'department', 'workgroup' ); 
		
		 
	   $results = '';
	   $results .= '<div class="cahnrswp-people-display-wrapper">';
	   $results .= '<div class="people-header">';
	   $results .= $this->directory_heading( $directory_title );
	   if ( $show_search == 'yes' ) {
	 		$results .= $this->search_form();
		}
	
		$results .= '</div>';
	 
		$results .= $this->list_heading( $profile_list_elements );
		
		 $i = 0;
		 
		
		$profile_elements_count = count($profile_list_elements);

		$cell_widths_4 = array( 13,25,19,19,24 );
		$cell_widths_3 = array( 20,30,20,30 ); 
		$cell_widths_2 = array( 25,43,32 ); 
		$cell_widths_1 = array( 40,60 ); 
		$cell_widths_0 = array( 100 ); 
		
		$cell_widths_array =  array( $cell_widths_0 , $cell_widths_1, $cell_widths_2, $cell_widths_3, $cell_widths_4 );
		
	//	$equal_cell_widths = ( 100 /( count( $profile_list_elements ) ) );
		
		
		$which_cell_widths_array = array();
		
		$which_cell_widths_array = $cell_widths_array [( $profile_elements_count - 1 ) ];
		 
		 $title = '';
		 $email = '';
		 $office = '';
		 $phone ='';
		 	     
		  foreach ($display_profiles as $profile ) {
			  
			  if ( isset ($profile->profile_working_title[0]) ) {
					$title = $profile->profile_working_title[0];									  
				} else {
					$title = $profile->profile_position_title;
				}
			
			if ( !empty($profile->profile_email_alt) ) {
					$email = $profile->profile_email_alt;									  
				} else {
					$email = $profile->profile_email;
				}
				
			if ( !empty($profile->profile_office_alt) ) {
					$office = $profile->profile_office_alt;									  
				} else {
					$office = $profile->profile_office;
				}
				
			if ( !empty($profile->profile_phone_alt) ) {
					$phone = $profile->profile_phone_alt;									  
				} else {
					$phone = $profile->profile_phone;
				}					
	
			if (in_array("email", $excluded)) {
				 $email = '';
				}
				
			if (in_array("phone", $excluded)) {
				 $phone = '';
				}	
			if (in_array("profile", $excluded)) {
			//	 $profile-link = '';
				}		
				
			if (in_array("name", $excluded)) {
				
				}
			
					
			//	var_dump($title);										  
														  
				
		//		$class = ( $i < $count ) ? 'row-display' : '';
		
			$class = ( $i < $count ) ? '' : 'hidden';
						
			ob_start();
							
		//	 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-list-display.php';
		
			// adaptive columns		
				
			$cell_width_index = 0;
			
			$percent_width = '';
			
			$row_html = '';
			
			
			include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-adeptive-list-display-row-header.php';
			 
			foreach ( $profile_list_elements as $cell_class ) {
			
				$percent_width = $which_cell_widths_array[ $cell_width_index ] . '%';	
				
				$cell_html = $this->get_cell_content( $profile, $title, $email, $office, $phone, $cell_class );
				
				 
				 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-adeptive-list-display.php';
		
				 $cell_width_index++;
				
				} //end foreach

			include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-adeptive-list-display-row-footer.php';		
	
			// adaptive columns
	 
	//			 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-adeptive-list-display.php';
				
				$results .= ob_get_clean();
				
				$i++;
				
		  } // end foreach

			 $results .= '</div>';	//close wsuprofileTable
			 
			 if ($count > $number_of_profiles ) {

					 $results .= '';
				 } else {
					 
					 $results .= $this->pagination( $count,  $number_of_profiles );		  
				 }
			 $results .= '</div>';	//close wrappter 
		  return $results;
		 
				 
	 } // end get_list_html 
	 
	 public function get_cell_content ($profile, $title, $email, $office, $phone, $field ) {
		 
		$field_html = ''; 
		ob_start(); 
		 
 		switch( $field ){
		   
		   case 'photo':
			
				  include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-adeptive-list-display-cell-photo.php';
			
				break;
				
			case 'name':
				
				 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-adeptive-list-display-cell-name.php';
				
				break;

	   		case 'title':
				
				 include plugin_dir_path( dirname( __FILE__ ) ) . 'inc/inc-adeptive-list-display-cell-title.php';
				
				break;
				
		   case 'department':
	
				$field_html = 'Department';
				
				break;
		
			case 'workgroup':
	
				$field_html = 'Workgroup';
				
				break;
		} //end switch
		
			
			
			return $field_html.= ob_get_clean();
			
	} //get_cell_content
	 
	 public function list_heading ( $profile_list_elements ){


		$html = '';
		$html .= '<div class="profile-table">';
		$html .= '<div class="profile-table-row-header" data-id="">';
		
//		$profile_list_elements = array();	
//    	$profile_list_elements = array( 'photo', 'name', 'title', 'department', 'workgroup' ); 
		
//		$profile_list_elements = array( 'name', 'title', 'department', 'workgroup', 'photo' ); 
//		$profile_list_elements = array( 'name', 'title', 'department', 'workgroup' ); 
		$profile_elements_count = count($profile_list_elements);

		$cell_widths_4 = array( 13,25,19,19,24 );
		$cell_widths_3 = array( 20,30,20,30 ); 
		$cell_widths_2 = array( 25,43,32 ); 
		$cell_widths_1 = array( 40,60 ); 
		$cell_widths_0 = array( 100 ); 
		
		$cell_widths_array =  array( $cell_widths_0 , $cell_widths_1, $cell_widths_2, $cell_widths_3, $cell_widths_4 );
		
	//	$equal_cell_widths = ( 100 /( count( $profile_list_elements ) ) );
		
	//	$html = '';
		
		$which_cell_widths_array = array();
		
		$which_cell_widths_array = $cell_widths_array [( $profile_elements_count - 1 ) ];
		
		$cell_width_index = 0;

		
		$percent_width = '';
/*		
		$html .= '<div class="profile-table-head photo"></div>';	
		$html .= '<div class="profile-table-head name">Name<div class="arrows"></div></div>';		
		$html .= '<div class="profile-table-head title">Title<div class="arrows"></div></div>';		
		$html .= '<div class="profile-table-head deparment">Department<div class="arrows"></div></div>';		
		$html .= '<div class="profile-table-head work-group">Workgroup<div class="arrows"></div></div>';
*/	
		foreach ( $profile_list_elements as $cell_class ) {
		
			$percent_width = $which_cell_widths_array[ $cell_width_index ] . '%';	
	
//var_dump('class ' . $cell_class . ' percent_width ' .$percent_width . ' cell_width_index ' . $cell_width_index . '<br />');
			$space_cell_class = ' '. $cell_class;
			
			if ($cell_class == 'photo') {

			 $html .= '<div class="profile-table-head' . $space_cell_class . '" width="' . $percent_width .'"></div>';	
				
			} else {
			
			 $html .= '<div class="profile-table-head' . $space_cell_class . '" width="' . $percent_width .'">'.  $cell_class .'<div class="arrows both"></div></div>';
			
			}
	
			 $cell_width_index++;
			
            } // foreach
           
            
		  $html .= '</div>';
		
		return $html;
		 
	 } //list_heading
	 
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
		$html .= $nav_html . '<div class="profiles-count">(' . $number_of_profiles . ' profiles)</div>';
		$html .= '</div>';
		
		return $html;
		
		}

	 
	 
		 


	 
} //end CAHNRSWP_People_Displays_Shortcode_Displays	 