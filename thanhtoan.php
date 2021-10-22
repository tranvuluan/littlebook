<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/header.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/classes/checkout.php';
if (Session::checkUserLogin() == false) {
    header('Location: index.php');
}
?>

<?php


if (isset($_GET['hoten'])) {
    $id_user = $_SESSION['id_user'];
    $hoten = $_GET['hoten'];
    $phone = $_GET['sdt'];
    $email = $_GET['email'];
    $address = $_GET['diachi'];
    $ghichu = $_GET['description'];
    $totalprice = $_SESSION['totalprice'];
    $checkout = new checkout();
    $addorder = $checkout->addOrder($id_user,$hoten,$email, $phone, $address, $ghichu, $totalprice, $_SESSION['cart']);
    if ($addorder) {
        header('Location: index.php');
    }
    else 
        header('Location: 404.php');
}

?>

<!-- Kết thúc header -->
<div style="text-align: center;">
    <a href="index.php"><img src="image/logo.jpg" style="width: 100px;"></a>
    <p class="_pinput" style="font-size: 30px;"> Thanh Toán </p>
</div>

<div class="pay-content">
    <div class="thanhtoan1">
        <span class="thanhtoan-stt">1</span>
        <span class="thanhtoan-text-stt">Thông Tin Đơn Hàng</span>
        <form class="_formthanhtoan" method="GET">
            <p class="_pinput"> Họ và tên<span style="color: red;">*</span> </p>
            <input class="_inputthanhtoan" id="name" type="text" name="hoten" placeholder="Họ và tên">
            <p class="_pinput">Email</p>
            <input class="_inputthanhtoan" id="mail" type="text" name="email" placeholder="Email">
            <p class="_pinput"> Điện Thoại<span style="color: red;">*</span> </p>
            <input class="_inputthanhtoan" id="sdt" type="text" name="sdt" placeholder="Số điện thoại">
            <p class="_pinput"> Địa Chỉ <span style="color: red;">*</span></p>
            <input class="_inputthanhtoan" id="address" type="text" name="diachi" placeholder="Địa chỉ cụ thể">
            <p class="_pinput"> Ghi Chú Đơn Hàng </p>
            <textarea id="description" name="description" rows="5" cols="40" placeholder="Ghi chú đơn hàng"></textarea>
        </form>
    </div>
    <div class="thanhtoan2">
        <span class="thanhtoan-stt">2</span>
        <span class="thanhtoan-text-stt">Phương Thức Thanh Toán</span>
        <div class="thanhtoan-content">
            <input class="_inputthanhtoan" checked type="radio">
            <span>Thanh toán bằng tiền mặt khi nhận hàng (COD)</span>
        </div>
    </div>

    <div class="thanhtoan3">
        <span class="thanhtoan-stt">3</span>
        <span class="thanhtoan-text-stt">Thông Tin Giỏ Hàng</span>
        <div class="thanhtoan3-content">
            <!-- List sản phẩm lấy từ cart -->
            <div class="list-info">
                <div class="info top-info">
                    <div class="col1">Tên sản phẩm</div>
                    <div class="col2">Số lượng</div>
                    <div class="col3">Giá</div>
                </div>
                <ul id="list">
                    <?php
                    $totalpricetemp = 0;
                    foreach ($_SESSION['cart'] as $key => $value) {
                        $totalpricetemp =  $totalpricetemp + $value['price_book'] * $value['quantity'];
                    ?>
                        <li class="info list">
                            <div class="col1"><?php echo $value['name_book'] ?></div>
                            <div class="col2"><?php echo $value['quantity'] ?></div>
                            <div class="col3"><?php echo $value['price_book'] * $value['quantity'] ?></div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="cart-price">
                <span>Tạm tính:</span>
                <span id="beforePrice" class="_price"> <?php echo $totalpricetemp ?>đ</span>
            </div>
            <div class="ship-price">
                <span>Phí vận chuyển: </span>
                <span class="_price">30000 đ</span>
            </div>
            <div class="total-price">
                <span>Tổng cộng: </span>
                <span id="totalPrice" class="_price"><?php echo $totalpricetemp + 30000;
                                                        $_SESSION['totalprice'] = $totalpricetemp + 30000 ?>đ</span>
            </div>
            <form method="GET" class="khuyenmai">
                <p class="_pinput">Nhập mã khuyễn mãi (Mã Coupon, Voucher)</p>
                <div class="code-khuyenmai">
                    <input class="_inputthanhtoan" name="voucher" type="text" placeholder="Nhập mã khuyễn mãi nếu có">
                    <div class="btn btn-dark code btnthanhtoan">Áp dụng</div>
                </div>
            </form>

            <div class="btn-bottom">
                <a href="#" onclick="submitFormCheckout()" class="btn btn-dark btnthanhtoan">Tiến hành thanh toán</a>
                <a href="index.php">
                    <div class="btn btn-dark btnthanhtoan">Tiếp tục mua sắm</div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function submitFormCheckout() {
        document.getElementsByClassName('_formthanhtoan')[0].submit();
    }
</script>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="js/homejs.js"></script>
</body>

</html>

<?php
ob_flush();
?>