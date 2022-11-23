<?php
include("admin-header.php");
include("admin-sidebar.php");
if(isset($_POST['Submit']))
{	
if(!empty($_POST['admin_name']) && !empty($_POST['admin_email']) && !empty($_POST['admin_password']) && !empty($_POST['admin_phone']) && !empty($_POST['admin_joining_date']))
{	
    $pswrd_hash = $_POST['admin_password'];
    $hshpswrd=password_hash($pswrd_hash,PASSWORD_DEFAULT);
    $suff = rand(1001,9999);
    $Uname = $_POST['admin_name'];
    $userNamefour = strtolower(substr($Uname,0,5));
    $userName = trim($userNamefour);
    $add_user_name = $userName.$suff;
  	$sql="INSERT INTO tbl_user SET 
    name='".htmlspecialchars(trim($_POST['admin_name']))."',		
    user_name='$add_user_name',
    mobile='".htmlspecialchars(trim($_POST['admin_phone']))."',	
    email='".htmlspecialchars(trim($_POST['admin_email']))."',
    user_password='$hshpswrd',
    user_role='T',
    doj='".htmlspecialchars(trim($_POST['admin_joining_date']))."'";
	  mysqli_query($con,$sql);	
      ?>
      <script>
        alert("Teacher Added Successfully");
       
      </script>
      <?php 
       header("location:teachers.php");
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
                <h3 class="page-title">Add Teachers</h3>
                <div class="col-auto text-end float-end ms-auto">
                <a href="teachers.php" class="btn btn-outline-primary me-2"
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
                          <input type="text" name="admin_name" id="admin_name" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Mobile</label>
                          <input type="text" name="admin_phone" id="admin_phone" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Joining Date</label>
                          <input type="date" name="admin_joining_date" id="admin_joining_date" class="form-control" />
                        </div>
                      </div>
                  
                      
                      <div class="col-12">
                        <h5 class="form-title"><span>Login Details</span></h5>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Email ID</label>
                          <input type="email" name="admin_email" id="admin_email" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="admin_password" id="admin_password" class="form-control" />
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