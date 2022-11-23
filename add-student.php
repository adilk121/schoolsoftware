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
<?php include("admin-sidebar.php") ?>
<?php
$date=date("Y-m-d");
if(isset($_POST['Submit']))
{	
  extract($_POST);
if(!empty($_POST['std_name']) && !empty($_POST['std_subject_id']) && !empty($_POST['std_password']) && !empty($_POST['std_email']) && !empty($_POST['std_mobile']) && !empty($_POST['std_dob']) && !empty($_POST['std_gender']) && !empty($_POST['std_class_id']))
{	
  $mobileno = $_POST['std_mobile'];
  if(is_numeric($mobileno))
  {
    $mobileregex = "/^[6-9][0-9]{9}$/";
  if(preg_match($mobileregex, $mobileno))
  {
    $std_sub_idim=$_POST['std_subject_id'];
    $implo = implode(",",$std_sub_idim);
    if(db_scalar("SELECT user_name FROM tbl_user")>0)
    {
        $msg="Student Already Exist Please enter another username";
    }else
    {
      $pswrd_hash = $_POST['std_password'];
      $hshpswrd=password_hash($pswrd_hash,PASSWORD_DEFAULT);
      $username = htmlspecialchars(trim($_POST['std_name']));
      $suff = rand(1001,9999);
      $Uname = $_POST['std_name'];
      $userNamefour = strtolower(substr($Uname,0,5));
      $userName = trim($userNamefour);
      $add_user_name = $userName.$suff;
	    $sql="INSERT INTO tbl_user SET 
	    name='".htmlspecialchars(trim($_POST['std_name']))."',		
	    user_name='$add_user_name',
	    user_password='$hshpswrd',
	    email='".htmlspecialchars(trim($_POST['std_email']))."',
	    mobile='".htmlspecialchars(trim($_POST['std_mobile']))."',
	    dob='".htmlspecialchars(trim($_POST['std_dob']))."',
	    gender='".htmlspecialchars(trim($_POST['std_gender']))."',
	    std_guardian_id='".htmlspecialchars(trim($_POST['std_guardian_id']))."',
	    std_teacher_id='".htmlspecialchars(trim($_POST['std_teacher_id']))."',
      std_class_id='".htmlspecialchars(trim($_POST['std_class_id']))."',
      std_subject_id='$implo',
	    user_role='S'";
	    $query = mysqli_query($con,$sql);
      if($query)
      {
        $to=$_POST['std_email'];
        $subject="Welcome to SMS";
        $message="Uername:".$add_user_name."&nbsp Password:".$_POST['std_password'];
        $headers="From:principal@gmail.com";
        if(mail($to,$subject,$message,$headers))
        {
          
        }
        else
        {
        $msg ="Mail not send";
        }
      }
  ?>
      <script>alert("Student Added Successfully! Welcome Mail Send to User")</script>
  <?php 
        header("location:students.php");
    }
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
    $msg="Please Fill all Required Field";
}
}
?>
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">Add Students</h3>
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
                          <input type="text" name="std_name" value="<?php echo $std_name ?>" id="std_name" class="form-control" />
                        </div>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Email <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <input type="email"  value="<?php echo $std_email ?>" name="std_email" id="std_email" autocomplete="off" autofill="no" class="form-control" />
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Mobile Number <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <input type="text" value="<?php echo $std_mobile ?>"  name="std_mobile" id="std_mobile" class="form-control" maxlength="12" />
                        </div>
                      </div>
                     
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Date of Birth <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <div>
                            <input type="date" value="<?php echo $std_dob ?>" name="std_dob" id="std_dob" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Gender <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <select class="form-control select " name="std_gender" id="std_gender">
                            <option>Select Gender</option>
                            <option <?php if($_POST['std_gender']=='M'){ ?> selected <?php } ?> value="M">Male</option>
                            <option  <?php if($_POST['std_gender']=='F'){ ?> selected <?php } ?> value="F">Female</option>
                            
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Class <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <select class="form-control select" name="std_class_id" id="std_class_id" onChange="loadSubject(this.value)">
                            <option value="">Select Class</option>
                            <?php 
                            $class = "SELECT * FROM tbl_class WHERE 1";
                            $res_class=db_query($class);
                            if(mysqli_num_rows($res_class)>0)
                            {
                                while($result_class=mysqli_fetch_array($res_class))
                                {
                            ?>
                            <option value="<?=$result_class['class_id']?>"><?=$result_class['class_name']?></option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-12 col-sm-6" id="subject-area">
                        <div class="form-group">
                          
                          
                        </div></div>
                          <div class="col-12">
                        <h5 class="form-title">
                          <span>Guardian Information </span>
                        </h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Guardian Name </label>
                          <select class="form-control select" name="std_guardian_id" id="std_guardian_id">
                            <option>
                            Select Guardian
                            </option>
                            <?php 
                            $guardian = "SELECT * FROM  tbl_user WHERE 1 AND user_role='G'";
                            $res=db_query($guardian);
                            if(mysqli_num_rows($res)>0)
                            {
                                while($result=mysqli_fetch_array($res))
                                {
                            ?>
                            <option value="<?=$result['user_id']?>">
                                <?=$result['name']?>
                            </option>
                            <?php }}?>
                         </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <h5 class="form-title">
                          <span>Teacher Information</span>
                        </h5>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Teacher Name <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <select class="form-control select" name="std_teacher_id" id="std_teacher_id">
                            <option>
                            Select Teacher
                            </option>
                            <?php 
                            $teacher_role = "SELECT * FROM  tbl_user WHERE 1 AND user_role='T'";
                            $res_teacher_role=db_query($teacher_role);
                            if(mysqli_num_rows($res_teacher_role)>0)
                            {
                                while($result_teacher_role=mysqli_fetch_array($res_teacher_role))
                                {
                            ?>
                            <option value="<?=$result_teacher_role['user_id']?>">
                                <?=$result_teacher_role['name']?>
                            </option>
                            <?php }}?>
                         </select>
                        </div>
                      </div>

                      <div class="col-12">
                        <h5 class="form-title">
                          <span>Login Info</span>
                        </h5>
                      </div>
                      
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label>Password <i class="fa fa-asterisk" style="font-size:0.425em;color:red ;" aria-hidden="true"></i></label>
                          <input type="password" class="form-control" name="std_password" id="std_password" />
                        </div>
                      </div>
                      
                      <div class="col-12">
                        <button type="submit" name="Submit" class="btn btn-primary">
                          Submit
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
		alert('Mobile can not be left blank');
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
return true;
}
</script>
<script language="javascript" src="ajax1.js"></script>
<?php include("admin-footer.php") ?>
