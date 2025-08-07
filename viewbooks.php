<?php
include("header.php");
include("admin_sidebar.php");
if(isset($_GET['delid']))
{
	$sql="delete from books where book_id='$_GET[delid]'";
	if(!mysqli_query($con,$sql))
	{
		echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Product record deleted successfully..');</script>";
	
	}
}
?>
        <div id="content" class="float_r">
        	<h2>View books</h2>
            <h5><strong></strong></h5>
            <div class="content_half float_l checkout">
            <form action="" method="post">
              <div style='overflow:auto; width:700px;height:500px;'>              
			  <table id="myTable" width="100%"  border="1">
                <thead>
                  <tr>                   
                    <th scope="col">Image</th>
                    <th scope="col">Product  Name</th>
                    <th scope="col">Book Type</th>
                    <th scope="col">Author</th>
                    <th scope="col">Total sales</th>
                    <th scope="col">Category</th>
                    <th scope="col">Book Seller</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock Status</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>             
              </thead>
                <tbody>
                  <?php
						$sql = "SELECT books.*,book_author.author_name FROM  books LEFT JOIN book_author ON book_author.book_author_id=books.book_author_id WHERE 0=0 ";						
						if($_SESSION['logintype'] == "bookseller")
						{
						$sql = $sql ." AND seller_id='$_SESSION[seller_id]'";
						}
				$rsquery = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($rsquery))
				{
					//############################
					$sql1purchase = "SELECT ifnull(count(qty),0) FROM  purchase WHERE book_id='$rs[book_id]'  ";
					$rsquery1purchase = mysqli_query($con,$sql1purchase);
					$rs1purchase = mysqli_fetch_array($rsquery1purchase);
					//############################
					$sql1 = "SELECT * FROM  category WHERE cat_id='$rs[cat_id]'  ";
					$rsquery1 = mysqli_query($con,$sql1);
					$rs1 = mysqli_fetch_array($rsquery1);
					//############################
					$sql3 = "SELECT * FROM  bookseller WHERE seller_id='$rs[seller_id]'  ";
					$rsquery3 = mysqli_query($con,$sql3);
					$rs3 = mysqli_fetch_array($rsquery3);
					//############################
                echo "<tr>
				<td>&nbsp;<img src='bookcoverimage/$rs[images]' width='50' height='50' ></td>	
				   	<td>$rs[book_name]</td>	
				   	<td>$rs[book_type]</td>	
				   	<td>$rs[author_name]</td>	
                  <td>&nbsp;$rs1purchase[0]</td>
                  <td>$rs1[cat_name]</td>
                  <td>&nbsp;$rs3[compname]</td>
					  <td>&nbsp;Rs.$rs[price]<br>
					  ($rs[discount]%&nbsp;discount)
					  </td>";
				if($rs['book_type'] == 'eBook')
				{
					echo "<td>N/A</td>";
				}
				else
				{
					echo "<td>$rs[stockstatus] (Delivery: $rs[deliveredin])</td>";
				}

				echo "<td>$rs[status]</td>
                  <td>&nbsp;
				  <a href='book.php?editid=$rs[book_id]'>Edit</a>
				  <br>
				  &nbsp;&nbsp;<a onclick='return yesno()' href='viewbooks.php?delid=$rs[book_id]'>Delete</a>
				  </td>
                </tr>";
				}
				?>
				</tbody>
                </table>
              </div>
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