<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/inc/header.php');
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/classes/danhmuc.php');
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/classes/khuyenmai.php');
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/classes/sach.php');

?>

<?php
$book = new sach();
$khuyenmai = new khuyenmai();
$danhmuc = new danhmucsach();
echo '<pre>'; 
echo $_SESSION['token'];
echo '</pre>';
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
    header('Location: index.php');
}
?>
<!-- Kết thúc header -->
<!-- Phần danh mục và slide -->
<div class="danhmuc-slide">
    <div class="danhmuc">
        <div class="block-title">
            <div class="fa fa-bars" style="font-size: 30px;"></div>
            <h6 class="title">DANH MỤC</h6>
        </div>
        <ul class="list">
            <li>
                <a href="congnghethongtin.php">
                    <div class="fa fa-book"></div>
                    <h6>Sách công nghệ thông tin<i class="fa fa-angle-right" style="margin-left: 79.5px;" aria-hidden="true"></i></h6>
                </a>
                <div class="phumuc cntt">
                    <ul>
                        <?php
                        $showcategorychild = $danhmuc->showDanhmuccon('1');
                        if ($showcategorychild) {
                            while ($rscategorychild = $showcategorychild->fetch_assoc()) {
                        ?>
                                <li>
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    <a href="congnghethongtin.php"><?php echo $rscategorychild['name_categorychild'] ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>

            </li>
            <li>
                <a href="selfhelp.php">
                    <div class="fa fa-book"></div>
                    <h6>Sách phát triển bản thân<i class="fa fa-angle-right" style="margin-left: 79.5px;" aria-hidden="true"></i></h6>
                </a>
                <div class="phumuc selfhelp">
                    <ul>
                        <?php
                        $showcategorychild = $danhmuc->showDanhmuccon('2');
                        if ($showcategorychild) {
                            while ($rscategorychild = $showcategorychild->fetch_assoc()) {
                        ?>
                                <li>
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    <a href="selfhelp.php"><?php echo $rscategorychild['name_categorychild'] ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </li>
            <li>
                <a href="ngoaingu.php">
                    <div class="fa fa-book"></div>
                    <h6>Sách ngoại ngữ<i class="fa fa-angle-right" style="margin-left: 152.5px;" aria-hidden="true"></i></h6>
                </a>
                <div class="phumuc language">
                    <ul>
                        <?php
                        $showcategorychild = $danhmuc->showDanhmuccon('3');
                        if ($showcategorychild) {
                            while ($rscategorychild = $showcategorychild->fetch_assoc()) {
                        ?>
                                <li>
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    <a href="ngoaingu.php"><?php echo $rscategorychild['name_categorychild'] ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="slide-show">
        <div id="carouselId" class="carousel slide myslide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                <li data-target="#carouselId" data-slide-to="1"></li>
                <li data-target="#carouselId" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="image/SlideShow/slideshow3.jpg" alt="">
                </div>
                <div class="carousel-item">
                    <img src="image/SlideShow/slideShow2.jpg" alt="">
                </div>
                <div class="carousel-item">
                    <img src="image/SlideShow/slideshow1.jpg" alt="">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<!-- Kết thúc Phần Danh mục Slide -->

<!-- Khuyễn mãi lơn - Sale-Off -->
<div class="content-block sale-off">
    <div class="sale-off_top">
        <div class="sale-off_left">
            <img src="image/SaleOff.PNG" alt="">
        </div>
        <div class="sale-off_right">
            <marquee behavior="scroll" direction="left">Chào mừng bạn đến với book.littlestupid.info - Sách chất lượng, uy tín,
                giá rẻ!</marquee>
        </div>
    </div>
    <div class="content">
        <!-- Content-left quảng cáo -->
        <div class="content-left myslide-saleoff">
            <div id="carouselId" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselId" data-slide-to="1"></li>
                    <li data-target="#carouselId" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="image/SaleOFF/Slide-left/1.jpg" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="image/SaleOFF/Slide-left/2.jpg" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="image/SaleOFF/Slide-left/3.jpg" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="image/SaleOFF/Slide-left/4.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="content-right">
            <!-- Slide sách SaleOFF-->
            <div class="owl-carousel owl-theme">
                <?php
                $showbook = $khuyenmai->showBookSale();
                if ($showbook) {
                    while ($result = $showbook->fetch_assoc()) {

                ?>
                        <div class="item">
                            <div class="product-image">
                                <div class="icon-product">
                                    <i class="fa fa-search-plus" onclick="quickview('<?php echo $result['id_book'] ?>');" aria-hidden="true" data-toggle="modal" data-target="#myModal" style="cursor: pointer;"></i>
                                    <a href="?id_bookaddtocart=<?php echo $result['id_book'] ?>" onclick="alert('Đã thêm sách vào giỏ hàng');"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                </div>
                                <img src="uploads/images/book/<?php
                                                                $imagepath = explode(',', $result['image_book']);

                                                                echo $imagepath[0] ?>" alt="">
                            </div>
                            <a onclick="showdetails(this)" href="details.php?id_book=<?php echo $result['id_book'] ?>&token=<?php echo $_SESSION['token'] ?>">
                                <h6 class="name" data-index="0"><?php echo $result['name_book'] ?></h6>
                                <h5 class="price"><?php echo $result['price_book'] * (1 - $result['discountpercent']) ?>đ</h5>
                                <h6 class="origin-price" style="text-decoration: line-through;display: inline;"><?php echo $result['price_book'] ?>đ</h6>
                            </a>
                        </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>


<!-- Sách Công nghệ thông tin - Home -->
<div class="content-block slide-cntt">
    <div class="sale-off_top">
        <div class="sale-off_right">
        <marquee behavior="scroll" direction="right">CÔNG NGHỆ THÔNG TIN</marquee>
        </div>
    </div>
    <div class=" content">
            <!-- Content-left quảng cáo -->
            <div class="content-left myslide-saleoff">
                <div id="carouselId" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselId" data-slide-to="1"></li>
                        <li data-target="#carouselId" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="image/CNTT_Index/Slide-left/hacking2.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="image/CNTT_Index/Slide-left/hacking1.jpg" alt="">
                        </div>

                    </div>
                </div>
            </div>
            <div class="content-right">
                <!-- Slide sách SaleOFF-->
                <div class="owl-carousel owl-theme">
                    <?php
                    $showCnttBook = $book->showBookOfCNTT();
                    if ($showCnttBook) {
                        while ($result1 = $showCnttBook->fetch_assoc()) {
                    ?>
                            <div class="item">
                                <div class="product-image">
                                    <div class="icon-product">
                                        <i class="fa fa-search-plus" onclick="quickview('<?php echo $result1['id_book'] ?>');" aria-hidden="true" data-toggle="modal" data-target="#myModal" style="cursor: pointer;"></i>
                                        <a href="?id_bookaddtocart=<?php echo $result1['id_book'] ?>" onclick="alert('Đã thêm sách vào giỏ hàng');"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>

                                    </div>
                                    <img src="uploads/images/book/<?php $imagepath = explode(',', $result1['image_book']);
                                                                    echo $imagepath[0]; ?>" alt="">
                                </div>
                                <a onclick="showdetails(this)" href="details.php?id_book=<?php echo $result1['id_book'] ?>">
                                    <h6 class="name" data-index="0"><?php echo $result1['name_book'] ?></h6>
                                    <?php
                                    if ($result1['salecheck_book'] === '2') {
                                        $cnttbooksale = $khuyenmai->showBookSaleById_book($result1['id_book']);
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
                                        <h5 class="price"><?php echo $result1['price_book'] ?>đ</h5>
                                    <?php } ?>
                                </a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
    </div>

</div>




<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            autoWidth: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

    });
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->


<!-- Bar bottom -->
<!-- Footer -->
<?php
include_once($filepath . '/../inc/footer.php');
?>