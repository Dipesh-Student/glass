<?php include_once(TEMP_PATH_HEADER); ?>

<style>
    .fixed-length {
        width: 40%;
    }
</style>
<!--========== CONTENTS ==========-->
<main>
    <div class="alert alert-message" id="alert-message" role="alert">
        <span id="alert-message-span">Hello-world</span>
        <button onclick="close_message();">X</button>
    </div>
    <!-- main-header -->
    <div class="main-header">
        <button class="cus-btn" onclick="load('add')" title="Add Product">
            <span class="material-icons-outlined">
                add
            </span></button>
        <button class="cus-btn" onclick="load('update')" title="Update Product"><span class="material-icons-outlined">
                update
            </span></button>
        <button class="cus-btn" onclick="load('delete')" title="Delete Product"><span class="material-icons-outlined">
                delete
            </span></button>
        <button class="cus-btn" onclick="$('#right-panel').empty().hide(true);" title="Clear Panel"><span class="material-icons-outlined">
                clear
            </span></button>
    </div>
    <!-- content-panel -->
    <div style="display: flex;">
        <div class="left-panel" id="left-panel">
            <a href="/product?page=1">
                <h2>Product-List</h2>
            </a>

            <table class="table" id="list-products">
                <caption>Product-List</caption>
                <tr class="tr">
                    <th>Id</th>
                    <th>name</th>
                    <th class="fixed-length">Desc</th>
                    <th>Product Thickness</th>
                    <th>rate</th>
                    <th>Action</th>
                </tr>
            </table>
            <nav aria-label="...">
                <ul class="pagination" id="pagination">

                </ul>
            </nav>
        </div>

        <div class="right-panel" id="right-panel"></div>
    </div>

</main>

<!--========== MAIN JS ==========-->

<script>
    $(document).ready(function() {
        $("#right-panel").hide(true);
        $("#alert-message").hide(true);

        /**
         * load and show product's list
         */
        var page = 0;
        var recordCount = 5;
        var pageUrl = window.location.search;
        var urlParam = new URLSearchParams(pageUrl);
        if (urlParam.get('page') == null) {
            page = 0;
        } else {
            page = urlParam.get('page');
        }

        $.ajax({
            url: "<?= BASE_DIR; ?>/product/getProductList",
            type: "POST",
            data: {
                "startLimit": page,
                "recordCount": recordCount
            },
            success: function(result) {
                console.log(result);
                var jsonResult = JSON.parse(result);
                //console.log(jsonResult);

                var table = $("#list-products");

                var totalRecords = jsonResult['totalRecords'];
                var totalPagesRequired = Math.ceil(totalRecords / recordCount);


                for (let i = 1; i <= totalPagesRequired; i++) {
                    if (page == i) {
                        $("#pagination").append(
                            `
                    <li class="page-item"><a class="page-link active" href="?page=${i}">${i}</a></li>
                    `
                        );
                    } else {
                        $("#pagination").append(
                            `
                    <li class="page-item"><a class="page-link" href="?page=${i}">${i}</a></li>
                    `
                        );
                    }
                }

                $.each(jsonResult['data'], function(key, value) {
                    var productId = value['product_id'];
                    var productName = value['product_name'];
                    var productDesc = value['product_desc'];
                    var productThickness = value['product_thickness'];
                    var productRate = value['product_rate'];
                    var shortDesc = productDesc.slice(0, 50);
                    table.append(
                        `<tr>
                    <th>${productId}</th>
                    <th>${productName}</th>
                    <th>
                    ${shortDesc}
                    </th>
                    <th>${productThickness}</th>
                    <th>${productRate}</th>
                    <th>
                    <a href='http://localhost/glass/public/product/form-update?pid=${productId}'>Edit</a>
                    <button class="btn btn-outline-danger m-2" onclick="delProduct(${productId});">Delete</button>
                    </th>
                    </tr>`
                    );
                });
            },
            error: function(result) {
                alert("Err " + result);
            }
        });
    });

    $('#form-add-product').on('submit', function(event) {
        event.preventDefault();
    });

    $(document).on('submit', '#form-add-product', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var formData = $('#form-add-product').serializeArray();
        var url = $('#form-add-product').attr('action');
        var httpMethod = $('#form-add-product').attr('method');
        console.log(formData);
        console.log(url);
        console.log(httpMethod);

        $.ajax({
            url: url,
            type: httpMethod,
            data: formData,
            success: function(result) {
                $('#form-add-product').trigger("reset");
                $("#alert-message").fadeIn();
                $("#alert-message").show(true);
                $("#alert-message-span").html(result);
                setInterval(function() {
                    $("#alert-message-span").html("");
                    $("#alert-message").hide(true).fadeOut();
                }, 10000);
            },
            error: function(result) {
                $('#form-add-product').trigger("reset");
                $("#alert-message").fadeIn();
                $("#alert-message").show(true);
                $("#alert-message-span").html(result);
                setInterval(function() {
                    $("#alert-message-span").html("");
                    $("#alert-message").hide(true).fadeOut();
                }, 10000);
            }
        });
    });

    function delProduct(productId) {
        if (confirm("This will delete record Permanently.")) {
            txt = "You pressed OK!";
            $.ajax({
                url: "<?= BASE_DIR; ?>/product/delProduct",
                type: "POST",
                data: {
                    "product-id": productId
                },
                success: function(result) {
                    console.log(result);
                },
                error: function(result) {
                    console.log(result);
                }
            });
        }
    }

    function load(view) {
        $("#right-panel").show(true);
        $("#right-panel").css("width", "100%");
        $("#right-panel").load("/product/form-" + view);
    }
</script>


<?php include_once(TEMP_PATH_FOOTER); ?>