<?php include(FORM_HEADER); ?>
<main>
    <section>
        <div>
            <h3 class="text-center">Hardware</h3>
            <form id="form-add-hardware" action="<?= BASE_DIR; ?>/hardware/form-add" method="post">
                <div class="form-group">
                    <input class="form-control mt-2" type="text" name="hardware-name" placeholder="Hardware Name" required>
                    <input class="form-control mt-2" type="number" step="0.01" name="hardware-rate" placeholder="Process Rate" required>
                    <textarea class="form-control mt-2" name="hardware-Desc" cols="30" rows="4" placeholder="Hardware Description" required></textarea>
                </div>

                <button class="btn btn-primary mt-4" type="submit">Add Hardware</button>
                <button class="btn btn-secondary mt-4" type="reset">Reset</button>
            </form>
        </div>
    </section>
</main>
<?php include(FORM_FOOTER); ?>