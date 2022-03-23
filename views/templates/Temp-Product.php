<?php include_once(TEMP_PATH_HEADER); ?>

<!--========== CONTENTS ==========-->
<main>

    <section>

        <?php
        $html_oprn_value = null;
        if (isset($html_oprn)) {
            $html_oprn_value = $html_oprn;
        }
        ?>

        <input type="radio" class="" name="sub-page" id="option1" value="add" autocomplete="off" <?php
                                                                                                    if ($html_oprn_value == 'add') {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                    ?>>
        <label class="" for="option1">Add</label>

        <input type="radio" class="" name="sub-page" id="option2" value="update" autocomplete="off" <?php
                                                                                                    if ($html_oprn_value == 'update') {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                    ?>>
        <label class="" for="option2">Update</label>

        <input type="radio" class="" name="sub-page" id="option4" value="delete" autocomplete="off" <?php
                                                                                                    if ($html_oprn_value == 'delete') {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                    ?>>
        <label class="" for="option4">Delete</label>
    </section>

    <section id="reqform">
    </section>
</main>

<!--========== MAIN JS ==========-->

<script>
    $(document).ready(function() {

        var getPageValue = document.querySelector('input[name="sub-page"]:checked').value;

        if (getPageValue) {
            load(getPageValue);
        }

        $('input[name=sub-page]').on('change', function() {
            alert(1);
            var getPageValue = document.querySelector('input[name="sub-page"]:checked').value;
            load(getPageValue);
        });

    });

    function load(view) {
        $("#reqform").load("/product/form-" + view);
    }
</script>
<?php include_once(TEMP_PATH_FOOTER); ?>