<?php
    session_start();
    error_reporting(E_ALL);

    include('includes/dbconn.php');
    $msg='';
    if(isset($_POST['signup']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $confirm_password = md5($_POST['confirm_password']);
        $status = 1; // Active status

        // Check if the passwords match
        if ($password !== $confirm_password) {
            $msg = "Passwords do not match. Please try again.";
        } else {
            // Check if the email already exists
            $sql ="SELECT * FROM users WHERE Email=:email";
            $query = $dbh -> prepare($sql);
            $query-> bindParam(':email', $email, PDO::PARAM_STR);
            $query-> execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            if($query->rowCount() == 0)
            {
                $sql ="INSERT INTO users (username, Email, Password, Status) VALUES (:username, :email, :password, :status)";
                $query= $dbh -> prepare($sql);
                $query-> bindParam(':username', $username, PDO::PARAM_STR);
                $query-> bindParam(':email', $email, PDO::PARAM_STR);
                $query-> bindParam(':password', $password, PDO::PARAM_STR);
                $query-> bindParam(':status', $status, PDO::PARAM_INT);
                $query->execute();

                if($query)
                {
                    echo "<script>alert('Registration successful. Please login to continue.');</script>";
                    echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
                }
                else
                {
                    $msg = "Something went wrong. Please try again.";
                }
            } else {
                $msg = "Email already exists. Please try with another email.";
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
    
    <title>Signup | WayaShare</title>
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

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Signup Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #241072;">
                <div class="featured-image mb-3">
                    <img src="assets/images/login.png" class="img-fluid" style="width: 250px;">
                </div>
                
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join the WayaShare platform to share your knowledge and resources.</small>
            </div>

            <!--------------------------- Right Box ----------------------------->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Create Account</h2>
                        <p>We are excited to have you onboard.</p>
                        <?php if($msg){?><div class="errorWrap"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                    </div>
                    <form method="POST" name="signup">
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control form-control-lg bg-light fs-6" placeholder="Username" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="confirm_password" class="form-control form-control-lg bg-light fs-6" placeholder="Confirm Password" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6" type="submit" name="signup">Sign Up</button>
                        </div>
                    </form>
                    <div class="row">
                        <small>Already have an account? <a href="login.php">Login here</a></small>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>