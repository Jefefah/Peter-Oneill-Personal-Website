<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
$permissions = [
    'AdminManage.php'     => [1],
    'Timesheet.php'       => [1, 2],
    'RotaDiary.php'       => [1, 2],
    'Documents.php'       => [1, 3],
    'MusicCollection.php' => [3],
    'PhotoCollection.php' => [3],
    'VideoCollection.php' => [3]
];
$currentPage = basename($_SERVER['SCRIPT_NAME']);
$pagePath = __DIR__.'/'.$currentPage;
if (!file_Exists($pagePath)) {
    header('HTTP/1.1 404 Not Found');
    header('Errors/NotFound.php');
    exit;
}
if (isset($permissions[$currentPage])) {
    $acceptedRoles = $permissions[$currentPage];
    if (!in_array($_SESSION['userRole'], $acceptedRoles)) {
        header('HTTP/1.1 403 Forbidden');
        header('Location: Errors/Forbidden.php');
        exit;
    }
}
if (isset($_SESSION['Timeout']) && (time() - $_SESSION['Timeout'] > 900)) {
    // Last request was more than 15 minutes ago
    session_unset();     // Unset $_SESSION variable for the run-time
    session_destroy();   // Destroy session data in storage
    header("Refresh:2; url=Index.php");
    exit;
}
if (isset($_SESSION['loggedin'])) { $_SESSION['Timeout'] = time();} // Update timeout timestamp
if (!isset($_SESSION['loggedin'])) {$_SESSION['userRole'] = 4;}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css?v=<?= time();?>">
    <title>Dr Peter O'Neill's Personal Website</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar custom-navbar navbar-expand-lg shadow-sm">
        <div class="container custom-navbar-container shadow">
            <a class="navbar-brand" href="#">Dr Peter O'Neill
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="Home">Home</a>
                    </li>
                    <li class="nav-item dropdown" id="aboutme-link">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            About Me
                        </a>
                        <ul class="dropdown-menu" id="aboutme-dropdown">
                            <li><a class="dropdown-item" href="My-Disability">My Disability</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="My-Work">My Work</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="My-Interests">My Interests</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="My-Recommendations">My Recommendations</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="My-Blog">My Blog</a></li>
                        </ul>
                    </li>
                    <?php if ($_SESSION['userRole'] == 1) { ?>
                    <li class="nav-item dropdown" id="admin-link">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" id="admin-dropdown">
                            <li><a class="dropdown-item" href="Admin-Dashboard">Manage</a></li>
                        </ul>
                    </li>
                    <?php 
                    } 
                    if ($_SESSION['userRole'] == 2 || $_SESSION['userRole'] == 1) {
                    ?>
                    <li class="nav-item dropdown" id="staff-link">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Staff
                        </a>
                        <ul class="dropdown-menu" id="staff-dropdown">
                            <li><a class="dropdown-item" href="Profile">Personal Details</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="Timesheets">Time Sheets</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="Annual-Leave">Annual Leave</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="Change-Password">Change Password</a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    if ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 1) {
                    ?>
                    <li class="nav-item dropdown" id="family-link">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Family
                        </a>
                        <ul class="dropdown-menu" id="family-dropdown">
                            <li><a class="dropdown-item" href="Music">Music</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="Videos">Videos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="Photos">Photos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="Documents">Documents</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="nav-item" id="workingfor-link">
                        <a class="nav-link" href="Working-For-Me">Working For Me</a>
                    </li>
                    <li class="nav-item" id="contact-link">
                        <a class="nav-link" href="Contact">Contact Me</a>
                    </li>                    
                    <!-- Account links, log in link, sign up link-->
                </ul>
                <ul class="nav navbar-nav navbar-right ms-auto">
                    <?php if (!isset($_SESSION['loggedin'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="Sign-Up"><i class="bi bi-person-fill-add"></i> Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    </li>
                    <?php 
                    } 
                    else if (isset($_SESSION['loggedin'])) { 
                    ?>
                    <li class="nav-item" id="logout-link">
                        <a class="nav-link" href="Logout.php"><i class="bi bi-box-arrow-in-right"></i> Log Out</a>
                    </li>
                    <li class="nav-item" id="account-link">
                        <a class="nav-link" href="Profile"><i class="bi bi-box-arrow-in-right"></i> Account</a>
                    </li>
                    <?php } 
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-between container p-4 bg-white border shadow w-50 h-100 text-center">





