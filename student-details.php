<?php 
//Student Id should not be blank
if ($_REQUEST['STDId']=='')
{
    header("location:students.php");
}
else
{
    $reusId=$_REQUEST['STDId'];
}?>
<?php include("admin-header.php") ?>
<?php include("admin-sidebar.php") ?>
<?php
if($_SESSION['user_role']=='P')
{
  //Student Detail
  $std = "SELECT * FROM tbl_user WHERE 1 AND user_role='S' AND user_id='$reusId'";
}elseif($_SESSION['user_role']=='T')
{
  $std = "SELECT * FROM tbl_user WHERE 1 AND user_role='S'AND user_id='$reusId' AND std_teacher_id='".$_SESSION['login_id']."'";
}elseif($_SESSION['user_role']=='G')
{
  $std = "SELECT * FROM tbl_user WHERE 1 AND user_role='S' AND user_id='$reusId' AND std_guardian_id='".$_SESSION['login_id']."'";
}
  $res=db_query($std);
if (mysqli_num_rows($res)>0)
{
  // Student Subject Id in array explode
    $result = mysqli_fetch_array($res);
    $sub_id_exe = $result['std_subject_id'];
    $explode_subId = explode(",",$sub_id_exe);

?>
<div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row">
              <div class="col-sm-12">
                <h3 class="page-title">Student Profile</h3>
                <div class="col-auto text-end float-end ms-auto">
                <a href="students.php" class="btn btn-outline-primary me-2"
                  >Back</a
                >
    
              </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="about-info">
                    
                    <div class="media mt-3 d-flex">
                    <?php if(!empty($msg))
                    { ?>
	  <div class="col-sm-12 text-center" style="margin-bottom:20px ;">
      <b style="font-size:14px; color:#F90000;">
      <?php echo $msg?>
      </b>
      </div><?php } ?>
                      <div class="media-body flex-grow-1">
                        <ul>
                          <li>
                            <span class="title-span">Full Name : </span>
                            <span class="info-span"><?php echo $result['name'] ?></span>
                          </li>
                          <li>
                            <span class="title-span">Class : </span>
                            <span class="info-span"><?php echo db_scalar("SELECT class_name FROM tbl_class WHERE 1 AND class_id='".$result['std_class_id']."'") ?></span>
                          </li>
                          <li>
                            <span class="title-span">Mobile : </span>
                            <span class="info-span"><?php echo $result['mobile'] ?></span>
                          </li>
                          <li>
                            <span class="title-span">Email : </span>
                            <span class="info-span"
                              ><?php echo $result['email'] ?></span
                            >
                          </li>
                          <li>
                            <span class="title-span">Gender : </span>
                            <span class="info-span"><?php echo $result['gender'] ?></span>
                          </li>
                          <li>
                            <span class="title-span">DOB : </span>
                            <span class="info-span"><?php echo $result['dob'] ?></span>
                          </li>


                          <?php 
                          //Student Guardian Details
                            $std_gud = "SELECT * FROM tbl_user WHERE 1 AND user_id='".$result['std_guardian_id']."'";
                            $std_guar = db_query($std_gud);
                            if(mysqli_num_rows($std_guar)>0)
                            {
                                $std_guardian_list=mysqli_fetch_array($std_guar)
                          ?>
                          <li>
                            <span class="title-span">Guardian: </span>
                            <span class="info-span"><?php echo $std_guardian_list['name'] ?></span>
                          </li>
                      <?php }?>
                              <?php 
                              //Student Teacher Only Principle can see this
                              if($_SESSION['user_role']=='P')
                              { 
                                  $std_tech = "SELECT * FROM tbl_user WHERE 1 AND user_id='".$result['std_teacher_id']."'";
                                  $std_teacher = db_query($std_tech);
                                  if(mysqli_num_rows($std_teacher)>0)
                                  {
                                      $std_teacher_list=mysqli_fetch_array($std_teacher);
                        ?>
                          <li>
                            <span class="title-span">Teacher: </span>
                            <span class="info-span"><?php echo $std_teacher_list['name'] ?></span>
                          </li>
                            <?php
                                  }
                              }?>
                         
                         <li> <span class="title-span"><b>List of Subjects</b> </span></li>
                          <?php 
                          //List of student subjects
                            $subjects = "SELECT * FROM tbl_subjects WHERE 1";
                            $std_subje = db_query($subjects);
                            if(mysqli_num_rows($std_subje)>0)
                            {
                                while($std_subj_list=mysqli_fetch_array($std_subje))
                                {   
                                    $std_SUBID = $std_subj_list['sub_id'];                              
                            ?>
                          <p style="font-size: 19px; margin-left:12px">
                             <span class="info-span"><?php if(in_array($std_SUBID,$explode_subId)){ echo $std_subj_list['sub_name'];}?></span>
                            </p>
                            <?php 
                                }
                            }?>
                           
                            
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
 <?php  
}
else
{
  ?>
  
<div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row">
              <div class="col-sm-12">
                <h3 class="page-title"> <?php echo "Sorry! No result Found"; ?></h3>
                <div class="col-auto text-end float-end ms-auto">
               
              </div>
              </div>
            </div>
          </div>
          
        </div>
  <?php
}?>
<?php include("admin-footer.php") ?>