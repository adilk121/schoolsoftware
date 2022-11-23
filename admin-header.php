<?php
ob_start();
require_once("includes/dbsmain.inc.php");
include("con.php");
$page_name=basename($_SERVER['PHP_SELF'],'.php');
$_SESSION['pgName'] = $page_name;
if(!isset($_SESSION['login'])){
	 header('Location: login.php');
	 exit;
}
$user=$_SESSION['login'];
$utype=$_SESSION['user_type'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <title>SMS - Students</title>

    <link rel="shortcut icon" href="assets/img/favicon.png" />

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap"
    />

    <link
      rel="stylesheet"
      href="assets/plugins/bootstrap/css/bootstrap.min.css"
    />

    <link
      rel="stylesheet"
      href="assets/plugins/fontawesome/css/fontawesome.min.css"
    />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />

    <link
      rel="stylesheet"
      href="assets/plugins/datatables/datatables.min.css"
    />

    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
.error input {
    border-color: 
red;
    border-width: 2px;
}

.success input {
    border-color: 
green;
    border-width: 2px;
}

.error span {
    color: 
red;
}

.success span {
    color: 
green;
}

span.error {
    color: 
red;
}

i {
    font-weight: 900;
    font-family: 'Font Awesome 5 Free';
}

    </style>
     
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
  </head>
  <body>
    <div class="main-wrapper">
      <div class="header">
        <div class="header-left">
          <a href="index.html" class="logo">
            <img src="assets/img/logo.png" alt="Logo" />
          </a>
          <a href="index.php" class="logo logo-small">
            <img
              src="assets/img/logo-small.png"
              alt="Logo"
              width="30"
              height="30"
            />
          </a>
        </div>

        <a href="javascript:void(0);" id="toggle_btn">
          <i class="fas fa-align-left"></i>
        </a>

       

        <a class="mobile_btn" id="mobile_btn">
          <i class="fas fa-bars"></i>
        </a>

        <ul class="nav user-menu">
             <li class="">
            
              <span><a class="dropdown-item" href="logout.php"><button type="button" class="btn btn-primary">Logout</button></a></span>
           
            
          </li>
        </ul>
      </div>
