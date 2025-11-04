<?php
require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kagetori</title>
</head>
<body>
    <center>
        <h2>ALL CATEGORIES</h2>
        <a href="cart.php">See All Shopping Cart</a><br><br>
    </center>
    <table border="1" cellpadding="6" style="margin: auto;">
        <tr>
            <th>NO</th>
            <th>NAME</th>
            <th>DESCRIPTION</th>
            <th>MANY</th>
        </tr>
        <?php
        $query = "SELECT CategoryID, CategoryName, Description from categories order by CategoryID";
        $result = mysqli_query($koneksi, $query);
        $no = 1;

        while($data = mysqli_fetch_assoc($result)){
            $queryCount = "SELECT count(*) as jumlah from products where CategoryID = ".$data["CategoryID"];
            $resultCount = mysqli_query($koneksi, $queryCount);
            $jumlah = mysqli_fetch_assoc($resultCount);
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data["CategoryName"] ?></td>
            <td><?= $data["Description"] ?></td>
            <td>
                <a href="products.php?category=<?= $data["CategoryID"] ?>"> <?= $jumlah["jumlah"] ?> Products</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>