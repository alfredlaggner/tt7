<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Helper files
| 4. Custom config files
| 5. Language files
| 6. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packges
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

$autoload['packages'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'session', 'xmlrpc');
*/

$autoload['libraries'] = array('database', 'session', 'parser', 'ion_auth', 'form_validation', 'pagination', 'session', 'excel', 'encrypt');

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/
$autoload['helper'] = array('url', 'form', 'file', 'force_ssl', 'file', 'download', 'html', 'cookie', 'print_r2_helper', 'form_html5');
/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/

$autoload['config'] = array('Stellar', 'Facebook');


/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/

$autoload['language'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('model1', 'model2');
|
*/

$autoload['model'] = array(
	'admin_model',
	'physical_level_model',
	'service_level_model',
	'location_model',
	'inquiry_message_model',
	'confirmation_message_model',
	'booking_message_model',
	'activity_model',
	'activity_related_model',
	'division_model',
	'style_model',
	'rate_plan_model',
	'rate_model',
	'rate_price_model',
	'tax_plan_model',
	'tax_model',
	'tax_plan_to_tax_model',
	'discount_model',
	'discount_type_model',
	'event_model',
	'event_to_employee_model',
	'discount_to_activity_model',
	'coordinates_model',
	'employee_model',
	'customer_model',
	'ledger_model',
	'employee_function_model',
	'activity_booking_model',
	'activity_to_region_model',
	'ledger_to_customer_model',
	'mail_model',
	'mail_sent_model',
	'customer_contact_model',
	'customer_contact_type_model',
	'account_model',
	'employee_cms_model',
	'tt_model',
	'tt_model_v1',
	'tt_model_v2',
	'region_model',
	'equipment_model',
	'activity_pictures_model',
	'gear_model',
	'gear_pictures_model',
	'gear_related_model',
	'gear_related_model',
	'gear_group_model',
	'gear_to_region_model',
	'news_model',
	'news_pictures_model',
	'news_related_model',
	'news_group_model',
	'news_group_model',
	'news_to_region_model',
	'home_slider_model',
	'home_slider_picture_model',
	'fizzlebizzle',
	'template_model',
	'template_to_attachment_model',
	'attachment_model',
	'calendar_model',
	'calendar_model_front'
);


/* End of file autoload.php */
/* Location: ./application/config/autoload.php */