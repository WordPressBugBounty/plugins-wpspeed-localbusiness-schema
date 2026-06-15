<?php
/*
Plugin Name: Local Business Schema Lite
Plugin URI: https://lvdynamic.com/
Description: Add clean Local Business Schema JSON-LD to your WordPress website and help search engines better understand your business information. No coding needed.
Version: 3.3.2
Author: Lumiverse Dynamic
License: GPLv2 or later
*/

// Do not allow direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WPSPEED_LOCALBUSINESS_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPSPEED_LOCALBUSINESS_VERSION', '3.3.2' );
define( 'WPSPEED_LOCALBUSINESS_NAME', 'Local Business Schema Lite' );
define( 'WPSPEED_LBS_PRO_URL', 'https://store.lvdynamic.com/product/local-business-schema-pro/' );
define( 'WPSPEED_LBS_PRO_COUPON', 'LUMIVERSE30' );

/**
 * Allowed business types for the Lite version.
 * More specific business types remain available in PRO.
 *
 * @return array
 */
function wpspeed_lbs_allowed_business_types() {
	return array(
		'LocalBusiness'       => __( 'Local Business', 'wpspeed-lbs' ),
		'Corporation'         => __( 'Corporation', 'wpspeed-lbs' ),
		'Store'               => __( 'Store', 'wpspeed-lbs' ),
		'ProfessionalService' => __( 'Professional Service', 'wpspeed-lbs' ),
	);
}

/**
 * Sanitize the selected business type.
 *
 * @param string $value Selected value.
 * @return string
 */
function wpspeed_lbs_sanitize_business_type( $value ) {
	$value   = sanitize_text_field( $value );
	$allowed = array_keys( wpspeed_lbs_allowed_business_types() );

	return in_array( $value, $allowed, true ) ? $value : 'LocalBusiness';
}

/**
 * Sanitize checkbox values.
 *
 * @param mixed $value Checkbox value.
 * @return string
 */
function wpspeed_lbs_sanitize_checkbox( $value ) {
	return ( '1' === (string) $value ) ? '1' : '';
}

/**
 * Sanitize price range.
 *
 * @param string $value Selected price range.
 * @return string
 */
function wpspeed_lbs_sanitize_price_range( $value ) {
	$value   = sanitize_text_field( $value );
	$allowed = array( '$', '$$', '$$$', '$$$$', '$$$$$' );

	return in_array( $value, $allowed, true ) ? $value : '$';
}

/**
 * Sanitize latitude/longitude text.
 * Allows numeric coordinates, minus sign and decimal separator.
 *
 * @param string $value Coordinate value.
 * @return string
 */
function wpspeed_lbs_sanitize_coordinate( $value ) {
	$value = trim( (string) $value );
	$value = str_replace( ',', '.', $value );
	$value = preg_replace( '/[^0-9\.\-]/', '', $value );

	return sanitize_text_field( $value );
}

/**
 * Sanitize output location.
 *
 * @param string $value Value.
 * @return string
 */
function wpspeed_lbs_sanitize_output_location( $value ) {
	$value   = sanitize_key( $value );
	$allowed = array( 'sitewide', 'homepage' );

	return in_array( $value, $allowed, true ) ? $value : 'sitewide';
}

/**
 * Register settings.
 */
function register_wpspeed_localbusiness_settings() {
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_businesstype', array( 'sanitize_callback' => 'wpspeed_lbs_sanitize_business_type' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_name', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_description', array( 'sanitize_callback' => 'sanitize_textarea_field' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_straddress', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_city', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_state', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_addresscountry', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_postal', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_image', array( 'sanitize_callback' => 'esc_url_raw' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_logo', array( 'sanitize_callback' => 'esc_url_raw' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_phone', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_email', array( 'sanitize_callback' => 'sanitize_email' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_url', array( 'sanitize_callback' => 'esc_url_raw' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_map', array( 'sanitize_callback' => 'esc_url_raw' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_area_served', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_facebook', array( 'sanitize_callback' => 'esc_url_raw' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_instagram', array( 'sanitize_callback' => 'esc_url_raw' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_pricerange1', array( 'sanitize_callback' => 'wpspeed_lbs_sanitize_checkbox' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_pricerange', array( 'sanitize_callback' => 'wpspeed_lbs_sanitize_price_range' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_active', array( 'sanitize_callback' => 'wpspeed_lbs_sanitize_checkbox' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lbs_output_location', array( 'sanitize_callback' => 'wpspeed_lbs_sanitize_output_location' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_geo', array( 'sanitize_callback' => 'wpspeed_lbs_sanitize_checkbox' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_lat', array( 'sanitize_callback' => 'wpspeed_lbs_sanitize_coordinate' ) );
	register_setting( 'wpspeed_localbusiness_settings_group', 'wpsp_lcseo_lon', array( 'sanitize_callback' => 'wpspeed_lbs_sanitize_coordinate' ) );
}
add_action( 'admin_init', 'register_wpspeed_localbusiness_settings' );

/**
 * Create settings menu.
 */
function wpspeed_localbusiness_create_menu() {
	global $wpspeed_lbs_admin_page_hook;

	$wpspeed_lbs_admin_page_hook = add_menu_page(
		'LB Schema JSON',
		'LB Schema JSON',
		'administrator',
		__FILE__,
		'wpspeed_localbusiness_settings_page',
		plugins_url( '/images/wps-localbusiness.png', __FILE__ )
	);
}
add_action( 'admin_menu', 'wpspeed_localbusiness_create_menu' );

/**
 * Load admin assets only on this plugin settings page.
 *
 * @param string $hook Current admin hook.
 */
function wpspeed_lbs_admin_assets( $hook ) {
	global $wpspeed_lbs_admin_page_hook;

	if ( empty( $wpspeed_lbs_admin_page_hook ) || $hook !== $wpspeed_lbs_admin_page_hook ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_style( 'wpsplocalbusiness', plugins_url( '/css/wpspeed-localbusiness-schema.css', __FILE__ ), array(), WPSPEED_LOCALBUSINESS_VERSION, 'all' );
}
add_action( 'admin_enqueue_scripts', 'wpspeed_lbs_admin_assets' );

/**
 * Get an option as a string.
 *
 * @param string $name Option name.
 * @param string $default Default value.
 * @return string
 */
function wpspeed_lbs_get_option( $name, $default = '' ) {
	$value = get_option( $name, $default );

	return is_string( $value ) ? $value : $default;
}

/**
 * Build the schema as a PHP array.
 *
 * @return array
 */
function wpspeed_lbs_build_schema_array() {
	$business_type   = wpspeed_lbs_sanitize_business_type( wpspeed_lbs_get_option( 'wpsp_lcseo_businesstype', 'LocalBusiness' ) );
	$name            = wpspeed_lbs_get_option( 'wpsp_lbs_name' );
	$description     = wpspeed_lbs_get_option( 'wpsp_lbs_description' );
	$street_address  = wpspeed_lbs_get_option( 'wpsp_lbs_straddress' );
	$city            = wpspeed_lbs_get_option( 'wpsp_lbs_city' );
	$state           = wpspeed_lbs_get_option( 'wpsp_lbs_state' );
	$postal_code     = wpspeed_lbs_get_option( 'wpsp_lbs_postal' );
	$address_country = wpspeed_lbs_get_option( 'wpsp_lbs_addresscountry' );
	$image           = wpspeed_lbs_get_option( 'wpsp_lbs_image' );
	$logo            = wpspeed_lbs_get_option( 'wpsp_lbs_logo' );
	$phone           = wpspeed_lbs_get_option( 'wpsp_lbs_phone' );
	$email           = wpspeed_lbs_get_option( 'wpsp_lbs_email' );
	$url             = wpspeed_lbs_get_option( 'wpsp_lbs_url' );
	$map             = wpspeed_lbs_get_option( 'wpsp_lbs_map' );
	$area_served     = wpspeed_lbs_get_option( 'wpsp_lbs_area_served' );
	$facebook        = wpspeed_lbs_get_option( 'wpsp_lbs_facebook' );
	$instagram       = wpspeed_lbs_get_option( 'wpsp_lbs_instagram' );
	$geo_enabled     = wpspeed_lbs_get_option( 'wpsp_lcseo_geo' );
	$latitude        = wpspeed_lbs_get_option( 'wpsp_lcseo_lat' );
	$longitude       = wpspeed_lbs_get_option( 'wpsp_lcseo_lon' );
	$price_enabled   = wpspeed_lbs_get_option( 'wpsp_lcseo_pricerange1' );
	$price_range     = wpspeed_lbs_get_option( 'wpsp_lcseo_pricerange', '$' );

	$schema = array(
		'@context' => 'https://schema.org',
		'@type'    => $business_type,
	);

	if ( '' !== $name ) {
		$schema['name'] = $name;
	}

	if ( '' !== $description ) {
		$schema['description'] = $description;
	}

	if ( '' !== $url ) {
		$schema['url'] = esc_url_raw( $url );
	}

	if ( '' !== $phone ) {
		$schema['telephone'] = $phone;
	}

	if ( '' !== $email && is_email( $email ) ) {
		$schema['email'] = $email;
	}

	if ( '' !== $image ) {
		$schema['image'] = esc_url_raw( $image );
	}

	if ( '' !== $logo ) {
		$schema['logo'] = esc_url_raw( $logo );
	}

	$address = array( '@type' => 'PostalAddress' );
	if ( '' !== $street_address ) {
		$address['streetAddress'] = $street_address;
	}
	if ( '' !== $city ) {
		$address['addressLocality'] = $city;
	}
	if ( '' !== $state ) {
		$address['addressRegion'] = $state;
	}
	if ( '' !== $postal_code ) {
		$address['postalCode'] = $postal_code;
	}
	if ( '' !== $address_country ) {
		$address['addressCountry'] = strtoupper( $address_country );
	}
	if ( count( $address ) > 1 ) {
		$schema['address'] = $address;
	}

	if ( '1' === $geo_enabled && '' !== $latitude && '' !== $longitude ) {
		$schema['geo'] = array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => $latitude,
			'longitude' => $longitude,
		);
	}

	if ( '' !== $map ) {
		$schema['hasMap'] = esc_url_raw( $map );
	}

	if ( '1' === $price_enabled && '' !== $price_range ) {
		$schema['priceRange'] = wpspeed_lbs_sanitize_price_range( $price_range );
	}

	if ( '' !== $area_served ) {
		$schema['areaServed'] = $area_served;
	}

	$same_as = array();
	if ( '' !== $facebook ) {
		$same_as[] = esc_url_raw( $facebook );
	}
	if ( '' !== $instagram ) {
		$same_as[] = esc_url_raw( $instagram );
	}
	$same_as = array_values( array_filter( $same_as ) );
	if ( ! empty( $same_as ) ) {
		$schema['sameAs'] = $same_as;
	}

	if ( '' !== $phone || ( '' !== $email && is_email( $email ) ) ) {
		$contact_point = array(
			'@type'       => 'ContactPoint',
			'contactType' => 'customer service',
		);
		if ( '' !== $phone ) {
			$contact_point['telephone'] = $phone;
		}
		if ( '' !== $email && is_email( $email ) ) {
			$contact_point['email'] = $email;
		}
		$schema['contactPoint'] = $contact_point;
	}

	return $schema;
}

/**
 * Encode the schema JSON.
 *
 * @param array $schema Schema array.
 * @return string
 */
function wpspeed_lbs_encode_schema_json( $schema ) {
	if ( ! is_array( $schema ) || count( $schema ) < 3 ) {
		return '';
	}

	return wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
}

/**
 * Create the final JSON-LD script.
 *
 * @return string
 */
function wpspeed_lbs_create_code() {
	$json = wpspeed_lbs_encode_schema_json( wpspeed_lbs_build_schema_array() );

	if ( '' === $json ) {
		return '';
	}

	$output  = '<!-- START LocalBusiness Schema by Lumiverse -->' . PHP_EOL;
	$output .= '<script type="application/ld+json">' . PHP_EOL;
	$output .= $json . PHP_EOL;
	$output .= '</script>' . PHP_EOL;
	$output .= '<!-- END LocalBusiness Schema by Lumiverse -->' . PHP_EOL;

	return $output;
}

/**
 * Decide whether the schema should be printed on the current frontend request.
 *
 * @return bool
 */
function wpspeed_lbs_should_output_schema() {
	if ( '1' !== get_option( 'wpsp_lbs_active' ) ) {
		return false;
	}

	$location = wpspeed_lbs_sanitize_output_location( wpspeed_lbs_get_option( 'wpsp_lbs_output_location', 'sitewide' ) );

	if ( 'homepage' === $location ) {
		return is_front_page() || is_home();
	}

	return true;
}

/**
 * Output schema in wp_head.
 */
function wpspeed_localbusiness_add_code() {
	if ( ! wpspeed_lbs_should_output_schema() ) {
		return;
	}

	echo wpspeed_lbs_create_code(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON-LD is generated with wp_json_encode().
}
add_action( 'wp_head', 'wpspeed_localbusiness_add_code' );

/**
 * Detect common SEO plugins that may output schema too.
 *
 * @return array
 */
function wpspeed_lbs_detect_seo_plugins() {
	$active_plugins = (array) get_option( 'active_plugins', array() );
	$detected       = array();
	$known          = array(
		'wordpress-seo/wp-seo.php'                 => 'Yoast SEO',
		'wordpress-seo-premium/wp-seo-premium.php' => 'Yoast SEO Premium',
		'seo-by-rank-math/rank-math.php'           => 'Rank Math SEO',
		'all-in-one-seo-pack/all_in_one_seo_pack.php' => 'All in One SEO',
		'wp-seopress/seopress.php'                 => 'SEOPress',
	);

	foreach ( $known as $plugin_file => $plugin_name ) {
		if ( in_array( $plugin_file, $active_plugins, true ) ) {
			$detected[] = $plugin_name;
		}
	}

	if ( is_multisite() ) {
		$network_plugins = array_keys( (array) get_site_option( 'active_sitewide_plugins', array() ) );
		foreach ( $known as $plugin_file => $plugin_name ) {
			if ( in_array( $plugin_file, $network_plugins, true ) && ! in_array( $plugin_name, $detected, true ) ) {
				$detected[] = $plugin_name;
			}
		}
	}

	return array_values( array_unique( $detected ) );
}

/**
 * Add one health row.
 *
 * @param array  $items Health items.
 * @param string $label Label.
 * @param string $status ok|warning|error.
 * @param string $message Message.
 * @param bool   $important Whether item is important for score.
 * @return array
 */
function wpspeed_lbs_add_health_item( $items, $label, $status, $message, $important = true ) {
	$items[] = array(
		'label'     => $label,
		'status'    => $status,
		'message'   => $message,
		'important' => (bool) $important,
	);

	return $items;
}

/**
 * Build Schema Health Check data.
 *
 * @return array
 */
function wpspeed_lbs_get_health_check() {
	$items = array();

	$name            = wpspeed_lbs_get_option( 'wpsp_lbs_name' );
	$description     = wpspeed_lbs_get_option( 'wpsp_lbs_description' );
	$street_address  = wpspeed_lbs_get_option( 'wpsp_lbs_straddress' );
	$city            = wpspeed_lbs_get_option( 'wpsp_lbs_city' );
	$country         = wpspeed_lbs_get_option( 'wpsp_lbs_addresscountry' );
	$phone           = wpspeed_lbs_get_option( 'wpsp_lbs_phone' );
	$email           = wpspeed_lbs_get_option( 'wpsp_lbs_email' );
	$url             = wpspeed_lbs_get_option( 'wpsp_lbs_url' );
	$image           = wpspeed_lbs_get_option( 'wpsp_lbs_image' );
	$logo            = wpspeed_lbs_get_option( 'wpsp_lbs_logo' );
	$geo_enabled     = wpspeed_lbs_get_option( 'wpsp_lcseo_geo' );
	$latitude        = wpspeed_lbs_get_option( 'wpsp_lcseo_lat' );
	$longitude       = wpspeed_lbs_get_option( 'wpsp_lcseo_lon' );
	$map             = wpspeed_lbs_get_option( 'wpsp_lbs_map' );
	$area_served     = wpspeed_lbs_get_option( 'wpsp_lbs_area_served' );
	$active          = wpspeed_lbs_get_option( 'wpsp_lbs_active' );
	$output_location = wpspeed_lbs_get_option( 'wpsp_lbs_output_location', 'sitewide' );
	$facebook        = wpspeed_lbs_get_option( 'wpsp_lbs_facebook' );
	$instagram       = wpspeed_lbs_get_option( 'wpsp_lbs_instagram' );

	$items = wpspeed_lbs_add_health_item( $items, __( 'JSON-LD output', 'wpspeed-lbs' ), '1' === $active ? 'ok' : 'error', '1' === $active ? __( 'Enabled', 'wpspeed-lbs' ) : __( 'Disabled. Enable schema output when your details are ready.', 'wpspeed-lbs' ) );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Business name', 'wpspeed-lbs' ), '' !== $name ? 'ok' : 'error', '' !== $name ? __( 'Added', 'wpspeed-lbs' ) : __( 'Missing business name.', 'wpspeed-lbs' ) );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Business description', 'wpspeed-lbs' ), '' !== $description ? 'ok' : 'warning', '' !== $description ? __( 'Added', 'wpspeed-lbs' ) : __( 'Optional, but recommended.', 'wpspeed-lbs' ), false );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Address', 'wpspeed-lbs' ), ( '' !== $street_address && '' !== $city && '' !== $country ) ? 'ok' : 'error', ( '' !== $street_address && '' !== $city && '' !== $country ) ? __( 'Street, city and country are present.', 'wpspeed-lbs' ) : __( 'Add at least street, city and country.', 'wpspeed-lbs' ) );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Phone or email', 'wpspeed-lbs' ), ( '' !== $phone || ( '' !== $email && is_email( $email ) ) ) ? 'ok' : 'error', ( '' !== $phone || ( '' !== $email && is_email( $email ) ) ) ? __( 'Contact details are present.', 'wpspeed-lbs' ) : __( 'Add phone or a valid email.', 'wpspeed-lbs' ) );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Website URL', 'wpspeed-lbs' ), '' !== $url ? 'ok' : 'warning', '' !== $url ? __( 'Added', 'wpspeed-lbs' ) : __( 'Recommended.', 'wpspeed-lbs' ), false );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Business image', 'wpspeed-lbs' ), '' !== $image ? 'ok' : 'warning', '' !== $image ? __( 'Added', 'wpspeed-lbs' ) : __( 'Recommended.', 'wpspeed-lbs' ), false );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Logo', 'wpspeed-lbs' ), '' !== $logo ? 'ok' : 'warning', '' !== $logo ? __( 'Added', 'wpspeed-lbs' ) : __( 'Recommended.', 'wpspeed-lbs' ), false );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Geo coordinates', 'wpspeed-lbs' ), ( '1' === $geo_enabled && '' !== $latitude && '' !== $longitude ) ? 'ok' : 'warning', ( '1' === $geo_enabled && '' !== $latitude && '' !== $longitude ) ? __( 'Added', 'wpspeed-lbs' ) : __( 'Optional, but useful for physical local businesses.', 'wpspeed-lbs' ), false );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Google Maps URL', 'wpspeed-lbs' ), '' !== $map ? 'ok' : 'warning', '' !== $map ? __( 'Added', 'wpspeed-lbs' ) : __( 'Optional.', 'wpspeed-lbs' ), false );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Area served', 'wpspeed-lbs' ), '' !== $area_served ? 'ok' : 'warning', '' !== $area_served ? __( 'Added', 'wpspeed-lbs' ) : __( 'Optional.', 'wpspeed-lbs' ), false );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Social profiles', 'wpspeed-lbs' ), ( '' !== $facebook || '' !== $instagram ) ? 'ok' : 'warning', ( '' !== $facebook || '' !== $instagram ) ? __( 'At least one profile added.', 'wpspeed-lbs' ) : __( 'Optional.', 'wpspeed-lbs' ), false );
	$items = wpspeed_lbs_add_health_item( $items, __( 'Output location', 'wpspeed-lbs' ), 'ok', 'homepage' === $output_location ? __( 'Homepage only', 'wpspeed-lbs' ) : __( 'Site-wide', 'wpspeed-lbs' ), false );

	$total_important = 0;
	$ok_important    = 0;
	foreach ( $items as $item ) {
		if ( ! empty( $item['important'] ) ) {
			$total_important++;
			if ( 'ok' === $item['status'] ) {
				$ok_important++;
			}
		}
	}

	$score = $total_important > 0 ? (int) round( ( $ok_important / $total_important ) * 100 ) : 0;

	return array(
		'items' => $items,
		'score' => $score,
		'ok'    => $ok_important,
		'total' => $total_important,
	);
}

/**
 * Render an image URL field with media library controls.
 *
 * @param string $option_name Option name.
 * @param string $value Current value.
 * @param string $button_label Button label.
 */
function wpspeed_lbs_render_media_field( $option_name, $value, $button_label ) {
	$preview_style = '' === $value ? 'display:none;' : '';
	?>
	<div class="wpspeed-lbs-media-field">
		<input type="text" name="<?php echo esc_attr( $option_name ); ?>" class="wpspeed-lbs-input wpspeed-lbs-media-url" value="<?php echo esc_attr( $value ); ?>" placeholder="<?php esc_attr_e( 'https://example.com/image.jpg', 'wpspeed-lbs' ); ?>" />
		<div class="wpspeed-lbs-media-actions">
			<button type="button" class="button wpspeed-lbs-select-media" data-title="<?php echo esc_attr( $button_label ); ?>"><?php echo esc_html( $button_label ); ?></button>
			<button type="button" class="button wpspeed-lbs-remove-media"><?php esc_html_e( 'Remove', 'wpspeed-lbs' ); ?></button>
		</div>
		<div class="wpspeed-lbs-media-preview" style="<?php echo esc_attr( $preview_style ); ?>">
			<img src="<?php echo esc_url( $value ); ?>" alt="" />
		</div>
		<p class="description"><?php esc_html_e( 'You can paste an external image URL or select an image from the WordPress Media Library.', 'wpspeed-lbs' ); ?></p>
	</div>
	<?php
}

/**
 * Settings page.
 */
function wpspeed_localbusiness_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$business_type   = wpspeed_lbs_get_option( 'wpsp_lcseo_businesstype', 'LocalBusiness' );
	$name            = wpspeed_lbs_get_option( 'wpsp_lbs_name' );
	$description     = wpspeed_lbs_get_option( 'wpsp_lbs_description' );
	$street_address  = wpspeed_lbs_get_option( 'wpsp_lbs_straddress' );
	$city            = wpspeed_lbs_get_option( 'wpsp_lbs_city' );
	$state           = wpspeed_lbs_get_option( 'wpsp_lbs_state' );
	$address_country = wpspeed_lbs_get_option( 'wpsp_lbs_addresscountry' );
	$postal_code     = wpspeed_lbs_get_option( 'wpsp_lbs_postal' );
	$image           = wpspeed_lbs_get_option( 'wpsp_lbs_image' );
	$logo            = wpspeed_lbs_get_option( 'wpsp_lbs_logo' );
	$phone           = wpspeed_lbs_get_option( 'wpsp_lbs_phone' );
	$email           = wpspeed_lbs_get_option( 'wpsp_lbs_email' );
	$url             = wpspeed_lbs_get_option( 'wpsp_lbs_url' );
	$map             = wpspeed_lbs_get_option( 'wpsp_lbs_map' );
	$area_served     = wpspeed_lbs_get_option( 'wpsp_lbs_area_served' );
	$facebook        = wpspeed_lbs_get_option( 'wpsp_lbs_facebook' );
	$instagram       = wpspeed_lbs_get_option( 'wpsp_lbs_instagram' );
	$geo_enabled     = wpspeed_lbs_get_option( 'wpsp_lcseo_geo' );
	$latitude        = wpspeed_lbs_get_option( 'wpsp_lcseo_lat' );
	$longitude       = wpspeed_lbs_get_option( 'wpsp_lcseo_lon' );
	$price_enabled   = wpspeed_lbs_get_option( 'wpsp_lcseo_pricerange1' );
	$price_range     = wpspeed_lbs_get_option( 'wpsp_lcseo_pricerange', '$' );
	$active          = wpspeed_lbs_get_option( 'wpsp_lbs_active' );
	$output_location = wpspeed_lbs_get_option( 'wpsp_lbs_output_location', 'sitewide' );
	$preview_json    = wpspeed_lbs_encode_schema_json( wpspeed_lbs_build_schema_array() );
	$health          = wpspeed_lbs_get_health_check();
	$seo_plugins     = wpspeed_lbs_detect_seo_plugins();
	$frontend_url    = home_url( '/' );
	?>

	<div class="wrap wpspeed-lbs-wrap" style="padding: 10px;">
		<h1><?php esc_html_e( 'Local Business Schema Lite', 'wpspeed-lbs' ); ?> <span class="wpspeed-lbs-version">v<?php echo esc_html( WPSPEED_LOCALBUSINESS_VERSION ); ?></span></h1>
		<?php settings_errors(); ?>

		<div class="wpspeed-lbs-dashboard">
			<div class="wpspeed-lbs-dashboard-card wpspeed-lbs-score-card">
				<span class="wpspeed-lbs-dashboard-label"><?php esc_html_e( 'Schema Health', 'wpspeed-lbs' ); ?></span>
				<strong><?php echo esc_html( $health['score'] ); ?>%</strong>
				<p><?php echo esc_html( sprintf( __( '%1$d of %2$d important items completed.', 'wpspeed-lbs' ), $health['ok'], $health['total'] ) ); ?></p>
			</div>
			<div class="wpspeed-lbs-dashboard-card">
				<span class="wpspeed-lbs-dashboard-label"><?php esc_html_e( 'Output', 'wpspeed-lbs' ); ?></span>
				<strong><?php echo '1' === $active ? esc_html__( 'Enabled', 'wpspeed-lbs' ) : esc_html__( 'Disabled', 'wpspeed-lbs' ); ?></strong>
				<p><?php echo 'homepage' === $output_location ? esc_html__( 'Homepage only', 'wpspeed-lbs' ) : esc_html__( 'Site-wide', 'wpspeed-lbs' ); ?></p>
			</div>
			<div class="wpspeed-lbs-dashboard-card">
				<span class="wpspeed-lbs-dashboard-label"><?php esc_html_e( 'Business Type', 'wpspeed-lbs' ); ?></span>
				<strong><?php echo esc_html( $business_type ); ?></strong>
				<p><?php esc_html_e( 'Lite includes 4 generic types. PRO unlocks 113+ searchable business types.', 'wpspeed-lbs' ); ?></p>
			</div>
			<div class="wpspeed-lbs-dashboard-card wpspeed-lbs-dashboard-actions">
				<a href="#wpspeed-lbs-settings" class="button button-primary wpspeed-lbs-open-wizard"><?php esc_html_e( 'Start Setup Wizard', 'wpspeed-lbs' ); ?></a>
				<a href="#wpspeed-lbs-health" class="button"><?php esc_html_e( 'View Health Check', 'wpspeed-lbs' ); ?></a>
				<a href="https://validator.schema.org/" target="_blank" rel="noopener" class="button"><?php esc_html_e( 'Schema.org Validator', 'wpspeed-lbs' ); ?></a>
			</div>
		</div>

		<?php if ( ! empty( $seo_plugins ) ) : ?>
			<div class="notice notice-warning inline wpspeed-lbs-seo-notice">
				<p><strong><?php esc_html_e( 'SEO plugin detected:', 'wpspeed-lbs' ); ?></strong> <?php echo esc_html( implode( ', ', $seo_plugins ) ); ?>.</p>
				<p><?php esc_html_e( 'Local Business Schema Lite can work with SEO plugins, but avoid outputting duplicate LocalBusiness schema from multiple plugins.', 'wpspeed-lbs' ); ?></p>
			</div>
		<?php endif; ?>


		<div class="notice notice-info inline wpspeed-lbs-lite-offer">
			<p><strong><?php esc_html_e( 'Special offer for Lite users:', 'wpspeed-lbs' ); ?></strong> <?php esc_html_e( 'upgrade to Local Business Schema PRO and get 30% OFF the lifetime license.', 'wpspeed-lbs' ); ?></p>
			<p><?php esc_html_e( 'PRO adds up to 5 business locations, opening hours, payment methods, 113+ searchable business types, WooCommerce Product Schema, Breadcrumbs Schema and advanced output controls.', 'wpspeed-lbs' ); ?></p>
			<p>
				<span class="wpspeed-lbs-coupon-label"><?php esc_html_e( 'Coupon code:', 'wpspeed-lbs' ); ?></span>
				<code class="wpspeed-lbs-coupon-code"><?php echo esc_html( WPSPEED_LBS_PRO_COUPON ); ?></code>
				<a href="<?php echo esc_url( WPSPEED_LBS_PRO_URL ); ?>" target="_blank" rel="noopener" class="button button-primary"><?php esc_html_e( 'View PRO Version', 'wpspeed-lbs' ); ?></a>
			</p>
			<p class="description"><?php esc_html_e( 'Lite continues to work normally. PRO is optional and designed for businesses that need a more complete schema setup.', 'wpspeed-lbs' ); ?></p>
		</div>
		<div class="box-region-middle" id="wpspeed-lbs-settings">
			<div class="box-wpspgrpro" style="background-color: #34407d!important;">
				<h2 align="center" style="color: #fff!important; padding-top: 15px;">LOCAL BUSINESS SCHEMA</h2>
			</div>

			<div class="box-wpspgrpro">
				<p><img src="<?php echo esc_url( plugins_url( '/images/banner-772x250.jpg', __FILE__ ) ); ?>" width="100%" align="center" alt="Local Business Schema" /></p>
			</div>

			<form method="post" action="options.php" class="wpspeed-lbs-form" novalidate>
				<?php settings_fields( 'wpspeed_localbusiness_settings_group' ); ?>
				<?php do_settings_sections( 'wpspeed_localbusiness_settings_group' ); ?>

				<div class="wpspeed-lbs-wizard-panel" aria-live="polite">
					<div class="wpspeed-lbs-wizard-head">
						<h2><?php esc_html_e( 'Setup Wizard', 'wpspeed-lbs' ); ?></h2>
						<p><?php esc_html_e( 'Use the steps below to complete your basic LocalBusiness schema. You can still edit all fields normally.', 'wpspeed-lbs' ); ?></p>
					</div>
					<div class="wpspeed-lbs-wizard-steps">
						<button type="button" class="button wpspeed-lbs-wizard-step is-active" data-step="all"><?php esc_html_e( 'All Fields', 'wpspeed-lbs' ); ?></button>
						<button type="button" class="button wpspeed-lbs-wizard-step" data-step="identity"><?php esc_html_e( '1. Identity', 'wpspeed-lbs' ); ?></button>
						<button type="button" class="button wpspeed-lbs-wizard-step" data-step="contact"><?php esc_html_e( '2. Contact', 'wpspeed-lbs' ); ?></button>
						<button type="button" class="button wpspeed-lbs-wizard-step" data-step="visuals"><?php esc_html_e( '3. Images', 'wpspeed-lbs' ); ?></button>
						<button type="button" class="button wpspeed-lbs-wizard-step" data-step="location"><?php esc_html_e( '4. Location', 'wpspeed-lbs' ); ?></button>
						<button type="button" class="button wpspeed-lbs-wizard-step" data-step="social"><?php esc_html_e( '5. Social', 'wpspeed-lbs' ); ?></button>
						<button type="button" class="button wpspeed-lbs-wizard-step" data-step="finish"><?php esc_html_e( '6. Finish', 'wpspeed-lbs' ); ?></button>
					</div>
				</div>

				<div class="box-wpspgrpro">
					<table class="form-table wpspeed-lbs-table">
						<tr class="wpspeed-lbs-row" data-step="identity">
							<th scope="row"><?php esc_html_e( 'Your Local Business', 'wpspeed-lbs' ); ?></th>
							<td>
								<select name="wpsp_lcseo_businesstype">
									<?php foreach ( wpspeed_lbs_allowed_business_types() as $type_value => $type_label ) : ?>
										<option value="<?php echo esc_attr( $type_value ); ?>" <?php selected( $business_type, $type_value ); ?>><?php echo esc_html( $type_label ); ?></option>
									<?php endforeach; ?>
								</select>
								<p class="description">🔓 <?php esc_html_e( 'PRO unlocks 113+ searchable Schema.org business types.', 'wpspeed-lbs' ); ?></p>
							</td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="identity">
							<th scope="row"><?php esc_html_e( 'Business Name', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_name" class="wpspeed-lbs-input" value="<?php echo esc_attr( $name ); ?>" placeholder="<?php esc_attr_e( 'Enter Your Business Name', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="identity">
							<th scope="row"><?php esc_html_e( 'Business Description', 'wpspeed-lbs' ); ?></th>
							<td>
								<textarea name="wpsp_lbs_description" class="wpspeed-lbs-input" rows="4" placeholder="<?php esc_attr_e( 'Short, factual description of your business and services.', 'wpspeed-lbs' ); ?>"><?php echo esc_textarea( $description ); ?></textarea>
								<p class="description"><?php esc_html_e( 'Keep it factual. Avoid keyword stuffing or ranking promises.', 'wpspeed-lbs' ); ?></p>
							</td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="contact">
							<th scope="row"><?php esc_html_e( 'Street Address', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_straddress" class="wpspeed-lbs-input" value="<?php echo esc_attr( $street_address ); ?>" placeholder="<?php esc_attr_e( 'Enter Street Address', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="contact">
							<th scope="row"><?php esc_html_e( 'City', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_city" class="wpspeed-lbs-input" value="<?php echo esc_attr( $city ); ?>" placeholder="<?php esc_attr_e( 'Enter Your City', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="contact">
							<th scope="row"><?php esc_html_e( 'State / Region', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_state" class="wpspeed-lbs-input" value="<?php echo esc_attr( $state ); ?>" placeholder="<?php esc_attr_e( 'Enter Your State or Region', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="contact">
							<th scope="row"><?php esc_html_e( 'Address Country', 'wpspeed-lbs' ); ?></th>
							<td>
								<input type="text" name="wpsp_lbs_addresscountry" class="wpspeed-lbs-input" value="<?php echo esc_attr( $address_country ); ?>" placeholder="<?php esc_attr_e( 'Example: US, GB, GR', 'wpspeed-lbs' ); ?>" />
								<p class="description"><?php esc_html_e( 'Use a two-letter country code when possible, e.g. US, GB, GR.', 'wpspeed-lbs' ); ?></p>
							</td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="contact">
							<th scope="row"><?php esc_html_e( 'Postal Code', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_postal" class="wpspeed-lbs-input" value="<?php echo esc_attr( $postal_code ); ?>" placeholder="<?php esc_attr_e( 'Enter Your Postal Code', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="contact">
							<th scope="row"><?php esc_html_e( 'Phone', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_phone" class="wpspeed-lbs-input" value="<?php echo esc_attr( $phone ); ?>" placeholder="<?php esc_attr_e( 'ex. +1 555-555-5555', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="contact">
							<th scope="row"><?php esc_html_e( 'Email', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_email" class="wpspeed-lbs-input" value="<?php echo esc_attr( $email ); ?>" placeholder="<?php esc_attr_e( 'info@example.com', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="contact">
							<th scope="row"><?php esc_html_e( 'Website URL', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_url" class="wpspeed-lbs-input" value="<?php echo esc_attr( $url ); ?>" placeholder="<?php esc_attr_e( 'https://example.com', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="visuals">
							<th scope="row"><?php esc_html_e( 'Business Image', 'wpspeed-lbs' ); ?></th>
							<td><?php wpspeed_lbs_render_media_field( 'wpsp_lbs_image', $image, __( 'Select Business Image', 'wpspeed-lbs' ) ); ?></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="visuals">
							<th scope="row"><?php esc_html_e( 'Logo', 'wpspeed-lbs' ); ?></th>
							<td><?php wpspeed_lbs_render_media_field( 'wpsp_lbs_logo', $logo, __( 'Select Logo', 'wpspeed-lbs' ) ); ?></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="location">
							<th scope="row">
								<div class="switch">
									<input id="wpsp_lcseo_geo" name="wpsp_lcseo_geo" class="cmn-toggle cmn-toggle-round" type="checkbox" value="1" <?php checked( '1', $geo_enabled ); ?> />
									<label for="wpsp_lcseo_geo"></label>
								</div>
								<?php esc_html_e( 'Geo Coordinates', 'wpspeed-lbs' ); ?>
							</th>
							<td width="50%">
								<input type="text" name="wpsp_lcseo_lat" class="wpspeed-lbs-input" style="width:50%;" value="<?php echo esc_attr( $latitude ); ?>" placeholder="<?php esc_attr_e( 'Latitude', 'wpspeed-lbs' ); ?> ex. XX.XXXX" />
								<input type="text" name="wpsp_lcseo_lon" class="wpspeed-lbs-input" style="width:50%;" value="<?php echo esc_attr( $longitude ); ?>" placeholder="<?php esc_attr_e( 'Longitude', 'wpspeed-lbs' ); ?> ex. XX.XXXX" />
								<p class="description"><?php esc_html_e( 'Latitude and longitude help define your physical business location.', 'wpspeed-lbs' ); ?></p>
							</td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="location">
							<th scope="row"><?php esc_html_e( 'Google Maps URL', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_map" class="wpspeed-lbs-input" value="<?php echo esc_attr( $map ); ?>" placeholder="<?php esc_attr_e( 'Enter Map URL', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="location">
							<th scope="row"><?php esc_html_e( 'Area Served', 'wpspeed-lbs' ); ?></th>
							<td>
								<input type="text" name="wpsp_lbs_area_served" class="wpspeed-lbs-input" value="<?php echo esc_attr( $area_served ); ?>" placeholder="<?php esc_attr_e( 'Example: Athens, Greece', 'wpspeed-lbs' ); ?>" />
								<p class="description">🔓 <?php esc_html_e( 'PRO can later expand this with advanced multi-area/service-area options.', 'wpspeed-lbs' ); ?></p>
							</td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="social">
							<th scope="row"><?php esc_html_e( 'Facebook URL', 'wpspeed-lbs' ); ?></th>
							<td><input type="text" name="wpsp_lbs_facebook" class="wpspeed-lbs-input" value="<?php echo esc_attr( $facebook ); ?>" placeholder="<?php esc_attr_e( 'https://facebook.com/your-page', 'wpspeed-lbs' ); ?>" /></td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="social">
							<th scope="row"><?php esc_html_e( 'Instagram URL', 'wpspeed-lbs' ); ?></th>
							<td>
								<input type="text" name="wpsp_lbs_instagram" class="wpspeed-lbs-input" value="<?php echo esc_attr( $instagram ); ?>" placeholder="<?php esc_attr_e( 'https://instagram.com/your-profile', 'wpspeed-lbs' ); ?>" />
								<p class="description">🔓 <?php esc_html_e( 'Lite includes 2 social profile links. PRO remains the place for more identity/profile options.', 'wpspeed-lbs' ); ?></p>
							</td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="finish">
							<th scope="row">
								<div class="switch">
									<input id="wpsp_lcseo_pricerange1" name="wpsp_lcseo_pricerange1" class="cmn-toggle cmn-toggle-round" type="checkbox" value="1" <?php checked( '1', $price_enabled ); ?> />
									<label for="wpsp_lcseo_pricerange1"></label>
								</div>
								<?php esc_html_e( 'Price Range', 'wpspeed-lbs' ); ?>
							</th>
							<td>
								<select name="wpsp_lcseo_pricerange">
									<?php foreach ( array( '$', '$$', '$$$', '$$$$', '$$$$$' ) as $range ) : ?>
										<option value="<?php echo esc_attr( $range ); ?>" <?php selected( $price_range, $range ); ?>><?php echo esc_html( $range ); ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="finish">
							<th scope="row"><?php esc_html_e( 'Output Location', 'wpspeed-lbs' ); ?></th>
							<td>
								<label><input type="radio" name="wpsp_lbs_output_location" value="sitewide" <?php checked( $output_location, 'sitewide' ); ?> /> <?php esc_html_e( 'Site-wide', 'wpspeed-lbs' ); ?></label><br />
								<label><input type="radio" name="wpsp_lbs_output_location" value="homepage" <?php checked( $output_location, 'homepage' ); ?> /> <?php esc_html_e( 'Homepage only', 'wpspeed-lbs' ); ?></label>
								<p class="description"><?php esc_html_e( 'Default remains site-wide for existing users. Homepage only is often cleaner for simple local business websites.', 'wpspeed-lbs' ); ?></p>
							</td>
						</tr>

						<tr class="wpspeed-lbs-row" data-step="finish">
							<th scope="row" style="width: 30%; color: red;">
								<div class="switch">
									<input id="wpsp_lbs_active" name="wpsp_lbs_active" class="cmn-toggle1 cmn-toggle1-round" type="checkbox" value="1" <?php checked( '1', $active ); ?> />
									<label for="wpsp_lbs_active"></label>
								</div>
							</th>
							<td><strong><?php esc_html_e( 'Activate JSON-LD Schema on Your Website', 'wpspeed-lbs' ); ?></strong></td>
						</tr>
					</table>
				</div>

				<div class="box-wpspgrpro" id="wpspeed-lbs-health">
					<div style="background-color:#34407d!important;width:100%; padding:5px;">
						<h3 style="color:white!important;">Schema Health Check</h3>
					</div>
					<p><?php esc_html_e( 'This checklist helps you see whether the basic LocalBusiness schema is complete enough to publish.', 'wpspeed-lbs' ); ?></p>
					<div class="wpspeed-lbs-health-score"><?php echo esc_html( $health['score'] ); ?>%</div>
					<table class="widefat striped wpspeed-lbs-health-table">
						<tbody>
							<?php foreach ( $health['items'] as $item ) : ?>
								<tr>
									<td><span class="wpspeed-lbs-status wpspeed-lbs-status-<?php echo esc_attr( $item['status'] ); ?>"><?php echo 'ok' === $item['status'] ? '✓' : ( 'error' === $item['status'] ? '!' : '•' ); ?></span></td>
									<td><strong><?php echo esc_html( $item['label'] ); ?></strong></td>
									<td><?php echo esc_html( $item['message'] ); ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<div class="box-wpspgrpro">
					<div style="background-color:#34407d!important;width:100%; padding:5px;">
						<h3 style="color:white!important;">Schema Preview</h3>
					</div>
					<p><?php esc_html_e( 'This is the JSON-LD that will be added to your website when schema output is active.', 'wpspeed-lbs' ); ?></p>
					<textarea id="wpspeed-lbs-schema-preview" readonly rows="18" style="width:100%;font-family:monospace;direction:ltr;"><?php echo esc_textarea( $preview_json ? $preview_json : __( 'Add at least one business detail to generate a preview.', 'wpspeed-lbs' ) ); ?></textarea>
					<p class="wpspeed-lbs-preview-actions">
						<button type="button" class="button" id="wpspeed-lbs-copy-schema"><?php esc_html_e( 'Copy JSON-LD', 'wpspeed-lbs' ); ?></button>
						<a href="https://search.google.com/test/rich-results?url=<?php echo rawurlencode( $frontend_url ); ?>" target="_blank" rel="noopener" class="button"><?php esc_html_e( 'Google Rich Results Test', 'wpspeed-lbs' ); ?></a>
						<a href="https://validator.schema.org/" target="_blank" rel="noopener" class="button"><?php esc_html_e( 'Schema.org Validator', 'wpspeed-lbs' ); ?></a>
						<span id="wpspeed-lbs-copy-done" class="wpspeed-lbs-copy-done" style="display:none;"><?php esc_html_e( 'Copied!', 'wpspeed-lbs' ); ?></span>
					</p>
				</div>

				<?php submit_button(); ?>
			</form>
		</div>

		<div class="box-region-right">
			<div class="wpspeed-lbs-sidebar wpspeed-lbs-pro-box">
				<h3>🚀 <?php esc_html_e( 'Upgrade to PRO', 'wpspeed-lbs' ); ?></h3>
				<p><?php esc_html_e( 'Lite is perfect for basic LocalBusiness JSON-LD. PRO is designed for businesses that need a more complete professional schema setup.', 'wpspeed-lbs' ); ?></p>
				<ul>
					<li><strong><?php esc_html_e( 'Up to 5 business locations', 'wpspeed-lbs' ); ?></strong></li>
					<li><strong><?php esc_html_e( '113+ searchable business types', 'wpspeed-lbs' ); ?></strong></li>
					<li><strong><?php esc_html_e( 'Opening hours and payment methods', 'wpspeed-lbs' ); ?></strong></li>
					<li><strong><?php esc_html_e( 'Advanced social/profile links', 'wpspeed-lbs' ); ?></strong></li>
					<li><strong><?php esc_html_e( 'WooCommerce Product Schema', 'wpspeed-lbs' ); ?></strong></li>
					<li><strong><?php esc_html_e( 'Breadcrumbs Schema', 'wpspeed-lbs' ); ?></strong></li>
					<li><strong><?php esc_html_e( 'Schema Health Check and safe output controls', 'wpspeed-lbs' ); ?></strong></li>
				</ul>
				<div class="wpspeed-lbs-cta wpspeed-lbs-coupon-card">
					<p><strong><?php esc_html_e( 'Lite user coupon', 'wpspeed-lbs' ); ?></strong></p>
					<p><?php esc_html_e( 'Use this coupon and get 30% OFF the PRO lifetime license:', 'wpspeed-lbs' ); ?></p>
					<p><code class="wpspeed-lbs-coupon-code"><?php echo esc_html( WPSPEED_LBS_PRO_COUPON ); ?></code></p>
					<a href="<?php echo esc_url( WPSPEED_LBS_PRO_URL ); ?>" class="button button-primary button-large" target="_blank" rel="noopener"><?php esc_html_e( 'Upgrade to PRO — Save 30%', 'wpspeed-lbs' ); ?></a>
				</div>
			</div>

			<div class="box-wpspgrpro" style="background-color: #34407d!important;">
				<h3 style="color: #fff!important;">Do you like the FREE version?</h3>
				<p style="color: #fff!important;">Give us a <strong style="color: #fff995!important;">5 Star</strong> <a style="color: #fff!important; text-decoration: underline;" target="_blank" rel="noopener" href="https://wordpress.org/support/plugin/wpspeed-localbusiness-schema/reviews/?rate=5#new-post">Review.</a></p>
			</div>

			<div class="wpspeed-lbs-sidebar">
				<h3><?php esc_html_e( 'Free Version Info', 'wpspeed-lbs' ); ?></h3>
				<ul>
					<li><?php esc_html_e( 'Empty fields are ignored automatically.', 'wpspeed-lbs' ); ?></li>
					<li><?php esc_html_e( 'Use HTTPS URLs for images, logo and social profiles.', 'wpspeed-lbs' ); ?></li>
					<li><?php esc_html_e( 'Structured data helps search engines understand your content, but it does not guarantee rankings or rich results.', 'wpspeed-lbs' ); ?></li>
				</ul>
			</div>

			<div class="box-wpspgrpro">
				<h4 style="text-decoration: underline;">Need Expert Help With Your Website?</h4>
				<p>🚨 Fix Accessibility (WCAG) Issues<br />🛠️ Fully Managed WordPress Care<br />🎨 Custom Web Design</p>
				<p><a target="_blank" rel="noopener" href="https://lumiverse.gr">We would love to hear from you!</a></p>
			</div>

			<div class="box-wpspgrpro">
				<h4 style="text-decoration: underline;">Useful Info</h4>
				<ul>
					<li><a target="_blank" rel="noopener" href="https://search.google.com/test/rich-results">Google Rich Results Test</a></li>
					<li><a target="_blank" rel="noopener" href="https://validator.schema.org/">Schema.org Validator</a></li>
					<li><a target="_blank" rel="noopener" href="https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data">Introduction to Structured Data</a></li>
					<li><a target="_blank" rel="noopener" href="https://www.latlong.net">Find Latitude & Longitude</a></li>
				</ul>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		(function($) {
			'use strict';

			$('.wpspeed-lbs-select-media').on('click', function(e) {
				e.preventDefault();
				var button = $(this);
				var field = button.closest('.wpspeed-lbs-media-field');
				var frame = wp.media({
					title: button.data('title') || '<?php echo esc_js( __( 'Select Image', 'wpspeed-lbs' ) ); ?>',
					button: { text: '<?php echo esc_js( __( 'Use this image', 'wpspeed-lbs' ) ); ?>' },
					multiple: false
				});
				frame.on('select', function() {
					var attachment = frame.state().get('selection').first().toJSON();
					field.find('.wpspeed-lbs-media-url').val(attachment.url).trigger('change');
					field.find('.wpspeed-lbs-media-preview img').attr('src', attachment.url);
					field.find('.wpspeed-lbs-media-preview').show();
				});
				frame.open();
			});

			$('.wpspeed-lbs-remove-media').on('click', function(e) {
				e.preventDefault();
				var field = $(this).closest('.wpspeed-lbs-media-field');
				field.find('.wpspeed-lbs-media-url').val('').trigger('change');
				field.find('.wpspeed-lbs-media-preview img').attr('src', '');
				field.find('.wpspeed-lbs-media-preview').hide();
			});

			$('.wpspeed-lbs-wizard-step').on('click', function() {
				var step = $(this).data('step');
				$('.wpspeed-lbs-wizard-step').removeClass('is-active');
				$(this).addClass('is-active');

				if ('all' === step) {
					$('.wpspeed-lbs-row').show();
				} else {
					$('.wpspeed-lbs-row').hide();
					$('.wpspeed-lbs-row[data-step="' + step + '"]').show();
				}
			});

			$('.wpspeed-lbs-open-wizard').on('click', function() {
				$('.wpspeed-lbs-wizard-step[data-step="identity"]').trigger('click');
			});

			$('#wpspeed-lbs-copy-schema').on('click', function() {
				var preview = document.getElementById('wpspeed-lbs-schema-preview');
				preview.select();
				preview.setSelectionRange(0, 999999);
				try {
					document.execCommand('copy');
					$('#wpspeed-lbs-copy-done').fadeIn(150).delay(1200).fadeOut(150);
				} catch (err) {}
			});
		})(jQuery);
	</script>
	<?php
}

/**
 * Display admin notice for the new version.
 */
function show_pro_version_notification_jsonld() {
	if ( ! current_user_can( 'install_plugins' ) ) {
		return;
	}

	$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';
	if ( false === strpos( $page, 'wpspeed-localbusiness-schema' ) ) {
		return;
	}

	$dismissed_until = get_option( 'pro_version_notification_jsonld_dismissed_until' );
	if ( $dismissed_until && current_time( 'timestamp' ) < $dismissed_until ) {
		return;
	}

	$nonce = wp_create_nonce( 'dismiss_pro_version_notification_jsonld' );
	?>
	<div class="notice notice-info is-dismissible" id="pro-version-notification-jsonld">
		<p><strong><?php esc_html_e( 'Local Business Schema Lite has a new PRO upgrade offer.', 'wpspeed-lbs' ); ?></strong><br />
		<?php esc_html_e( 'Need up to 5 locations, opening hours, payment methods, 113+ searchable business types, WooCommerce Product Schema and Breadcrumbs Schema?', 'wpspeed-lbs' ); ?></p>
		<p><?php esc_html_e( 'Use coupon', 'wpspeed-lbs' ); ?> <code><?php echo esc_html( WPSPEED_LBS_PRO_COUPON ); ?></code> <?php esc_html_e( 'and get 30% OFF the PRO lifetime license.', 'wpspeed-lbs' ); ?></p>
		<p><a href="<?php echo esc_url( WPSPEED_LBS_PRO_URL ); ?>" target="_blank" rel="noopener" class="button button-primary"><?php esc_html_e( 'View PRO Version', 'wpspeed-lbs' ); ?></a></p>
	</div>
	<script type="text/javascript">
		(function($) {
			$('#pro-version-notification-jsonld').on('click', '.notice-dismiss', function() {
				$.post(ajaxurl, {
					action: 'dismiss_pro_version_notification_jsonld',
					nonce: '<?php echo esc_js( $nonce ); ?>'
				});
			});
		})(jQuery);
	</script>
	<?php
}
add_action( 'admin_notices', 'show_pro_version_notification_jsonld' );

/**
 * Handle admin notice dismissal.
 */
function dismiss_pro_version_notification_jsonld() {
	check_ajax_referer( 'dismiss_pro_version_notification_jsonld', 'nonce' );

	$dismiss_period = 20 * DAY_IN_SECONDS;
	update_option( 'pro_version_notification_jsonld_dismissed_until', current_time( 'timestamp' ) + $dismiss_period );

	wp_die();
}
add_action( 'wp_ajax_dismiss_pro_version_notification_jsonld', 'dismiss_pro_version_notification_jsonld' );
