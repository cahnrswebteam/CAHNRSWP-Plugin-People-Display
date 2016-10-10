<?php

class CAHNRSWP_People_Displays_Profiles {
	
	protected $url;
	
	protected $json;
	
	protected $data;
	
	public $profiles_list = array();
	
	
	 public function init() {
	 
	 	$profiles_list = $this->get_profiles();	

	 }
	 
	
	
	
	public function get_profiles() {
		/* parameters 
			tag - 
			count - 
			classification -
			university_organization_slug -
			
		
		*/
		
//		$url = "https://people.wsu.edu/wp-json/wp/v2/people/?type=wsuwp_people_profile&filter[orderby]=title&filter[order]=ASC&filter[tag]=department-of-human-development&filter[per_page]=60";

		$url = "https://people.wsu.edu/wp-json/wp/v2/people/?type=wsuwp_people_profile&filter[orderby]=title&filter[order]=ASC&filter[wsuwp_university_location]=mount-vernon&filter[per_page]=100";
		$json = file_get_contents($url);
	
		$data = json_decode($json, TRUE);

	
	
		$sortArray = array();
		
	//	var_dump($data);
	/*	
		foreach($data as $item ) {
		  foreach($item as $key=>$value){
				if(!isset($sortArray[$key])){
					$sortArray[$key] = $array();
					}
				$sortArray[$key][] = $value;
				}
 
		}
	*/	
	$orderby = 'last_name'; 
	
//	array_multisort($sortArray[$orderby],SORT_ASC,$data); 
		
		
	//	$one_profile = '';
		
		$profiles = array();
			
			foreach ($data as $person) {
				
			$one_profile = new CAHNRSWP_People_Displays_Profiles();
//				$one_profile = $this->set_profile_fields( $person );

				
			    $one_profile->profile_last_name = $person['last_name'];
				$one_profile->profile_first_name = $person['first_name'];
				$one_profile->profile_office = $person['office'];
				$one_profile->profile_office_alt = $person['office_alt'];
				$one_profile->profile_phone = $person['phone'];
				$one_profile->profile_email = $person['email'];
				$one_profile->profile_website = $person['website'];
				$one_profile->profile_position_title = $person['position_title'];
				$one_profile->profile_working_title = $person['working_titles'];			
				$one_profile->profile_degree = $person['degrees'];
				$one_profile->profile_college_bio = $person['bio_college'];
				$one_profile->profile_dept_bio = $person['bio_department'];
				$one_profile->profile_photo = 	$person['profile_photo'];
				$one_profile->profile_slug = $person['slug'];
				$one_profile->profile_content = $person['content'];
					
				$profiles[] = $one_profile;
				
				
//				$json_profiles_list = $person['last_name'] . ',' . $person['first_name'] . $person['position_title'];  				
				
				
				} // foreach
			
				
				return $profiles;

	 } //get_profiles
	 

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