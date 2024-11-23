<?php
session_start();
error_reporting(E_ALL);

include('dbconn.php');
$msg = '';

if (isset($_POST['reset_password_request'])) {
    $email = $_POST['email'];

    // Check if the email exists
    $sql = "SELECT * FROM users WHERE Email = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        // Save email in session for reset step
        $_SESSION['reset_email'] = $email;
        echo "<script type='text/javascript'> document.location = 'reset-password.php'; </script>";
    } else {
        $msg = "Email not found. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Password Recovery | WayaShare</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }

        .box-area {
            width: 500px; /* Adjust the width to match the right box */
            padding: 20px; /* Add padding to the container */
        }

        .right-box {
            padding: 40px 30px;
            background-color: #fff;
            border-radius: 20px; /* Rounded borders */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add shadow for some depth */
        }

        ::placeholder {
            font-size: 16px;
        }

        @media only screen and (max-width: 768px) {
            .box-area {
                margin: 0 10px;
                width: 100%; /* Make the form responsive */
            }

            .right-box {
                padding: 20px;
            }
        }

        .errorWrap {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Password Recovery Box -------------------------->

        <div class="row box-area">

            <!----------------------- Right Box -------------------------->

            <div class="col-md-12 right-box">
                <div class="header-text mb-4">
                    <h2>Password Recovery</h2>
                    <p>WayaShare | Note Sharing Platform</p>
                    <?php if ($msg) { ?>
                        <div class="errorWrap"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div>
                    <?php } ?>
                </div>
                <form method="POST" name="reset_password_request">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <button id="form_submit" type="submit" name="reset_password_request" class="btn btn-primary">Request Password Reset</button>
                        <a href="../login.php" class="btn btn-link">Back to Login</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-DyZ1ssSE2dOlQ1eTXeW+QolRaHj8j1W0jNykfRdZ0xqP0v5p6tSca8Sm5AAKzU5N" crossorigin="anonymous"></script>
</body>
</html>
