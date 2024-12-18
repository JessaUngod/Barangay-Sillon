<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/mdb.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/fontawesome6/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/de.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
    <script type="text/javascript" src="../sweet_alert/sweetalert.min.js"></script>
    <script type="text/javascript" src="../assets/js/apexchart.js"></script>

    <style>
        /* Sidebar */
        .sidebar {
            background-color: #343a40;
            height: 100vh;
            position: fixed;
            width: 250px;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar .header-box {
            background-color: #23272b;
            color: white;
            padding: 15px;
            font-size: 1.2em;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar .header-box img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .sidebar ul {
            padding-left: 0;
            margin-top: 20px;
        }

        .sidebar ul li {
            list-style: none;
        }

        .sidebar ul li a {
            display: block;
            padding: 15px;
            color: white;
            font-size: 1.1em;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        .sidebar ul li.active a {
            background-color: #007bff;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        .sidebar .close-btn {
            font-size: 1.5em;
            color: white;
            background: none;
            border: none;
        }

        .sidebar.active {
            width: 0;
            padding: 0;
        }

        .content.shift {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                height: 100%;
            }

            .sidebar.active {
                width: 200px;
            }

            .content {
                margin-left: 0;
            }

            .content.shift {
                margin-left: 200px;
            }

            .sidebar .header-box {
                display: block;
            }

            .sidebar ul li a {
                padding: 12px;
                font-size: 1em;
            }

            .sidebar ul li.active a {
                background-color: #007bff;
            }
        }
    </style>
</head>
<body>
    <div class="main-container-fluid d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5"><img src="../assets/img/sillon.jpg" style="width: 50px; height: 50px; border-radius: 50%;"> <strong style="color: #fff;">Barangay Sillon</strong></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <ul class="list-unstyled px-3">
                <li class="active"><a href="../admin/admin_dash.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="../admin/employee.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-users"></i> Employees</a></li>
                <li><a href="../admin/employee_payroll.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-pencil"></i> Payroll</a></li>
                <li><a href="../admin/payroll_rec.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-book-open"></i> Reports</a></li>
                <li><a href="../admin/posistion.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-bar-chart"></i> Positions</a></li>
                <li><a href="../admin/accounts.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-user"></i> Accounts</a></li>
                <li><a href="../admin/log_rec.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-clock"></i> Login / Logout</a></li>
            </ul>
            <hr class="h-color mx-2">
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <div class="container-fluid">
                    <button class="navbar-toggler d-md-none d-block" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline small" style="color: #000;">Hello,</span>
                                <span class="mr-2 d-lg-inline small">
                                    <img src="../uploads/<?php echo $row['img']; ?>" style="height: 40px; width:40px; border-radius:50%;" >
                                </span>
                                <span class="mr-2 d-lg-inline small fw-bold" style="color: #000;"><?php echo $row['fname']; ?></span>
                            </a>
                            <div class="dropdown-menu shadow animated-grow-in px-4" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"  data-target="#setModal" data-toggle="modal">
                                    <i class="fas fa-solid fa-location-dot fa-sm fa-fw mr-2 fw-bold" style="color: #000;"></i>
                                    <strong class="fw-bold">Set Location</strong>
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 fw-bold" style="color: #000;"></i>
                                    <strong class="fw-bold">Logout</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <h1 class="fw-bold mb-4 text-gray-800 fs-3" style="color: #000;"><strong>Dashboard</strong></h1>

                <!-- Your other content goes here -->

            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/mdb.js"></script>
    <script src="../vendor/datatables/dataTable.js"></script>

    <script>
        // Sidebar toggle
        $(".sidebar ul li").on('click', function() {
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');
        });

        $('.open-btn').on('click', function() {
            $('.sidebar').addClass('active');
            $('.content').addClass('shift');
        });

        $('.close-btn').on('click', function() {
            $('.sidebar').removeClass('active');
            $('.content').removeClass('shift');
        });
    </script>
</body>
</html>
