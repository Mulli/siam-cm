<?php

// handle elementor form to get room price
// 1. Get fields from form & verify dates are checking < checkout
// 2. Get hotel data from json file
// 3. Verify dates are in contract period
// 4. Calculate price:
//    a. get table with prices
//    b. get table with promotions
//    c. get table with supplements
//    d. get table with promotions book by
//    e. calculate price



function handle_nana_form( $record, $handler ) {

	$form_name = $record->get_form_settings( 'form_name' );
    $raw_fields = $record->get( 'fields' );

    if ( 'nana_form' == $form_name ){
        $arg = array( 
            'name' => $raw_fields['name']['value'],
            'number' => $raw_fields['phone']['value'],
            'email' => $raw_fields['email']['value'],
            'custom_field_11044' => $raw_fields['message']['value'], // text area
            'source' => $raw_fields['source']['value']??'',
            'custom_field_11042' => $raw_fields['date_start']['value']??'', // date start
            'custom_field_11043' => $raw_fields['date_end']['value']??'',   // date end
            'custom_field_11040' => $raw_fields['flying_ticket']['value']??'' // is there flying ticket?
        );
        $res = siam_cm_send_request($arg);
        if ($res['status'] == 'success'){
            $handler->add_response_data( 'nana_form', $res['response']['body']);
        } else {
            $handler->add_response_data( 'nana_form', 'fail' );
        }
        error_log('handle_nana_form ' . print_r($res, true));
    }
    return ;     
}
add_action( 'elementor_pro/forms/new_record', 'handle_nana_form', 10, 2 );

function siam_cm_send_request($arg){
    $arg['token'] = '8b369b5a7f8a26bafc646c4334444e21';
    $url = 'https://app.callmarker.com/api/simple/customers';
    $arg['campaign'] = '6776';
    $arg['number'] = '0509262025';
    $arg['mail'] = 'yosi@siam-tours.com';
    $arg['custom_field_11044'] = 'כאן יהיה טקסט חופשי שנאנה תוכל להקליד. הליד הזה נוצר באמצעות טופס וורדפרס ואלמנטור';
    $response = wp_remote_post( $url, array(
        'method'      => 'POST',
        'timeout'     => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking'    => true,
        'headers'     => array(),
        'body'        => $arg,
        'cookies'     => array()
        )
    );
    
    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        return ['status' => 'fail', 'error' => "Something went wrong: $error_message"];
    } 
        
    return ['status' => 'success', 'response' => $response];

}
