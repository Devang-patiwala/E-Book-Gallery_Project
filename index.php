<?php
if (!isset($_SESSION)) {
    session_start();
}
include("header.php");
include("sidebar.php");
include("databaseconnection.php");
?>
<div id="content" class="float_r">
    <div id="slider-wrapper">
        <div id="slider" class="nivoSlider">
            <img src="images/slider/slider3.jpg" alt="" />
            <img src="images/slider/slider2.jpg" alt="" title="Online Book Store" />
            <img src="images/slider/reason-to-prefer-online-shopping.jpg" alt="" />
            <img src="images/slider/online-shopping-tablet.jpg" alt="" title="#htmlcaption" />
            <img src="images/slider/slider1.jpg" alt="" />
        </div>
        <div id="htmlcaption" class="nivo-html-caption">
            <strong>E Book Gallery</strong>.
        </div>
    </div>
    <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider();
        });
    </script>
    <?php
    $i = 0;
    $sql = "SELECT * FROM books where discount > 0 AND status='Active' ORDER BY RAND() LIMIT 12";
    $qsql = mysqli_query($con, $sql);
    while ($rsq = mysqli_fetch_array($qsql)) {
        if ($i == "2") {
            echo "<div class='product_box  no_margin_right'>";
            echo '<div class="cleaner"></div>';
        } else {
            echo "<div class='product_box'>";
            echo '<div class="cleaner"></div>';
        }
    ?>
        <h2><?php echo $rsq['book_type']; ?></h2>
        <a href="productdetail.php?book_id=<?php echo $rsq['book_id']; ?>">
            <img src="bookcoverimage/<?php echo $rsq['images']; ?>" alt="<?php echo $rsq['book_name']; ?>" width="100" height="150" />
        </a>
        <p style="height: 30px;"><a href="productdetail.php?book_id=<?php echo $rsq['book_id']; ?>"><strong><?php echo ucfirst($rsq['book_name']); ?></strong></a></p>
        <p>
            <font color="#006600"> Rs. <?php
                                        $discprice = ($rsq['price'] * $rsq['discount']) / 100;
                                        echo $rsq['price'] - $discprice;
                                        ?> <strike>Rs. <?php echo $rsq['price']; ?></strike> <?php echo $rsq['discount']; ?>% Off</font>
        </p>
        <?php
        $checkcart = "SELECT * FROM purchase WHERE book_id='$rsq[book_id]' AND cust_id='$_SESSION[loginid]' AND purchasestatus='Pending'";
        $rescart = mysqli_query($con, $checkcart);
        if (mysqli_num_rows($rescart) == 1) {
        ?>
            <a href="viewcart.php">Exist in Cart</a>
        <?php
        } else {
        ?>
            <a href="viewcart.php?productid=<?php echo $rsq['book_id']; ?>&price=<?php echo $rsq['price']; ?>&qty=1&submit=Add+to+Cart" class="addtocart"></a>
        <?php
        }
        ?>
        <a href="productdetail.php?book_id=<?php echo $rsq['book_id']; ?>" class="detail"></a>
</div>
<?php
        $i++;
    }
?>

</div>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<?php
include("footer.php");
?>