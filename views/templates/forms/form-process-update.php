<?php include(FORM_HEADER); ?>

<main>
    <h3 class="text-center m-4">Update Process</h3>
    <div id="message">

    </div>
    <section>
        <div>

            <input type="text" class="form-control mt-4" name="search" id="search-process" placeholder="Search-Process" autocomplete="off">
            <div class="search-result" id="search-result">

            </div>
            <form id="form-update-process" action="<?= BASE_DIR; ?>/process/update">
                <input class="form-control mt-4" type="text" name="process-id" id="process-id" placeholder="Process Id" disabled required>
                <input class="form-control mt-2" type="text" name="process-name" placeholder="Process Name" required>
                <input class="form-control mt-2" type="number" step="0.01" name="process-rate" placeholder="Process Rate" required>
                <button class="btn btn-primary m-2" type="submit">Update</button>
                <button class="btn btn-secondary" type="reset">Delete</button>
            </form>
        </div>
    </section>
</main>
<script>
    $(document).ready(function() {

        $("#search-process").keyup(function() {
            var search_key = $("#search-process").val();
            var search_result = $('#search-result');
            search_result.text(search_key);

            if (search_key != null) {

                $.ajax({
                    url: "<?= BASE_DIR; ?>/process/getSearchResult",
                    type: "POST",
                    data: {
                        "search-key": search_key
                    },
                    success: function(result) {
                        console.log(result);
                        var jsonResult = JSON.parse(result);
                        mydata = jsonResult;
                        $('#search-result').html("");
                        if (jsonResult['data'] != null) {
                            $.each(jsonResult['data']['data'], function(key, value) {
                                var processId = value['product_id'];
                                var productName = value['product_name'];
                                $('#search-result').append(
                                    `
                            <button onclick='loadProcess(${processId})'>${processName}</button>
                            `
                                );
                            });
                        } else {
                            $("#form-update-process").trigger('reset');
                        }
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });

            }
        });

        $("#form-update-process").submit(function(event) {
            event.preventDefault();

            var data = $("#form-update-process").serialize();

            $.ajax({
                url: "/glass/public/process/update",
                type: "POST",
                data: {
                    "process-id": $("#product-id").val(),
                    "process-name": $("#product-name").val(),
                    "process-rate": $("#product-rate").val()

                },
                success: function(result) {
                    console.log(result);
                    var jsonResult = JSON.parse(result);

                    console.log(jsonResult['message']);

                    $("#message").html(jsonResult['message']);

                    setInterval(function() {
                        $("#message").html("");
                    }, 3000);
                },
                error: function(result) {
                    console.log(result);
                }
            });
        });

    });

    function loadProduct(id) {
        $.ajax({
            url: "/glass/public/product/getProduct",
            type: "POST",
            data: {
                "product-id": id
            },
            success: function(result) {
                console.log(result);
                var jsonResult = JSON.parse(result);

                var data = jsonResult['data']['data'];

                $.each(data, function(key, value) {
                    var productId = value['product_id'];
                    var productName = value['product_name'];
                    var productDesc = value['product_desc'];
                    var productRate = value['product_rate'];

                    $("#product-id").val(productId);
                    $("#product-name").val(productName);
                    $("#product-rate").val(productRate);
                    $("#product-Desc").val(productDesc);

                    $("#search-result").html("");

                });
            },
            error: function(result) {
                console.log(result);
            }
        });
    }
</script>

<?php include(FORM_FOOTER); ?>