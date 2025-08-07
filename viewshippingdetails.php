<?php

include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");

if(isset($_GET['delid']))
{
	$sql3="delete from address where address_id='$_GET[delid]'";
	if(!mysqli_query($con,$sql3))
	{
	echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Shipping record deleted successfully..');</script>";
	
	}
}
	
	
?>

    
        <div id="content" class="float_r">
        	<h2>View Shipping Details </h2>
            <h5><strong></strong></h5>
            <div class="content">
            <form action="" method="post">
			<table id="myTable" width="100%"  border="1">
                <thead>
                <tr>
                  <th scope="col">Address</th>
                  <th scope="col">State</th>
                  <th scope="col">Country</th>
                  <th scope="col">Pincode</th>
                  <th scope="col">Contact Number</th>
                  <th scope="col">Actions</th>
                </tr>             
              </thead>
                <tbody>
                <?php
				$shipsql = "SELECT * FROM  `address` where custid='$_SESSION[cid]' ";
				$shipping = mysqli_query($con,$shipsql);
				while($ship = mysqli_fetch_array($shipping))
				{
								$shipsqlstate = "SELECT * FROM  location where location_id='$ship[state]' ";
								$shippingstate = mysqli_query($con,$shipsqlstate);
								$shipstate = mysqli_fetch_array($shippingstate);
								
								$shipsqlcountry = "SELECT * FROM  location where location_id='$ship[country]' ";
								$shippingcountry = mysqli_query($con,$shipsqlcountry);
								$shipcountry = mysqli_fetch_array($shippingcountry);
                echo "<tr>
						  <td>&nbsp;$ship[address]</td>
						  <td>&nbsp;$shipstate[name]</td>
						  <td>&nbsp;$shipcountry[name]</td>
						  <td>&nbsp;$ship[pincode]</td>
						  <td>&nbsp;$ship[contactno]</td>
						  <td>&nbsp;<a  href='addshippingdetails.php?editid=$ship[address_id]'>Edit </a>| 
						  <a onclick='return yesno()' href='viewshippingdetails.php?delid=$ship[address_id]'>Delete</a></td>
                	</tr>";
				}
				?>
				</tbody>
              </table>
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
  function yesno()
  {
	  if(confirm("Are you sure?")==true)
	  {
		  return true;
	  }
	  else
	  {
		  return false;
		  }
  }
  </script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  } );
</script>