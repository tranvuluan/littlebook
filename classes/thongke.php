<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');


?>
<?php
class thongke
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function sltaikhoan() {
        $query = "SELECT * FROM `tbl_useraccount`";
        $rs = $this->db->select($query);
        return $rs;
    }

    public function slsachdaban() {
        $query = "SELECT * FROM `tbl_book`";
        $rs = $this->db->select($query);
        return $rs;
    }

    public function slorder() {
        $query = "SELECT * FROM `tbl_order`";
        $rs = $this->db->select($query);
        return $rs;
    }

    public function doanhthu() {
        $query = "SELECT * FROM `tbl_order`, `tbl_item` WHERE tbl_order.id_order = tbl_item.id_order
        ";
        $rs = $this->db->select($query);
        return $rs;
    }
}
?>