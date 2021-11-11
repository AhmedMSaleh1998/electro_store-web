<?php 
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<div class="container">
  <h2 class="text-warning">Delete Account Confirmation</h2>
  <div class="card" style="width:400px">
    <img class="card-img-top" src="download.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h3 class="card-text text-info">Are You Sure You Want To Delete Your Account</h3>
      <a href="deleteaccount.php" class="btn btn-danger">Yes</a>
	  <a href="MyProfile.php" class="btn btn-success">No</a>
    </div>
  </div>
</center>
