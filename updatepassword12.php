<?php
session_start();
include_once "headerbefore.php";
$password=$code=$passwordConfirmation="";
$passwordErr=$codeErr=$passwordConfirmationErr="";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }
?>
<html>
<style>
    .error{
        color:red;
    }
</style>
<div class="login">
	<div class="container">
    <center>
    <h2 class="text-primary">password update</h2>
    <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
        <form method="POST" class="form-group" style="width:650px;">
            <input type="text" class="form-control" name="txtcode" placeholder="Verfication Code"/>
            <span class="error"><?php echo $codeErr; ?></span>
            <input type="password" class="form-control" name="txtpass" placeholder="New Password"/>
            <span class="error"><?php echo $passwordErr; ?></span>
            <input type="password" class="form-control"name="txtconfirm" placeholder="Confirm New Password"/>
            <span class="error"><?php echo $passwordConfirmationErr; ?></span>
            <input type="submit" value="Update Password" name="btnupdate">
            <h4>For New People</h4>
            <p><a href="register.php">Register Here</a> (Or) go back to <a href="index.php">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
                <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(empty($_POST["txtcode"])){
                        $codeErr = "Confirmation code is required";
                        }else{
                        $code=test_input($_POST["txtcode"]);
                        if($_SESSION["code"]!==$code){
                        $codeErr = "Confirmation code is Wrong";
                        }
                    }
                    if(empty($_POST["txtpass"])){
                        $passwordErr = "Password is required";
                        }else{
                        $password=test_input($_POST["txtpass"]);
                        // check if name only contains letters and whitespace
                        $passreg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";  
                        if(!preg_match($passreg,$password)) {
                            $passwordErr = "Min 8 char, at least 1 uppercase , 1 lowercase , 1 num and 1 special";
                        }
                    }
                    if(empty($_POST["txtconfirm"])){
                        $passwordConfirmErr = "Password is required";
                        }else{
                        $passwordConfirmation=test_input($_POST["txtconfirm"]);
                        if($passwordConfirmation!==$password){
                        $passwordConfirmationErr="Confirm must be match password , Try Again";
                        }
                    }
                
                        if(isset($_POST["btnupdate"])){
                        if(empty($codeErr)&&empty($passwordErr)&&empty($passwordConfirmationErr)){
                        include_once "Customer.php";
                        $cust=new Customer();
                        $cust->setpassword($password);
                        $ms=$cust->UpdatePW();
                        if($ms == "ok"){
                            echo("<script> window.open('index .php', '_self')</script>");
                        }else{
                            echo $ms;
                        }
                }
            } }
                ?>
        </form>
    </div>
    </div>
</div>
</html>
<?php
include_once "footer.php";
?>