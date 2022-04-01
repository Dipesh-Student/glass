<?php include(FORM_HEADER); ?>
<main>
    <div id="message-div">

    </div>
    <section>
        <div>
            <h3 class="text-center">Update Customer details</h3>
            <input type="text" class="form-control mt-4" name="search" id="search-customer" placeholder="Search-Customer" autocomplete="off">
            <div class="search-result" id="search-result">

            </div>
            <form id="form-update-customer" action="<?= BASE_DIR; ?>/customer/form-add" method="post">
                <div class="form-group">
                    <input class="form-control mt-4" type="text" name="customer-id" id="customer-id" placeholder="Customer Id" disabled required>
                    <input class="form-control mt-4" type="text" name="customer-name" id="customer-name" placeholder="Customer Name" required>
                    <input class="form-control mt-4" type="Number" name="customer-contact" id="customer-contact" placeholder="Customer Contact" required>
                    <input class="form-control mt-4" type="email" name="customer-email" id="customer-email" placeholder="Customer email" required>
                    <textarea class="form-control mt-4" name="customer-address" id="customer-address" cols="30" rows="4" placeholder="Address" required></textarea>
                </div>

                <button class="btn btn-primary mt-4" type="submit">Update</button>
                <button class="btn btn-secondary mt-4" type="reset">Reset</button>
            </form>
        </div>
    </section>
</main>

<script>
    $(document).ready(function() {

        $("#form-update-customer").submit(function(event) {
            event.preventDefault();

            var form_data = $("#form-update-customer").serialize();
            $.ajax({
                url: "<?= BASE_DIR; ?>/customer/form-update",
                type: "POST",
                data: {
                    "cid": $("#customer-id").val(),
                    "cname": $("#customer-name").val(),
                    "ccontact": $("#customer-contact").val(),
                    "cemail": $("#customer-email").val(),
                    "cadd": $("#customer-address").val()
                },
                success: function(result) {
                    $("#message-div").text(result);
                    $("#form-update-customer").trigger('reset');
                    setInterval(function() {
                        $("#message-div").html("");
                    }, 5000);
                },
                error: function(result) {
                    console.log(result);
                }
            });
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