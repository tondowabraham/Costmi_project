<!-- Edit form content -->
<form id="bill_form" method="post" class="general-form">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div class="modal-body clearfix">
        <div class="container-fluid">


            <div class="form-group">
                <div class="row">
                    <label for="task_id" class="col-md-3">Task ID:</label>
                    <div class="col-md-9">
                        <input type="text" name="task_id" id="task_id" value="<?= $task_id ?? ''; ?>" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="task_name" class="col-md-3">Task Name:</label>
                    <div class="col-md-9">
                        <input type="text" name="task_name" id="task_name" value="<?= $task_name ?? ''; ?>" class="form-control">
                    </div>
                </div>
            </div>

        
            <div class="form-group">
                <div class="row">
                    <label for="bill_type" class="col-md-3">Bill Type:</label>
                    <div class="col-md-9">
                        <select name="bill_type" id="bill_type" value="<?= $bill_type ?? ''; ?>" class="form-control" required>
                            <option value="" disabled>Select Bill Type</option>
                            <option value="bill_1" <?= ($bill_type ?? '') === 'bill_1' ? 'selected' : '' ?>>Bill 1: General</option>
                            <option value="bill_2" <?= ($bill_type ?? '') === 'bill_2' ? 'selected' : '' ?>>Bill 2: Site Clearance and Earthworks</option>
                            <option value="bill_3" <?= ($bill_type ?? '') === 'bill_3' ? 'selected' : '' ?>>Bill 3: Concrete Culverts</option>
                            <option value="bill_4" <?= ($bill_type ?? '') === 'bill_4' ? 'selected' : '' ?>>Bill 4: Pavement and Surfacing</option>
                            <option value="bill_5" <?= ($bill_type ?? '') === 'bill_5' ? 'selected' : '' ?>>Bill 5: Bridgework</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="description" class="col-md-3">Description:</label>
                    <div class="col-md-9">
                        <textarea name="description" id="description" class="form-control"><?= $description ?? ''; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="quantity" class="col-md-3">Quantity:</label>
                    <div class="col-md-9">
                        <input type="text" name="quantity" id="quantity" value="<?= $quantity ?? ''; ?>" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="unit" class="col-md-3">Unit:</label>
                    <div class="col-md-9">
                        <select name="unit" id="unit" class="form-control" required>
                            <option value="" selected disabled>Select Unit</option>
                            <option value="Sum" <?= ($unit ?? '') === 'Sum' ? 'selected' : '' ?>>Sum</option>
                            <option value="Ha" <?= ($unit ?? '') === 'Ha' ? 'selected' : '' ?>>Ha</option>
                            <option value="No" <?= ($unit ?? '') === 'No' ? 'selected' : '' ?>>No.</option>
                            <option value="M" <?= ($unit ?? '') === 'M' ? 'selected' : '' ?>>M</option>
                            <option value="M2" <?= ($unit ?? '') === 'M2' ? 'selected' : '' ?>>M<sup>2</sup> </option>
                            <option value="M3" <?= ($unit ?? '') === 'M3' ? 'selected' : '' ?>>M<sup>3</sup> </option>
                            <option value="M/tonne" <?= ($unit ?? '') === 'M/tonne' ? 'selected' : '' ?>>M/tonne</option>
                            <option value="Tonne" <?= ($unit ?? '') === 'Tonne' ? 'selected' : '' ?>>Tonne</option>
                            <option value="Lin.m" <?= ($unit ?? '') === 'Lin.m' ? 'selected' : '' ?>>Lin.m</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="rate" class="col-md-3">Rate:</label>
                    <div class="col-md-9">
                        <input type="text" name="rate" id="rate" value="<?= $rate ?? ''; ?>" class="form-control" disabled>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="amount" class="col-md-3">Amount:</label>
                    <div class="col-md-9">
                        <input type="text" name="amount" id="amount" value="<?= $amount ?? ''; ?>" class="form-control" disabled>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div id="validation_errors" class="text-danger"></div>
                <button type="button" class="btn btn-primary" onclick="saveBillAndReload()">Update</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    function saveBillAndReload() {
        $.ajax({
            url: '/index.php/bills/save_bill',
            method: 'POST',
            data: $('#bill_form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Close the modal
                    $('#billModal').modal('hide');
                    
                    // Reload the current page
                    location.reload();
                } else {
                    // Handle validation errors
                    if (response.errors) {
                        // Display validation errors to the user
                        var errorHtml = '';
                        $.each(response.errors, function(field, errorMessage) {
                            errorHtml += '<p>' + errorMessage + '</p>';
                        });
                        $('#validation_errors').html(errorHtml);
                    }
                }
            }
        });
    }
</script>