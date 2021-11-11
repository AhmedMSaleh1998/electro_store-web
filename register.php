
<?php
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
                    $name = $password = $phone = $email =  "";
                    $nameErr = $passwordErr = $phoneErr = $emailErr  = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){     
                  
                    if(empty($_POST["txtname"])) {
                      $nameErr = "Name is required";
                    } else {
                      $name =test_input($_POST["txtname"]);
                      // check if name only contains letters and whitespace
                      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)){
                        $nameErr = "Only letters and white space allowed";
                      }
                    }
                    if(empty($_POST["txtpass"])){
                        $passwordErr = "Password is required";
                      }else{
                        $password =test_input($_POST["txtpass"]);
                        // check if name only contains letters and whitespace
                        $passreg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";  
                        if(!preg_match($passreg,$password)) {
                          $passwordErr = "Min 8 char, at least 1 uppercase , 1 lowercase , 1 num and 1 special";
                        }
                      }
                      if(empty($_POST["txtphone"])){
                        $phoneErr = "phone is required";
                      }else{
                        $phone =test_input($_POST["txtphone"]);
                        // check if phone numbers are 11 numbers
                        $phonereg = "/^[0-9]{11}$/";
                        if(!preg_match($phonereg,$phone)){
                          $phoneErr = "Phone must be 11 Numbers";
                        }
                      }
                      if(empty($_POST["txtemail"])){
                        $emailErr = "email is required";
                      }else{
                        $email =test_input($_POST["txtemail"]);
                        // check if e-mail address is well-formed
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                          $phoneErr = "Invalid email format";
                        }
                      }
                      if(isset($_POST["btn-register"])){
                        include_once "customer.php";
                        $cust = new customer(); 
                        $cust->setname($name);
                        $cust->setpassword($password);
                        $cust->setphone($phone);
                        $cust->setemail($email);
                        $cust->setcountry($_POST["country"]);
                        $cust->setstate($_POST["state"]);
                        $cust->setcity($_POST["city"]);
                            if(empty($nameErr)&&empty($passwordErr)&&empty($phoneErr)&&empty($emailErr)){
                            $ms = $cust->Add();  
                            if($ms=="ok")
                            {
                             echo("<script>window.open('index.php','_self')</script>");
                            }
                            elseif(strpos($ms,"phone"))
                            {
                              $phoneErr = "This phone is used before";
                            }
                            elseif(strpos($ms,"email"))
                            {
                              $emailErr = "This Email is used before";
                            }
                            else{
                                echo("<div class='alert alert-danger'>$ms</div>");
                            }
                          }
                        }
                      }
        ?>
        <h1 class="alert alert-info text-center">Register Page</h1>
        <center>
        <h4 class="alert alert-danger" style="width:700px">*Reqired Fields</h4>
        <form method="POST" style="width:500px">
            <div class="form-group text-left">
             <label for="txtname"><span class="error";>*</span>Username</label>
             <input type="text" class="form-control" name="txtname" placeholder="Only letters and white space allowed"/>
             <span class="error"><?php echo $nameErr; ?></span>
            </div> 
            <div class="form-group text-left">
            <label for="txtpass"><span class="error";>*</span>password</label>
             <input type="password" class="form-control" name="txtpass" placeholder="Min 8 char, at least 1 uppercase , 1 lowercase , 1 num and 1 special"/>
             <span class="error"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group text-left">
             <label for="txtphone"><span class="error";>*</span>phone</label>
             <input type="phone" class="form-control" name="txtphone" placeholder="Phone must be 11 Numbers" />
             <span class="error"><?php echo $phoneErr; ?></span>
            </div>
            <div class="form-group text-left">
             <label for="txtemail"><span class="error";>*</span>Email</label>
             <input type="text" class="form-control" name="txtemail" placeholder="ahmed@ahmed.com"/>
             <span class="error"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group" name="countries">
             <?php include_once "countries.php";?>
            </div>
            <div class="form-group text-warning">
            <span class="error";>*</span>
             <input type="checkbox"  required name="checkaggree"/> </td>
              I Agree your terms & Condaitions
             </div>
            <div class="right-w3l">
             <input type="submit" class="form-control" value="Register" name="btn-register">
            </div>
         </form>
    </center>
    </body
</html>
<?php
include_once "footer.php";
?>