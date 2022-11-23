<?php
// Load All Subject using AJax with Class ID and Student ID (If Subjects already alotted)
ob_start();
require_once("includes/dbsmain.inc.php");
include("con.php");
if(isset($_REQUEST['classID']))
{
    $classID=$_REQUEST['classID'];	
    $a=explode(',',$classID);
    //explode User id and classId
    $reso_ld = "SELECT * FROM tbl_user WHERE 1 AND user_id='$a[1]' AND user_role='S'";
    $numrows_ld = mysqli_query($con,$reso_ld);
    $result_ld = mysqli_fetch_array($numrows_ld);
    //extract($result_ld);
    $subject_explode_ld= $result_ld['std_subject_id'];
    $res_explode_id = explode(",",$subject_explode_ld);
//$classID=db_scalar("SELECT category_id FROM tbl_category WHERE 1 AND category_name='$classID'");
?>
<div class="col-12 col-sm-6">
<div class="form-group row">
<div >
<?php
    $sql="SELECT * FROM  tbl_subjects WHERE 1 AND sub_class_id='$a[0]'";
    $dataClass=mysqli_query($con,$sql);
    while($recClass=mysqli_fetch_array($dataClass))
    {
        $std_id_arr=$recClass['sub_id'];
        //print(in_array($std_id_arr,$res_explode_id));
?>
<input <?php if(in_array($std_id_arr,$res_explode_id)){ ?> checked <?php }?> ? type="checkbox" name="std_subject_id[]" value="<?php echo $recClass['sub_id'] ?>" id="subjectname"> <?php echo $recClass['sub_name'] ?>
<?php
    }
?>
</div>
</div>
</div>
<?php
}
?>