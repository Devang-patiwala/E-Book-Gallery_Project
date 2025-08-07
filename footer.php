    
   <div id="templatemo_footer" >
    	<p><a href="index.php">Home</a> 
		<?php
		if(!isset($_SESSION['loginid']) && !isset($_SESSION['seller_id']))
		{
		?>
		 |  <a href="adminlogin.php">Admin Login</a> | <a href="booksellerlogin.php">Book Seller Login</a>
		<?php
		}
		?>
		</p>

    	<span style="color: white;">©Copyright 2023-24 E Book-Gallery.</span><br><br>
      <a href="https://facebook.com" target="_blank"> Facebook </a>
      <a href="https://twitter.com" target="_blank">  Twitter </a>
	  <a href="https://www.instagram.com" target="_blank">  Instagram </a>
	  <a href="https://www.C.com/" target="_blank"> Youtube </a>
      <!-- Add similar lines for other social media platforms -->
 
    </div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->

</body>
</html>