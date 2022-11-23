<?php 
ob_start();
require_once("includes/dbsmain.inc.php");
include("con.php");
?>
 <?php
if(isset($_SESSION['UserID']))
{
if(isset($_REQUEST['CHANGE']))
 {
    $passowrd = trim($_POST['password']);
    $cpassowrd = trim($_POST['cpassowrd']);
    if($password!=$cpassowrd){
        $msg = "Password Not Matched";
    }else{
        $hashpasword = password_hash($passowrd,PASSWORD_DEFAULT);
        $usercheck = "UPDATE tbl_user SET user_password='$hashpasword' WHERE user_id='".$_SESSION['UserID']."'";
        $chek = mysqli_query($con,$usercheck);
        if(mysqli_num_rows($chek)>0)
        {
            ?>
            <script>
                alert("Password Reset Successfully");
            </script>
            <?php 
            session_destroy();
            header("location:login.php");
        }
    }

 }
}else{
header("location:forgot-password.php");
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
  </head>
  <body>
    <div class="text-center" style="width: 500px;margin:200px auto">
      <div class="">
        <div class="">
          <div class="form-group"><?php if(!empty($msg)){ ?>
	  <div class="col-sm-12 text-center">
      <b style="font-size:14px; color:#F90000;">
      <?php echo $msg?>
      </b>
      <?php }?>
            <div class="">
              <div class="">
                <h4>Change Password</h4>
                
      
                <form
                action="" method="post" onSubmit="return loginValidate();"
                >
                  <div class="form-group">
                    <input
                      class="form-control"
                      type="password" style="width:250px;margin:auto" name="password" id="password"
                      placeholder="Enter Password"
                    />
    
                  </div>
                  <div class="form-group">
                    <input
                      class="form-control"
                      type="password" style="width:250px;margin:auto" name="cpassword" id="cpassword"
                      placeholder="Enter Confirm Password"
                    />
    
                  </div>
                  <div class="form-group">
                    <button  style="width:250px;margin:auto"  class="btn btn-primary btn-block" name="CHANGE" type="submit">
                      Reset 
                    </button>
                  </div>
                </form>             
                
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
	if(document.getElementById("password").value==''){
            $('.pass-status').addClass('wrong-entry');
			document.getElementById("password").focus();
		   return false;
	}
       if(document.getElementById("cpassword").value==''){
            $('.log-status').addClass('wrong-entry');
			document.getElementById("cpassword").focus();
		   return false;
	}	
    if(document.getElementById("password").value!=document.getElementById("cpassword").value){
        alert("Passwsord Not Matched");
        document.getElementById("cpassword").focus();
        return false;
    }
	return true;
}
</script>
    <script src="assets/js/script.js"></script>
  </body>

  <!-- Mirrored from preschool.dreamguystech.com/html-template/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Oct 2022 09:21:47 GMT -->
</html>
