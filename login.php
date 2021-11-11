<html>
<?php
ob_start();
session_start();
include_once "headerBefore.php";
?>
</br></br>
<center>
<form method="post" style="width:400px">
    <h1>Login Form</h1>
    </br>
        <div class="form-group" >
        <input type="text" class="form-control" placeholder="username" name="txtuser" required=""></br>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="password" name="Password" required="" id="myInput">
            <input type="checkbox" onclick="myFunction()">Show Password
        </div>
        <div class="sub-w3l">
                <input type="checkbox" name="remmemberme">
                <label for="remmember me">Remember me?</label>
            </div>
        <div class="right-w3l">
            <input type="submit" class="form-control" value="Log in" name="btn-login">
        </div>
        <p class="text-center dont-do mt-3">
            <a href="checkemail.php">
                Forget Password</a>
        </p>
        <p class="text-center dont-do mt-3">
            <a href="Dashboardlogin.php">
                Login As Admin</a>
        </p>
        <p class="text-center dont-do mt-3">Don't have an account?
            <a href="register.php">
                Register Now</a>
        </p>
        <?php
        if(isset($_POST["btn-login"])){
        include_once "customer.php";
        $cust = new customer();
        $cust ->setemail($_POST["txtuser"]);
        $cust ->setphone($_POST["txtuser"]);
        $cust ->setpassword($_POST["Password"]);
        $rs = $cust->Login();
        
        if($row = mysqli_fetch_assoc($rs)){
            $_SESSION["name"] = $row["name"];
            $_SESSION["id"] = $row["customerid"];
            if(isset($_POST["remmemberme"]))
                {
                    setcookie("usercookie",$_POST["txtuser"],time()+60*60*24*365);
                }
            echo("<script> window.open('index.php', '_self')</script>");
            }else{
                echo "invalid login Data";
            }
            
            
        } 
        ?>
</form>
</center>
<?php
include_once "footer.php";
?>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</html>