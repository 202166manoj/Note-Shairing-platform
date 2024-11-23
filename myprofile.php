<?php
session_start();
include('includes/dbconn.php');

if (strlen($_SESSION['eid']) == 0) {
    header('location:logout.php');
    exit;
}

$eid = $_SESSION['eid'];

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $uploadDir = 'uploads/';
    $profilePicture = null;

    // Handle profile picture upload
    if (isset($_FILES['profilepicture']) && $_FILES['profilepicture']['error'] == 0) {
        $file = $_FILES['profilepicture'];
        $fileName = basename($file['name']);
        $uploadFile = $uploadDir . $fileName;

        // Ensure the uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $profilePicture = $fileName;
        } else {
            echo '<script>alert("Failed to upload profile picture. Ensure the uploads directory is writable.")</script>';
        }
    } else {
        // Retrieve current profile picture if any
        $sql = "SELECT ProfilePicture FROM users WHERE id=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $profilePicture = $result['ProfilePicture'];
    }

    // Update database
    $sql = "UPDATE users SET UserName=:username, Email=:email" . ($profilePicture ? ", ProfilePicture=:profilepicture" : "") . " WHERE id=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    if ($profilePicture) {
        $query->bindParam(':profilepicture', $profilePicture, PDO::PARAM_STR);
    }
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();

    echo '<script>alert("Profile updated successfully.")</script>';
}

if (isset($_GET['delete_picture']) && $_GET['delete_picture'] == '1') {
    // Handle profile picture deletion
    $sql = "SELECT ProfilePicture FROM users WHERE id=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $profilePicture = $result['ProfilePicture'];

    if ($profilePicture) {
        $filePath = 'uploads/' . $profilePicture;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Update database to remove profile picture
        $sql = "UPDATE users SET ProfilePicture=NULL WHERE id=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Profile picture deleted successfully.")</script>';
    }
}

// Fetch current user details
$sql = "SELECT UserName, Email, ProfilePicture FROM users WHERE id=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
$userName = $result['UserName'];
$userEmail = $result['Email'];
$currentProfilePicture = $result['ProfilePicture'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600;700;900&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Quicksand", sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #3f23ac;
            margin-top: 40px;
        }
        .container {
            position: relative;
            max-width: 700px;
            width: 100%;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .container header {
            font-size: 1.5rem;
            color: #333;
            font-weight: 500;
            text-align: center;
        }
        .form {
            margin-top: 30px;
        }
        .form .input-box {
            width: 100%;
            margin-top: 20px;
        }
        .input-box label {
            color: #333;
        }
        .form :where(.input-box input) {
            position: relative;
            height: 50px;
            width: 100%;
            outline: none;
            font-size: 1rem;
            color: #707070;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0 15px;
        }
        .form button {
            height: 55px;
            width: 100%;
            color: #fff;
            font-size: 1rem;
            font-weight: 400;
            margin-top: 30px;
            border: none;
            cursor: pointer;
            background: #241072;
        }
        .form button:hover {
            background: rgb(88, 56, 250);
        }
        .navbar {
            background-color: #fff;
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            height: 60px;
        }
        .navbar-container {
            display: flex;
            align-items: center;
            width: 100%; /* Ensures the container takes the full width */
            justify-content: flex-start; /* Aligns items to the left */
        }
        .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .nav-links li {
            margin-left: 20px;
            font-weight: 40px;
        }
        .nav-links li:first-child {
            margin-left: 0; 
            font-weight: bold;
            font-size: 1.1rem;
            padding-left: 20px; /* Ensures the first item has no extra margin */
        }
        .nav-links li a {
            color: #000;
            text-decoration: none;
            font-size: 1rem;
        }
        .nav-links li a i {
            margin-right: 8px; /* Adjust the spacing between the arrow and the text */
        }
        .nav-links li a:hover {
            color: #00aaff;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <ul class="nav-links">
            <li><a href="home.php"><i class="fas fa-arrow-left"></i> Back</a></li>
        </ul>
    </div>
</nav>
<section class="container">
    <header>Edit Profile</header>
    <form method="post" enctype="multipart/form-data" class="form" name="editprofile">
    <!-- Current Profile Picture -->
    <div class="input-box">
        <label>Current Profile Picture</label>
        <?php if ($currentProfilePicture): ?>
            <img src="uploads/<?php echo htmlentities($currentProfilePicture); ?>" alt="Profile Picture" style="max-width: 100px; max-height: 100px;"><br><br>
            <a href="myprofile.php?delete_picture=1" onclick="return confirm('Are you sure you want to delete your profile picture?');">Delete Profile Picture</a>
        <?php else: ?>
            <p>No profile picture set.</p>
        <?php endif; ?>
    </div>

    <!-- Upload New Profile Picture -->
    <div class="input-box">
        <label for="profilepicture">Upload New Profile Picture (Optional)</label>
        <input type="file" name="profilepicture" id="profilepicture" accept="image/*">
    </div>

    <!-- Username -->
    <div class="input-box">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo htmlentities($userName); ?>" required>
    </div>

    <!-- Email -->
    <div class="input-box">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo htmlentities($userEmail); ?>" required>
    </div>

    <button type="submit" name="submit">Save Changes</button>
</form>

</section>
</body>
</html>
