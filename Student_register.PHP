<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student- Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="Admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        var check = function() {
            if (document.getElementById('pass').value ==
                document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'matching';
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
            }
        }
    </script>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <center>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                        </div>
                        <form action="connection.php" method="POST" onSubmit="return checkPassword(this)">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required="">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Email Address" required="">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3">
                                    <input type="password" name="password" class="form-control" id="pass" placeholder="Password" onkeyup='check();' required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm password" onkeyup='check();' required>
                                    <span id='message'></span>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-user btn-block" type="submit" name="submitstu" id="submitform">Register Account</button>
                            <script>
                                $("#submitform").click(function() {
                                    alert("The Form has been Submitted.");

                                });
                            </script>

                            <hr>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login!</a>
                        </div>
                    </div>
            </div>
            </center>
        </div>
    </div>
    </div>
    <?php

    include('Panel/script.php');

    ?>

</body>

</html>