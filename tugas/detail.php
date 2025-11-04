<?php
require "koneksi.php";
session_start();

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$query = "SELECT*from products where ProductID = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

$category = $data["CategoryID"];

$queryCategory = "SELECT CategoryName from categories where CategoryID = $category";
$resultCategory = mysqli_query($koneksi, $queryCategory);
$categoryData = mysqli_fetch_assoc($resultCategory);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
</head>
<body>
    <center>
        <h2><?= $data["ProductName"] ?></h2>  
        <a href="products.php?category=<?= $category ?>">See All <?= $categoryData["CategoryName"] ?> Products</a> <br><br>
    </center>
    <table>
        <tr>
            <td><b>ID Produk</b></td>
            <td>: <?= $data["ProductID"] ?></td>
        </tr>
        <tr>
            <td><b>Supplier ID</b></td>
            <td>: <?= $data["SupplierID"] ?></td>
        </tr>
        <tr>
            <td><b>Category ID</b></td>
            <td>: <?= $data["CategoryID"] ?></td>
        </tr>
        <tr>
            <td><b>Quantity Per Unit</b></td>
            <td>: <?= $data["QuantityPerUnit"] ?></td>
        </tr>
        <tr>
            <td><b>Harga Per Unit</b></td>
            <td>: <?= $data["UnitPrice"] ?></td>
        </tr>
        <tr>
            <td><b>Units In Stock</b></td>
            <td>: <?= $data["UnitsInStock"] ?></td>
        </tr>
        <tr>
            <td><b>Units On Order</b></td>
            <td>: <?= $data["UnitsOnOrder"] ?></td>
        </tr>
        <tr>
            <td><b>Reorder Level</b></td>
            <td>: <?= $data["ReorderLevel"] ?></td>
        </tr>
    </table>
    <form action="cart.php" method="POST">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="ProductID" value="<?= $data["ProductID"] ?>">
        <label><b>Many Unit Add to Cart</b></label>
        <input type="number" name="qyt" min="1" value="1">
        <button type="submit">Add</button>
    </form>
</body>
</html>