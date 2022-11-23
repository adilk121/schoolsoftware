<?php 
//Check Student ID Is Not Blank
if($_REQUEST['did']=='')
{
    header("location:students-score.php");
    exit;
}else
{
    $std_id_url = $_REQUEST['did'];
}
?>
<?php include("admin-header.php") ?>
<?php include("admin-sidebar.php") ?>
<?php 
//Score Update Start
if(isset($_POST['Submit']))
{	
if(!empty($_POST['score_sub_id']) && !empty($_POST['sub_score']))
{	
  //all subject score in array
    $subIDNew=$_POST['sub_score'];
		foreach($subIDNew as $key=>$value){
    $check_detail = "select * from tbl_score where 1 and score_std_id='$std_id_url' and score_sub_id='$key'"; // Select One by One Score  of Each Subjects
    $disk = mysqli_query($con,$check_detail);
      if(mysqli_num_rows($disk)>0)
      {
        // if subject is already then it will update the score only
          $popu = "update tbl_score set sub_score='$value' where score_std_id='$std_id_url' and score_sub_id='$key'";
          mysqli_query($con,$popu);
          $color ="green";  
          $msg='Score Updated Successfully';
      }else
      {
        //Insert the Record of score in each subject
		      $popu = "insert into tbl_score set sub_score='$value',score_std_id='$std_id_url',score_sub_id='$key'";
          mysqli_query($con,$popu);
          $color ="green";  
          $msg='Score Added Successfully';
      }
    
    }
	
}
else
{
    $msg="Please Fill all Required Field";
}

}
$reso = "select * from tbl_user where 1 and user_id='$std_id_url' and user_role='S'";
$numrows = mysqli_query($con,$reso);
if(mysqli_num_rows($numrows)>0)
{
    $result = mysqli_fetch_array($numrows);
    extract($result);
    $subject_explode= $result['std_subject_id'];
    $res_explode = explode(",",$subject_explode);
}
else
{
  $msg="No Records found of User";
}
?>
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Edit Score</h3>
                <div class="col-auto text-end float-end ms-auto">
                <a href="students-score.php" class="btn btn-outline-primary me-2">Back</a>
              </div>
              </div>
            </div>
          </div>
          <?php if(!empty($msg)){ ?>
	  <div class="col-sm-12 text-center">
      <b <?php if($color=="green"){?>style="font-size:14px; color:#008000;" <?php }else{ ?>style="font-size:14px; color:#F90000;"<?php }?>>
      <?php echo $msg?>
      </b>
      </div>
      <?php } ?>
      <div class="row">
            <div class="col-sm-12">
              <form action="" name="form" method="post" enctype="multipart/form-data">
              <div class="card card-table">
                <div class="card-body">
                  <div class="table-responsive ">
                    <table
                      class="table table-hover table-center mb-0 ">
                      <thead>
                        <tr> 
                          <th>S.No.</th>
                          <th>Subject Name</th>
                          <th>Marks Obt.</th>
                          <th>Max Marks</th>                         
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
$i=1;
foreach($res_explode as $vo)
{
    $subjects = "select * from tbl_subjects WHERE 1 and sub_id='$vo'";
    $std_subje = db_query($subjects);
    if(mysqli_num_rows($std_subje)>0)
    {
        $std_subj_list=mysqli_fetch_array($std_subje);
        $std_SUBID = $std_subj_list['sub_id'];
?>
                        <tr>
                    
                          <td><?php echo $i?></td>
                          <td>
                            <h2 class="table-avatar">
                              <?php echo $std_subj_list['sub_name'];?>
                              <input type="hidden" value="<?php $std_SUBID['sub_id']?>" name="score_sub_id">
                            </h2>
                          </td>
                          <!-- <td>10 B</td> -->
                          <td><input type="text" name="sub_score[<?php echo $std_SUBID?>]" id="sub_score[<?php echo $std_SUBID?>]" value="<?php echo db_scalar("select sub_score from tbl_score where score_sub_id='$std_SUBID' and score_std_id='$std_id_url'")?>" class="form-control" style="width:100px;" maxlength="3" /></td>
                          <td><input type="text" readonly value="100" class="form-control" style="width:100px;" maxlength="3" /></td>
                          
<?php 

 }
 $i++; 
}
?>
                      </tr>
                      </tbody>
                    </table>
                  </div> <div class="col-12">
                        <button type="submit" name="Submit" class="btn btn-primary">
                          Update Score
                        </button>
                      </div>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include("admin-footer.php") ?>