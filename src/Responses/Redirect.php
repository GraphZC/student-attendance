<?php
namespace Src\Responses;

class Redirect {
    /**
     * Redirects the client to a new URL.
     *
     * @param string $url The URL to redirect to.
     * @param int $status The HTTP status code to send.
     */
    public static function to($url, $status = 302) {
        // Set the HTTP status code.
        http_response_code($status);
        // Set the location header to the new URL.
        header("Location: $url");
        // End the script to ensure no further output.
        exit;
    }
}