<?php include_once(TEMP_PATH_HEADER); ?>

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
        padding: 18px 16px;
        background-color: #F4F0FA;
        border-radius: 15px;
        box-shadow: 2px 2px 6px #ccc;
        margin: 5px;
        min-height: 300px;
    }
</style>

<!--========== CONTENTS ==========-->
<main>
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
        <div class="left-panel">
            <h2>Processes-List</h2>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem incidunt dignissimos dolorum natus quisquam officiis minus nesciunt excepturi consectetur amet reprehenderit, ratione soluta, fugiat quo. Ea saepe velit ex! Ut?
            </p>
        </div>
        <div class="right-panel" id="right-panel">

        </div>
    </div>

    <table class="table" id="list-products">
        <caption>Product-List</caption>
        <tr class="tr">
            <th>Id</th>
            <th>name</th>
            <th>rate</th>
            <th>Action</th>
        </tr>
    </table>
    <nav aria-label="...">
        <ul class="pagination" id="pagination">

        </ul>
    </nav>

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
            url: "<?= BASE_DIR; ?>/process/getProcessList",
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
                    var processId = value['process_id'];
                    var processName = value['process_name'];
                    //var processDesc = value['process_desc'];
                    var processRate = value['process_rate'];

                    table.append(
                        `<tr>
                    <th>${processId}</th>
                    <th>${processName}</th>
                    
                    <th>${processRate}</th>
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

    function load(view) {
        $("#right-panel").show(true);
        $("#right-panel").css("width", "100%");
        $("#right-panel").load("/product/form-" + view);
    }
</script>


<?php include_once(TEMP_PATH_FOOTER); ?>