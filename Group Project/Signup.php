<?php
include "Navbar.php";
include "dbConnect.php";
include "functions.php";

$db = dbOpen();

if (isset($_POST['createAccount'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST[''];
    $middlename = $_POST[''];
    $lastname = $_POST[''];
    $telno = $_POST[''];
    $dob = $_POST[''];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $stmt = $db->prepare("SELECT * FROM tblLogins WHERE USER_EMAIL = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $results = $stmt->execute();
    $existingUser = $results->fetchArray(SQLITE3_ASSOC);

    if ($existingUser) {
        // Username already taken
        echo "<div class='alert alert-danger' role='alert'>Username already exists. Please choose a different one.</div>";
        header("Refresh:2; url=Signup.php");
    } else {
        // Insert new user into the database
        $stmt = $db->prepare("INSERT INTO USER (USER_EMAIL, PasswordHashed, USER_FNAME, USER_MNAME, USER_LNAME, USER_TELNO, USER_DOB) VALUES (:username, :password, :firstname, :middlename, :lastname, :telno, :dob)");
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
        $stmt->bindvalue(':firstname', $firstname, SQLITE3_TEXT);
        $stmt->bindValue(':middlename', $middlename, SQLITE3_TEXT);
        $stmt->bindValue(':lastname', $lastname, SQLITE3_TEXT);
        $stmt->bindValue(':telno', $telno, SQLITE3_TEXT);
        $stmt->bindValue(':dob', $dob, SQLITE3_TEXT);
        $stmt->execute();
        echo "<div class='alert alert-success' role='alert'>Account created successfully! Redirecting to login page...</div>";
        header("Refresh:2; url=Login.php");
    }
}

?>
<script>
    window.onload = function() {
        document.getElementById("forenamecontainer").style.display = "none";
        document.getElementById("middlecontainer").style.display = "none";
        document.getElementById("surnamecontainer").style.display = "none";
        document.getElementById("telcontainer").style.display = "none";
        //document.getElementById("dobcontainer").style.display = "none";
        document.getElementById("createaccount").style.display = "none";
    };  
</script>
<div class="container mt-4 mb-4 p-4 rounded shadow-lg custom-signup-container">
    <h2 class="text-center mb-4">Create Your Account</h2>
    <form method="POST" class="d-flex flex-column flex-nowrap align-items-start" id="signupform">
        <div class="input-group mb-3" id="usernamecontainer">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <div class="form-floating">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                <label for="username">Email</label>
            </div>
        </div>
        <div class="input-group mb-3" id="passwordcontainer">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
        </div>
        <div class="input-group mb-3" id="dobcontainer">
            <span class="input-group-text"><i class="bi bi-calendar2-plus-fill"></i></span>
            <div class="form-floating">
                <input type="date" class="form-control" name="dob" id="dob" placeholder="DOB">
                <label for="dob">Date of Birth</label>
            </div>
        </div>
        <button type="button" value="nextpage" name="nextpage" id="nextpage" class="custom-button btn btn-primary mb-3">Next</button>
            <div class="input-group mb-3" id="forenamecontainer">
                <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                <div class="form-floating">
                    <input type="forename" class="form-control" name="forename" id="forename" placeholder="Forename">
                    <label for="forename">Forename</label>
                </div>
            </div>
            <div class="input-group mb-3" id="middlecontainer">
                <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                <div class="form-floating">
                    <input type="middlename" class="form-control" name="middlename" id="middlename" placeholder="Middle Name">
                    <label for="middlename">Middle Name(s)</label>
                </div>
            </div>
            <div class="input-group mb-3" id="surnamecontainer">
                <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                <div class="form-floating">
                    <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname">
                    <label for="Surname">Surname</label>
                </div>
            </div>
            <div class="input-group mb-3" id="telcontainer">
                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                <div class="form-floating">
                    <input type="telephone" class="form-control" name="telephone" id="telephone" placeholder="Telephone">
                    <label for="Telephone">Telephone</label>
                </div>
            </div>
        <button type="submit" value="createAccount" name="createAccount" id="createaccount" class="custom-button btn btn-primary mb-3">Create Account</button>
    </form>
</div>

<script>
        document.getElementById("nextpage").onclick = function() {
        document.getElementById("usernamecontainer").style.display = "none";
        document.getElementById("passwordcontainer").style.display = "none";
        document.getElementById("nextpage").style.display = "none";
        document.getElementById("forenamecontainer").style.display = "flex";
        document.getElementById("middlecontainer").style.display = "flex";
        document.getElementById("surnamecontainer").style.display = "flex";
        document.getElementById("telcontainer").style.display = "flex";
        document.getElementById("dobcontainer").style.display = "none";
        document.getElementById("createaccount").style.display = "flex";
    };
</script>


<?php 
dbClose($db);
include_once "Footer.php"; 
?>