<?php
// Establish database connection for supplier information
$supplier_connection = mysqli_connect("localhost", "root", "", "reg");

// Check if connection was successful
if (!$supplier_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch supplier information
$supplier_query = "SELECT * FROM registration WHERE roles = 's'";

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
$product_query = "SELECT * FROM clothessup ORDER BY items ASC, sizes ASC";

// Perform the query
$product_result = mysqli_query($product_connection, $product_query);

// Check if query was successful
if (!$product_result) {
    die("Database query failed: " . mysqli_error($product_connection));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $stocks = $_POST['stocks'];
    $availability = $_POST['availability'];

    // Update stocks and availability in the database
    $update_query = "UPDATE clothessup SET stocks='$stocks', productlevel='$availability' WHERE id='$id'";
    $update_result = mysqli_query($product_connection, $update_query);

    if (!$update_result) {
        echo "Failed to update data: " . mysqli_error($product_connection);
    }
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
    <title>Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="">Welcome Supplier</a>
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
                    <li><hr class="dropdown-divider" /></li>
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
                        <a class="nav-link" href="supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Add product</div>
                        <a class="nav-link" href="product.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Add product
                        </a>
                        <div class="sb-sidenav-menu-heading">receive purchase order</div>
                        <a class="nav-link" href="receive ordersup.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            receive purchase order
                        </a>
                        <div class="sb-sidenav-menu-heading">transaction history</div>
                        <a class="nav-link" href="transactionhistoryS.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            transaction history
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                   supplier
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"></li>
                    </ol>
                    <!-- Supplier Information Table -->
                    <div>
                        <h2>Supplier Information</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Supplier Name</th>
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
                    </div>
                    <!-- Product Information Table -->
                    <div>
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
                                    <th>Action</th>
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
                                    echo "<td>";
                                    echo "<form method='post' action=''>"; // Form for updating stocks and availability
                                    echo "<input type='hidden' name='id' value='" . $row_product['id'] . "'>";
                                    echo "<input type='number' name='stocks' placeholder='Stocks' required>";
                                    echo "<select name='availability' required>"; // Dropdown for availability
                                    echo "<option value='No Stocks'>No Stocks</option>";
                                    echo "<option value='Low'>Low</option>";
                                    echo "<option value='Medium'>Medium</option>";
                                    echo "<option value='High'>High</option>";
                                    echo "</select>";
                                    echo "<button type='submit'>Update</button>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
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

<?php
// Release the returned data
mysqli_free_result($supplier_result);
mysqli_free_result($product_result);

// Close database connections
mysqli_close($supplier_connection);
mysqli_close($product_connection);
?>
