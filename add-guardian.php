<?php
include("admin-header.php");
include("admin-sidebar.php");
if(isset($_POST['Submit']))
{	
if(!empty($_POST['guardian_name'])  && !empty($_POST['guardian_email']) && !empty($_POST['guardian_password']) && !empty($_POST['guardian_mobile']))
{	
    $pswrd_hash = $_POST['guardian_password'];
    $hshpswrd=password_hash($pswrd_hash,PASSWORD_DEFAULT);
    $suff = rand(1001,9999);
    $Uname = $_POST['guardian_name'];
    $userNamefour = strtolower(substr($Uname,0,5));
    $userName = trim($userNamefour);
    $add_user_name = $userName.$suff;
  	$sql="INSERT INTO tbl_user SET 
    user_name='$add_user_name',		
    user_password='$hshpswrd',
    name='".htmlspecialchars(trim($_POST['guardian_name']))."',	
    email='".htmlspecialchars(trim($_POST['guardian_email']))."',
    user_role='G',
    mobile='".htmlspecialchars(trim($_POST['guardian_mobile']))."'";
	  mysqli_query($con,$sql);
    ?>
    <script>
      alert("Guardian Add Successfully")
      </script>
    <?php 	
    header("location:guardian.php");  
  }
    else
    {
        $msg="Please Fill all Required Field";
    }
	
}
?>
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Add Guadian</h3>
                <div class="col-auto text-end float-end ms-auto">
                <a href="guardian.php" class="btn btn-outline-primary me-2"
                  >Back</a
                >
              </div>
              </div>
            </div>
          </div>
          <?php if(!empty($msg)){ ?>
	  <div class="col-sm-12 text-center">
      <b style="font-size:14px; color:#F90000;">
      <?php echo $msg?>
      </b>
      </div>
      <?php } ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-12">
                        <h5 class="form-title"><span>Basic Details</span></h5>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="guardian_name" id="guardian_name" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Mobile</label>
                          <input type="text" name="guardian_mobile" id="guardian_mobile" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12">
                        <h5 class="form-title"><span>Login Details</span></h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Email ID</label>
                          <input type="email" autocomplete="off" name="guardian_email" id="guardian_email" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" autocomplete="off" name="guardian_password" id="guardian_password" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="col-12">
                        <button type="submit" name="Submit" class="btn btn-primary">
                          Submit
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include("admin-footer.php") ?>