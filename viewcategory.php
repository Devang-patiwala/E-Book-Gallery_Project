<?php
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");

if(isset($_GET['delid']))
{
	$sql="delete from category where cat_id='$_GET[delid]'";
	if(!mysqli_query($con,$sql))
	{
	echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Category record deleted successfully..');</script>";
	
	}
}
?>

    
        <div id="content" class="float_r">
        	<h2>View Category </h2>
            <h5><strong></strong></h5>
            <div >
            <form action="" method="post">
            
              <table id="myTable" width="100%"  border="1">
                <thead>
                  <tr>
                    <th scope="col">Category Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql = "SELECT * FROM category";
                  $rsquery = mysqli_query($con,$sql);
                  while($rs = mysqli_fetch_array($rsquery))
                  {
                    echo "<tr>
                      <td>&nbsp;$rs[cat_name]</td>
                      <td>&nbsp;$rs[cat_des]</td>
                      <td>&nbsp;
                          <a  href='category.php?editid=$rs[cat_id]'>Edit </a>| 
                          <a onclick='return yesno()' href='viewcategory.php?delid=$rs[cat_id]'>Delete</a></td>
                      </tr>";
                  }
                ?>
              </tbody>
              </table>
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