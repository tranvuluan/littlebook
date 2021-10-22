<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/header.php';

?>

<div class="bg-img">
    <img src="image/khuyenmai.jpg" width="100%" height="530px">
    <a href="index.php" title="khuyen-mai" class="img-buy"><img src="image/icon-mua-ngay.png" width="270px" height="80px"></a>
</div>
<div class="bg-discount">
    <p class="text-dis"> CHƯƠNG TRÌNH TRI ÂN KHÁCH HÀNG</p>
    <p class="text-dis">Khuyến mãi thêm lên đến 20%</p>
    <div class="bg-dis-code">
        <div class="dis-code1">
            <img src="image/Discount/discount1.jpg" width="200px" height="200px" alt="">
        </div>
        <div class="dis-code1">
            <img src="image/Discount/discount2.jpg" width="200px" height="200px" alt="">
        </div>
        <div class="dis-code1">
            <img src="image/Discount/discount3.jpg" width="200px" height="200px" alt="">
        </div>
        <div class="dis-code1">
            <img src="image/Discount/discount7.jpg" width="200px" height="200px" alt="">
        </div>
    </div>
    <br>
    <p class="text-dis-code">Ưu đãi thêm từ Ngân hàng và Ví điện tử</p>
    <div class="bg-dis-code1">
        <div class="dis-code2">
            <img src="image/Discount/discount4.jpg" width="300px" height="150px" alt="">
        </div>
        <div class="dis-code2">
            <img src="image/Discount/discount5.jpg" width="300px" height="150px" alt="">
        </div>
        <div class="dis-code2 dis-code2-end">
            <img src="image/Discount/discount6.jpg" width="300px" height="150px" alt="">
        </div>
    </div>

</div>

<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/footer.php';
ob_flush();
?>