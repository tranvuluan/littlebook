<?php 
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
Session::checkSession();
include_once($filepath . '/../classes/danhmuc.php');
include_once($filepath . '/../classes/sach.php');

?>
<?php 
    if(isset($_GET['id_book'])) {
        $id_book = $_GET['id_book'];
        $sach = new sach();
        $showsach = $sach->showBookByID($id_book);
        while ($result = $showsach->fetch_assoc()) {
            $name_book = $result['name_book'];
            $author_book = $result['author_book'];
            $publisher_book = $result['publisher_book'];
            $id_categorychild = $result['id_categorychild'];
            $danhmuc = new danhmucsach();
            $danhmuccon = $danhmuc->findDanhmuccon($id_categorychild);
            $categorychild;
            while ($result1 = $danhmuccon->fetch_assoc()) {
                $categorychild = $result1['name_category'].'---'.$result1['name_categorychild'];
            }
            $description_book = $result['description_book'];
            $price_book = $result['price_book'];
            $count_book = $result['count_book'];
            $dateofsale = $result['DateOfSale'];
            $salecheck_book = $result['salecheck_book'];
            echo $name_book.'|'.$author_book.'|'.$publisher_book.'|'.$description_book.'|'.$categorychild.'|'.'|'.$price_book.'|'.$count_book.'|'.$dateofsale.'|'.$salecheck_book.'|'.$id_book.'|'.$result['salecheck_book'];
        }
    }
?>

