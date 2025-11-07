<?php
require "koneksi.php";
session_start();

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$query = "SELECT p.*, s.CompanyName, c.CategoryName
          from products p
          join suppliers s on p.SupplierID = s.SupplierID 
          join categories c on p.CategoryID = c.CategoryID
          where p.ProductID = $id";
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
            <td><b>ID</b></td>
            <td>: <?= $data["ProductID"] ?></td>
        </tr>
        <tr>
            <td><b>Name</b></td>
            <td>: <?= $data["ProductName"] ?></td>
        </tr>
        <tr>
            <td><b>Supplier</b></td>
            <td>: <?= $data["CompanyName"] ?></td>
        </tr>
        <tr>
            <td><b>Category ID</b></td>
            <td>: <?= $data["CategoryName"] ?></td>
        </tr>
        <tr>
            <td><b>Quantity Per Unit</b></td>
            <td>: <?= $data["QuantityPerUnit"] ?></td>
        </tr>
        <tr>
            <td><b>Price Per Unit</b></td>
            <td>: $<?= $data["UnitPrice"] ?></td>
        </tr>
        <tr>
            <td><b>Unit In Stock</b></td>
            <td>: <?= $data["UnitsInStock"] ?></td>
        </tr>
        <tr>
            <td><b>Unit On Order</b></td>
            <td>: <?= $data["UnitsOnOrder"] ?></td>
        </tr>
        <tr>
            <td><b>Reorder Level</b></td>
            <td>: <?= $data["ReorderLevel"] ?></td>
        </tr>
        <tr>
            <td><b>Status</b></td>
            <td>: <?= $data["Discontinued"] == 0 ? "Continue" : "Discontinued" ?></td>
        </tr>
    </table>
    <form action="cart.php" method="POST">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="ProductID" value="<?= $data["ProductID"] ?>">
        <label><b>Many Unit Add to Cart</b></label>
        <input type="number" name="qty" min="1" value="1">
        <button type="submit">Add</button>
    </form>
</body>
</html>
