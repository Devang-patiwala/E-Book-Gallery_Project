<?php
function calculateprice($price,$discount)
{
$discountprice = ($price*$discount)/100;
$totprice = $price- $discountprice;
return $totprice;
}
?>