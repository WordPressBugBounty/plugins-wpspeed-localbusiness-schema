<?php
/*
Plugin Name: Local Business Schema Lite
Plugin URI: https://lvdynamic.com/
Description: Easily add structured Local Business Schema (JSON-LD) to your website — improve your visibility on Google, attract more local customers, and enhance your search rankings. No coding needed. Fast, simple, and effective!
Version: 3.0.0
Author: Lumiverse Dynamic
License: GPLv2 or later
*/

// DO NOT ALLOW DIRECT ACCESS
if ( !defined( 'ABSPATH' ) ) exit;

define( 'WPSPEED_LOCALBUSINESS_PATH', plugin_dir_path( __FILE__ ) );					// Defining plugin dir path
define( 'WPSPEED_LOCALBUSINESS_VERSION', 'v3.0.0');										// Defining plugin version
define( 'WPSPEED_LOCALBUSINESS_NAME', 'Local Business Schema Lite');		// Defining plugin name

/**
 * Create Settings Page
 */

// Create Settings Menu
add_action('admin_menu', 'wpspeed_localbusiness_create_menu');

function wpspeed_localbusiness_create_menu() {

    add_menu_page('LB Schema JSON', 'LB Schema JSON', 'administrator', __FILE__, 'wpspeed_localbusiness_settings_page' , plugins_url('/images/wps-localbusiness.png', __FILE__) );	
	add_action( 'admin_init', 'register_wpspeed_localbusiness_settings' );
	
}

function register_wpspeed_localbusiness_settings() {
	// Register Plugin Settings
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_businesstype' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_name' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_straddress' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_city' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_state' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_addresscountry' );	
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_postal' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_image' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_phone' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_url' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_map' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_pricerange1' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_pricerange' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_active' );
		register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_geo' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_lat' );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_lon' );
}

function wpspeed_localbusiness_settings_page() {
	$wpspeed_lbs_name = get_option( 'wpsp_lbs_name' );
	$wpspeed_lbs_straddress = get_option( 'wpsp_lbs_straddress' );
	$wpspeed_lbs_city = get_option( 'wpsp_lbs_city' );
	$wpspeed_lbs_state = get_option( 'wpsp_lbs_state' );
	$wpspeed_lbs_postal = get_option( 'wpsp_lbs_postal' );
	$wpspeed_lbs_addresscountry = get_option( 'wpsp_lbs_addresscountry' );
	$wpspeed_lbs_image = get_option( 'wpsp_lbs_image' );
	$wpspeed_lbs_phone = get_option( 'wpsp_lbs_phone' );
	$wpspeed_lcseo_pricerange = get_option( 'wpsp_lcseo_pricerange' );
	$wpspeed_lcseo_pricerange1 = get_option( 'wpsp_lcseo_pricerange1' );
	$wpspeed_lbs_url = get_option( 'wpsp_lbs_url' );
	$wpspeed_lbs_map = get_option( 'wpsp_lbs_map' );
	$wpspeed_lbs_active = get_option( 'wpsp_lbs_active' );
	$wpspeed_lcseo_geo = get_option( 'wpsp_lcseo_geo' );
	$wpspeed_lcseo_lat = get_option( 'wpsp_lcseo_lat' );
	$wpspeed_lcseo_lon = get_option( 'wpsp_lcseo_lon' );
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
	wp_register_style('wpsplocalbusiness', plugins_url('/css/wpspeed-localbusiness-schema.css', __FILE__ ), false, '3.1', 'all');
	wp_print_styles(array('wpsplocalbusiness', 'wpsplocalbusiness'));
	?>
<hr/>
<form method="post" action="options.php">
    <?php settings_fields( 'wpspeed_localbusiness_settings_group' ); ?>
    <?php do_settings_sections( 'wpspeed_localbusiness_settings_group' ); ?>	
<div class="box-wpspgrpro">
<div style="background-color:#0029ae!important;width:100%; padding:5px;">    
<h3 style="color:white!important;">Lumiverse LocalBusiness Schema Lite</h3>
</div>
<table class="form-table wpspeed-lbs-table">
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;">
<?php _e('Your Local Business', 'wpspeed-lbs') ?></th>
<td>		
<?php $wplbsthetype = get_option( 'wpsp_lcseo_businesstype' ); ?>
			<select name="wpsp_lcseo_businesstype">
			<option value="LocalBusiness" <?php if ( $wplbsthetype == 'LocalBusiness') { ?>selected <?php } ?>>Local Business</option>
             <option value="Corporation" <?php if ( $wplbsthetype == 'Corporation') { ?>selected <?php } ?>>Corporation</option>
            <option value="Store" <?php if ( $wplbsthetype == 'Store') { ?>selected <?php } ?>>Store</option>
            <option value="ProfessionalService" <?php if ( $wplbsthetype == 'ProfessionalService') { ?>selected <?php } ?>>ProfessionalService</option>
			</select>
</td>
</tr>
<tr>
<th scope="row" style="width: 30%;">-</th><td style="background-color:#f2f2f2;">🔓 <strong>Unlock 110+ business types</strong> with the <strong>PRO version</strong>. Ideal for any business or organization!</td>
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Business Name', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_name" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_name; ?>" placeholder="<?php _e('Enter Your Business Name', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Street Address', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_straddress" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_straddress; ?>" placeholder="<?php _e('Enter Street Address', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('City', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_city" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_city; ?>" placeholder="<?php _e('Enter Your City', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('State', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_state" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_state; ?>" placeholder="<?php _e('Enter Your State', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('AddressCountry', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_addresscountry" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_addresscountry; ?>" placeholder="<?php _e('Enter Your AddressCountry', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Postal Code', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_postal" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_postal; ?>" placeholder="<?php _e('Enter Your Postal Code', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Phone', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_phone" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_phone; ?>" placeholder="<?php _e('ex. 555-555-5555', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>
<th scope="row" style="width: 30%;">-</th><td style="background-color:#f2f2f2;">💡 Did you know? Filling out your full business details helps Google display rich results and increases trust with local customers!<br/><strong>Unlock a second location with the PRO version. Perfect for multi-location businesses!</strong></td>
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('URL', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_url" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_url; ?>" placeholder="<?php _e('Website URL', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Image', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_image" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_image; ?>" placeholder="<?php _e('Enter Image Url', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>		
<th scope="row" style="width: 10%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"></th><td><b><?php _e('Min Size: 160Χ90px  Max Size: 1920X1080px', 'wpspeed-lbs') ?></b><br/><?php _e('The image will probably be cropped square from the top for some items', 'wpspeed-lbs') ?></td>		
</tr>
<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;">

<div class="switch">
			<input id="wpsp_lcseo_geo" name="wpsp_lcseo_geo" class="cmn-toggle cmn-toggle-round" type="checkbox" value="1" <?php checked( '1', get_option( 'wpsp_lcseo_geo' ) ); ?> />
			<label for="wpsp_lcseo_geo"></label>
</div>

<?php _e('GeoCoordinates', 'wpspeed-lbs') ?></th>
<td width="50%">
<input type="text" name="wpsp_lcseo_lat" class="wpspeed-lbs-input" style="width:50%;" value="<?php echo $wpspeed_lcseo_lat; ?>" placeholder="<?php _e('Latitude', 'wpspeed-lbs')?> ex. XX.XXXX">	
<input type="text" name="wpsp_lcseo_lon" class="wpspeed-lbs-input" style="width:50%;" value="<?php echo $wpspeed_lcseo_lon; ?>" placeholder="<?php _e('Longitude', 'wpspeed-lbs')?> ex. XX.XXXX">
</td>
</tr>
<tr>
<th scope="row" style="width: 30%;">-</th><td style="background-color:#f2f2f2;">💡 Did you know? Adding geo coordinates can increase visibility in Google Maps results!</td>
</tr>

<tr>		
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;"><?php _e('Map', 'wpspeed-lbs') ?></th><td><input type="text" name="wpsp_lbs_map" class="wpspeed-lbs-input" value="<?php echo $wpspeed_lbs_map; ?>" placeholder="<?php _e('Enter Map Url', 'wpspeed-lbs')?>"></td>		
</tr>
<tr>
<th scope="row" style="width: 30%;">-</th><td style="background-color:#f2f2f2;">💡 Make it effortless for customers to get directions—adding your Google Maps link provides a one-click path to your doorstep.</td>
</tr>
	
<tr>
<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4;">

<div class="switch">
			<input id="wpsp_lcseo_pricerange1" name="wpsp_lcseo_pricerange1" class="cmn-toggle cmn-toggle-round" type="checkbox" value="1" <?php checked( '1', get_option( 'wpsp_lcseo_pricerange1' ) ); ?> />
			<label for="wpsp_lcseo_pricerange1"></label>
</div>

<?php _e('Price Range', 'wpspeed-lbs') ?></th>
<td>		
			<select name="wpsp_lcseo_pricerange">
			 <option value="$" <?php if ( $wpspeed_lcseo_pricerange == '$') { ?>selected <?php } ?>>$</option>
			 <option value="$$" <?php if ( $wpspeed_lcseo_pricerange == '$$') { ?>selected <?php } ?>>$$</option>
			 <option value="$$$" <?php if ( $wpspeed_lcseo_pricerange == '$$$') { ?>selected <?php } ?>>$$$</option>
			 <option value="$$$$" <?php if ( $wpspeed_lcseo_pricerange == '$$$$') { ?>selected <?php } ?>>$$$$</option>
			 <option value="$$$$$" <?php if ( $wpspeed_lcseo_pricerange == '$$$$$') { ?>selected <?php } ?>>$$$$$</option>
			</select>
</td>
</tr>
<tr>
<th scope="row" style="width: 30%;">-</th><td style="background-color:#f2f2f2;">💡 Did you know? Adding a pricing range gives visitors an instant idea of what to expect — and helps Google show more accurate business info!</td>
</tr>

<tr style="background-color:#0029ae; color:white; width:100%;">		
<th scope="row" style="padding-left:10px; width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4; color:white;"><strong><?php _e('Are You Ready?', 'wpspeed-lbs') ?></strong></th>		
</tr>

<th scope="row" style="width: 30%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: #f4f4f4; color: red;">

<div class="switch">
			<input id="wpsp_lbs_active" name="wpsp_lbs_active" class="cmn-toggle1 cmn-toggle1-round" type="checkbox" value="1" <?php checked( '1', get_option( 'wpsp_lbs_active' ) ); ?> />
			<label for="wpsp_lbs_active"></label>
</div>
</th>
<td><b><?php _e('OK, Activate JSON-LD Schema on Your Website', 'wpspeed-lbs') ?></b></td>


</table>		
</div>    
    <?php submit_button(); ?>
</form>
</div>



<div class="box-region-right">




<div class="wpspeed-lbs-sidebar">
    <h3>🚀 Unlock Pro Power</h3>
    <p>Supercharge your local SEO and provide richer information to customers with the Pro version.</p>

    <ul>
        <li><strong>110+ Specific Business Types</strong> (Not just 4)</li>
        <li><strong>Advanced Opening Hours</strong></li>
        <li><strong>Second Location/Branch</strong> support</li>
        <li>Acceptance of <strong>Multiple Payment Methods</strong></li>
        <li><strong>WooCommerce Product & Breadcrumb</strong> Schema</li>
        <li><strong>Priority Support</strong> and future updates</li>
    </ul>

    <div class="wpspeed-lbs-cta">
        <p><strong>Love the Lite version?</strong><br>Upgrading to a <strong>lifetime license</strong> directly supports our development team, helping us keep this core plugin free and powerful for everyone.</p>
        <a href="https://store.lvdynamic.com/product/local-business-schema-pro" class="button button-primary button-large" target="_blank" rel="noopener">Upgrade to LocalBusiness Schema Pro</a>
    </div>
</div>

<div class="box-wpspgrpro" style="background-color: #34407d!important;">
<table>
<tr>
<td><h3 style="color: #fff!important;">Do you Like the FREE Version?</h3>
<li style="color: #fff!important;">Give Us a <strong style="color: #fff995!important;">5 Star</strong> <a style="color: #fff!important; text-decoration: underline;" target="_blank" href="https://wordpress.org/support/plugin/wpspeed-localbusiness-schema/reviews/?rate=5#new-post">Review.</a></li>
</td>
</tr>
</table>
</div>


<div class="wpspeed-lbs-sidebar">
    <h3>Free Version Info</h3>
    <p>Supercharge your local SEO and provide richer information to customers with the Pro version.</p>

    <ul>
        <li>Easily Add <b>JSON-LD</b> LocalBusiness Structured Data on your Website.</li>
<li>Use All Fields to Provide a Complete Business Information.</li>
<li>In Address Details Section, Empty Fields will be ignored.</li>
<li>AddressCountry Field: Use the two-letter ISO 3166-1 country code (e.g., US for United States, GB for United Kingdom, FR for France).</li>
    </ul>

</div>


	
	

	

<div class="box-wpspgrpro">
<h4 style="text-decoration: underline;">Need Expert Help With Your Website?</h4>
<table>
<tr>
<td>
<p>
🚨 Fix Accessibility (WCAG) Issues<br/>
Boost compliance, avoid legal risk, and make your site accessible to everyone.
<br/><br/>
🛠️ Fully Managed WordPress Care. We handle everything<br/>
✓ Monthly Updates<br/>
✓ Speed Optimization<br/>
✓ Security & Malware Scanning<br/>
✓ 24/7 Monitoring<br/>
✓ Free Malware Removal<br/>
<br/><br/>
🎨 Custom Web Design<br/>
Modern, fast, and responsive websites built to convert.    
</p>    
	<p><a target="_blank" href="https://lumiverse.gr">We Would Love to Hear From You!</a></p>
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
<li><a target="_blank" href="https://www.latlong.net">Find Latitude & Longitude</a></li>
</td>
</tr>
</table>
</div>	


</div>

<?php }
   
function wpspeed_lbs_create_code() {
    // Retrieve options with sanitization
    $wplbsthetype = get_option( 'wpsp_lcseo_businesstype' );
    $wpspeed_lbs_name = get_option( 'wpsp_lbs_name' );
    $wpspeed_lbs_straddress = get_option( 'wpsp_lbs_straddress' );
    $wpspeed_lbs_city = get_option( 'wpsp_lbs_city' );
    $wpspeed_lbs_state = get_option( 'wpsp_lbs_state' );
    $wpspeed_lbs_postal = get_option( 'wpsp_lbs_postal' );
    $wpspeed_lbs_addresscountry = get_option( 'wpsp_lbs_addresscountry' );
    $wpspeed_lbs_image = get_option( 'wpsp_lbs_image' );
    $wpspeed_lbs_phone = get_option( 'wpsp_lbs_phone' );
    $wpspeed_lbs_map = get_option( 'wpsp_lbs_map' ); // NEW MAP URL FIELD
    $wpspeed_lcseo_pricerange = get_option( 'wpsp_lcseo_pricerange' );
    $wpspeed_lcseo_pricerange1 = get_option( 'wpsp_lcseo_pricerange1' );
    $wpspeed_lbs_url = get_option( 'wpsp_lbs_url' );
    $wpspeed_lcseo_geo = get_option( 'wpsp_lcseo_geo' );
    $wpspeed_lcseo_lat = get_option( 'wpsp_lcseo_lat' );
    $wpspeed_lcseo_lon = get_option( 'wpsp_lcseo_lon' );

    // Start building the schema properties array
    $schema_properties = array();

    // Set default type if empty
    if ( empty( $wplbsthetype ) ) {
        $wplbsthetype = 'LocalBusiness';
    }
    $schema_properties['@context'] = '"@context": "https://schema.org"';
    $schema_properties['@type']    = '"@type": "' . esc_attr( $wplbsthetype ) . '"';

    // Add name if it exists
    if ( ! empty( $wpspeed_lbs_name ) ) {
        $schema_properties['name'] = '"name": "' . esc_attr( $wpspeed_lbs_name ) . '"';
    }

    // Build the address array only if at least one field is filled
    $address_properties = array();
    if ( ! empty( $wpspeed_lbs_straddress ) ) {
        $address_properties['streetAddress'] = '"streetAddress": "' . esc_attr( $wpspeed_lbs_straddress ) . '"';
    }
    if ( ! empty( $wpspeed_lbs_city ) ) {
        $address_properties['addressLocality'] = '"addressLocality": "' . esc_attr( $wpspeed_lbs_city ) . '"';
    }
    if ( ! empty( $wpspeed_lbs_state ) ) {
        $address_properties['addressRegion'] = '"addressRegion": "' . esc_attr( $wpspeed_lbs_state ) . '"';
    }
    if ( ! empty( $wpspeed_lbs_postal ) ) {
        $address_properties['postalCode'] = '"postalCode": "' . esc_attr( $wpspeed_lbs_postal ) . '"';
    }
    // Add addressCountry to the address properties
    if ( ! empty( $wpspeed_lbs_addresscountry ) ) {
        $address_properties['addressCountry'] = '"addressCountry": "' . esc_attr( $wpspeed_lbs_addresscountry ) . '"';
    }

    // If we have any address details, add the full address object
    if ( ! empty( $address_properties ) ) {
        // Prepend the required @type to the address properties array
        $full_address = array( '"@type": "PostalAddress"' );
        $full_address = array_merge( $full_address, array_values( $address_properties ) );
        // Format the address object correctly
        $schema_properties['address'] = '"address": {' . PHP_EOL . '    ' . implode( ',' . PHP_EOL . '    ', $full_address ) . PHP_EOL . '  }';
    }

    // Add Geo Coordinates if enabled and values exist
    if ( $wpspeed_lcseo_geo == 1 && ! empty( $wpspeed_lcseo_lat ) && ! empty( $wpspeed_lcseo_lon ) ) {
        $geo_coordinates = array(
            '"@type": "GeoCoordinates"',
            '"latitude": "' . esc_attr( $wpspeed_lcseo_lat ) . '"',
            '"longitude": "' . esc_attr( $wpspeed_lcseo_lon ) . '"'
        );
        $schema_properties['geo'] = '"geo": {' . PHP_EOL . '    ' . implode( ',' . PHP_EOL . '    ', $geo_coordinates ) . PHP_EOL . '  }';
    }

    // Add Price Range if enabled and value exists
    if ( $wpspeed_lcseo_pricerange1 == 1 && ! empty( $wpspeed_lcseo_pricerange ) ) {
        $schema_properties['priceRange'] = '"priceRange": "' . esc_attr( $wpspeed_lcseo_pricerange ) . '"';
    }

    // Add Image if it exists
    if ( ! empty( $wpspeed_lbs_image ) ) {
        $schema_properties['image'] = '"image": "' . esc_url( $wpspeed_lbs_image ) . '"'; // Use esc_url for URLs
    }

    // Add Telephone if it exists (CORRECTED property name)
    if ( ! empty( $wpspeed_lbs_phone ) ) {
        $schema_properties['telephone'] = '"telephone": "' . esc_attr( $wpspeed_lbs_phone ) . '"';
    }

    // NEW: Add Google Maps URL if it exists (using the hasMap property)
    if ( ! empty( $wpspeed_lbs_map ) ) {
        $schema_properties['hasMap'] = '"hasMap": "' . esc_url( $wpspeed_lbs_map ) . '"';
    }

    // Add URL if it exists
    if ( ! empty( $wpspeed_lbs_url ) ) {
        $schema_properties['url'] = '"url": "' . esc_url( $wpspeed_lbs_url ) . '"'; // Use esc_url for URLs
    }

    // If no properties were filled out, return nothing to avoid invalid schema.
    if ( count( $schema_properties ) < 3 ) { // Less than 3 means only @context and @type might be set, with no actual data.
        return '';
    }

    // Build the final JSON-LD script
    $wpspeed_final_LBS  = '<!-- START LocalBusiness Schema by Lumiverse -->' . PHP_EOL;
    $wpspeed_final_LBS .= '<script type="application/ld+json">' . PHP_EOL;
    $wpspeed_final_LBS .= '{' . PHP_EOL;
    $wpspeed_final_LBS .= '  ' . implode( ',' . PHP_EOL . '  ', $schema_properties ) . PHP_EOL;
    $wpspeed_final_LBS .= '}' . PHP_EOL;
    $wpspeed_final_LBS .= '</script>' . PHP_EOL;
    $wpspeed_final_LBS .= '<!-- END LocalBusiness Schema by Lumiverse -->' . PHP_EOL;

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

// Hook to display the admin notice
add_action('admin_notices', 'show_pro_version_notification_jsonld');

function show_pro_version_notification_jsonld() {
    // Check if the current user can install plugins
    if (!current_user_can('install_plugins')) {
        return;
    }

    // Check if the notification was dismissed
    $dismissed_until = get_option('pro_version_notification_jsonld_dismissed_until');
    if ($dismissed_until && current_time('timestamp') < $dismissed_until) {
        return;
    }

    // Display the notice
    ?>
    <div class="notice notice-info is-dismissible" id="pro-version-notification-jsonld">
        <p><strong>Welcome to the New Version of Lumiverse LocalBusiness Schema!</strong><br/>
New in this release:<br/>
– ✅ Business Type Selection<br/>
– 📍 AddressCountry Field<br/>
– * Google Map Link<br/>			
– # Code Security Updates</p>
            <p><?php esc_html_e('The PRO version of LocalBusiness JSON Schema is now available with advanced features to supercharge your website\'s SEO!', 'wpspeed-localbusiness-schema'); ?>
        </p>
        <p>
            <a href="https://store.lvdynamic.com/product/local-business-schema-pro/" target="_blank" class="button button-primary">
                <?php esc_html_e('Learn More and Upgrade', 'wpspeed-localbusiness-schema'); ?>
            </a>
        </p>
    </div>
    <script type="text/javascript">
        (function($) {
            $('#pro-version-notification-jsonld').on('click', '.notice-dismiss', function() {
                $.post(ajaxurl, {
                    action: 'dismiss_pro_version_notification_jsonld'
                });
            });
        })(jQuery);
    </script>
    <?php
}

// Handle the dismissal of the notification
add_action('wp_ajax_dismiss_pro_version_notification_jsonld', 'dismiss_pro_version_notification_jsonld');

function dismiss_pro_version_notification_jsonld() {
    // Set the dismissal period (20 days in seconds)
    $dismiss_period = 20 * DAY_IN_SECONDS;
    update_option('pro_version_notification_jsonld_dismissed_until', current_time('timestamp') + $dismiss_period);

    wp_die(); // Terminate to return a proper response
}