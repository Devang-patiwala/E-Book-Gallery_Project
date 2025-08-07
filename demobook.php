<?php
include("header.php");
include("sidebar.php");
$checkcart="SELECT * FROM purchase WHERE book_id='$_GET[book_id]' AND cust_id='$_SESSION[loginid]' AND purchasestatus='Pending'";
$rescart=mysqli_query($con,$checkcart);
$sql="SELECT books.*,book_author.author_name, category.cat_name FROM books LEFT JOIN book_author ON book_author.book_author_id=books.book_author_id LEFT JOIN category ON category.cat_id=books.cat_id where books.book_id='$_GET[book_id]'";
$ressql=mysqli_query($con,$sql);
$res=mysqli_fetch_array($ressql);
$sqlbookseller="SELECT * FROM bookseller where seller_id='$res[seller_id]'";
$ressqlbookseller=mysqli_query($con,$sqlbookseller);
$resbookseller=mysqli_fetch_array($ressqlbookseller);
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
table, td, th {
  border: 1px solid;
  padding: 10px;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
<div id="content" class="float_r">
        	<h1><?php echo ucfirst($res['book_name']); ?></h1>
           
		
            <div class="content_half float_l" style="width: 100%;">
                <table width="100%" class="table table-bordred" >
                 <tr>
                        <th style="text-align: left;" width='100'>Book Name:</th>
                        <td><?php echo $res['book_name']; ?></td>
                  </tr>
					<tr>
                        <th style="text-align: left;">Book Type:</th>
                        <td style="text-align: left;"><?php echo $res['book_type']; ?></th>
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
                </table>
                </table>
			
              <div class="cleaner h20"></div>
			</div>
    </form>           
            <div class="cleaner h30"></div>
			<embed src="demo_book/<?php echo $res['demo_book_link']; ?>" style="width: 100%;" height="600" type="application/pdf">              
          <div class="cleaner h50"></div>
		
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
 <?php
 include("footer.php");
 ?>
<script type="application/javascript">
function validatesubmission()
{
	if(document.form1.qty.value>document.form1.totqty.value)
	{
		alert("Entered quantitiy is larger than available quantity..");
		return false;
	}
	else if(document.form1.qty.value=="")
	{
		alert("Enter quantity..");
		document.form1.qty.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>