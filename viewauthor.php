<?php
include("header.php");
include("admin_sidebar.php");
if(isset($_GET['delid']))
{
	$sql="delete from book_author where book_author_id='$_GET[delid]'";
	if(!mysqli_query($con,$sql))
	{
	echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Author record deleted successfully..');</script>";
	}
}
?>
        <div id="content" class="float_r">
        	<h2>View Author </h2>
            <h5><strong></strong></h5>
            <div >
            <form action="" method="post">
            
              <table id="myTable" width="100%"  border="1">
                <thead>
                  <tr>
                    <th scope="col">Author image</th>
                    <th scope="col">Author Name</th>
                    <th scope="col">About Author</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql = "SELECT * FROM book_author";
                  $rsquery = mysqli_query($con,$sql);
                  while($rs = mysqli_fetch_array($rsquery))
                  {
                    if($rs['author_img'] == "")
                    {
                      $imgauthor = "images/default_image.jpg";
                    }
                    else if(file_exists("authorimage/" . $rs['author_img']))
                    {
                      $imgauthor = "authorimage/" . $rs['author_img'];
                    }
                    else
                    {
                      $imgauthor = "images/default_image.jpg";								
                    }
                    echo "<tr>
                      <td>&nbsp;<img src='$imgauthor' style='height: 90px; width: 75px;'> </td>
                      <td>&nbsp;$rs[author_name]</td>
                      <td>&nbsp;$rs[about_author]</td>
                      <td>&nbsp;$rs[author_status]</td>
                      <td>&nbsp;
                          <a  href='author.php?editid=$rs[book_author_id]'>Edit </a>| 
                          <a onclick='return yesno()' href='viewauthor.php?delid=$rs[book_author_id]'>Delete</a></td>
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