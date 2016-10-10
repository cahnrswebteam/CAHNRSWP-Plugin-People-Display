<?php

class CAHNRSWP_People_Displays_Shortcode {
	
	protected $shortcode_name;	
	
	protected $default_atts = array();

 
 
 public function init() {
	 	 
	 add_action('init', array($this, 'register_shortcode'));
	 
	 
	 }
	 
 public function register_shortcode() {
	 
	 add_shortcode( $this->shortcode_name , array($this, 'run_shortcode')); 
	 
	 } 
	
 public function run_shortcode ( $atts , $content = null)  {
	 
	 $atts = shortcode_atts(
				$this->default_atts, 
				$atts, 
				$shortcode_name
				);


	 return $this->display_content( $atts, $content); // create display_content function
	 
	 } //end run_shortcode 	
	 

} //end CAHNRSWP_People_Displays_Shortcode	 