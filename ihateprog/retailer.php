<?php
// Establish database connection for supplier information
$supplier_connection = mysqli_connect("localhost", "root", "", "reg");

// Check if connection was successful
if (!$supplier_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch supplier information
$supplier_query = "SELECT * FROM registration WHERE roles = 'r'";

// Perform the query
$supplier_result = mysqli_query($supplier_connection, $supplier_query);

// Check if query was successful
if (!$supplier_result) {
    die("Database query failed: " . mysqli_error($supplier_connection));
}

// Establish database connection for transaction history
$transaction_connection = mysqli_connect("localhost", "root", "", "orderforretailer");

// Check if connection was successful
if (!$transaction_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to calculate estimated delivery date
function calculateDeliveryDate($shippingMethod) {
    $today = new DateTime();
    $deliveryDate = clone $today;

    if ($shippingMethod === 'E') {
        // Express shipping (3 days)
        $deliveryDate->modify('+3 days');
    } else {
        // Standard shipping (5 days)
        $deliveryDate->modify('+5 days');
    }

    return $deliveryDate->format('Y-m-d');
}
// Query to fetch transaction history where delivery_status is "delivered"
$transaction_query = "SELECT * FROM retailerorders WHERE status = 'delivered'";

// Perform the query
$transaction_result = mysqli_query($transaction_connection, $transaction_query);

// Check if query was successful
if (!$transaction_result) {
    die("Database query failed: " . mysqli_error($transaction_connection));
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
        <title>Retailer</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">Retailer</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
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
                            <a class="nav-link" href="retailer.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">       
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">transaction history/receipt/order</div>
                            <a class="nav-link" href="transactionhistoryR.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Transaction history
                            </a>
                            <a class="nav-link" href="receiptR.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                receipt
                            </a>
                            <a class="nav-link" href="orderR.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                order here
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Retailer
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
                        <div>
                        <h2>Retailer Information</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Retailer Name</th>
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
                    <!-- Notification Panel -->
                    <div class="notification-panel">
                        <form method="post" action="update stats D.php"> <!-- Corrected the file name -->
                            <h2>Notification Panel</h2>
                            <ul id="notification-list">
                                <?php
                                while ($row_transaction = mysqli_fetch_assoc($transaction_result)) {
                                    $transaction_id = $row_transaction['id'];
                                    $manufacturer_name = $row_transaction['name'];
                                    $order_date = $row_transaction['order_date'];
                                    $shipping_method = $row_transaction['shipping_method'];

                                    // Calculate delivery date based on shipping method
                                    $delivery_date = calculateDeliveryDate($shipping_method);

                                    echo "<li>";
                                    echo "<input type='checkbox' name='notification_ids[]' value='$transaction_id'>"; // Checkbox
                                    echo "$manufacturer_name, your order placed on $order_date with $shipping_method will arrive on $delivery_date.";
                                    echo "</li>";
                                }
                                ?>
                            </ul>
                            <button type="submit" class="btn btn-primary">order arrived</button> <!-- Submit button -->
                        </form>
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

<?php
// Release the returned data
mysqli_free_result($supplier_result);
mysqli_free_result($product_result);
mysqli_free_result($transaction_result);

// Close database connections
mysqli_close($supplier_connection);
mysqli_close($product_connection);
mysqli_close($transaction_connection);
?>