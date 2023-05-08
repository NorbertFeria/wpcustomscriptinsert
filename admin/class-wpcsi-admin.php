<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mvpmailhouse.com
 * @since      1.0.0
 *
 * @package    Wpcsi
 * @subpackage Wpcsi/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpcsi
 * @subpackage Wpcsi/admin
 * @author     MVP Mailhouse <website@mvpmailhouse.com>
 */
class Wpcsi_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpcsi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpcsi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpcsi-admin.css', array(), $this->version, 'all' );

	}

	public function csi_pageotions(){
		add_options_page("Custom Script Insert", "Custom Script Insert", "manage_options", "script-insert", array($this,'csi_settings_page') );
	}

	public function csi_settings_page(){
		$settings = get_option( 'csi_settings', $csi_settings );
		if ( ! isset( $_REQUEST['updated'] ) )
			$_REQUEST['updated'] = false;

		include(sprintf("%s/partials/wpcsi-admin-display.php", dirname(__FILE__)));
	}

	public function csi_register_settings(){
		register_setting( 'csi_plugin_settings', 'csi_settings', array($this,'csi_validate_settings') );
	}

	public function validateinput($input){
		//eval(base64_decode(
		return $input;
	}

	public function csi_validate_settings( $input ){

		$input['header_scripts'] = $this->validateinput($input['header_scripts']);
		$input['footer_scripts'] = $this->validateinput($input['footer_scripts']);
		$input['shortcode_script'] = $this->validateinput($input['shortcode_script']);

		$input['headersidebar'] = ($input['headersidebar'] != '1') ? 0 : 1;
		$input['footersidebar'] = ($input['footersidebar'] != '1') ? 0 : 1;

		return $input;
	}

	public function csi_afterbody_insert(){
		global $post;
		global $wp;
		
		$current_url = home_url( add_query_arg( array(), $wp->request ) );
		$csi_settings = get_option( 'csi_settings');

		if( !empty( $csi_settings['after_body'] ) ) {
			foreach( $csi_settings['after_body'] as $key => $value ){

				if('page' === $csi_settings['after_body_visibilty_selection'][$key]){
					if( 'ALL' == $csi_settings['after_body_visibilty'][$key] ){
						echo $value;
					}
					if( $post->ID == $csi_settings['after_body_visibilty'][$key] ){
						echo $value;
					}
				}

				if('contain' === $csi_settings['after_body_visibilty_selection'][$key]){
					if (false !== strpos( $current_url, $csi_settings['after_body_contain'][$key] ) ) {
						echo $value;
					}
				}
			}
		}
	}

	public function csi_header_insert(){
		global $post;
		global $wp;
		
		$current_url = home_url( add_query_arg( array(), $wp->request ) );
		$csi_settings = get_option( 'csi_settings' );

		if( !empty( $csi_settings['header_scripts'] ) ) {
			foreach( $csi_settings['header_scripts'] as $key => $value ){

				if('page' === $csi_settings['header_scripts_visibilty_selection'][$key]){
					if( 'ALL' == $csi_settings['header_scripts_visibilty'][$key] ){
						echo $value;
					}
					if( $post->ID == $csi_settings['header_scripts_visibilty'][$key] ){
						echo $value;
					}
				}

				if('contain' === $csi_settings['header_scripts_visibilty_selection'][$key]){
					if (false !== strpos( $current_url, $csi_settings['header_scripts_contain'][$key] ) ) {
						echo $value;
					}
				}
			}
		}


		if($csi_settings['headersidebar'] == 1){
			echo $this->get_dynamic_sidebar('csheader');
		}
	}

	public function csi_footer_insert(){
		global $post;
		global $wp;
		
		$current_url = home_url( add_query_arg( array(), $wp->request ) );

		$csi_settings = get_option( 'csi_settings' );

		if( !empty( $csi_settings['footer_scripts'] ) ) {
			foreach( $csi_settings['footer_scripts'] as $key => $value ){

				if('page' === $csi_settings['footer_scripts_visibilty_selection'][$key]){
					if( 'ALL' == $csi_settings['footer_scripts_visibilty'][$key] ){
						echo $value;
					}
					if( $post->ID == $csi_settings['footer_scripts_visibilty'][$key] ){
						echo $value;
					}
				}

				if('contain' === $csi_settings['footer_scripts_visibilty_selection'][$key]){
					if (false !== strpos( $current_url, $csi_settings['footer_scripts_contain'][$key] ) ) {
						echo $value;
					}
				}
			}
		}

		if($csi_settings['footersidebar'] == 1){
			echo $this->get_dynamic_sidebar('csfooter');
		}
	}

	public function register_custom_shortcode(){
		$csi_settings = get_option( 'csi_settings' );
		
		foreach( $csi_settings['shortcode_text'] as $key => $value ){	
			if( 0 < strlen($value) ){
				add_shortcode( $value, array( $this, 'custom_script_insert_shortcode_callback') );
			}
		}		
	}

	public function custom_script_insert_shortcode_callback( $atts, $content = null, $tag){
				
		$csi_settings = get_option( 'csi_settings' );

		foreach( $csi_settings['shortcode_scripts'] as $key => $value ){
			if( $tag === $csi_settings['shortcode_text'][$key] ){
				$sdstr = $value;
			}
		}

		return $sdstr;

	}

	public function register_custom_sidebars(){
		$settings = get_option( 'csi_settings', $csi_settings );

		if($settings['headersidebar'] == 1)
		{
			if (function_exists('register_sidebar')) 
			{
				register_sidebar(array(
						'name' => 'Custom Header Sidebar',
						'id'   => 'csheader',
						'description'   => 'Custom header Sidebar parsed on &lt;head&gt;',
						'before_widget' => '',
						'after_widget'  => '',
						'before_title'  => '',
						'after_title'   => ''
					));
			}
		}

		if($settings['footersidebar'] == 1)
		{
			if (function_exists('register_sidebar')) 
			{
				register_sidebar(array(
						'name' => 'Custom Footer Sidebar',
						'id'   => 'csfooter',
						'description'   => 'Custom footer Sidebar parsed before &lt;/body&gt;',
						'before_widget' => '',
						'after_widget'  => '',
						'before_title'  => '',
						'after_title'   => ''
					));
			}
		}		
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpcsi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpcsi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpcsi-admin.js', array( 'jquery' ), $this->version, false );

	}

}
