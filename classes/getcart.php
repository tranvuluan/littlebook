<?php session_start(); ?>
<?php

if (isset($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
    $id_book = $_GET['id_book'];
    $_SESSION['cart'][$id_book]['quantity'] = $quantity;
    $totalprice = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        $totalprice += $value['price_book'] * $value['quantity'];
    }
    echo $totalprice;
}

if (isset($_GET['id_book_remove'])) {
    $id_book = $_GET['id_book_remove'];
    unset($_SESSION['cart'][$id_book]);
    $totalprice = 0;
    foreach ($_SESSION['cart'][$id_book] as $key => $value) {
        $totalprice += strval($value['price_book']) * strval($value['quantity']);
    }
    echo $totalprice;
}

?>