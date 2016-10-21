<?php

class CAHNRSWP_People_Displays_General extends CAHNRSWP_People_Displays { 
	
	public $display_type = 'list';
	
	public function init() {

		add_action('wp_enqueue_scripts', array($this, 'register_styles'));					
	    add_action('admin_enqueue_scripts',array($this, 'register_styles_admin'));
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 21 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 21 );
		
		add_action( 'wp_ajax_single_profile_display', array( 'CAHNRSWP_People_Displays_General', 'single_profile_display' ) );
		add_action( 'wp_ajax_nopriv_single_profile_display', array( 'CAHNRSWP_People_Displays_General', 'single_profile_display' ) );
		
								
		} //end init

	public function enqueue_scripts() {
			
		 wp_enqueue_script( 'people-displays-scripts', plugins_url( '/js/displays.js', dirname(__FILE__) ), array( 'jquery' ) );
		 wp_localize_script( 'people-displays-scripts', 'profiles', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		 
		}	
		
	
	
	public function single_profile_display(){
	
		$url;
	
		$json;
	
		$data;
		
		$results = '';
				
		$test =  $_POST['oneprofile'];
		  
		// var_dump($test);
			 
		$title = '';
		$email = '';
		$phone = '';
		$office = '';
		   
		if ( $_POST['oneprofile'] ) {
				
			$url = "https://people.wsu.edu/wp-json/wp/v2/people/" . $_POST['oneprofile'];
			
			//var_dump($url);		
				
			$json = file_get_contents($url);
		
			$one_profile = json_decode($json);
			
	//		$tags_url ="https://people.wsu.edu/wp-json/wp/v2/tags?post=" . $_POST['oneprofile'];
			
	//		$json_tags =  file_get_contents($tags_url);
			
	//		$one_profile_tags = json_decode($json_tags);
			
		//	var_dump($one_profile_tags);
			
	//		$one_profile_tags_names = array();
			
	//		foreach ( $one_profile_tags as $one_profile_tag) {
			
	//			array_push($one_profile_tags_names, $one_profile_tag->name);
					
	//		}
	//		$names_string = implode(',', $one_profile_tags_names);
		//	var_dump( $one_profile_tags_names);
		//	var_dump($names_string);		
			
			
			//$results .= '<div class="cahnrswp-people-single-profile">';
			
			if ( isset($one_profile->working_titles[0]) ) {
				 $title = $one_profile->working_titles[0]; 
				} else {
				  $title = $one_profile->position_title;		
				}
			if ( ! empty($one_profile->email_alt) ) {
				 $email = $one_profile->email_alt; 
				} else {
				  $email = $one_profile->email;		
				}
			if ( ! empty($one_profile->phone_alt) ) {
				 $phone = $one_profile->phone_alt; 
				} else {
				  $phone = $one_profile->phone;		
				}
			if ( ! empty($one_profile->office_alt) ) {
				 $office = $one_profile->office_alt; 
				} else {
				  $office = $one_profile->office;		
				}	
				
			ob_start();
			
			include plugin_dir_path( dirname( __FILE__) ) . 'inc/inc-single-profile.php';
			
			$results .=	ob_get_clean();

		//	$results .= '</div>';	
			
				
		} //end _POST['profile']
		
		 echo $results;
		
			wp_die();
			
		//	return $html;

 
} //end single_page_display
		
	
} //end CAHNRSWP_People_Views_General
	
	