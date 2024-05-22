<?php
namespace Src\Responses;

class JsonResponse {
    /**
    * Sends a JSON response to the client.
    *
    * @param array $data The data to encode to JSON.
    * @param int $status The HTTP status code to send.
    */
   public static function send($data, $status = 200) {
       // Set the content type to application/json.
       header("Content-Type: application/json; charset=UTF-8");
       // Set the HTTP status code.
       http_response_code($status);

       // Encode the response array to JSON and print it.
       echo json_encode($data);

       // End the script to ensure no further output.
       exit;
   }
}
