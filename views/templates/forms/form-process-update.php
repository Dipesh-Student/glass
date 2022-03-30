<?php include(FORM_HEADER); ?>

<main>
    <div id="message">

    </div>
    <section>
        <div>

            <input type="text" class="form-control mt-4" name="search" id="search-product" placeholder="Search-Product" autocomplete="off">
            <div class="search-result" id="search-result">

            </div>
            <form id="form-update-product" action="<?=BASE_DIR;?>/product/update">
                <div class="form-group mt-2">
                    <label for="product-id">Product-Id</label>
                    <input class="form-control" type="text" name="product-id" id="product-id" disabled>
                </div>
                <div class="form-group mt-2">
                    <label for="product-name">Product-name</label>
                    <input class="form-control" type="text" name="product-name" id="product-name" placeholder="Product-Name" required>
                </div>
                <div class="form-group mt-2">
                    <label for="product-rate">Product-rate</label>
                    <input class="form-control" type="number" name="product-rate" id="product-rate" placeholder="Product-Rate" required>
                </div>
                <div class="form-group mt-2">
                    <label for="product-Desc">Product-Desc</label>
                    <textarea class="form-control" name="product-Desc" cols="30" rows="4" id="product-Desc" required></textarea>
                </div>
                <button class="btn btn-primary m-2" type="submit">Update</button>
                <button class="btn btn-secondary" type="reset">Delete</button>
            </form>
        </div>
    </section>
</main>
<script>
    $(document).ready(function() {

        $("#search-product").keyup(function() {
            var search_key = $("#search-product").val();
            var search_result = $('#search-result');
            search_result.text(search_key);

            if (search_key != null) {

                $.ajax({
                    url: "<?= BASE_DIR; ?>/product/getSearchResult",
                    type: "POST",
                    data: {
                        "search-key": search_key
                    },
                    success: function(result) {
                        var jsonResult = JSON.parse(result);
                        mydata = jsonResult;
                        $('#search-result').html("");
                        if (jsonResult['data'] != null) {
                            $.each(jsonResult['data']['data'], function(key, value) {
                                var productId = value['product_id'];
                                var productName = value['product_name'];
                                $('#search-result').append(
                                    `
                            <button onclick='loadProduct(${productId})'>${productName}</button>
                            `
                                );
                            });
                        } else {
                            $("#form-update-product").trigger('reset');
                        }
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });

            }
        });

        $("#form-update-product").submit(function(event) {
            event.preventDefault();

            var data = $("#form-update-product").serialize();

            $.ajax({
                url: "/glass/public/product/update",
                type: "POST",
                data: {
                    "product-id": $("#product-id").val(),
                    "product-name": $("#product-name").val(),
                    "product-Desc": $("#product-Desc").val(),
                    "product-rate": $("#product-rate").val()

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