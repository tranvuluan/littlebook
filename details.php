<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/header.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/classes/sach.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/classes/khuyenmai.php';
ob_start();
?>

<?php
$token = $_COOKIE['token'];
echo 'token'.$token;
$book = new sach();
$khuyenmai = new khuyenmai();
if ($_COOKIE['token'] == $_GET['token']) {
    if (isset($_GET['id_book'])) {
        $id_book = $_GET['id_book'];
        $showBookById = $book->showBookByID($id_book);
        $result = $showBookById->fetch_assoc();
        
    }
} else {
    header('Location: index.php');
}


isset($_SESSION['cart']) ? $_SESSION['cart'] : $_SESSION['cart'] = null;
if (isset($_GET['id_bookaddtocart'])) {
    $id_book = $_GET['id_bookaddtocart'];
    if (!isset($_SESSION['cart'][$id_book])) {
        $showBookByID = $book->showBookByID($id_book);
        if ($showBookByID)
            $rs = $showBookByID->fetch_assoc();

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
    header('Location: details.php?id_book='.$id_book);
}
?>
<!-- Kết thúc header -->
<!-- Content -->
<div class="details-link">
    <span><a href="index.php">Trang chủ</a> / <a href="#">THÔNG TIN SẢN PHẨM</a></span>
</div>
<br>

<div class="deltails-content">
    <div class="deltails-content-left">
        <img id="del-img" src="<?php 
                                $strimage = $result['image_book'];
                                $arrimg = explode(",",$strimage);
                                echo 'uploads/images/book/'.$arrimg[0];
                            ?>" alt="">
    </div>
    <div class="deltails-content-right">
        <h4 id="del-title" class="del-name-product" style="text-transform: uppercase;">
            <?php echo $result['name_book'] ?>
        </h4>

        <div class="del-block">
            <div class="price-quantity">
                <div id="del-price" style="font-size: 30px; font-weight: 500; display: inline; color: #C73736;" class="_price">
                    <?php echo $result['price_book'] ?>đ
                </div>
                <?php if ($result['salecheck_book'] == '2') {
                    $booksale = new khuyenmai();
                    $showBookSale = $booksale->showBookSaleById_book($id_book);
                    $result1 = $showBookSale->fetch_assoc();
                ?>
                    <span id="del-origin-price" style="font-size: 20px; text-decoration: line-through; font-style: italic;" class="_origin-price"><?php echo $result1['price_book'] * (1 - $result1['discountpercent']) ?>đ</span>
                <?php } ?>
            </div>
            <div class="del-description">
                <p style="font-size: 20px;font-weight: 500;">Dịch vụ của chúng tôi</p>
                <i style="margin-right: 10px; float: left;font-size: 30px;" class="fa fa-truck" aria-hidden="true"></i>
                <span>Giao hàng tận nhà toàn quốc, thanh toán khi nhận hàng (COD).</span>
                <br>
                <br>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                <span style="margin-left: 5px;">Sách hay, rẻ, chất lượng tốt.</span>
            </div>
        </div>
        <div style="margin-left: 30px;" class="del-btn">
            <a href="cart.php?id_book=<?php echo $result['id_book'] ?>" style="float: left; width: 125px; height: 37px;">
                <div class="button buy">MUA NGAY</div>
            </a>

            <a href="?id_bookaddtocart=<?php echo $result['id_book']?>" onclick="alert('Đã thêm sách vào giỏ hàng');" style="margin-left: 30px; float: left;width: 190px; height: 37px; cursor: pointer;">
                <div class="button addcart">THÊM VÀO GIỎ HÀNG</div>
            </a>

        </div>
    </div>
</div>
<div class="deltails-description">
        <div style="padding-left: 20px;">
            <h2>Mô tả sách</h2>
        </div>
        <div style="padding-left: 40px">
            <form action="#">
            <?php echo $result['description_book'] ?>
            </form>
        </div>
    </div>
    <br>
    <div class="deltails-comments">
        <div style="padding-left: 20px;">
            <h2>Nhận xét đánh giá</h2>
        </div>
        <div style="padding-left: 20px;">
            <form action="#" method="post">
                <div style="margin-left: 15px">
                    <span style="margin-bottom: 20px">Đánh giá sản phẩm</span>
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                      </div>
                </div>
                <div class="input-comments" style="margin: 15px 35px 10px 15px">
                    <span>Viết bình luận của bạn tại đây</span>
                    <textarea id="commentsText" rows="8" placeholder="Viết bình luận của bạn đây." class="form-control input"></textarea>
                </div>
                <input class="btn btn-success" type="submit" value="Gửi">
            </form>
            
        </div>
    </div>
<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/footer.php';
ob_flush();
?>