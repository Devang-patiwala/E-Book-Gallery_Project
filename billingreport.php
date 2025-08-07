<?php
include("header.php");
include("admin_sidebar.php");
if(isset($_GET['delst']))
{
	//bill_id delst
	$sqlupd = "UPDATE billing SET deliv_date='$dt',status='Delivered' WHERE bill_id='$_GET[bill_id]'";
	$qsqlupd = mysqli_query($con,$sqlupd);
	if(mysqli_affected_rows($con) == 1)
	{
		$sqlpurchaseupd ="UPDATE purchase SET purchasestatus='Delivered' where bill_id='$_GET[bill_id]'";
		echo "<script>alert('Product delivered successfully..');</script>";
		echo "<script>window.location='billingreport.php';</script>";
	}
}
?>
        <div id="content" class="float_r">
        	<h1>Billing Report</h1>
        <div class="cleaner"></div>    
  
<table  id="myTable" width="100%" border="1">
  <tr>
    <th width="138" scope="col">Bill No.</th>
    <th width="173" scope="col">Customer Name</th>
    <th width="162" scope="col">Purchase Date</th>
    <th width="177" scope="col">Delivery Date</th>
    <th width="177" scope="col">Card Type</th>
     <th width="177" scope="col">Status</th>
    </tr>
    <?php
	$pursql1="SELECT * from billing ORDER BY bill_id DESC";
	$purres1=mysqli_query($con,$pursql1);
	while($prs1=mysqli_fetch_array($purres1))
	{
		
		$rss12="select * from `customer` where custid='$prs1[custid]'";
		$resrs12=mysqli_query($con,$rss12);
		$rs12=mysqli_fetch_array($resrs12);
		
		
  echo"<tr>
    <td>$prs1[bill_id]</td>
    <td>$rs12[custfname]</td>
    <td>" . date("d-m-Y",strtotime($prs1['purch_date'])) . "</td>
    <td>";
	if($prs1['deliv_date'] == "0000-00-00")
	{
		echo "Pending";
	}
	else
	{
		echo date("d-m-Y",strtotime($prs1['deliv_date']));
	}
	echo "</td>
	<td>";
	if($prs1['cardtype'] == "")
	{
		echo "Cash on Delivery";
	}
	else
	{
		echo $prs1['cardtype'];
	}
	echo "</td>
	<td>";
	if($prs1['status'] == "Delivered")
	{
		echo "Delivered";
	}
	else
	{
		echo "Pending";
		echo "<br><a href='billingreport.php?bill_id=$prs1[0]&delst=Delivered'>Deliver</a>";
	}
	echo "</td>
    </tr>";
	}
	?>
</table>

   
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