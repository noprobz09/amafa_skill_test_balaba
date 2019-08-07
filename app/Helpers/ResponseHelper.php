<?php

namespace App\Helpers;

class ResponseHelper {
	
    
    public static function failed(string $message = '', array $contents = array(), string $code = '200') {

        return self::getArrayResponse(false, $message, $contents, $code);
        
    }

    public static function getArrayResponse(bool $success, string $message, array $contents = array(), string $code = '200') {
        
        $explodedMessage = explode('//', $message);

        $messages = (count($explodedMessage) > 1)  ?    $explodedMessage    :   $message;

        $response = [
            'result' => $success,
            'message' => $messages,
            'message_code' => $code
        ];

        if (!empty($contents)) {
            $response = array_merge($response, $contents);
        }
        
        return $response;
    }


}