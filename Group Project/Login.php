<?php
include "Navbar.php"; 
include "DbConnect.php";
include "Functions.php";
$db = dbOpen();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $db->prepare("SELECT * FROM tblLogins WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $results = $stmt->execute();
    $user = $results->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['PasswordHashed'])) {
        // Successful login
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['Timeout'] = time(); // Set the timeout timestamp
        header("Location: Index.php");
        exit;
    }
    else {
        // Failed login
        echo "<div class='alert alert-danger' role='alert'>Invalid username or password.</div>";
        header("Refresh:2; url=Login.php");
    }

    
}


?>


<div class="container mt-4 mb-4 p-4 rounded shadow-lg"
    style="max-width: 600px; background-color: #ecf0f1; border: 2px solid #827215;">
    <h2 class="text-center mb-4">Login to Your Account</h2>
    <form method="POST" class="d-flex flex-column flex-nowrap">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <div class="form-floating">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    <label for="username">Username</label>
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
            </div>
            <button type="submit" value="login" name="login" class="custom-button btn btn-primary mb-3">Login</button>
            <button type="button" class="btn btn-secondary mb-3" name="signup" id="signup" onclick="window.location.href='Signup.php'">
                <small class="text-light d-block">Create Account</small>
            </button>
    </form>
</div>



   

<?php include_once "Footer.php"; ?>