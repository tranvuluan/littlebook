<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/header.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/classes/sach.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/classes/khuyenmai.php';

?>

<?php
$book = new sach();
$khuyenmai = new khuyenmai();
isset($_SESSION['cart'])?$_SESSION['cart']:$_SESSION['cart']=null;
if (isset($_GET['id_book'])) {
    $id_book = $_GET['id_book'];
    if (!isset($_SESSION['cart'][$id_book])) {
        $showBookByID = $book->showBookByID($id_book);
        if ($showBookByID)
            $rs = $showBookByID->fetch_assoc();

        var_dump($rs);
        $discountpercent = 1;
        if ($rs['salecheck_book'] == '2') {
            $showBookSaleByIdBook = $khuyenmai->showBookSaleById_book($id_book);
            if ($showBookSaleByIdBook)
                $discountpercent = 1 - $showBookSaleByIdBook->fetch_assoc()['discountpercent'];
        }

        $item = [
            'id_book' => $rs['id_book'],
            'name_book' => $rs['name_book'],
            'price_book' => $rs['price_book'] * $discountpercent,
            'original_price' => $rs['price_book'],
            'image_book' => substr($rs['image_book'], strpos($rs['image_book'], ',')),
            'quantity' => 1
        ];
        $_SESSION['cart'][$id_book] = $item;
    } else
        $_SESSION['cart'][$id_book]['quantity']++;
    unset($_GET['id_book']);
    header("Location:cart.php");
}


?>

<!-- Kết thúc header -->
<div class="content-cart">
    <br>
    <div id="cart" class="item-cart">
        <div class="row">
            <div class="col-md-8 col-sm-12 m-auto">
                <?php if (isset($_SESSION['cart'])) { ?>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered display">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Giá(đ)</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng(đ)</th>
                                    <th scope="col">Xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalprice = 0;
                                $i=0;
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    $i++;
                                    $totalprice = $totalprice + $value['price_book']*$value['quantity'];
                                ?>
                                    <tr id="tr_<?php echo $i ?>">
                                        <td><img style="width:80px" src="uploads/images/book/<?php echo $value['image_book'] ?>" alt=""></td>
                                        <td class="cart_name_book"><?php echo $value['name_book'] ?></td>
                                        <td><?php echo $value['price_book']; if($value['price_book'] != $value['original_price']) echo '</br><span style="text-decoration: line-through; color:#41414141">'.$value['original_price'].'</span>' ?></td>
                                        <td><input style="width:50px" type="number" min="1" onchange="changeValue(this, <?php echo $i ?>)" value="<?php echo $value['quantity'] ?>" data-id_book = <?php echo $value['id_book'] ?>></td>

                                        <td ><?php echo $value['price_book']*$value['quantity']; if($value['price_book'] != $value['original_price']) echo '</br><span style="text-decoration: line-through; color:#41414141">'.$value['original_price']*$value['quantity'].'</span>' ?></td>
                                        <td><button data-id_book="<?php echo $value['id_book'] ?>" onclick="removeItemFromCartSession(this)" class="btn btn-danger">X</button></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else echo '<div class="text-center"><img src="image/empty_cart.png"><br>Giỏ hàng hiện rỗng</div>' ?>
            </div>
        </div>
    </div>
    <div class="total">
        <span class="tong">Tổng: </span>
        <span id="total-price" class="total-price"><?php if(isset($totalprice)) echo $totalprice ?>đ</span>
    </div>
    <div class="btn-cart">
        <a href="index.php" class="btn btn-info btncart">TIẾP TỤC MUA SẮM</a>
        <a href="#" class="btn btn-outline-info btncart" onclick="toCheckcout(<?php (isset($_SESSION['userLogin']) == true)? print '1': print '0' ?>, <?php (isset($_SESSION['cart']))? print count($_SESSION['cart']) : print '0' ?>)">THANH TOÁN</a>
    </div>
</div>
<br>

<!-- Barbottom, Bottom -->
<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/footer.php';

?>