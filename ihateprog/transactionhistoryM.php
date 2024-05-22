
<?php
$product_connection = mysqli_connect("localhost", "root", "", "orderformanu");

// Check if connection was successful
if (!$product_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch product information
$product_query = "SELECT * FROM manuorders";

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
    <title>transaction history</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">transaction history</a>
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
       
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Go back</div>
                        <a class="nav-link" href="manufacturer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Go back
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
                    <h1 class="mt-4">Transaction history</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"></li>
                    </ol>
                    <div>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
// Fetch and display product data row by row
while ($row_product = mysqli_fetch_assoc($product_result)) {
    // Extracting variables for easier access
    $name = $row_product['name'];
    $email = $row_product['email'];
    $phone = $row_product['phone'];
    $item = $row_product['item'];
    $quantity = $row_product['quantity'];
    $gender = $row_product['gender'];
    $size = $row_product['size'];
    $shipping_address = $row_product['shipping_address'];
    $payment_method = $row_product['payment_method'];
    $shipping_method = $row_product['shipping_method'];
    $order_date = $row_product['order_date']; // Retrieve order date from the database
    
    // Initialize total price for this order
    $total_price = 0;

    // Calculate total price based on item selection
    $total_price = 0;
    $price_per_item = 0;

    // Calculate total price based on item selection, size, and gender
    if ($item === 'Nike') {
        if ($size === 'xs') {
            if ($gender === 'f') {
                $price_per_item = 110;
            } elseif ($gender === 'm') {
                $price_per_item = 115;
            } else {
                // Handle other genders if needed
            }
        } elseif ($size === 's') {
            if ($gender === 'f') {
                $price_per_item = 170;
            } elseif ($gender === 'm') {
                $price_per_item = 180;
            } else {
                // Handle other genders if needed
            }
        } elseif ($size === 'm') {
            if ($gender === 'f') {
                $price_per_item = 250;
            } elseif ($gender === 'm') {
                $price_per_item = 280;
            } else {
                // Handle other genders if needed
            }
        } elseif ($size === 'l') {
            if ($gender === 'f') {
                $price_per_item = 300;
            } elseif ($gender === 'm') {
                $price_per_item = 320;
            } else {
                // Handle other genders if needed
            }
        } elseif ($size === 'xl') {
            if ($gender === 'f') {
                $price_per_item = 350;
            } elseif ($gender === 'm') {
                $price_per_item = 400;
            } else {
                // Handle other genders if needed
            }
        } else {
            // Handle other sizes if needed
        }
        $total_price += $quantity * $price_per_item;
    } elseif ($item === 'Shein') {
        if ($size === 'xs') {
            if ($gender === 'f') {
                $price_per_item = 150;
            } elseif ($gender === 'm') {
                $price_per_item = 175;
            } else {
                // Handle other genders if needed
            }
        } elseif ($size === 's') {
            if ($gender === 'f') {
                $price_per_item = 170;
            } elseif ($gender === 'm') {
                $price_per_item = 195;
            } else {
                // Handle other genders if needed
            }
        } elseif ($size === 'm') {
            if ($gender === 'f') {
                $price_per_item = 180;
            } elseif ($gender === 'm') {
                $price_per_item = 205;
            } else {
                // Handle other genders if needed
            }
        } elseif ($size === 'l') {
            if ($gender === 'f') {
                $price_per_item = 200;
            } elseif ($gender === 'm') {
                $price_per_item = 215;
            } else {
                // Handle other genders if needed
            }
        } elseif ($size === 'xl') {
            if ($gender === 'f') {
                $price_per_item = 210;
            } elseif ($gender === 'm') {
                $price_per_item = 230;
            } else {
                // Handle other genders if needed
            }
        } else {
            // Handle other sizes if needed
        }
        $total_price += $quantity * $price_per_item;
    } else {
        // Handle other items if needed
    }
    

    // Add additional charge for express shipping
    if ($shipping_method === 'E') {
        $total_price += 150; // Additional charge for express shipping
    }

    // Outputting the received order in sentence format
    echo "$name ($email and the manufacturer's phone number is: $phone) ordered $item, $quantity quantities, gender $gender, size $size. Shipping address: $shipping_address. The payment method is $payment_method, and the shipping method is $shipping_method.";

    // Adding the order date retrieved from the database
    echo " Order placed on: $order_date";

    // Display the total price for the order
    echo " Total Price: $total_price";

    echo "<br><br>";
}
?>




                        
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                           
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
