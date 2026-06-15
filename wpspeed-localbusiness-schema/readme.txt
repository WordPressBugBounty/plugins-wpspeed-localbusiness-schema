=== Local Business Schema (JSON-LD) Lite ===
Contributors: bestseogr
Plugin URI: https://lumiverse.gr
Tags: local seo, json schema, seo optimization, json-ld, structured data
Requires at least: 4.7
Tested up to: 7.0
Stable tag: 3.3.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add clean LocalBusiness JSON-LD structured data to WordPress without coding.

== Description ==

= Local Business Schema Lite by Lumiverse =

Local Business Schema Lite helps you add clean JSON-LD structured data to your WordPress website without touching code.

It is built for local businesses, service providers, shops, agencies and professionals who want search engines to better understand their business details, location, contact information, map link, geo coordinates, social profiles and service area.

Structured data can help search engines understand your content and may make your pages eligible for enhanced search features. It does not guarantee rankings or rich results.

= Lite Features =

* 4 generic business types: LocalBusiness, Corporation, Store, ProfessionalService
* Business name
* Business description
* Street address
* City
* State / region
* Address country
* Postal code
* Phone
* Email
* Website URL
* Business image with Media Library selector
* Logo with Media Library selector
* Geo coordinates
* Google Maps URL / hasMap
* Price range
* Area served
* Facebook URL
* Instagram URL
* sameAs output for social profiles
* Basic contactPoint output
* Setup Wizard for easier configuration
* Schema Health Check
* Schema preview inside the admin page
* Copy JSON-LD button
* Google Rich Results Test shortcut
* Schema.org Validator shortcut
* Output location control: site-wide or homepage only
* SEO plugin detection notice
* Safer JSON-LD generation using wp_json_encode()

= Upgrade to PRO =

Need a more complete professional schema setup?

Local Business Schema PRO adds:

* 113+ searchable Schema.org business types
* Multi-location support for up to 5 business locations
* Opening hours
* Payment methods
* More social/profile identity links
* Advanced output controls
* WooCommerce Product Schema
* Breadcrumbs Schema
* Premium support
* Lifetime license and updates

View the PRO version:
https://store.lvdynamic.com/product/local-business-schema-pro/


== Upgrade Notice ==
Major admin experience update. Adds setup wizard, media library selectors, schema health check, output location control, SEO plugin detection and improved schema testing tools. Please review your settings after updating.

== Installation ==

1. Go to Plugins > Add New.
2. Search for "Local Business Schema by Lumiverse".
3. Install and activate the plugin.
4. Navigate to the "LB Schema JSON" admin menu.
5. Add your business details.
6. Enable schema output.
7. Save your settings.

== Frequently Asked Questions ==

= What does this plugin do? =

It adds LocalBusiness JSON-LD structured data to your WordPress website based on the business details you enter in the plugin settings.

= Do I need coding knowledge? =

No. You only need to fill in the settings fields and activate the schema output.

= Will this guarantee better rankings? =

No. Structured data helps search engines understand your content, but it does not guarantee rankings, rich results or specific search features.

= Why JSON-LD? =

JSON-LD is a recommended structured data format for Google Search.

= Which business types are included in Lite? =

Lite includes LocalBusiness, Corporation, Store and ProfessionalService.

= What does PRO add? =

PRO adds 113+ searchable business types, up to 5 business locations, opening hours, payment methods, advanced output controls, WooCommerce Product Schema and Breadcrumbs Schema.

= Can I add my business logo? =

Yes. The Lite version includes a dedicated logo field with a WordPress Media Library selector.

= Can I add social profiles? =

Yes. Lite includes Facebook and Instagram URL fields and outputs them using sameAs.

= Can I test the schema? =

Yes. The settings page includes a schema preview, copy button, Google Rich Results Test shortcut and Schema.org Validator shortcut.

= What happens if I leave fields empty? =

Empty fields are ignored automatically, so the plugin only outputs the business details you provide.

= Is this a full schema builder for every Schema.org type? =

No. This plugin focuses on LocalBusiness-style structured data. The PRO version expands the LocalBusiness setup and also adds WooCommerce Product Schema and Breadcrumbs Schema.

== Screenshots ==

1. Admin dashboard and setup wizard
2. Schema Health Check
5. Schema Preview and testing buttons

== Changelog ==

= 3.3.1 =
* Fixed settings form saving issue.
* Added visible messages after saving.

= 3.3.0 =
* New: Setup Wizard for easier first-time configuration
* New: Media Library selector for Business Image
* New: Media Library selector for Logo
* New: Image and logo preview with remove buttons
* New: Schema Health Check with important and optional field status
* New: Admin dashboard with schema health score
* New: Output location setting: site-wide or homepage only
* New: SEO plugin detection notice for Yoast SEO, Rank Math, AIOSEO and SEOPress
* New: Schema.org Validator shortcut
* New: Copy JSON-LD button in Schema Preview
* Improvement: Better admin UI and field descriptions
* Improvement: Admin notice updated for the new release

= 3.1.0 =
* New: Business Description field
* New: Email field
* New: Logo field
* New: Area Served field
* New: Facebook URL field
* New: Instagram URL field
* New: sameAs output for social profiles
* New: Basic contactPoint output
* New: Schema preview in the admin page
* New: Google Rich Results Test shortcut
* Improvement: Schema generation now uses PHP arrays and wp_json_encode()
* Improvement: Added sanitize callbacks to registered settings
* Improvement: Escaped admin field values
* Improvement: Added nonce verification to the dismissible admin notice
* Improvement: Safer wording around structured data and search visibility

= 3.0.0 =
* New: Address Country field
* New: Google Maps link
* Fix: Prevent XSS vulnerabilities
* Fix: Validation and fallbacks
* Fix: Smart code handling

= 2.0.1 =
* New: Business Type
* New: Geo Coordinates
* New: Price Range
* Fix: CSS improvements
* Tested with WP 6.8

= 1.4 =
* Fix: Phone field

= 1.3 =
* Tested with WP 6.7.1

= 1.2 =
* Tested with WP 5.5.1

= 1.1 =
* Tested with WP 4.9.5

= 1.0 =
* First release
