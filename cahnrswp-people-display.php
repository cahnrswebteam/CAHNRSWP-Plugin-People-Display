<?php
/*
Plugin Name: CAHNRSWP People Display
Description: A plugin for displaying lists of profiles from people.wsu.edu.
Author: CAHNRS, philcable
Version: 0.0.1
*/

class CAHNRSWP_People_Display {

	/**
	 * Hooks.
	 */
	public function __construct() {
		//add_filter( 'shortcode_atts_', array( $this, 'extended_atts' ), 10, 3 );
		add_filter( 'shortcode_atts_wsuwp_people', array( $this, 'extended_atts' ), 10, 3 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 21 );
		add_filter( 'wsuwp_people_html', array( $this, 'people_wrapper_html' ), 10, 3 );
		add_filter( 'wsuwp_people_sort_items', array( $this, 'people_sort' ), 10, 2 );
		add_filter( 'wsuwp_people_item_html', array( $this, 'people_html' ), 10, 3 );
		add_action( 'wp_ajax_nopriv_profile_request', array( $this, 'profile_request' ) );
		add_action( 'wp_ajax_profile_request', array( $this, 'profile_request' ) );
	}

	public function extended_atts( $out, $pairs, $atts ) {
		//if ( $out['query'] == 'posts/?type=wsuwp_people_profile' ) ) {
			//remove_filter( current_filter(), __FUNCTION__ );
		if ( isset( $atts['output'] ) ) {
			$out['output'] = $atts['output'];
		} else {
			$out['output'] = 'default';
		}
		if ( isset( $atts['actions'] ) ) {
			$out['actions'] = $atts['actions'];
		}
		if ( isset( $atts['head'] ) ) {
			$out['head'] = $atts['head'];
		}
		//}
		return $out;
	}

	/**
	 * Enqueue custom scripts and styles for the frontend.
	 */
	public function enqueue_scripts() {
		$post = get_post();
		if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'wsuwp_people' ) ) {
			wp_enqueue_style( 'cahnrs-people', plugins_url( '/css/people.css', __FILE__ ) );
			wp_enqueue_script( 'cahnrs-people', plugins_url( '/js/people.js', __FILE__ ), array( 'jquery' ) );
			wp_localize_script( 'cahnrs-people', 'personnel', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		}
	}

	/**
	 * Custom HTML template for use with syndicated people.
	 *
	 * @param string   $html   The HTML to output for an individual person.
	 * @param stdClass $person Object representing a person received from people.wsu.edu.
	 * @param array    $atts   The shortcode attributes.
	 *
	 * @return string The HTML to output for a person.
	 */
	public function people_wrapper_html( $html, $people, $atts ) {
		if ( $atts['actions'] && '' != $atts['actions'] ) {
			$actions = explode( ',', $atts['actions'] );
			ob_start();
			include_once( __DIR__ . '/templates/people-actions.php' );
			$html = ob_get_contents();
			ob_end_clean();
			return $html;
		}	
	}

	/**
	 * Use the provided Content Syndicate filter to sort people results before displaying.
	 */
	public function people_sort( $people, $atts ) {
		if ( $atts['head'] && '' != $atts['head'] ) {
			$heads = explode( ',', $atts['head'] );
			$unit_heads = array();
			foreach ( $people as $index => $person ) {
				if ( in_array( $person->ID, $heads ) ) {
					array_push( $unit_heads, $person );
					unset( $people[$index] );
				}
			}
		}
		usort( $people, array( $this, 'sort_alpha' ) );
		if ( $atts['head'] && '' != $atts['head'] ) {
			return array_merge( array_reverse( $unit_heads ), $people );
		} else {
			return $people;
		}
	}

	/**
	 * Sort people alphabetically by their last name.
	 *
	 * @param stdClass $a Object representing a person.
	 * @param stdClass $b Object representing a person.
	 *
	 * @return int Whether person a's last name is alphabetically smaller or greater than person b's.
	 */
	public function sort_alpha( $a, $b ) {
		//if ( in_array( $a->ID, $heads ) ) {
		//}
		return strcasecmp( $a->last_name, $b->last_name );
	}

	/**
	 * Custom HTML template for use with syndicated people.
	 *
	 * @param string   $html   The HTML to output for an individual person.
	 * @param stdClass $person Object representing a person received from people.wsu.edu.
	 * @param string   $type   The shortcode's "output" attribute value.
	 *
	 * @return string The HTML to output for a person.
	 */
	public function people_html( $html, $person, $type ) {
		if ( isset( $person->working_titles[0] ) ) {
			$title = $person->working_titles[0];
		} else {
			$title = ucwords( strtolower( $person->position_title ) );
		}
		if ( ! empty( $person->email_alt ) ) {
			$email = $person->email_alt;
		} else {
			$email = $person->email;
		}
		if ( ! empty( $person->office_alt ) ) {
			$office = $person->office_alt;
		} else {
			$office = $person->office;
		}
		if ( ! empty( $person->phone_alt ) ) {
			$phone = $person->phone_alt;
		} else {
			$phone = $person->phone;
		}
		ob_start();
		include( __DIR__ . '/templates/people.php' );
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	/**
	 * AJAX profile request.
	 */
	public function profile_request() {
		if ( $_POST['profile'] ) {
			$response = wp_remote_get( 'https://people.wsu.edu/wp-json/posts/' . $_POST['profile'], array( 'sslverify' => false ) );
			if ( is_wp_error( $response ) ) {
				return '<!-- error -->';
			}
			$data = wp_remote_retrieve_body( $response );
			if ( empty( $data ) ) {
				return '<!-- error -->';
			}
			$person = json_decode( $data );
			include( __DIR__ . '/templates/profile.php' );
		}
		exit;
	}

}

new CAHNRSWP_People_Display();