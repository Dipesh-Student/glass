<?php include(FORM_HEADER); ?>

<main>
    <h3 class="text-center m-4">Update Hardware</h3>
    <div id="message">

    </div>
    <section>
        <div>

            <input type="text" class="form-control mt-4" name="search" id="search-hardware" placeholder="Search-Hardware" autocomplete="off">
            <div class="search-result" id="search-result">

            </div>
            <form id="form-update-hardware" action="<?= BASE_DIR; ?>/hardware/update">
                <div class="form-group mt-2">
                    <label for="hardware-id">Hardware-Id</label>
                    <input class="form-control" type="text" name="hardware-id" id="hardware-id" disabled required>
                </div>
                <div class="form-group mt-2">
                    <label for="hardware-name">Hardware-name</label>
                    <input class="form-control" type="text" name="hardware-name" id="hardware-name" placeholder="hardware-Name" required>
                </div>
                <div class="form-group mt-2">
                    <label for="hardware-rate">Hardware-rate</label>
                    <input class="form-control" type="number" name="hardware-rate" step="0.01" id="hardware-rate" placeholder="hardware-Rate" required>
                </div>
                <div class="form-group mt-2">
                    <label for="hardware-Desc">Hardware-Desc</label>
                    <textarea class="form-control" name="hardware-Desc" cols="30" rows="4" id="hardware-Desc" placeholder="Hardware Description" required></textarea>
                </div>
                <button class="btn btn-primary m-2" type="submit">Update</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </form>
        </div>
    </section>
</main>
<script>
    $(document).ready(function() {

        var pageUrl = window.location.search;
        var urlParam = new URLSearchParams(pageUrl);
        if (urlParam.get('pid') != null) {
            loadProduct(urlParam.get('pid'));
        } else {
            //page = urlParam.get('page');
        }

        $("#search-hardware").keyup(function() {
            var search_key = $("#search-hardware").val();
            var search_result = $('#search-result');
            search_result.text(search_key);

            if (search_key != null) {

                $.ajax({
                    url: "<?= BASE_DIR; ?>/hardware/getSearchResult",
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
                                var hwId = value['hardware_id'];
                                var hwName = value['hardware_name'];
                                $('#search-result').append(
                                    `
                            <button onclick='loadHardware(${hwId})'>${hwName}</button>
                            `
                                );
                            });
                        } else {
                            $("#form-update-hardware").trigger('reset');
                        }
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });

            }
        });

        $("#form-update-hardware").submit(function(event) {
            event.preventDefault();

            var data = $("#form-update-hardware").serialize();

            $.ajax({
                url: "/glass/public/hardware/form-update",
                type: "POST",
                data: {
                    "hardware-id": $("#hardware-id").val(),
                    "hardware-name": $("#hardware-name").val(),
                    "hardware-Desc": $("#hardware-Desc").val(),
                    "hardware-rate": $("#hardware-rate").val()
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

    function loadHardware(id) {
        $.ajax({
            url: "/glass/public/hardware/getHardware",
            type: "POST",
            data: {
                "hw-id": id
            },
            success: function(result) {
                console.log(result);
                var jsonResult = JSON.parse(result);

                var data = jsonResult['data']['data'];

                $.each(data, function(key, value) {
                    var hardwareId = value['hardware_id'];
                    var hardwareName = value['hardware_name'];
                    var hardwareDesc = value['hardware_desc'];
                    var hardwareRate = value['hardware_rate'];

                    $("#hardware-id").val(hardwareId);
                    $("#hardware-name").val(hardwareName);
                    $("#hardware-rate").val(hardwareRate);
                    $("#hardware-Desc").val(hardwareDesc);

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