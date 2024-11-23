<?php
    session_start();
    error_reporting(E_ALL);

    include('includes/dbconn.php');
    $msg = '';
    if (isset($_POST['signin'])) {
        $uname = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT Email,Password,Status,id FROM users WHERE Email=:uname and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':uname', $uname, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
                $status = $result->Status;
                $_SESSION['eid'] = $result->id;
            }
            if ($status == 0) {
                $msg = "In-Active Account. Please contact your administrator!";
            } else {
                $_SESSION['stulogin'] = $_POST['username'];
                echo "<script type='text/javascript'> document.location = 'home.php'; </script>";
            }
        } else {
            echo "<script>alert('Sorry, Invalid Details.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | WayaShare</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@600;700;900&family=Quicksand:wght@400;500;600;700&display=swap');

        body {
            font-family: "Quicksand", sans-serif;
            background: hsl(228, 50%, 96%);
        }

        .box-area {
            width: 930px;
        }

        .right-box {
            padding: 40px 30px 40px 40px;
        }

        ::placeholder {
            font-size: 16px;
        }

        .rounded-4 {
            border-radius: 20px;
        }

        .rounded-5 {
            border-radius: 30px;
        }

        @media only screen and (max-width: 768px) {
            .box-area {
                margin: 0 10px;
            }
            .left-box {
                height: 100px;
                overflow: hidden;
            }
            .right-box {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Login Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            
            <!-- Left Box -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #241072;">
                <div class="featured-image mb-3">
                    <img src="assets/images/login.png" class="img-fluid" style="width: 250px;">
                </div>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on this platform.</small>
            </div>

            <!-- Right Box -->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Hello, Again</h2>
                        <p>We are happy to have you back.</p>
                        <?php if ($msg) { ?>
                            <div class="alert alert-danger">
                                <strong>Error</strong> : <?php echo htmlentities($msg); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Login Form -->
                    <form method="POST" name="signin">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" name="username" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="includes/password-recovery.php">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3" >
                            <button class="btn btn-lg btn-primary w-100 fs-6" type="submit" name="signin">Login</button>
                        </div>

                        <div class="row">
                            <small>Don't have an account? <a href="register.php">Sign Up</a></small>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- JS and Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
