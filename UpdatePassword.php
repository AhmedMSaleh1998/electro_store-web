<?php
ob_start();
session_start();
include_once "headerBefore.php";
?>
<html>
    <style>
        .error{
            color:red;
        }
    </style>
    <body>
        <?php
              function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
             }
                    $password = $passwordconfirm =  "";
                    $passwordErr = $passwordconfirmErr = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){     
                  
                    if(empty($_POST["txtpass"])) {
                      $passwordErr = "Name is required";
                    } else {
                      $password =test_input($_POST["txtpass"]);
                      // validate password
                      $passreg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"; 
                      if (!preg_match($passreg,$password)){
                        $passwordErr = "Min 8 char, at least 1 uppercase , 1 lowercase , 1 num and 1 special";
                      }
                    }
                    if(empty($_POST["txtpassconfirm"])){
                        $passwordconfirmErr = "Password confirmation is required";
                    }else{
                        $passwordconfirm=test_input($_POST["txtpassconfirm"]);
                        // check if confirm matches password
                        if($passwordconfirm!==$password){
                        $passwordconfirmErr = "confirm doesn't matches password";
                        }
                        
                    }
                        if(isset($_SESSION["ide"])){
                        if(isset($_POST["btn-update"])){
                        if(empty($passwordErr)&&empty($passwordconfirmErr)){
                        include_once "customer.php";
                        $cust = new customer(); 
                        $cust->setpassword($password);
                        $ms = $cust->UpdatePW();  
                        if($ms=="ok")
                        {   
                            echo("<script> window.open('loginAfterChangePassword.php', '_self')</script>");
                        }
                        else{
                            echo("<div class='alert alert-danger'>$ms</div>");
                        }
                    }
                        }
                            }
                        }
        ?>
        <h1 class="alert alert-info text-center">Update Password Page</h1>
        <center>
        <h4 class="alert alert-danger" style="width:700px">*Reqired Fields</h4>
        <form method="POST" style="width:550px">
             <div class="form-group text-left">
            <label for="txtpass"><span class="error";>*</span>password</label>
             <input type="password" class="form-control" name="txtpass" placeholder="Min 8 char, at least 1 uppercase , 1 lowercase , 1 num and 1 special"/>
             <span class="error"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group text-left">
             <label for="txtpassconfirm"><span class="error";>*</span>Password Confirm</label>
             <input type="password" class="form-control" name="txtpassconfirm" placeholder="confirm must matches password" />
             <span class="error"><?php echo $passwordconfirmErr; ?></span>
            </div>
            <div class="right-w3l">
             <input type="submit" class="form-control" value="Update Password" name="btn-update">
            </div>
         </form>
    </center>
    </body
</html>
<?php
include_once "footer.php";
?>