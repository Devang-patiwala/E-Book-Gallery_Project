<?php
if(!isset($_SESSION)){ session_start(); }
if(!isset($_SESSION['loginid']))
{
	header("Location: booksellerlogin.php");
}
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");
$dt=date("Y-m-d");
if(isset($_POST['submit']))
{
	$filename = rand().$_FILES['browse']['name'];
	move_uploaded_file($_FILES['browse']['tmp_name'],"shopimage/".$filename);
	
	if(isset($_GET['editid']))
	{
			$sql="UPDATE bookseller SET compname='$_POST[compname]',address='$_POST[address]',state='$_POST[state]',country='$_POST[country]',contact_no='$_POST[contactno]',login_id='$_POST[loginid]',s_password='$_POST[password]'";
		if($_FILES['browse']['name']!=="")
		{
			$sql=$sql.",imgpath='$filename'";
		}
		
		$sql=$sql.",status='$_POST[status]' WHERE seller_id='$_GET[editid]'";
		mysqli_query($con,$sql);
		echo"<script>alert('Record updated successfully...')</script>";
		echo "<script>window.location='viewbookseller.php';</script>";		
	}
	else
	{
			$query=mysqli_query($con,"insert into bookseller(compname,address,state,country,contact_no,login_id,s_password,created_at,imgpath,status)VALUES('$_POST[compname]','$_POST[address]','$_POST[state]','$_POST[countryi]','$_POST[contactno]','$_POST[loginid]','$_POST[password]','$dt','$filename','$_POST[status]')");
			if(!$query)
			{
				echo mysqli_error($con);
			
				}
				else
				{
					echo "<script>alert('Book Seller/Seller Record  inserted successfully..');</script>";
					echo "<script>window.location='bookseller.php';</script>";
				}
			}
			$subject = "bookseller login credentials";
			$message = "Login Credentials of $_POST[compname],<br /><br />
						Login ID: $_POST[loginid]<br />
						Password: $_POST[password]
						";			
			//sendmail($toaddress,$subject,$message);
	}

if(isset($_GET['editid']))
{
	$sql="SELECT * FROM bookseller WHERE seller_id='$_GET[editid]'";
	$qsql=mysqli_query($con,$sql);
	$res=mysqli_fetch_array($qsql);	
}
?>
    
        <div id="content" class="float_r">
        	<h2>Book Seller / Publications</h2>
            <h5><strong></strong></h5>
            <div class="content_half float_l checkout">
            <form action="" method="post" name="frmbookseller" onsubmit="return validateadmin()" enctype="multipart/form-data">
            
              <p>Company Name :
                <input name="compname" type="text" id="compname"  style="width:300px;" value="<?php echo $res['compname'];?>"  />
              </p>
              <p>Address :
                <label for="address"></label>
                <textarea name="address" id="address" style="width:300px;" cols="45" rows="5"><?php echo $res['address'];?> </textarea>
                <br />
                <br />
                </p>
                Country:<br />
                <select name="countryi" id="countryi" onchange="ajax_call(this.value)" style="width:300px;">
                <option value="">Select Country</option>
                <?php
				// Lets select all countries from our table...
				$sqlAllCountries = "SELECT * FROM location WHERE location_type =0";
				$sqlAllCountriesResult = mysqli_query($con,$sqlAllCountries);
                while ($row =  mysqli_fetch_array($sqlAllCountriesResult))
				{
                    echo "<option value='$row[location_id]'>$row[name]</option>";
                }
                ?>
            </select>            
              <?php
             // include("countrystatelist.php")
              ?>
			  </p>
              <p>
              State: <br />
              <label id='loadajaxstate'><?php include("ajaxstate.php"); ?></label>
              </p>
              <p>
                Contact No:
            <input name="contactno" type="text" id="contactno" style="width:300px;" value="<?php echo $res['contact_no'];?>" onkeydown='return isNumeric(event.keyCode);'/>
              </p>
              <p>Login Id:
                <label for="loginid"></label>
                <input type="text" name="loginid" id="loginid"style="width:300px;" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" value="<?php echo $res['login_id'];?>"/>
              </p>
              <p>Password :
                <label for="password"></label>
                <input type="password" name="password" id="password"style="width:300px;" value="<?php echo $res['s_password'];?>"/>
              </p><p>Confirm Password :
      <input type="password" name="cpassword" id="cpassword"style="width:300px;" value="<?php echo $res['s_password'];?>"/>
              </p>
              <p>Image :<br /><input type="file" name="browse" id="browse" /></p>
              
              <p> Status :
                <label for="status"></label>
                <select name="status" id="status" style="width:300px;">
                  <option value="">Select</option>
              <?php
			  $arr1=array("Active","Inactive");
			  foreach($arr1 as $val)
			  {
				  if($val==$res['status'])
		          {
					  
					  echo "<option value='$val' selected>$val</option>";		  
				  }
			  else
			  {
				    echo "<option value='$val'>$val</option>";		  
				  }
			  }
			  ?>
                </select>
              </p>
              <p>
                <input type="submit" name="submit" id="submit" value="Submit">
              </p>
              <p>&nbsp;</p>
              </form>
            </div>
            
            
          <div class="content_half float_r checkout"><br />
                <br />
          </div>
           
            
          <div class="cleaner h50"></div>
            <h3>&nbsp;</h3>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
  <?php
  include("footer.php");
  ?>
  <script type="application/javascript">
	function validateadmin()
	{
		if(document.frmbookseller.compname.value == "")
		{
			alert("Company Name should not be empty..");
			document.frmbookseller.compname.focus();
			return false;
		}
		else if(document.frmbookseller.address.value == "")
		{
			alert("Address should not be empty..");
			document.frmbookseller.address.focus();
			return false;
		}
		else if(document.frmbookseller.country.value ="")
		{
			alert(" Select Country....");
			document.frmbookseller.country.focus();
			return false;
		}	
		else if(document.frmbookseller.state.value="")
		{
			alert("Select State ..");
			document.frmbookseller.state.focus();
			return false;
		}	
		else if(document.frmbookseller.contactno.value == "")
		{
			alert("contactno should not be empty..");
			document.frmbookseller.contactno.focus();
			return false;
		}	
		else if(document.frmbookseller.contactno.value.length<10)
		{
			alert("Enter 10 digit contact number..");
			document.frmbookseller.contactno.focus();
			return false;
		}	
		/*else if(document.frmbookseller.loginid.value.length < 8)
		{
			alert("Loginid should be more than 8 characters.");
			document.frmbookseller.loginid.focus();
			return false;
		}*/
		else if(document.frmbookseller.password.value.length < 8)
		{
			alert("Password should be more than 8 characters.");
			document.frmbookseller.password.focus();
			return false;
		}
		else if(document.frmbookseller.password.value != document.frmadmin.cpassword.value)
		{
			alert("Password not matching..");
			document.frmbookseller.password.focus();
			return false;
		}	
		
		else if(document.frmbookseller.browse.value == "")
		{
			alert("Select Image for the product...");
			document.frmbookseller.browse.focus();
			return false;
		}
		else if(document.frmbookseller.status.value="")
		{
			alert("select status..");
			document.frmbookseller.status.focus();
			return false;
		}								
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

function ajax_call(country) {
    if (country == "")
	{
        document.getElementById("loadajaxstate").innerHTML = "<select name='state' id='state'></select>";
        return;
    } 
	else 
	{ 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("loadajaxstate").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","ajaxstate.php?country="+country,true);
        xmlhttp.send();
    }
}
</script>
<?php
function sendmail($toaddress,$subject,$message)
{
	require 'PHPMailer-master/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.dentaldiary.in';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'sendmail@dentaldiary.in';                 // SMTP username
	$mail->Password = 'q1w2e3r4/';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to
	
	$mail->From = 'sendmail@dentaldiary.in';
	$mail->FromName = 'Web Mall';
	$mail->addAddress($toaddress, 'Joe User');     // Add a recipient
	$mail->addAddress($toaddress);               // Name is optional
	$mail->addReplyTo('aravinda@technopulse.in', 'Information');
	$mail->addCC('cc@example.com');
	$mail->addBCC('bcc@example.com');
	
	$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = $subject;
	$mail->Body    = $message;
	$mail->AltBody = $subject;
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo '<center><strong><font color=green>Login credentails sent to your Email ID.</font></strong></center>';
	}
}
?>