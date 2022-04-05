<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($html_pageTitle)) {
            echo $html_pageTitle;
        }
        ?>
    </title>

    <!-- load jquery -->
    <script src="resources/js/jquery-3.6.0.min.js"></script>

    <!-- load bootstrap-css -->
    <link rel="stylesheet" href="resources/bootstrap.min.css">
    <!-- load bootstrap-js -->
    <script src="resources/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="resources/css/style.css">

    <style>
        html,
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        main {
            /* display: flex;
            flex-direction: column;
            align-items: center; */
        }

        form {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 16px 0 #121212;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            display: flex;
            flex-direction: column;
            justify-items: center;
            padding: 15px 16px;
        }
    </style>
</head>

<body>
    <main class="container mt-4">
        <section>
            <h2 class="text-center">User-Login</h2>
        </section>
        <section>
            <form class="" action="<?= BASE_DIR; ?>/login" method="post">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                <input class="mt-4 btn btn-primary" type="submit" value="Login">
            </form>
        </section>
    </main>
</body>

</html>