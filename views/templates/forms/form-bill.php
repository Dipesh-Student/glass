<?php include(FORM_HEADER); ?>

<style>
    th,
    td {
        text-align: left;
        border: 1px solid grey;
    }
</style>
<main>
    <div id="message-div">

    </div>
    <section>
        <div>
            <h3 class="text-center">Generate Bill/Invoice</h3>

            <input type="text" class="form-control mt-4" name="search" id="search-customer" placeholder="Search-Customer" autocomplete="off">
            <div class="search-result" id="search-result">

            </div>
            <form id="form-gen-bill" action="<?= BASE_DIR; ?>/invoice/gen-bill" method="post">
                <div class="form-group" id="challan-id">

                </div>

                <button class="btn btn-primary mt-4" type="submit">Generate Bill</button>
                <button class="btn btn-secondary mt-4" type="reset">Reset</button>
            </form>

            <div id="inv" style="margin: 00.5em;">
                <table class="table" id="gen-bill">
                    <thead>
                        <caption>Invoice</caption>
                        <tr class="tr">
                            <th>Challan Id</th>
                            <th>ProductName</th>
                            <th>Product Dimension</th>
                            <th>Quantity</th>
                            <th>Work Details</th>
                            <th>Total Dimension</th>
                            <th>Std Rate</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <!-- <div id="inv-total"></div> -->

                </table>
                <div>
                    <span class="span-total" id="inv-total" style="display: flex;justify-content: end;text-align:end"></span>
                </div>
            </div>

            <input class="btn btn-secondary" type="button" onclick="myPrint()" value="print">
            <!-- <textarea class="form-control" name="" id="result" cols="30" rows="10"></textarea> -->
            <button class="btn btn-secondary" onclick="invoicetotal()">Add Total</button>
        </div>
    </section>
</main>

<script>
    $(document).ready(function() {

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
                            $("#form-update-product").trigger('reset');
                        }
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });

            }
        });

    }); //end document ready

    $("#form-gen-bill").submit(function(event) {
        event.preventDefault();
        var data = $("#form-gen-bill").serialize();

        $.ajax({
            url: "<?= BASE_DIR; ?>/invoice/gen-bill",
            type: "post",
            data: data,
            success: function(result) {
                var jR = JSON.parse(result);

                $("#gen-bill tbody").children('tr:not(:first)').html("");

                $.each(jR, function(key, nvalue) {
                    $.each(nvalue, function(key, value) {

                        var challanId = value['iv_challan_id'];
                        var productname = value['iv_product_name'];
                        var pdim = value['iv_product_dim'];
                        var quantity = value['iv_product_quantity'];
                        var workDetails = value['iv_product_work'];
                        var totalDim = value['iv_product_tdim'];
                        var stdrate = value['iv_product_rate'];
                        var total = value['iv_total'];

                        //console.log(productname);
                        $("#gen-bill > tbody:last-child").append(
                            `
                            <tr>
                            <td>${challanId}</td>
                            <td>${productname}</td>
                            <td>${pdim}</td>
                            <td>${quantity}</td>
                            <td>${workDetails}</td>
                            <td>${totalDim}</td>
                            <td>${stdrate}</td>
                            <td name="total[]">${total}
                            <input type="hidden" name=t[] value="${total}">
                            </td>
                            </tr>
                            `
                        );
                    });
                });
                invoicetotal();
            },
            error: function(result) {
                console.log(result);
            }

        });

    });


    function invoicetotal() {
        $("#inv-total").html("");
        var sum = 0;
        var total = $('input[name="t[]"]').map(function() {
            return this.value;
        }).get();
        $.each(total, function(key, value) {
            sum = parseInt(sum) + parseInt(value);
        });
        var cgst = percentage(9, sum);
        var sgst = percentage(9, sum);
        var finalAmount = parseInt(sum) + parseInt(cgst) + parseInt(sgst);
        $("#inv-total").html(
            "AMT Before GST : " + sum +
            "<br>CGST @ 9% : " + cgst +
            "<br>CGST @ 9% : " + sgst +
            "<br>Total Amount : " + finalAmount
        );

    }

    function percentage(percent, total) {
        return ((percent / 100) * total).toFixed(2)
    }

    function loadCustomer(customerId) {
        retrieveChallanByCustomerId(customerId);
        $('#search-result').html("");
    }

    function retrieveChallanByCustomerId(id) {
        $.ajax({
            url: "<?= BASE_DIR; ?>/challan/retrieveUserChallan",
            type: "post",
            data: {
                "customer-id": id
            },
            success: function(result) {
                $("#challan-id").html("");
                //console.log(result);
                var jsonResult = JSON.parse(result);

                $.each(jsonResult['data'], function(key, value) {
                    var customerId = value['customer_id'];
                    var challanId = value['challan_id'];
                    var customerName = value['customer_name'];

                    $("#challan-id").append(
                        `
                        <div>
                        <input type="checkbox" name="challan-id[]" id="${challanId}" value="${challanId}">
                        <label for="${challanId}">${challanId}-${customerName}</label>
                        </div>
                        `
                    );
                });
            },
            error: function(result) {
                console.log(result);
            }
        });
    }

    function loadCustomerInvoiceByChallan(customerId) {
        $.ajax({
            url: "<?= BASE_DIR; ?>/invoice/getCustInvByChllaan",
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
                        var customerContact = value['c_contact'];
                        var customerEmail = value['c_email'];
                        var customerAdd = value['c_address'];

                        $("#customer-id").val(customerId);
                        $("#customer-name").val(customerName);
                        $("#customer-contact").val(customerContact);
                        $("#customer-email").val(customerEmail);
                        $("#customer-address").val(customerAdd);

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
<?php include(FORM_FOOTER); ?>