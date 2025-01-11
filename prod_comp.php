<?php
    session_start();
    include_once 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Comparison</title>
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
            <h4 class="my-1">Product Comparison</h4>
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
                    <a href="distributors.php" class="nav-link text-white">
                    <i class="fa-solid fa-users me-2" width="16" height="16"></i>
                    Distributors
                    </a>
                </li>
                <li>
                    <a href="prod_comp.php" class="nav-link active" aria-current="page">
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

                <div class="table-responsive fs-6" style="width:100%;">
                    <table id="userTable" class="table table-hover">
                        <thead>
                            <tr role="row">
                                <th>Specification</th>
                                <th>Product 1</th>
                                <th>Product 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
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