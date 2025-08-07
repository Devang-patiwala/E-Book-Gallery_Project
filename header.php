<?php
error_reporting(E_ALL & ~E_NOTICE  & ~E_WARNING);
if (!isset($_SESSION)) {
	session_start();
}
$dt = date("Y-m-d");
$logopath = "images/ebookgellary-logo.png";
//$logopath = "images/BookStore.png";
$logowidth = "275px";
$logoheight = "55px";
include("databaseconnection.php");
if (!isset($_SESSION["cartrefresh"])) {
	$sql = "DELETE FROM purchase WHERE cust_id='0' AND purchasestatus='Pending'";
	$qsql = mysqli_query($con, $sql);
	echo mysqli_error($con);
	$_SESSION["cartrefresh"] = "Refresh";
}
//code to update cart details to logged in customer record
if (isset($_SESSION['loginid'])) {
	$sqlupdpurchase = "UPDATE purchase SET cust_id='$_SESSION[cid]' WHERE  cust_id='0' AND purchasestatus='Pending'";
	$qsql = mysqli_query($con, $sqlupdpurchase);
	echo mysqli_error($con);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>E Book Gallery</title>
	<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
	<link rel="icon" type="image" href="images\faviconbook.jpg">
	<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css" />
  
	<script type="text/javascript" src="js/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
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
		.button {
			border-radius: 4px;
			background-color: #f4511e;
			border: none;
			color: #FFFFFF;
			text-align: center;
			font-size: 12px;
			padding: 5px;
			transition: all 0.5s;
			cursor: pointer;
			margin: 5px;
		}

		.button span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}

		.button span:after {
			content: '\00bb';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -20px;
			transition: 0.5s;
		}

		.button:hover span {
			padding-right: 25px;
		}

		.button:hover span:after {
			opacity: 1;
			right: 0;
		}

		input,
		select {
			line-height: 2em;
		}
	</style>
</head>

<body>
	<div id="templatemo_body_wrapper">
		<div id="templatemo_wrapper">

			<div id="templatemo_header" style="background-color:#FFF">


				<div style="color:#F00;">
					<div>
						<a href="index.php"><img src="<?php echo $logopath; ?>" ALIGN="middle" style="width: <?php echo $logowidth; ?>;height:  <?php echo $logoheight; ?>;"></a>
						<span style="float: right;">
							<?php
							if (isset($_SESSION['loginid'])) {
								if ($_SESSION['logintype'] == "Administrator") {
									echo "<b><a href='logout.php'  style='color:#F00'>Logout</a></b>";
								} else if ($_SESSION['logintype'] == "bookseller") {
									echo "<b> <a href='changebooksellerprofile.php'  style='color:#F00'>My Account</a> <a href='logout.php'  style='color:#F00'>Logout</a></b>";
								} else {
									echo "<b><a href='changecustomerprofile.php'  style='color:#F00'>My Account</a> | <a href='logout.php'  style='color:#F00'>Logout</a></b>";
								}
							} else {
								echo "<b><a href='login.php' style='color:#000'>Log In</a></b> | ";
								echo "<b><a href='registration.php' style='color:#000'>Sign Up</a></b> | ";
							}
							?><br>
							Shopping Cart: <strong>
								<?php
								//coding to display number of cart items
								$sqlnocart = "SELECT * FROM purchase WHERE cust_id='" . $_SESSION['cid'] . "' AND purchasestatus='Pending'";
								$qsqlnocart = mysqli_query($con, $sqlnocart);
								$cartcount = mysqli_num_rows($qsqlnocart);
								if ($cartcount == 0) {
									echo 0;
								}
								if ($cartcount == 1) {
									echo $cartcount . " item";
								} else if ($cartcount > 1) {
									echo $cartcount . " items";
								}
								?> </strong>
							( <a href="viewcart.php" style='color:#000'>Show Cart</a> )
						</span>
					</div>
				</div>
			</div> <!-- END of templatemo_header -->

			<div id="templatemo_menubar">
				<div id="top_nav" class="ddsmoothmenu">
					<ul>
						<li><a href="index.php" class="selected">Home</a></li>


						<li><a href="booklist.php">Books</a>

							<ul>
								<?php
								$hsql = "SELECT * from category";
								$hres = mysqli_query($con, $hsql);
								while ($hres1 = mysqli_fetch_array($hres)) {
								?>
									<li><a href="booklist.php?catid=<?php echo $hres1['cat_id']; ?>" class="selected"> <?php echo $hres1['cat_name']; ?></a>
									</li>

								<?php
								}
								?>
							</ul>

						</li>
						<li><a href="about.php">About</a></li>
						<li><a href="faqs.php">FAQs</a></li>
						<li><a href="viewcart.php">Cart</a></li>
						<li><a href="contact.php">Contact Us</a></li>
						<!-- <li><a href="viewauthor.php">authors</a></li> -->
					</ul>
					<br style="clear: left" />
				</div> <!-- end of ddsmoothmenu -->
				<div id="templatemo_search">
					<form action="booklist.php" method="get">
						<input type="text" value="" name="keyword" placeholder="Search Books" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
						<input type="submit"  name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn" />
					</form>
				</div>
			</div> <!-- END of templatemo_menubar -->