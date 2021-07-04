<?php

$connection = mysqli_connect("localhost", "root", "", "schoolbd");

//  Tacheer Connection

if (isset($_POST['submittea'])) {
    $username = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];

    if ($password === $cpassword) {
        $query = "INSERT INTO teacher_login (ID,firstname,lastname,password) VALUES ('$username','$lastname','$email','$password')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['success'] = "admin profile added";
            header('Location: index.php');
        } else {
            $_SESSION['status'] = "admin profile not added";
            header('Location: index.php');
        }
    } else {
        $_SESSION['status'] = "password and confirm password dos nit match";
        header('Location: index.php');
    }
}

// student Connection

if (isset($_POST['submitstu'])) {
    $username = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];

    if ($password === $cpassword) {
        $query = "INSERT INTO student_login (ID,firstname,lastname,password) VALUES ('$username','$lastname','$email','$password')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['success'] = "admin profile added";
            header('Location: index.php');
        } else {
            $_SESSION['status'] = "admin profile not added";
            header('Location: index.php');
        }
    } else {
        $_SESSION['status'] = "password and confirm password dos nit match";
        header('Location: index.php');
    }
}



//Admin profile

if (isset($_POST['submitprofile'])) {
    $username = $_POST['fname'];
    $lastname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $Bdate = $_POST['bdate'];
    $phoneno = $_POST['mobileno'];

    if ($password === $cpassword) {
        $query = "INSERT INTO admin_profile (ID,fname,lname,email,password,address,bdate,mobileno) VALUES ('$username','$lastname','$email','$password','$address',' $Bdate',' $phoneno')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['success'] = "admin profile added";
            header('Location: admin/profile.php');
        } else {
            $_SESSION['status'] = "admin profile not added";
            header('Location: index.php');
        }
    } else {
        $_SESSION['status'] = "password and confirm password dos nit match";
        header('Location: index.php');
    }
}