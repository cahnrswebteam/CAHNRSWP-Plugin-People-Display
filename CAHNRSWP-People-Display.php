<?php
/**
* Plugin Name: CAHNRSWP People Display - V2 
* Plugin URI:  http://cahnrs.wsu.edu/communications/
* Description: CAHNRSWP People Display Displays from content on people.wsu.edu
* Version:     0.1
* Author:      CAHNRS Communications, Don Pierce
* Author URI:  http://cahnrs.wsu.edu/communications/
* License:     Copyright Washington State University
* License URI: http://copyright.wsu.edu
*/

class CAHNRSWP_People_Displays_Library {
	
	protected static $instance;
	
	public static function get_Instance() {
		
		if (self::$instance === null) {
			self::$instance = new self();
			}
		
		return self::$instance;
		}
	
	
	public function __construct() {

		require_once('classes/class-cahnrswp-people-display.php');
		require_once('classes/class-cahnrswp-people-display-general.php');
		$People_Displays = new CAHNRSWP_People_Displays_General;	
		$People_Displays->init();
		
		require_once('classes/class-cahnrswp-people-display-profiles.php');
		$People_Profiles = new CAHNRSWP_People_Displays_Profiles;	
		$People_Profiles->init();
		
		require_once('classes/class-cahnrswp-people-display-shortcode.php');
		require_once('classes/class-cahnrswp-people-display-shortcode-display.php');
		$Shortcode_Display = new CAHNRSWP_People_Displays_Shorcode_Display;	
		$Shortcode_Display->init();
		
		
		
		
			
		} //end __construct
		
		


} //end CAHNRSWP_People_Displays_Library

$cahnrswp_people_Displays_library = CAHNRSWP_People_Displays_Library::get_Instance();