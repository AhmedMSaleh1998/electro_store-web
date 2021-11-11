<?php 
ob_start();
include_once "updateprofile.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//geodata.solutions/includes/countrystatecity.js"></script>
  <style>
.profileField {
  padding: 15px;
  width:150px;
  font-family: 'Oxygen', sans-serif;
  font-weight: 300;
  font-size: 20px;
  display: inline-block;
  white-space: nowrap;
}
</style>
</head>
<body>
<?php
$country = $state = $city = "";
$countryErr = $stateErr = $cityErr = "";
?>
<div class="container" width="50px">
  <div class="row">
    <div class="sm-2">
      <h3><span class="error";>*</span>Country</h3>
      <select name="country" class="countries form-select profileField" id="countryId" value=<?php echo $row["country"]?>>
    <option value=""> Select Country</option>
    </select>
    </div>
  <div class="sm-2">
      <h3><span class="error";>*</span>State</h3>
      <select name="state" class="states form-select profileField" id="stateId" value=<?php echo $row["state"]?>>
    <option value="">Select State</option>
    </select>
    </div>
    <div class="sm-2">
      <h3><span class="error";>*</span>City</h3>       
      <select name="city" class="cities form-select profileField" id="cityId" value=<?php echo $row["city"]?>>
    <option value="">Select City</option>
    </select>
    </div>
    </div>
    </div>

</body>
</html>