
<?php
include "Navbar.php"; 
include "DbConnect.php";
include "functions.php";
$db = dbOpen();

if (isset($_POST['createAccount'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $stmt = $db->prepare("SELECT * FROM tblLogins WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $results = $stmt->execute();
    $existingUser = $results->fetchArray(SQLITE3_ASSOC);

    if ($existingUser) {
        // Username already taken
        echo "<div class='alert alert-danger' role='alert'>Username already exists. Please choose a different one.</div>";
        header("Refresh:2; url=Signup.php");
    } else {
        // Insert new user into the database
        $stmt = $db->prepare("INSERT INTO tblLogins (Username, PasswordHashed) VALUES (:username, :password)");
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
        $stmt->execute();
        echo "<div class='alert alert-success' role='alert'>Account created successfully! Redirecting to login page...</div>";
        header("Refresh:2; url=Login.php");
    }
}


?>

<div class="container mt-4 mb-4 p-4 rounded shadow-lg"
    style="max-width: 600px; background-color: #ecf0f1; border: 2px solid #827215;">
    <h2 class="text-center mb-4">Create Your Account</h2>
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
            <button type="submit" value="createAccount" name="createAccount" class="custom-button btn btn-primary mb-3">Create Account</button>   
    </form>
</div>



   

<?php include_once "Footer.php"; ?>