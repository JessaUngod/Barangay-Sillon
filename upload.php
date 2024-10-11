<?php
require_once 'db.php';
date_default_timezone_set('Asia/Manila');
function getAddress($lat, $long) {
    // Nominatim API URL
    $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$lat&lon=$long&addressdetails=1";

    // Set up the HTTP context with a User-Agent header
    $opts = [
        'http' => [
            'header' => "User-Agent: MyGeoApp/1.0 (your-email@example.com)\r\n"
        ]
    ];
    $context = stream_context_create($opts);

    // Make the HTTP request with the context
    $response = file_get_contents($url, false, $context);

    // Check if the response was successful
    if ($response === FALSE) {
        return "Unable to get address for the given coordinates.";
    }

    $responseData = json_decode($response, true);

    if (isset($responseData['address'])) {
        // Get the formatted address
        $address = $responseData['display_name'];
        return $address;
    } else {
        return "Unable to get address for the given coordinates.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $imageData = $_POST['imageData'];
    $emp_id = $_POST['emp_id'];

    // Decode the base64 image data
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $image = base64_decode($imageData);

    // Create a unique filename for the image
    $filename = uniqid() . '.png';

    // Ensure the uploads directory exist
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Save the image to the server
    if (file_put_contents($filename, $image)) {
        // Get the human-readable address using latitude and longitude
        $address = getAddress($latitude, $longitude);

        // Output success message with address
        // echo "Image saved successfully with Latitude: $latitude, Longitude: $longitude, and Address: $address";

        $today = date('Y-m-d');

        $check = $con->prepare("SELECT * FROM attendance_proof WHERE employee_id = ? AND DATE(date) = ? ");
        $check->bind_param('ss', $emp_id, $today);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $update = $con->prepare("UPDATE attendance_proof SET image_out = ?, location = ? WHERE employee_id = ?");
            $update->bind_param("sss", $filename, $address, $emp_id);
            $update->execute();
           ?>
            <script>
                window.location = "attendance.php?msgtime_out=time_out";
            </script>
            <?php 
        }else{
            $insert = $con->prepare("INSERT INTO attendance_proof(employee_id, image_in, location) VALUES(?,?,?)");
            $insert->bind_param('sss', $emp_id, $filename, $address);
            $insert->execute();
            ?>
            <script>
                 window.location = "attendance.php?msginsert=inserted";
            </script>
            <?php 
        }


    } else {
        echo "Failed to save image.";
    }
} else {
    echo "Invalid request.";
}
?>
