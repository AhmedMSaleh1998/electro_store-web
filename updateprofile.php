<?php
 ob_start();
 session_start();
if(isset($_SESSION["id"]))
{
	include_once "headerafter.php";
}else{
	echo("<script> window.open('login.php', '_self')</script>");		 
}
?>
<html>
    <style>
        .error{
            color:red;
        }
    </style>
    <body>
        <?php
              
                    $name = $password = $phone = $email =  "";
                    $nameErr = $passwordErr = $phoneErr = $emailErr  = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){     
                  
                    if(empty($_POST["txtname"])) {
                      $nameErr = "Name is required";
                    } else {
                      $name =$_POST["txtname"];
                      // check if name only contains letters and whitespace
                      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)){
                        $nameErr = "Only letters and white space allowed";
                      }
                    }
                    if(empty($_POST["txtpass"])){
                        $passwordErr = "Password is required";
                      }else{
                        $password =$_POST["txtpass"];
                        // check if name only contains letters and whitespace
                        $passreg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";  
                        if(!preg_match($passreg,$password)) {
                          $passwordErr = "Min 8 char, at least 1 uppercase , 1 lowercase , 1 num and 1 special";
                        }
                      }
                      if(empty($_POST["txtphone"])){
                        $phoneErr = "phone is required";
                      }else{
                        $phone =$_POST["txtphone"];
                        // check if phone numbers are 11 numbers
                        $phonereg = "/^[0-9]{11}$/";
                        if(!preg_match($phonereg,$phone)){
                          $phoneErr = "Phone must be 11 Numbers";
                        }
                      }
                      if(empty($_POST["txtemail"])){
                        $emailErr = "email is required";
                      }else{
                        $email =$_POST["txtemail"];
                        // check if e-mail address is well-formed
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                          $phoneErr = "Invalid email format";
                        }
                      }
                      if(isset($_POST["btn-update"])){
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
                            $ms = $cust->update();  
                            if($ms=="ok")
                            {
                                $dir="customer/";
                                $image=$_FILES['file']['name'];              
                                $temp_name=$_FILES['file']['tmp_name'];
                            
                                //$size = filesize($temp_name);
                                //echo($size);
                                $img=$_SESSION["id"];
                                if($image!="")
                                {
                                    $fdir= $dir.$img.".jpg";
                                    move_uploaded_file($temp_name, $fdir);
                                }
                                echo("<script> window.open('Myprofile.php', '_self')</script>");
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
        <h1 class="alert alert-info text-center">update Page</h1>
        <?php
        include_once "Customer.php";
        $cust=new Customer();
        $rs=$cust->GetByID();
        if($row=mysqli_fetch_assoc($rs))
		{
    ?>
        <center>
        <form method="POST" style="width:500px" enctype="multipart/form-data">
            <div class="form-group text-left">
             <label for="txtname"><span class="error";></span>Username</label>
             <input type="text" class="form-control" name="txtname" value=<?php echo $row["name"]?> placeholder="Only letters and white space allowed"/>
             <span class="error"><?php echo $nameErr; ?></span>
            </div> 
            <div class="form-group text-left">
            <label for="txtpass"><span class="error";></span>password</label>
             <input type="password" class="form-control" name="txtpass" value=<?php echo $row["password"]?> placeholder="Min 8 char, at least 1 uppercase , 1 lowercase , 1 num and 1 special"/>
             <span class="error"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group text-left">
             <label for="txtphone"><span class="error";></span>phone</label>
             <input type="phone" class="form-control" name="txtphone" value=<?php echo $row["phone"]?> placeholder="Phone must be 11 Numbers" />
             <span class="error"><?php echo $phoneErr; ?></span>
            </div>
            <div class="form-group text-left">
             <label for="txtemail"><span class="error";></span>Email</label>
             <input type="text" class="form-control" name="txtemail" value=<?php echo $row["email"]?> placeholder="ahmed@ahmed.com"/>
             <span class="error"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group text-left">
             <label for="country"><span class="error";></span>country</label>
             <input type="text" class="form-control" name="country" value=<?php echo $row["country"]?>>
            </div>
            <div class="form-group text-left">
             <label for="txtemail"><span class="error";></span>state</label>
             <input type="text" class="form-control" name="state" value=<?php echo $row["state"]?>>
            </div>
            <div class="form-group text-left">
             <label for="txtemail"><span class="error";></span>city</label>
             <input type="text" class="form-control" name="city" value=<?php echo $row["city"]?>>
            </div>
            <tr> <td> Upload Image Profile </td>
             <td><input type="file" class="form-control"  name="file"/></td></tr>
            <div class="right-w3l">
             <input type="submit" class="form-control" value="update" name="btn-update">
            </div>
            
         </form>
         <?php } ?>
    </center>
    </body
</html>
<?php
include_once "footer.php";
?>