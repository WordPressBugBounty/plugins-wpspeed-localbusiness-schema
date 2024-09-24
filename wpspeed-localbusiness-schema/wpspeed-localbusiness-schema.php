<?php
/*
Plugin Name: Local Business Schema Lite
Plugin URI: https://lvdynamic.com/
Description: Easily Add JSON-LD LocalBusiness Schema on your Website.
Version: 1.2
Author: Lumiverse Dynamic
License: GPL2
*/

// DO NOT ALLOW DIRECT ACCESS
if ( !defined( 'ABSPATH' ) ) exit;

define( 'WPSPEED_LOCALBUSINESS_PATH', plugin_dir_path( __FILE__ ) );					// Defining plugin dir path
define( 'WPSPEED_LOCALBUSINESS_VERSION', 'v1.2');										// Defining plugin version
define( 'WPSPEED_LOCALBUSINESS_NAME', 'Local Business Schema Lite');		// Defining plugin name

/**
 * Create Settings Page
 */

// Create Settings Menu
add_action('admin_menu', 'wpspeed_localbusiness_create_menu');

function wpspeed_localbusiness_create_menu() {

    add_menu_page('WP Speed LBS', 'WP Speed LBS', 'administrator', __FILE__, 'wpspeed_localbusiness_settings_page' , plugins_url('/images/wps-localbusiness.png', __FILE__) );	
	add_action( 'admin_init', 'register_wpspeed_localbusiness_settings' );
	
}

function register_wpspeed_localbusiness_settings() {
	// Register Plugin Settings
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_name' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_straddress' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_city' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_state' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_postal' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_image' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_phone' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_url' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_active' );
}

function wpspeed_localbusiness_settings_page() {
	$wpspeed_lbs_name = get_option( 'wpsp_lbs_name' );
	$wpspeed_lbs_straddress = get_option( 'wpsp_lbs_straddress' );
	$wpspeed_lbs_city = get_option( 'wpsp_lbs_city' );
	$wpspeed_lbs_state = get_option( 'wpsp_lbs_state' );
	$wpspeed_lbs_postal = get_option( 'wpsp_lbs_postal' );
	$wpspeed_lbs_image = get_option( 'wpsp_lbs_image' );
	$wpspeed_lbs_phone = get_option( 'wpsp_lbs_phone' );
	$wpspeed_lbs_url = get_option( 'wpsp_lbs_url' );
	$wpspeed_lbs_active = get_option( 'wpsp_lbs_active' );
?>

<div class="wrap" style="padding: 10px;">

<div class="box-region-middle">

<div class="box-wpspgrpro" style="background-color: #34407d!important;">
<h2 align="center" style="color: #fff!important; padding-top: 15px;">LOCAL BUSINESS SCHEMA:</h2>
</div>

<div class="box-wpspgrpro">
<p><img src="<?php echo plugins_url( '/images/banner-772x250.jpg', __FILE__ ); ?>" width="100%" align="center" /></p>
</div>
	<?php
	wp_register_style('wpsplocalbusiness', plugins_url('/css/wpspeed-localbusiness-schema.css', __FILE__ ), false, '1.0', 'all');
	wp_print_styles(array('wpsplocalbusiness', 'wpsplocalbusiness'));
	?>
<hr/>
<form method="post" action="options.php">
    <?php settings_fields( 'wpspeed_localbusiness_settings_group' ); ?>
    <?php do_settings_sections( 'wpspeed_localbusiness_settings_group' ); ?>	
<div class="box-wpspgrpro">
<h3>Free Version Options</h3>
<table class="form-table">
<tr>		
<th scope="row" style="width: 40%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Business Name', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_name" style="width:100%;" value="<?php echo $wpspeed_lbs_name; ?>" placeholder="<?php _e('Enter Your Business Name', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 40%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Street Address', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_straddress" style="width:100%;" value="<?php echo $wpspeed_lbs_straddress; ?>" placeholder="<?php _e('Enter Street Address', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 40%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('City', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_city" style="width:100%;" value="<?php echo $wpspeed_lbs_city; ?>" placeholder="<?php _e('Enter Your City', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 40%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('State', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_state" style="width:100%;" value="<?php echo $wpspeed_lbs_state; ?>" placeholder="<?php _e('Enter Your State', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 40%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Postal Code', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_postal" style="width:100%;" value="<?php echo $wpspeed_lbs_postal; ?>" placeholder="<?php _e('Enter Your Postal Code', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 40%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Phone', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_phone" style="width:100%;" value="<?php echo $wpspeed_lbs_phone; ?>" placeholder="<?php _e('ex. 555-555-5555', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 40%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('URL', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_url" style="width:100%;" value="<?php echo $wpspeed_lbs_url; ?>" placeholder="<?php _e('Website URL', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 40%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Image', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_image" style="width:100%;" value="<?php echo $wpspeed_lbs_image; ?>" placeholder="<?php _e('Enter Image Url', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 10%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"></th><td><b><?php _e('Min Size: 160Χ90px  Max Size: 1920X1080px', 'wpspeed-lbs') ?></b><br/><?php _e('The image will probably be cropped square from the top for some items', 'wpspeed-lbs') ?></td>		
</tr>
<tr>
<th scope="row" style="width: 40%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4; color: red;"><b><?php _e('ACTIVATE', 'wpspeed-lbs') ?></b></th><td><input name="wpsp_lbs_active" type="checkbox" value="1" <?php checked( '1', get_option( 'wpsp_lbs_active' ) ); ?> /></td>
</tr>
</table>		
</div>    
    <?php submit_button(); ?>
</form>
</div>



<div class="box-region-right">

<div class="box-wpspgrpro" style="background-color: #34407d!important;">
<table>
<tr>
<td><h3 style="color: #fff!important;">Do you Like the FREE Version?</h3>
<li style="color: #fff!important;">Give Us a <strong style="color: #fff995!important;">5 Star</strong> <a style="color: #fff!important; text-decoration: underline;" target="_blank" href="https://wordpress.org/support/plugin/wpspeed-localbusiness-schema/reviews/?rate=5#new-post">Review.</a></li>
</td>
</tr>
</table>
</div>


<div class="box-wpspgrpro">
<h4 style="text-decoration: underline;">Free Version Info</h4>
<table>
<tr>
<td>
<li>Easily Add <b>JSON-LD</b> LocalBusiness Structured Data on your Website</li>
<li>Use All Fields to Provide a Complete Business Information</li>
</td>
</tr>
</table>
</div>		
	

<div class="box-wpspgrpro">
<h4 style="text-decoration: underline;">About Us</h4>
<table>
<tr>
<td>
<p align="center">You Need Help for Your Website?
Check Out Our Services</p>
<p align="center"><a target="_blank" href="https://lvdynamic.com">Lumiverse Dynamic</a></li>
</td>
</tr>
</table>
</div>


<div class="box-wpspgrpro">
<h4 style="text-decoration: underline;">Useful Info</h4>
<table>
<tr>
<td>
<li><a target="_blank" href="https://search.google.com/structured-data/testing-tool?hl=en">STRUCTURED DATA TESTING TOOL</a></li>
<li><a target="_blank" href="https://developers.google.com/search/docs/guides/intro-structured-data">INTRODUCTION TO STRUCTURED DATA</a></li>
</td>
</tr>
</table>
</div>	


</div>
</div>
<?php }
   

 
function wpspeed_lbs_create_code () {
	
	$wpspeed_lbs_name = get_option( 'wpsp_lbs_name' );
	$wpspeed_lbs_straddress = get_option( 'wpsp_lbs_straddress' );
	$wpspeed_lbs_city = get_option( 'wpsp_lbs_city' );
	$wpspeed_lbs_state = get_option( 'wpsp_lbs_state' );
	$wpspeed_lbs_postal = get_option( 'wpsp_lbs_postal' );
	$wpspeed_lbs_image = get_option( 'wpsp_lbs_image' );
	$wpspeed_lbs_phone = get_option( 'wpsp_lbs_phone' );
	$wpspeed_lbs_url = get_option( 'wpsp_lbs_url' );
	
	$wpspeed_final_LBS = '';
	$wpspeed_final_LBS .= '<script type="application/ld+json">'. PHP_EOL;
	$wpspeed_final_LBS .= '{' . PHP_EOL;
	$wpspeed_final_LBS .= '"@context": "http://schema.org",' . PHP_EOL;
	$wpspeed_final_LBS .= '"@type": "LocalBusiness",' . PHP_EOL;
	$wpspeed_final_LBS .= '"name": "' . $wpspeed_lbs_name . '",' . PHP_EOL;
	$wpspeed_final_LBS .= '"address": {' . PHP_EOL;
	$wpspeed_final_LBS .= '"@type": "PostalAddress",' . PHP_EOL;
	$wpspeed_final_LBS .= '"streetAddress": "' . $wpspeed_lbs_straddress . '",' . PHP_EOL;
	$wpspeed_final_LBS .= '"addressLocality": "' . $wpspeed_lbs_city . '",' . PHP_EOL;
	$wpspeed_final_LBS .= '"addressRegion": "' . $wpspeed_lbs_state . '",' . PHP_EOL;
	$wpspeed_final_LBS .= '"postalCode": "' . $wpspeed_lbs_postal . '"' . PHP_EOL;
	$wpspeed_final_LBS .= '},' . PHP_EOL;
	$wpspeed_final_LBS .= '"image": "' . $wpspeed_lbs_image . '",' . PHP_EOL;
	$wpspeed_final_LBS .= '"telePhone": "' . $wpspeed_lbs_phone . '",' . PHP_EOL;
	$wpspeed_final_LBS .= '"url": "' . $wpspeed_lbs_url . '"' . PHP_EOL;
	$wpspeed_final_LBS .= '}' . PHP_EOL;
	$wpspeed_final_LBS .= '</script>' . PHP_EOL;
	return $wpspeed_final_LBS;
}	

function wpspeed_localbusiness_add_code() {
	$wpspeed_final_LBS = wpspeed_lbs_create_code ();
	echo $wpspeed_final_LBS;
  }

// Do we need the Code ?  
$wpspeed_lbs_active = get_option( 'wpsp_lbs_active' );  
if ( $wpspeed_lbs_active == 1 ) {
// Yes! ... Then Go Live !
add_action( 'wp_head', 'wpspeed_localbusiness_add_code' );
}
?>