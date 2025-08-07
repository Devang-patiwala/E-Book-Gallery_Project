<?php
session_start();

include("header.php");
include("sidebar.php");
$checkcart = "SELECT * FROM purchase WHERE book_id='$_GET[book_id]' AND cust_id='$_SESSION[cid]' AND purchasestatus='Pending'";
$rescart = mysqli_query($con, $checkcart);
$sql = "SELECT books.*,book_author.author_name, category.cat_name FROM books LEFT JOIN book_author ON book_author.book_author_id=books.book_author_id LEFT JOIN category ON category.cat_id=books.cat_id where books.book_id='$_GET[book_id]'";
$ressql = mysqli_query($con, $sql);
$res = mysqli_fetch_array($ressql);
$sqlbookseller = "SELECT * FROM bookseller where seller_id='$res[seller_id]'";
$ressqlbookseller = mysqli_query($con, $sqlbookseller);
$resbookseller = mysqli_fetch_array($ressqlbookseller);
?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
<script type="text/javascript">
	ddsmoothmenu.init({
		mainmenuid: "top_nav", //menu DIV id
		orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
		classname: 'ddsmoothmenu', //class added to menu's outer DIV
		//customtheme: ["#1c5a80", "#18374a"],
		contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	})
</script>
<style>
	table,
	td,
	th {
		border: 1px solid;
		padding: 10px;
	}

	table {
		width: 100%;
		border-collapse: collapse;
	}
</style>
<div id="content" class="float_r">
	<h1><?php echo isset($res) ? ucfirst($res['book_name']) : ''; ?></h1>

	<div class="content_half float_l">
		<form method="get" action="viewcart.php" name="form1" onsubmit="return validatesubmission()">
			<input type="hidden" name="productid" value="<?php echo $_GET['book_id']; ?>" />
			<table width="350" height="301" border="1" class="tftable">
				<tr>
					<td width="231" height="295">&nbsp;
						<?php
						$prodimage =  $res['images'];
						?>
						<img src="bookcoverimage/<?php echo $prodimage; ?>" alt="" width="100%" height="100%" />
						<hr>
						<center><a class="button" style='color: white;' target="_blank" href="demobook.php?book_id=<?php echo $res['book_id']; ?>">View Demo Preview</a></center>
					</td>

				</tr>
			</table>


	</div>

	<div class="content_half float_r" style="width: 350px;">
		<table width="100%" class="table table-bordred">
			<tr>
				<th style="text-align: left;" width='100'>Book Name:</th>
				<td><?php echo $res['book_name']; ?></td>
			</tr>
			<tr>
				<th style="text-align: left;">Book Type:</th>
				<td style="text-align: left;"><?php echo $res['book_type']; ?></th>
			</tr>
			<tr>
				<th style="text-align: left;">Category:</th>
				<td><?php echo $res['cat_name']; ?></td>
			</tr>
			<tr>
				<th style="text-align: left;">Book Seller:</th>
				<td><?php echo $resbookseller['compname']; ?></td>
			</tr>
			<tr>
				<th style="text-align: left;">Author:</th>
				<td><?php echo $res['author_name']; ?></td>
			</tr>
			<tr>
				<th style="text-align: left;">Language:</th>
				<td><?php echo $res['language']; ?></td>
			</tr>
			<?php
			if ($res['book_type'] != "eBook") {
			?>
				<tr>
					<th style="text-align: left;">Stock Status</th>
					<td><?php echo $res['stockstatus']; ?></td>
				</tr>
				<tr>
					<th style="text-align: left;">Delivered In:</th>
					<td><?php echo $res['deliveredin']; ?> days</td>
				</tr>
			<?php
			}
			?>
			<tr>
				<td height="43" colspan="2">
					<input type="hidden" name="price" value="<?php echo $res['price']; ?>" />
					<h3>
						<?php
						if ($res['discount'] == 0) {
							echo  "<HR WIDTH='90%' align='LEFT'>MRP : Rs." . $res['price'] . "<HR WIDTH='90%' align='LEFT'>";
						} else {
							echo  "<HR WIDTH='90%' align='LEFT'>MRP : <strike>Rs." . $res['price'] . "</strike><br /><HR WIDTH='90%' align='LEFT'>";
							echo "Discount : " . $res['discount'] . " %<HR WIDTH='90%' align='LEFT'></p>";
							echo "<font color='green'>Selling Price : Rs.";
							include("functioncalculateprice.php");
							$price = calculateprice($res['price'], $res['discount']);
							echo "$price</font>";
							echo "</p>";
						}

						?>
			</tr>
		</table>
		</table>

		<div class="cleaner h20"></div>
		<?php
		if ($res['stockstatus'] == "Out of Stock") {
			echo "<font color='red'><strong>Out of Stock</strong></font>";
		} else {
		?>
			Quantity :
			<input type="number" name="qty" style="width:50px;" maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
			<input type="submit" name="submit" value="Add to Cart" <?php
																	if (mysqli_num_rows($rescart) >= 1) {
																		echo "disabled";
																	}
																	?> />
			<?php
			if (mysqli_num_rows($rescart) >= 1) {
				echo "<br /><font color='blue'>This product is already added in the cart</font>";
			}
			?>
		<?php
		}
		?>
	</div>
	</form>
	<div class="cleaner h30"></div>

	<h4>Product Description</h4>
	<?php
	echo "<p>" . $res['book_description'] . "</p>";
	?>
	<div class="cleaner h50"></div>

	<div id="content" class="float_r">
		<h3>Related books</h3>
		<?php
		$i = 0;
		$sql1 = "SELECT * FROM books where status='Active' AND cat_id='$res[cat_id]' ORDER BY rand() LIMIT 0,3";
		$qsql1 = mysqli_query($con, $sql1);
		while ($rsq1 = mysqli_fetch_array($qsql1)) {
			if ($i == "2") {
				echo "<div class='product_box  no_margin_right'>";
				echo '<div class="cleaner"></div>';
				$i = 0;
			} else {
				echo "<div class='product_box'>";
				echo '<div class="cleaner"></div>';
			}
		?>

			<h3>
				<a href="productdetail.php?book_id=<?php echo $rsq1['book_id']; ?>" style="height: 30px;"><strong><?php echo ucfirst($rsq1['book_name']); ?></strong></a>
			</h3>
			<a href="productdetail.php?book_id=<?php echo $rsq1['book_id']; ?>"><img src="bookcoverimage/<?php echo $rsq1['images']; ?>" alt="<?php echo $rsq1['book_name']; ?>" width="100%" height="350px;" style="height: 250px;" /></a>
			<p class="product_price">Rs. <?php echo $rsq1['price']; ?></p>
			<a href="shoppingcart.php" class="addtocart"></a>
			<a href="productdetail.php?book_id=<?php echo $rsq1['book_id']; ?>" class="detail"></a>
	</div>
<?php
			$i++;
		}
?>
</div>
</div>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<?php
include("footer.php");
?>
<script type="application/javascript">
	function validatesubmission() {
		if (document.form1.qty.value > document.form1.totqty.value) {
			alert("Entered quantitiy is larger than available quantity..");
			return false;
		} else if (document.form1.qty.value == "") {
			alert("Enter quantity..");
			document.form1.qty.focus();
			return false;
		} else {
			return true;
		}
	}
</script>