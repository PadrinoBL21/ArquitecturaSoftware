<?php
// Requires "curl" to be enabled

function removeBg($imageFilePath) {
    $apiKey = 'PZEUSH6p9WXtynSqdZAhNZtg';
    $url = 'https://api.remove.bg/v1.0/removebg';

    // Initialize a cURL session
    $ch = curl_init();

    // Configure cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "X-Api-Key: $apiKey"
    ]);

    // Attach the image file
    $fileData = new CURLFile($imageFilePath);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'image_file' => $fileData,
        'size' => 'auto'
    ]);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        curl_close($ch);
        return null;
    } else {
        // Get the HTTP response code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode == 200) {
            return $response; // Return the image binary data
        } else {
            // Decode and print error message
            $responseDecoded = json_decode($response, true);
            echo "Error removing background: " . $responseDecoded['detail'];
            return null;
        }
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image_file'])) {
    $imageFilePath = $_FILES['image_file']['tmp_name'];
    $resultImage = removeBg($imageFilePath);

    if ($resultImage) {
        // Set the content type header to serve the image
        header('Content-Type: image/png');
        echo $resultImage; // Output the image directly
    }
}
?>