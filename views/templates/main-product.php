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
        <div class="left-panel" id="left-panel">
            <h2>Product-List</h2>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem incidunt dignissimos dolorum natus quisquam officiis minus nesciunt excepturi consectetur amet reprehenderit, ratione soluta, fugiat quo. Ea saepe velit ex! Ut?
            </p>
        </div>
        <div class="right-panel" id="right-panel">

        </div>
    </div>

</main>

<!--========== MAIN JS ==========-->

<script>
    $(document).ready(function() {
        $("#right-panel").hide(true);
    });

    $.ajax({
        url: "/product/getProduct",
        type: "POST",
        data: {
            "id": 23
        },
        success: function(result) {
            $("#left-panel").append(result);
        },
        error: function(result) {
            alert("Err " + result);
        }
    });

    function load(view) {
        $("#right-panel").show(true);
        $("#right-panel").css("width", "75%");
        $("#right-panel").load("/product/form-" + view);
    }
</script>


<?php include_once(TEMP_PATH_FOOTER); ?>