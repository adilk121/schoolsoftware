<?php 
if($_REQUEST['SubID']==""){
  header("location:class.php");
}
else{
  $subID = $_REQUEST['SubID'];
}
include("admin-header.php");
include("admin-sidebar.php");
if(isset($_REQUEST['DelID']))
{
   $del_query = "DELETE FROM tbl_subjects WHERE sub_id='".$_REQUEST['DelID']."'";
   mysqli_query($con,$del_query);
   $subID = $_REQUEST['SubID'];
   header("location:subjects.php?SubID=$subID");
}
?>
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Subjects List</h3>
                
              </div>
              <div class="col-auto text-end float-end ms-auto">
                <a href="class.php" class="btn btn-outline-primary me-2"
                  > Back</a
                >
                <a href="add-subject.php?SubID=<?php echo $_REQUEST['SubID'] ?>" class="btn btn-primary"
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
                          <th class="text-end">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $std = "SELECT * FROM tbl_subjects WHERE 1 AND sub_class_id='".$_REQUEST['SubID']."'";
                        $res=mysqli_query($con,$std);
                        if ($res>0)
                        {
                          $i=1;
                        while($result = mysqli_fetch_array($res))
                        {
                        ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td>
                            <h2>
                              <a><?php echo $result['sub_name']?></a>
                            </h2>
                          </td>

                       
                          <td class="text-end">
                            <div class="actions">
                              <a
                                href="edit-subject.php?SubClass=<?php echo $_REQUEST['SubID']?>&mainSubID=<?php echo $result['sub_id'] ?>"
                                class="btn btn-sm bg-success-light me-2"
                              >
                                <i class="fas fa-pen"></i>
                              </a>
                              <a href="subjects.php?DelID=<?php echo $result['sub_id']?>&SubID=<?php echo $_REQUEST['SubID']?>" class="btn btn-sm bg-danger-light">
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