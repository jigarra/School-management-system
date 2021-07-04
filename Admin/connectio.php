<?php

$connection = mysqli_connect("localhost","root","","schoolms");
// admin connection
if(isset($_POST['submit']))
{
    $username = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $cpassword = $_POST['confirm_password'];

if($password === $cpassword)
{
$query = "INSERT INTO `admin_registration` (first_name,last_name,email,pass,confirm_password) VALUES ('$username','$lastname','$email','$password','$cpassword')";
$query_run = mysqli_query($connection,$query);

if($query_run)
{
    $_SESSION['success'] = "admin profile added";
    header('Location: index.php');    
}
else
{
    $_SESSION['status'] = "admin profile not added";
    header('Location: index.php');
}
}
else
{
    $_SESSION['status'] = "password and confirm password dos nit match";
    header('Location: inxed.php');
}
}


// Tacheer Connection

if(isset($_POST['submit']))
{
    $username = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $cpassword = $_POST['confirm_password'];

if($password === $cpassword)
{
$query = "INSERT INTO `teacher_registration` (first_name,last_name,email,pass,confirm_password) VALUES ('$username','$lastname','$email','$password','$cpassword')";
$query_run = mysqli_query($connection,$query);

if($query_run)
{
    $_SESSION['success'] = "admin profile added";
    header('Location: index.php');    
}
else
{
    $_SESSION['status'] = "admin profile not added";
    header('Location: index.php');
}
}
else
{
    $_SESSION['status'] = "password and confirm password dos nit match";
    header('Location: index.php');
}
}
// student Connection

if(isset($_POST['submit']))
{
    $username = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $cpassword = $_POST['confirm_password'];

if($password === $cpassword)
{
$query = "INSERT INTO `student_registration` (first_name,last_name,email,pass,confirm_password) VALUES ('$username','$lastname','$email','$password','$cpassword')";
$query_run = mysqli_query($connection,$query);

if($query_run)
{
    $_SESSION['success'] = "admin profile added";
    header('Location: index.php');    
}
else
{
    $_SESSION['status'] = "admin profile not added";
    header('Location: index.php');
}
}
else
{
    $_SESSION['status'] = "password and confirm password dos nit match";
    header('Location: index.php');
}
}

// update Adin ID

if(isset($_POST['updatebtn']))
{
    $id = $_POST['update_id'];
    echo $id;
    // $query= "DELETE FROM `admin_registration` WHERE id='$id'";
    // $query_run = mysqli_query($connection,$query);
    

// delete Admin Id 
if(isset($_POST['deletebtn']))
{
    $id = $_POST['delete_id'];

    $query= "DELETE FROM `admin_registration` WHERE id='$id'";
    $query_run = mysqli_query($connection,$query);
    
    if ($query_run)
    {
        $_SESSION['success'] = "your Data is Deleted";
        header('Location: Admin/index.php'); 
    }
    else
    {
        $_SESSION['status'] = "your Data is  not Deleted";
        header('Location: Admin/index.php'); 
    }
}

?>           