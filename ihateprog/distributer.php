<?php
// Establish database connection for supplier information
$supplier_connection = mysqli_connect("localhost", "root", "", "reg");

// Check if connection was successful
if (!$supplier_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch supplier information
$supplier_query = "SELECT * FROM registration WHERE roles = 'd'";

// Perform the query
$supplier_result = mysqli_query($supplier_connection, $supplier_query);

// Check if query was successful
if (!$supplier_result) {
    die("Database query failed: " . mysqli_error($supplier_connection));
}

// Establish database connection for product information
$product_connection = mysqli_connect("localhost", "root", "", "clothes");

// Check if connection was successful
if (!$product_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch product information with alphabetical ordering by 'Items' and 'Sizes'
$product_query = "SELECT * FROM clothesm ORDER BY items ASC, sizes ASC";

// Perform the query
$product_result = mysqli_query($product_connection, $product_query);

// Check if query was successful
if (!$product_result) {
    die("Database query failed: " . mysqli_error($product_connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Distributor</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="">Distributer</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                   
                    <li><a class="dropdown-item" href="login.html">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="distributer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                            </nav>
                        </div>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                           
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Transaction history and order tracking</div>
                        <a class="nav-link" href="transactionhistoryD.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Transaction history
                        </a>
                       
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Distributer
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">   
                    </ol>
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="mt-4">Distributor Information</h1>
                                <ol class="breadcrumb mb-4">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Distributor Name</th>
                                                <th>Role</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch and display supplier data row by row
                                            while ($row = mysqli_fetch_assoc($supplier_result)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
                                                echo "<td>" . $row['roles'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </ol>
                            </div>
                            <div class="col-md-6">
                                <!-- Product Information Table -->
                                <h2>Product Information</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Items</th>
                                            <th>Gender</th>
                                            <th>Sizes</th>
                                            <th>Cost</th>
                                            <th>Stocks</th>
                                            <th>Availability</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch and display product data row by row
                                        while ($row_product = mysqli_fetch_assoc($product_result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row_product['items'] . "</td>";
                                            echo "<td>" . $row_product['gender'] . "</td>";
                                            echo "<td>" . $row_product['sizes'] . "</td>";
                                            echo "<td>" . $row_product['cost'] . "</td>";
                                            echo "<td>" . $row_product['stocks'] . "</td>";
                                            echo "<td>" . $row_product['productlevel'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
