<?php include(FORM_HEADER); ?>
<main>
    <section>
        <div>
            <h3 class="text-center">Process</h3>
            <form id="form-add-process" action="<?=BASE_DIR;?>/process/form-add" method="post">
                <div class="form-group">
                <input class="form-control mt-2" type="text" name="process-name" placeholder="Process Name" required>
                <input class="form-control mt-2" type="number" step="0.01" name="process-rate" placeholder="Process Rate" required>
                </div>
                
                <button class="btn btn-primary mt-4" type="submit">Add Process</button>
                <button class="btn btn-secondary mt-4" type="reset">Reset</button>
            </form>
        </div>
    </section>
</main>
<?php include(FORM_FOOTER); ?>