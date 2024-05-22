<?php
namespace Src\Responses;

class RenderResponse {
    /**
     * Renders a view to the client.
     *
     * @param string $view The view to render.
     * @param array $data The data to pass to the view.
     */
    public static function render($view, $data = []) {
        // Extract the data array to variables for easy access in the views.
        extract($data);

        // Start output buffering to capture the output of the view.
        ob_start();

        // Include the view file. Path is relative to this file location.
        require __DIR__ . "/../views/$view.php";

        // Capture the view output in a variable.
        $content = ob_get_contents();
        
        // Clean the output buffer without stopping it.
        ob_clean();

        // Include the layout template file which should use the $content variable.
        include __DIR__ . "/../views/layout/app-layout.php";

        // Get the final content of the buffer and then clean and close the buffer.
        $output = ob_get_clean();

        // Print the final output.
        echo $output;
    }
}