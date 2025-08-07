<?php
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");


if(isset($_GET['delid']))
{
	$sql="delete from bookseller where seller_id='$_GET[delid]'";
	if(!mysqli_query($con,$sql))
	{
	echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Book Seller record deleted successfully..');</script>";
	
	}
}
	


?>

    
        <div id="content" class="float_r">
        	<h2>View Book Sellers</h2>
            <h5><strong></strong></h5>
            <div>
            <form action="" method="post">
			<table id="myTable" width="100%"  border="1">
                <thead>
                <tr>
                  <th scope="col">Logo</th>
                  <th scope="col">Seller/Publication Detail</th>
                  <th scope="col">Login ID</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>             
              </thead>
                <tbody>
                <?php
				$sql = "SELECT * FROM  `bookseller` ";
				$rsquery = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($rsquery))
				{
						$sqlstate = "SELECT * FROM  location  WHERE location_id='$rs[state]'";
						$qstate = mysqli_query($con,$sqlstate);
						$rsstate = mysqli_fetch_array($qstate);
						$sqlcountry = "SELECT * FROM  location  WHERE location_id='$rs[country]'";
						$qcountry = mysqli_query($con,$sqlcountry);
						$rscountry = mysqli_fetch_array($qcountry);
					echo "<tr>
							<td>&nbsp;<img src='shopimage/$rs[imgpath]' width='50' height='50'></td>
							<td><b>$rs[compname]</b><br>
							$rs[address],<br>State- $rsstate[name],<br>Country - $rscountry[name]
							<hr>Ph.&nbsp;No.&nbsp;$rs[contact_no]
							</td>
							<td>&nbsp;$rs[login_id]</td>
							<td>&nbsp;$rs[status]</td>
							<td style='text-align: center;'>&nbsp;
								<a href='bookseller.php?editid=$rs[seller_id]'>Edit <br></a>
								<a onclick='return yesno()' href='viewbookseller.php?delid=$rs[seller_id]'> Delete</a>
							</td>
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