<?php
include "config.php";
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] =[];
//delete cart
if(isset($_GET['delcart']) && ($_GET['delcart'] == 1)) unset($_SESSION['cart']);
//delete element
if(isset($_GET['del']) && ($_GET['del'] >= 0)) {
    array_splice($_SESSION['cart'],$_GET['del'],1);
}
//take data into form
if (isset($_POST['addcart']) && ($_POST['addcart'])) {
    $track_quantity = $_POST['quantity'];
    $track_title = $_POST['track_title'];
    $track_img = $_POST['track_img'];
    $track_artist = $_POST['track_artist'];
    $track_price = $_POST['track_price'];
    $track_id = $_POST['track_id'];

    // update product in cart

    $find_product = 0;
    for ($i=0; $i < sizeof($_SESSION['cart']) ; $i++) {
        if($_SESSION['cart'][$i][5] == $track_id){
            $find_product = 1;
            $new_quantity = $track_quantity + $_SESSION['cart'][$i][0];
            $_SESSION['cart'][$i][0] = $new_quantity;
            break;
        }
    }
    //add product
    if($find_product == 0) {
        $product = [$track_quantity,$track_title,$track_img,$track_artist,$track_price,$track_id];
        $_SESSION['cart'][] = $product;
    }
}

function showCart() {
    if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) {
        if(sizeof($_SESSION['cart']) > 0){
            $sum_price = 0;
            for ($i=0; $i < sizeof($_SESSION['cart']); $i++) {
                $total_price = $_SESSION['cart'][$i][4] * $_SESSION['cart'][$i][0] ;
                $sum_price += $total_price;
                echo '<tr>
                <td class="product-number">'.($i+1).'</td>
                    <td class="product-name">'.$_SESSION['cart'][$i][1].'</td>
                    <td class="product-img"><img src="'.$_SESSION['cart'][$i][2].'"></td>
                    <th class="prodct-artist">'.$_SESSION['cart'][$i][3].'</th>
                    <td class="product-price">'.$_SESSION['cart'][$i][4].'</td>
                    <td class="product-quantity">'.$_SESSION['cart'][$i][0].'</td>
                    <td class="total-money">'.$total_price.'$</td>
                    <td class="product-delete"><a href="cart.php?del='.$i.'">Delete</a></td>
                </tr>';
            }
            echo '<tr id="row-total">
                    <td class="product-number">&nbsp;</td>
                    <td class="product-name">Total Money</td>
                    <th class="total-money">&nbsp;</th>
                    <td class="product-img">&nbsp;</td>
                    <td class="product-price">&nbsp;</td>
                    <td class="product-quantity">&nbsp;</td>
                    <td class="total-money">'.$sum_price.'$</td>
                    <td class="product-delete"><a href="cart.php?delcart=1">Delete All</td>
                </tr>';

        }else{
            echo "You have no products in your shopping cart! ";
        }

    }
}
//Order

$error = false;
if(isset($_POST['order_click'])){
    if(empty($_POST['name'])){
        $error = "Enter reciever name";
    }elseif(empty($_POST['phone'])){
        $error = "Enter your phone number";
    }elseif(empty($_POST['address'])){
        $error = "Enter your address";
    }elseif(empty($_SESSION['cart'])){
        $error = "Empty Cart";
    }
    // save to table oder

    if ($error == false && !empty($_SESSION['cart'])) {
        $insertOrder = mysqli_query($link, "INSERT INTO `order` (`id`, `cus_name`, `cus_phone`, `address`, `note`) 
            VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['phone'] . "', '" . $_POST['address'] . "', '" . $_POST['note'] . "');");
        $success = "Order successed";
        unset($_SESSION['cart']);
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" linktent="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/cart.css" >
</head>
<body>
<div class="container">
    <?php if(!empty($error)) {?>
        <div id="notify-msg">
            <?= $error ?>. <a href="javascript:history.back()"> Return</a>
        </div>
    <?php } elseif(!empty($success)) { ?>
        <div>
            <?= $success ?>.<a href="index.php"> Keep buying </a>
        </div>
    <?php } else { ?>
        <a href="index.php">Home Page</a>
        <h1>Your Cart</h1>
        <form id="cart-form" action="cart.php?action=submit" method="POST">
            <table>
                <tr>
                    <th class="product-number">Number</th>
                    <th class="product-name">Song name</th>
                    <th class="product-img">Song image</th>
                    <th class="product-img">Artist</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="total-money">Total</th>
                    <th class="product-delete">&nbsp;</th>
                </tr>
                <?php showCart() ?>
            </table>
            <div id="form-button">
                <input type="submit" name="update_click" value="Cập nhật" />
            </div>
            <hr>
            <div><label>Reciever: </label><input type="text" value="" name="name" /></div>
            <div><label>Phone number: </label><input type="text" value="" name="phone" /></div>
            <div><label>Address: </label><input type="text" value="" name="address" /></div>
            <div><label>Note: </label><textarea name="note" cols="50" rows="7" ></textarea></div>
            <input type="submit" name="order_click" value="Order" />
        </form>
    <?php }?>
</div>
</body>
</html>