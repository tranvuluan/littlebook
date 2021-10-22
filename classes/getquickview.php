<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/sach.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/khuyenmai.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../helpers/format.php';
?>


<?php
$fm = new Format();
if (isset($_GET['id_book'])) {
    $id_book = $_GET['id_book'];
    $book = new sach();
    $khuyenmai = new khuyenmai();
    $showbookbyid = $book->showBookByID($id_book);
    if ($showbookbyid) {
        while ($result = $showbookbyid->fetch_assoc()) {
?>
            <!-- The Modal -->
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title _modaltitle">Thông tin sản phẩm
                        </h5>
                        <button type="button" class="close _close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body _modalbody">
                        <div class="modal-body-image _modalimage">
                            <img id="modal_image" src="<?php 
                                $strimage = $result['image_book'];
                                $arrimg = explode(",",$strimage);
                                echo 'uploads/images/book/'.$arrimg[0];
                            ?>" alt="">
                        </div>
                        <div class="modal-body-info _modalinfo">
                            <h5 class="info-name"><a href="details.php?id_book=<?php echo $result['id_book'] ?>"><?php echo $result['name_book'] ?></a></h5>
                            <?php
                            if ($result['salecheck_book'] == '2') {
                                $booksale = $khuyenmai->showBookSaleById_book($result['id_book']);
                                $result1 = $booksale->fetch_assoc();
                            ?>
                                <h4 class="info-price" style="color: #C73736; display: inline-block;">
                                    <?php echo $result1['discountpercent'] * $result['price_book'] ?>đ
                                </h4>
                                <h6 class="info-origin-price" style="text-decoration: line-through;display: inline-block; margin-left: 5px;"><?php echo $result['price_book'] ?>đ</h6>
                            <?php
                            } else {
                            ?>
                                <h4 class="info-price" style="color: #C73736; display: inline-block;"><?php echo $result['price_book'] ?>đ</h4>
                            <?php
                            }
                            ?>
                            <br>

                            <span id="info-fewdesciption"><?php echo $fm->textShorten($result['description_book'], 120) ?></span>
                            <span id="info-description" class="collapse"><?php echo $fm->textToText($result['description_book'], 120) ?></span>


                            <div class="btn btn-primary" style="font-size:10px; margin: 2px" data-toggle="collapse" data-target="#info-description">Xem thêm</div>
                            <br>
                            <br>
                            <a href="cart.php?id_book=<?php echo $result['id_book'] ?>">
                                <div class="btn btn-danger mybtn">Mua ngay</div>
                            </a>
                            <a href="?id_bookaddtocart=<?php echo $result['id_book']?>" onclick="alert('Đã thêm sách vào giỏ hàng');">
                                <div class="btn btn-danger mybtn">Thêm vào giỏ hàng</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
}
?>