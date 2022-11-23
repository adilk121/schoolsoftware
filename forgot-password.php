<!DOCTYPE html>
<?php 
ob_start();
require_once("includes/dbsmain.inc.php");
include("con.php");
if(isset($_SESSION['login'])){
    header('Location: index.php');
    exit;
}
?>
<?php
if(isset($_POST['Submit'])&& isset($_POST['email']))
{
session_start();
 $otp=$_SESSION["OTP"];
 $usercheck = "SELECT user_name FROM  tbl_user WHERE 1 AND email='".strval($_POST['email'])."'";
 $chek = mysqli_query($con,$usercheck);
 $checknum = mysqli_num_rows($chek);
if($checknum>0){
$RESETDETAIL = mysqli_fetch_array($chek);
$to=$email;
$subject="Verify OTP for Password reset";
$otp=rand(100000,999999);
$message=strval($otp);
$headers="From:abc@gmail.com";
if(mail($to,$subject,$message,$headers)){
$_SESSION["OTP"]=$otp;
$_SESSION["UserID"]=$RESETDETAIL['user_id'];
$_SESSION["username"]=$RESETDETAIL['user_name'];
$_SESSION["Email"]=$RESETDETAIL['email'];
$_SESSION["Password"]=$RESETDETAIL['password'];
header("Location:reset-password.php");
}
else
$msg ="Mail not send";
 }
  else{
    $msg ="User Not found";
 }
}
 ?>


<html lang="en">
  <!-- Mirrored from preschool.dreamguystech.com/html-template/template/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Oct 2022 09:22:57 GMT -->
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <title>SMS - Forgot Password</title>

    <link rel="shortcut icon" href="assets/img/favicon.png" />

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap"
    />

    <link
      rel="stylesheet"
      href="assets/plugins/bootstrap/css/bootstrap.min.css"
    />

    <link
      rel="stylesheet"
      href="assets/plugins/fontawesome/css/fontawesome.min.css"
    />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <div class="main-wrapper login-body">
      <div class="login-wrapper">
        <div class="container">
          <div class="loginbox">
            <div class="login-left">
              <img
                class="img-fluid"
                src="assets/img/logo-white.png"
                alt="Logo"
              />
            </div>
           
            <div class="login-right">
              <div class="login-right-wrap">
                
                <h1>Forgot Password?</h1>
                <p class="account-subtitle">
                  Enter your email to get a password reset link
                </p>
                <?php if(!empty($msg)){ ?>
	  <div class="col-sm-12 text-center">
      <b style="font-size:14px; color:#F90000;">
      <?php echo $msg?>
      </b>
      </div>
      <?php } ?>
                <form
                  action="" method="post"
                >
                  <div class="form-group">
                    <input
                      class="form-control"
                      type="email" name="email" id="email"
                      placeholder="email" required
                    />
                  </div>
                  
                  <div class="form-group mb-0">
                    <button name="Submit" class="btn btn-primary btn-block" type="submit">
                      Reset Password
                    </button>
                  </div>
                </form>

                <div class="text-center dont-have">
                  Remember your password? <a href="login.php">Login</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
  </body>

  <!-- Mirrored from preschool.dreamguystech.com/html-template/template/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Oct 2022 09:22:57 GMT -->
</html>
