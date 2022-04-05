<?php include_once(TEMP_PATH_HEADER); ?>

<!--========== CONTENTS ==========-->
<main>

    <?php
    if (isset($_SESSION['user']) === false) {
    ?>
        <h2>OOps!</h2>
        <h4>404 Not Found</h4>
        <p>Sorry, an error has occured, Requested page not found!</p>
        <a class="btn btn-primary" href="/glass/public/login">Access denied - Login required</a>
    <?php
    } else {
    ?>
        <h2>OOps!</h2>
        <h4>404 Not Found</h4>
        <p>Sorry, an error has occured, Requested page not found!</p>
        <a href="/glass/public">Go-home</a>
        <a href="#" onclick="history.back();">Go-back</a>
    <?php
    }
    ?>

</main>

<!--========== MAIN JS ==========-->

<?php include_once(TEMP_PATH_FOOTER); ?>