<?php
require "koneksi.php";
session_start();

if(!isset($_SESSION["cart"])){
    $_SESSION["cart"] = [];
}

if(isset($_POST["action"]) && $_POST["action"] == "add"){
    $ProductID = $_POST["ProductID"];
    $qty = $_POST["qty"];

    if(isset($_SESSION["cart"]["ProductID"])){
        $_SESSION["cart"]["$ProductID"] += $qty;
    } else {
        $_SESSION["cart"]["$ProductID"] = $qty;
    }
    header("location:cart.php");
}

if(isset($_GET["action"]) && $_GET["action"] == "remove"){
    $ProductID = $_GET["id"];
    unset($_SESSION["cart"][$ProductID]);
    header("location:cart.php");
}

if (isset($_GET["action"]) && $_GET["action"] == "clear") {
    $_SESSION["cart"] = [];
    header("location:cart.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <center>
        <h2>Shopping Cart</h2>
        <a href="index.php">Add Another Cart</a><br><br>
    </center>
    <?php
    if(empty($_SESSION["cart"])){ ?>
        <p style="text-align:center;">Keranjang masih kosong.</p>
    <?php } else { ?>
        <table border="1" cellpadding="6" style="margin: auto;">
            <tr>
                <th>NO</th>
                <th>NAME</th>
                <th>PRICE</th>
                <th>MANY</th>
                <th>SUBTOTAL</th>
            </tr>
            <?php
            $total = 0;
            foreach($_SESSION["cart"] as $ProductID => $qty){
                $query = "SELECT ProductName, UnitPrice from products where ProductID = $ProductID";
            $result = mysqli_query($koneksi, $query);
            $data = mysqli_fetch_assoc($result);

            $subtotal = $data["UnitPrice"] * $qty;
            $total += $subtotal;
            ?>
            <tr>
                <td style="text-align:center;"><?= $ProductID ?></td>
                <td><?= $data["ProductName"] ?></td>
                <td style="text-align:center;">$<?= $data["UnitPrice"] ?></td>
                <td style="text-align:center;"><?= $qty ?></td>
                <td style="text-align:center;">$<?= $subtotal ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="4" style="text-align:center"><b>TOTAL</b></td>
                <td><b>$<?= $total ?></b></td>
            </tr>
        </table>
        <p style="text-align:center;"> 
            <a href="cart.php?action=clear" onclick="return confirm('Kosongkan keranjang?')">Kosongkan Keranjang</a>
        </p>
    <?php } ?>
</body>
</html>
