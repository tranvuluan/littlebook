<?php
$filepath = realpath(dirname(__FILE__));
include($filepath . '/../lib/database.php');
include($filepath . '/../helpers/format.php');


?>
<?php
class checkout
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    function addOrder($id_user, $hoten, $email, $phone, $address, $ghichu, $totalprice, $listItem)
    {
        $id_order = uniqid(5);
        $id_user = $id_user;
        $hoten = $this->fm->validation($hoten);
        $email = $this->fm->validation($email);
        $phone = $this->fm->validation($phone);
        $address = $this->fm->validation($address);
        $ghichu = $this->fm->validation($ghichu);
        $totalprice = $this->fm->validation($totalprice);

        $hoten = mysqli_real_escape_string($this->db->link, $hoten);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $ghichu = mysqli_real_escape_string($this->db->link, $ghichu);
        $totalprice = mysqli_real_escape_string($this->db->link, $totalprice);

        $query = "INSERT INTO `tbl_order`(`id_order`,`id_user`, `totalprice`, `hoten`, `address`, `email`, `phone`, `ghichu`) VALUES ('$id_order','$id_user', '$totalprice', '$hoten', '$address', '$email', '$phone','$ghichu')";
        $result = $this->db->insert($query);
        if ($result) {
            $this->addItem($listItem, $id_order);
            return "Successful";
        }
        else
            return "Fail";
    }

    function addItem($listItem, $id_order)
    {
        foreach ($listItem as $key => $value) {
            $id_book = $value['id_book'];
            $count = $value['quantity'];
            $priceItem = $value['price_book']*$value['quantity'];
            $query = "INSERT INTO `tbl_item`(`id_book`, `id_order`, `count`, `item_price`) VALUES ('$id_book','$id_order','$count','$priceItem')";
            $rs = $this->db->insert($query);
            $this->incBuyCount($id_book, $count);
        }
    }

    function incBuyCount($id_book, $buycount) {
        $sql = "SELECT * FROM `tbl_book` WHERE id_book = '$id_book'";
        $rs = $this->db->select($sql);
        $buycount_book = $rs->fetch_assoc();
        $count = $buycount_book['buycount_book'] + $buycount;
        $query = "UPDATE `tbl_book` SET buycount_book = '$count' WHERE id_book = '$id_book'";
        $result = $this->db->update($query);

    }
}
?>