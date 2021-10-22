<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../classes/sach.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../classes/khuyenmai.php';

?>
<?php
if (isset($_GET['id_categorychild']) && isset($_GET['id_filter'])) {
    $id_categorychild = $_GET['id_categorychild'];
    $id_filter = $_GET['id_filter'];
    $book = new sach();
    $khuyenmai = new khuyenmai();
    $showsach = $book->showBookByCategorychildIdByFilter($id_categorychild, $id_filter);
    $objects = array();
    if ($showsach) {
        while ($result = $showsach->fetch_assoc()) {
?>
            <li>
                <div class="item">
                    <div class="product-image">
                        <div class="icon-product">
                            <i class="fa fa-search-plus" onclick="quickview('<?php echo $result['id_book'] ?>');" aria-hidden="true" data-toggle="modal" data-target="#myModal" style="cursor: pointer;"></i>
                            <a href="?id_bookaddtocart=<?php echo $result['id_book']?>" onclick="alert('Đã thêm sách vào giỏ hàng');"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                        </div>
                        <img src="uploads/images/book/<?php $imagepath = explode(',', $result['image_book']);
                                                        echo $imagepath[0]; ?>" alt="">
                    </div>
                    <a onclick="showdetails(this)" href="details.php?id_book=<?php echo $result['id_book'] ?>">
                        <h6 class="name" data-index="0"><?php echo $result['name_book'] ?></h6>
                        <?php
                        if ($result['salecheck_book'] === '2') {
                            $cnttbooksale = $khuyenmai->showBookSaleById_book($result['id_book']);
                            if ($cnttbooksale) {
                                while ($resultsale = $cnttbooksale->fetch_assoc()) {
                        ?>
                                    <h5 class="price"><?php echo $resultsale['price_book'] * (1 - $resultsale['discountpercent']) ?>đ</h5>
                                    <h6 class="origin-price" style="text-decoration: line-through;display: inline;"><?php echo $resultsale['price_book'] ?>đ</h6>
                            <?php

                                }
                            }
                        } else {
                            ?>
                            <h5 class="price"><?php echo $result['price_book'] ?>đ</h5>
                        <?php
                        }
                        ?>
                    </a>
                </div>
            </li>
<?php
        }
    }
}
?>