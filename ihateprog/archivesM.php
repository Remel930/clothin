<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Archives for manufacturer</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="">Archives</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="manufacturer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            go back to manufacturer
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    manufacturer
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php
                    // Handle archive action
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["archive"])) {
                        $archived_ids = $_POST["archive"];
                        
                        // Establish database connection for archived notifications
                        $archive_connection = mysqli_connect("localhost", "root", "", "orderformanu");

                        // Check if connection was successful
                        if (!$archive_connection) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        foreach ($archived_ids as $transaction_id) {
                            // Fetch the transaction details
                            $fetch_query = "SELECT * FROM manuorders WHERE id = '$transaction_id'";
                            $fetch_result = mysqli_query($archive_connection, $fetch_query);
                            $row_transaction = mysqli_fetch_assoc($fetch_result);

                            // Insert archived notification
                            if ($row_transaction) {
                                $insert_query = "INSERT INTO archives_notification (name, order_date, shipping_method) VALUES ('{$row_transaction['name']}', '{$row_transaction['order_date']}', '{$row_transaction['shipping_method']}')";
                                mysqli_query($archive_connection, $insert_query);
                            }
                        }

                        // Close database connection
                        mysqli_close($archive_connection);
                        
                        header("Location: archivesM.php");
                        exit();
                    }

                    // Establish database connection for transaction history
                    $transaction_connection = mysqli_connect("localhost", "root", "", "orderformanu");

                    // Check if connection was successful
                    if (!$transaction_connection) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    if (isset($_GET['ids']) && !empty($_GET['ids'])) {
                        $archived_ids = explode(",", $_GET['ids']);
                        
                        echo "<h1>Archived Notifications</h1>";
                        echo "<ul>";
                        
                        foreach ($archived_ids as $transaction_id) {
                            // Fetch the transaction details
                            $fetch_query = "SELECT * FROM archives_notification WHERE id = '$transaction_id'";
                            $fetch_result = mysqli_query($transaction_connection, $fetch_query);
                            $row_transaction = mysqli_fetch_assoc($fetch_result);

                            // Display the archived notification
                            if ($row_transaction) {
                                echo "<li>";
                                echo $row_transaction['name'] . ", your order placed on " . $row_transaction['order_date'] . " with " . $row_transaction['shipping_method'] . " has been archived.";
                                echo "</li>";
                            }
                        }
                        
                        echo "</ul>";
                    } else {
                        echo "<h1>No Archived Notifications</h1>";
                    }

                    // Close database connection
                    mysqli_close($transaction_connection);
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
</body>
</html>
