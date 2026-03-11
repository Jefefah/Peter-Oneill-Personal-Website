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
    <link rel="stylesheet" href="styles?v=<?= time();?>">
    <title>S&M Hotels</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar custom-navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">S&M Hotels
                <i class="bi bi-buildings-fill" alt="Logo"></i>
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
                    <?php if (isset($_SESSION['loggedin'])) { ?>
                    <li class="nav-item" id="bookings-link">
                        <a class="nav-link" href="viewBookings.php">Bookings</a>
                    </li>
                    <li class="nav-item dropdown" id="rooms-link">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Rooms
                        </a>
                        <ul class="dropdown-menu" id="rooms-dropdown">
                            <li><a class="dropdown-item" href="viewRooms.php">View Rooms</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="viewRoomTypes.php">View Room Types</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" id="guests-link">
                        <a class="nav-link" href="viewGuests.php">Guests</a>
                    </li>
                    <li class="nav-item" id="hotels-link">
                        <a class="nav-link" href="viewHotels.php">Hotels</a>
                    </li>
                    <?php } ?>
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
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
