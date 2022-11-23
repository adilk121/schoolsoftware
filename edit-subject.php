<?php 
if($_REQUEST['SubClass']=='' || $_REQUEST['mainSubID']=='' ){
  header("location:subjects.php?SubID=".$_REQUEST['SubClass']);
  exit;
}
?>
<?php include("admin-header.php") ?>
<?php include("admin-sidebar.php") ;
if(isset($_POST['Submit']))
{	
if(!empty($_POST['sub_name']))
{	
    $usercheck = "SELECT sub_name FROM tbl_subjects WHERE 1 AND sub_id='".$_REQUEST['mainSubID']."'";
    $chek = mysqli_query($con,$usercheck);
    $checknum = mysqli_num_rows($check);
    if($checknum>0){
       $sql_subjects_edit = mysqli_fetch_array($check);
    }

	$sql="update tbl_subjects set 
	std_name='".htmlspecialchars(trim($_POST['std_name']))."'";
	mysqli_query($con,$sql);	
  $msg='Subject Updated Successfully';
    
	
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
                <h3 class="page-title">Edit Subject</h3>
                <div class="col-auto text-end float-end ms-auto">
                <a href="subjects.php?SubID=<?php echo $_REQUEST['SubClass']?>" class="btn btn-outline-primary me-2"
                  >Back to Classes</a
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