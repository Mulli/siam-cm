<?php

function siam_cm_send_request($url, $arg){
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