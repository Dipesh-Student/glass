<?php include_once(TEMP_PATH_HEADER); ?>
<div>
    <?php
    $d = $param['d'];
    ?>
    layout<?= $d; ?>
</div>

<div>
    <form action="/hello/{123}/{200}" method="get">
        <input type="submit" value="submit">
    </form>
</div>
<?php include_once(TEMP_PATH_FOOTER); ?>