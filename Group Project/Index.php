<?php
session_start();

include "Navbar.php"; 

/*
if (!isset($_SESSION['loggedin'])) {
    // Not logged in
    header("Location: Login.php");
    exit;
}
elseif (isset($_SESSION['loggedin'])) {
    echo "<div class='container mt-4 mb-4 p-4 rounded shadow-lg'
    style='max-width: 600px; background-color: #ecf0f1; border: 2px solid #827215;'>
    <h2 class='text-center mb-4'>Welcome, " . $_SESSION['username'] . "!</h2>
    <p class='text-center'>You are now logged in. Use the navigation menu to access different sections of the site.</p>
    </div>";
}
*/


?>

<?php include_once "Footer.php"; ?>
