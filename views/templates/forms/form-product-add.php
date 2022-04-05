<?php include(FORM_HEADER); ?>
<main>
    <section>
        <div>
            <h3 class="text-center m-4">Add Product</h3>
            <form id="form-add-product" action="<?= BASE_DIR; ?>/product/add" method="post">
                <input class="form-control mt-2" type="text" name="product-name" placeholder="Product-Name" required>
                <div class="form-group mt-2">
                    <h3>Product Type</h3>
                    <input class="" type="radio" name="product-type[]" value="glass" id="glass" required>
                    <label for="glass">Glass</label>
                    <input class="" type="radio" name="product-type[]" value="hardware" id="hardware" required>
                    <label for="hardware">h/w</label>
                </div>
                <input class="form-control mt-2" type="text" name="product-value" id="" placeholder="Product Value thickness" required>
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