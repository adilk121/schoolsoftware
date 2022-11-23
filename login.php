<?php 
ob_start();
require_once("includes/dbsmain.inc.php");
include("con.php");
if(isset($_SESSION['login'])){
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from preschool.dreamguystech.com/html-template/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Oct 2022 09:21:45 GMT -->
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <title>Preskool - Login</title>

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
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css" />
    <?php

if(isset($_POST['Login']))
{
    
	$user_name = $_REQUEST['user_name'];
	$password = $_REQUEST['password'];
  if(!empty($user_name) && !empty($password))
  {
	$sql="SELECT * FROM tbl_user WHERE user_name='".$user_name."' and user_status='Active'";
	$result = mysqli_query($con,$sql);
	$res=mysqli_fetch_array($result);
  $pswrd = password_verify($password,$res['user_password']);
	if($pswrd)
	{
    if(!empty($_POST["remember"])) {
      //COOKIES for username
      setcookie ("username",$user_name,time()+ (10 * 365 * 24 * 60 * 60));
      //COOKIES for password
      setcookie ("userpassword",$password,time()+ (10 * 365 * 24 * 60 * 60));
      } else {
        if(isset($_COOKIE["username"])) {
          setcookie ("username",null);
          if(isset($_COOKIE["userpassword"])) {
          setcookie ("userpassword",null);
                  }
                }
                }
		$_SESSION['login']=$res['user_name'];
		$_SESSION['login_id']=$res['user_id'];
		$_SESSION['std_guardian_id']=$res['std_guardian_id'];
		$_SESSION['std_teacher_id']=$res['std_teacher_id'];
		$_SESSION['user_name']=$res['user_name'];
		$_SESSION['name']=$res['name'];
		$_SESSION['user_name']=$res['user_name'];
		$_SESSION['user_role']=$res['user_role'];
    $_SESSION['loggedin_time'] = time();  
		if(isset($_SESSION["login_id"])) {
        if(!isLoginSessionExpired()) {
          header("Location:index.php");
        } else {
          header("Location:logout.php");
        }
      }
  
	}
  else{
    $msg="Invalid Login ID Or Password";
  }
  
  } 
}
  ?>
    

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
                <h1>Login</h1>
                <p class="account-subtitle">Access to our dashboard</p>
                <?php if(!empty($msg)){ ?>
	  <div class="col-sm-12 text-center">
      <b style="font-size:14px; color:#F90000;">
      <?php echo $msg?>
      </b>
      <?php }?>
      
                <form
                action="" method="post" onSubmit="return loginValidate();"
                >
                  <div class="form-group">
                    <input
                      class="form-control"
                      type="text"  value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"  name="user_name" id="login_id"
                      placeholder="Email Or Username"
                    />
                  </div>
                  <div class="form-group">
                    <input
                      class="form-control"
                      type="password" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>" name="password" id="password"
                      placeholder="Password"
                    />
                  </div>
                  <div class="form-group">
                    <input
                     
                      type="checkbox"  name="remember" id="remember" <?php if(isset($_COOKIE["username"])) { ?> checked <?php } ?> 
                    
                    /> Remember Me
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary btn-block" name="Login" type="submit">
                      Login
                    </button>
                  </div>
                </form>

                <div class="text-center forgotpass">
                  <a href="forgot-password.php">Forgot Password?</a>
                </div>
              
               
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
 $(document).ready(function(){
        $('.form-control').keypress(function(){
			$('.pass-status').removeClass('wrong-entry');
            $('.log-status').removeClass('wrong-entry');
        });

    });
function loginValidate(){
	if(document.getElementById("login_id").value==''){
            $('.pass-status').addClass('wrong-entry');
			document.getElementById("login_id").focus();
		   return false;
	}
       if(document.getElementById("password").value==''){
            $('.log-status').addClass('wrong-entry');
			document.getElementById("password").focus();
		   return false;
	}	
	return true;
}
</script>
    <script src="assets/js/script.js"></script>
  </body>

  <!-- Mirrored from preschool.dreamguystech.com/html-template/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Oct 2022 09:21:47 GMT -->
</html>
