<?php
// Establish database connection for supplier information
$supplier_connection = mysqli_connect("localhost", "root", "", "reg");

// Check if connection was successful
if (!$supplier_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch supplier information
$supplier_query = "SELECT * FROM registration WHERE roles = 'm'";

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
    <title>Order here for manufacturer</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="">Order here</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        
        </form>
        <!-- Navbar-->
       
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">GO BACK</div>
                        <a class="nav-link" href="retailer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            BACK TO RETAILER 
                        </a>
                       
                       
                    </div>
                </div>
               
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Order here</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"></li>
                    </ol>
                    <!-- Supplier Information Table -->
                    <div>
                      
                            </tbody>
                        </table>
                    </div>
                    <!-- Product Information Table -->
                    <div>
                        <h2>Product Information of the manufacturer</h2>
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
                    <!-- Order Form -->
                    
                    <div>
    <h2>Order Form</h2>
    <form action="submitorderforRetailer.php" method="POST">
        <div style="display: flex; justify-content: space-between;">
            <!-- Customer Information -->
            <div style="width: 45%;">
                <h3>Retailer Information:</h3>
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="phone">Phone Number:</label><br>
                <input type="text" id="phone" name="phone" required><br><br>

                <label for="shipping_address">Shipping Address:</label><br>
                <textarea id="shipping_address" name="shipping_address" required></textarea><br><br>
            </div>

            <!-- Order Details -->
            <div style="width: 45%;">
                <h3>Order Details:</h3>
                <label for="item">Item:</label><br>
                <input type="text" id="item" name="item" required><br><br>

                <label for="quantity">Quantity:</label><br>
                <input type="number" id="quantity" name="quantity" required><br><br>

                <label for="gender">Gender:</label><br>
                <input type="text" id="gender" name="gender"><br><br>

                <label for="size">Size:</label><br>
                <input type="text" id="size" name="size"><br><br>

               
            </div>
        </div>

        <div style="display: flex; justify-content: space-between;">
            <!-- Payment Information -->
            <div style="width: 45%;">
                <h3></h3>
                <!-- Please choose a payment method -->
                <h3>Payment Information:</h3>
<label for="payment_method">Payment Method:</label><br>
<label for="credit_card" class="radio-inline">
    <input type="radio" name="payment_method" value="C" id="credit_card" required> Credit Card
</label><br>
<label for="debit_card" class="radio-inline">
    <input type="radio" name="payment_method" value="D" id="debit_card" required> Debit Card
</label><br>
<label for="paypal" class="radio-inline">
    <input type="radio" name="payment_method" value="P" id="paypal" required> PayPal
</label><br>
<label for="bank_transfer" class="radio-inline">
    <input type="radio" name="payment_method" value="B" id="bank_transfer" required> Bank Transfer
</label><br><br>

                <!-- Credit Card Information -->
                <div id="credit_card_info">
                    <label for="card_number">Card Number:</label><br>
                    <input type="text" id="card_number" name="card_number"><br><br>
                    <label for="expiration_date">Expiration Date:</label><br>
<input type="text" id="expiration_date" name="expiration_date" value="<?php echo (''); ?>" placeholder="YYYY-MM-DD" oninput="clearDate(this)"><br><br>

<script>
function clearDate(input) {
    var dateValue = input.value;
    if (dateValue === 'YYYY-MM-DD') {
        input.value = '';
    }
}
</script>

                    <label for="cvv">CVV/CVC:</label><br>
                    <input type="text" id="cvv" name="cvv"><br><br>
                </div>
            </div>

            <!-- Shipping Method -->
            <div style="width: 45%;">
            <h3>Shipping Method:</h3>
<label for="standard_shipping" class="radio-inline">
    <input type="radio" name="shipping_method" value="S" id="standard_shipping" required> Standard Shipping
</label><br>
<label for="express_shipping" class="radio-inline">
    <input type="radio" name="shipping_method" value="E" id="express_shipping" required> Express Shipping
</label><br><br>
            </div>
        </div>


                          

                            <!-- Submit Button -->
                            <input type="submit" value="Submit Order">
                        </form>
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
