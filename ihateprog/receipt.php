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
        <a class="navbar-brand ps-3" href="">receipts</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">GO BACK</div>
                        <a class="nav-link" href="manufacturer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            BACK TO MANUFACTURER
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
        <h2>RECEIPTS</h2>
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"></li>
                    </ol>
                    <!-- Display All Receipts -->
                    <?php
                    // Establish database connection
                    $conn = new mysqli('localhost', 'root', '', 'orderformanu');
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }

                    // Retrieve all orders from the database
                    $sql = "SELECT * FROM manuorders";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Loop through each order
                        while ($row = $result->fetch_assoc()) {
                            // Extract order details
                            $id = $row['id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                            $item = $row['item'];
                            $quantity = $row['quantity'];
                            $gender = $row['gender'];
                            $size = $row['size'];
                            $shipping_address = $row['shipping_address'];
                            $payment_method = $row['payment_method'];
                            $shipping_method = $row['shipping_method'];
                            $order_date = $row['order_date'];

                            // Initialize total price for this order
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

                            // Generate receipt for the current order
                            echo "
                                <div id='receipt$id' style='display: none;'>
                                    <h2>Receipt</h2>
                                    <p><strong>Customer Name:</strong> $name</p>
                                    <p><strong>Email:</strong> $email</p>
                                    <p><strong>Phone:</strong> $phone</p>
                                    <p><strong>Shipping Address:</strong> $shipping_address</p>
                                    <hr>
                                    <h3>Order Details</h3>
                                    <p><strong>Item:</strong> $item</p>
                                    <p><strong>Quantity:</strong> $quantity</p>
                                    <p><strong>Gender:</strong> $gender</p>
                                    <p><strong>Size:</strong> $size</p>
                                    <p><strong>Total Price:</strong> $total_price</p> <!-- Display total price -->
                                    <hr>
                                    <h3>Payment Information</h3>
                                    <p><strong>Payment Method:</strong> $payment_method</p>
                                    <h3>Shipping Information</h3>
                                    <p><strong>Shipping Method:</strong> $shipping_method</p>
                                    <hr>
                                    <p><strong>Order Date:</strong> $order_date</p>
                                    <hr>
                                </div>
                                <p><a href='javascript:void(0);' onclick='toggleReceipt(\"receipt$id\");'>$name</a></p>
                            ";
                        }
                    } else {
                        echo "No orders found.";
                    }

                    // Close database connection
                    $conn->close();
                    ?>
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
    <script>
        function toggleReceipt(id) {
            var receipt = document.getElementById(id);
            if (receipt.style.display === 'none') {
                receipt.style.display = 'block';
            } else {
                receipt.style.display = 'none';
            }
        }
    </script>
</body>
</html>
