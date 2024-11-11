<?php
require_once 'db.php';
date_default_timezone_set('Asia/Manila');
$todays_date = date("y-m-d h:i:sa");
$today = strtotime($todays_date);
$date = date("Y-m-d h:i:sa", $today);

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
// Set the default location coordinates , Longitude: 

$x;
$y;

$updateloc = $con->prepare("SELECT `location` FROM `admin`");
$updateloc->execute();
$locresult = $updateloc->get_result();

if ($row = $locresult->fetch_assoc()) {
    $location = $row['location'];
    list($x, $y) = explode(',', $location);
    //echo "<script>alert('$x,$y')</script>";
} else {
    echo "No location found.";
}

$defaultLat = $x;
$defaultLon = $y;

// Define an acceptable radius (in meters)
$acceptableRadius = 100; // Example: 100 meters

// Function to calculate the distance between two coordinates using the Haversine formula
function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {

$latitudeFrom = (float)$latitudeFrom;
$longitudeFrom = (float)$longitudeFrom;
$latitudeTo = (float)$latitudeTo;
$longitudeTo = (float)$longitudeTo;

if (!is_numeric($latitudeFrom) || !is_numeric($longitudeFrom) || !is_numeric($latitudeTo) || !is_numeric($longitudeTo)) {
    throw new InvalidArgumentException("Invalid latitude or longitude value provided.");
    echo "javascript:history.go(-1);";
}
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Calculate the distance between current location and default location
    $distance = haversineGreatCircleDistance($latitude, $longitude, $defaultLat, $defaultLon);

    if ($distance <= $acceptableRadius) {


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
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Save the image to the server
    if (file_put_contents($uploadDir . $filename, $image)) {
        // Get the human-readable address using latitude and longitude
        $address = "$latitude,$longitude";

        // Output success message with address
        // echo "Image saved successfully with Latitude: $latitude, Longitude: $longitude, and Address: $address";
        date_default_timezone_set('Asia/Manila');
        $today = date("y-m-d");

        $check = $con->prepare("SELECT * FROM attendance_proof WHERE employee_id = ? AND DATE(date) = ? ");
        $check->bind_param('ss', $emp_id, $today);
        $check->execute();
        $result = $check->get_result();

        ########## from attendance moved to upload.php #########
     
        ########## end of input ##########


        if ($result->num_rows > 0) {
            $update = $con->prepare("UPDATE attendance_proof SET image_out = ?, location = ? WHERE employee_id = ? AND DATE(date) = ?");
            $update->bind_param("ssss", $filename, $address, $emp_id, $today);
            $update->execute();
           ?>
            <script>
                window.location = "attendance.php?msgtime_out=time_out";
            </script>
            <?php 
        }else{
            $insert = $con->prepare("INSERT INTO attendance_proof(employee_id, image_in, location, date) VALUES(?,?,?,?)");
            $insert->bind_param('ssss', $emp_id, $filename, $address, $today);
            $insert->execute();
            ?>
            <script>
                 window.location = "attendance.php?msginsert=inserted";
            </script>
            <?php 
        }


        } else {
            echo '<script>
                alert("Failed to save image.");
                javascript:history.go(-1);
                </script>';
            
        }

        } else {
            // Location does not match
            echo "<script>
            alert('Location does not match. Data not saved.');
            javascript:history.go(-1);
            </script>";
            //header("Location: {$_SERVER["HTTP_REFERER"]}");
            //header("Location: verify.php?emp_id=$emp_id");
        }
    } else {
        echo 'Invalid request.
        <script>
            alert("Failed to save image.");
            javascript:history.go(-1);
        </script>
        ';
    }
?>
