<?php 
if($_REQUEST['did']==''){
    header("location:students.php");
    exit;

}
else{
    $std_id_url = $_REQUEST['did'];
}
?>
<?php include("admin-header.php") ?>
<script>
function getXMLHTTP() {
var xmlhttp=false;	
try{
xmlhttp=new XMLHttpRequest();
}
catch(e){
try{	
xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
}
catch(e){
try{
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
}
catch(e1){
xmlhttp=false;
}
}
}
return xmlhttp;
}
function loadSubject(classID){
//alert(classID);
var req=new XMLHttpRequest();
var str="load-subject.php?classID="+classID;
req.onreadystatechange = function() {
	
if(req.readyState==4){
if(req.status==200){//alert(req.responseText);

document.getElementById('subject-area').innerHTML=req.responseText;

}
}
}
req.open("GET",str,true);
req.send(null);
}
</script>
<?php include("admin-sidebar.php");
if(isset($_POST['Update']))
{	
if(!empty($_POST['name']) && !empty($_POST['std_subject_id']) && !empty($_POST['email']) && !empty($_POST['dob']) && !empty($_POST['mobile']) && !empty($_POST['gender']) && !empty($_POST['std_class_id'])&& !empty($_POST['std_teacher_id']))
{	
  $mobileno = $_POST['mobile'];
  if(is_numeric($mobileno))
  {
    $mobileregex = "/^[6-9][0-9]{9}$/";
  if(preg_match($mobileregex, $mobileno))
  {
    $std_sub_idim_update=$_POST['std_subject_id'];
    $implo_update_var = implode(",",$std_sub_idim_update);
	  $sql="UPDATE tbl_user SET 
	  name='".htmlspecialchars(trim($_POST['name']))."',		
	  email='".htmlspecialchars(trim($_POST['email']))."',
	  mobile='".htmlspecialchars(trim($mobileno))."',
	  dob='".htmlspecialchars(trim($_POST['dob']))."',
	  gender='".htmlspecialchars(trim($_POST['gender']))."',
	  std_guardian_id='".htmlspecialchars(trim($_POST['std_guardian_id']))."',
	  std_teacher_id='".htmlspecialchars(trim($_POST['std_teacher_id']))."',
    std_class_id='".htmlspecialchars(trim($_POST['std_class_id']))."',
    std_subject_id='$implo_update_var',
    user_role='S' where user_id='$std_id_url'";
	  mysqli_query($con,$sql);	
    $score = "UPDATE tbl_score SET score_sub_id='$implo_update_var', WHERE score_std_id='$std_id_url'";
    mysqli_query($con,$score);
    $msg='Student Updated Successfully';
} 
else
{
  $msg ="Mobile no. should be of 10 digits";
}
} 
  else
  {
    $msg ="Mobile no. should be in digits";
  }
}
else
{
    $msg="Please fill all required fields";
}

}
//Student Details
$reso = "SELECT * FROM tbl_user WHERE 1 AND user_id='$std_id_url' AND user_role='S'";
$numrows = mysqli_query($con,$reso);
$result = mysqli_fetch_array($numrows);
if(mysqli_num_rows($numrows)>0)
{
  extract($result);
  //Explode Studnet Subject ID
  $subject_explode= $result['std_subject_id'];
  $res_explode = explode(",",$subject_explode);
}
?>
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Edit Student</h3>
                <div class="col-auto text-end float-end ms-auto">
                <a href="students.php" class="btn btn-outline-primary me-2"
                  >Back</a
                >
    
              </div>
              </div>
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
              <div class="card">
                <div class="card-body">
                  <form action="" method="POST" onsubmit="return frmValid()">
                    <div class="row">
                      <div class="col-12">
                        <h5 class="form-title">
                          <span>Student Information</span>
                        </h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Student Name <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <input type="text" value="<?php echo $name?>" name="name" id="std_name" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Email <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <input type="text" value="<?php echo $email?>" name="email" id="std_email" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Mobile Number <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <input type="text" value="<?php echo $mobile?>" name="mobile" id="std_mobile" class="form-control" maxlength="12" />
                        </div>
                      </div>
                     
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Date of Birth <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <div>
                            <input type="date" name="dob" id="dob" value="<?php echo $dob?>" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Gender <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <select class="form-control" name="gender" id="std_gender">
                            <option <?php if($result['gender']==''){?> selected<?}?> value="">Select Gender</option>
                            <option  <?php if($result['gender']=='M'){?> selected<?}?> value="M">Male</option>
                            <option <?php if($result['gender']=='F'){?> selected<?}?> value="F">Female</option>
                          </select>
                        </div>
                      </div>
                                
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Class <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <select class="form-control select" name="std_class_id" id="std_class" onChange="loadSubject(this.value)" >
                            <option value="">Select Class</option>
                            <?php 
                            $class = "SELECT * FROM tbl_class WHERE 1 ";
                            $res_class=db_query($class);
                            if(mysqli_num_rows($res_class)>0)
                            {
                                while($result_class=mysqli_fetch_array($res_class))
                                {
                            ?>
                            <option <?php if($result['std_class_id']==$result_class['class_id']){ ?> selected <?php }?> value="<?php echo $result_class['class_id']?>,<?php echo $result['user_id']?>"><?php echo $result_class['class_name']?></option>
                            <?php }
                             }?>
                          </select>
                        </div>
                      </div>


                      <div class="col-12 col-sm-6" id="subject-area">
                        <div class="form-group">
                          <label><b>Subjects <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></b></label>
                          <div>
                            <?php 
                             $subj = "SELECT * FROM tbl_subjects WHERE 1 AND sub_class_id='".$result['std_class_id']."'";
                             $subj_class=db_query($subj);
                             if(mysqli_num_rows($subj_class)>0)
                             {
                                 while($result_class=mysqli_fetch_array($subj_class))
                                 {
                                  $std_id_arr=$result_class['sub_id'];
                                      ?>
                                      <input <?php if(in_array($std_id_arr,$res_explode)){ ?> checked <?php }?>type="checkbox" name="std_subject_id[]" value="<?php echo $result_class['sub_id'] ?>"> <?php echo $result_class['sub_name'] ?>

                                <?php 
                                       
                                  }
                              }?>
                          

                          </div> 
                        </div></div>
                      <div class="col-12">
                        <h5 class="form-title">
                          <span>Guardian Information</span>
                        </h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Guardian Name </label>
                          <select class="form-control select" name="std_guardian_id" id="std_guardian_id">
                            <option>
                            Select Guardian <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i>
                            </option>
                            <?php 
                            //Guardian Of Studnets
                            $guardian = "SELECT * FROM  tbl_user WHERE 1 AND user_role='G'";
                            $res=db_query($guardian);
                            if(mysqli_num_rows($res)>0)
                            {
                                while($result_guradian=mysqli_fetch_array($res))
                                {
                            ?>
                            <option <?php if($result['std_guardian_id']==$result_guradian['user_id']){ ?> selected<? } ?> value="<?php echo $result_guradian['user_id']?>">
                            <?php echo $result_guradian['name']?>
                            </option>
                            <?php }}?>
                         </select>
                        </div>
                      </div>

                  <?php 
                  if($_SESSION['user_role']=='P')
                  {?>
                      <div class="col-12">
                        <h5 class="form-title">
                          <span>Teacher Information</span>
                        </h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Teacher Name <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <select class="form-control" name="std_teacher_id" id="std_teacher_id">
                            <option value="">
                            Select Teacher
                            </option>
                            <?php 
                            // Techaer Of Students
                            $teacher_role = "SELECT * FROM  tbl_user WHERE 1 AND user_role='T'";
                            $res_teacher_role=db_query($teacher_role);
                            if(mysqli_num_rows($res_teacher_role)>0)
                            {
                                while($result_teacher_role=mysqli_fetch_array($res_teacher_role))
                                {
                            ?>
                            <option <?php if($result['std_teacher_id']==$result_teacher_role['user_id']) {?> selected <?php } ?> value="<?php echo $result_teacher_role['user_id']?>">
                            <?php echo $result_teacher_role['name']?>
                            </option>
                            <?php }}?>
                         </select>
                        </div>
                      </div>

            <?php }else
                  { // if teacher is edit a student then teacher id will be same
                  ?>
                    <input type="hidden" name="std_teacher_id" value="<?php echo $result['std_teacher_id'] ?>">
            <?php } ?> 
                     
                     
                     <div class="col-12">
                        <h5 class="form-title">
                          <span>Login Info</span>
                        </h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Username</label>
                          <input  readonly value="<?php echo $user_name?>" class="form-control"  name="" id=""/>
                        </div>
                      </div>                      
                      <div class="col-12">
                        <button type="submit" name="Update" class="btn btn-primary">
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

<script>
function frmValid()
{
 
if(document.getElementById('std_name').value==''){
		alert('Enter Student Name');
		document.getElementById('std_name').focus();
		return false;
	}	
    function trim(str){
return str.replace(/^\s*|\s*$/g,'');
}
var std_email=document.getElementById('std_email').value;

var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(trim(std_email)==0){
alert('Please enter email id');
document.getElementById('std_email').focus();
return false;
}else if(!std_email.match(mailformat)){
alert("You have entered an invalid email address!");
document.getElementById('std_email').focus();
return false;
}
	if(document.getElementById('std_mobile').value==''){
		alert('Please enter mobile no.');
		document.getElementById('std_mobile').focus();
		return false;
	}
if(isNaN(document.getElementById('std_mobile').value)){
alert("Mobile No. Should Be No.!");
document.getElementById('std_mobile').focus();
return false;
}
if(document.getElementById('std_mobile').value.length < 10){
    alert("Mobile no. should be 10 digit long !");
	document.getElementById('std_mobile').focus();
	return false;
}	
	if(document.getElementById('std_dob').value==''){
		alert('Please Select DOB');
		document.getElementById('std_dob').focus();
		return false;
	}
    if(document.getElementById('std_gender').value==''){
		alert('Please Choose Class');
		document.getElementById('std_gender').focus();
		return false;
	}
	if(document.getElementById('std_class').value==''){
		alert('Please Choose Class');
		document.getElementById('std_class').focus();
		return false;
	}
  
	if(document.getElementById('subjectname').value==''){
		alert('Please Choose Subjects');
		document.getElementById('subjectname').focus();
		return false;
	}
return true;
}
</script>
<script language="javascript" src="ajax1.js"></script>
<?php include("admin-footer.php") ?>
