<?php include(FORM_HEADER); ?>

<main>
    <h3 class="text-center m-4">Update Process</h3>
    <div id="message">

    </div>
    <section>
        <div>

            <input type="text" class="form-control mt-4" name="search" id="search-process" placeholder="Search-Process" autocomplete="off">
            <div class="search-result" id="search-result">

            </div>
            <form id="form-update-process" action="<?= BASE_DIR; ?>/process/update">
                <input class="form-control mt-4" type="text" name="process-id" id="process-id" placeholder="Process Id" disabled required>
                <input class="form-control mt-2" type="text" name="process-name" id="process-name" placeholder="Process Name" required>
                <input class="form-control mt-2" type="number" step="0.01" name="process-rate" id="process-rate" placeholder="Process Rate" required>
                <button class="btn btn-primary m-2" type="submit">Update</button>
                <button class="btn btn-secondary" type="reset">Delete</button>
            </form>
        </div>
    </section>
</main>
<script>
    $(document).ready(function() {

        var pageUrl = window.location.search;
        var urlParam = new URLSearchParams(pageUrl);
        if (urlParam.get('pid') != null) {
            loadProcess(urlParam.get('pid'));
        } else {
            //page = urlParam.get('page');
        }

        $("#search-process").keyup(function() {
            var search_key = $("#search-process").val();
            var search_result = $('#search-result');
            search_result.text(search_key);

            if (search_key != null) {

                $.ajax({
                    url: "<?= BASE_DIR; ?>/process/getSearchResult",
                    type: "POST",
                    data: {
                        "search-key": search_key
                    },
                    success: function(result) {
                        console.log(result);
                        var jsonResult = JSON.parse(result);
                        mydata = jsonResult;
                        $('#search-result').html("");
                        if (jsonResult['data'] != null) {
                            $.each(jsonResult['data'], function(key, value) {
                                var processId = value['process_id'];
                                var processName = value['process_name'];
                                $('#search-result').append(
                                    `
                            <button onclick='loadProcess(${processId})'>${processName}</button>
                            `
                                );
                            });
                        } else {
                            $("#form-update-process").trigger('reset');
                        }
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });

            }
        });

        $("#form-update-process").submit(function(event) {
            event.preventDefault();

            var data = $("#form-update-process").serialize();

            $.ajax({
                url: "/glass/public/process/form-update",
                type: "POST",
                data: {
                    "process-id": $("#process-id").val(),
                    "process-name": $("#process-name").val(),
                    "process-rate": $("#process-rate").val()

                },
                success: function(result) {
                    //console.log(result);
                    var jsonResult = JSON.parse(result);

                    //console.log(jsonResult['message']);

                    $("#message").html(result);

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

    function loadProcess(id) {
        $.ajax({
            url: "/glass/public/process/getProcess",
            type: "POST",
            data: {
                "process-id": id
            },
            success: function(result) {
                //console.log(result);
                var jsonResult = JSON.parse(result);

                var data = jsonResult['data'];

                $.each(data, function(key, value) {
                    var productId = value['process_id'];
                    var productName = value['process_name'];
                    var productRate = value['process_rate'];

                    $("#process-id").val(productId);
                    $("#process-name").val(productName);
                    $("#process-rate").val(productRate);

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