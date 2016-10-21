<?php

class CAHNRSWP_People_Displays_Profiles {
	
	protected $url;
	
	protected $json;
	
	protected $data;
	
	public $profiles_list = array();
	
	
	 public function init() {
	 
//	 	$profiles_list = $this->get_profiles( $atts );	

	 }
	 
	
	
	
	public function get_profiles( $atts ) {
		/* parameters 
			tag - 
			count - 
			classification -
			university_organization_slug -
		*/
	/*	
		  $args = shortcode_atts( array(
		  		'display'  => 'display',
		  		'classification' => 'classification')
				,  $atts ) ;
				
	*/	
	$organization_code = '';
	$classificaton_code = '';
	$location_code = '';
	$tag_code = '';
		
	   extract( $atts );	
	   
	//	var_dump($classification);	
		
	//	$sc_classificaton = "faculty";
	
		if ( $organization ) { $organization_code = '&wsuwp_university_org=' . $organization; }
		
		if ( $classification) {$classificaton_code = 'filter[classification]=' . $classification;}
		
		if ( $location ) {$location_code = '&filter[wsuwp_university_location]=' . $location;}
		
		if ( $tag ) {$tag_code = '&filter[tag]=' . $tag; }
		
		//department-of-human-development		
	
		
//		$url = "https://people.wsu.edu/wp-json/wp/v2/people/?type=wsuwp_people_profile&filter[orderby]=title&filter[order]=ASC&filter[tag]=department-of-human-development&filter[per_page]=60";

//		$url = "https://people.wsu.edu/wp-json/wp/v2/people/?type=wsuwp_people_profile&filter[orderby]=title&filter[order]=ASC&filter[classification]=faculty&filter[wsuwp_university_location]=mount-vernon&per_page=100";
		
//		$url = "https://people.wsu.edu/wp-json/wp/v2/people/?type=wsuwp_people_profile&filter[orderby]=title&filter[order]=ASC&filter[classification]=' . $sc_classificaton . '&filter[wsuwp_university_location]=mount-vernon&per_page=100";
		
		$url = "https://people.wsu.edu/wp-json/wp/v2/people/?type=wsuwp_people_profile" . $organization_code ."&filter[orderby]=title&filter[order]=ASC&" . $classificaton_code . '"' . $location_code . '"'. $tag_code ."&per_page=100";

	//	var_dump ($url);	
		
		$json = file_get_contents($url);
	
//		$data = json_decode($json, TRUE);

		$data = json_decode($json);

	
	//	$sortArray = array();	

	usort( $data, array( $this, 'sort_by_last_name' ) );
			
		
	//	$one_profile = '';
		
		$profiles = array();
			
			foreach ($data as $person) {
				
			$one_profile = new CAHNRSWP_People_Displays_Profiles();

				$one_profile->profile_Ct = $person->type;
				$one_profile->profile_title = $person->title;
				$one_profile->profile_ID = $person->id;
				$one_profile->profile_last_name = $person->last_name;
				$one_profile->profile_first_name = $person->first_name;
				$one_profile->profile_office = $person->office;
				$one_profile->profile_office_alt = $person->office_alt;
				$one_profile->profile_phone = $person->phone;
				$one_profile->profile_phone_alt = $person->phone_alt;
				$one_profile->profile_email = $person->email;
				$one_profile->profile_email_alt = $person->email_alt;
				$one_profile->profile_website = $person->website;
				$one_profile->profile_position_title = $person->position_title;
				$one_profile->profile_working_title = $person->working_titles;			
				$one_profile->profile_degree = $person->degrees;
				$one_profile->profile_college_bio = $person->bio_college;
				$one_profile->profile_dept_bio = $person->bio_department;
				$one_profile->profile_photo = 	$person->profile_photo;
				$one_profile->profile_slug = $person->slug;
				$one_profile->profile_tags = $person->tags;
				$one_profile->profile_content = $person->content;		
		
				$profiles[] = $one_profile;
								
				
				} // foreach
			
				
				return $profiles;

	 } //get_profiles
	
	
	public function sort_by_last_name( $a , $b ) {
		
			return strcasecmp( $a->last_name, $b->last_name);
		
		} //end sort_by_last_name

/*	 
	 function set_profile_fields ( $person ) {
		 
		
			    $this->profile_last_name = $person['last_name'];
				$this->profile_first_name = $person['first_name'];
				$this->profile_office = $person['office'];
				$this->profile_office_alt = $person['office_alt'];
				$this->profile_phone = $person['phone'];
				$this->profile_email = $person['email'];
				$this->profile_website = $person['website'];
				$this->profile_position_title = $person['position_title'];
				$this->profile_working_title = $person['working_titles'];			
				$this->profile_degree = $person['degrees'];
				$this->profile_college_bio = $person['bio_college'];
				$this->profile_dept_bio = $person['bio_department'];
				$this->profile_photo = 	$person['profile_photo'];
				$this->profile_slug = $person['slug'];
				$this->profile_content = $person['content'];
				
		 
		 	return $this;
		 
		 } //end set_profile_fields
*/	

	
} //CAHNRSWP_People_Displays_Profiles