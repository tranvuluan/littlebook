<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../classes/khuyenmai.php';
?>

<?php
$khuyenmai = new khuyenmai();
if (isset($_GET['id_book'])) {
    $id_book = $_GET['id_book'];
    $showbooksale = $khuyenmai->showBookSaleById_book($id_book);
    if ($showbooksale) {
        while ($result = $showbooksale->fetch_assoc()) {
?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông tin khuyến mãi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-control " action="" style="border: none;">
                            <label for="">Thông tin khuyến mãi</label>
                            <input type="text" name="discountpercent" value="<?php echo $result['discountpercent'] * 100 ?>">

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="confirm('Xoá khuyến mãi?');requestAjaxtoDelete('<?php echo $result['id_book'] ?>')">Xoá KM</button>
                        <button type="button" class="btn btn-primary" onclick="requestAjaxToChange('<?php echo $result['id_book'] ?>')">Sửa KM</button>
                    </div>
                </div>
            </div>
<?php
        }
    }
}

if (isset($_GET['id_bookdelete'])) {
    $id_bookdelete = $_GET['id_bookdelete'];
    $deletekm = $khuyenmai->deleteBookSale($id_bookdelete);
    if ($deletekm) {
        echo "Successful";
    } else
        echo "Fail";
}

if (isset($_GET['id_bookchange']) && isset($_GET['discountpercent'])) {
    $id_bookchange = $_GET['id_bookchange'];
    $discountpercent = $_GET['discountpercent'] / 100;
    $changekm = $khuyenmai->setKM($id_bookchange, $discountpercent);
    if ($changekm) {
        echo "Successful";
    } else
        echo "Fail";
}

?>