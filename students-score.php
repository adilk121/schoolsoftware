<?php include("admin-header.php") ?>
<?php include("admin-sidebar.php") ?>
<?php
//Techaer can only access this page
if ($_SESSION['user_role']!='T' && $_SESSION['user_role']!='G')
{
  header('location:index.php');
}
?>
<div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Students Score List</h3>
              </div>
            </div>
          </div>
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
                          <th>Name</th>
                          <!-- <th>Class</th> -->
                          <th>Total Avg. Score</th>
                          <?php
                          if($_SESSION['user_role']=='T')
                          {
                          ?>
                          <th class="text-end">Action</th>
                          <?php
                         }?>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                       if($_SESSION['user_role']=='T')
                       {
                           $std = "SELECT * FROM tbl_user WHERE 1 and user_role='S' and std_teacher_id='".$_SESSION['login_id']."' ORDER BY user_id desc";
                       }else{
                          $std = "SELECT * FROM tbl_user WHERE 1 and user_role='S' and std_guardian_id='".$_SESSION['login_id']."' ORDER BY user_id desc";
                       
                        }
                        $res=db_query($std);
                        if ($res>0)
                        {
                          $i=1;
                        while($result = mysqli_fetch_array($res))
                        {
                        ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td>
                            <h2 class="table-avatar">
                              <a href="student-details.php?STDId=<?php echo $result['user_id'] ?>"
                                ><?php echo $result['name']?></a>
                            </h2>
                          </td>
                          <!-- <td>10 B</td> -->
                          <td> 
                          <?php 
                            if(db_scalar("SELECT SUM(sub_score) FROM tbl_score WHERE score_std_id='".$result['user_id']."'")!='') 
                            {
                              ?>
                            <?php 
                            //Average Score of Students 
                            $subject_explode_ld= $result['std_subject_id'];
                            $res_explode_id = explode(",",$subject_explode_ld);
                            //echo "SELECT score_sub_id FROM tbl_score WHERE score_std_id='".$result['user_id']."'";
                            $avg_count =0;
                            $avg=0;
                            foreach($res_explode_id as $vo)
                            { 

                             // echo "SELECT SUM(sub_score) FROM tbl_score WHERE score_sub_id='$vo' AND score_std_id='".$result['user_id']."'";
                                $avg+=db_scalar("SELECT sub_score FROM tbl_score WHERE score_sub_id='$vo' AND score_std_id='".$result['user_id']."'");
                                $avg_count+= db_scalar("SELECT COUNT(*) FROM tbl_score WHERE score_sub_id='$vo'AND score_std_id='".$result['user_id']."'");
                                //echo $avg_count
                          }
                          echo round($avg/$avg_count)."%";
                          
                            ?>
                            <?php 
                            }else
                            {
                              echo "No Score";
                            }
                              ?>
                            </td>
                            <?php 
                            if($_SESSION['user_role']=='T')
                            {
                               
                            ?>
                          <td class="text-end">
                            <div class="actions">
                             <a href="edit-score.php?did=<?php echo $result['user_id']?>">  <button type="button" name="Submit" class="btn btn-primary">
                                Update Score</button>
                              </a>
                            </div>
                          </td>
                            <?php }?>
                        <?php 
                        $i++;
                          }
                          }?>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                        </form>
            </div>
          </div>
        </div>
       
       <?php include("admin-footer.php") ?>