<?php
session_start();
include_once 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/searchbuilder/1.8.1/css/searchBuilder.dataTables.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
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
                    <a href="products.php" class="nav-link text-white">
                    <i class="fa-solid fa-laptop me-2" width="16" height="16"></i>
                    Products
                    </a>
                </li>
                <li>
                    <a href="distributors.php" class="nav-link active" aria-current="page">
                    <i class="fa-solid fa-users me-2" width="16" height="16"></i>
                    Distributors
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
            <!-- <div class="content ms-2"> -->
            <div>
                <?php
                    if (isset($_SESSION['notif'])){
                        echo $_SESSION['notif'];
                        unset($_SESSION['notif']);
                    }
                ?>

                <div class="text-end mb-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Distributor</button>
                </div>

                <div class="table-responsive fs-6" style="width:100%;">
                    <table id="userTable" class="table table-hover">
                        <thead>
                            <tr role="row">
                                <th>Distributor ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Products</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $distrib = mysqli_query($conn, "SELECT * FROM distributors");
                                while($row = mysqli_fetch_assoc($distrib)){
                            ?>
                                <tr class="my-auto">
                                    <td><?php echo $row['dist_id'] ?></td>
                                    <td><?php echo $row['dist_name'] ?></td>
                                    <td><a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a></td>
                                    <td><a href="tel:+<?php echo $row['phone'] ?>"><?php echo $row['phone'] ?></a></td>
                                    <td><?php echo $row['address'] ?></td>
                                    <td><?php echo $row['products'] ?></td>
                                    <td class="d-flex">
                                        <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['dist_id'] ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['dist_id'] ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Add Modal -->
                                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Distributor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="">                           
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="addDistName" class="form-control rounded-3" id="distName" placeholder="" required>
                                                        <label for="distName">Name</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="email" name="addEmail" class="form-control rounded-3" id="email" placeholder="" required>
                                                        <label for="email">Email</label>
                                                    </div>                           
                                                    <div class="form-floating mb-3">
                                                        <input type="tel" name="addPhone" class="form-control rounded-3" id="phone" placeholder="" required>
                                                        <label for="phone">Phone</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="addAddress" class="form-control rounded-3" id="address" placeholder="" required>
                                                        <label for="address">Address</label>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" name="addDistrib" value="Save">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal<?php echo $row['dist_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo $row['dist_name'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="">
                                                    <input type="hidden" class="form-control" name="del_id" value="<?php echo $row['dist_id'] ?>">                            
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="editCompName" class="form-control rounded-3" id="compName" value="<?php echo $row['dist_name'] ?>" required>
                                                        <label for="compName">Company Name</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="editAddress" class="form-control rounded-3" id="address" value="<?php echo $row['address'] ?>" required>
                                                        <label for="address">Address</label>
                                                    </div>                            
                                                    <div class="form-floating mb-3">
                                                        <input type="tel" name="editPhone" class="form-control rounded-3" id="phone" value="<?php echo $row['phone'] ?>" required>
                                                        <label for="phone">Price</label>
                                                    </div>                            
                                                    <div class="form-floating mb-3">
                                                        <input type="email  " name="editEmail" class="form-control rounded-3" id="email" value="<?php echo $row['email'] ?>" required>
                                                        <label for="email">Email</label>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" name="deleteItem" value="Save">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $row['dist_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $row['dist_name'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="">
                                                    <input type="hidden" class="form-control" name="del_id" value="<?php echo $row['dist_id'] ?>">
                                                    <p>Do you want to remove <?php echo $row['dist_name'] ?> from the list?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-danger" name="deleteItem" value="Delete Item">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/05d9027216.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/searchbuilder/1.8.1/js/dataTables.searchBuilder.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</body>
</html>