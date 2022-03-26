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
    .search-result a{
        margin: 5px;
    }
</style>
<main>
    <section>
        <div>

            <input type="text" class="form-control mt-4" name="search" id="search-product" placeholder="Search-Product" autocomplete="off">
            <div class="search-result" id="search-result">

            </div>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>
</main>
<script>
    $(document).ready(function() {

        var mydata = null;

        $("#search-product").keyup(function() {
            var search_key = $("#search-product").val();
            var search_result = $('#search-result');
            search_result.text(search_key);
            $.ajax({
                url: "/product/getSearchResult",
                type: "POST",
                data: {
                    "search-key": search_key
                },
                success: function(result) {
                    var jsonResult = JSON.parse(result);
                    mydata = jsonResult;
                    //console.log(jsonResult);
                    $('#search-result').html("");
                    $.each(jsonResult['data']['data'], function(key, value) {
                        var productId = value['product_id'];
                        var productName = value['product_name'];
                        $('#search-result').append(
                            `
                            <a href='${productId}'>${productName}</a>
                            `
                        );
                    });
                },
                error: function(result) {
                    console.log(result);
                }
            });
            console.log(mydata['data']);
        });
        
    });
</script>

<?php include(TEMP_PATH_FOOTER); ?>