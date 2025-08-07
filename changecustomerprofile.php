<?php
include("header.php");
ob_start();
include("admin_sidebar.php");
include("databaseconnection.php");
if(isset($_POST['submit']))
{
	$sql="UPDATE customer SET custfname='$_POST[firstname]',custlname='$_POST[lastname]',dob='$_POST[date]',email='$_POST[email]' WHERE custid='$_SESSION[cid]'";
	if(!mysqli_query($con,$sql))
	{
		echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Profile updated successfully..');</script>";
		echo "<script>window.location='changecustomerprofile.php';</script>";
	}
}
$psql="SELECT * FROM customer WHERE custid='$_SESSION[cid]'";
$psql1=mysqli_query($con,$psql);
$psql2=mysqli_fetch_array($psql1);
?>
    
        <div id="content" class="float_r">
        <form action="" method="post" name="frmregistration" onsubmit="return validatereg()">
        	<h2>Customer Profile</h2>
            <h5><strong> You can change your profile here.</strong></h5>
				<table width="531" height="181" border="1">
                <tr>
                <td>
                First Name :</td>
                  <td><input name="firstname" type="text" id="firstname"  style="width:300px;"  value="<?php echo $psql2['custfname']; ?>" onkeydown='return isAlpha(event.keyCode);'/></td>
                </tr>
               
             <tr><td>Last Name :</td> 
			  <td><input name="lastname" type="text" id="lastname"  style="width:300px;" value="<?php echo $psql2['custlname']; ?>" onkeydown='return isAlpha(event.keyCode);'/></td>
    </tr>
         <tr><td>     Date of birth :</td> 
    <td>   <input name="date" type="date" id="date"  style="width:300px;"  value="<?php echo $psql2['dob'];?>"max="<?php echo date("Y-m-d"); ?>"/></td></tr>
               
               <tr><td> Email :</td><td><input type="email" name="email" style="width:300px;" value="<?php echo $psql2['email']; ?>"required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" /></td>
                     </tr>

                
                <tr>
			        <th colspan="2" scope="row">
                <input name="submit" type="submit" id="submit" /></th></tr>
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
		else if(document.frmregistration.date.value =="")
		{
			alert("Date should not be empty..");
			document.frmregistration.date.focus();
			return false;
		}
		else if(document.frmregistration.date.value =="")
		{
			alert("Select correct date..");
			document.frmregistration.date.focus();
			return false;
		}
		/*else if(document.frmregistration.address.value == "")
		{
			alert("Address should not be empty..");
			document.frmregistration.address.focus();
			return false;
		}
		else if(document.frmregistration.contactno.value == "")
		{
			alert("Contact Number should not be empty..");
			document.frmregistration.contactno.focus();
			return false;
		}
		else if(document.frmregistration.country.value == "")
		{
			alert("Select country..");
			document.frmregistration.country.focus();
			return false;
		}
		else if(document.frmregistration.state.value == "")
		{
			alert("Select State..");
			document.frmregistration.state.focus();
			return false;
		}*/
		else if(document.frmregistration.email.value == "")
		{
			alert("Email ID should not be empty..");
			document.frmregistration.email.focus();
			return false;
		}
		/*else if(document.frmregistration.password.value == "")
		{
			alert("Enter password..");
			document.frmregistration.password.focus();
			return false;
		}
		else if(document.frmregistration.cpassword.value == "")
		{
			alert("Confirm your password..");
			document.frmregistration.cpassword.focus();
			return false;
		}*/
		else
		{
			return true;
		}
	}
  </script>
  <script type = "text/javascript">
    function isNumeric(keyCode)
    {
        return ((keyCode >= 48 && keyCode <= 57) || keyCode == 8 || keyCode == 9 || keyCode == 46 || keyCode == 37 || keyCode == 39 ||
                (keyCode >= 96 && keyCode <= 105))
    }
	
    function isAlpha(keyCode)
    {
        return ((keyCode >= 65 && keyCode <= 90) || keyCode == 8 || keyCode == 9 || keyCode == 46 || keyCode == 37 || keyCode == 39 )
    }
	</script>