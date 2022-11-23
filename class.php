<?php
include("admin-header.php");
include("admin-sidebar.php");
?>
<?php
if(isset($_REQUEST['DelID']))
{
    
   $del_query_subj = "DELETE FROM tbl_class WHERE class_sub_id='".$_REQUEST['DelID']."'";
   mysqli_query($con,$del_query_subj);
   $del_query = "DELETE FROM tbl_class WHERE class_id='".$_REQUEST['DelID']."'";
   mysqli_query($con,$del_query);
    
}
?>
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Class List</h3>
                
              </div>
              <div class="col-auto text-end float-end ms-auto">
               
                <a href="add-class.php" class="btn btn-primary"
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
                          <th>Class Name</th>
                          <th> </th>
                          <th class="text-end">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $std = "SELECT * FROM tbl_class WHERE 1 ";
                        $res=mysqli_query($con,$std);
                        if ($res>0)
                        {
                          $i=1;
                        while($result = mysqli_fetch_array($res))
                        {
                        ?>
                        <tr>
                          <td><?=$i?></td>
                          <td>
                            <h2>
                              <a href="subjects.php?SubID=<?php echo $result['class_id']?>"><u><?=$result['class_name']?></u></a>
                            </h2>
                          </td>

                          <td><a href="add-subject.php?SubID=<?php echo $result['class_id']?>">Add Subjects</a></td>
                          <td class="text-end">
                            <div class="actions">
                              <a
                                href="edit-class.php?EditId=<?php echo $result['class_id'] ?>"
                                class="btn btn-sm bg-success-light me-2"
                              >
                                <i class="fas fa-pen"></i>
                              </a>
                              <a href="class.php?DelID=<?=$result['class_id']?>" class="btn btn-sm bg-danger-light">
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