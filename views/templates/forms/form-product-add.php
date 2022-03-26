<div>
    <?php echo $html_d; ?>
    <form id="form-add-product" action="/product/add" method="post">
        <input class="form-control mt-2" type="text" name="product-name" placeholder="Product-Name" required>
        <input class="form-control mt-2" type="number" name="product-rate" placeholder="Product-Rate" required>
        <textarea class="form-control mt-2" name="product-Desc" cols="30" rows="4" required></textarea>
        <button class="btn btn-primary m-2" type="submit">Add Product</button>
        <button class="btn btn-secondary" type="reset">Reset</button>
    </form>
</div>