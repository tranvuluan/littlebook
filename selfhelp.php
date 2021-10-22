<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/header.php';
?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/classes/danhmuc.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/classes/sach.php';
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/classes/khuyenmai.php');
?>

<?php
$danhmuc = new danhmucsach();
$book = new sach();
$khuyenmai = new khuyenmai();

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
    header('Location: selfhelp.php');
}
?>
<!-- Kết thúc header -->

<!-- Nội dung -->
<div class="cntt-link">
    <span><a href="index.php">Trang chủ</a> / <a href="#">SÁCH PHÁT TRIỂN BẢN THÂN</a></span>
</div>
<div class="cntt-content-block">
    <div class="cntt-content_left">
        <div class="left_danhmuc">
            <span>DANH MỤC SẢN PHẨM</span>
        </div>
        <div class="left_content-block">
            <ul>
                <?php
                $showdanhmuc = $danhmuc->showDanhmuccon('2');
                if ($showdanhmuc) {
                    while ($result = $showdanhmuc->fetch_assoc()) {
                ?>
                        <li class="li_sach" style="cursor: pointer" onclick="requestAjaxToShowBookCategory(<?php echo strval($result['id_categorychild']) ?>,0); joincategorychild(this);">
                            <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                            <span><?php echo $result['name_categorychild'] ?></span>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
            <script> $(document).ready(function() {$('.li_sach')[0].click()}) </script>
        </div>
    </div>
    <div class="cntt-content_right ngonngulaptrinh">
        <div class="right-content_top">
            <div class="filter_content">
                <button onclick="filter('0',this)" class="btn btn-outline-info btn-sm filter active">Khuyến mãi</button>
                <button  onclick="filter('1',this)" class="btn btn-outline-info btn-sm filter">Mới
                    nhất</button>
                <button  onclick="filter('2',this)" class="btn btn-outline-info btn-sm filter">Bán
                    chạy</button>
            </div>
        </div>
        <!-- Block sách -->
        <div class="right-content_books">
            <ul id="show_allbook">

            </ul>
        </div>
    </div>

</div>



<!-- Quick view -->


<!-- Barbottom -->
<!-- Footer -->
<?php
include_once $filepath . '/../inc/footer.php';
?>