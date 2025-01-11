<?php
    session_start();
    include_once 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/searchbuilder/1.8.1/css/searchBuilder.dataTables.min.css" rel="stylesheet">
</head>
<body>    
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink-0 p-3 me-4 text-white bg-dark" style="width: 280px; height: 100vh;">
            <h2 class="my-1">Portal</h2>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="home.php" class="nav-link text-white">
                    <i class="fa-solid fa-house me-2" width="16" height="16"></i>
                    Home
                    </a>
                </li>
                <li>
                    <a href="products.php" class="nav-link active" aria-current="page">
                    <i class="fa-solid fa-laptop me-2" width="16" height="16"></i>
                    Products
                    </a>
                </li>
                <li>
                    <a href="distributors.php" class="nav-link text-white">
                    <i class="fa-solid fa-users me-2" width="16" height="16"></i>
                    Distributors
                    </a>
                </li>
                <li>
                    <a href="prod_comp.php" class="nav-link text-white">
                    <i class="fa-solid fa-users me-2" width="16" height="16"></i>
                    Product Comparison
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-circle-user fa-xl me-2"></i>
                    <strong>Admin</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small my-auto shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>

        <div class="container py-3">
            <div>
                <?php
                    if (isset($_SESSION['notif'])){
                        echo $_SESSION['notif'];
                        unset($_SESSION['notif']);
                    }
                ?>

                <div class="text-end mb-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Products</button>
                </div>

                <div class="table-responsive fs-6" style="width:100%;">
                    <table id="userTable" class="table table-hover">
                        <thead>
                            <tr role="row">
                                <th>Product ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Warranty</th>
                                <th>Specs</th>
                                <th>Mfr Price</th>
                                <th>Rsr Price</th>
                                <th>Stock Qty</th>
                                <th>Dist's Contact</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $products = mysqli_query($conn, "SELECT * FROM products AS pd JOIN distributors AS db ON pd.dist_id = db.dist_id;");
                                while($row = mysqli_fetch_assoc($products)){
                            ?>
                                <tr class="my-auto">
                                    <td><?php echo $row['prod_id'] ?></td>
                                    <td><?php echo $row['prod_name'] ?></td>
                                    <td><?php echo $row['categ'] ?></td>
                                    <td><?php echo $row['warr'] ?></td>
                                    <td>
                                        <a class="mx-auto" href="#">
                                            <button type="button" class="btn btn-info">
                                                <i class="fa-solid fa-circle-info" style="color: white;"></i>
                                            </button>
                                        </a>
                                    </td>
                                    <td><?php echo $row['mfr_price'] ?></td>
                                    <td><?php echo $row['rsr_price'] ?></td>
                                    <td><?php echo $row['stock_qty'] ?></td>
                                    <td><?php echo $row['dist_name'] . "<br>" . $row['email'] . "<br>" . $row['phone'] . "<br>" . $row['address'] ?></td>
                                    <td><?php //echo $row['status'] ?></td>
                                    <td class="d-flex align-items-center">
                                        <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['prod_id'] ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['prod_id'] ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Add Modal -->
                                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="width: 100rem;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="" method="POST" action="">
                                                    <h6 class="mb-3">Basic Details</h6>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="addName" class="form-control rounded-3" id="name" placeholder="" required>
                                                        <label for="name">Name</label>
                                                    </div> 
                                                    <select class="form-floating form-select mb-3" id="inputGroupSelect01">
                                                        <option selected="">Categories</option>
                                                        <?php
                                                            $query = mysqli_query($conn, "SELECT * FROM categories");
                                                            while($row = mysqli_fetch_assoc($query)) {
                                                        ?>
                                                        <option value="<?php echo range(1,100) ?>" name="addCateg"><?php echo $row['categ_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="form-floating input-group mb-3">
                                                        <input type="number" name="addWarr" class="form-control" min="1" id="warr" placeholder="" aria-label="Warranty" aria-describedby="basic-addon2" required>
                                                        <span class="input-group-text" id="basic-addon2">Months</span>
                                                        <label for="warr">Warranty</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" name="addMfrPrice" class="form-control rounded-3" min="1" id="mfrPrice" placeholder="" required>
                                                        <label for="mfrPrice">Manufacturer Price</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" name="addRsrPrice" class="form-control rounded-3" min="1" id="rsrPrice" placeholder="" required>
                                                        <label for="rsrPrice">Reseller Price</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" name="addStockQty" class="form-control rounded-3" min="1" id="stock_qty" placeholder="" required>
                                                        <label for="stock_qty">Stock Quantity</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" name="addDistID" class="form-control rounded-3" id="dist_id" placeholder="" required>
                                                        <label for="dist_id">Distributor ID</label>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" name="addProduct" value="Save">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal<?php echo $row['prod_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="width: 100rem;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo $row['prod_name'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="" method="POST" action="">
                                                    <h6 class="mb-3">Basic Details</h6>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="editName" class="form-control rounded-3" id="name" value="<?php echo $row['prod_name'] ?>" placeholder="" required>
                                                        <label for="name">Name</label>
                                                    </div> 
                                                    <select class="form-floating form-select mb-3" id="inputGroupSelect01">
                                                        <option selected="">Categories</option>
                                                        <?php
                                                            $query = mysqli_query($conn, "SELECT * FROM categories");
                                                            while($row = mysqli_fetch_assoc($query)) {
                                                        ?>
                                                        <option value="<?php echo range(1,100) ?>" name="editCateg"><?php echo $row['categ_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="form-floating input-group mb-3">
                                                        <input type="number" name="editWarr" class="form-control" min="1" id="warr" placeholder="" aria-label="Warranty" aria-describedby="basic-addon2" required>
                                                        <span class="input-group-text" id="basic-addon2">Months</span>
                                                        <label for="warr">Warranty</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" name="editMfrPrice" class="form-control rounded-3" min="1" id="mfrPrice" placeholder="" required>
                                                        <label for="mfrPrice">Manufacturer Price</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" name="editRsrPrice" class="form-control rounded-3" min="1" id="rsrPrice" placeholder="" required>
                                                        <label for="rsrPrice">Reseller Price</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" name="editStockQty" class="form-control rounded-3" min="1" id="stock_qty" placeholder="" required>
                                                        <label for="stock_qty">Stock Quantity</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="number" name="editDistID" class="form-control rounded-3" id="dist_id" placeholder="" required>
                                                        <label for="dist_id">Distributor ID</label>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" name="editProduct" value="Save">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $row['prod_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $row['prod_name'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="">
                                                    <input type="hidden" class="form-control" name="del_id" value="<?php echo $row['prod_id'] ?>">
                                                    <p>Do you want to remove <?php echo $row['prod_name'] ?> from the list?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-danger" name="deleteProduct" value="Delete Product">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'process.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/05d9027216.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/searchbuilder/1.8.1/js/dataTables.searchBuilder.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</body>
</html>