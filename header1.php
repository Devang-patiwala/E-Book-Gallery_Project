<?php
if(!isset($_SESSION)){ session_start(); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web Mall</title> 
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

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

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1><a href="index.php"></a></h1></div>
        <div id="header_right">
        	<p>
	        <a href="account.php">My Account</a> | <a href="cart.php">My Cart</a>  | 
            <?php
			if(isset($_SESSION['loginid']))
			{
            	echo "<a href='login.php'>Log In</a>";
			}
			else
			{
				echo "<a href='login.php'>Log In</a>";			
			}
			?>
            </p>
            <p>
            	Shopping Cart: <strong>3 items</strong> ( <a href="cart.php">Show Cart</a> )
			</p>
		</div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php" class="selected">Home</a></li>
                <li><a href="booklist.php">books</a>
                <ul>
                <li><a href="index.php" class="selected">Home</a></li>
                <li><a href="booklist.php">books</a>
                
                </li>
                <li><a href="about.php">About</a></li>
                <li><a href="faqs.php">FAQs</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
                </li>
                <li><a href="about.php">About</a></li>
                <li><a href="faqs.php">FAQs</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="" method="get">
              <input type="text" value="" name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div> <!-- END of templatemo_menubar -->