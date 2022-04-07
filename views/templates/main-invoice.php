<?php include(TEMP_PATH_HEADER); ?>

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

<main>
    <section>
        <h3>Invoice</h3>
    </section>
    <section>
        <div>
            <input type="text" class="form-control mt-4" name="search" id="search-product" placeholder="Search-Product" autocomplete="off">
            <div class="search-result" id="search-result">

            </div>
        </div>
        <div>
            <form id="form-add-invoice" action="<?= BASE_DIR; ?>/invoice/add">

                <div id="inv">
                </div>

                <table>
                    <tr>
                        <th>h</th>
                        <th>b</th>
                    </tr>
                    <tr>
                        <th>213</th>
                        <th>325</th>
                    </tr>
                </table>

                <button class="btn btn-primary m-2" type="submit">Save-Invoice</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
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
                            //$("#form-add-invoice").trigger('reset');
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
        if ($('#' + id).length) // use this if you are using id to check
        {
            alert("You have already added this product");
        } else {
            $.ajax({
                url: "/glass/public/product/getProduct",
                type: "POST",
                data: {
                    "product-id": id
                },
                success: function(result) {
                    //console.log(result);
                    var jsonResult = JSON.parse(result);

                    var data = jsonResult['data']['data'];

                    $.each(data, function(key, value) {
                        var productId = value['product_id'];
                        var productName = value['product_name'];
                        var productDesc = value['product_desc'];
                        var productRate = value['product_rate'];

                        $("#form-add-invoice").append(
                            `
                        <div id=${productId} class="form-group mt-2">
                            <input type="number" name="product-id" value="${productId}" id="${productId}product-id">                            
                            <input type="text" name="pname" value="${productName}" id="${productId}product-name" placeholder="Product Name">
                            <input type="text" name="product-length" value="" id="${productId}product-length" placeholder="Product Dimension">
                            <input type="number" name="product-tdimension" value="" id="${productId}product-tdimension" placeholder="Total Dimension">
                            <input type="number" name="prate" value="${productRate}" id="${productId}product-rate" placeholder="Product Rate">
                            <input type="number" name="pquantity" value="1" id="${productId}product-quantity" onkeyup="quantityChange(${productId})" placeholder="Product Quantity">
                            <input type="number" name="total" value="${productRate}" id="${productId}product-total" placeholder="Total">
                        </div>
                        `
                        );

                        $("#search-result").html("");

                    });
                },
                error: function(result) {
                    console.log(result);
                }
            });
        }
    }

    function quantityChange(id) {
        var rate = $("#" + id + "product-rate").val();
        var quantity = $("#" + id + "product-quantity").val();
        $("#" + id + "product-total").val(rate * quantity);
    }
</script>

<?php include(TEMP_PATH_FOOTER); ?>