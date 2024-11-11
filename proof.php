<?php
date_default_timezone_set('Asia/Manila');
$todays_date = date("y-m-d h:i:sa");
$today = strtotime($todays_date);
$date = date("Y-m-d h:i:sa", $today);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeoCam</title>
</head>
<body>
    <h1>GeoCam Application</h1>
    <p id="status">Getting your location...</p>
    <h3>Preview Cam:</h3>
    <video id="video" width="320" height="240" autoplay></video>
    <button id="capture">Capture Photo</button>
    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
    <img id="photo" src="uploads/no-photo.jpg" width="320" height="240" alt="Captured Image">
    
    <form id="geoCamForm" action="upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <input type="hidden" name="imageData" id="imageData">
        <input type="hidden" name="emp_id" value="<?= $_GET['emp_id'] ?>">
        <button type="submit">Save Data</button>
    </form>

    <script>
        // Get the user's location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('status').textContent = `Latitude: ${position.coords.latitude}, Longitude: ${position.coords.longitude}`;
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }, function() {
                document.getElementById('status').textContent = 'Geolocation is not supported by this browser.';
            });
        } else {
            document.getElementById('status').textContent = 'Geolocation is not supported by this browser.';
        }

        // Access the user's camera
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photo = document.getElementById('photo');
        const captureButton = document.getElementById('capture');

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                video.srcObject = stream;
            })
            .catch(function(error) {
                console.error("Error accessing camera: ", error);
            });

        // Capture the photo and display it
        captureButton.addEventListener('click', function() {
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL('image/png');
            photo.src = dataURL;
            document.getElementById('imageData').value = dataURL;
        });

        // User should allow location permission
        function checkGeolocationPermission() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    // Success callback
                    function(position) {
                        // Location access granted, proceed to load PHP content
                        document.getElementById("geoCamForm").style.display = 'block';
                    },
                    // Error callback
                    function(error) {
                        if (error.code == error.PERMISSION_DENIED) {
                            alert("Camera access denied, allow permission and refresh the page");

                        }
                    }
                );
            } else {
                //window.location.href = 'index.php';
                alert("Location not supported, allow permission and refresh the page");

            }
        }

        // Check geolocation permission on page load
        window.onload = checkGeolocationPermission;
    </script>

</body>
</html>
