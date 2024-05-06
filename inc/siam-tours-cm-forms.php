<?php

// handle sima-tours.com elementor form to send data to CallMarker
// 1. Get fields from form submission
// 2. send only non empty fields to CallMarker
// 3. get reply & display it on screen using elementor form response
// and JS code on page

function handle_siam_tours_cm_forms( $record, $handler ) {

	$form_name = $record->get_form_settings( 'form_name' );
    $raw_fields = $record->get( 'fields' );
    $url = 'https://app.callmarker.com/api/simple/customers' ; //$raw_fields['url']['value'];
    $token = '8b369b5a7f8a26bafc646c4334444e21' ; // $raw_fields['token']['value'];
    $campaign = '6776' ; // $raw_fields['campaign']['value'];

    if ( 'nana form' == $form_name ){
        return nana_form();
    }
    if ( 'דברו איתנו עמוד הבית' == $form_name ){
        $arg = talk2us_homepage($token, $campaign, $raw_fields, 'website-homepage');
        return siam_cm_send_request($url, $arg);
    }
    if ('טופס תחתון - ירח דבש' == $form_name){
        $arg = honey_month($token, $campaign, $raw_fields, 'website-honey-month');
        return siam_cm_send_request($url, $arg);
    }
    if ('טופס תחתון - משפחות' == $form_name){
        $arg = family_bottom($token, $campaign, $raw_fields, 'website-family-bottom');
        return siam_cm_send_request($url, $arg);
    }
    if ('טופס - עמוד צור קשר' == $form_name){
        $arg = contact_page($token, $campaign, $raw_fields, 'website-contact-page');
        return siam_cm_send_request($url, $arg);
    }
    if ('טופס תחתון - מזג אוויר' == $form_name){
        $arg = whether_page($token, $campaign, $raw_fields, 'website-whether-page');
        return siam_cm_send_request($url, $arg);
    }
    return ;     
}
function whether_page($token, $campaign, $raw_fields, $source){
    return honey_month($token, $campaign, $raw_fields, $source);
}

function contact_page($token, $campaign, $raw_fields, $source){
    $arg = array(
        'token' => $token, //$raw_fields['token']['value'], // '6776' - CM ט - קוד סיאם טורס ב
        'campaign' => $campaign, // $raw_fields['campaign']['value'], // '6776' - CM ט - קוד סיאם טורס ב
                                                    // '9343' - Code Mulli for testing
        'name' => $raw_fields['name']['value'],
        'number' => $raw_fields['field_338b7fc']['value'],
        'email' => $raw_fields['field_6d3b03a']['value'],
        'source' => $raw_fields['source']['value'] ?? $source,
        'reset' => 'true'
    );
    $fldmap = array(
        //'category' => 'custom_field_11039',
       // 'adults' => 'custom_field_11036',
       // 'children' => 'custom_field_11037',
        'field_eaccf07' => 'custom_field_11042', // start_date = field_eaccf07
        'field_d62435a' => 'custom_field_11043', // end_date = field_d62435a
        'message' => 'custom_field_11044',
        'field_42f1784' => 'custom_field_11040', // flyticket = field_42f1784
        'field_7a06bb9' => 'custom_field_7189' // passengers = field_7a06bb9
    );

    foreach ($fldmap as $key => $value){
        if (isset($raw_fields[$key]['value']) && !empty($raw_fields[$key]['value'])){
            $arg[$value] = $raw_fields[$key]['value'];
        }
    }
    return $arg;
}
function family_bottom($token, $campaign, $raw_fields, $source){
    return honey_month($token, $campaign, $raw_fields, $source);
}

function honey_month($token, $campaign, $raw_fields, $source){
    $arg = array(
        'token' => $token, //$raw_fields['token']['value'], // '6776' - CM ט - קוד סיאם טורס ב
        'campaign' => $campaign, // $raw_fields['campaign']['value'], // '6776' - CM ט - קוד סיאם טורס ב
                                                    // '9343' - Code Mulli for testing
        'name' => $raw_fields['name']['value'],
        'number' => $raw_fields['field_ea318f3']['value'],
        'email' => $raw_fields['field_6d3b03a']['value'],
        'source' => $raw_fields['source']['value'] ?? $source,
        'reset' => 'true'
    );
    $fldmap = array(
        //'category' => 'custom_field_11039',
       // 'adults' => 'custom_field_11036',
       // 'children' => 'custom_field_11037',
       // 'field_eaccf07' => 'custom_field_11042', // start_date = field_eaccf07
       // 'field_d62435a' => 'custom_field_11043', // end_date = field_d62435a
        'message' => 'custom_field_11044',
        'field_e83c0fa' => 'custom_field_11040', // flyticket = field_42f1784
      //  'field_7a06bb9' => 'custom_field_7189' // passengers = field_7a06bb9
    );

    foreach ($fldmap as $key => $value){
        if (isset($raw_fields[$key]['value']) && !empty($raw_fields[$key]['value'])){
            $arg[$value] = $raw_fields[$key]['value'];
        }
    }
    return $arg;
}

function talk2us_homepage($token, $campaign, $raw_fields, $source){
    $arg = array(
        'token' => $token, //$raw_fields['token']['value'], // '6776' - CM ט - קוד סיאם טורס ב
        'campaign' => $campaign, // $raw_fields['campaign']['value'], // '6776' - CM ט - קוד סיאם טורס ב
                                                    // '9343' - Code Mulli for testing
        'name' => $raw_fields['name']['value'],
        'number' => $raw_fields['field_338b7fc']['value'],
        'email' => $raw_fields['email']['value'],
        'source' => $raw_fields['source']['value'] ?? $source,
        'reset' => 'true'
    );
    $fldmap = array(
        'category' => 'custom_field_11039',
        'adults' => 'custom_field_11036',
        'children' => 'custom_field_11037',
        'field_eaccf07' => 'custom_field_11042', // start_date = field_eaccf07
        'field_d62435a' => 'custom_field_11043', // end_date = field_d62435a
        'message' => 'custom_field_11044',
        'field_42f1784' => 'custom_field_11040', // flyticket = field_42f1784
        'field_7a06bb9' => 'custom_field_7189' // passengers = field_7a06bb9
    );

    foreach ($fldmap as $key => $value){
        if (isset($raw_fields[$key]['value']) && !empty($raw_fields[$key]['value'])){
            $arg[$value] = $raw_fields[$key]['value'];
        }
    }
    return $arg;
}

function nana_form(){
    $arg = array(
        'token' => $raw_fields['token']['value'], // '6776' - CM ט - קוד סיאם טורס ב
        'campaign' => $raw_fields['campaign']['value'], // '6776' - CM ט - קוד סיאם טורס ב
                                                    // '9343' - Code Mulli for testing
        'name' => $raw_fields['name']['value'],
        'number' => $raw_fields['phone']['value'],
        'email' => $raw_fields['email']['value'],
        'source' => $raw_fields['source']['value']??'',
        'reset' => 'true'
    );
    $fldmap = array(
        'category' => 'custom_field_11039',
        'adults' => 'custom_field_11036',
        'children' => 'custom_field_11037',
        'start_date' => 'custom_field_11042',
        'end_date' => 'custom_field_11043',
        'message' => 'custom_field_11044',
        'flyticket' => 'custom_field_11040',
        'passengers' => 'custom_field_7189'
    );
    
    foreach ($fldmap as $key => $value){
        if (isset($raw_fields[$key]['value']) && !empty($raw_fields[$key]['value'])){
            $arg[$value] = $raw_fields[$key]['value'];
        }
    }
    $url = $raw_fields['url']['value'];
    if (empty($url)){
        $ajax_handler->add_error_message( 'No URL provided - message not sent' );
        return;
    }
    $res = siam_cm_send_request($url, $arg);
    if ($res['status'] == 'success'){
        $handler->add_response_data( 'nana_form', $res['response']['body']);
    } else {
        $handler->add_response_data( 'nana_form', 'fail' );
    }
    error_log('handle_nana_form ' . print_r($res, true));

    return ;     
}