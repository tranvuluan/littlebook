<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../classes/order.php';
?>

<?php
if (isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];
    $order = new order();
    $showOrderByIdOrder = $order->showOrderById_Order($id_order);
    $result = $showOrderByIdOrder->fetch_assoc();
}
?>
<div class="modal-dialog sua" role="document">
    <div class="modal-content" >
        <div class="pay-content">
            <div class="thanhtoan1">
                <span class="thanhtoan-stt">1</span>
                <span class="thanhtoan-text-stt">Thông Tin Đơn Hàng</span>
                <form class="_formthanhtoan" method="GET">
                    <p class="_pinput"> Họ và tên<span style="color: red;">*</span> </p>
                    <input class="_inputthanhtoan" id="name" type="text" name="hoten" placeholder="Họ và tên" value="<?php echo  $result['hoten'] ?>">
                    <p class="_pinput">Email</p>
                    <input class="_inputthanhtoan" id="mail" type="text" name="email" placeholder="Email" value="<?php echo $result['email'] ?>">
                    <p class="_pinput"> Điện Thoại<span style="color: red;">*</span> </p>
                    <input class="_inputthanhtoan" id="sdt" type="text" name="sdt" placeholder="Số điện thoại" value="<?php echo $result['phone'] ?>">
                    <p class="_pinput"> Địa Chỉ <span style="color: red;">*</span></p>
                    <input class="_inputthanhtoan" id="address" type="text" name="diachi" placeholder="Địa chỉ cụ thể" value="<?php echo $result['address'] ?>">
                    <p class="_pinput"> Ghi Chú Đơn Hàng </p>
                    <textarea id="description" name="description" rows="5" cols="40" placeholder="Ghi chú đơn hàng"><?php echo $result['ghichu'] ?></textarea>
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
                            $showAllItem = $order->showOrderById_OrderAllItem($id_order);
                            if ($showAllItem) {
                                $totalprice = 0;
                                while ($rs = $showAllItem->fetch_assoc()) {
                                    $totalprice = $totalprice + $rs['item_price'];
                            ?>
                                    <li class="info list">
                                        <div class="col1"><?php echo $rs['name_book'] ?></div>
                                        <div class="col2"><?php echo $rs['count'] ?></div>
                                        <div class="col3"><?php echo $rs['item_price'] ?></div>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="cart-price">
                        <span>Tạm tính:</span>
                        <span id="beforePrice" class="_price"><?php echo $totalprice ?></span>
                    </div>
                    <div class="ship-price">
                        <span>Phí vận chuyển: </span>
                        <span class="_price">30000 đ</span>
                    </div>
                    <div class="total-price">
                        <span>Tổng cộng: </span>
                        <span id="totalPrice" class="_price"><?php echo $totalprice + 30000  ?>đ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>