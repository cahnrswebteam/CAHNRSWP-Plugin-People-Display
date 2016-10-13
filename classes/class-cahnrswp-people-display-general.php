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
		   
		if ( $_POST['oneprofile'] ) {
				
			$url = "https://people.wsu.edu/wp-json/wp/v2/people/" . $_POST['oneprofile'];
			
			//var_dump($url);		
				
			$json = file_get_contents($url);
		
			$one_profile = json_decode($json);
			
			//var_dump($one_profile);
			
			//$results .= '<div class="cahnrswp-people-single-profile">';
				
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
	
	