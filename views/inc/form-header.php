<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- load jquery -->
    <script src="../resources/js/jquery-3.6.0.min.js"></script>

    <!-- load bootstrap-css -->
    <link rel="stylesheet" href="../resources/bootstrap.min.css">
    <!-- load bootstrap-js -->
    <script src="../resources/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="../resources/css/style.css">

    <style>
        main {
            margin-left: 68px;
        }
    </style>

    <style>
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
            background-color: #F4F0FA;
            border-radius: 15px;
            box-shadow: 2px 2px 6px #ccc;
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
        }

        .table th {
            max-width: 50em;
        }

        .active-page {
            background-color: #6923D0;
            color: #c6c8ca;
        }
    </style>

    <style>
        .search-result {
            display: flex;
            flex-direction: column;
            width: 50%;
            position: absolute;
            background-color: #ffffff;
            box-shadow: 2px 2px 8px #ccc;
            border-radius: 5px;
            transition: 2s ease;
        }

        .search-result button {
            margin: 5px;
            background: none;
            border: 0;
            text-align: left;
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
                        <h3 class="nav__subtitle">Globe</h3>

                        <a href="/" class="nav__link active">
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
                            <a href="/glass/public/product?page=1" class="nav__link">
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

                        <a href="<?=BASE_DIR;?>/process" class="nav__link">
                            <i class='bx bx-message-rounded nav__icon'></i>
                            <span class="nav__name">Process</span>
                        </a>
                        <a href="#" class="nav__link">
                            <i class='bx bx-message-rounded nav__icon'></i>
                            <span class="nav__name">Hardware</span>
                        </a>
                        <a href="<?=BASE_DIR;?>/quotes" class="nav__link">
                            <i class='bx bx-message-rounded nav__icon'></i>
                            <span class="nav__name">Quotation's</span>
                        </a>
                        <a href="<?=BASE_DIR;?>/challan" class="nav__link">
                            <i class='bx bx-message-rounded nav__icon'></i>
                            <span class="nav__name">Challan</span>
                        </a>
                        <a href="<?=BASE_DIR;?>/customer" class="nav__link">
                            <i class='bx bx-message-rounded nav__icon'></i>
                            <span class="nav__name">Customer</span>
                        </a>
                        <a href="<?=BASE_DIR;?>/invoice" class="nav__link">
                            <i class='bx bx-message-rounded nav__icon'></i>
                            <span class="nav__name">Bill/Invoice</span>
                        </a>
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

            <a href="#" class="nav__link nav__logout">
                <i class='bx bx-log-out nav__icon'></i>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>