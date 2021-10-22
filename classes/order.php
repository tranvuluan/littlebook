<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');


?>
<?php
class order
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function showOrderById_User($id_user)
    {
        $query = "SELECT * FROM `tbl_order` WHERE id_user = '$id_user'";
        $result = $this->db->select($query);
        return $result;
    }

    public function showOrderById_Order($id_order)
    {
        $query = "SELECT * FROM `tbl_order`, `tbl_item` WHERE tbl_order.id_order = tbl_item.id_order
        AND tbl_order.id_order = '$id_order' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function showOrderById_OrderAllItem($id_order)
    {
        $query = "SELECT * FROM `tbl_order`, `tbl_item`, `tbl_book` WHERE tbl_order.id_order = tbl_item.id_order AND tbl_book.id_book = tbl_item.id_book
        AND tbl_order.id_order = '$id_order'";
        $result = $this->db->select($query);
        return $result;
    }

    public function showOrderChuaXuLy()
    {
        $query = "SELECT * FROM `tbl_order` WHERE status = '0'";
        $result = $this->db->select($query);
        return $result;
    }

    public function showOrderDaXuLy()
    {
        $query = "SELECT * FROM `tbl_order` WHERE status = '1'";
        $result = $this->db->select($query);
        return $result;
    }

    public function showOrderHoanTat()
    {
        $query = "SELECT * FROM `tbl_order` WHERE status = '2'";
        $result = $this->db->select($query);
        return $result;
    }

    public function xuly($id_order)
    {
        $query = "UPDATE `tbl_order` SET status = '1' WHERE id_order = '$id_order'";
        $result = $this->db->update($query);
        return $result;
    }
    public function hoantat($id_order)
    {
        $query = "UPDATE `tbl_order` SET status = '2' WHERE id_order = '$id_order'";
        $result = $this->db->update($query);
        return $result;
    }

    public function xoadh($id_order)
    {
        $query = "DELETE FROM `tbl_order`  WHERE id_order = '$id_order'";
        $result = $this->db->delete($query);
        return $result;
    }
}
?>