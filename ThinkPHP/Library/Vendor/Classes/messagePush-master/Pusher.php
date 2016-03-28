<?php
require(dirname(__FILE__).'/MessageBuilder.php');

Class Pusher {
    const MESSAGE_SERVER_HOST='http://127.0.0.1:2121';

    public static function push($message) {
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, self::MESSAGE_SERVER_HOST );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HEADER, false );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode($message));
        $result = curl_exec ( $ch );
        curl_close ( $ch );

        return $result;
    }
}