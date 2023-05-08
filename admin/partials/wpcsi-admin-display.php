<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://mvpmailhouse.com
 * @since      1.0.0
 *
 * @package    Wpcsi
 * @subpackage Wpcsi/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="chrs-settings-block">
<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated">
	<p>Custom scripts saved</p>
	</div>
<?php endif; ?>

<?php 
$pages = get_pages();
?>

</div>

<div class="wrap">

	<h2>Custom Script insert settings page</h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'csi_plugin_settings' ); ?>
		<div class="tab">
		  <button class="tablinks" onclick="openTab(event, 'headerscript')" id="defaultbtn">Header Scripts</button>
		  <button class="tablinks" onclick="openTab(event, 'afterbodyscript')" id="afterscriptsbtn">After body Scripts</button>
		  <button class="tablinks" onclick="openTab(event, 'footerscript')" id="footerscriptsbtn">Footer Scripts</button>
		  <button class="tablinks" onclick="openTab(event, 'shortcodescript')">Shortcode Script</button>
		  <button class="tablinks" onclick="openTab(event, 'sidebars')">Additional Sidebars</button>
		</div>

			<div id="headerscript" class="tabcontent">
				<h3>Header Script Insert</h3>
			  	<p>The scripts listed encoded here will be included with the wp_head hook which is usually parsed on the &lt;head> portion of all your page. depending on the visibility options chosen.</p>
				<div class="wpcsi_hs_h">
					<div class="wpcsi_hs_input_ta_h">
						Script
					</div>
					<div class="wpcsi_hs_input_t_h">
						Visibility options
					</div>
					<div class="wpcsi_hs_r_h">
						&nbsp;
					</div>
					<Br class="clear">
				</div>
				<div class="wpcsi_hs_blank">
					<div class="wpcsi_hs_input_ta">
						<textarea name="header_script_textarea" rows="5" cols="75"></textarea>
					</div>
					<div class="wpcsi_hs_input_t">
					<div class="input_group">
						
						<input class="rd_check" type="radio" name="header_scripts_visibilty_selection" value="page" checked/> <span>Show on Page</span>
						<input class="rd_check" type="radio" name="header_scripts_visibilty_selection2" value="contain" /><span>Show if URL contains</span>
						<input type="text" class="text_selection" name="header_scripts_visibilty_selection_text" value="page">
						<select class="select_input"  name="header_script_visibility">
							<?php 
								$sdstr = '<option value="ALL">Display on All Pages</option>';

								foreach ( $pages as $page ) {
									$sdstr .= '<option value="' . $page->ID . '">';
									$sdstr .= $page->post_title;
									$sdstr .= '</option>';
								}
								echo $sdstr;
								?>
						</select><BR>
						
						<input type="text" class="text_input" name="header_scripts_contain" placeholder="Enter URL filter" style="display:none">
					</div>
					</div>
					<div class="wpcsi_hs_r">
						<a href="#" class="removescript">&#10006;</a>
					</div>
					<br class="clear">	
				</div>
				<?php 
					if( empty( $settings['header_scripts'] ) ){
					?>
						<div class="wpcsi_hs">
							<div class="wpcsi_hs_input_ta">
								<textarea name="csi_settings[header_scripts][]" rows="5" cols="75"></textarea>
							</div>
							<div class="wpcsi_hs_input_t">
								<div class="input_group">
									
									<input class="rd_check" type="radio" name="header_select_firstempty" value="page" checked/> <span>Show on Page</span>
									<input class="rd_check" type="radio" name="header_select_firstempty" value="contain" /> <span>Show if URL contains</span>

									<input type="text" class="text_selection" name="csi_settings[header_scripts_visibilty_selection][]" value="page">

									<select class="select_input" name="csi_settings[header_scripts_visibilty][]">
										<?php 
										$sdstr = '<option value="ALL">Display on All Pages</option>';

										foreach ( $pages as $page ) {
											$sdstr .= '<option value="' . $page->ID . '">';
											$sdstr .= $page->post_title;
											$sdstr .= '</option>';
										}
										echo $sdstr;
										?>
									</select><BR>
									<input type="text" class="text_input" name="csi_settings[header_scripts_contain][]" placeholder="Enter URL filter" style="display:none">
								</div>

							</div>
							<div class="wpcsi_hs_r">
								<a href="#" class="removescript">&#10006;</a>
							</div>
							<br class="clear">
						</div>
					<?php	
					}
					foreach( $settings['header_scripts'] as $key => $value ){
						$pageselect = "";
						$containselect = "";
					?>
						<div class="wpcsi_hs">
							<div class="wpcsi_hs_input_ta">
								<textarea name="csi_settings[header_scripts][]" rows="5" cols="75"><?php echo $value; ?></textarea>
							</div>
							<div class="wpcsi_hs_input_t">

								<div class="input_group">

									<?php 
									if( "page" === $settings['header_scripts_visibilty_selection'][$key] ){
										$pageselect = "checked";
										$containselect = "";
										$selectinput_style = '';
										$containinput_style = 'style="display:none;"';
									}else{
										$pageselect = "";
										$selectinput_style = 'style="display:none;"';
										$containselect = "checked";
										$containinput_style = '';
									}
									?>

									<input class="rd_check" type="radio" name="header_select_<?php echo $key; ?>" value="page" <?php echo $pageselect; ?>/> <span>Show on Page</span>
									<input class="rd_check" type="radio" name="header_select_<?php echo $key; ?>" value="contain" <?php echo $containselect; ?>/> <span>Show if URL contains</span>
									<input type="text" class="text_selection" name="csi_settings[header_scripts_visibilty_selection][]" value="<?php echo $settings['header_scripts_visibilty_selection'][$key]; ?>">
									<select class="select_input" name="csi_settings[header_scripts_visibilty][]" <?php echo $selectinput_style; ?>>
										<?php 
										
										$sdstr = '<option value="ALL">Display on All Pages</option>';

										foreach ( $pages as $page ) {
											$selected = '';
											if( $page->ID == $settings['header_scripts_visibilty'][$key] ){
												$selected = 'selected';
											}
											$sdstr .= '<option value="' . $page->ID . '" '.$selected.'>';
											$sdstr .= $page->post_title;
											$sdstr .= '</option>';
										}
										echo $sdstr;
										?>
									</select><BR>
									<input type="text" class="text_input" name="csi_settings[header_scripts_contain][]" value="<?php echo $settings['header_scripts_contain'][$key];?>" <?php echo $containinput_style; ?>>
								</div>

							</div>
							<div class="wpcsi_hs_r">
								<a href="#" class="removescript">&#10006;</a>
							</div>
							<br class="clear">
						</div>
					<?php
					}
					?>

				<br class="clear">
				<a href="" class="wpcs_btn" id="wpcs_hs_btn" >Add New after header Script</a>
			</div>

			<div id="afterbodyscript" class="tabcontent">
				<h3>Afer Body Tag Script Insert </h3>
				<p>The scripts on these fields will be added after the body tag &lt;/body&gt if and only if you have added "body_begin" action hook to your theme file. e.g. do_action('body_begin'); </p>
				<div class="wpcsi_ab_container" rel="0">
				<div class="wpcsi_ab_h">
					<div class="wpcsi_ab_input_ta_h">
						Script
					</div>
					<div class="wpcsi_ab_input_t_h">
						Visibility options
					</div>
					<div class="wpcsi_ab_r_h">
						&nbsp;
					</div>
					<Br class="clear">
				</div>
					<div class="wpcsi_ab_blank">
						<div class="wpcsi_ab_input_ta">
							<textarea name="after_body_textarea" rows="5" cols="75"></textarea>
						</div>
						<div class="wpcsi_ab_input_t">
							<div class="input_group">
							
								<input class="rd_check" type="radio" name="after_body_visibilty_selection" value="page" checked/> <span>Show on Page</span>
								<input class="rd_check" type="radio" name="after_body_visibilty_selection2" value="contain" /> <span>Show if URL contains</span>
								<input type="text" class="text_selection" name="after_body_visibilty_selection_text" value="page">
								<select class="select_input" name="after_body_visibility">
									<?php 
									$sdstr = '<option value="ALL">Display on All Pages</option>';

									foreach ( $pages as $page ) {
										$sdstr .= '<option value="' . $page->ID . '">';
										$sdstr .= $page->post_title;
										$sdstr .= '</option>';
									}
									echo $sdstr;
									?>
								</select><BR>

								<input type="text" class="text_input" name="after_body_contain" placeholder="Enter URL filter" style="display:none">
							</div>
						</div>
						<div class="wpcsi_ab_r">
							<a href="#" class="removescript">&#10006;</a>
						</div>
						<br class="clear">
					</div>

					<?php 
					if( empty( $settings['after_body'] ) ){
					?>
						<div class="wpcsi_ab">
							<div class="wpcsi_ab_input_ta">
								<textarea name="csi_settings[after_body][]" rows="5" cols="75"></textarea>
							</div>
							<div class="wpcsi_ab_input_t">
								<div class="input_group">

									<input class="rd_check" type="radio" name="body_select_firstempty" value="page" checked/> <span>Show on Page</span>
									<input class="rd_check" type="radio" name="body_select_firstempty" value="contain" /> <span>Show if URL contains</span>
									<input type="text" class="text_selection" name="csi_settings[after_body_visibilty_selection][]" value="page">
									<select class="select_input" name="csi_settings[after_body_visibilty][]">
										<?php 
										$sdstr = '<option value="ALL">Display on All Pages</option>';
										foreach ( $pages as $page ) {
											$sdstr .= '<option value="' . $page->ID . '">';
											$sdstr .= $page->post_title;
											$sdstr .= '</option>';
										}
										echo $sdstr;
										?>
									</select><BR>
									<input type="text" class="text_input" name="csi_settings[after_body_contain][]" placeholder="Enter URL filter"  style="display:none">
								</div>
							</div>

							<div class="wpcsi_ab_r">
								<a href="#" class="removescript">&#10006;</a>
							</div>
							
							<br class="clear">
						</div>
					<?php	
					}

					foreach( $settings['after_body'] as $key => $value ){
					?>
					<div class="wpcsi_ab">
						<div class="wpcsi_ab_input_ta">
							<textarea name="csi_settings[after_body][]" rows="5" cols="75"><?php echo $value; ?></textarea>
						</div>
						<div class="wpcsi_ab_input_t">
							<div class="input_group">

								<?php 
									if( "page" === $settings['after_body_visibilty_selection'][$key] ){
										$pageselect = "checked";
										$containselect = "";
										$selectinput_style = '';
										$containinput_style = 'style="display:none;"';
									}else{
										$pageselect = "";
										$selectinput_style = 'style="display:none;"';
										$containselect = "checked";
										$containinput_style = '';
									}
								?>

								<input class="rd_check" type="radio" name="body_select_<?php echo $key; ?>" value="page" <?php echo $pageselect; ?>/> <span>Show on Page</span>
								<input class="rd_check" type="radio" name="body_select_<?php echo $key; ?>" value="contain" <?php echo $containselect; ?>/> <span>Show if URL contains</span>
								<input type="text" class="text_selection" name="csi_settings[after_body_visibilty_selection][]" value="<?php echo $settings['after_body_visibilty_selection'][$key]; ?>">
								<select class="select_input" name="csi_settings[after_body_visibilty][]" <?php echo $selectinput_style; ?>>
									<?php 
									$sdstr = '<option value="ALL">Display on All Pages</option>';

									foreach ( $pages as $page ) {
										$selected = '';
										if( $page->ID == $settings['after_body_visibilty'][$key] ){
											$selected = 'selected';
										}
										$sdstr .= '<option value="' . $page->ID . '" '.$selected.'>';
										$sdstr .= $page->post_title;
										$sdstr .= '</option>';
									}
									echo $sdstr;
									?>
								</select><br>
								<input type="text" class="text_input" name="csi_settings[after_body_contain][]" placeholder="Enter URL filter" value="<?php echo $settings['after_body_contain'][$key]; ?>" <?php echo $containinput_style; ?>>
							</div>
						</div>
						<div class="wpcsi_ab_r">
							<a href="#" class="removescript">&#10006;</a>
						</div>
						<br class="clear">
					</div>
					<?php } ?>
				</div>
				<br class="clear">
				<a href="" class="wpcs_btn" id="wpcs_abs_btn" >Add New after body Script</a>
			</div>

			<div id="footerscript" class="tabcontent">
				<h3>Footer Script Insert </h3>
				<p>The script on this field will be included with the wp_footer hook which is usually parsed before the end body tag &lt;/body> on all your pages </p>
				<div class="wpcsi_fs_h">
					<div class="wpcsi_hs_input_ta_h">
						Script
					</div>
					<div class="wpcsi_fs_input_t_h">
						Visibility options
					</div>
					<div class="wpcsi_fs_r_h">
						&nbsp;
					</div>
					<Br class="clear">
				</div> 
			  <div class="wpcsi_fs_blank">
					<div class="wpcsi_fs_input_ta">
						<textarea name="footer_script_textarea" rows="5" cols="75"></textarea>
					</div>
					<div class="wpcsi_fs_input_t">
						<div class="input_group">
						
							<input class="rd_check" type="radio" name="footer_scripts_visibilty_selection" value="page" checked/> <span>Show on Page</span>
							<input class="rd_check" type="radio" name="footer_scripts_visibilty_selection2" value="contain" /> <span>Show if URL contains</span>
							<input type="text" class="text_selection" name="footer_scripts_visibilty_selection_text" value="page">
							<select class="select_input" name="footer_script_visibility">
								<?php 
									$sdstr = '<option value="ALL">Display on All Pages</option>';

									foreach ( $pages as $page ) {
										$sdstr .= '<option value="' . $page->ID . '">';
										$sdstr .= $page->post_title;
										$sdstr .= '</option>';
									}
									echo $sdstr;
									?>
							</select><BR>
							<input type="text" class="text_input" name="footer_script_contain" placeholder="Enter URL filter" style="display:none">
						</div>
					</div>
					<div class="wpcsi_fs_r">
						<a href="#" class="removescript">&#10006;</a>
					</div>
					<br class="clear">	
				</div>
				<?php if( empty( $settings['footer_scripts'] ) ){ ?>
						<div class="wpcsi_fs">
							<div class="wpcsi_fs_input_ta">
								<textarea name="csi_settings[footer_scripts][]" rows="5" cols="75"></textarea>
							</div>
							<div class="wpcsi_fs_input_t">
								<div class="input_group">

									<input class="rd_check" type="radio" name="footer_select_firstempty" value="page" checked/> <span>Show on Page</span>
									<input class="rd_check" type="radio" name="footer_select_firstempty" value="contain" /> <span>Show if URL contains</span>
									<input type="text" class="text_selection" name="csi_settings[footer_scripts_visibilty_selection][]" value="page">
									<select class="select_input" name="csi_settings[footer_scripts_visibilty][]">
										<?php 
										$sdstr = '<option value="ALL">Display on All Pages</option>';

										foreach ( $pages as $page ) {
											$sdstr .= '<option value="' . $page->ID . '">';
											$sdstr .= $page->post_title;
											$sdstr .= '</option>';
										}
										echo $sdstr;
										?>
									</select><BR>
									<input type="text" class="text_input" name="csi_settings[footer_scripts_contain][]" placeholder="Enter URL filter" style="display:none;">
									</div>
							</div>
							<div class="wpcsi_fs_r">
								<a href="#" class="removescript">&#10006;</a>
							</div>
							<br class="clear">
						</div>
					<?php	
					}
					foreach( $settings['footer_scripts'] as $key => $value ){
					?>
						<div class="wpcsi_fs">
							<div class="wpcsi_fs_input_ta">
								<textarea name="csi_settings[footer_scripts][]" rows="5" cols="75"><?php echo $value; ?></textarea>
							</div>
							<div class="wpcsi_fs_input_t">
								<div class="input_group">
									
									<?php 
										if( "page" === $settings['footer_scripts_visibilty_selection'][$key] ){
											$pageselect = "checked";
											$containselect = "";
											$selectinput_style = '';
											$containinput_style = 'style="display:none;"';
										}else{
											$pageselect = "";
											$selectinput_style = 'style="display:none;"';
											$containselect = "checked";
											$containinput_style = '';
										}
									?>
									<input class="rd_check" type="radio" name="footer_select_<?php echo $key; ?>" value="page" <?php echo $pageselect; ?>/> <span>Show on Page</span>
									<input class="rd_check" type="radio" name="footer_select_<?php echo $key; ?>" value="contain" <?php echo $containselect; ?>/> <span>Show if URL contains</span>
									<input type="text" class="text_selection" name="csi_settings[footer_scripts_visibilty_selection][]" value="<?php echo $settings['footer_scripts_visibilty_selection'][$key]; ?>">
									<select class="select_input" name="csi_settings[footer_scripts_visibilty][]" <?php echo $selectinput_style; ?>>
										<?php 
										
										$sdstr = '<option value="ALL">Display on All Pages</option>';

										foreach ( $pages as $page ) {
											$selected = '';
											if( $page->ID == $settings['footer_scripts_visibilty'][$key] ){
												$selected = 'selected';
											}
											$sdstr .= '<option value="' . $page->ID . '" '.$selected.'>';
											$sdstr .= $page->post_title;
											$sdstr .= '</option>';
										}
										echo $sdstr;
										?>
									</select><br>
									<input type="text" class="text_input" name="csi_settings[footer_scripts_contain][]" placeholder="Enter URL filter" value="<?php echo $settings['footer_scripts_contain'][$key]; ?>" <?php echo $containinput_style; ?>>
								</div>
							</div>
							<div class="wpcsi_fs_r">
								<a href="#" class="removescript">&#10006;</a>
							</div>
							<br class="clear">
						</div>
					<?php
					}
					?>
					<br class="clear">
					<a href="" class="wpcs_btn" id="wpcs_fs_btn" >Add New footer Script</a>
			</div>

			<div id="shortcodescript" class="tabcontent">
			  	<h3>shortcode script Insert</h3>
			  	<p>Note: you may insert [{shortcode tag}] shortcode to a post or page and the script on these fields will be parsed on that content.</p>
				  <div class="wpcsi_sc_h">
					<div class="wpcsi_hs_input_ta_h">
						Script
					</div>
					<div class="wpcsi_fs_input_t_h">
						Shortcode tag
					</div>
					<div class="wpcsi_fs_r_h">
						&nbsp;
					</div>
					<Br class="clear">
				</div> 
				  <div class="wpcsi_sc_blank">
					<div class="wpcsi_sc_input_ta">
						<textarea id="shortcode_script" name="shortcode_scripts" rows="5" cols="75"></textarea>
					</div>
					<div class="wpcsi_sc_input_t">
					<input type="text" class="text_input" name="shortcode_text" placeholder="Enter Shortcode" >
					</div>
					<div class="wpcsi_sc_r">
						<a href="#" class="removescript">&#10006;</a>
					</div>
					<br class="clear">
				</div>
				<?php if( empty( $settings['shortcode_scripts'] ) ){ ?>
					<div class="wpcsi_sc">
						<div class="wpcsi_sc_input_ta">
							<textarea id="shortcode_script" name="csi_settings[shortcode_scripts][]" rows="5" cols="75"></textarea>
						</div>
						<div class="wpcsi_sc_input_t">
						<input type="text" class="text_input" name="csi_settings[shortcode_text][]" placeholder="Enter Shortcode">
						</div>
						<div class="wpcsi_sc_r">
							<a href="#" class="removescript">&#10006;</a>
						</div>
						<br class="clear">
					</div>
				<?php } 
				foreach( $settings['shortcode_scripts'] as $key => $value ){
				?>
					<div class="wpcsi_sc">
						<div class="wpcsi_sc_input_ta">
							<textarea id="shortcode_script" name="csi_settings[shortcode_scripts][]" rows="5" cols="75"><?php echo $value;?></textarea>
						</div>
						<div class="wpcsi_sc_input_t">
						<input type="text" class="text_input" name="csi_settings[shortcode_text][]" placeholder="Enter Shortcode" value="<?php echo $settings['shortcode_text'][$key]; ?>">
						</div>
						<div class="wpcsi_sc_r">
							<a href="#" class="removescript">&#10006;</a>
						</div>
						<br class="clear">
					</div>
				<?php } ?>
			  	<br class="clear">
			  	<a href="" class="wpcs_btn" id="wpcs_sc_btn" >Add New Shortcode</a>
			</div>

			<div id="sidebars" class="tabcontent">
			  <h3>Settings for additional footer and header sidebar Containers</h3>
			  <p>Activate additional header and footer sidebars location parsed on the header &lt;head> and on the end of body &lt;/body>  </p>
			  	
			  	<label class="switch">
				  <input type="checkbox" id="headersidebar" name="csi_settings[headersidebar]" value="1" <?php echo checked( 1, $settings['headersidebar'], false ); ?>>
				  <span class="slider"></span>
				</label>Enable Additional header sidebar<BR>

				<label class="switch">
				  <input type="checkbox" id="footersidebar" name="csi_settings[footersidebar]" value="1" <?php echo checked( 1, $settings['footersidebar'], false ); ?>>
				  <span class="slider"></span>
				</label>Enable Additional footer sidebar<BR>

			</div> 
		<div class="bottomtab">
			<input type="submit" class="button-primary" value="Save custom scripts" />
		</div>
	</form>
</div> 