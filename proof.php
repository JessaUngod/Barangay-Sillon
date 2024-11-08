<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeoCam Application</title>
    <style>
        /* Styling for video element */
        #video {
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>GeoCam Application</h1>
    <p id="status">Getting your location...</p>
    
    <!-- Video element to display the camera feed -->
    <video id="video" width="320" height="240" autoplay></video>

    <!-- Button to capture photo -->
    <button id="capture">Capture Photo</button>

    <!-- Canvas to temporarily store the captured photo -->
    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>

    <!-- Image element to display the captured photo -->
    <img id="photo" src="" alt="Captured Image">

    <!-- Form to upload data -->
    <form id="geoCamForm" action="upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <input type="hidden" name="imageData" id="imageData">
        <input type="hidden" name="emp_id" value="<?= $_GET['emp_id'] ?>">
        <button type="submit">Save Data</button>
    </form>

    <script>
        // Check if geolocation is supported and handle it
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('status').textContent = `Latitude: ${position.coords.latitude}, Longitude: ${position.coords.longitude}`;
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }, function(error) {
                document.getElementById('status').textContent = 'Error getting geolocation: ' + error.message;
            });
        } else {
            document.getElementById('status').textContent = 'Geolocation is not supported by this browser.';
        }

        // Function to handle camera access
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photo = document.getElementById('photo');
        const captureButton = document.getElementById('capture');

        // Check for camera permissions and access
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: "environment" // Try to use back camera (for mobile devices)
                }
            })
            .then(function(stream) {
                // On success, attach the video stream to the video element
                video.srcObject = stream;
                document.getElementById('status').textContent = 'Camera is ready.';
            })
            .catch(function(error) {
                // Handle any errors related to camera access
                console.error("Error accessing camera: ", error);
                alert("Error accessing camera: " + error.message);
                document.getElementById('status').textContent = "Unable to access camera: " + error.message;

                // Add additional checks for specific error codes
                if (error.name === "NotAllowedError") {
                    document.getElementById('status').textContent = "Camera permission denied.";
                } else if (error.name === "NotFoundError") {
                    document.getElementById('status').textContent = "No camera found.";
                } else {
                    document.getElementById('status').textContent = "An unknown error occurred with the camera.";
                }
            });
        } else {
            alert("Your browser does not support camera access.");
            document.getElementById('status').textContent = "Your browser does not support camera access.";
        }

        // Capture photo when the button is clicked
        captureButton.addEventListener('click', function() {
            if (video.srcObject) {
                // Draw the current frame from the video to the canvas
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                // Convert the canvas to a Data URL (image format)
                const dataURL = canvas.toDataURL('image/png');
                
                // Display the captured image
                photo.src = dataURL;

                // Store the image data in a hidden input field for form submission
                document.getElementById('imageData').value = dataURL;
            } else {
                alert("Camera is not accessible.");
            }
        });
    </script>
</body>
</html>
