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
    <video id="video" width="320" height="240" autoplay></video>
    <button id="capture">Capture Photo</button>
    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
    <img id="photo" src="" alt="Captured Image">
    
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
    </script>
</body>
</html>
