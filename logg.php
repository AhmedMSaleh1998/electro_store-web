<?php
include_once "headerBefore.php";
?>
<!-- login -->
<div class="login">
<div class="container">
      <center><br/>
        <h2>login Page</h2></br/>
        <table class="table table-border table-striped" style="width:80%">
         </td></tr>
         <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
				<form method="post">
					<input type="text" name="txtuser" placeholder="Username" required=" " >
					<input type="password" name="txtpass" placeholder="Password" required=" " >
					<div class="forgot">
						<a href="#">Forgot Password?</a>
                    </div>
                    <div style="text-align:center">
                    <input type="checkbox" value="1" name="chkrem"/> Login Me
            </div>
                    <input type="submit" value="Login" name="login">
                    </form>
			</div>
			<h4>For New People</h4>
			<p><a href="register.php">Register Here</a> (Or) go back to <a href="index.php">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
		</div> 
</table>
</center>
</div>

		
			
		
</div>
<?php
include_once "footer.php";
?>