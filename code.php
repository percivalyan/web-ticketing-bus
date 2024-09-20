<?php
session_start();
include_once 'conn.php';

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    if($password === $cpassword){
        $query = "INSERT INTO `register`(`username`, `email`, `password`) VALUES ('$username','$email','$password')";
        $run = mysqli_query($conn,$query);

        if($run){
            $_SESSION['success'] = "Admin profile Added!";
            header('location:register.php');
        }
        else{
            $_SESSION['status'] = "admin profile not added!";
            header('location:register.php');
        }

    }
    else
    {
        $_SESSION['status'] = "Password does not match";
        header('location: register.php');
    }
}

if(isset($_POST['update']))
{   
    $id = $_POST['edit_id'];
    $username = $_POST['eusername'];
    $email = $_POST['edemail'];
    $password = $_POST['epassword'];

    $query = "UPDATE `register` SET `username`='$username',`email`='$email',`password`='$password' WHERE id='$id' ";
    $sql = mysqli_query($conn, $query);

    if($sql)
    {
        $_SESSION['success'] = "Your admin data is updated!";
        header('location:register.php');
    }
    else
    {
        $_SESSION['status'] = "You admin data is not updated.";
        header('location:register.php');
    }
}


//Delete php code starts here

if(isset($_POST['delete_btn']))
{
    $d_id = $_POST['delete_id'];
    
    $slq_que = "DELETE FROM `register` WHERE id='$d_id' ";
    $slq_run = mysqli_query($conn, $slq_que);

    if($slq_run)
    {
        $_SESSION['success'] = "Your Data is deleted!";
        header('location: register.php');
    }
    else
    {
        $_SESSION['status'] = "It is not deleted!";
        header('location: register.php');
    }
}

//Delete php code ends here



//login coding start..
if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill'];
    $pass_login = $_POST['passwordd'];

    $login_sql = "SELECT * FROM `register` WHERE email='$email_login' AND password='$pass_login' ";
    $login_run = mysqli_query($conn, $login_sql);

    if(mysqli_fetch_array($login_run))
    {
        $_SESSION['username'] = $email_login;
        header('location: index.php');
    }
    else
    {
        $_SESSION['failed'] = 'Eamil ID and Password is incorrect.';
        header('location: login.php');
    }
}



?>