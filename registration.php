<?php
if(!isset($_SESSION)){ session_start(); }	
ob_start();
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");

if(isset($_POST['submit']))
{
	$sql="INSERT INTO customer(custfname,custlname,dob,email,c_password,status)values('$_POST[firstname]','$_POST[lastname]','$_POST[date]','$_POST[email]','$_POST[password]','Active')";
	if(!mysqli_query($con,$sql))
	{
		echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Registration done successfully..');</script>";
	}
			if(isset($_GET['cart']))
			{
				echo "<script>window.location.href = 'login.php?cart=checkout';</script>";
			}
			else
			{
				echo "<script>window.location.href = 'login.php';</script>";
			}	
}
?>
    
        <div id="content" class="float_r">
        <form action="" method="post" name="frmregistration" onsubmit="return validatereg()">
        	<h2>REGISTRATION FORM</h2>
            <h5><strong>Enter the following information to register.</strong></h5>
            
<table width="531" height="176" border="1" class="tftable">
			      <tr>
			        <th height="26" scope="row">First Name :</th>
 <td> <input name="firstname" type="text" id="firstname"  style="width:300px;"  onkeydown='return isAlpha(event.keyCode);'/></td></tr>
				<tr>
			        <th height="26" scope="row">Last Name :</th> 
				 <td>
				  <input name="lastname" type="text" id="lastname"  style="width:300px;"  onkeydown='return isAlpha(event.keyCode);'/></td></tr>
				 <tr>
			        <th height="26" scope="row">Date Of Birth:</th>
				  <td> 
				  <input name="date" type="date" id="date"  style="width:300px;" max="<?php echo date("Y-m-d"); ?>" /></td></tr>
		  <tr>
			        <th height="26" scope="row">Email ID :</th>
				<td><input type="text" name="email" title="email" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" style="width:300px;"/>
             <!--   <input type="email" name="email" pattern="[^ @]*@[^ @]" required style="width:300px;"  />-->
                </td></tr>
                <tr>
			        <th height="26" scope="row">Password:</th>
				<td><input type="password" name="password" style="width:300px;"  /></td></tr>
                <tr>
                <th height="26" scope="row"> Confirm Password:</th>
				<td><input type="password" name="cpassword" style="width:300px;"  /></td></tr>
				  <tr>
			        <th colspan="2" scope="row" align="center"><center><input type="submit" name="submit" id="submit" value="Click here to Register" /></center></th>
		          </tr>
</table>
          </form>
            </div>
            
       
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
          <?php
  include("footer.php");
  ?>
  
  <script type="application/javascript">
	function validatereg()
	{
		if(document.frmregistration.firstname.value == "")
		{
			alert("First Name should not be empty..");
			document.frmregistration.firstname.focus();
			return false;
		}
		else if(document.frmregistration.lastname.value == "")
		{
			alert("Last Name should not be empty..");
			document.frmregistration.lastname.focus();
			return false;
		}
		else if(document.frmregistration.date.value == "")
		{
			alert("Date should not be empty..");
			document.frmregistration.date.focus();
			return false;
		}
	
		else if(document.frmregistration.email.value == "")
		{
			alert("Email ID should not be empty..");
			document.frmregistration.email.focus();
			return false;
		}
		else if(document.frmregistration.password.value == "")
		{
			alert("Password should not be empty..");
			document.frmregistration.password.focus();
			return false;
		}	
		else if(document.frmregistration.password.value.length < 8)
		{
			alert("Password length should be more than 8 characters.");
			document.frmregistration.password.focus();
			return false;
		}
		else if(document.frmregistration.password.value != document.frmregistration.cpassword.value)
		{
			alert("Password not matching..");
			document.registration.cpassword.focus();
			return false;
		}	
		else if(document.frmregistration.status.value == "")
		{
			alert("Sttus should not be empty..");
			document.frmregistration.status.focus();
			return false;
		}	

		else
		{
			return true;
		}
	}
  </script>