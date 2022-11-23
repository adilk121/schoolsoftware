<?php 
//Check Class ID Is Not Blank
    if($_REQUEST['EditId']=='')
    {
        header("location:class.php");
    }else
    {
        $editId = $_REQUEST['EditId'];
    }
         
        //header files Included
        include("admin-header.php");
        include("admin-sidebar.php");

// Adding Class Start
if(isset($_POST['Submit']))
{	
    if(!empty($_POST['class_name']))
    {	
        $className = htmlspecialchars(trim($_POST['class_name']));
	    $sql="UPDATE tbl_class SET 	
	    class_name='$className' WHERE 1 AND class_id='$editId'";
	    $clsSql =db_query($sql); 
        $color ="green";  
        $msg='Class Updated Successfully';
       
    }else
    {
        $msg="Please Fill all Required Field";
    }

}
//Fetch class details using of class ID
$clasDetail = "SELECT * FROM tbl_class WHERE 1 AND class_id='$editId'";
$details = db_query($clasDetail);
if(mysqli_num_rows($details)>0)
{
    $sqlresult = mysqli_fetch_array($details);
    extract($sqlresult);
}else
{
    $msg = "No Result Found";
}
?>
  <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Update Class</h3>
                <div class="col-auto text-end float-end ms-auto">
                <a href="class.php" class="btn btn-outline-primary me-2"
                  >Back</a
                >
              </div>
            </div>
          </div>
          <?php if(!empty($msg)){ ?>
	  <div class="col-sm-12 text-center" style="margin-bottom:20px ;">
      <b <?php if($color=="green"){?>style="font-size:14px; color:#008000;" <?php }else{ ?>style="font-size:14px; color:#F90000;"<?php }?>>
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
                          <input type="text" required value="<?php echo $class_name;?>" class="form-control" name="class_name" id="class_name" />
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