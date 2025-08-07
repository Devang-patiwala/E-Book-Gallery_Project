<?php
include("header.php");
include("sidebar.php");
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
            <div class="content_half float_l checkout">
            <form action="" method="post">
            <table id="myTable" width="100%"  border="1">
                <thead>
                <tr>
                  <th scope="col">Customer ID</th>
                  <th scope="col">Product ID</th>
                  <th scope="col">Notifications</th>
                  
                </tr>             
              </thead>
                <tbody>
                <?php
				$psql = "SELECT * FROM  `notification` ";
				$prsquery = mysqli_query($con,$psql);
				while($prs = mysqli_fetch_array($prsquery))
				{
					
				$msql = "SELECT * FROM  `customer` where custid=$prs[custid] ";
				$mrsquery = mysqli_query($con,$msql);
	            $mprs = mysqli_fetch_array($mrsquery);
				
				$ksql = "SELECT * FROM  `books` where book_id=$prs[book_id] ";
				$krsquery = mysqli_query($con,$ksql);
	            $kprs = mysqli_fetch_array($krsquery);
					
					
					
                echo "<tr>
                  <td>&nbsp;$mprs[custfname]</td>
                  <td>&nbsp;$kprs[book_name]</td>
                  <td>&nbsp;$prs[notification_status]</td>
                  
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
  <script>
    $(document).ready( function () {
      $('#myTable').DataTable();
    } );
  </script>
  