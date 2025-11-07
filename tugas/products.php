<?php
require "koneksi.php";

$category = isset($_GET["category"]) ? $_GET["category"] : 0;
$query = "SELECT CategoryName from categories where CategoryID = $category";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
</head>
<body>
    <center>
        <h2>All <?= $data["CategoryName"] ?> PRODUCTS</h2>
        <a href="index.php">See All Categories</a> <br><br>
    </center>
    <table border="1" cellpadding="6" style="margin: auto;">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>PRICE</th>
        </tr>
        <?php
        $query = "SELECT ProductID, ProductName, UnitPrice from products where CategoryID = $category order by ProductID";
        $result = mysqli_query($koneksi, $query);
        while($data = mysqli_fetch_assoc($result)){;
        ?>
        <tr>
            <td style="text-align:center;"><?= $data["ProductID"] ?></td>
            <td><a href="detail.php?id=<?= $data["ProductID"] ?>"><?= $data["ProductName"] ?></a></td>
            <td style="text-align:center;"><?= $data["UnitPrice"] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
