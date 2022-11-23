<?php
if($_REQUEST['EditId']==''){

    header("location:teachers.php");

}
else
{
    $teach_ID = $_REQUEST['EditId'];
}
include("admin-header.php");
include("admin-sidebar.php");
if(isset($_POST['Submit']))
{	
if(!empty($_POST['name']) && !empty($_POST['mobile']) && !empty($_POST['email']) && !empty($_POST['doj']))
{	
  	$sql="UPDATE tbl_user SET 
    name='".htmlspecialchars(trim($_POST['name']))."',		
    mobile='".htmlspecialchars(trim($_POST['mobile']))."',	
    email='".htmlspecialchars(trim($_POST['email']))."',
    doj='".htmlspecialchars(trim($_POST['doj']))."' WHERE user_id='$teach_ID'";
	  mysqli_query($con,$sql);	
    echo $msg='Teacher Updated Successfully';
    }
    else
    {
        $msg="Please Fill all Required Field";
    }
	
}
$reso_tech = "SELECT * FROM tbl_user WHERE 1 AND user_id='$teach_ID' AND user_role='T'";
$numrows_teach = mysqli_query($con,$reso_tech);
$result_teach = mysqli_fetch_array($numrows_teach);
extract($result_teach);
?>

?>
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Update Teacher</h3>
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
                          <input type="text" value="<?php echo $name ?>" name="name" id="name" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Mobile</label>
                          <input type="text" value="<?php echo $mobile ?>" name="mobile" id="admin_phone" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Joining Date</label>
                          <input type="date" value="<?php echo $doj ?>" name="doj" id="admin_joining_date" class="form-control" />
                        </div>
                      </div>
                  
                      <div class="col-12">
                        <h5 class="form-title"><span>Login Details</span></h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" readonly value="<?php echo $user_name ?>"  name="user_name" id="user_name" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Email ID</label>
                          <input type="email"  value="<?php echo $email ?>" name="email" id="email" class="form-control" />
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