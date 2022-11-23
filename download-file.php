<?php
require_once("includes/dbsmain.inc.php");
include("con.php");
if($_SESSION['user_role']=='P')
{
$filename= "students_list_".date('Y-m-d').".csv";
$sep = ",";
$fpointer = fopen("php://memory",'w');
$fileField = array('S.No.','User Name','Name','Email','DOB','Mobile','Class Name','Subjects');
fputcsv($fpointer,$fileField,$sep);

$query = "SELECT * FROM tbl_user WHERE user_role='S' ORDER BY name ASC";
$num_rows = mysqli_query($con,$query);
if(mysqli_num_rows($num_rows)>0)
{   
    $i=1;
    while($SqlData =mysqli_fetch_array($num_rows))
    {
        $var ="";
        $sub_id_exe = $SqlData['std_subject_id'];
        $explode_subId = explode(",",$sub_id_exe);
        
        foreach($explode_subId as $vo)
        {
           $var .=  db_scalar("SELECT sub_name FROM tbl_subjects WHERE 1 AND sub_id='$vo'").",";
        }
        $clasname = db_scalar("SELECT class_name FROM tbl_class WHERE class_id='".$SqlData['std_class_id']."'");
        
        $allrowscols = array($i,$SqlData['user_name'],$SqlData['name'],$SqlData['email'],$SqlData['dob'],$SqlData['mobile'],$clasname,$var);
        fputcsv($fpointer,$allrowscols,$sep);
    $i++;}
}
fseek($fpointer,0);
header('Content-Type: text/csv');
header('Content-Disposition:attachment; filename="' .$filename. '";');
fpassthru($fpointer);
exit();
}
?>
