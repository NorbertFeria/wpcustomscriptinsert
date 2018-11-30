<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="chrs-settings-block">
<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated">
	<p>Custom scripts saved</p>
	</div>
<?php endif; ?>
</div>

<div class="wrap">

	<h2>Custom Script insert settings page</h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'si_plugin_settings' ); ?>
		<div class="tab">
		  <button class="tablinks" onclick="openTab(event, 'headerscript')" id="defaultbtn">Header Scripts</button>
		  <button class="tablinks" onclick="openTab(event, 'footerscript')">Footer Scripts</button>
		  <button class="tablinks" onclick="openTab(event, 'shortcodescript')">Shortcode Script</button>
		</div>

			<div id="headerscript" class="tabcontent">
			  <h3>Header Script Insert</h3>
			  <p>The code in this script will be included with the wp_head hook which is usually parsed on the &lt;head> portion of all your page</p>

			  <textarea id="header_scripts" name="si_settings[header_scripts]" rows="10" cols="60"><?php echo stripslashes($settings['header_scripts']); ?></textarea>
			</div>

			<div id="footerscript" class="tabcontent">
			  <h3>Footer Script Insert </h3>
			  <p>The script on this field will be included with the wp_footer hook which is usually parsed before the end body tag &lt;/body> on all your pages </p>
			  <textarea id="footer_scripts" name="si_settings[footer_scripts]" rows="10" cols="60"><?php echo stripslashes($settings['footer_scripts']); ?></textarea>			  
			</div>

			<div id="shortcodescript" class="tabcontent">
			  <h3>shortcode script Insert</h3>
			  <p>Note: you may insert [csi] shortcode to a post or page and the script on this field will be parsed on that content.</p>
			  <textarea id="shortcode_script" name="si_settings[shortcode_script]" rows="10" cols="60"><?php echo stripslashes($settings['shortcode_script']); ?></textarea>
			</div> 
		<div class="bottomtab">
			<input type="submit" class="button-primary" value="Save custom scripts" />
		</div>
	</form>
</div> 