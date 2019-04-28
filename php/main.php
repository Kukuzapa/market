<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    header('Content-Type: text/html; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');

    include 'helper.php';

    //Проверка на бот, запрос может быть только ajax
    if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $new = new Helper;
    
        $query = explode( '&', $_SERVER['QUERY_STRING'] );

        $request = [];

        foreach ( $query as $value ) {
            $tmp = explode( '=', $value );
            $request[$tmp[0]] = $tmp[1];
        }

        $response = $new->$request['command']( $request );
        
        echo json_encode( $response, JSON_UNESCAPED_UNICODE );
    }
?>