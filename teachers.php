<?php
include("admin-header.php");
include("admin-sidebar.php");
include("con.php");
if(isset($_REQUEST['DelID']))
{
   $del_query = "DELETE FROM tbl_user WHERE user_id='".$_REQUEST['DelID']."' AND user_role='T'";
  mysqli_query($con,$del_query);
    
}
?>
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Teachers</h3>
                
              </div>
              <div class="col-auto text-end float-end ms-auto">
               
                <a href="add-teacher.php" class="btn btn-primary"
                  ><i class="fas fa-plus"></i
                ></a>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="card card-table">
                <div class="card-body">
                  <div class="table-responsive">
                    <table
                      class="table table-hover table-center "
                    >
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>DOJ</th>
                          <th>Email</th>
                          <th>Mobile Number</th>
                          <th class="text-end">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $std = "SELECT * FROM tbl_user WHERE 1 AND user_role='T'";
                        $res=mysqli_query($con,$std);
                        if ($res>0)
                        {
                          $i=1;
                        while($result = mysqli_fetch_array($res))
                        {
                        ?>
                        <tr>
                          <td><?php echo $i ?></td>
                          <td>
                            <h2 class="table-avatar">
                              
                            <?=$result['name']?>
                            </h2>
                          </td>
                          <td><?=$result['user_name']?></td>
                          <td><?=$result['doj']?></td>
                          <td><?=$result['email']?></td>
                          <td><?=$result['mobile']?></td>
                          <td class="text-end">
                            <div class="actions">
                              <a
                                href="edit-teacher.php?EditId=<?php echo $result['user_id'] ?>"
                                class="btn btn-sm bg-success-light me-2"
                              >
                                <i class="fas fa-pen"></i>
                              </a>
                              <a href="teachers.php?DelID=<?=$result['user_id']?>" class="btn btn-sm bg-danger-light">
                                <i class="fas fa-trash"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                        <?php $i++;}}?>    
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include("admin-footer.php") ?>