<?php 
function connect_db(){
	global $ARR_CFGS;
	if (!isset($GLOBALS['dbcon'])){
		$GLOBALS['dbcon'] =	mysqli_connect($ARR_CFGS["db_host"], $ARR_CFGS["db_user"], $ARR_CFGS["db_pass"]);
	mysqli_select_db($GLOBALS['dbcon'],$ARR_CFGS["db_name"]) or die("Could not connect to database. Please check configuration and ensure MySQL is running.");
	
	}
}
function db_query($sql, $dbcon2 = null){
	if($dbcon2==''){
		if(!isset($GLOBALS['dbcon'])) {
			connect_db();
		}
		$dbcon2	= $GLOBALS['dbcon'];
	}
	$time_before_sql = checkpoint();
	$result	= mysqli_query($dbcon2,$sql) or	die(db_error($sql));
	return $result;
}
function db_scalar($sql, $dbcon2 = null){
	if($dbcon2==''){
		if(!isset($GLOBALS['dbcon'])) {
			connect_db();
		}
		$dbcon2	= $GLOBALS['dbcon'];
	}
	$result	= db_query($sql, $dbcon2);
	if ($line =	mysqli_fetch_array($result))	{
		$response =	$line[0];
	}
	return $response;
}
function isLoginSessionExpired() {
	$login_session_duration = 10; 
	$current_time = time(); 
	if(isset($_SESSION['loggedin_time']) and isset($_SESSION["user_id"])){  
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
			return true; 
		} 
	}
	return false;
}
function checkpoint($from_start = false){
	global $PREV_CHECKPOINT;
	if($PREV_CHECKPOINT==''){
		$PREV_CHECKPOINT = SCRIPT_START_TIME;
	}
	$cur_microtime = getmicrotime();	
	if($from_start){
		return $cur_microtime - SCRIPT_START_TIME;
	}
	else{
		$time_taken = $cur_microtime - $PREV_CHECKPOINT;
		$PREV_CHECKPOINT = $cur_microtime;
		return $time_taken;
	}
}
function getmicrotime(){
	list($usec,	$sec) =	explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}
function make_url($url){
	$parsed_url	= parse_url($url);
	if ($parsed_url['scheme'] == '') {
		return 'http://' . $url;
	}
	else {
		return $url;
	}
}