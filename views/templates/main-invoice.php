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

    .cus-txt {
        width: fit-content;
    }
</style>

<main>
    <section>
        <h3>Invoice</h3>
    </section>
    <section>
        <div>
            <label for="search-customer">Add Customer</label>
            <input type="text" class="form-control" name="" id="search-customer" placeholder="Customer name" required>
            <div class="search-result" id="search-result-customer"></div>

            <label for="search-product">Add Product</label>
            <input type="text" class="form-control" name="search" id="search-product" placeholder="Search-Product" autocomplete="off">
            <div class="search-result" id="search-result"></div>
        </div>
        <div class="mt-4" style="border: 1px solid #ccc;padding: 16px;">
            <form id="form-add-invoice" action="<?= BASE_DIR; ?>/invoice/add" method="POST">

                <input class="cus-txt" type="text" name="customer-id" id="customer-id" placeholder="Customer-Id">
                <input type="text" name="customer-name" id="customer-name" placeholder="Customer-Name">

                <input type="text" name="challan-id" id="challan-id" placeholder="Challan Id" required>

                <div id="inv">
                </div>

                <button class="btn btn-primary m-2" type="submit">Save-Invoice</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
                <input class="btn btn-secondary" type="button" onclick="myPrint('form-add-invoice')" value="print">
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

        // $("#form-add-invoice").submit(function(event){
        //     event.preventDefault();
        //     var x = $("#form-add-invoice").serialize();
        //     console.log(x);
        // });

        $("#search-customer").keyup(function() {
            var search_key = $("#search-customer").val();
            var search_result = $('#search-result-customer');
            search_result.text(search_key);

            if (search_key != null) {

                $.ajax({
                    url: "<?= BASE_DIR; ?>/customer/getSearchResult",
                    type: "POST",
                    data: {
                        "search-key": search_key
                    },
                    success: function(result) {
                        //console.log(result);
                        var jsonResult = JSON.parse(result);
                        //mydata = jsonResult;
                        $('#search-result-customer').html("");

                        var data = jsonResult['data'];
                        console.log(data['data']);
                        if (jsonResult['data'] != null) {
                            $.each(jsonResult['data'], function(key, value) {
                                var customerId = value['customer_id'];
                                var customerName = value['c_name'];

                                $('#search-result-customer').append(
                                    `
                                    <button onclick='loadCustomer(${customerId})'>${customerId}-${customerName}</button>
                            
                                    `
                                );
                            });
                        } else {
                            //$("#form-update-product").trigger('reset');
                        }
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });

            }
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

                        $("#inv").append(
                            `
                        <div id=${productId} class="form-group mt-2">
                            <input type="number" name="product-id[]" value="${productId}" id="${productId}product-id">                            
                            <input type="text" name="pname[]" value="${productName}" id="${productId}product-name" placeholder="Product Name">
                            <input type="text" name="product-length[]" value="" id="${productId}product-length" placeholder="Product Dimension">
                            <input type="number" name="pquantity[]" value="1" id="${productId}product-quantity" onkeyup="quantityChange(${productId})" placeholder="Product Quantity">
                            <input type="text" name="work-details[]" value="" id="${productId}work-details" placeholder="Work Details">
                            <input type="number" name="product-tdimension[]" value="" id="${productId}product-tdimension" placeholder="Total Dimension">
                            <input type="number" name="prate[]" value="${productRate}" id="${productId}product-rate" placeholder="Product Rate">
                            
                            <input type="number" name="total[]" value="${productRate}" id="${productId}product-total" placeholder="Total">
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

    function loadCustomer(customerId) {
        $.ajax({
            url: "<?= BASE_DIR; ?>/customer/getCustomer",
            type: "POST",
            data: {
                "customer-id": customerId
            },
            success: function(result) {
                console.log(result);
                var jsonResult = JSON.parse(result);
                if (jsonResult['data']) {
                    var data = jsonResult['data'];
                    $.each(data, function(key, value) {
                        var customerId = value['customer_id'];
                        var customerName = value['c_name'];
                        var customerContact = value['c_contact'];
                        var customerEmail = value['c_email'];
                        var customerAdd = value['c_address'];

                        $("#customer-id").val(customerId);
                        $("#customer-name").val(customerName);
                        // $("#customer-contact").val(customerContact);
                        // $("#customer-email").val(customerEmail);
                        // $("#customer-address").val(customerAdd);

                        $("#search-result-customer").html("");
                    });
                }
            },
            error: function(result) {
                console.log(result)
            }
        });
    }
</script>

<?php include(TEMP_PATH_FOOTER); ?>