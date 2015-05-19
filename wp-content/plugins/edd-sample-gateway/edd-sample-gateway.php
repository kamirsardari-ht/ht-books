<?php
/*
Plugin Name: Easy Digital Downloads - Sample Gateway
Plugin URL: http://easydigitaldownloads.com/extension/sample-gateway
Description: A sample gateway for Easy Digital Downloads
Version: 1.0
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Contributors: mordauk
*/

// Don't forget to load the text domain here. Sample text domain is pw_edd


// registers the gateway
function pw_edd_register_gateway( $gateways ) {
	$gateways['sample_gateway'] = array( 'admin_label' => 'Sample Gateway', 'checkout_label' => __( 'Sample Gateway', 'pw_edd' ) );
	return $gateways;
}
add_filter( 'edd_payment_gateways', 'pw_edd_register_gateway' );


// Remove this if you want a credit card form
add_action( 'edd_sample_gateway_cc_form', '__return_false' );


// processes the payment
function pw_edd_process_payment( $purchase_data ) {

	global $edd_options;

	/**********************************
	* set transaction mode
	**********************************/

	if ( edd_is_test_mode() ) {
		// set test credentials here
	} else {
		// set live credentials here
	}

	/**********************************
	* check for errors here
	**********************************/

	/*
	// errors can be set like this
	if( ! isset($_POST['card_number'] ) ) {
		// error code followed by error message
		edd_set_error('empty_card', __('You must enter a card number', 'edd'));
	}
	*/


	/**********************************
	* Purchase data comes in like this:

    $purchase_data = array(
        'downloads'     => array of download IDs,
        'tax' 			=> taxed amount on shopping cart
        'fees' 			=> array of arbitrary cart fees
        'discount' 		=> discounted amount, if any
        'subtotal'		=> total price before tax
        'price'         => total price of cart contents after taxes,
        'purchase_key'  =>  // Random key
        'user_email'    => $user_email,
        'date'          => date( 'Y-m-d H:i:s' ),
        'user_id'       => $user_id,
        'post_data'     => $_POST,
        'user_info'     => array of user's information and used discount code
        'cart_details'  => array of cart details,
     );
    */

	// check for any stored errors
	$errors = edd_get_errors();
	if ( ! $errors ) {

		$purchase_summary = edd_get_purchase_summary( $purchase_data );

		/****************************************
		* setup the payment details to be stored
		****************************************/

		$payment = array(
			'price'        => $purchase_data['price'],
			'date'         => $purchase_data['date'],
			'user_email'   => $purchase_data['user_email'],
			'purchase_key' => $purchase_data['purchase_key'],
			'currency'     => $edd_options['currency'],
			'downloads'    => $purchase_data['downloads'],
			'cart_details' => $purchase_data['cart_details'],
			'user_info'    => $purchase_data['user_info'],
			'status'       => 'pending'
		);

		// record the pending payment
		$payment = edd_insert_payment( $payment );

		$merchant_payment_confirmed = false;

		/**********************************
		* Process the credit card here.
		* If not using a credit card
		* then redirect to merchant
		* and verify payment with an IPN
		**********************************/

		// if the merchant payment is complete, set a flag
		$merchant_payment_confirmed = true;

		if ( $merchant_payment_confirmed ) { // this is used when processing credit cards on site

			// once a transaction is successful, set the purchase to complete
			edd_update_payment_status( $payment, 'complete' );

			// record transaction ID, or any other notes you need
			edd_insert_payment_note( $payment, 'Transaction ID: XXXXXXXXXXXXXXX' );

			// go to the success page
			edd_send_to_success_page();

		} else {
			$fail = true; // payment wasn't recorded
		}

	} else {
		$fail = true; // errors were detected
	}

	if ( $fail !== false ) {
		// if errors are present, send the user back to the purchase page so they can be corrected
		edd_send_back_to_checkout( '?payment-mode=' . $purchase_data['post_data']['edd-gateway'] );
	}
}
add_action( 'edd_gateway_sample_gateway', 'pw_edd_process_payment' );


// adds the settings to the Payment Gateways section
function pw_edd_add_settings( $settings ) {

	$sample_gateway_settings = array(
		array(
			'id' => 'sample_gateway_settings',
			'name' => '<strong>' . __( 'Sample Gateway Settings', 'pw_edd' ) . '</strong>',
			'desc' => __( 'Configure the gateway settings', 'pw_edd' ),
			'type' => 'header'
		),
		array(
			'id' => 'live_api_key',
			'name' => __( 'Live API Key', 'pw_edd' ),
			'desc' => __( 'Enter your live API key, found in your gateway Account Settins', 'pw_edd' ),
			'type' => 'text',
			'size' => 'regular'
		),
		array(
			'id' => 'test_api_key',
			'name' => __( 'Test API Key', 'pw_edd' ),
			'desc' => __( 'Enter your test API key, found in your Stripe Account Settins', 'pw_edd' ),
			'type' => 'text',
			'size' => 'regular'
		)
	);

	return array_merge( $settings, $sample_gateway_settings );
}
add_filter( 'edd_settings_gateways', 'pw_edd_add_settings' );

// setup a custom CC form for Sample Gateway
function pw_edd_sample_gateway_cc_form() {
	ob_start(); ?>
	<fieldset>
		<legend><?php _e('Credit Card Info', 'edd'); ?></legend>
		<p>
			<input type="text" autocomplete="off" name="card_name" class="card-name edd-input required" placeholder="<?php _e('Card name', 'pw_edd'); ?>"/>
			<label class="edd-label"><?php _e('Name on the Card', 'pw_edd'); ?></label>
		</p>
		<p>
			<input type="text" autocomplete="off" name="card_number" class="card-number edd-input required" placeholder="<?php _e('Card number', 'pw_edd'); ?>" />
			<label class="edd-label"><?php _e('Card Number', 'pw_edd'); ?></label>
		</p>
		<p>
			<input type="text" size="4" autocomplete="off" name="card_cvc" class="card-cvc edd-input required" placeholder="<?php _e('CVC', 'pw_edd'); ?>"/>
			<label class="edd-label"><?php _e('CVC', 'pw_edd'); ?></label>
		</p>
		<p class="card-expiration">
			<input type="text" size="2" name="card_exp_month" class="card-expiry-month edd-input required" placeholder="<?php _e('Month', 'pw_edd'); ?>"/>
			<span class="exp-divider"> / </span>
			<input type="text" size="4" name="card_exp_year" class="card-expiry-year edd-input required" placeholder="<?php _e('Year', 'pw_edd'); ?>"/>
			<label class="edd-label"><?php _e('Expiration (MM/YYYY)', 'pw_edd'); ?></label>
		</p>
	</fieldset>
	<?php
	echo ob_get_clean();
}
add_action('edd_sample_gateway_cc_form', 'pw_edd_sample_gateway_cc_form');
