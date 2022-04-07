<?php include(FORM_HEADER); ?>
<main>
    <section>
        <div>
            <h3 class="text-center m-4">Add Product</h3>
            <form id="form-add-product" action="<?= BASE_DIR; ?>/product/add" method="post">
                <input class="form-control mt-2" type="text" name="product-name" placeholder="Product-Name" required>
                <input class="form-control mt-2" type="text" name="product-thickness" id="" placeholder="Product Value thickness in mm" required>
                <input class="form-control mt-2" type="number" name="product-rate" step="0.01" placeholder="Product-Rate" required>
                <textarea class="form-control mt-2" name="product-Desc" cols="30" rows="4" required></textarea>
                <button class="btn btn-primary m-2" type="submit">Add Product</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </form>
        </div>
    </section>
</main>

<script>
    function clearMessage() {
        $("#message-content").html("");
    }
</script>

<?php include(FORM_FOOTER); ?>