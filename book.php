<?php
if (!isset($_SESSION)) {
	session_start();
}
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");
$dt = date("Y-m-d");
if (isset($_POST['submit'])) {
	//################################
	// $prodspecification = mysqli_real_escape_string($con, $_POST['pspecification']);
	if (isset($_POST['pspecification'])) {
		$prodspecification = mysqli_real_escape_string($con, $_POST['pspecification']);
		// Rest of your code using $prodspecification
	} else {
		// Handle the case where 'pspecification' is not set in $_POST
		// You might want to set a default value or show an error message
	}
	
	$bookname = mysqli_real_escape_string($con, $_POST['bookname']);
	$prodspecification = mysqli_real_escape_string($con, $_POST['editor1']);
	//################################
	$filename = rand() . $_FILES['browse']['name'];
	move_uploaded_file($_FILES['browse']['tmp_name'], "bookcoverimage/" . $filename);
	//################################
	$digital_book_link = rand() . $_FILES['digital_book_link']['name'];
	move_uploaded_file($_FILES['digital_book_link']['tmp_name'], "digi_book/" . $digital_book_link);
	//################################
	$demo_book_link = rand() . $_FILES['demo_book_link']['name'];
	move_uploaded_file($_FILES['demo_book_link']['tmp_name'], "demo_book/" . $demo_book_link);
	//################################
	if (isset($_GET['editid'])) {
		$sql = "UPDATE books SET cat_id='$_POST[category]',seller_id='$_POST[supplier]',book_author_id='$_POST[book_author_id]', book_type='$_POST[book_type]',book_name='$bookname', language='$_POST[language]',price='$_POST[price]',discount='$_POST[discount]',stockstatus='$_POST[stockstatus]',deliveredin='$_POST[delivery]',book_description='$prodspecification', number_of_pages='$_POST[number_of_pages]'";
		if ($_FILES['browse']['name'] != "") {
			$sql = $sql . ",images='$filename'";
		}
		if ($_FILES['digital_book_link']['name'] != "") {
			$sql = $sql . ",digital_book_link='$digital_book_link'";
		}
		if ($_FILES['demo_book_link']['name'] != "") {
			$sql = $sql . ",demo_book_link='$demo_book_link'";
		}
		$sql = $sql . ",status='$_POST[status]' WHERE book_id='$_GET[editid]'";
		mysqli_query($con, $sql);
		echo mysqli_error($con);
		echo "<script>alert('Record updated successfully....')</script>";
		echo "<script>window.location='viewbooks.php';</script>";
	} else {
		$sql = "insert into books(`cat_id`, `seller_id`, `book_author_id`, `book_type`, `book_name`, `language`, `price`, `discount`, `stockstatus`, `deliveredin`, `book_description`, `images`, `digital_book_link`, `demo_book_link`, `number_of_pages`, `status`)values('$_POST[category]','$_POST[supplier]','$_POST[book_author_id]','$_POST[book_type]','$bookname','$_POST[language]','$_POST[price]','$_POST[discount]','$_POST[stockstatus]','$_POST[delivery]','$prodspecification','$filename','$digital_book_link','$demo_book_link','$_POST[number_of_pages]','$_POST[status]')";
		$qsql = mysqli_query($con, $sql);
		echo mysqli_error($con);
		echo "<script>alert('New product record inserted successfully..');</script>";
		//echo "<script>window.location='book.php';</script>";
	}
}
if (isset($_GET['editid'])) {
	$sql = "select * from books WHERE book_id='$_GET[editid]'";
	$qsql = mysqli_query($con, $sql);
	echo mysqli_error($con);
	$resview = mysqli_fetch_array($qsql);
}
?>
<div id="content" class="float_r">
	<?php
	$ccustomer = "SELECT * FROM customer WHERE custid='$_SESSION[cid]'";
	$qcustomer = mysqli_query($con, $ccustomer);
	$rscustomer = mysqli_fetch_array($qcustomer);

	$sbilling = "SELECT * FROM billing WHERE bill_id='$_GET[billid]'";
	$qsbilling = mysqli_query($con, $sbilling);
	$rsbilling = mysqli_fetch_array($qsbilling);
	?>
	<h1>Books - Add/Edit Books Detail</h1>
	<div id="txtcart">
		<div id="billingreport">
			<form action="" method="post" enctype="multipart/form-data" name="frmproduct" onsubmit="return validateproduct()">
				<p>Book Name :<br />
					<input name="bookname" type="text" id="bookname" style="width:300px;" value="<?php echo $resview['book_name']; ?>" />
					<br />
				</p>

				<p>Book Cover Image : &nbsp;&nbsp;&nbsp;&nbsp;<br />
					<input type="file" accept="image/*" name="browse" id="browse" style="width:300px;height:30px;" />
					&nbsp;
				</p>
				<p>

				<p>
					<br />
					Book Category :<br />
					<select name="category" id="category" style="width:300px;height:30px;" onchange="changecategory(this.value)">
						<option value="">Select</option>
						<?php
						$sql1 = "SELECT * FROM  category";
						$res1 = mysqli_query($con, $sql1);
						while ($rs1 = mysqli_fetch_array($res1)) {
							if ($rs1['cat_id'] == $resview['cat_id']) {
								echo "<option value='" . $rs1['cat_id'] . "' selected>$rs1[cat_name]</value>";
							} else {
								echo "<option value='$rs1[cat_id]'>" . $rs1['cat_name'] . "</value>";
							}
						}
						?>
					</select>
				</p>
				<?php
				if (isset($_SESSION['seller_id'])) {
				?>
					<input type="hidden" name="supplier" value="<?php echo $_SESSION['seller_id']; ?>" style="width:300px;height:30px;" />
				<?php
				} else {
				?>
					<p>Book Seller :<br />
						<select name="supplier" id="supplier" style="width:300px;height:30px;">
							<option value="">Unknown</option>
							<?php
							$sql3 = "SELECT * FROM  bookseller ";
							$res3 = mysqli_query($con, $sql3);
							while ($rs3 = mysqli_fetch_array($res3)) {
								if ($rs3['seller_id'] == $resview['seller_id']) {
									echo "<option value='$rs3[seller_id]'selected>$rs3[compname]</value>";
								} else {
									echo "<option value='$rs3[seller_id]'>$rs3[compname]</value>";
								}
							}
							?>
						</select>
					<?php
				}
					?>
					</p>


					<p>Book Author :<br />
						<select name="book_author_id" id="book_author_id" style="width:300px;height:30px;">
							<option value="">Select Book Author</option>
							<?php
							$sql3 = "SELECT * FROM  book_author WHERE author_status='Active' ";
							$res3 = mysqli_query($con, $sql3);
							while ($rs3 = mysqli_fetch_array($res3)) {
								if ($rs3['book_author_id'] == $resview['book_author_id']) {
									echo "<option value='$rs3[book_author_id]'selected>$rs3[author_name]</value>";
								} else {
									echo "<option value='$rs3[book_author_id]'>$rs3[author_name]</value>";
								}
							}
							?>
						</select>
					</p>


					<p>Book Language :<br />
						<input name="language" type="text" id="language" style="width:300px;" value="<?php echo $resview['language']; ?>" />
					</p>


					<p>Book Demo Copy: (Kindly upload PDF demo copy)<br />
						<input type="file" accept="application/pdf" name="demo_book_link" id="demo_book_link" style="width:300px;height:30px;" />
					</p>


					<p>
						Price :<br />

						<input name="price" type="number" id="price" style="width:300px;" value="<?php echo $resview['price']; ?>" />
					</p>
					Discount : (in Percentage %)<br />
					<input type="text" name="discount" style="width:300px;" id="discount" value="<?php echo $resview['discount']; ?>" onkeydown='return isNumeric(event.keyCode);' /><br /><br />

					<p>Number of Pages :<br />
						<input name="number_of_pages" type="number" id="number_of_pages" style="width:300px;" value="<?php echo $resview['number_of_pages']; ?>" />
						<br />
					</p>

					<p>Product Specification :<br />
						<?php
						include("ckeditor.php");
						?>
					</p>


					<p>Book Type :<br />
						<select name="book_type" id="book_type" style="width:300px;height:30px;" onchange="load_book_type(this.value)">
							<option value="">Select</option>
							<?php
							$arr1 = array("eBook", "Hardcover", "Paperback");
							foreach ($arr1 as $val) {
								if ($val == $resview['book_type']) {
									echo "<option value='$val' selected>$val</option>";
								} else {
									echo "<option value='$val'>$val</option>";
								}
							}
							?>
						</select>
					</p>


					<p id="divdigital_book_link" style="display: none;">Book Digital Download Link:<br />
						<input type="file" name="digital_book_link" id="digital_book_link" style="width:300px;height:30px;" />
					</p>


					<p id="divdelivery" style="display: none;">Delivered in (No. of days) :<br />
						<input type="text" name="delivery" id="delivery" value="<?php echo $resview['deliveredin']; ?>" style="width:300px;height:30px;" />
					</p>

					<p id="divstockstatus" style="display: none;">Stock Status :<br />
						<select name="stockstatus" id="stockstatus" style="width:300px;height:30px;">
							<option value="">Select</option>
							<?php
							$arr = array("Available", "Out of Stock");
							foreach ($arr as $val) {
								if ($val == $resview['stockstatus']) {
									echo "<option value='$val' selected>$val</option>";
								} else {
									echo "<option value='$val'>$val</option>";
								}
							}
							?>
						</select>
					</p>

					<p>Status :<br />
						<select name="status" id="status" style="width:300px;height:30px;">
							<?php
							$arr1 = array("Select", "Active", "Inactive");
							foreach ($arr1 as $val) {
								if ($val == $resview['status']) {

									echo "<option value='$val' selected>$val</option>";
								} else {
									echo "<option value='$val'>$val</option>";
								}
							}
							?>
						</select>
					</p>

					<p>
						<hr>
						<input type="submit" name="submit" id="submit" value="Submit" />
					</p>
			</form>
		</div>
	</div>
	<h1>
	</h1>
	</form>
</div>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<?php
include("footer.php");
?>
<script>
	//book_type divdigital_book_link divdelivery divstockstatus
	function load_book_type() {
		if ($('#book_type').val() == "eBook") {
			$('#divdigital_book_link').show();
			$('#divdelivery').hide();
			$('#divstockstatus').hide();
		} else if ($('#book_type').val() == "Hardcover" || $('#book_type').val() == "Paperback") {
			$('#divdigital_book_link').hide();
			$('#divdelivery').show();
			$('#divstockstatus').show();
		}
	}
</script>
<script type="application/javascript">
	function validateproduct() {
		if (document.frmproduct.bookname.value == "") {
			alert("Book Name should not blank");
			document.frmproduct.bookname.focus();
			return false;
		} else if (document.frmproduct.category.value == "") {
			alert("Please select Category.");
			document.frmproduct.category.focus();
			return false;
		} else if (document.frmproduct.subcat.value == "") {
			alert("Please select  Sub Category.");
			document.frmproduct.subcat.focus();
			return false;
		} else if (document.frmproduct.supplier.value == "") {
			alert("Select Book Seller from the list.");
			document.frmproduct.supplier.focus();
			return false;
		} else if (document.frmproduct.quantity.value == "") {
			alert("Select number of quantity.");
			document.frmproduct.quantity.focus();
			return false;
		} else if (document.frmproduct.price.value == "") {
			alert("Price should not be blank.");
			document.frmproduct.price.focus();
			return false;
		} else if (document.frmproduct.discount.value == "") {
			alert("Enter discount amount..");
			document.frmproduct.discount.focus();
			return false;
		} else if (document.frmproduct.warranty.value == "") {
			alert("Enter warranty ..");
			document.frmproduct.warranty.focus();
			return false;
		} else if (document.frmproduct.stockstatus.value == "") {
			alert("Select stock status.");
			document.frmproduct.stockstatus.focus();
			return false;
		} else if (document.frmproduct.delivery.value == "") {
			alert("Enter delivery days..");
			document.frmproduct.delivery.focus();
			return false;
		} else if (document.frmproduct.pspecification.value == "") {
			alert("Product specification should not be blank.");
			document.frmproduct.pspecification.focus();
			return false;
		} else if (document.frmproduct.browse.value == "") {
			alert("Select images for the product.");
			document.frmproduct.browse.focus();
			return false;
		} else if (document.frmproduct.status.value == "") {
			alert("Select status.");
			document.frmproduct.status.focus();
			return false;
		} else {
			return true;
		}
	}

	function changecategory(categoryid) {
		if (categoryid == "") {
			document.getElementById("changesubcategory").innerHTML = "";
			return;
		} else {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("changesubcategory").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "ajaxchangesubcategory.php?categoryid=" + categoryid, true);
			xmlhttp.send();
		}
	}
</script>
<script type="text/javascript">
	function isNumeric(keyCode) {
		return ((keyCode >= 48 && keyCode <= 57) || keyCode == 8 || keyCode == 9 || keyCode == 46 || keyCode == 37 || keyCode == 39 ||
			(keyCode >= 96 && keyCode <= 105))
	}

	function isAlpha(keyCode) {
		return ((keyCode >= 65 && keyCode <= 90) || keyCode == 8 || keyCode == 9 || keyCode == 46 || keyCode == 37 || keyCode == 39)
	}
</script>