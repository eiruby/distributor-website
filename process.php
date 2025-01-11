<?php
require_once 'conn.php';

function sanitizeData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['addProduct'])) {
    $addName = sanitizeData($_POST['addName']);
    $addCateg = sanitizeData($_POST['addCateg']);
    $addWarr = sanitizeData($_POST['addWarr']);
    $addMfrPrice = sanitizeData($_POST['addMfrPrice']);
    $addRsrPrice = sanitizeData($_POST['addRsrPrice']);
    $addStockQty = sanitizeData($_POST['addStockQty']);
    $addDistrib = sanitizeData($_POST['addDistID']);

    $insert = mysqli_query($conn, "INSERT INTO products (prod_name, prod_categ, warr, mfr_price, rsr_price, stock_qty, dist_id) VALUES ('$addName', '$addCateg', '$addWarr', '$addMfrPrice', '$addRsrPrice', '$addStockQty', '$addDistrib')");

    if ($insert) {
        $_SESSION['notif'] = '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Record has been added.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
        echo "<script>location.href = 'products.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);

}

if(isset($_POST['addDistrib'])) {
    $addCompName = sanitizeData($_POST['addCompName']);
    $addAdddress = sanitizeData($_POST['addAddress']);
    $addPhone = sanitizeData($_POST['addPhone']);
    $addEmail = sanitizeData($_POST['addEmail']);

    $insert = mysqli_query($conn, "INSERT INTO distributors (comp_name, ddress, phone, email) VALUES ('$addCompName', '$addAddress', '$addPhone', '$addEmail')");

    if ($insert) {
        $_SESSION['notif'] = '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Record has been added.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
        echo "<script>location.href = 'distributors.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);

}
?>