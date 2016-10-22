<?php

abstract class CAHNRSWP_People_Displays {
	
	public $display_type;
	
 	public $search_people;
	
 	public $filter_people;
	
	public $request_profile_update;
	
	public $profile_Ct;

	public $profile_ID;
	
	public $profile_title;
	
	public $profile_last_name;
	
	public $profile_first_name;
	
	public $profile_office;
	
	public $profile_office_alt;
	
	public $profile_phone;
	
	public $profile_phone_alt;
	
	public $profile_email;
	
	public $profile_email_alt;
	
	public $profile_website;

	public $profile_position_title;
	
	public $profile_working_title;
	
	public $profile_degree;
	
	public $profile_college_bio;
	
	public $profile_dept_bio;
	
	public $profile_photo;	
	
	public $profile_slug;
	
	public $profile_content;
	
	public $profile_count;
	
	
	
	
	


	public function init() {
		
	//	add_action('wp_enqueue_scripts', array($this, 'register_styles'));					
	//    add_action('admin_enqueue_scripts',array($this, 'register_styles_admin'));
	
	//	add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 21 );
		
	//	add_action( 'wp_ajax_single_profile_display', array( $this, 'single_profile_display' ) );
	//	add_action( 'wp_ajax_nopriv_single_profile_display', array( $this, 'single_profile_display' ) );
						
		
		} //end init

/*		
	public function enqueue_scripts() {
			
		 wp_enqueue_script( 'people-displays-scripts', plugins_url( '/js/displays.js', dirname(__FILE__) ), array( 'jquery' ) );
		 wp_localize_script( 'people-displays-scripts', 'profiles', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		}	
*/		
		
		
		public function register_styles_admin() {
				
//			 wp_register_style( 'people-displays-style',  plugins_url( 'css/people-display-style.css', __FILE__ ) );
			 
		 wp_register_style( 'people-displays-style',  plugins_url( '/css/people-display-style.css', dirname(__FILE__) ) );
		 
	     wp_enqueue_style('people-displays-style');
			 
		 
		
		} //end register_styles
		
		public function register_styles() {
	 	
			 wp_register_style( 'people-displays-style',  plugins_url( '/css/people-display-style.css', dirname(__FILE__) ) );
	//		 wp_register_style( 'people-displays-style',  plugins_url( '/CAHNRSWP-Plugin-People-display/css/people-display-style.css') );
	         wp_enqueue_style('people-displays-style');
			
			
	wp_register_style( 'people-displays-adative-style',  plugins_url( '/css/people-adaptive-display-style.css', dirname(__FILE__) ) );
		 
	     wp_enqueue_style('people-displays-adative-style');	 
		
		
		} //end register_styles	
	
/*	
		public function single_profile_display(){
		
		
			$url;
		
			$json;
		
			$data;
			   
			if ( $_POST['oneprofile'] ) {
				
			//	$which_profile = $_POST['oneprofile']; 	
				
		//		var_dump($which_profile);	
			
		//		$url = "https://people.wsu.edu/wp-json/wp/v2/people/3990";
				
				$url = "https://people.wsu.edu/wp-json/wp/v2/people/" . $_POST['oneprofile'];
				
				var_dump($url);		
					
				$json = file_get_contents($url);
			
				$one_profile = json_decode($json);
					
			//	ob_start();
				
					include plugin_dir_path( dirname( __FILE__) ) . 'inc/inc-single-profile.php';
				
			//	$html = ob_get_clean();
					
			} //end _POST['profile']
				
			die();
				
			//	return $html;
	
	 
	} //end single_page_display
	
*/	


	
} //end CAHNRSWP_People_Displays