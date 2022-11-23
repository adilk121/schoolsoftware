<?php 
if($_REQUEST['SubID']==""){
  header("location:class.php");
}else{
  $subID= $_REQUEST['SubID'];
}
include("admin-header.php");
include("admin-sidebar.php");
if(isset($_POST['Submit']))
{	
if(!empty($_POST['sub_name']) && !empty($_REQUEST['SubID']))
{	
 
	$sql="INSERT into tbl_subjects SET 
	sub_name='".htmlspecialchars(trim($_POST['sub_name']))."',	
	sub_class_id='".htmlspecialchars(trim($_REQUEST['SubID']))."'";
	mysqli_query($con,$sql);	?>
  <script>
    
    alert("Subject Added Successfully");
   
  </script>
  <?php 
   header("location:subjects.php?SubID=$subID");
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
                <h3 class="page-title">Add Subject</h3>
                <div class="col-auto text-end float-end ms-auto">
                <a href="subjects.php?SubID=<?php echo $_REQUEST['SubID']?>" class="btn btn-outline-primary me-2"
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
                        <h5 class="form-title">
                          <span>Subject Information</span>
                        </h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Subject Name</label>
                          <input type="text" class="form-control" name="sub_name" id="sub_name" />
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