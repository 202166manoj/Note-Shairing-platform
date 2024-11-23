<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconn.php');
error_reporting(0);
if (strlen($_SESSION['eid']==0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $eid = $_SESSION['eid'];
    $cpassword = md5($_POST['currentpassword']);
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT id FROM users WHERE id=:eid and Password=:cpassword";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
      $con = "UPDATE users SET Password=:newpassword WHERE id=:eid";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':eid', $eid, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();

      echo '<script>alert("Your password has been successfully changed")</script>';
    } else {
      echo '<script>alert("Your current password is wrong")</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600;700;900&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (copied from upload.php) -->
    <style>
        body {
          font-family: "Quicksand", sans-serif;
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 20px;
          background: #3f23ac;
          margin-top:40px;
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
  height:60px;
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
  font-weight:40px;
}
.nav-links li:first-child {
  margin-left: 0; 
  font-weight: bold;
  font-size: 1.1rem;
  padding-left:20px;/* Ensures the first item has no extra margin */
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

    <script type="text/javascript">
    function checkpass() {
      if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
        alert('New Password and Confirm Password do not match');
        document.changepassword.confirmpassword.focus();
        return false;
      }
      return true;
    }
    </script>
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
        <header>Change Password</header>
        <form method="post" class="form" name="changepassword" onsubmit="return checkpass();">
            <div class="input-box">
                <label for="currentpassword">Current Password</label>
                <input type="password" name="currentpassword" id="currentpassword" required>
            </div>

            <div class="input-box">
                <label for="newpassword">New Password</label>
                <input type="password" name="newpassword" id="newpassword" required>
            </div>

            <div class="input-box">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" name="confirmpassword" id="confirmpassword" required>
            </div>

            <button type="submit" name="submit">Change</button>
        </form>
    </section>
</body>
</html>
