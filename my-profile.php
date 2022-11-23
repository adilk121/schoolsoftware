<?php include("admin-header.php") ?>
<?php include("admin-sidebar.php") ?>
<?php
//Student can only access this page
if ($_SESSION['user_role']!='S')
{
  header('location:index.php');
}
?>
<?php
$std = "SELECT * FROM tbl_user WHERE 1 AND user_role='S' AND user_id='".$_SESSION['login_id']."'";
$res=db_query($std);
if ($res>0)
{
    $result = mysqli_fetch_array($res);
    // Student Subject Id in array explode
    $sub_id_exe = $result['std_subject_id'];
    $explode_subId = explode(",",$sub_id_exe);
}else
{
    $msg = "No Result Found";
}
?>
<div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row">
              <div class="col-sm-12">
                <h3 class="page-title">Profile</h3>
                <div class="col-auto text-end float-end ms-auto">
                <div class="col-auto text-end float-end ms-auto">
                <a href="index.php" class="btn btn-outline-primary me-2"
                  >Back</a
                >
    
              </div>
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
                            <span class="info-span"><?php echo db_scalar("select class_name from tbl_class where 1 and class_id='".$result['std_class_id']."'") ?></span>
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
                          //Guardian name Assign to a Student
                            $std_gud = "SELECT * FROM tbl_user WHERE 1 AND user_id='".$_SESSION['std_guardian_id']."'";
                            $std_guar = db_query($std_gud);
                            if(mysqli_num_rows($std_guar)>0)
                            {
                                $std_guardian_list=mysqli_fetch_array($std_guar)
                            ?>
                          <li>
                            <span class="title-span">Guardian: </span>
                            <span class="info-span"><?php echo $std_guardian_list['name'] ?></span>
                          </li>
                          <?php
                             }
                            
                            //Teacher name Assign to a Student
                            $std_tech = "SELECT * FROM tbl_user WHERE 1 AND user_id='".$_SESSION['std_teacher_id']."'";
                            $std_techer = db_query($std_tech);
                            if(mysqli_num_rows($std_techer)>0)
                            {
                                $std_teacher_list=mysqli_fetch_array($std_techer);
                            ?>
                          <li>
                            <span class="title-span">Teacher : </span>
                            <span class="info-span"><?php echo $std_teacher_list['name'] ?></span>
                          </li>
                         <li> <span class="title-span"><b>List of Subjects</b> </span></li>
                        <?php }
                        // Subjects Of Students
                            foreach($explode_subId as $vo)
                            { ?>
                          <li>
                            <span class="info-span"><?php  echo db_scalar("SELECT sub_name FROM tbl_subjects WHERE 1 AND sub_id='$vo'");?></span>
                          </li>
                      <?php }?>
                            

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
<?php include("admin-footer.php") ?>