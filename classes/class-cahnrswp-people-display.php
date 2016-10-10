<?php

abstract class CAHNRSWP_People_Displays {
	
	public $display_type;
	
 	public $search_people;
	
 	public $filter_people;
	
	public $request_profile_update;
	
	public $profile_last_name;
	
	public $profile_first_name;
	
	public $profile_office;
	
	public $profile_office_alt;
	
	public $profile_phone;
	
	public $profile_email;
	
	public $profile_website;

	public $profile_position_title;
	
	public $profile_working_title;
	
	public $profile_degree;
	
	public $profile_college_bio;
	
	public $profile_dept_bio;
	
	public $profile_photo;	
	
	public $profile_slug;
	
	public $profile_content;
	
	
	
	
	


	public function init() {
		
	    add_action('admin_enqueue_scripts',array($this, 'register_styles_admin'));
		add_action('wp_enqueue_scripts', array($this, 'register_styles'));				

					
		
		} //end init
		
		public function register_styles_admin() {
		 	
			 wp_register_style( 'people-displays-style',  plugins_url( 'CAHNRSWP-Plugin-People-display/css/people-display-style.css') );
	         wp_enqueue_style('people-displays-style');
			 
		
		} //end register_styles
		
	public function register_styles() {
		 
	 	
			 wp_register_style( 'people-displays-style',  plugins_url( 'CAHNRSWP-Plugin-People-display/css/people-display-style.css') );
	         wp_enqueue_style('people-displays-style');
		
		} //end register_styles	
	

	


	


	
} //end CAHNRSWP_People_Displays