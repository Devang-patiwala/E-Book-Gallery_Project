<?php 
if(!isset($_SESSION)){ session_start(); }
include("databaseconnection.php");
include("header.php");
include("admin_sidebar.php");
?>
        <div id="content" class="float_r">
        	<h1>Billing Report</h1>
        <div class="cleaner"></div>    

 <blockquote>
<table width="658" border="1"  class="tftable">
  <tr>
    <th width="138" scope="col">Bill No.</th>
    <th width="173" scope="col">Customer Name</th>
    <th width="162" scope="col">Purchase Date</th>
    <th width="177" scope="col">Delivery Date</th>
    <th width="177" scope="col">Payment Type</th>
     <th width="177" scope="col">Delivery Status</th>
    <th width="177" scope="col">Receipt</th>
    </tr>
    <?php
	$pursql1="SELECT * from billing where custid='$_SESSION[cid]' ORDER BY bill_id DESC";
	$purres1=mysqli_query($con,$pursql1);
	while($prs1=mysqli_fetch_array($purres1))
	{
		
		$rss11="select * from `customer` where custid='$_SESSION[cid]'";
		$resrs11=mysqli_query($con,$rss11);
		$rs11=mysqli_fetch_array($resrs11);

		
  echo"<tr>
    <td>$prs1[bill_id]</td>
    <td>$rs11[custfname]</td>
    <td>" . date("d-m-Y",strtotime($prs1['purch_date'])) . "</td>
    <td>";
	if($prs1['deliv_date'] == "0000-00-00")
	{
	echo "Pending Delivery";
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
	}
	echo "</td>
	<td><a href='orderbilling.php?billid=". $prs1[0] ."' target='_blank'>Receipt</a></td>
    </tr>";
	}
	?>
</table>
</blockquote>

</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
<?php
include("footer.php");
?>