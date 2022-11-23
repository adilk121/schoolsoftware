<?php
if($_REQUEST['EditGId']=='')
{
    header("location:guardian.php");
}
else
{
    $EditId = $_REQUEST['EditGId'];
}
include("admin-header.php");
include("admin-sidebar.php");
if(isset($_POST['Submit']))
{	
if(!empty($_POST['user_name']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['mobile']))
{	
  	$sql="UPDATE tbl_user SET 
    user_name='".htmlspecialchars(trim($_POST['user_name']))."',		
    name='".htmlspecialchars(trim($_POST['name']))."',	
    email='".htmlspecialchars(trim(strval($_POST['email'])))."',
    mobile='".htmlspecialchars(trim($_POST['mobile']))."' WHERE user_id='$EditId' and user_role='G'";
    
	mysqli_query($con,$sql);	
    echo $msg='Guardian Added Successfully';
    }
    else
    {
        $msg="Please Fill all Required Field";
    }
	
}
$reso_guard = "SELECT * FROM tbl_user WHERE 1 AND user_id='$EditId' AND user_role='G'";
$numrows_guard = mysqli_query($con,$reso_guard);
$result_gurad = mysqli_fetch_array($numrows_guard);
extract($result_gurad);
?>

      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Update Guadian</h3>
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
                          <input type="text" value="<?php echo $name ?>" name="name" id="name" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Mobile</label>
                          <input type="text" value="<?php echo $mobile ?>" name="mobile" id="mobile" class="form-control" />
                        </div>
                      </div>
                     
                  
                      
                      <div class="col-12">
                        <h5 class="form-title"><span>Login Details</span></h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" value="<?php echo $user_name ?>"  name="user_name" id="user_name" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Email ID</label>
                          <input type="email" value="<?php echo $email ?>" name="email" id="email" class="form-control" />
                        </div>
                      </div>
                    
                      
                      <div class="col-12">
                        <button type="submit" name="Submit" class="btn btn-primary">
                          Update
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