<?php 
include("admin-header.php");
include("admin-sidebar.php");
$date=date("Y-m-d");
if(isset($_POST['Submit']))
{	
if(!empty($_POST['class_name']))
{	
 
	$sql="INSERT into tbl_class SET 	
	class_name='".htmlspecialchars(trim($_POST['class_name']))."'";
	mysqli_query($con,$sql);
 $msg='Class Added Successfully';

}
else{
    $msg="Please Fill all Required Field";
}
}

?>

      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Add Class</h3>
                <div class="col-auto text-end float-end ms-auto">
                <a href="class.php" class="btn btn-outline-primary me-2"
                  > Back</a
                >
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
                        <h5 class="form-title">
                          <span>Class Information</span>
                        </h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Class Name</label>
                          <input type="text" class="form-control" name="class_name" id="class_name" />
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