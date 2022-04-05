<?php include(TEMP_PATH_HEADER); ?>

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

    <div class="left-panel">
        <h3><a href="<?= BASE_DIR; ?>/hardware?page=1">Hardware List</a></h3>
        <table class="table" id="list-hardware">
            <caption>Process-List</caption>
            <tr class="tr">
                <th>Id</th>
                <th>Hardware</th>
                <th>Hardware Rate</th>
                <th>Action</th>
            </tr>
        </table>
        <nav aria-label="...">
            <ul class="pagination" id="pagination">

            </ul>
        </nav>
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
            url: "<?= BASE_DIR; ?>/hardware/getHardwareList",
            type: "POST",
            data: {
                "startLimit": page,
                "recordCount": recordCount
            },
            success: function(result) {
                console.log(result);
                var jsonResult = JSON.parse(result);
                //console.log(jsonResult);

                var table = $("#list-hardware");

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
                    var hardwareId = value['hardware_id'];
                    var hardwareName = value['hardware_name'];
                    //var processDesc = value['process_desc'];
                    var hardwareRate = value['hardware_rate'];

                    table.append(
                        `<tr>
                    <th>${hardwareId}</th>
                    <th>${hardwareName}</th>
                    <th>${hardwareRate}</th>
                    <th>
                    <a href='http://localhost/glass/public/hardware/form-update?pid=${hardwareId}'>Edit</a>
                    <button class="btn btn-outline-danger m-2">Delete</button>
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

    function load(view) {
        $("#right-panel").show(true);
        $("#right-panel").css("width", "100%");
        $("#right-panel").load("/product/form-" + view);
    }
</script>
<?php include(TEMP_PATH_FOOTER); ?>