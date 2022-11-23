<?php include("header-top.php") ?>
 <?php include("admin-sidebar.php") ?>
     <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row">
              <div class="col-sm-12">
                <h3 class="page-title">Welcome <?php echo ucfirst($_SESSION['name']); ?></h3>
                
              </div>
            </div>
          </div>

          <div class="row">
            
          <?php
            if($_SESSION['user_role']!='S')
            {
          ?>
          <div class="col-xl-6 col-sm-6 col-12 d-flex">
              <div class="card bg-one w-100">
                <div class="card-body">
                  
                <div
                    class="db-widgets d-flex justify-content-between align-items-center"
                  >
                    <div class="db-icon">
                      <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="db-info">
                      <h3>
                      <?php
                        if($_SESSION['user_role']=='P')
                        {
                            echo db_scalar("SELECT COUNT(*) FROM tbl_user WHERE 1 AND user_role='S'");
                        }elseif($_SESSION['user_role']=='T')
                        {
                            echo db_scalar("SELECT COUNT(*) FROM tbl_user WHERE 1 AND std_teacher_id='".$_SESSION['login_id']."'");
                        }elseif($_SESSION['user_role']=='G')
                        {
                            echo db_scalar("SELECT COUNT(*) FROM tbl_user WHERE 1 AND std_guardian_id='".$_SESSION['login_id']."'");
                        }
                        ?>
                    </h3>
                      <h6>Students</h6>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          <?php
            }
          
          ?>
          <?php
            if($_SESSION['user_role']!='T' && $_SESSION['user_role']!='G')
            {
          ?>
            <div class="col-xl-6 col-sm-6 col-12 d-flex">
              <div class="card bg-two w-100">
                <div class="card-body">
                  <div
                    class="db-widgets d-flex justify-content-between align-items-center"
                  >
                    <div class="db-icon">
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="db-info">
                    <h3>
                    <?php
                        if($_SESSION['user_role']=='P')
                        {
                            echo db_scalar("SELECT COUNT(*) FROM tbl_user WHERE 1 AND user_role='T'");
                        }elseif($_SESSION['user_role']=='S')
                        {
                            echo db_scalar("SELECT COUNT(*) FROM tbl_user WHERE 1 AND user_id='".$_SESSION['std_teacher_id']."'");
                        }
                        ?>    
                  
                  </h3>
                      <h6>Teachers</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <?php 
            }
            ?>
          <?php
            if($_SESSION['user_role']!='T' && $_SESSION['user_role']!='G')
            {
          ?>
            <div class="col-xl-6 col-sm-6 col-12 d-flex">
              <div class="card bg-three w-100">
                <div class="card-body">
                  <div
                    class="db-widgets d-flex justify-content-between align-items-center"
                  >
                    <div class="db-icon">
                      <i class="fas fa-building"></i>
                    </div>
                    <div class="db-info">
                    <h3>
                    <?php
                        if($_SESSION['user_role']=='P')
                        {
                            echo db_scalar("SELECT COUNT(*) FROM tbl_user WHERE 1 AND user_role='T'");
                        }elseif($_SESSION['user_role']=='S')
                        {
                            echo db_scalar("SELECT COUNT(*) FROM tbl_user WHERE 1 AND user_id='".$_SESSION['std_guardian_id']."'");
                        }
                        ?>      
                  </h3>
                      <h6>Guardians</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                 <?php  if($_SESSION['user_role']=='P')
                        { ?>
            <div class="col-xl-6 col-sm-6 col-12 d-flex">
              <div class="card bg-two w-100">
                <div class="card-body">
                  <div
                    class="db-widgets d-flex justify-content-between align-items-center"
                  >
                    <div class="db-icon">
                    <i class="fa-solid fa-school"></i>
                    </div>
                    <div class="db-info">
                    <h3>
                    <?php
                            echo db_scalar("SELECT COUNT(*) FROM tbl_class");
                       
                        ?>    
                  
                  </h3>
                      <h6>Classes</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php }?>
          </div>
          
              <?php
              }
              ?>
              
          <div class="row">
            <div class="col-md-12 d-flex">
              <div class="card flex-fill">
                <div class="card-header">
                  <h5 class="card-title">Star Students</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-center">
                      <thead class="thead-light">
                        <tr>
                          <th>S.No.</th>
                          <th>Name</th>
                          <th class="text-center" >Class</th>
                          <th class="text-center">Marks</th>
                          <th class="text-center">Percentage</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $std_score = "SELECT * FROM tbl_user WHERE 1 AND user_role='S' ";
                        $res_score=db_query($std_score);
                        if ($res_score>0)
                        {
                          $i=1;
                        while($result_score = mysqli_fetch_array($res_score))
                        {
                        ?>

                        <tr>
                          <td class="text-nowrap">
                            <div><?php echo $i; ?></div>
                          </td>
                          <td class="text-nowrap"><?=$result_score['name']?></td>
                          <td class="text-center">
                            <?php echo db_scalar("SELECT class_name FROM tbl_class WHERE class_id='".$result_score['std_class_id']."'");
                            ?></td>
                          <td class="text-center">
                            <?php echo db_scalar("SELECT sum(sub_score) FROM tbl_score WHERE score_std_id='".$result_score['user_id']."' AND score_sub_id='".$result_score['std_subject_id']."'");
                            ?></td>
                          <td class="text-center">
                           <?php 
                           if(db_scalar("SELECT sum(sub_score) FROM tbl_score WHERE score_std_id='".$result_score['user_id']."'")!='')
                           {?>
                         <?php 
                            //Average Score of Students 
                            $subject_explode_ld= $result_score['std_subject_id'];
                            $res_explode_id = explode(",",$subject_explode_ld);
                            //echo "SELECT score_sub_id FROM tbl_score WHERE score_std_id='".$result['user_id']."'";
                            $avg_count =0;
                            $avg=0;
                            foreach($res_explode_id as $vo)
                            { 

                             // echo "SELECT SUM(sub_score) FROM tbl_score WHERE score_sub_id='$vo' AND score_std_id='".$result['user_id']."'";
                                $avg+=db_scalar("SELECT sub_score FROM tbl_score WHERE score_sub_id='$vo' AND score_std_id='".$result_score['user_id']."'");
                                $avg_count+= db_scalar("SELECT COUNT(*) FROM tbl_score WHERE score_sub_id='$vo'AND score_std_id='".$result_score['user_id']."'");
                                //echo $avg_count
                          }
                          echo round($avg/$avg_count)."%";
                          
                          }else
                          {
                              echo "No Score";
                            }
                              ?>
                            </td>
                         
                        </tr>

                        <?php $i++;} }?>
                       
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
            </div>
          </div>
        </div>
<?php include("admin-footer.php") ?>