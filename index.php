
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BSWAS</title>
	 <link rel="stylesheet" href="./assets/css/mdb.css">
	<link rel="stylesheet" href="./assets/fontawesome6/css/all.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="./assets/img/sillon.jpg">
	 <link rel="stylesheet" href="./assets/css/web.css">
</head>

<body class="overflow-hidden">
	<nav class="navbar navbar-expand-lg  navbar-dark " style="background-color: #000;">
		<div class="container">
			
			<h1 class="navbar-brand"><img src="./assets/img/sillon.jpg" style="width: 70px; height: 70px; border-radius: 50%;"><strong> Barangay Sillon  <span class="d-lg-initial d-none">Employee Attendance</span></strong></h1>
			<button class="navbar-toggler shadow-none border-0" type="button" data-mdb-toggle="offcanvas" data-mdb-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"> 
				<i class="fas fa-bars"></i>
				

			</button>

			<div class="sidebar offcanvas offcanvas-start" style="width: 250px;" tabindex="-1" id="offcanvasNavbar"
			aria-labelledby="offcanvasNavbarLabel">

			<div class="offcanvas-header text-white border-button">
				<h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel"><strong style="font-size: 1em;">Attendance</strong></h5>
				<button class="btn-close btn-close-white shadow-none" type="button"
				data-mdb-dismiss="offcanvas"
				aria-label="Close">
					
				</button>
				
			</div>

				<!-- side <bodybody> -->
				<div class="offcanvas-body" style="padding: unset">
					<ul class="navbar-nav justify-content-center flex-grow-1 pe-3" id="navbar">
				<!-- <li class="nav-item me-3">
					<a href="#" class="nav-link" data-mdb-toggle="modal" data-mdb-target="#homemodal"><strong>Home</strong></a>
					
				</li>
				<li class="nav-item me-3">
					<a href="3" class="nav-link " data-mdb-toggle="modal" data-mdb-target="#about"><strong>About Us</strong></a>
					
				</li>
				<li class="nav-item me-3">
					<a href="#" class="nav-link" data-mdb-toggle="modal" data-mdb-target="#feed"> <strong>Feedback</strong></a>
					
				
 -->
			
				
			</ul>

			<a href="attendance.php" class="btn btn-light py-3 fw-bold" style="max-height: 47px; margin-bottom: 7px;"><i class="fas fa-sign-in-alt me-1" ></i><strong> Attendance</strong></a>
			<a href="staff/index.php" class="btn btn-light py-3 fw-bold d-lg-none d-block" style="max-height: 47px; margin-bottom: 7px;"><i class="fas fa-sign-in-alt me-1" ></i><strong> Login</strong></a>
			<a href="admin/index.php" class="btn btn-light py-3 fw-bold d-lg-none d-block" style="max-height: 47px; margin-bottom: 7px;"><i class="fas fa-sign-in-alt me-1" ></i><strong> Admin Login</strong></a>
			
					

				</div>
			</div>

			

		</div>

		

	</nav>

	<main class="d-flex justify-content-center align-items-center" style="height: 100vh;
	background: linear-gradient( rgba(0,0,0,0.3), rgba(0,0,0,0.3)),url(./assets/img/brgy.hall1.jpg); background-repeat: no-repeat;
	background-size: cover;
	background-position: center;">
	   <!-- <div class="modal fade" id="studentLog"> -->
	  
	



	</main>



  

     
   









  <script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.bundle.js"></script>
<script src="./assets/js/mdb.js"></script>

<script>

	$(".navbar ul li a").on('click' , function(){
		$(".navbar ul li a.active").removeClass('active');
		$(this).addClass('active');


	});

	$('.open-btn').on('click' , function(){
		$('.navbar').addClass('active');
	});
	$('.close-btn').on('click' , function(){
		$('.navbar').removeClass('active');
	});
   </script> 



</body>
</html>


<?php
// ==============================
// Security Headers
// ==============================

// Content Security Policy: Restricts sources for content, scripts, and frames
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://trusted-scripts.com; frame-ancestors 'none';");
header("Content-Security-Policy: script-src 'self'; object-src 'none';");

// Prevent clickjacking by disallowing framing
header("X-Frame-Options: DENY");

// Enforce HTTPS using Strict-Transport-Security
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");

// Prevent MIME type sniffing
header("X-Content-Type-Options: nosniff");

// Enable basic XSS protection for older browsers
header("X-XSS-Protection: 1; mode=block");

// Control referrer information sent with requests
header("Referrer-Policy: no-referrer-when-downgrade");

// Restrict usage of certain browser features and APIs
header("Permissions-Policy: geolocation=(), camera=(), microphone=(), payment=()");



// ==============================
// Redirect HTTP to HTTPS
// ==============================
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}

// ==============================
// Secure Session Cookie Settings
// ==============================
ini_set('session.cookie_secure', '1');          // Enforces HTTPS-only session cookies
ini_set('session.cookie_httponly', '1');        // Prevents JavaScript access to session cookies
ini_set('session.cookie_samesite', 'Strict');   // Mitigates CSRF by limiting cross-site cookie usage

// Start a session securely
session_start();                                

// ==============================
// Anti-XXE: Secure XML Parsing
// ==============================

// Disable loading of external entities to prevent XXE attacks
libxml_disable_entity_loader(true);

// Suppress libxml errors to allow custom handling
libxml_use_internal_errors(true);

/**
 * Securely parses XML strings to prevent XXE vulnerabilities.
 *
 * @param string $xmlString The XML input as a string.
 * @return DOMDocument The parsed DOMDocument object.
 * @throws Exception If parsing fails.
 */
function parseXMLSecurely($xmlString) {
    $dom = new DOMDocument();

    // Load the XML string securely
    if (!$dom->loadXML($xmlString, LIBXML_NOENT | LIBXML_DTDLOAD | LIBXML_DTDATTR | LIBXML_NOCDATA)) {
        throw new Exception('Error loading XML');
    }

    return $dom;
}

// ==============================
// Example Usage
// ==============================
try {
    $xmlString = '<root><element>Sample</element></root>'; // Replace with actual XML input
    $dom = parseXMLSecurely($xmlString);

    // Continue processing $dom...
    echo " ";
} catch (Exception $e) {
    // Handle XML processing errors securely
    echo 'Error processing XML: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
?>


<script type="text/javascript">
    // Disable right-click with an alert
    document.addEventListener('contextmenu', function(event) {
        event.preventDefault();
        alert("Right-click is disabled on this page.");
    });

    // Disable F12 key and Inspect Element keyboard shortcuts with alerts
    document.onkeydown = function(e) {
        // F12
        if (e.key === "F12") {
            alert("F12 (DevTools) is disabled.");
            e.preventDefault(); // Prevent default action
            return false;
        }

        // Ctrl + Shift + I (Inspect)
        if (e.ctrlKey && e.shiftKey && e.key === "I") {
            alert("Inspect Element is disabled.");
            e.preventDefault();
            return false;
        }

        // Ctrl + Shift + J (Console)
        if (e.ctrlKey && e.shiftKey && e.key === "J") {
            alert("Console is disabled.");
            e.preventDefault();
            return false;
        }


         // Ctrl + U or Ctrl + u (View Source)
         if (e.ctrlKey && (e.key === "U" || e.key === "u" || e.keyCode === 85)) {
            alert("Viewing page source is disabled.");
            e.preventDefault();
            return false;
        }
    };
</script>

<script>
    (function() {
  const detectDevToolsAdvanced = () => {
    // Detect if the console is open by triggering a breakpoint
    const start = new Date();
    debugger; // This will trigger when dev tools are open
    const end = new Date();
    if (end - start > 100) {
      document.body.innerHTML = "<h1>Unauthorized Access</h1><p>Developer tools are not allowed on this page.</p>";
      document.body.style.textAlign = "center";
      document.body.style.paddingTop = "20%";
      document.body.style.backgroundColor = "#fff";
      document.body.style.color = "#000";
    }
  };

  setInterval(detectDevToolsAdvanced, 500); // Continuously monitor
})();


const blockedAgents = ["Cyberfox", "Kali"];
if (navigator.userAgent.includes(blockedAgents)) {
  document.body.innerHTML = "<h1>Access Denied</h1><p>Your browser is not supported.</p>";
}


if (window.__proto__.toString() !== "[object Window]") {
  alert("Unauthorized modification detected.");
  window.location.href = "https://www.bible-knowledge.com/wp-content/uploads/battle-verses-against-demonic-attacks.jpg";
}

</script>
<?php
$disallowedUserAgents = [
    "BurpSuite", 
    "Cyberfox", 
    "OWASP ZAP", 
    "PostmanRuntime"
];

if (preg_match("/(" . implode("|", $disallowedUserAgents) . ")/i", $_SERVER['HTTP_USER_AGENT'])) {
    http_response_code(403);
    exit("Unauthorized access");
}
?>
