<?php 
if(!isset($_SESSION)){ session_start(); }
include("databaseconnection.php");
include("header.php");
include("admin_sidebar.php");
if(isset($_GET['cancelid']))
{
	$sql = "UPDATE purchase SET purchasestatus='Cancelled' WHERE purch_id='$_GET[cancelid]'";
	$qsql = mysqli_query($con,$sql);
	echo "<script>alert('This purchase record cancelled successfully...');</script>";
}
?>
        <div id="content" class="float_r">
        	<h1>Digital Books</h1>
        <div class="cleaner"></div>    

 <div >

<?php if(isset($_SESSION['orderPlaced']) && $_SESSION['orderPlaced'] == 'success'){ ?>
<table width="100%" border="1" class="tftable">
  <tr>
    <th width="138" scope="col">Bill No.</th>
    <th width="173" scope="col">Book Name</th>
    <th width="173" scope="col">Language</th>
    <th width="177" scope="col">Download Link</th>
  </tr>
    <?php
	$pursql="SELECT * from purchase LEFT JOIN books ON purchase.book_id=books.book_id where cust_id='$_SESSION[cid]' AND books.book_type='eBook' ORDER BY purchase.purch_id DESC";
	$purres=mysqli_query($con,$pursql);
	while($prs=mysqli_fetch_array($purres))
	{
		$rss1="select * from books where book_id='$prs[book_id]'";
		$resrs1=mysqli_query($con,$rss1);
		$rs1=mysqli_fetch_array($resrs1);
		
		
		$rss3="select * from `customer` where custid='$prs[cust_id]'";
		$resrs3=mysqli_query($con,$rss3);
		$rs3=mysqli_fetch_array($resrs3);
		
		echo "<tr>
				<td>$prs[bill_id]</td>
				<td>$prs[book_name]</td>
				<td>$prs[language]</td>
				<td><a class='button' style='color: white;' download href='digi_book/$prs[digital_book_link]'>Download Digital Book</a></td>
			</tr>";
	}
	?>
</table>
<?php } ?>
</div>
    
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
<?php
include("footer.php");
?>
<script type="application/javascript">
function confirmcancellation(purchaseid)
{
	var r = confirm("Are you sure want to cancel this order??");
	if (r == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>