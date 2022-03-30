<?php include(FORM_HEADER); ?>
<main>
    <div id="message-div">

    </div>
    <section>
        <div>
            <h3 class="text-center">Add Customer</h3>
            <form id="form-add-customer" action="<?= BASE_DIR; ?>/customer/form-add" method="post">
                <div class="form-group">
                    <input class="form-control mt-4" type="text" name="customer-name" id="customer-name" placeholder="Customer Name" required>
                    <input class="form-control mt-4" type="Number" name="customer-contact" id="customer-contact" placeholder="Customer Contact" required>
                    <input class="form-control mt-4" type="email" name="customer-email" id="customer-email" placeholder="Customer email" required>
                    <textarea class="form-control mt-4" name="customer-address" id="customer-address" cols="30" rows="4" placeholder="Address" required></textarea>
                </div>

                <button class="btn btn-primary mt-4" type="submit">Add Customer</button>
                <button class="btn btn-secondary mt-4" type="reset">Reset</button>
            </form>
        </div>
    </section>
</main>

<script>
    $(document).ready(function() {

        $("#form-add-customer").submit(function(event) {
            event.preventDefault();

            var form_data = $("#form-add-customer").serialize();
            $.ajax({
                url: "<?= BASE_DIR; ?>/customer/form-add",
                type: "POST",
                data: {
                    "cname": $("#customer-name").val(),
                    "ccontact": $("#customer-contact").val(),
                    "cemail": $("#customer-email").val(),
                    "cadd": $("#customer-address").val()
                },
                success: function(result) {
                    $("#message-div").text(result);
                    setInterval(function() {
                        $("#message-div").html("");
                    }, 5000);
                },
                error: function(result) {
                    console.log(result);
                }
            });
        });

    }); //end document ready
</script>
<?php include(FORM_FOOTER); ?>