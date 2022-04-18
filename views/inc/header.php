<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
            if (isset($html_pageTitle)) {
                echo $html_pageTitle;
            }
            ?></title>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->

    <!-- load jquery -->
    <script src="resources/js/jquery-3.6.0.min.js"></script>

    <!-- load bootstrap-css -->
    <link rel="stylesheet" href="resources/bootstrap.min.css">
    <!-- load bootstrap-js -->
    <script src="resources/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="resources/css/style.css">

    <script>
        // function myPrint(myform) {
        //     var printdata = document.getElementById(myform);
        //     newwin = window.open("");
        //     newwin.document.write(printdata.outerHTML);
        //     newwin.print();
        //     newwin.close();
        // }

        function myPrint() {
            var divToPrint = document.getElementById('table');
            var htmlToPrint = '' +
                '<style type="text/css">' +
                'table th, table td {' +
                'border:1px solid #000;' +
                'padding;0.5em;' +
                '}' +
                '</style>';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write(htmlToPrint);
            newWin.print();
            newWin.close();
        }
    </script>

    <style>
        main {
            margin-left: 68px;
        }

        .main-header {
            display: flex;
            justify-content: end;
            margin: 10px 16px;
        }

        .cus-btn {
            display: flex;
            align-items: center;
            background: none;
            border: 0;
            padding: 12px;
            border-radius: 50%;
            transition: 0.8s ease;
        }

        .cus-btn:hover {
            background-color: #F4F0FA;
            color: #121212;
            box-shadow: 5px 2px 12px #ccc;
        }

        .left-panel,
        .right-panel {
            width: 100%;
            padding: 18px 16px;
            background-color: #FFFFFF;
            border-radius: 10px;
            /* box-shadow: 2px 2px 6px #121212; */
            margin: 5px;
            min-height: 300px;
        }

        .alert-message {
            width: 100%;
            background-color: #d6d8d9;
            color: #121212;
            padding: 12px 16px;
            border-radius: 5px;
            border: 1px solid #c6c8ca;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table {
            border-bottom: 1px solid #6923D0;
        }

        .tr {
            color: #6923D0;
            text-transform: capitalize;
        }

        .table th {
            max-width: 50em;
        }

        .table-desc {
            border: 0;
            text-align: left;
            background-color: inherit;
        }

        .search-result {
            width: 50%;
            background-color: #ffffff;
            border-radius: 5px;
            position: absolute;
            box-shadow: 2px 2px 6px #000;
        }

        .search-result button {
            width: 100%;
            padding: 5px;
            background: none;
            border: 0;
            text-align: left;
        }

        .search-result button:hover {
            background-color: #d6d8d9;
        }
    </style>

</head>

<body>
    <!--========== HEADER ==========-->
    <header class="header">
        <div class="header__container">
            <img src="#" alt="" class="header__img">

            <a href="#" class="header__logo">Globe</a>

            <div class="header__search">
                <input type="search" placeholder="Search" class="header__input">
                <i class='bx bx-search header__icon'></i>
            </div>

            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
        </div>
    </header>

    <!--========== NAV ==========-->
    <div class="nav" id="navbar">
        <nav class="nav__container">
            <div>
                <a href="#" class="nav__link nav__logo">
                    <i class='bx bxs-disc nav__icon'></i>
                    <span class="nav__logo-name">Globe</span>
                </a>

                <div class="nav__list">
                    <div class="nav__items">
                        <h3 class="nav__subtitle">
                            <?php
                            if (isset($_SESSION['username'])) {
                                echo $_SESSION['username'];
                            }
                            ?>
                        </h3>

                        <a href="<?= BASE_DIR; ?>" class="nav__link active">
                            <i class='bx bx-home nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>

                        <div class="nav__dropdown">
                            <a href="/glass/public/product?page=1" class="nav__link">
                                <i class='bx bx-user nav__icon'></i>
                                <span class="nav__name">Product</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="/glass/public/product/form-add" class="nav__dropdown-item">Add-Product</a>
                                    <a href="/glass/public/product/form-update" class="nav__dropdown-item">Update-Product</a>
                                    <a href="/glass/public/product/form-delete" class="nav__dropdown-item">Remove-Product</a>
                                </div>
                            </div>
                        </div>

                        <div class="nav__dropdown">
                            <a href="/glass/public/process?page=1" class="nav__link">
                                <i class='bx bx-user nav__icon'></i>
                                <span class="nav__name">Process</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="/glass/public/process/form-add" class="nav__dropdown-item">Add-Process</a>
                                    <a href="/glass/public/process/form-update" class="nav__dropdown-item">Update-Process</a>
                                    <a href="/glass/public/process/form-delete" class="nav__dropdown-item">Remove-Process</a>
                                </div>
                            </div>
                        </div>

                        <div class="nav__dropdown">
                            <a href="/glass/public/hardware?page=1" class="nav__link">
                                <i class='bx bx-user nav__icon'></i>
                                <span class="nav__name">Hardware</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="/glass/public/hardware/form-add" class="nav__dropdown-item">Add-Hardware</a>
                                    <a href="/glass/public/hardware/form-update" class="nav__dropdown-item">Update-Hardware</a>
                                    <a href="/glass/public/hardware/form-delete" class="nav__dropdown-item">Remove-Hardware</a>
                                </div>
                            </div>
                        </div>

                        <a href="<?= BASE_DIR; ?>/quotes" class="nav__link">
                            <i class='bx bx-message-rounded nav__icon'></i>
                            <span class="nav__name">Quotation's</span>
                        </a>
                        <a href="<?= BASE_DIR; ?>/challan?page=1" class="nav__link">
                            <i class='bx bx-message-rounded nav__icon'></i>
                            <span class="nav__name">Challan</span>
                        </a>

                        <div class="nav__dropdown">
                            <a href="/glass/public/customer?page=1" class="nav__link">
                                <i class='bx bx-user nav__icon'></i>
                                <span class="nav__name">customer</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="/glass/public/customer/form-add" class="nav__dropdown-item">Add-customer</a>
                                    <a href="/glass/public/customer/form-update" class="nav__dropdown-item">Update-customer</a>
                                    <a href="/glass/public/customer/form-delete" class="nav__dropdown-item">Remove-customer</a>
                                </div>
                            </div>
                        </div>

                        <div class="nav__dropdown">
                            <a href="<?= BASE_DIR; ?>/invoice" class="nav__link">
                                <i class='bx bx-user nav__icon'></i>
                                <span class="nav__name">Bill/Invoice</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="<?= BASE_DIR; ?>/invoice/gen-bill" class="nav__dropdown-item">Generate-Bill</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nav__items">
                        <h3 class="nav__subtitle">Menu</h3>

                        <div class="nav__dropdown">
                            <a href="#" class="nav__link">
                                <i class='bx bx-bell nav__icon'></i>
                                <span class="nav__name">Notifications</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="#" class="nav__dropdown-item">Blocked</a>
                                    <a href="#" class="nav__dropdown-item">Silenced</a>
                                    <a href="#" class="nav__dropdown-item">Publish</a>
                                    <a href="#" class="nav__dropdown-item">Program</a>
                                </div>
                            </div>

                        </div>

                        <a href="#" class="nav__link">
                            <i class='bx bx-compass nav__icon'></i>
                            <span class="nav__name">Explore</span>
                        </a>
                        <a href="#" class="nav__link">
                            <i class='bx bx-bookmark nav__icon'></i>
                            <span class="nav__name">Saved</span>
                        </a>
                    </div>
                </div>
            </div>

            <a href="/glass/public/logout" class="nav__link nav__logout">
                <i class='bx bx-log-out nav__icon'></i>
                <span class="nav__name">Log Out</span>
            </a>

            <!-- <form action="/glass/public/logout" method="post">
                <input type="submit" value="Logout">
            </form> -->
        </nav>
    </div>