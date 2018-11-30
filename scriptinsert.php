<?php
/*
Plugin Name: WP Custom Script insert
Plugin URI: http://norbertferia.com/wp-custom-script-insert
Description: Insert scripts into header or footer 
Version: 1.0
Author: Norbert Feria
Author URI: http://norbertferia.com
License: GPLv2 or later
*/
if ( ! defined( 'ABSPATH' ) ) exit;

$custom_script_insert = new scriptinsert(__FILE__);

class scriptinsert{

	public function __construct($file){
		add_action('admin_menu',array($this,'si_pageotions') );
		add_action('admin_init',array($this,'si_register_settings') );
		add_action('wp_head',array($this,'si_header_insert'),100 );
		add_action('wp_footer',array($this,'si_footer_insert'),100 );
		add_action('init',array($this,'register_custom_shortcode') );
		add_action('admin_enqueue_scripts', array($this,'enqueue_assets') );
	}

	function enqueue_assets($hook){
		if($hook != 'settings_page_script-insert')
			return;
		wp_register_style( 'si_admin_style', plugins_url( 'assets/si_admin.css' , __FILE__ ) );
    	wp_enqueue_style( 'si_admin_style' );
    	wp_enqueue_script( 'si_admin_script', plugins_url( 'assets/si_admin.js' , __FILE__ ) );
	}

	function si_pageotions(){
		add_options_page("Custom Script Insert", "Custom Script Insert", "manage_options", "script-insert", array($this,'si_settings_page') );
	}

	function si_register_settings(){
		register_setting('si_plugin_settings','si_settings', array($this,'si_validate_settings'));
	}

	function register_custom_shortcode(){
		add_shortcode('csi', array($this,'custom_script_insert_shortcode') );
	}

	function custom_script_insert_shortcode($atts,$content = null){
		$si_settings = get_option( 'si_settings', $si_settings );
		$sdstr = $si_settings['shortcode_script'];
		return $sdstr;
	}

	function validateinput($input){
		//eval(base64_decode(
		return $input;
	}

	function si_validate_settings($input){
		$input['header_scripts'] = $this->validateinput($input['header_scripts']);
		$input['footer_scripts'] = $this->validateinput($input['footer_scripts']);
		$input['shortcode_script'] = $this->validateinput($input['shortcode_script']);
		return $input;
	}

	function si_header_insert(){
    	$si_settings = get_option( 'si_settings', $si_settings );
		echo $si_settings['header_scripts'];
		if($si_settings['headersidebar'] == 1){
			echo $this->get_dynamic_sidebar('csheader');
		}
	}

	function si_footer_insert(){
    	$si_settings = get_option( 'si_settings', $si_settings );
		echo $si_settings['footer_scripts'];
		if($si_settings['footersidebar'] == 1){
			echo $this->get_dynamic_sidebar('csfooter');
		}
	}
 
	function si_settings_page(){
		$settings = get_option( 'si_settings', $si_settings );
		if ( ! isset( $_REQUEST['updated'] ) )
			$_REQUEST['updated'] = false;

		include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
	}

}

?>