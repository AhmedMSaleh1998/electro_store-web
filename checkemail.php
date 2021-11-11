<html>
<?php
ob_start();
session_start();
include_once "headerBefore.php";
?>
</br></br>
<center>
<form method="post" style="width:400px">
    <h1>Check Email Form</h1>
    </br>
        <div class="form-group" >
        <input type="email" class="form-control" placeholder="email" name="txtemail" required=""></br>
        </div>
        <div class="right-w3l">
            <input type="submit" class="form-control" value="check" name="btncheck">
        </div>
        <?php 
          if(isset($_POST["btncheck"])){
              include_once "customer.php";
              $cust = new customer();
              $cust->setemail($_POST["txtemail"]);
              $rs = $cust->GetByEmail();
              if($row=mysqli_fetch_assoc($rs)){
                  $no = rand (1111,9999);
                  $link="http://localhost/web/UpdatePassword.php?id=".$row["customerid"];
                    require_once "src/PHPMailer.php";
                    require_once "src/Exception.php";
                    require_once "src/SMTP.php";
                    require_once "vendor/autoload.php";
                                
                        $mail = new  PHPMailer\PHPMailer\PHPMailer();

                        $mail->IsSMTP();
                        //$mail->SMTPDebug = 1;
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'ssl';
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port = 465; // or 587
                        $mail->IsHTML(true);
                        $mail->Username = "ahmosaleh1998@gmail.com";
                        $mail->Password = "Engineer01026513696";
                        $mail->setFrom('ahmosaleh1998@gmail.com');
                        $mail->addAddress($_POST["txtemail"]);
                        $mail->Subject = 'Forget Password';
                        $mail->Body ="Dear : ".($row["name"])."\n Your Verfication Code is ".$no."\n or you can click here To Update Password "."<a href='$link'>change pass</a>";
                        
                        if(!$mail->send()) {
                            //  echo "Opps! For some technical reasons we couldn't able to sent you an email. We will shortly get back to you with download details.";	
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        }
                        else{
                            $_SESSION["code"]=$no;	
                            $_SESSION["ide"] = $row["customerid"];
                            echo("<script> window.open('confirmcode.php', '_self')</script>");
                        } 
                    }
                    else{
                        echo("<br/><div class='alert alert-danger'> Invaild Email , Try Again </div>");
                    }
              }
          
        ?>
</form>
</center>
<?php
include_once "footer.php";
?>
</html>