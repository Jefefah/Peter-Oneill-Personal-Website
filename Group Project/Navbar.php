<?php 
session_start();
        if (isset($_SESSION['Timeout']) && (time() - $_SESSION['Timeout'] > 900)) {
            // Last request was more than 15 minutes ago
            session_unset();     // Unset $_SESSION variable for the run-time
            session_destroy();   // Destroy session data in storage
            header("Location: Login.php");
            exit;
        }
        $_SESSION['Timeout'] = time(); // Update timeout timestamp
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
                        <a class="nav-link" aria-current="page" href="Index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown" id="aboutme-link">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            About Me
                        </a>
                        <ul class="dropdown-menu" id="aboutme-dropdown">
                            <li><a class="dropdown-item" href="MyDisability.php">My Disability</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="MyWork.php">My Work</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="MyInterests.php">My Interests</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="MyRecommendations.php">My Recommendations</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="Blog.php">My Blog</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" id="admin-link">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" id="admin-dropdown">
                            <li><a class="dropdown-item" href="AdminManage.php">Manage</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" id="staff-link">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Staff
                        </a>
                        <ul class="dropdown-menu" id="staff-dropdown">
                            <li><a class="dropdown-item" href="UserProfile.php">Personal Details</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="Timesheet.php">Time Sheets</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="AnnualLeave.php">Annual Leave</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="ChangePassword.php">Change Password</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" id="family-link">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Staff
                        </a>
                        <ul class="dropdown-menu" id="family-dropdown">
                            <li><a class="dropdown-item" href="MusicCollection.php">Music</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="VideoCollection.php">Videos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="PhotoCollection.php">Photos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="Documents.php">Documents</a></li>
                        </ul>
                    </li>



                    <li class="nav-item" id="workingfor-link">
                        <a class="nav-link" href="WorkingForMe.php">Working For Me</a>
                    </li>
                    <li class="nav-item" id="contact-link">
                        <a class="nav-link" href="ContactWith.php">Contact Me</a>
                    </li>                    
                    <!-- Account links, log in link, sign up link-->
                </ul>
                <ul class="nav navbar-nav navbar-right ms-auto">
                    <?php if (!isset($_SESSION['loggedin'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="Signup.php"><i class="bi bi-person-fill-add"></i> Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    </li>
                    <?php 
                    } 
                    else if (isset($_SESSION['loggedin'])) { 
                    ?>
                    <li class="nav-item" id="logout-link">
                        <a class="nav-link" href="Logout.php"><i class="bi bi-box-arrow-in-right"></i> Log Out</a>
                    </li>
                    <li class="nav-item" id="account-link">
                        <a class="nav-link" href="UserProfile.php"><i class="bi bi-box-arrow-in-right"></i> Account</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-between container p-4 bg-white border shadow w-50 h-100 text-center">





