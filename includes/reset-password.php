<?php
session_start();
error_reporting(E_ALL);

include('dbconn.php');
$msg = '';

if (!isset($_SESSION['reset_email'])) {
    echo "<script type='text/javascript'> document.location = 'password-recovery.php'; </script>";
}

if (isset($_POST['reset_password'])) {
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $email = $_SESSION['reset_email'];

    // Check if the passwords match
    if ($password !== $confirm_password) {
        $msg = "Passwords do not match. Please try again.";
    } else {
        // Update password
        $sql = "UPDATE users SET Password = :password WHERE Email = :email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        if ($query) {
            unset($_SESSION['reset_email']);
            echo "<script>alert('Password reset successful. Please login with your new password.');</script>";
            echo "<script type='text/javascript'> document.location = '../login.php'; </script>";
        } else {
            $msg = "Something went wrong. Please try again.";
        }
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
    <title>Reset Password | WayaShare</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }

        .box-area {
            width: 500px; /* Match the width to the index.html */
            padding: 20px; /* Add padding */
        }

        .right-box {
            padding: 40px 30px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        ::placeholder {
            font-size: 16px;
        }

        @media only screen and (max-width: 768px) {
            .box-area {
                margin: 0 10px;
                width: 100%;
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

        <!----------------------- Reset Password Box -------------------------->

        <div class="row box-area">

            <!----------------------- Right Box -------------------------->

            <div class="col-md-12 right-box">
                <div class="header-text mb-4">
                    <h2>Reset Password</h2>
                    <p>WayaShare | Note Sharing Platform</p>
                    <?php if ($msg) { ?>
                        <div class="errorWrap"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div>
                    <?php } ?>
                </div>
                <form method="POST" name="reset_password">
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <button id="form_submit" type="submit" name="reset_password" class="btn btn-primary">Reset Password</button>
                        <a href="password-recovery.php" class="btn btn-link">Back</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-DyZ1ssSE2dOlQ1eTXeW+QolRaHj8j1W0jNykfRdZ0xqP0v5p6tSca8Sm5AAKzU5N" crossorigin="anonymous"></script>
</body>
</html>
