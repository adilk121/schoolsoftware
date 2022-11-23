<?php include("admin-header.php") ?>
<script language="JavaScript" type="text/javascript" src="includes/general.js"></script>
<?php include("admin-sidebar.php") ?>
<?php
if(isset($_POST['submit']))
{ 
	$execu_name=$_POST['guardian_id'];
	$cid=$_POST['cid'];
	$company=count($_POST['cid']);
	if($company >0)
	{
		foreach($cid as $cpid)
		{
			echo $dd="UPDATE tbl_user SET std_guardian_id='$execu_name' WHERE user_id ='$cpid'";
			mysqli_query($con,$dd);
      $msg = "Guardian Assigned Successfully";
		}
	}
}
if(isset($_POST['submit_teachers']))
{ 
	$admin_id=$_POST['admin_id'];
	$cid=$_POST['cid'];
	$company=count($_POST['cid']);
	if($company >0)
	{
		foreach($cid as $cpid)
		{
			$dd="UPDATE tbl_user SET std_teacher_id='$admin_id' WHERE user_id ='$cpid'";
			mysqli_query($con,$dd);
      $msg = "Teacher Assigned Successfully";
		}
	}
}
?>
<?php
if(isset($_REQUEST['DelID']))
{
   $del_query = "DELETE FROM tbl_user WHERE user_id='".$_REQUEST['DelID']."'";
  mysqli_query($con,$del_query);
    
}
?>
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Students List</h3>
              </div>
              <?php if($_SESSION['user_role']=='P'){?>

              <div class="col-auto text-end float-end ms-auto">
              <a href="download-file.php" class="btn btn-outline-primary me-2"
                  ><i class="fas fa-download"></i> Download</a
                >
                <a href="add-student.php" class="btn btn-primary"
                  ><i class="fas fa-plus"></i
                ></a>
              </div>

<?php }?>
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
              <form action="" name="form" method="post" enctype="multipart/form-data">
              <div class="card card-table">
                <div class="card-body">
                  <div class="table-responsive ">
                    <table
                      class="table table-hover table-center mb-0 "
                    >


                    <?php if($_SESSION['user_role']=='P'){?>
                    <div class="row" style="margin-left: 15px;">
                <div class="form-group">
                  <input  type="checkbox" name="check_all" id="check_all" value="1" onclick="checkall(this.form)" />
                  <select name="guardian_id" style="width:200px; height: 32px;border-radius: 25px;">
                  <option> Assign Guardian</option>
                  <?php
	$guradian="SELECT * FROM tbl_user WHERE 1 AND user_role='G'";
	$qqgua=db_query($guradian);
	while($res_guardian=mysqli_fetch_array($qqgua))
	{ ?>
                    <option value="<?php echo $res_guardian['user_id'];?>"><?php echo $res_guardian['name']; ?></option>
                    <?php } ?>
                    
                     </select>
                  <button type="submit" name="submit" class="btn btn-primary" onclick="return select_one()"><span ></span> Shift</button>
                 
                 
                  <select name="admin_id" style="width:200px; height: 32px;border-radius: 25px;">
                  <option> Assign Teacher</option>
                  <?php
	$teachers="select * from tbl_user where 1 and user_role='T'";
	$tech=db_query($teachers);
	while($res_teachers=mysqli_fetch_array($tech))
	{ ?>
                    <option value="<?php echo $res_teachers['user_id'];?>"><?php echo $res_teachers['name']; ?></option>
                    <?php } ?>
                    
                     </select>
                  <button type="submit" name="submit_teachers" class="btn btn-primary" onclick="return select_one()"><span></span> Shift</button>
                


                </div>
              </div>
              <?php }?>
             
              <thead>
                        <tr> 
                        <?php if($_SESSION['user_role']=='P'){?>
                        <th></th>
                        <?}?>
                          <th>S.No.</th>
                          <th>Name</th>
                          <!-- <th>Class</th> -->
                          <th>DOB</th>
                          <th>Class Name</th>
                          <th>Mobile Number</th> <th>Guardian Name</th> 
                          <?php if($_SESSION['user_role']=='P'){?>
                        <th>Teacher name</th>
                        <?}?>
                          <?php 
                          if($_SESSION['user_role']=='P' || $_SESSION['user_role']=='T'){
                          ?>
                          <th class="text-end">Action</th>
                          <?php }?>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                       if($_SESSION['user_role']=='P'){
                       $std = "SELECT * FROM tbl_user WHERE 1 AND user_role='S' order by user_id desc";
                       }elseif($_SESSION['user_role']=='T'){
                        $std = "SELECT * FROM tbl_user WHERE 1 AND user_role='S' and std_teacher_id='".$_SESSION['login_id']."' order by user_id desc";
                       }elseif($_SESSION['user_role']=='G'){
                        $std = "SELECT * FROM tbl_user WHERE 1 AND user_role='S' and std_guardian_id='".$_SESSION['login_id']."' order by user_id desc";
                       }
                        $res=db_query($std);
                        if ($res>0)
                        {
                          $i=1;
                        while($result = mysqli_fetch_array($res))
                        {
                        ?>
                        <tr>
                        <?php if($_SESSION['user_role']=='P'){?><td> <input type="checkbox" name="cid[]" id="cid[]" value="<?php echo $result['user_id']; ?>"></td><?php }?>
                          <td><?php echo $i?></td>
                          <td>
                            <h2 class="table-avatar">
                              <a href="student-details.php?STDId=<?php echo $result['user_id'] ?>"
                                ><?=$result['name']?></a
                              >
                            </h2>
                          </td>
                          <!-- <td>10 B</td> -->
                          <td><?php echo $result['dob']?></td>
                          <td><?php echo db_scalar("SELECT class_name FROM tbl_class WHERE class_id='".$result['std_class_id']."'")?></td>
                          <td><?php echo $result['mobile']?></td>
                          <td><?php echo db_scalar("SELECT name FROM tbl_user WHERE 1 and user_id='".$result['std_guardian_id']."'")?></td>
                          <?php if($_SESSION['user_role']=='P'){ ?>
                          <td><?php echo db_scalar("SELECT name FROM tbl_user WHERE 1 and user_id='".$result['std_teacher_id']."'")?></td>
                          <?php }?>
                          <?php  if($_SESSION['user_role']=='P' || $_SESSION['user_role']=='T'){?>
                          <td class="text-end">
                            <div class="actions">
                              <a
                                href="edit-student.php?did=<?php echo $result['user_id']?>"
                                class="btn btn-sm bg-success-light me-2"
                              >
                                <i class="fas fa-pen"></i>
                              </a>
                              <?php if($_SESSION['user_role']=='P'){ ?>
                            <a href="students.php?DelID=<?php echo $result['user_id']?>" class="btn btn-sm bg-danger-light">
                                <i class="fas fa-trash"></i></a>
                              </a>
                              <?php }?>
                            </div>
                          </td>

                          <?php }?>
                        </tr>

                        <?php $i++;}}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                        </form>
            </div>
          </div>
        </div>
<script language="javascript" type="text/javascript">
function checkall(objForm) {
  //alert(objForm);
  len = objForm.elements.length;
  var i = 0;
  for (i = 0; i < len; i++) {
    if (objForm.elements[i].type == "checkbox") {
      objForm.elements[i].checked = objForm.check_all.checked;
    }
  }
}

function select_one()
{
var chks = document.getElementsByName('cid[]');
var hasChecked = false;
for (var i = 0; i < chks.length; i++)
{
if (chks[i].checked)
{
hasChecked = true;
break;
}else{
hasChecked = false;
}
}
if (hasChecked == false)
{
alert("Please select at least one !");
return false;
}else{
return true;
}
}
</script>
       <?php include("admin-footer.php") ?>