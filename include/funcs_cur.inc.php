<?php
function set_session_msg($msg)
{
 $_SESSION['sess_msg']=$msg;
}

function display_sess_msg()
{
 if($_SESSION['sess_msg']!='')  {
  echo '<span class="redcolor">';
  echo $_SESSION['sess_msg'];
  unset($_SESSION['sess_msg']) ; 
  echo "</span>";
   }

}
function protect_admin_page() {

	$cur_page = basename($_SERVER['PHP_SELF']);

	$arr=array('login.php','proposal.php','proposal1.php','proposal2.php','proposal3.php','dialer_req.php','dialer_resp.php','sla.php','invoice_format.php');

	if(in_array("$cur_page",$arr)){

		//no action	

	}

	else{

		if ($_SESSION['sess_admin_login_id']=='') {

			header('Location: login.php');

			exit;

		}

	}

}
function protect_member_page() {

	$cur_page = basename($_SERVER['PHP_SELF']);

	//echo "<br>cur_page: $cur_page";

	if($cur_page != 'login.php') {

		if ($_SESSION['sess_user_id']=='') {

			header('Location: login.php');

			exit;

		}

	}

}


?>