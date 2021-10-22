<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class khuyenmai
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function themKM($id_book, $discountpercent) {
        $query = "INSERT INTO `tbl_booksale`(`id_book`, `discountpercent`) VALUES ('$id_book','$discountpercent')";
        $result = $this->db->insert($query);
        if ($result) {
            return "Sucessful";
        }
        else
            return "Fail"; 
    }

    public function setKM($id_book, $discountpercent) {
        $query = "UPDATE `tbl_booksale` SET discountpercent = '$discountpercent' WHERE id_book = '$id_book'";
        $result = $this->db->update($query);
        if ($result) {
            return "Sucessful";
        }
        else
            return "Fail"; 
    }

    public function showBookSale() {
        $query = "SELECT * FROM `tbl_booksale`, `tbl_book` WHERE tbl_book.id_book = tbl_booksale.id_book";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteBookSale($id_book) {
        $query = "DELETE FROM `tbl_booksale` WHERE id_book = '$id_book'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function showBookSaleById_book($id_book) {
        $query = "SELECT * FROM `tbl_booksale`, `tbl_book` WHERE tbl_book.id_book = tbl_booksale.id_book AND tbl_book.id_book = '$id_book'";
        $result = $this->db->select($query);
        return $result;
    }
}