<?php
include_once "headerBefore.php";
?>
<html>
  <head>
<style>
.error{
    color: #FF0000;
    }
</style>
</head>
<body style="font-size="25px;">
    <center>
<!-- register -->
        <h2>Register Page</h2></br/>
        <?php
           if(isset($_POST["btnregister"]))
           {

            $reg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
            if(preg_match($reg,$_POST["txtpass"]))
            {
               include_once "Customer.php";
               $cust=new Customer();
               $cust->setname($_POST["txtname"]);
               $cust->setpassword($_POST["txtpass"]);
               $cust->setphone($_POST["txtphone"]);
               $cust->setemail($_POST["txtemail"]);
               $cust->setcountry($_POST["scountry"]);
               $cust->setcity($_POST["txtcity"]);
               $cust->setgender($_POST["rdgender"]);
               $cust->setstreet($_POST["txtaddress"]);

               $ms=$cust->Add();
               if($ms=="ok")
               {
                   echo("<div class='alert alert-success'> Your Account has been created </div>");
               }
               else if(strpos($ms,"Phone"))
               {
                echo("<div class='alert alert-warning'>This Phone Is Used</div>");
               }
               else if(strpos($ms,"Email"))
               {
                echo("<div class='alert alert-warning'>This Email Is Used</div>");
               }
               else{
                   echo("<div class='alert alert-danger'>$ms</div>");
               }
               }
               else
               {echo("<div class='alert alert-warning'>This Password Is Weak , Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</div>");

               }
           }
       ?>       
            <form method="POST" style="width:450px"></br>
            <div class='alert alert-warning'><span class="error" style="font-size:30px;">*</span> Required Fields </div>
            <div class="form-group text-left">
             <label for="txtname"><span class="error";>*</span>Username</label>
             <input type="text" class="form-control" name="txtname" placeholder="Only letters and white space allowed"/>
             
            </div> 
            <div class="form-group text-left">
            <label for="txtname"><span class="error";>*</span>password</label>
             <input type="password" class="form-control" name="txtpass" placeholder="Min 8 char, at least 1 uppercase , 1 lowercase , 1 num and 1 special "/>
             
            </div>
            <div class="form-group text-left">
             <label for="txtname"><span class="error";>*</span>phone</label>
             <input type="phone" class="form-control" name="txtphone" placeholder="Phone must be 11 Numbers" />
             
            </div>
            <div class="form-group text-left">
             <label for="txtname"><span class="error";>*</span>Email</label>
             <input type="text" class="form-control" name="txtemail" placeholder="email@...... . ......."/>
             
            </div>
            <div class="form-group" name="countries">
             <?php include_once "countries.php";?>
            </div>
            <div class="form-group" >
             <input type="checkbox" name="checkaggree"/> </td>
             <span class="error";>*</span>I Agree your terms & Condaitions
            </div>
            <div class="right-w3l">
             <input type="submit" class="form-control" value="Register" name="btn-register">
            </div>
    </form>
</center>
</body>        
</html>
<?php
include_once "Footer.php";
?>