<?php
if(!isset($_SESSION)){ session_start(); }
include("header.php");
include("sidebar.php");
include("databaseconnection.php");
if(isset($_POST['submit']))
{
$squery="INSERT INTO  notification(custid,book_id,notification_status)VALUES('$_POST[custid]','$_POST[book_id]','$_POST[notifystatus]')";

          if(mysqli_query($con,$squery))
			{
				echo "<script>alert('Notification record inserted successfully..');</script>";
				
			}
			else
			{
				echo mysqli_error($con);
			}
}
?>
    
        <div id="content" class="float_r">
        	<h2>Notifications</h2>
            <h5><strong></strong></h5>
            <div class="content_half float_l checkout">
            <form action="" method="post" name="notification" onsubmit="return validatenotification()">
            
         <table width="531" height="176" border="1">   
              <tr>
              <td>Customer ID </td> 
              <td><select name="custid">
               <option value="">Select</option>
              <?php
			  $nsql="SELECT * FROM customer";
			  $nres=mysqli_query($con,$nsql);
			  while($nqres=mysqli_fetch_array($nres))
			  {
			echo "<option value='$nqres[custid]' >$nqres[custfname]</value>";
					
			  }
			  ?>
              </select></td>
              </tr>
              
              <tr>
              <td>Product ID</td>       
                <td><select name="book_id">
                 <option value="">Select</option>
                 <?php
			  $nsql2="SELECT * FROM books";
			  $nres2=mysqli_query($con,$nsql2);
			  while($nqres2=mysqli_fetch_array($nres2))
			  {
			echo "<option value='$nqres2[book_id]' >$nqres2[book_name]</value>";
					
			  }
			  ?>
              </select></td></tr>
                <tr>
                
              <td>  
              Notification Status :</td>
              
  <td>
              <select name="notifystatus" id="notifystatus">
                <option value="">Select</option>
                <?php
			  $arr1=array("Pending","Sent");
			  foreach($arr1 as $val)
			  {
				  if($val==$res['notifystatus'])
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
              </td></tr>
              
                <th colspan="2" scope="row"><input type="submit" name="submit" id="submit" value="Submit">
              
              
              </table>
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
	function validatenotification()
            
	{
		if(document.notification.custid.value == "")
		{
			alert(" select a customer id..");
			document.notification.custid.focus();
			return false;
		}
		else if(document.notification.book_id.value == "")
		{
			alert(" select a product id..");
			document.notification.book_id.focus();
			return false;
		}
		else if(document.notification.notifystatus.value == "")
		{
			alert("select a notification status..");
			document.notification.notifystatus.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
  </script>