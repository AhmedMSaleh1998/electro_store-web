<?php 
ob_start();
session_start();
include_once "headerBefore.php";
?>
<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Custom-Files -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Main css -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<!-- pop-up-box -->
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<!-- menu style -->
	<!-- //Custom-Files -->
    <!-- web fonts -->
	<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //web fonts -->
    <style>
    .error{
        color:red;
    }
</style>
</head>
<body>
<div class="login">
<div class="container">
    <center>
        <br><br><br>
    <h1>Verification code confirm</h1>
  <br/><div class='alert alert-success'>Check Your Email</div>
    <br>
    <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
        <form method="POST" style=width:450px;>
        <input type="text" class="form-control" name="txtcode" placeholder="Enter your verification code"/><br>
        <input type="submit" value="check code" name="codecheck">
        <?php
            
            if(isset($_POST["codecheck"])){
            if($_SESSION["code"]==$_POST["txtcode"]){

                $link="http://localhost/web/UpdatePassword.php?id=".$_SESSION["ide"];
                echo("<script> window.open('$link','_self')</script>");

            }else{
                echo("<br/><div class='alert alert-danger'> Invaild Code , Try Again </div>");
            }
        }
        ?>    
    </form>
        
    </center>
</body>
</html>