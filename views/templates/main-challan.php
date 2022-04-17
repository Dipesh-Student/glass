<?php include_once(TEMP_PATH_HEADER); ?>

<!--========== CONTENTS ==========-->
<main>

    <section>
        <div>
            <h3 class="text-center">Update Customer details</h3>
            <input type="text" class="form-control mt-4" name="search" id="search-customer" placeholder="Search-Customer" autocomplete="off">
            <div class="search-result" id="search-result">

            </div>
            <form id="form-add-challan" action="<?= BASE_DIR; ?>/challan/form-challan-add" method="post">
                <input class="form-control mt-2" type="text" name="customer-id" id="customer-id" placeholder="Customer Id" required>
                <input class="form-control mt-2" type="text" name="customer-name" id="customer-name" placeholder="Customer name" required>
                <button class="btn btn-primary" type="submit">Add Challan</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </form>
        </div>
        <div style="display: flex;">
            <div class="left-panel" id="left-panel">
                <a href="/challan?page=1">
                    <h2>Challan-List</h2>
                </a>

                <table class="table" id="list-challan">
                    <caption>Challan-List</caption>
                    <tr class="tr">
                        <th>Challan Id</th>
                        <th>Customer-Id</th>
                        <th>Customer-name</th>
                        <th>Action</th>
                    </tr>
                </table>
                <nav aria-label="...">
                    <ul class="pagination" id="pagination">

                    </ul>
                </nav>
            </div>
        </div>
    </section>

</main>

<!--========== MAIN JS ==========-->

<script>
    $(document).ready(function() {
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
            url: "<?= BASE_DIR; ?>/challan/getChallanList",
            type: "POST",
            data: {
                "startLimit": page,
                "recordCount": recordCount
            },
            success: function(result) {
                console.log(result);
                var jsonResult = JSON.parse(result);
                //console.log(jsonResult);

                var table = $("#list-challan");

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
                    var challanId = value['challan_id'];
                    var customerId = value['customer_id'];
                    var customerName = value['customer_name'];

                    table.append(
                        `<tr>
                    <th>${challanId}</th>
                    <th>${customerId}</th>
                    <th>${customerName}</th>
                    <th>
                    <a href='http://localhost/glass/public/invoice?challanid=${challanId}'>Bill/Invoice</a>
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

        $("#search-customer").keyup(function() {
            var search_key = $("#search-customer").val();
            var search_result = $('#search-result');
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
                        $('#search-result').html("");

                        var data = jsonResult['data'];
                        console.log(data['data']);
                        if (jsonResult['data'] != null) {
                            $.each(jsonResult['data'], function(key, value) {
                                var customerId = value['customer_id'];
                                var customerName = value['c_name'];

                                $('#search-result').append(
                                    `
                                    <button onclick='loadCustomer(${customerId})'>${customerName}</button>
                            
                                    `
                                );
                            });
                        } else {
                            $("#form-add-challan").trigger('reset');
                        }
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });

            }
        });

    });

    function loadCustomer(customerId) {
        $.ajax({
            url: "<?= BASE_DIR; ?>/customer/getCustomer",
            type: "POST",
            data: {
                "customer-id": customerId
            },
            success: function(result) {

                var jsonResult = JSON.parse(result);
                if (jsonResult['data']) {
                    var data = jsonResult['data'];
                    $.each(data, function(key, value) {
                        var customerId = value['customer_id'];
                        var customerName = value['c_name'];
                        //var customerContact = value['c_contact'];
                        //var customerEmail = value['c_email'];
                        //var customerAdd = value['c_address'];

                        $("#customer-id").val(customerId);
                        $("#customer-name").val(customerName);
                        //$("#customer-contact").val(customerContact);
                        //$("#customer-email").val(customerEmail);
                        //$("#customer-address").val(customerAdd);

                        $("#search-result").html("");
                    });
                }
            },
            error: function(result) {
                console.log(result)
            }
        });
    }
</script>


<?php include_once(TEMP_PATH_FOOTER); ?>