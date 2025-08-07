<?php
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");

if(isset($_GET['delid']))
{
	$sql="delete from customer where custid='$_GET[delid]'";
	if(!mysqli_query($con,$sql))
	{
	echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Customer record deleted successfully..');</script>";
	
	}
}
	

?>

    
        <div id="content" class="float_r">
        	<h2>View Customer</h2>
            <h5><strong></strong></h5>
            <div>
            <form action="" method="post">
            <div >
            <table id="myTable" width="100%"  border="1">
                <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">DOB</th>
                  <th scope="col">Address</th>
                  <th scope="col">Contact No</th>
                  <th scope="col">Email ID</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>             
              </thead>
                <tbody>
                <?php
				$sql = "SELECT * FROM  `customer` ";
				$rsquery = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($rsquery))
				{
					 $qaddress="SELECT * FROM address where custid='$rs[custid]'";
				  $qadd1=mysqli_query($con,$qaddress);
				 $qadd2=mysqli_fetch_array($qadd1);
						$sqlstate = "SELECT * FROM  location  WHERE location_id='$qadd2[state]'";
						$qstate = mysqli_query($con,$sqlstate);
						$rsstate = mysqli_fetch_array($qstate);
						$sqlcountry = "SELECT * FROM  location  WHERE location_id='$qadd2[country]'";
						$qcountry = mysqli_query($con,$sqlcountry);
						$rscountry = mysqli_fetch_array($qcountry);
				 
                echo "<tr>
                  <td>&nbsp;$rs[custfname]&nbsp;$rs[custlname]</td>
                  <td>&nbsp;" . date("d-m-Y",strtotime($rs['dob'])) . "</td>
		            <td style='padding-left: 3px;'>$qadd2[address],<br>State - $rsstate[name],<br>Country - $rscountry[name]<bR>PIN-$qadd2[pincode]</td>
					    <td>&nbsp;$qadd2[contactno]</td>
				         <td>&nbsp;$rs[email]</td>
						    <td>&nbsp;$rs[status]</td>
                  <td>&nbsp;
				  <a onclick='return yesno()' href='viewcustomer.php?delid=$rs[custid]'>Delete</a></td>
                </tr>";
				}
				?>
        </tbody>
              </table>
              </div>
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