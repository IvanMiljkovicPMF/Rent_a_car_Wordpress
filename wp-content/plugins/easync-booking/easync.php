<?php 

    /*
    Plugin Name: eaSYNC Booking
    Description: Plugin for Booking modules (hotel booking, car rental and restaurant reservation)
    Author: Syntactics, Inc.
    Version: 1.1.9
    Author URI: http://www.syntacticsinc.com
    */

/**************************generates tables*************************/
if( ! defined( 'ABSPATH' ) ) exit;

global $jal_db_version, $wp_query, $wpdb, $sync_hotel_enable, $sync_car_enable , $sync_restau_enable, $paypalURL, $paypalID, $paypal_sandbox, $paypal_production, $paypal_method, $sync_default_rate, $sync_currency, $sync_currency_set, $geoPlugin_array, $sync_product_currency, $sync_emailtemplate_image, $sync_hotel_privacy, $sync_hotel_terms, $sync_car_privacy, $sync_car_terms, $sync_restau_privacy, $sync_restau_terms, $has_shortcode_page, $errors_config_hotel, $errors_config_car, $errors_config_restau;

//require_once('CurrencyConverterECB.php');
//$CurrencyConverterECB = new CurrencyConverterECB();

// global $sync_currency, $sync_currency_set, $geoPlugin_array;
   $errors_config_hotel = array();
   $errors_config_car = array();
   $errors_config_restau = array();
   $has_shortcode_page = array();
   $sync_product_currency = 'USD';
   $sync_currency_set = array();
   $geoPlugin_array = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']) );
   $sync_currency  = array (
            'AFN' => 'Afghani',
            'ALL' => 'Lek', // ALBANIA Currency
            'DZD' => 'Algerian Dinar',
            'AOA' => 'Kwanza', // ANGOLA Currency
            'XCD' => 'East Carribean Dollar', // ANGUILLA, ANTIGUA AND BARBUDA Currency
            'ARS' => 'Argentinian Peso',
            'AMD' => 'Armenian Dram',
            'AUD' => 'Australian Dollar',
            'AZN' => 'Azerbaijanian Manat',
            'BSD' => 'Bahamian Dollar', // BAHAMAS (THE) Currency
            'BHD' => 'Bahraini Dinar',
            'BDT' => 'Taka', // BANGLADESH Currency
            'BBD' => 'Barbados Dollar',
            'BYN' => 'Belarussian Ruble',
            'BZD' => 'Belize Dollar',
            'XOF' => 'CFA Franc BCEAO', // BENIN Currency
            'BMD' => 'Bermudian Dollar',
            'BTN' => 'Ngultrum', // BHUTAN Currency
            'BOB' => 'Boliviano',
            'BOV' => 'Mvdol', 
            'BAM' => 'Convertible Mark', //BOSNIA AND HERZEGOVINA
            'BWP' => 'Pula', // BOTSWANA Currency
            'NOK' => 'Norwegian Krone', // BOUVET ISLAND
            'BRL' => 'Brazilian Real',
            'BND' => 'Brunei Dollar',
            'BGN' => 'Bulgarian Lev',
            'BIF' => 'Burundi Franc',
            'CVE' => 'Cabo Verde Escudo', 
            'KHR' => 'Riel', // CAMBODIA Currency
            'CAD' => 'Canadian Dollar',
            'KYD' => 'Cayman Islands Dollar',
            'XAF' => 'CFA Franc BEAC',
            'CLF' => 'Unidad de Fomento',
            'CLP' => 'Chilean Peso',
            'CNY' => 'Yuan Renminbi', // CHINA Currency
            'COP' => 'Colombian Peso',
            'COU' => 'Unidad Valor Real',
            'KMF' => 'Comoro Franc',
            'CDF' => 'Congolese Franc',
            'CRC' => 'Costa Rican Colon',
            'HRK' => 'Kuna', // CROATIA Currency
            'CUC' => 'Peso Convertible', // CUBA Currency
            'CUP' => 'Cuban Peso',
            'ANG' => 'Netherlands Antilliean Guilder', 
            'CZK' => 'Czech Koruna',
            'DKK' => 'Danish Krone',
            'DJF' => 'Djibouti Franc',
            'XCD' => 'East Caribbean Dollar',
            'DOP' => 'Dominican Peso',
            'EGP' => 'Egyptian Pound',
            'SVC' => 'El Salvador Colon',
            'ERN' => 'Nakfa', // ERITREA Currency
            'EUR' => 'Euro',
            'ETB' => 'Ethiopian Birr',
            'FKP' => 'Falkland Islands Pound',
            'FJD' => 'Fiji Dollar', 
            'XPF' => 'CFP Franc', // FRENCH POLYNESIA Currency
            'GMD' => 'Dalasi', // GAMBIA Currency 
            'GEL' => 'Lari', // GEORGIA Currency
            'GHS' => 'Ghana Cedi',
            'GIP' => 'Gibraltar Pound',
            'GTQ' => 'Quetzal', // GUATEMALA Currency
            'GBP' => 'British Pound',
            'GNF' => 'Guinea Franc', 
            'GYD' => 'Guyana Dollar',
            'HTG' => 'Gourde',
            'HNL' => 'Lempira', // HONDURAS Currency
            'HKD' => 'Hong Kong Dollar',
            'HUF' => 'Hungarian Forint',
            'ISK' => 'Iceland Krona',
            'INR' => 'Indian Rupee',
            'IDR' => 'Indonesian Rupiah',
            'XDR' => 'SDR (Special Drawing Right)',
            'IRR' => 'Iranian Rial',
            'IQD' => 'Iraqi Dinar',
            'ILS' => 'Israeli New Sheqel',
            'JMD' => 'Jamaican Dollar',
            'JPY' => 'Japanese Yen',
            'JOD' => 'Jordanian Dinar',
            'KZT' => 'Tenge',
            'KES' => 'Kenyan Shilling',
            'KPW' => 'North Korean Won',
            'KRW' => 'Won', // Korea currrenmf
            'KWD' => 'Kuwaiti Dinar',
            'KGS' => 'Som', // KYRGYSTAN Currency
            'LAK' => 'Kip', //LAO PEOPLE'S DEMOCRATIC REPUBLIC Currency
            'LBP' => 'Lebanese Pound',
            'LSL' => 'Loti', // LESOTHO Currency
            'ZAR' => 'Rand',
            'LRD' => 'Liberian Dollar',
            'LYD' => 'Libyan Dinar',
            'CHF' => 'Swiiss Franc',
            'MOP' => 'Pataca',
            'MGA' => 'Malagasy Ariary', // MADAGASCAR Currency
            'MWK' => 'Kwacha', 
            'MYR' => 'Malaysian Ringgit',
            'MVR' => 'Rufiyaa',
            'MRU' => 'Ouguiya',
            'MUR' => 'Mauritius Rupee',
            'XUA' => 'ADB Unit of Account',
            'MXN' => 'Mexican Peso',
            'MDL' => 'Moldovan Leu',
            'MNT' => 'Tugrik',
            'MZN' => 'Mozambique Metical',
            'MMK' => 'Kyat',
            'NAD' => 'Namibia Dollar',
            'ZAR' => 'Rand',
            'NPR' => 'Nepalese Rupee',
            'NGN' => 'Nigerian Naira',
            'TWD' => 'New Taiwan Dollar',
            'NZD' => 'New Zealand Dollar',
            'NIO' => 'Cordoba Oro',
            'OMR' => 'Omani Rial',
            'PKR' => 'Pakistani Rupee',
            'PAB' => 'Balboa',
            'PGK' => 'Kina',
            'PYG' => 'Guarani',
            'PEN' => 'Nuevo Sol',
            'PHP' => 'Philippine Peso',
            'PLN' => 'Polish Złoty',
            'GBP' => 'Pound Sterling',
            'QAR' => 'Qatari Rial',
            'MKD' => 'Denar',
            'RON' => 'Romanian Leu',
            'RUB' => 'Russian Ruble',
            'RWF' => 'Rwanda Franc',
            'SHP' => 'Saint Helena Pound',
            'WST' => 'Tala',
            'STN' => 'Dobra',
            'SAR' => 'Saudi Riyal',
            'RSD' => 'Serbian Dinar',
            'SCR' => 'Seychelles Rupee',
            'SLL' => 'Leone',
            'SGD' => 'Singapore Dollar',
            'XSU' => 'Sucre',
            'SDB' => 'Solomon Islands Dollar',
            'SOS' => 'Somali Shilling',
            'ZAR' => 'Rand',
            'SSP' => 'South Sudanese Pound',
            'LKR' => 'Sri Lanka Rupee',
            'SDG' => 'Sudanese Pound',
            'SRD' => 'Surinam Dollar',
            'SZL' => 'Lilangeni',
            'SEK' => 'Swedish Krona',
            'CHE' => 'WIR Euro',
            'CHF' => 'Swiss Franc',
            'CHW' => 'WIR Franc',
            'SYP' => 'Syrian Pound',
            'THB' => 'Thai Baht',
            'TWD' => 'Taiwan Dollar',
            'TJS' => 'Somoni',
            'TZS' => 'Tanzanian Shilling',
            'TOP' => 'Panga',
            'TTD' => 'Trinidad and Tobago Dollar',
            'TND' => 'Tunisian Dinar',
            'TRY' => 'Turkish Lira',
            'TMT' => 'Turmenistan New Manat',
            'UGX' => 'Uganda Shilling',
            'UAH' => 'Hryvnia',
            'AED' => 'UAE Dirham',
            'USN' => 'US Dollar (Next Day)',
            'UYI' => 'Uruguay Peso en Unidades Idexadas (URUIURUI)',
            'UYU' => 'Peso Uruguayo',
            'UZS' => 'Uzbekistan Sum',
            'VUV' => 'Vatu',
            'VEF' => 'Bolivar (VEF)',
            'VED' => 'Bolivar (VED)',
            'VND' => 'Dong', 
            'USD' => 'United States Dollar',
            'MAD' => 'Moroccan Dirham',
            'YER' => 'Yemeni Rial',
            'ZMW' => 'Zambian Kwacha',
            'ZAL' => 'Zambian Dollar'
        );

$jal_db_version = '1.0';

function easyncActivationRedirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=easync-booking' ) ) );
    }
}
add_action( 'activated_plugin', 'easyncActivationRedirect' );  

// register_activation_hook( __FILE__, 'copyRedirectedPage' );

// function copyRedirectedPage() {
//     copy(ABSPATH . 'wp-content/plugins/easync/easync-success-and-save.php', ABSPATH  ."/easync-success-and-save.php");
//     copy(ABSPATH . 'wp-content/plugins/easync/easync-cancel.php', ABSPATH  ."/easync-cancel.php");
// }

function easyncInstall() {
    global $wpdb;
    global $jal_db_version;

    $table_hotel_entries     = $wpdb->prefix . 'sync_hotel_entries';
    $table_rent_car_entries  = $wpdb->prefix . 'sync_rent_car_entries';
    $table_restau_entries    = $wpdb->prefix . 'sync_restau_entries';
    $table_options           = $wpdb->prefix . 'sync_options';
    $table_payments          = $wpdb->prefix . 'sync_payments';
    $table_currency_exchange = $wpdb->prefix . 'currency_exchange';
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_hotel_entries (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        firstname varchar(55) NOT NULL,
        lastname varchar(55) NOT NULL,
        phone varchar(25) NOT NULL,
        email varchar(55) NOT NULL,
        room_id mediumint(9) NOT NULL,
        arrival_date text NOT NULL,
        departure_date text NOT NULL,
        night_number varchar(55) NOT NULL,
        guest_number varchar(55) NOT NULL,
        room_number varchar(55) NOT NULL,
        facility_request text NOT NULL,
        other_req text NOT NULL,
        address_1 text NOT NULL,
        address_2 text NOT NULL,
        city text NOT NULL,
        province text NOT NULL,
        postal_code varchar(25) NOT NULL,
        status varchar(25) NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;
    CREATE TABLE $table_rent_car_entries (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        firstname varchar(55) NOT NULL,
        lastname varchar(55) NOT NULL,
        phone varchar(25) NOT NULL,
        email varchar(55) NOT NULL,
        with_driver varchar(55) NOT NULL,
        d_name varchar(55) NOT NULL,
        d_phone varchar(25) NOT NULL,
        d_license_image text NOT NULL,
        car_id mediumint(9) NOT NULL,
        pick_date text NOT NULL,
        pick_time text NOT NULL,
        return_date text NOT NULL,
        return_time text NOT NULL,
        pick_location text NOT NULL,
        number_days varchar(55) NOT NULL,
        address_1 text NOT NULL,
        address_2 text NOT NULL,
        city text NOT NULL,
        province text NOT NULL,
        postal_code varchar(25) NOT NULL,
        status varchar(25) NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;
    CREATE TABLE $table_restau_entries (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(55) NOT NULL,
        phone varchar(25) NOT NULL,
        email varchar(55) NOT NULL,
        branch text NOT NULL,
        guest_no varchar(55) NOT NULL,
        table_no varchar(55) NOT NULL,
        timeslot text NOT NULL,
        pick_date text NOT NULL,
        menu_ids text NOT NULL,
        address_1 text NOT NULL,
        address_2 text NOT NULL,
        city text NOT NULL,
        province text NOT NULL,
        postal_code varchar(25) NOT NULL,
        status varchar(25) NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;
    CREATE TABLE $table_options (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        option_name text NOT NULL,
        option_value text NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;
    CREATE TABLE $table_payments (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        item_belongsto varchar(25) NOT NULL,
        item_cat varchar(25) NOT NULL,
        item_number varchar(25) NOT NULL,
        txn_id varchar(25) NOT NULL,
        payment_gross varchar(25) NOT NULL,
        currency_code varchar(25) NOT NULL,
        payment_status varchar(25) NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'jal_db_version', $jal_db_version );

    $table = $wpdb->prefix . "sync_options";

    $temp_val = 'none<>none<>sandbox';
    $row = $wpdb->get_results(  "SELECT * FROM $table WHERE option_name = 'sync_paypal_setting'");
    if(empty($row)) {
        $entries = array(
             'option_name'    =>   'sync_paypal_setting',
             'option_value'   =>   $temp_val,
        );
        $wpdb->insert($table, $entries);
    }

    $temp_val = '07:00 am-8:00 pm';
    $row = $wpdb->get_results(  "SELECT * FROM $table WHERE option_name = 'sync_car_default_time'");
    if(empty($row)) {
        $entries = array(
             'option_name'    =>   'sync_car_default_time',
             'option_value'   =>   $temp_val,
        );
        $wpdb->insert($table, $entries); 
    }  
}

function easyncInstallData() {
    global $wpdb;
    
    $welcome_name = 'Mr. WordPress';
    $welcome_text = 'Congratulations, you just completed the installation!';
    
    $table_name = $wpdb->prefix . 'liveshoutbox';
    
    $wpdb->insert( 
        $table_name, 
        array( 
            'time' => current_time( 'mysql' ), 
            'name' => $welcome_name, 
            'text' => $welcome_text, 
        ) 
    );
}

register_activation_hook( __FILE__, 'easyncInstall' );
register_activation_hook( __FILE__, 'easyncInstallData' );
register_activation_hook( __FILE__, 'easyncAddRole' );
register_activation_hook( __FILE__, 'sync_currency_list' );

register_deactivation_hook( __FILE__, 'easyncRemoveRole' );
register_deactivation_hook( __FILE__, 'sync_currency_list_remove' );

/**************************END of generates tables*******/

/***************detecting plugins active*****************/
$table_name = $wpdb->prefix . "sync_options";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
    $sync_hotel_enable = false;
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_switch_hotel'));
    if ($entries && $entries[0]->option_value=='on') {
        $sync_hotel_enable = true;
    }
    $sync_car_enable = false;
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_switch_car'));
    if ($entries && $entries[0]->option_value=='on') {
        $sync_car_enable = true;
    }
    $sync_restau_enable = false;
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_switch_restau'));
    if ($entries && $entries[0]->option_value=='on') {
        $sync_restau_enable = true;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_paypal_setting'));
    if ($entries) {
        $paypal_sandbox = explode("<>", $entries[0]->option_value, 2)[0];
        $paypal_production  = explode("<>", $entries[0]->option_value, 3)[1];
        $paypal_method = explode("<>", $entries[0]->option_value, 4)[2];
        if($paypal_method=='sandbox') {
            $paypalID = $paypal_sandbox;
        }
        if($paypal_method=='production') {
            $paypalID =  $paypal_live;
        }
        if(($paypal_method=='sandbox' && $paypal_sandbox=='none') || ($paypal_method=='production' && $paypal_production=='none') ) {
             $paypalURL = 'error';
             $temp_error = 'Paypal credentials';
             $errors_config_hotel['paypal_error'] = $temp_error;
             $errors_config_car['paypal_error'] = $temp_error;
             $errors_config_restau['paypal_error'] = $temp_error;
        }
    }else{
        $paypalURL = 'error';
        $temp_error = 'Paypal credentials';
        $errors_config_hotel['paypal_error'] = $temp_error;
        $errors_config_car['paypal_error'] = $temp_error;
        $errors_config_restau['paypal_error'] = $temp_error;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_currency'));
    if ($entries) {
        foreach ($entries as $key => $value) {
            $sync_currency_set[$key] = $value->option_value;
        }
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_product_currency_code'));
    if ($entries) {
        $sync_product_currency = $entries[0]->option_value;
    }else{
        $temp_error = 'Product currency';
        $errors_config_hotel['product_currency_error'] = $temp_error;
        $errors_config_car['product_currency_error'] = $temp_error;
        $errors_config_restau['product_currency_error'] = $temp_error;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_user_email_image'));
    if ($entries) {
        $sync_emailtemplate_image = $entries[0]->option_value;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_hotel_page_privacy'));
    if ($entries) {
        $sync_hotel_privacy = $entries[0]->option_value;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_hotel_page_terms'));
    if ($entries) {
        $sync_hotel_terms = $entries[0]->option_value;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_car_page_privacy'));
    if ($entries) {
        $sync_car_privacy = $entries[0]->option_value;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_car_page_terms'));
    if ($entries) {
        $sync_car_terms = $entries[0]->option_value;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_restau_page_privacy'));
    if ($entries) {
        $sync_restau_privacy = $entries[0]->option_value;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_restau_page_terms'));
    if ($entries) {
        $sync_restau_terms = $entries[0]->option_value;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_car_pickup'));
    if (count($entries) <= 0) {
        $temp_error = 'Please provide atleast one pick up location';
        $errors_config_car['car_pick_error'] = $temp_error;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_car_types'));
    if (count($entries) <= 0) {
        $temp_error = 'Please provide atleast one car type';
        $errors_config_car['car_type_error'] = $temp_error;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_car_model'));
    if (count($entries) <= 0) {
        $temp_error = 'Please provide atleast one car model';
        $errors_config_car['car_model_error'] = $temp_error;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_car_default_time'));
    if (count($entries) <= 0) {
        $temp_error = 'Please provide default pickup and return time';
        $errors_config_car['car_default_time_error'] = $temp_error;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_branch_locations'));
    if (count($entries) <= 0) {
        $temp_error = 'Please provide atleast one branch location';
        $errors_config_restau['restau_branch_location_error'] = $temp_error;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_restau_banner_image'));
    if (count($entries) <= 0) {
        $temp_error = 'Please provide menu banner image';
        $errors_config_restau['restau_menu_banner_error'] = $temp_error;
    }

    $timeslots_error = false;
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_timeslot1'));
    if (count($entries) <= 0) {
         $timeslots_error = true;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_timeslot2'));
    if (count($entries) <= 0) {
         $timeslots_error = true;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_timeslot3'));
    if (count($entries) <= 0) {
         $timeslots_error = true;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_timeslot4'));
    if (count($entries) <= 0) {
         $timeslots_error = true;
    }
    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_timeslot5'));
    if (count($entries) <= 0) {
         $timeslots_error = true;
    }
    
    if ($timeslots_error == true) {
        $temp_error = 'Please provide timeslots';
        $errors_config_restau['restau_timeslots_error'] = $temp_error;
    }
}

if (in_array($geoPlugin_array['geoplugin_currencyCode'], $sync_currency_set)) {
    $sync_default_rate = $geoPlugin_array['geoplugin_currencyCode'];
}else{
    $sync_default_rate = $sync_product_currency;
}


/***************END plugins active*****************/
function easyncRemoveRole() {
    remove_role( 'sync_booking' );
}

function easyncAddRole() {
    $customCaps = array(
        'edit_others_contacts'          => true,
        'delete_others_contacts'        => true,
        'delete_private_contacts'       => true,
        'edit_private_contacts'         => true,
        'read_private_contacts'         => true,
        'edit_published_contacts'       => true,
        'publish_contacts'              => true,
        'delete_published_contacts'     => true,
        'edit_contacts'             => true,
        'delete_contacts'           => true,
        'edit_contact'              => true,
        'read_contact'              => true,
        'delete_contact'            => true,
        'read'                  => true,
    );
     
    add_role( 'sync_booking', __( 'Sync book keeper', 'sync_privilage'), $customCaps );
    $role = get_role('sync_booking');
    $role->add_cap('upload_files');
    unset( $role );
}



/**************************pages*************************/

add_action('admin_menu', 'easyncAdminActions');

 function easyncAdminActions(){
    $role = 'manage_options';
    if(!is_super_admin())
        $role = 'sync_booking';
    
   add_menu_page('eaSYNC Booking', 'eaSYNC Booking', $role, 'easync-booking', 'easyncBookingHomePage', plugins_url('/easync-booking/images/icon.png',__DIR__));

   add_submenu_page('easync-booking', 'Bookings', 'Bookings', $role, '/easync-entries', 'easyncBookingEntriesPage');
   add_submenu_page('easync-booking', 'Settings', 'Settings', $role, '/easync-settings', 'easyncBookingSettingsPage');
   //add_submenu_page('easync-booking', 'About', 'About', $role, '/sync-about', 'syncBookingAboutPage');

 }
 
 function easyncBookingHomePage() {
    include('modules/home.php');
 }

 function easyncBookingEntriesPage(){
    include('modules/entries.php');
 }

 function easyncBookingSettingsPage(){
    include('modules/settings.php');
 }

 function easyncBookingAboutPage(){
    include('modules/about.php');
 }

/**************************END of backend pages*************************/
session_start();
//if(is_admin() || is_page('car-rental')) {
 require_once('requirements.php');
 //require_once( dirname( __FILE__ ) . '/easync-cancel.php' );
 //require_once('validation.php');
//}

/**********fronted forms*****************/
if ($sync_hotel_enable==true) {
 require_once('hotel_posttype.php');
    /**********hotel forms*****************/
        add_shortcode('easync_hotel_code', 'easyncHotelCode');

        function easyncHotelCode() {
            echo do_shortcode( '[easync_booking_room]' );
        }

        add_shortcode('easync_booking_room', 'easyncFormRoomCreation');

        function easyncFormRoomCreation(){
             include('forms/hotel/search-room.php');
        }
}
    /**********END of hotel forms*****************/
if ($sync_car_enable==true) {
 require_once('car_posttype.php');
    /**********car forms*****************/
        add_shortcode('easync_car_code', 'easyncCarCode');

        function easyncCarCode() {
            echo do_shortcode( '[easync_booking_car]' );
        }

        add_shortcode('easync_booking_car', 'easyncFormCarCreation');

        function easyncFormCarCreation(){
             include('forms/car-rental/search-car.php');
        }
}        
    /**********END of car forms*****************/
if ($sync_restau_enable==true) {
 require_once('restaurant_posttype.php');
    /**********restau forms*****************/
        add_shortcode('easync_restau_code', 'easyncRestauCode');

        function easyncRestauCode() {
            echo do_shortcode( '[easync_booking_restau]' );
        }

        add_shortcode('easync_booking_restau', 'easyncFormRestauCreation');

        function easyncFormRestauCreation(){
             include('forms/restaurant/select-date.php');
        }
}
    /**********END of restau forms*****************/

/**********END of fronted forms*****************/

function easyncStringLimitWords($string, $word_limit) {
   $words = explode(' ', $string, ($word_limit + 1));
   if(count($words) > $word_limit) {
       array_pop($words);
       //add a ... at last article when more than limit word count
       echo implode(' ', $words)."..."; 
    } else {
       //otherwise
       echo implode(' ', $words); 
    }

 }


function easyncExchangeRate($amount,$from_currency,$to_currency){

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  $json = file_get_contents("https://free.currencyconverterapi.com/api/v6/convert?q={$query}&compact=ultra");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);

  $total = $val * $amount;
  return number_format($total, 2, '.', ',');
}

function easyncPrice($price) {
    global $sync_default_rate, $sync_product_currency;
    $final_price = 0;
    if(!empty($price)) {
        if($sync_default_rate!=$sync_product_currency)
            $final_price = easyncExchangeRate($price, $sync_product_currency, $sync_default_rate);
        else
            $final_price = $price;
    }
    return $final_price;
}

function easyncCurrency() {
    global $sync_default_rate;
    return $sync_default_rate; 
}

// function smtpmailer($to, $from, $from_name, $subject, $body, $is_gmail = true) { 
//      global $error, $smtpuser, $smtppwd, $smtpserver;
//      require 'Exception.php';
//      require 'PHPMailer.php';
//      require 'SMTP.php';
//      $mail = new PHPMailer();
//      $mail->IsSMTP();
//      $mail->SMTPAuth = true; 
//      if ($is_gmail) {
//          $mail->SMTPSecure = 'ssl'; 
//          $mail->Host = 'smtp.gmail.com';
//          $mail->Port = 465;  
//          $mail->Username = $smtpuser;  
//          $mail->Password = $smtppwd;   
//      } else {
//          $mail->Host = $smtpserver;
//          $mail->Username = $smtpuser;  
//          $mail->Password = $smtppwd;
//      }        
//      $mail->SetFrom($from, $from_name);
//      $mail->Subject = $subject;
//      $mail->Body = $body;
//      $mail->AddAddress($to);
//      if(!$mail->Send()) {
//          $error = 'Mail error: '.$mail->ErrorInfo;
//          return false;
//      } else {
//          $error = 'Message sent!';
//          return true;
//      }
// }

// function syncOptionsCurrency() {
//     global $sync_currency_set, $sync_product_currency;
//     $options = '';
//     foreach ($sync_currency_set as $key => $value) {
//         if($value==easyncCurrency()) 
//             $options .= '<option selected value="'.$value.'">'.$value.'</option>';
//         else
//             $options .= '<option value="'.$value.'">'.$value.'</option>';
//     }
//     if(count($sync_currency_set)==0)
//         $options = '<option value="USD">USD</option>';

//     return $options; 
// }


add_action("wp_ajax_easync_calendar_query", "easync_calendar_query");
function easync_calendar_query() {
    global $wpdb, $post;
    $data             = array(); 
    $errors           = array();       
    $data['success']  = false;
    $data['message']  = 'failed!';
    $event            = array();

    $type = '';
    $sani_type = sanitize_text_field($_GET['type']);
    if(isset($sani_type)) {
        $type = $sani_type;
    }

    switch ($type) {

        case 'restau':
            $restau_table = $wpdb->prefix . "sync_options";
            $currCode = $wpdb->get_results( "SELECT option_value FROM $restau_table WHERE option_name='sync_product_currency_code'" );
            $table_name = $wpdb->prefix . "sync_restau_entries";
            $entries = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id DESC" );
            $data['count'] = $wpdb->num_rows;
            if ( ! $entries ) {
                $wpdb->print_error(); 
            }else {
                $yourCurrCode;
                foreach ($entries as $key => $item) {
                    if($currCode[$key]->option_value != NULL){
                        $yourCurrCode = $currCode[$key]->option_value;
                    }
                    // var_dump($yourCurrCode); 
                    $temp_title="";
                    $temp_array = explode(',',$item->menu_ids);
                    $itemprice =0;
                     foreach ($temp_array as $key2 => $value) {
                        // var_dump($value);
                        $metaID = get_post($value)->ID;
                        $meta = get_post_meta( $metaID, 'sync_restau', true ); 
                        preg_match('#\((.*?)\)#', $value, $match);
                      $temp_title .= '> '.get_post($value)->post_title .' (Quantity: '.trim($match[1], ' QTY ').')</br>';

                      $itemprice += $meta['price'] * substr($match[1], 5);

                     // var_dump($overallprice); 
                     }
                     $overallprice = $itemprice;
                    $temp_data = ucfirst($item->status).'<>'.$temp_title.'<>'.$item->name.'<>'.$item->phone.'<>'.$item->email.'<>'.ucfirst($item->branch).'<>'.$item->guest_no.'<>'.$item->timeslot.'<>'.$item->pick_date.'<>'.$overallprice . ' ' . $yourCurrCode;
                    $temp_label = 'Status<>Menu Order<>Name<>Phone<>Email<>Branch<>Number of Guests<>Time Slot<>Picked Date<>Price';
                    $bgcolor = '';
                    if($item->status=='active') {
                        $bgcolor = 'rgb(15, 169, 21)';
                    }else if($item->status=='inactive') {
                        $bgcolor = '#c7c7c7';
                    }else if($item->status=='trash'){
                        $bgcolor = 'grey';
                    }else{
                        $bgcolor = '#FF562D';
                    }
                    $data['event'][$key] = array(
                        array(
                            'start'             => $item->pick_date,
                            'name'              => $item->name,
                            'description'       => $temp_data .'+'.$temp_label.'+'.$item->id, 
                            'backgroundColor'   => $bgcolor
                        )
                    );
                }
            }   
            $data['success']          = true;
            $data['message']          = 'success';
            $data['typeee']           = sanitize_text_field($_GET['type']);
            break;

        case 'car':
            $car_table = $wpdb->prefix . "sync_options";
            $currCode = $wpdb->get_results( "SELECT option_value FROM $car_table WHERE option_name='sync_product_currency_code'" );
            $table_name = $wpdb->prefix . "sync_rent_car_entries";
            $entries = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id DESC" );
            $data['count'] = $wpdb->num_rows;
            if ( ! $entries ) {
                $wpdb->print_error(); 
            }else {
                $yourCurrCode;
                foreach ($entries as $key => $item) {
                    if($currCode[$key]->option_value != NULL){
                        $yourCurrCode = $currCode[$key]->option_value;
                    }
                    $driver_label = 'Driver';
                    $driver_info  = $item->with_driver; 
                    if($item->with_driver=='self-driven') {
                        $driver_label = 'Driver<>Driver\'s Name<>Driver\'s Phone No.<>Driver\'s License';
                        $driver_info  = ucfirst($item->with_driver).'<>'.$item->d_name.'<>'.$item->d_phone.'<>'.$item->d_license_image;
                    }

                    $date_start = new DateTime($item->pick_date);
                    $date_end   = new DateTime($item->return_date);

                    $number_days = $date_end->diff($date_start)->format("%a");

                    $meta = get_post_meta( $item->car_id, 'easync_car', true ); 

                    $temp_data = ucfirst($item->status).'<>'.get_post($item->car_id)->post_title.'<>'.$meta['type'].'<>'.$meta['model'].'<>'.$item->firstname.'<>'.$item->lastname.'<>'.$item->phone.'<>'.$item->email.'<>'.$driver_info.'<>'.$item->pick_date.'<>'.$item->pick_time.'<>'.$item->return_date.'<>'.$item->return_time.'<>'.$item->pick_location.'<>'.$number_days.'<>'.$meta['price'] . ' ' . $yourCurrCode;
                    $temp_label = 'Status<>Car Name<>Car Type<>Car Model<>First Name<>Last Name<>Phone No.<>Email Address<>'.$driver_label.'<>Pick Date<>Pick Time<>Return Date<>Return Time<>Pick Location<>Days<>Price';
                    $bgcolor = '';
                    if($item->status=='active') {
                        $bgcolor = 'rgb(15, 169, 21)';
                    }else if($item->status=='inactive') {
                        $bgcolor = '#c7c7c7';
                    }else if($item->status=='trash') {
                        $bgcolor = 'grey';
                    }else{
                        $bgcolor = '#FF562D';
                    }
                    $data['event'][$key] = array(
                        array(
                            'start'       => $item->pick_date,
                            'end'         => $item->return_date,
                            'firstname'   => $item->firstname,
                            'lastname'    => $item->lastname,
                            'description' => $temp_data .'+'.$temp_label.'+'.$item->id,
                            'backgroundColor'   => $bgcolor 
                        )
                    );
                }
            }   
            $data['success']          = true;
            $data['message']          = 'success';
            $data['typeee']           = sanitize_text_field($_GET['type']);
            break;

        case 'hotel':
            $hotel_table = $wpdb->prefix . "sync_options";
            $currCode = $wpdb->get_results( "SELECT option_value FROM $hotel_table WHERE option_name='sync_product_currency_code'" );
            $table_name = $wpdb->prefix . "sync_hotel_entries";
            $entries = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id DESC" );
            $data['count'] = $wpdb->num_rows;
            if ( ! $entries ) {
                $wpdb->print_error(); 
            }else {
                $yourCurrCode;
                foreach ($entries as $key => $item) {
                    if($currCode[$key]->option_value != NULL){
                        $yourCurrCode = $currCode[$key]->option_value;
                    }
                    $temp_array = explode(',',$item->facility_request);
                    $temp_request= '';
                    $meta = get_post_meta( $item->room_id, 'easync_hotel', true ); 
                     foreach ($temp_array as $key2 => $value) {
                        preg_match('#\((.*?)\)#', $value, $match);
                      $temp_request .= ' > '.$value .'</br>';
                     }
                    $temp_data = ucfirst($item->status).'<>'.get_post($item->room_id)->post_title.'<>'.$item->firstname.'<>'.$item->lastname.'<>'.$item->phone.'<>'.$item->email.'<>'.$item->arrival_date.'<>'.$item->departure_date.'<>'.$item->night_number.'<>'.$item->guest_number.'<>'.$item->room_number.'<>'.$temp_request.'<>'.$item->other_req.'<>'.$meta['price']*$item->night_number. ' ' . $yourCurrCode;
                    $temp_label = 'Status<>Room Type<>First Name<>Last Name<>Phone No.<>Email Address<>Check-in<>Check-out<>Number of Nights<>Number of Guests<>Total Room<>Facility request<>Other request<>Price';
                    $bgcolor = '';
                    if($item->status=='active') {
                        $bgcolor = 'rgb(15, 169, 21)';
                    }else if($item->status=='inactive') {
                        $bgcolor = '#c7c7c7';
                    }else if($item->status=='trash'){
                        $bgcolor = 'grey';
                    }else{
                        $bgcolor = '#FF562D';
                    }
                    $data['event'][$key] = array(
                        array(
                            'start'             => $item->arrival_date,
                            'end'               => $item->departure_date,
                            'firstname'         => $item->firstname,
                            'lastname'          => $item->lastname,
                            'description'       => $temp_data .'+'.$temp_label.'+'.$item->id,
                            'backgroundColor'   => $bgcolor
                        )
                    );
                }
            }

            $data['success']          = true;
            $data['message']          = 'success';
            $data['typeee']           = sanitize_text_field($_GET['type']);
            break;
        
        default:
            echo "error";
            break;
    }   
    echo json_encode($data);
    die();

}

add_action("wp_ajax_nopriv_easync_validation", "easync_validation");
add_action("wp_ajax_easync_validation", "easync_validation");
function easync_validation() {

    global $post;
    $errors  = array();      
    $data    = array();
    $menu    = array();
    $paypal_item        = array();
    $paypal_item_qty    = array();
    $paypal_item_price  = array();

    $type = '';
    $sani_type = sanitize_text_field($_POST['type']);
    if(isset($sani_type)) {
        $type = $sani_type;
    }

    switch ($type) {
            case 'hotel':

                if(!wp_verify_nonce($_POST['easync_hotel_nonce'], 'easync_hotel_to_pay')){
                    return 'Not Allowed!';
                }
                if (empty(sanitize_text_field($_POST['firstname'])))
                    $errors['firstname'] = 'This field is required.';

                if (empty(sanitize_text_field($_POST['lastname'])))
                    $errors['lastname'] = 'This field is required.';

                if (empty(sanitize_text_field($_POST['phone'])))
                    $errors['phone'] = 'This field is required.';

                if (empty(sanitize_email($_POST['email'])))
                    $errors['email'] = 'This field is required.';

                 if (!empty($_POST['request_facilities']))
                    $data['facility_request'] = implode(',', $_POST['request_facilities']);
                 else
                     $data['facility_request'] = '';

                if (!empty(sanitize_text_field($_POST['other_req'])))
                    $data['other_req'] = sanitize_text_field($_POST['other_req']);
                else
                    $data['other_req'] = '';

                if(!intval($_POST['hotel_guest_number']))
                    die();

                if ( ! empty($errors)) {
                    $data['success'] = false;
                    $data['errors']  = $errors;
                }else{
                    $data['success']          = true;
                    $data['message']          = 'Success!';
                    $data['firstname']        = sanitize_text_field($_POST['firstname']);
                    $data['lastname']         = sanitize_text_field($_POST['lastname']);
                    $data['phone']            = sanitize_text_field($_POST['phone']);
                    $data['email']            = sanitize_email($_POST['email']);
                    $data['date_arrive']      = sanitize_text_field($_POST['hotel_arrival_date']);
                    $data['date_departure']   = sanitize_text_field($_POST['hotel_departure_date']);
                    $data['night_number']     = intval($_POST['hotel_night_number']);
                    $data['number_guest']     = sanitize_text_field($_POST['hotel_guest_number']);                      
                    $data['number_room']      = sanitize_text_field($_POST['hotel_number_room']);
                }

                break;


            case 'car':
                if(!wp_verify_nonce($_POST['easync_car_nonce'], 'easync_car_to_pay')){
                    return 'Not Allowed!';
                }
                if (empty(sanitize_text_field($_POST['firstname'])))
                    $errors['firstname'] = 'This field is required.';

                if (empty(sanitize_text_field($_POST['lastname'])))
                    $errors['lastname'] = 'This field is required.';

                if (empty(sanitize_text_field($_POST['phone'])))
                    $errors['phone'] = 'This field is required.';

                if (empty(sanitize_email($_POST['email'])))
                    $errors['email'] = 'This field is required.';
                
                if(!empty(sanitize_text_field($_POST['with_driver'])) && sanitize_text_field($_POST['with_driver'])=='self-driven') {   

                    if (empty(sanitize_text_field($_POST['driver_name'])))
                        $errors['driver_name'] = 'This field is required.';

                    if (empty(sanitize_text_field($_POST['driver_phone'])))
                        $errors['driver_phone'] = 'This field is required.';
                    
                    if(!empty(sanitize_text_field($_POST['file_empty'])) && sanitize_text_field($_POST['file_empty']) =='no-file')
                        $errors['file'] = 'Image required.';
                     if(!empty(sanitize_text_field($_POST['file_empty'])) && sanitize_text_field($_POST['file_empty']) =='invalid-file')
                         $errors['file'] = 'Invalid image.';

                }  

                if(!intval($_POST['car_number_day']))
                    die();
                    
                if ( ! empty($errors)) {
                    $data['success'] = false;
                    $data['errors']  = $errors;
                }else{
                    $data['success']            = true;
                    $data['message']            = 'Success!';
                    $data['firstname']          = sanitize_text_field($_POST['firstname']);
                    $data['lastname']           = sanitize_text_field($_POST['lastname']);
                    $data['phone']              = sanitize_text_field($_POST['phone']);
                    $data['email']              = sanitize_email($_POST['email']);
                    $data['driver_name']        = sanitize_text_field($_POST['driver_name']);
                    $data['driver_phone']       = sanitize_text_field($_POST['driver_phone']);
                    $data['date_pick']          = sanitize_text_field($_POST['car_pick_date']);
                    $data['pick_time']          = sanitize_text_field($_POST['car_pick_time']);
                    $data['pick_location']      = sanitize_text_field($_POST['car_pick_location']);
                    $data['date_return']        = sanitize_text_field($_POST['car_return_date']);
                    $data['return_time']        = sanitize_text_field($_POST['car_return_time']);
                    $data['number_days']        = intval($_POST['car_number_day']);
                    $data['with_or_out_driver'] = sanitize_text_field($_POST['with_or_out_driver']);
                                       
                }
                break;


            case 'restau':
                if(!wp_verify_nonce($_POST['easync_restau_nonce'], 'easync_restau_to_pay')){
                    return 'Not Allowed!';
                }
                $temp_data = "";
                $temp_data2 ="";
                $temp_data3 ="";
                if (empty($_POST['check_dish']) || empty($_POST['qty'])){
                    $errors['menu_ids'] = 'Please select at least one item.';
                }else{
                    $check_dish = $_POST['check_dish'];
                    $qty = $_POST['qty'];
                    if($qty){
                        foreach($check_dish as $key => $value){
                            $temp_data  .= $value." ( QTY ".$qty[$key]."),";
                            $temp_data2 .= get_post($value)->post_title."(".$qty[$key]."),";
                            $temp_data3 .= (get_post_meta($value, 'sync_restau', true)['price'] * $qty[$key]);
                            $paypal_item[$key] = get_post($value)->post_title;//." ( QTY ".$_POST['qty'][$key].")"
                            $paypal_item_qty[$key] = $qty[$key];
                            $paypal_item_price[$key] = (get_post_meta($value, 'sync_restau', true)['price'] * $qty[$key]);
                        }  
                    }
                    
                    $data['paypal_items'] = $paypal_item;
                    $data['paypal_item_qtys'] = $paypal_item_qty;
                    $data['paypal_item_prices'] = $paypal_item_price;
                }
                if ( ! empty($errors)) {
                    $data['success'] = false;
                    $data['errors']  = $errors;
                }else{
                    $data['success']          = true;
                    $data['message']          = 'Success!'; 
                    $data['menu_ids']         = rtrim($temp_data,',');
                    $data['paypal_dis']       = rtrim($temp_data2,',');
                    $data['paypal_dis_price'] = $temp_data3;
                }
                break;



            case 'restau-second':
                if (empty(sanitize_text_field($_POST['name'])))
                    $errors['namee']     = 'This field is required.';

                if (empty(sanitize_email($_POST['email'])))
                    $errors['email']    = 'This field is required.';

                if (empty(sanitize_text_field($_POST['phone_no'])))
                    $errors['phone_no'] = 'This field is required.';

                if (empty(sanitize_text_field($_POST['branch'])))
                    $errors['branch']   = 'This field is required.';

                if (empty(sanitize_text_field($_POST['table_no'])))
                    $errors['table_no'] = 'This field is required.';

                if (empty(sanitize_text_field($_POST['guest_no'])))
                    $errors['guest_no'] = 'This field is required.';

                if (empty(sanitize_text_field($_POST['timeslot'])))
                    $errors['timeslot'] = 'This field is required.';

                if (empty(sanitize_text_field($_POST['picked_date'])))
                    $errors['picked_date'] = 'This field is required.';

                if(!intval($_POST['guest_no']))
                    die();

                if(!intval($_POST['table_no']))
                    die();   

                if ( ! empty($errors)) {
                    $data['success'] = false;
                    $data['errors']  = $errors;
                }else{
                    $data['success']     = true;
                    $data['message']     = 'Success!';
                    $data['name']        =  sanitize_text_field($_POST['name']);
                    $data['email']       =  sanitize_email($_POST['email']);
                    $data['phone_no']    =  sanitize_text_field($_POST['phone_no']);
                    $data['branch']      =  sanitize_text_field($_POST['branch']);
                    $data['guest_no']    =  intval($_POST['guest_no']);
                    $data['table_no']    =  intval($_POST['table_no']);
                    $data['timeslot']    =  sanitize_text_field($_POST['timeslot']);
                    $data['picked_date'] =  sanitize_text_field($_POST['picked_date']);
                }
                break;


            case 'car-payment':
            case 'hotel-payment':
            case 'restau-payment':
                if(!wp_verify_nonce($_POST['easync_payment_nonce'], 'easync_payment')){
                    return 'Not Allowed!';
                }
                if (empty(sanitize_text_field($_POST['address_1'])))
                    $errors['address_1']     = 'The address 1 field is required.';

                if (empty(sanitize_text_field($_POST['address_2'])))
                    $errors['address_2']    = 'The address 2 field  is required.';

                if (empty(sanitize_text_field($_POST['city'])))
                    $errors['city'] = 'The city field  is required.';

                if (empty(sanitize_text_field($_POST['province'])))
                    $errors['province']   = 'The province field is required.';

                if (empty(sanitize_text_field($_POST['postal_code'])))
                    $errors['postal_code'] = 'The postal_code field is required.';

                if ( ! empty($errors)) {
                    $data['success'] = false;
                    $data['errors']  = $errors;
                }else{
                    $data['success'] = true;
                }
                
                break;
          
          default:
              echo "error";
              break;
      }      


   echo json_encode($data);
   die();
}

add_action("wp_ajax_nopriv_easync_session_store", "easync_session_store");
add_action("wp_ajax_easync_session_store", "easync_session_store");
function easync_session_store() {
    global $wpdb;
    session_start();
    $data       = array(); 
    $errors     = array();       
    $entries    = array();
    $trigger_on = 'save';
    $table      = $wpdb->prefix . "sync_options";
    $data['success']   = false;
    $data['message']   = 'failed!';

    $type = '';
    $sani_type = sanitize_text_field($_POST['type']);
    if(isset($sani_type)) {
        $type = $sani_type;
    }

    switch ($type) {
        case 'hotel':
            $meta                     = get_post_meta( sanitize_text_field($_POST['room_id']), 'sync_hotel', true );
            $data['subtotal']         = (sanitize_text_field($meta['price']) * (sanitize_text_field($_POST['room_number']) * sanitize_text_field($_POST['night_number'])));
            $data['total']            = $data['subtotal'];
            $data['success']          = true;
            $data['message']          = 'Success!';
      
              $table = $wpdb->prefix . "sync_hotel_entries";
              $entries = array(
                      'firstname'         =>   sanitize_text_field($_POST['firstname']),
                      'lastname'          =>   sanitize_text_field($_POST['lastname']),
                      'phone'             =>   sanitize_text_field($_POST['phone']),
                      'email'             =>   sanitize_email($_POST['email']),
                      'room_id'           =>   sanitize_text_field($_POST['room_id']),
                      'arrival_date'      =>   sanitize_text_field($_POST['arrival_date']),       
                      'departure_date'    =>   sanitize_text_field($_POST['departure_date']),
                      'night_number'      =>   intval($_POST['night_number']),
                      'guest_number'      =>   intval($_POST['guest_number']),
                      'room_number'       =>   intval($_POST['room_number']),
                      'facility_request'  =>   sanitize_text_field($_POST['facility_request']), //bug here
                      'other_req'         =>   sanitize_text_field($_POST['other_req']),
                      'address_1'         =>   sanitize_text_field($_POST['address_1']) ,
                      'address_2'         =>   sanitize_text_field($_POST['address_2']),
                      'city'              =>   sanitize_text_field($_POST['city']),
                      'province'          =>   sanitize_text_field($_POST['province']),
                      'postal_code'       =>   sanitize_text_field($_POST['postal_code']),
                      'status'            =>   'pending',

              );
              // var_dump($entries['room_number']);
              
              $_SESSION['sync_entries'] = $entries;
            break;


        case 'car':
            $meta                       = get_post_meta( sanitize_text_field($_POST['car_id']), 'sync_car', true );
            $data['subtotal']           = ($meta['price'] * sanitize_text_field($_POST['number_days']));
            $data['total']              = $data['subtotal'];
            $data['success']            = true;
            $data['message']            = 'Success!';

            $image_path = '';
            if(sanitize_text_field($_POST['with_driver'])=='self-driven') {
                $uploads = wp_upload_dir();
                $driver_license_image = array('driver_license_image1', 'driver_license_image2');
                $validextensions = array("jpeg", "jpg", "png");
                foreach ($driver_license_image as $key => $value) {
                    $unique_name = md5(uniqid());      
                    $ext = explode('.', basename($_FILES[$value]['name']));   
                    $target_path =  esc_url($uploads['basedir'].'/') . $unique_name . "." . $ext[count($ext) - 1];   
                    if (move_uploaded_file($_FILES[$value]['tmp_name'], $target_path)) { 
                        $image_path .= esc_url($uploads['baseurl'].'/').$unique_name . "." . $ext[count($ext) - 1].'|';
                    }else{
                        $image_path = 'error';
                        $data['message']  = 'please try again!.';
                    }
                }   
                $image_path = rtrim($image_path,'|');
            }

            $table = $wpdb->prefix . "sync_rent_car_entries";
            $entries = array(
                    'firstname'         =>   sanitize_text_field($_POST['firstname']),
                    'lastname'          =>   sanitize_text_field($_POST['lastname']),
                    'phone'             =>   sanitize_text_field($_POST['phone']),
                    'email'             =>   sanitize_email($_POST['email']),
                    'with_driver'       =>   sanitize_text_field($_POST['with_or_out_driver']),
                    'd_name'            =>   sanitize_text_field($_POST['driver_name']),
                    'd_phone'           =>   sanitize_text_field($_POST['driver_phone']),
                    'd_license_image'   =>   $image_path,
                    'car_id'            =>   sanitize_text_field($_POST['car_id']),
                    'pick_date'         =>   sanitize_text_field($_POST['date_pick']),       
                    'pick_time'         =>   sanitize_text_field($_POST['pick_time']),
                    'return_date'       =>   sanitize_text_field($_POST['date_return']),
                    'return_time'       =>   sanitize_text_field($_POST['return_time']),
                    'pick_location'     =>   sanitize_text_field($_POST['pick_location']),
                    'number_days'       =>   intval($_POST['number_days']),
                    'address_1'         =>   sanitize_text_field($_POST['address_1']),
                    'address_2'         =>   sanitize_text_field($_POST['address_2']),
                    'city'              =>   sanitize_text_field($_POST['city']),
                    'province'          =>   sanitize_text_field($_POST['province']),
                    'postal_code'       =>   sanitize_text_field($_POST['postal_code']),
                    'status'            =>   'pending',

            );

            //$_SESSION['sries'] =ync_ent $entries;
            $_SESSION['sync_entries'] = $entries;
            break;


        case 'restau':
            $table   = $wpdb->prefix . "sync_restau_entries";
            $data['success']        = true;
            $data['message']        = 'Success!';
            $entries = array(
                    'name'          =>   sanitize_text_field($_POST['name']),
                    'phone'         =>   sanitize_text_field($_POST['phone_no']),
                    'email'         =>   sanitize_email($_POST['email']),
                    'branch'        =>   sanitize_text_field($_POST['branch']),
                    'guest_no'      =>   intval($_POST['guest_no']),
                    'table_no'      =>   intval($_POST['table_no']),       
                    'timeslot'      =>   sanitize_text_field($_POST['timeslot']),
                    'pick_date'     =>   sanitize_text_field($_POST['picked_date']),
                    'menu_ids'      =>   sanitize_text_field($_POST['menu_ids']),
                    'address_1'     =>   sanitize_text_field($_POST['address_1']),
                    'address_2'     =>   sanitize_text_field($_POST['address_2']),
                    'city'          =>   sanitize_text_field($_POST['city']),
                    'province'      =>   sanitize_text_field($_POST['province']),
                    'postal_code'   =>   sanitize_text_field($_POST['postal_code']),
                    'status'        =>   'pending',
            );

            $_SESSION['sync_entries'] = $entries;
            break;
        
        default:
            echo "error";       
            break;
    }

    echo json_encode($data);
    die();
}

add_action("wp_ajax_easync_setting_save", "easync_setting_save");
function easync_setting_save() {

    global $wpdb;
    $data       = array(); 
    $errors     = array();       
    $entries    = array();
    $trigger_on = 'save';
    $option     = '';
    $table      = $wpdb->prefix . "sync_options"; 
    $data['success']          = false;
    $data['message']          = 'failed!';

    $type = '';
    $sani_type = sanitize_text_field($_POST['type']);
    if(isset($sani_type)) {
        $type = $sani_type;
    }

    switch ($type) {


        case 'option_paypal_set':
            $temp_val = sanitize_text_field($_POST['sync_paypal_sandbox']).'<>'.sanitize_text_field($_POST['sync_paypal_production']).'<>'.sanitize_text_field($_POST['sync_paypal_use']);
            if(empty(sanitize_text_field($_POST['sync_paypal_production'])) ) {

                $temp_val = sanitize_text_field($_POST['sync_paypal_sandbox']).'<>none<>'.sanitize_text_field($_POST['sync_paypal_use']);
            }
            if(empty(sanitize_text_field($_POST['sync_paypal_sandbox'])) ) {

                $temp_val = 'none<>'.sanitize_text_field($_POST['sync_paypal_production']).'<>'.sanitize_text_field($_POST['sync_paypal_use']);
            }
            if(empty(sanitize_text_field($_POST['sync_paypal_use'])) ) {

                $temp_val = 'none<>'.sanitize_text_field($_POST['sync_paypal_production']).'<>sandbox';
            }     
            $row = $wpdb->get_results(  "SELECT * FROM $table WHERE option_name = 'sync_paypal_setting'");
            if(empty($row)) {
                $entries_pay = array(
                     'option_name'    =>   'sync_paypal_setting',
                     'option_value'   =>   $temp_val,
                );
                $wpdb->insert($table, $entries_pay);
            }else{     
                $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_val, 'sync_paypal_setting' )
                );
            }
            
            $data['success']  = true;
            $data['message']   = 'success!';
            break;


        case 'option_default_car_time':
            $temp_val = sanitize_text_field($_POST['sync_default_pickup']).'-'.sanitize_text_field($_POST['sync_default_return']);
            if(!empty(sanitize_text_field($_POST['sync_default_return'])) && !empty(sanitize_text_field($_POST['sync_default_pickup'])) && wp_verify_nonce($_POST['easync_car_default_time_nonce'], 'easync_car_default_time')) {

                $wpdb->query($wpdb->prepare("UPDATE $table 
                             SET option_value = %s
                             WHERE option_name = %s", $temp_val, 'sync_car_default_time' )
                );
                $trigger_on = 'update';
                $data['success']  = true;
                $data['message']   = 'success!';
            }
            break;


        case 'option_product_currency':
            $temp_val = sanitize_text_field($_POST['sync_currency_name']);
            $row = $wpdb->get_results(  "SELECT * FROM $table
                WHERE option_name = 'sync_product_currency_code'");
            if(!empty(sanitize_text_field($_POST['sync_currency_name']))) {
                if(empty($row)) {
                    $entries = array(
                             'option_name'    =>   'sync_product_currency_code',
                             'option_value'   =>   $temp_val,
                        );
                }else{
                     $wpdb->query($wpdb->prepare("UPDATE $table 
                                     SET option_value = %s
                                     WHERE option_name = %s", $temp_val, 'sync_product_currency_code' )
                        );
                        $trigger_on = 'update';
                }
                $data['success']  = true;
                $data['message']   = 'success!';
            }
            break;


        case 'option_switch_hotel':
            $row = $wpdb->get_results(  "SELECT * FROM $table
            WHERE option_name = 'sync_switch_hotel'");
            $on = '';
            if(!empty(sanitize_text_field($_POST['sync_switch']))) {
                $on = sanitize_text_field($_POST['sync_switch']);
            }else{
                $on = 'off';
            }
            if(empty($row)) {
                $entries = array(
                         'option_name'    =>   'sync_switch_hotel',
                         'option_value'   =>   $on,
                    );
            }else{
                 $wpdb->query($wpdb->prepare("UPDATE $table 
                                 SET option_value = %s
                                 WHERE option_name = %s", $on, 'sync_switch_hotel' )
                    );
                    $trigger_on = 'update';
            }
            $data['success']        = true;
            $data['message']        = 'Success!';
            break;


        case 'option_switch_car':
            $row = $wpdb->get_results(  "SELECT * FROM $table
            WHERE option_name = 'sync_switch_car'");
            $on = '';
            if(!empty(sanitize_text_field($_POST['sync_switch']))) {
                $on = sanitize_text_field($_POST['sync_switch']);
            }else{
                $on = 'off';
            }
            if(empty($row)) {
                $entries = array(
                         'option_name'    =>   'sync_switch_car',
                         'option_value'   =>   $on,
                    );
            }else{
                 $wpdb->query($wpdb->prepare("UPDATE $table 
                                 SET option_value = %s
                                 WHERE option_name = %s", $on, 'sync_switch_car' )
                    );
                    $trigger_on = 'update';
            }
            $data['success']        = true;
            $data['message']        = 'Success!';
            break;


        case 'option_switch_restau':
            $row = $wpdb->get_results(  "SELECT * FROM $table
            WHERE option_name = 'sync_switch_restau'");
            $on = '';
            if(!empty(sanitize_text_field($_POST['sync_switch']))) {
                $on = sanitize_text_field($_POST['sync_switch']);
            }else{
                $on = 'off';
            }
            if(empty($row)) {
                $entries = array(
                         'option_name'    =>   'sync_switch_restau',
                         'option_value'   =>   $on,
                    );
            }else{
                 $wpdb->query($wpdb->prepare("UPDATE $table 
                                 SET option_value = %s
                                 WHERE option_name = %s", $on, 'sync_switch_restau' )
                    );
                    $trigger_on = 'update';
            }
            $data['success']        = true;
            $data['message']        = 'Success!';
            break;


        case 'option_branch':
            if(!empty(sanitize_text_field($_POST['branch_name'])) && wp_verify_nonce($_POST['easync_restau_branch_nonce'], 'easync_restau_branch')) {
                 $temp_id   = sanitize_text_field($_POST['branch_id']);
                 $temp_name = sanitize_text_field($_POST['branch_name']);
                 if($_POST['trig']=='save') {
                    $entries = array(
                         'option_name'    =>   'sync_branch_locations',
                         'option_value'   =>   $temp_name,

                    );
                 }else if($_POST['trig']=='update') {
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE id = %d", $temp_name, $temp_id)
                    );
                    $trigger_on = 'update';
                 }else if($_POST['trig']=='delete') {
                    $wpdb->query($wpdb->prepare("DELETE FROM $table 
                                WHERE id = %d", $temp_id)
                    );
                    $trigger_on = 'delete';
                 }

                 $option          = 'sync_branch_locations';

                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;


        case 'option_currency':
            if(!empty(sanitize_text_field($_POST['sync_currency_name']))) {
                 $temp_id   = sanitize_text_field($_POST['sync_currency_id']);
                 $temp_name = sanitize_text_field($_POST['sync_currency_name']);
                 if($_POST['trig']=='save') {
                    $entries = array(
                         'option_name'    =>   'sync_currency',
                         'option_value'   =>   $temp_name,

                    );
                 }else if(sanitize_text_field($_POST['trig'])=='update') {
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE id = %d", $temp_name, $temp_id)
                    );
                    $trigger_on = 'update';
                 }else if($_POST['trig']=='delete') {
                    $wpdb->query($wpdb->prepare("DELETE FROM $table 
                                WHERE id = %d", $temp_id)
                    );
                    $trigger_on = 'delete';
                 }

                 $option          = 'sync_currency';

                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;


        case 'option_pickup_location':
            if(!empty(sanitize_text_field($_POST['location_name'])) && wp_verify_nonce($_POST['easync_car_pickup_nonce'], 'easync_car_pickup')) {
                 $temp_id   = sanitize_text_field($_POST['pickup_id']);
                 $temp_name =sanitize_text_field($_POST['location_name']);  
                 if($_POST['trig']=='save') {
                    $entries = array(
                         'option_name'    =>   'sync_car_pickup',
                         'option_value'   =>   $temp_name,
                    );
                 }else if(sanitize_text_field($_POST['trig'])=='update') {
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE id = %d", $temp_name, $temp_id)
                    );
                    $trigger_on = 'update';
                 }else if(sanitize_text_field($_POST['trig'])=='delete') {
                    $wpdb->query($wpdb->prepare("DELETE FROM $table 
                                WHERE id = %d", $temp_id)
                    );
                    $trigger_on = 'delete';
                 }

                $option           = 'sync_car_pickup';

                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;


        case 'option_car_types':
            if(!empty(sanitize_text_field($_POST['type_name'])) && wp_verify_nonce($_POST['easync_car_types_nonce'], 'easync_car_types')) {
                 $temp_id   = sanitize_text_field($_POST['type_id']);
                 $temp_name = sanitize_text_field($_POST['type_name']); 
                 if(sanitize_text_field($_POST['trig'])=='save') {
                    $entries = array(
                         'option_name'    =>   'sync_car_types',
                         'option_value'   =>   $temp_name,
                    );
                 }else if(sanitize_text_field($_POST['trig'])=='update') {
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE id = %d", $temp_name, $temp_id)
                    );
                    $trigger_on = 'update';
                 }else if(sanitize_text_field($_POST['trig'])=='delete') {
                    $wpdb->query($wpdb->prepare("DELETE FROM $table 
                                WHERE id = %d", $temp_id)
                    );
                    $trigger_on = 'delete';
                 }

                $option           = 'sync_car_types';

                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;

        case 'option_car_thanks':
            if(!empty(sanitize_text_field($_POST['sync_car_thank_you'])) && wp_verify_nonce($_POST['easync_car_thank_u_nonce'], 'easync_car_thank_u')) {
                 $temp_name = sanitize_text_field($_POST['sync_car_thank_you']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_car_page_thank_u'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_car_page_thank_u',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_car_page_thank_u")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;

        case 'option_car_privacy':
            if(!empty(sanitize_text_field($_POST['sync_car_privacy'])) && wp_verify_nonce($_POST['easync_car_privacy_nonce'], 'easync_car_privacy')) {
                 $temp_name = sanitize_text_field($_POST['sync_car_privacy']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_car_page_privacy'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_car_page_privacy',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_car_page_privacy")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;

        case 'option_car_terms':
            if(!empty(sanitize_text_field($_POST['sync_car_terms'])) && wp_verify_nonce($_POST['easync_car_terms_nonce'], 'easync_car_terms')) {
                 $temp_name = sanitize_text_field($_POST['sync_car_terms']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_car_page_terms'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_car_page_terms',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_car_page_terms")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;          


        case 'option_hotel_thanks':
            if(!empty($_POST['sync_hotel_thank_you']) && wp_verify_nonce($_POST['easync_hotel_thank_you_nonce'], 'easync_hotel_thank_you')) {
                 $temp_name = sanitize_text_field($_POST['sync_hotel_thank_you']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_hotel_page_thank_u'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_hotel_page_thank_u',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_hotel_page_thank_u")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;


        case 'option_hotel_privacy':
            if(!empty(sanitize_text_field($_POST['sync_hotel_privacy'])) && wp_verify_nonce($_POST['easync_hotel_privacy_nonce'], 'easync_hotel_privacy')) {
                 $temp_name = sanitize_text_field($_POST['sync_hotel_privacy']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_hotel_page_privacy'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_hotel_page_privacy',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_hotel_page_privacy")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;

        
        case 'option_hotel_terms':
            if(!empty(sanitize_text_field($_POST['sync_hotel_terms'])) && wp_verify_nonce($_POST['easync_hotel_terms_nonce'], 'easync_hotel_terms')) {
                 $temp_name = sanitize_text_field($_POST['sync_hotel_terms']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_hotel_page_terms'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_hotel_page_terms',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table_check 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_hotel_page_terms")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;

        case 'option_restau_thanks':
            if(!empty(sanitize_text_field($_POST['sync_restau_thank_you'])) && wp_verify_nonce($_POST['easync_restau_thank_u_nonce'], 'easync_restau_thank_u')) {
                 $temp_name = sanitize_text_field($_POST['sync_restau_thank_you']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_restau_page_thank_u'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_restau_page_thank_u',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_restau_page_thank_u")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;


        case 'option_restau_privacy':
            if(!empty(sanitize_text_field($_POST['sync_restau_privacy'])) && wp_verify_nonce($_POST['easync_restau_privacy_nonce'], 'easync_restau_privacy')) {
                 $temp_name = sanitize_text_field($_POST['sync_restau_privacy']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_restau_page_privacy'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_restau_page_privacy',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_restau_page_privacy")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;


        case 'option_restau_terms':
            if(!empty(sanitize_text_field($_POST['sync_restau_terms'])) && wp_verify_nonce($_POST['easync_restau_terms_nonce'], 'easync_restau_terms')) {
                 $temp_name = sanitize_text_field($_POST['sync_restau_terms']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_restau_page_terms'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_restau_page_terms',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_restau_page_terms")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;  

        case 'option_banner_image':
            if(!empty(sanitize_text_field($_POST['myprefix_image_id'])) && wp_verify_nonce($_POST['easync_restau_banner_image_nonce'], 'easync_restau_banner_image')) {
                 $temp_name = sanitize_text_field($_POST['myprefix_image_id']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_restau_banner_image'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_restau_banner_image',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_restau_banner_image")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;

        case 'option_restau_email_head_notify':
            if(/*!empty(sanitize_text_field($_POST['email-header-text']))*/ wp_verify_nonce($_POST['easync_restau_email_head_notify_nonce'], 'easync_restau_email_head_notify')) {
                 $temp_name = sanitize_text_field($_POST['email-header-text']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_restau_email_head_notify'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_restau_email_head_notify',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_restau_email_head_notify")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            //}else{
            //  $data['success']  = false;
            }
            break;


        case 'option_restau_email_foot_notify':
            if(/*!empty(sanitize_text_field($_POST['email-footer-text']))*/ wp_verify_nonce($_POST['easync_restau_email_foot_notify_nonce'], 'easync_restau_email_foot_notify')) {
                 $temp_name = sanitize_text_field($_POST['email-footer-text']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_restau_email_foot_notify'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_restau_email_foot_notify',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_restau_email_foot_notify")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            //}else{
            //  $data['success']  = false;
            }
            break;

        
        case 'option_car_email_head_notify':
            if(wp_verify_nonce($_POST['easync_car_email_head_notify_nonce'], 'easync_car_email_head_notify')) {
                 $temp_name = sanitize_text_field($_POST['email-header-text']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_car_email_head_notify'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_car_email_head_notify',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_car_email_head_notify")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            //}else{
            //  $data['success']  = false;
           }
            break;


        case 'option_car_email_foot_notify':
            if(wp_verify_nonce($_POST['easync_car_email_foot_notify_nonce'], 'easync_car_email_foot_notify')) {
                 $temp_name = sanitize_text_field($_POST['email-footer-text']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_car_email_foot_notify'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_car_email_foot_notify',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_car_email_foot_notify")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            //}else{
            //  $data['success']  = false;
            }
            break;

        case 'option_hotel_email_head_notify':
            if(wp_verify_nonce($_POST['easync_hotel_email_head_notify_nonce'], 'easync_hotel_email_head_notify')) {
                 $temp_name = sanitize_text_field($_POST['email-header-text']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_hotel_email_head_notify'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_hotel_email_head_notify',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_hotel_email_head_notify")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            //}else{
            //  $data['success']  = false;
            }
            break;


        case 'option_hotel_email_foot_notify':
            if(wp_verify_nonce($_POST['easync_hotel_email_foot_notify_nonce'], 'easync_hotel_email_foot_notify')) {
                 $temp_name = sanitize_text_field($_POST['email-footer-text']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_hotel_email_foot_notify'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_hotel_email_foot_notify',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_hotel_email_foot_notify")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            //}else{
            //  $data['success']  = false;
            }
            break;                                                  


        case 'option_email_image':
            if(!empty(sanitize_text_field($_POST['myprefix_image_id']))) {
                 $temp_name =sanitize_text_field($_POST['myprefix_image_id']);
                 $table_check = $wpdb->prefix . "sync_options"; 
                 $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", 'sync_user_email_image'));
                 if(count($check) == 0) {
                    $entries = array(
                         'option_name'    =>   'sync_user_email_image',
                         'option_value'   =>   $temp_name,
                    );
                 }else{
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE option_name = %s", $temp_name, "sync_user_email_image")
                    );
                    $trigger_on = 'update';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;          


        case 'option_car_model':
            if(!empty(sanitize_text_field($_POST['model_name']))  && wp_verify_nonce($_POST['easync_car_model_nonce'], 'easync_car_model')) {
                 $temp_id   = sanitize_text_field($_POST['model_id']);
                 $temp_name = sanitize_text_field($_POST['model_name']);    
                 if(sanitize_text_field($_POST['trig'])=='save') {
                    $entries = array(
                         'option_name'    =>   'sync_car_model',
                         'option_value'   =>   $temp_name,
                    );
                 }else if(sanitize_text_field($_POST['trig'])=='update') {
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE id = %d", $temp_name, $temp_id)
                    );
                    $trigger_on = 'update';
                 }else if(sanitize_text_field($_POST['trig'])=='delete') {
                    $wpdb->query($wpdb->prepare("DELETE FROM $table 
                                WHERE id = %d", $temp_id)
                    );
                    $trigger_on = 'delete';
                 }

                 $option          = 'sync_car_model';

                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;          


        case 'option_billing_province':
            if(!empty(sanitize_text_field($_POST['province_name']))) {
                 $temp_id   = sanitize_text_field($_POST['province_id']);
                 $temp_name = sanitize_text_field($_POST['province_name']); 
                 if(sanitize_text_field($_POST['trig'])=='save') {
                    $entries = array(
                         'option_name'    =>   'sync_billing_province',
                         'option_value'   =>   $temp_name,
                    );
                 }else if(sanitize_text_field($_POST['trig'])=='update') {
                    $wpdb->query($wpdb->prepare("UPDATE $table 
                                SET option_value = %s
                                WHERE id = %d", $temp_name, $temp_id)
                    );
                    $trigger_on = 'update';
                 }else if(sanitize_text_field($_POST['trig'])=='delete') {
                    $wpdb->query($wpdb->prepare("DELETE FROM $table 
                                WHERE id = %d", $temp_id)
                    );
                    $trigger_on = 'delete';
                 }
                $data['success']  = true;
            }else{
                $data['success']  = false;
            }
            break;


        case 'option_timeslot1':
            $temp_val = sanitize_text_field($_POST['timeslot1']).'-'.sanitize_text_field($_POST['timeslot1_1']);
            $row = $wpdb->get_results(  "SELECT * FROM $table
                WHERE option_name = 'sync_timeslot1'");
            if(!empty(sanitize_text_field($_POST['timeslot1'])) && !empty(sanitize_text_field($_POST['timeslot1_1'])) && wp_verify_nonce($_POST['easync_restau_timeslot_1_nonce'], 'easync_restau_timeslot_1')) {
                if(empty($row)) {
                    $entries = array(
                             'option_name'    =>   'sync_timeslot1',
                             'option_value'   =>   $temp_val,
                        );
                }else{
                     $wpdb->query($wpdb->prepare("UPDATE $table 
                                     SET option_value = %s
                                     WHERE option_name = %s", $temp_val, 'sync_timeslot1' )
                        );
                        $trigger_on = 'update';
                }
                $data['success']  = true;
            }else{  
                $data['success']  = false;
            }
            break;


        case 'option_timeslot2':
            $temp_val = sanitize_text_field($_POST['timeslot2']).'-'.sanitize_text_field($_POST['timeslot1_2']);
            $row = $wpdb->get_results(  "SELECT * FROM $table
                WHERE option_name = 'sync_timeslot2'");
            if(!empty(sanitize_text_field($_POST['timeslot2'])) && !empty(sanitize_text_field($_POST['timeslot1_2'])) && wp_verify_nonce($_POST['easync_restau_timeslot_2_nonce'], 'easync_restau_timeslot_2')) {
                if(empty($row)) {
                    $entries = array(
                             'option_name'    =>   'sync_timeslot2',
                             'option_value'   =>   $temp_val,
                        );
                }else{
                     $wpdb->query($wpdb->prepare("UPDATE $table 
                                     SET option_value = %s
                                     WHERE option_name = %s", $temp_val, 'sync_timeslot2' )
                        );
                        $trigger_on = 'update';
                }
                $data['success']  = true;
            }else{  
                $data['success']  = false;
            }
            break;


        case 'option_timeslot3':
            $temp_val = sanitize_text_field($_POST['timeslot3']).'-'.sanitize_text_field($_POST['timeslot1_3']);
            $row = $wpdb->get_results(  "SELECT * FROM $table
                WHERE option_name = 'sync_timeslot3'");
            if(!empty(sanitize_text_field($_POST['timeslot3'])) && !empty(sanitize_text_field($_POST['timeslot1_3'])) && wp_verify_nonce($_POST['easync_restau_timeslot_3_nonce'], 'easync_restau_timeslot_3')) {
                if(empty($row)) {
                    $entries = array(
                             'option_name'    =>   'sync_timeslot3',
                             'option_value'   =>   $temp_val,
                        );
                }else{
                     $wpdb->query($wpdb->prepare("UPDATE $table 
                                     SET option_value = %s
                                     WHERE option_name = %s", $temp_val, 'sync_timeslot3' )
                        );
                        $trigger_on = 'update';
                }
                $data['success']  = true;
            }else{  
                $data['success']  = false;
            }
            break;


        case 'option_timeslot4':
            $temp_val = sanitize_text_field($_POST['timeslot4']).'-'.sanitize_text_field($_POST['timeslot1_4']);
            $row = $wpdb->get_results(  "SELECT * FROM $table
                WHERE option_name = 'sync_timeslot4'");
            if(!empty(sanitize_text_field($_POST['timeslot4'])) && !empty(sanitize_text_field($_POST['timeslot1_4'])) && wp_verify_nonce($_POST['easync_restau_timeslot_4_nonce'], 'easync_restau_timeslot_4')) {
                if(empty($row)) {
                    $entries = array(
                             'option_name'    =>   'sync_timeslot4',
                             'option_value'   =>   $temp_val,
                        );
                }else{
                     $wpdb->query($wpdb->prepare("UPDATE $table 
                                     SET option_value = %s
                                     WHERE option_name = %s", $temp_val, 'sync_timeslot4' )
                        );
                        $trigger_on = 'update';
                }
                $data['success']  = true;
            }else{  
                $data['success']  = false;
            }
            break;


        case 'option_timeslot5':
            $temp_val = sanitize_text_field($_POST['timeslot5']).'-'.sanitize_text_field($_POST['timeslot1_5']);
            $row = $wpdb->get_results(  "SELECT * FROM $table
                WHERE option_name = 'sync_timeslot5'");
            if(!empty(sanitize_text_field($_POST['timeslot5'])) && !empty(sanitize_text_field($_POST['timeslot1_5'])) && wp_verify_nonce($_POST['easync_restau_timeslot_5_nonce'], 'easync_restau_timeslot_5')) {
                if(empty($row)) {
                    $entries = array(
                             'option_name'    =>   'sync_timeslot5',
                             'option_value'   =>   $temp_val,
                        );
                }else{
                     $wpdb->query($wpdb->prepare("UPDATE $table 
                                     SET option_value = %s
                                     WHERE option_name = %s", $temp_val, 'sync_timeslot5' )
                        );
                        $trigger_on = 'update';
                }
                $data['success']  = true;
            }else{  
                $data['success']  = false;
            }
            break;

        
        default:

            echo "error";
    }

    if($data['success']==true && $trigger_on == 'save') 
    $wpdb->insert($table, $entries);
    $data['entries']  = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table WHERE option_name = %s ORDER BY id DESC", $option)); 

    echo json_encode($data);
    die();
}

add_action("wp_ajax_easync_reserved_event", "easync_reserved_event");
function easync_reserved_event() {

    global $wpdb, $sync_default_rate, $sync_emailtemplate_image, $smtpuser;
    $data             = array(); 
    $errors           = array();       
    $entries          = array();
    $data['success']  = false;
    $data['message']  = 'failed!';

    $email_entry = array(); 
    $user_email = '';
    $noti_for   = '';
    $greet_name = '';
    $type = '';
    $sani_type = sanitize_text_field($_POST['type']);
    if(isset($sani_type)) {
        $type = $sani_type;
    }
    switch ($type) {
        
        case 'hotel':
            $table = $wpdb->prefix . "sync_hotel_entries";
            $table2 = $wpdb->prefix . "sync_payments";
            $table3 = $wpdb->prefix . "sync_options";
            if(!empty(sanitize_text_field($_POST['reserve_event_id'])) && !empty(sanitize_text_field($_POST['reserve_event_option']))) {
                $wpdb->query($wpdb->prepare("UPDATE $table 
                                     SET status = %s
                                     WHERE id = %s", sanitize_text_field($_POST['reserve_event_option']), sanitize_text_field($_POST['reserve_event_id'] ))
                        );

                $entries =  $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table WHERE id = %s", sanitize_text_field($_POST['reserve_event_id'])));
                
                if(count($entries) > 0) {
                        $amount =  $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table2 WHERE item_belongsto = %s AND item_cat = %s", sanitize_text_field($_POST['reserve_event_id']), 'hotel'));

                        $price = '';
                        if(count($amount) > 0) {
                             $price = $amount[0]->currency_code.' '.$amount[0]->payment_gross;
                        }

                        $greet_name = ucfirst($entries[0]->firstname);
                        $user_email = $entries[0]->email;
                        $email_entry['Room Type']          = ucfirst(get_post($entries[0]->room_id)->post_title);
                        $email_entry['First Name']          = ucfirst($entries[0]->firstname);
                        $email_entry['Last Name']           = ucfirst($entries[0]->lastname);
                        $email_entry['Phone']              = $entries[0]->phone;
                        $email_entry['Email']              = $entries[0]->email;
                        $email_entry['Check-in']           = $entries[0]->arrival_date;
                        $email_entry['Check-out']          = $entries[0]->departure_date;
                        $email_entry['Night(s)']             = $entries[0]->night_number;
                        $email_entry['Number of Guest(s)']       = $entries[0]->guest_number;
                        $email_entry['Total Room(s)']         = $entries[0]->room_number;
                        $email_entry['Facility Requested'] = $entries[0]->facility_request;
                        $email_entry['Other Request(s)']          = (($entries[0]->number_days!='') ? $entries[0]->number_days : 'N/A');
                        $email_entry['Address 1']          = ucfirst($entries[0]->address_1);
                        $email_entry['Address 2']          = ucfirst($entries[0]->address_2);
                        $email_entry['City']               = ucfirst($entries[0]->city);
                        $email_entry['Province']           = ucfirst($entries[0]->province);
                        $email_entry['Postal Code']        = $entries[0]->postal_code;
                        $email_entry['Status']             = 'Approved';
                        $email_entry['Amount Paid']        = $price;

                        $noti_for   = 'Room Booking Notification';
                  
                }

                $data['success']          = true;
                $data['message']          = 'success!';
                $data['typee']            = sanitize_text_field($_POST['type']);
                $data['header_msg']       = 'Your reservation request has been confirmed, please see and review your booking information below.';
                $data['footer_msg']       = 'Remember cleanliness is part of our daily routine, thank you for choosing us as your second home.';

                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table3 WHERE option_name = %s ORDER BY id DESC",'sync_hotel_email_head_notify' ) );
                if ( $entries && $entries[0]->option_value!='') {
                    $data['header_msg'] = $entries[0]->option_value;
                }

                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table3 WHERE option_name = %s ORDER BY id DESC",'sync_hotel_email_foot_notify' ) );
                if ( $entries && $entries[0]->option_value!='') {
                    $data['footer_msg'] = $entries[0]->option_value;
                }
            }   
            break;


        case 'car':
            $table = $wpdb->prefix . "sync_rent_car_entries";
            $table2 = $wpdb->prefix . "sync_payments";
            $table3 = $wpdb->prefix . "sync_options";
            if(!empty(sanitize_text_field($_POST['reserve_event_id'])) && !empty(sanitize_text_field($_POST['reserve_event_option']))) {
                $wpdb->query($wpdb->prepare("UPDATE $table 
                                     SET status = %s
                                     WHERE id = %s", sanitize_text_field($_POST['reserve_event_option']), sanitize_text_field($_POST['reserve_event_id'] ))
                        );

                $entries =  $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table WHERE id = %s", sanitize_text_field($_POST['reserve_event_id'])));
                if(count($entries) > 0) {
                        $meta = get_post_meta( $entries[0]->car_id, 'easync_car', true );

                        $amount =  $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table2 WHERE item_belongsto = %s AND item_cat = %s", sanitize_text_field($_POST['reserve_event_id']), 'car'));

                        $price = '';
                        if(count($amount) > 0) {
                             $price = $amount[0]->currency_code.' '.$amount[0]->payment_gross;
                        }

                        $date_start = new DateTime($entries[0]->pick_date);
                        $date_end   = new DateTime($entries[0]->return_date);

                        $number_days = $date_end->diff($date_start)->format("%a");


                        $greet_name = ucfirst($entries[0]->firstname);
                        $user_email = $entries[0]->email;
                        $email_entry['Car']            = get_post($entries[0]->car_id)->post_title;
                        $email_entry['Car Type']       = $meta['type'];
                        $email_entry['Car Model']      = $meta['model'];
                        $email_entry['First Name']     = ucfirst($entries[0]->firstname);
                        $email_entry['Last Name']      = ucfirst($entries[0]->lastname);
                        $email_entry['Phone']          = $entries[0]->phone;
                        $email_entry['Email']          = $entries[0]->email;
                        $email_entry['Driver']         = ucfirst($entries[0]->with_driver);
                        $email_entry['Pick Date']      = $entries[0]->pick_date;
                        $email_entry['Pick Time']      = $entries[0]->pick_time;
                        $email_entry['Return Date']    = $entries[0]->return_date;
                        $email_entry['Return Time']    = $entries[0]->return_time;
                        $email_entry['Pick Location']  = ucfirst($entries[0]->pick_location);
                        $email_entry['Number of Days'] = $number_days;
                        $email_entry['Address 1']      = ucfirst($entries[0]->address_1);
                        $email_entry['Address 2']      = ucfirst($entries[0]->address_2);
                        $email_entry['City']           = ucfirst($entries[0]->city);
                        $email_entry['Province']       = ucfirst($entries[0]->province);
                        $email_entry['Postal Code']    = $entries[0]->postal_code;
                        $email_entry['Status']         = 'Approved';
                        $email_entry['Amount Paid']    = $price;
                        
                        $noti_for   = 'Car Booking Notification';
                }

                $data['success']          = true;
                $data['message']          = 'success!';
                $data['typee']            = sanitize_text_field($_POST['type']);
                $data['header_msg']       = 'Your booking request has been confirmed, please see and review your booking information below.';
                $data['footer_msg']       = 'Remember always check your safety, pray before your travel and God bless your trip, thank you for choosing us as your rental provider.';

                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table3 WHERE option_name = %s ORDER BY id DESC",'sync_car_email_head_notify' ) );
                if ( $entries && $entries[0]->option_value!='') {
                    $data['header_msg'] = $entries[0]->option_value;
                }

                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table3 WHERE option_name = %s ORDER BY id DESC",'sync_car_email_foot_notify' ) );
                if ( $entries && $entries[0]->option_value!='') {
                    $data['footer_msg'] = $entries[0]->option_value;
                }
            }   
            break;


        case 'restau':
            $table = $wpdb->prefix . "sync_restau_entries";
            $table2 = $wpdb->prefix . "sync_payments";
            $table3 = $wpdb->prefix . "sync_options";
            if(!empty(sanitize_text_field($_POST['reserve_event_id'])) && !empty(sanitize_text_field($_POST['reserve_event_option']))) {
                $wpdb->query($wpdb->prepare("UPDATE $table 
                                     SET status = %s
                                     WHERE id = %s", sanitize_text_field($_POST['reserve_event_option']), sanitize_text_field($_POST['reserve_event_id'] ))
                        );

                $entries =  $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table WHERE id = %s", sanitize_text_field($_POST['reserve_event_id'])));
                if(count($entries) > 0) {

                    $amount =  $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table2 WHERE item_belongsto = %s AND item_cat = %s", sanitize_text_field($_POST['reserve_event_id']), 'restau'));

                    $price = '';
                    if(count($amount) > 0) {
                         $price = $amount[0]->currency_code.' '.$amount[0]->payment_gross;
                    }

                    $greet_name = ucfirst($entries[0]->name);
                    $user_email = $entries[0]->email;
                    $menu_list = explode(',', $entries[0]->menu_ids);
                    foreach ($menu_list as $key => $value) {
                         preg_match('#\((.*?)\)#', $value, $match);
                        $meta = get_post_meta( (int)$value, 'sync_restau', true );
                        $sub = $amount[0]->currency_code.' '.((int)trim($match[1],' QTY ') * floatval($meta['price']));
                        $email_entry['Menus'] .= '<span style="display:table;line-height:20px;text-align:right;float:right;">'.get_post($value)->post_title .' ('.$match[1].') '.$sub.'</span><br /> ';
                    }
                    $email_entry['Time Slot']        = $entries[0]->timeslot;
                    $email_entry['Total Guest(s)']   = $entries[0]->guest_no;
                    $email_entry['Total Table(s)']   = $entries[0]->table_no;
                    $email_entry['Branch']        = ucfirst($entries[0]->branch);
                    $email_entry['Name']          = ucfirst($entries[0]->name);
                    $email_entry['Picked Date']   = $entries[0]->pick_date;
                    $email_entry['Phone']         = $entries[0]->phone;
                    $email_entry['Email']         = $entries[0]->email;
                    $email_entry['Address 1']     = ucfirst($entries[0]->address_1);
                    $email_entry['Address 2']     = ucfirst($entries[0]->address_2);
                    $email_entry['City']          = ucfirst($entries[0]->city);
                    $email_entry['Province']      = ucfirst($entries[0]->province);
                    $email_entry['Postal Code']   = $entries[0]->postal_code;
                    $email_entry['Status']        = 'Approved';
                    $email_entry['Amount Paid']   = $price;

                    $noti_for   = 'Restaurant Reservation Notification';
                }

                $data['success']          = true;
                $data['message']          = 'success!';
                $data['typee']            = sanitize_text_field($_POST['type']);
                $data['header_msg']       = 'Your reservation request has been confirmed, please see and review your booking information below.';
                $data['footer_msg']       = 'Remember don\'t waste every single food you eat, it\'s a blessing from God, thank you.';

                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table3 WHERE option_name = %s ORDER BY id DESC",'sync_restau_email_head_notify' ) );
                if ( $entries && $entries[0]->option_value!='') {
                    $data['header_msg'] = $entries[0]->option_value;
                }

                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table3 WHERE option_name = %s ORDER BY id DESC",'sync_restau_email_foot_notify' ) );
                if ( $entries && $entries[0]->option_value!='') {
                    $data['footer_msg'] = $entries[0]->option_value;
                }
            }   
            break;


        case 'currency_symbol':
            if(!empty(sanitize_text_field($_POST['sync_currency_to'])) && !empty(sanitize_text_field($_POST['sync_currency_from'])) && !empty(sanitize_text_field($_POST['sync_prices']))) {
                $sync_default_rate = sanitize_text_field($_POST['sync_currency_to']);
                $data['newsymbol'] = sanitize_text_field($_POST['sync_currency_to']);
                $temp_price = array();
                foreach (sanitize_text_field($_POST['sync_prices']) as $key => $value) {
                    $temp_price[$key] = easyncExchangeRate($value, sanitize_text_field($_POST['sync_currency_from']), sanitize_text_field($_POST['sync_currency_to'])) ;
                }
                $data['test'] = $sync_default_rate;
                $data['newprice']  = $temp_price;
                $data['success']   = true;
                $data['message']   = 'success!';    
            }
            break;
        
        default:
            echo "error";
            break;
    }

    $send = 'no';


    if($data['typee']=='car' || $data['typee']=='hotel' || $data['typee']=='restau') {
        if($data['success']==true && !empty(sanitize_text_field($_POST['reserve_event_option'])) && strtolower($_POST['reserve_event_option']) == 'active') {
            $send = 'yes';
        }
    }
    
    if($send=='yes') {

        require_once("user-email-template.php");

        $to        = $user_email; // this is your Email address
        $from      = get_option('admin_email'); // this is the sender's Email address

        $headers   = "MIME-Version: 1.0" . "\r\n";
        $headers   .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers   .= 'From: '.get_bloginfo( 'name' ).'<'.$from .'>' . "\r\n";
        $subject   = 'eaSYNC-Booking Reservation';
        $message   = $htmlContent;
        
        $headers2  = "MIME-Version: 1.0" . "\r\n";
        $headers2  .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers2  .= 'From: '.$noti_for.'<'.$from .'>' . "\r\n";
        $subject2  = get_bloginfo( 'name' ).' reservation (admin copy)';
        $message2  = $htmlContent;
        $name = get_bloginfo( 'name' );

        // $headers2 = "MIME-Version: 1.0" . "\r\n";
        // $headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // $headers2 .= 'From: Notification<'.$from .'>' . "\r\n";
        // $headers .= 'Cc: welcome@example.com' . "\r\n";
        // $headers .= 'Bcc: welcome2@example.com' . "\r\n";
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
        //echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
        //You can also use header('Location: thank_you.php'); to redirect to another page.

        // $msg = 'Hello World';
        // $subj = 'test mail message';
        // $to = 'qa.testmail187@gmail.com';
        // $from = 'from@mail.com';
        // $name = get_bloginfo( 'name' );
         
        // if (smtpmailer($to, $from, $name, $subject, $message) && smtpmailer($from, $from, $name, $subject2, $message2)) {
        //  echo 'Yippie, message send via Gmail';
        // } else {
        //  if (!smtpmailer($to, $from, $name, $subject, $message, false) && !smtpmailer($from, $from, $name, $subject2, $message2, false)) {
        //  if (!empty($error)) echo $error;
        //  } else {
        //  echo 'Yep, the message is send (after doing some hard work)';
        //  }
        // }

    }

    echo json_encode($data);
    die();
}


add_action("wp_ajax_nopriv_easync_success_and_save", "easync_success_and_save");
add_action("wp_ajax_easync_success_and_save", "easync_success_and_save");
function easync_success_and_save() {
    global $wpdb;
    session_start();
    $table          = $wpdb->prefix . "sync_options";
    $cat            = '';
    $id             = '';
    $txn_id         = '';
    $payment_gross  = '';
    $currency_code  = 'PHP';
    $payment_status = 'paid';
    $redirection = '';
    $data = array();
    $email_entry = array(); 
    $user_email = '';
    $greet_name = '';
    $noti_for = '';
    $send_email = false;

    $row = $wpdb->get_results(  "SELECT * FROM $table
        WHERE option_name = 'sync_auto_gen_id'");
    if(empty($row)) {
        $entries = array(
                 'option_name'    =>   'sync_auto_gen_id',
                 'option_value'   =>   '1',
            );
        $wpdb->insert($table, $entries);
    }else{
        $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table
            WHERE option_name = %s ", 'sync_auto_gen_id'));
        if ( $entries ) {
             $wpdb->query($wpdb->prepare("UPDATE $table 
                         SET option_value = %s
                         WHERE option_name = %s", ($entries[0]->option_value+1), 'sync_auto_gen_id' )
            );
        }
    }

    $_SESSION['form_type'] = $_SESSION['sync_form'];

    $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table
            WHERE option_name = %s ", 'sync_auto_gen_id'));
    if ( $entries ) 
        $txn_id = $entries[0]->option_value;


    $_SESSION['message'] = 'Reservation successful!';
    //header("Location: $location");
    if (!empty($_SESSION['sync_form']) && $_SESSION['sync_form'] =='restau') {
        unset($_SESSION['sync_form']);
        $table = $wpdb->prefix . "sync_restau_entries";
        $cat        = 'restau';
        $item_number = 0; 
        $temp_array = explode(',',$_SESSION['sync_entries']['menu_ids']);
         foreach ($temp_array as $key2 => $value) {
            preg_match('#\((.*?)\)#', $value, $match);
            $payment_gross += ((float)get_post_meta((int)$value, 'sync_restau', true )['price'] * (int)trim($match[1],' QTY'));
            $item_number += (int)trim($match[1],' QTY'); 
         }
         $redirection = 'sync_restau_page_thank_u';

        $price = ''; 
        $send_email = true;
        $greet_name = ucfirst($_SESSION['sync_entries']['name']);
        $user_email = $_SESSION['sync_entries']['email'];
        $menu_list = explode(',', $_SESSION['sync_entries']['menu_ids']);
        foreach ($menu_list as $key => $value) {
             preg_match('#\((.*?)\)#', $value, $match);
            $meta = get_post_meta( (int)$value, 'sync_restau', true );
            $sub = $amount[0]->currency_code.' '.((int)trim($match[1],' QTY ') * floatval($meta['price']));
            $email_entry['Menus'] .= '<span style="display:table;line-height: 20px;text-align:right;float:right;">'.get_post($value)->post_title .' ('.$match[1].') '.$sub.'</span><br /> ';
            $price = floatval($price) + ((int)trim($match[1],' QTY ') * floatval($meta['price']));
        }
        $email_entry['Time Slot']        = $_SESSION['sync_entries']['timeslot'];
        $email_entry['Total Guest(s)']   = $_SESSION['sync_entries']['guest_no'];
        $email_entry['Total Table(s)']   = $_SESSION['sync_entries']['table_no'];
        $email_entry['Branch']        = ucfirst($_SESSION['sync_entries']['branch']);
        $email_entry['Name']          = ucfirst($_SESSION['sync_entries']['name']);
        $email_entry['Picked Date']   = $_SESSION['sync_entries']['pick_date'];
        $email_entry['Phone']         = $_SESSION['sync_entries']['phone'];
        $email_entry['Email']         = $_SESSION['sync_entries']['email'];
        $email_entry['Address 1']     = ucfirst($_SESSION['sync_entries']['address_1']);
        $email_entry['Address 2']     = ucfirst($_SESSION['sync_entries']['address_2']);
        $email_entry['City']          = ucfirst($_SESSION['sync_entries']['city']);
        $email_entry['Province']      = ucfirst($_SESSION['sync_entries']['province']);
        $email_entry['Postal Code']   = $_SESSION['sync_entries']['postal_code'];
        $email_entry['Status']        = 'Processing';
        $email_entry['Amount Paid']   = $price;

        $noti_for   = 'Restaurant Reservation Notification';
    

        $data['success']          = true;
        $data['message']          = 'success!';


    }

    if (!empty($_SESSION['sync_form']) && $_SESSION['sync_form'] =='car'){
        unset($_SESSION['sync_form']);
        $table = $wpdb->prefix . "sync_rent_car_entries";
        $cat        = 'car';
        $meta = get_post_meta( $post->ID, 'sync_car', true );
        $payment_gross = ((float)get_post_meta((int)$_SESSION['sync_entries']['car_id'], 'easync_car', true )['price'] * $_SESSION['sync_entries']['number_days']);
        $item_number = $_SESSION['sync_entries']['number_days'];   
        $redirection = 'sync_car_page_thank_u';

       
        $meta = get_post_meta( $_SESSION['sync_entries']['car_id'], 'easync_car', true ); 
        $price = $meta['price'];
        $send_email = true;
        $date_start = new DateTime($_SESSION['sync_entries']['pick_date']);
        $date_end   = new DateTime($_SESSION['sync_entries']['return_date']);

        $number_days = $date_end->diff($date_start)->format("%a");


        $greet_name = ucfirst($_SESSION['sync_entries']['firstname']);
        $user_email = $_SESSION['sync_entries']['email'];
        $email_entry['Car']            = get_post($_SESSION['sync_entries']['car_id'])->post_title;
        $email_entry['Car Type']       = $meta['type'];
        $email_entry['Car Model']      = $meta['model'];
        $email_entry['First Name']     = ucfirst($_SESSION['sync_entries']['firstname']);
        $email_entry['Last Name']      = ucfirst($_SESSION['sync_entries']['lastname']);
        $email_entry['Phone']          = $_SESSION['sync_entries']['phone'];
        $email_entry['Email']          = $_SESSION['sync_entries']['email'];
        $email_entry['Driver']         = ucfirst($_SESSION['sync_entries']['with_driver']);
        $email_entry['Pick Date']      = $_SESSION['sync_entries']['pick_date'];
        $email_entry['Pick Time']      = $_SESSION['sync_entries']['pick_time'];
        $email_entry['Return Date']    = $_SESSION['sync_entries']['return_date'];
        $email_entry['Return Time']    = $_SESSION['sync_entries']['return_time'];
        $email_entry['Pick Location']  = ucfirst($_SESSION['sync_entries']['pick_location']);
        $email_entry['Number of Days'] = $number_days;
        $email_entry['Address 1']      = ucfirst($_SESSION['sync_entries']['address_1']);
        $email_entry['Address 2']      = ucfirst($_SESSION['sync_entries']['address_2']);
        $email_entry['City']           = ucfirst($_SESSION['sync_entries']['city']);
        $email_entry['Province']       = ucfirst($_SESSION['sync_entries']['province']);
        $email_entry['Postal Code']    = $_SESSION['sync_entries']['postal_code'];
        $email_entry['Status']         = 'Processing';
        $email_entry['Amount Paid']    = $price * $number_days;
        
        $noti_for   = 'Car Booking Notification';

        $data['success']          = true;
        $data['message']          = 'success!';

    }


    if (!empty($_SESSION['sync_form']) && $_SESSION['sync_form'] =='hotel'){
        unset($_SESSION['sync_form']);
        $table = $wpdb->prefix . "sync_hotel_entries";
        $cat        = 'hotel';
        $payment_gross = ((float)get_post_meta( (int)$_SESSION['sync_entries']['room_id'], 'easync_hotel', true )['price'] * $_SESSION['sync_entries']['night_number']);
        $item_number = $_SESSION['sync_entries']['night_number'];  
        $redirection = 'sync_hotel_page_thank_u';


        $meta = get_post_meta( $_SESSION['sync_entries']['room_id'], 'easync_hotel', true ); 
        $price = $meta['price'];
        $send_email = true;
        $greet_name = ucfirst($_SESSION['sync_entries']['firstname']);
        $user_email = $_SESSION['sync_entries']['email'];
        $email_entry['Room Type']          = ucfirst(get_post($_SESSION['sync_entries']['room_id'])->post_title);
        $email_entry['First Name']          = ucfirst($_SESSION['sync_entries']['firstname']);
        $email_entry['Last Name']           = ucfirst($_SESSION['sync_entries']['lastname']);
        $email_entry['Phone']              = $_SESSION['sync_entries']['phone'];
        $email_entry['Email']              = $_SESSION['sync_entries']['email'];
        $email_entry['Check-in']           = $_SESSION['sync_entries']['arrival_date'];
        $email_entry['Check-out']          = $_SESSION['sync_entries']['departure_date'];
        $email_entry['Night(s)']             = $_SESSION['sync_entries']['night_number'];
        $email_entry['Number of Guest(s)']       = $_SESSION['sync_entries']['guest_number'];
        $email_entry['Total Room(s)']         = $_SESSION['sync_entries']['room_number'];
        $email_entry['Facility Requested'] = $_SESSION['sync_entries']['facility_request'];
        $email_entry['Other Request(s)']          = (($_SESSION['sync_entries']['number_days']!='') ? $_SESSION['sync_entries']['number_days'] : 'N/A');
        $email_entry['Address 1']          = ucfirst($_SESSION['sync_entries']['address_1']);
        $email_entry['Address 2']          = ucfirst($_SESSION['sync_entries']['address_2']);
        $email_entry['City']               = ucfirst($_SESSION['sync_entries']['city']);
        $email_entry['Province']           = ucfirst($_SESSION['sync_entries']['province']);
        $email_entry['Postal Code']        = $_SESSION['sync_entries']['postal_code'];
        $email_entry['Status']             = 'Processing';
        $email_entry['Amount Paid']        = $price * $_SESSION['sync_entries']['night_number'];

        $noti_for   = 'Room Booking Notification';

        $data['success']          = true;
        $data['message']          = 'success!';
        
    }

    if($send_email==true) {
        $data['header_msg']       = 'Thank you for choosing '.get_bloginfo( 'name' ).'. Your transaction is now being processed and will be confirmed as soon as possible.<br /><br />Here are the details you submitted for your booking:';
        $data['footer_msg']       = 'For any concerns regarding your booking, please email us at '.get_option('admin_email');
        require_once("user-email-template.php");

        $to        = $user_email; // this is your Email address
        $from      = get_option('admin_email'); // this is the sender's Email address

        $headers   = "MIME-Version: 1.0" . "\r\n";
        $headers   .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers   .= 'From: '.get_bloginfo( 'name' ).'<'.$from .'>' . "\r\n";
        $subject   = 'eaSYNC-Booking Reservation';
        $message   = $htmlContent;
        
        $headers2  = "MIME-Version: 1.0" . "\r\n";
        $headers2  .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers2  .= 'From: '.$noti_for.'<'.$from .'>' . "\r\n";
        $subject2  = get_bloginfo( 'name' ).' reservation (admin copy)';
        $message2  = $htmlContent;
        $name = get_bloginfo( 'name' );

        // $headers2 = "MIME-Version: 1.0" . "\r\n";
        // $headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // $headers2 .= 'From: Notification<'.$from .'>' . "\r\n";
        // $headers .= 'Cc: welcome@example.com' . "\r\n";
        // $headers .= 'Bcc: welcome2@example.com' . "\r\n";
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
        //echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
        //You can also use header('Location: thank_you.php'); to redirect to another page.
    }

    $data['curr'] = $_SESSION;

    if(!empty($txn_id)){

        //Check if payment data exists with the same TXN ID.
        $syncpay_table = $wpdb->prefix . "sync_payments";
        $prevPaymentResult = $wpdb->query("SELECT id FROM $syncpay_table WHERE txn_id = '".$txn_id."'");

        if($prevPaymentResult->num_rows > 0){
            $paymentRow = $prevPaymentResult->fetch_assoc();
            $last_insert_id = $paymentRow['payment_id'];
        }else{
            // if(!empty($_SESSION['sync_entries'])) {
            //     $wpdb->insert($table, $_SESSION['sync_entries']);
            //     unset($_SESSION['sync_entries']);
            // }

            if( ( $_SESSION['form_type'] === 'hotel' && !empty($_SESSION['sync_entries']['arrival_date']) && !empty($_SESSION['sync_entries']['departure_date']) ) ||
                ( $_SESSION['form_type'] === 'car' && !empty($_SESSION['sync_entries']['pick_date']) && !empty($_SESSION['sync_entries']['return_date']) ) ||
                ( $_SESSION['form_type'] === 'restau' && !empty($_SESSION['sync_entries']['pick_date']) ) 
            ){
                $wpdb->insert($table, $_SESSION['sync_entries']);
                unset($_SESSION['sync_entries']);
            }else{
                $data["error"] = "Some fields are empty. Cannot save data.";
            }

            $entries = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC");
            if ( ! $entries ) {
                $wpdb->print_error(); 
            }else {
                $id = $entries[0]->id;
            }

            $insert = $wpdb->query("INSERT INTO $syncpay_table(item_belongsto,item_cat, item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$id."','".$cat."','".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')");
            $last_insert_id = $wpdb->insert_id;

            $table_check = $wpdb->prefix . "sync_options";  
            $check = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_check WHERE option_name = %s", $redirection));
            if(count($check) == 0 || $check[0]->option_value=='default') {
                $data['redirect'] = home_url( '/'.$_SESSION['sync_page_redirect'] ); 
            }else{
                $data['redirect'] = $check[0]->option_value; 
            }
            unset($_SESSION['sync_page_redirect']);
        }
    }

    echo json_encode($data);
    die();
}

if ( ! function_exists( 'eb_fs' ) ) {
    // Create a helper function for easy SDK access.
    function eb_fs() {
        global $eb_fs;

        if ( ! isset( $eb_fs ) ) {
            require_once dirname(__FILE__) . '/freemius/start.php';

            $eb_fs = fs_dynamic_init( array(
                'id'                  => '8958',
                'slug'                => 'easync-booking',
                'type'                => 'plugin',
                'public_key'          => 'pk_559902b5858a3e4e9894b843a92d7',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'menu'                => array(
                    'slug'           => 'easync-booking',
                    'first-path'     => 'admin.php?page=easync-booking',
                ),
            ) );
        }
        return $eb_fs;
    }
    // Init Freemius.
    eb_fs();
    // Signal that SDK was initiated.
    do_action( 'eb_fs_loaded' );
}