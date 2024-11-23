<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconn.php');
if (strlen($_SESSION['eid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $subject = $_POST['subject'];
    $level = $_POST['level'];
    $module = $_POST['module'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $did = $_GET['editid'];

    $sql = "UPDATE notes SET Subject=:subject, Level=:level, Module=:module, Title=:title, Description=:desc WHERE id=:did";
    $query = $dbh->prepare($sql);

    $query->bindParam(':subject', $subject, PDO::PARAM_STR);
    $query->bindParam(':level', $level, PDO::PARAM_STR);
    $query->bindParam(':module', $module, PDO::PARAM_STR);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':desc', $desc, PDO::PARAM_STR);
    $query->bindParam(':did', $did, PDO::PARAM_STR);
    $query->execute();

    echo '<script>alert("Notes has been updated")</script>';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Notes</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600;700;900&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main-style.css">

    <style>
        body {
          font-family: "Quicksand", sans-serif;
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 20px;
          background: #3f23ac;
          margin-top: 80px;
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
        .form :where(.input-box input, .select-box) {
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
        .form textarea {
          height: auto; /* Adjust textarea height */
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

<!-- Navigation Bar Start -->
<nav class="navbar">
    <div class="navbar-container">
        <ul class="nav-links">
            <li><a href="home.php"><i class="fas fa-arrow-left"></i> Back</a></li>
        </ul>
    </div>
</nav>
<!-- Navigation Bar End -->

<section class="container">
    <header>Update Notes</header>
    <form method="post" class="form">
        <?php
        $did = $_GET['editid'];
        $sql = "SELECT * FROM notes WHERE notes.id=:did";
        $query = $dbh->prepare($sql);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $row) {
        ?>
            <div class="input-box">
                <label for="subject">Subject</label>
                <input type="text" name="subject" value="<?php echo htmlentities($row->Subject); ?>" required>
            </div>
            <div class="input-box">
                <label for="level">Level</label>
                <input type="text" name="level" value="<?php echo htmlentities($row->Level); ?>" required>
            </div>
            <div class="input-box">
                <label for="module">Module</label>
                <input type="text" name="module" value="<?php echo htmlentities($row->Module); ?>" required>
            </div>
            <div class="input-box">
                <label for="title">Title</label>
                <input type="text" name="title" value="<?php echo htmlentities($row->Title); ?>" required>
            </div>
            <div class="input-box">
                <label for="desc">Description</label>
                <textarea name="desc" required><?php echo htmlentities($row->Description); ?></textarea>
            </div>
            <div class="input-box">
               
                <a href="folder/<?php echo $row->File; ?>" target="_blank"><strong style="color: red">View File</strong></a>
            </div>
            <?php $cnt = $cnt + 1; } } ?>
        <button type="submit" name="submit" class="btn">Update</button>
    </form>
</section>

</body>
</html>
<?php } ?>
