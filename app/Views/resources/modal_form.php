<style>
  .hidden {
    display: none;
  }
</style>
<!-- Edit form content -->
<form id="resource_form" method="post" class="general-form">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <div class="form-group">
                <div class="row">
                    <label for="resource_type" class="col-md-3">Resource Type:</label>
                    <div class="col-md-9">
                        <select name="resource_type" id="resource_type" class="form-control" required>
                            <option value="<?php echo $resource_type; ?>" selected disabled>Select Resource Type</option>
                            <option value="Material" <?= ($resource_type ?? '') === 'Material' ? 'selected' : '' ?>>Material</option>
                            <option value="Labour" <?= ($resource_type ?? '') === 'Labour' ? 'selected' : '' ?>>Labour</option>
                            <option value="Equipment" <?= ($resource_type ?? '') === 'Equipment' ? 'selected' : '' ?>>Equipment</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Material Resource Type -->
            <div id="materialFields" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="material_name" class="col-md-3">Material Name:</label>
                        <div class="col-md-9">
                            <input type="text" name="material_name" id="material_name" value="<?= $material_name ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="material_name_code" class="col-md-3">Material Name Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="material_name_code" id="material_name_code" value="<?= $material_name_code ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="material_group" class="col-md-3">Material Group:</label>
                        <div class="col-md-9">
                            <input type="text" name="material_group" id="material_group" value="<?= $material_group ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="material_group_code" class="col-md-3">Material Group Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="material_group_code" id="material_group_code" value="<?= $material_group_code ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="description" class="col-md-3">Description:</label>
                        <div class="col-md-9">
                            <input type="text" name="description" id="description" value="<?= $description ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="description_code" class="col-md-3">Description Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="description_code" id="description_code" value="<?= $description_code ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="material_manufacturer" class="col-md-3">Material Manufacturer:</label>
                        <div class="col-md-9">
                            <input type="text" name="material_manufacturer" id="material_manufacturer" value="<?= $material_manufacturer ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="unit" class="col-md-3">Unit:</label>
                        <div class="col-md-9">
                            <input type="text" name="unit" id="unit" value="<?= $unit ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="size" class="col-md-3">Size:</label>
                        <div class="col-md-9">
                            <input type="text" name="size" id="size" value="<?= $size ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Labour Resource Type -->
            <div id="labourFields" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="labour_name" class="col-md-3">Labour Name:</label>
                        <div class="col-md-9">
                            <input type="text" name="labour_name" id="labour_name" value="<?= $labour_name ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="labour_code" class="col-md-3">Labour Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="labour_code" id="labour_code" value="<?= $labour_code ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="trade" class="col-md-3">Trade:</label>
                        <div class="col-md-9">
                            <input type="text" name="trade" id="trade" value="<?= $trade ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="trade_code" class="col-md-3">Trade Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="trade_code" id="trade_code" value="<?= $trade_code ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="trade_category" class="col-md-3">Labour Category:</label>
                        <div class="col-md-9">
                            <input type="text" name="trade_category" id="trade_category" value="<?= $trade_category ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="trade_category_code" class="col-md-3">Labour Category Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="trade_category_code" id="trade_category_code" value="<?= $trade_category_code ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="trade_status" class="col-md-3">Labour Status:</label>
                        <div class="col-md-9">
                            <input type="text" name="trade_status" id="trade_status" value="<?= $trade_status ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Equipment Resource Type -->
            <div id="equipmentFields" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="equipment_name" class="col-md-3">Equipment Name:</label>
                        <div class="col-md-9">
                            <input type="text" name="equipment_name" id="equipment_name" value="<?= $equipment_name ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="equipment_name_code" class="col-md-3">Equipment Name Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="equipment_name_code" id="equipment_name_code" value="<?= $equipment_name_code ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="equipment_category" class="col-md-3">Equipment Category:</label>
                        <div class="col-md-9">
                            <input type="text" name="equipment_category" id="equipment_category" value="<?= $equipment_category ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="equipment_category_code" class="col-md-3">Equipment Category Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="equipment_category_code" id="equipment_category_code" value="<?= $equipment_category_code ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="equipment_manufacturer" class="col-md-3">Equipment Manufacturer:</label>
                        <div class="col-md-9">
                            <input type="text" name="equipment_manufacturer" id="equipment_manufacturer" value="<?= $equipment_manufacturer ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="equipment_model" class="col-md-3">Model:</label>
                        <div class="col-md-9">
                            <input type="text" name="equipment_model" id="equipment_model" value="<?= $equipment_model ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="power_rating" class="col-md-3">Power Rating:</label>
                        <div class="col-md-9">
                            <input type="text" name="power_rating" id="power_rating" value="<?= $power_rating ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="equipment_status" class="col-md-3">Equipment Status:</label>
                        <div class="col-md-9">
                            <input type="text" name="equipment_status" id="equipment_status" value="<?= $equipment_status ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="notes" class="col-md-3">Note:</label>
                    <div class="col-md-9">
                        <textarea name="notes" id="notes" class="form-control"><?= $notes ?? ''; ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <div id="validation_errors" class="text-danger"></div>
                <button type="button" class="btn btn-primary" onclick="saveResourceAndReload()">Save</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        const resource_type = document.getElementById('resource_type');
        const materialFields = document.getElementById('materialFields');
        const labourFields = document.getElementById('labourFields');
        const equipmentFields = document.getElementById('equipmentFields');

        resource_type.addEventListener('change', function () {
            materialFields.classList.add('hidden');
            labourFields.classList.add('hidden');
            equipmentFields.classList.add('hidden');

            if (this.value === 'Material') {
            materialFields.classList.remove('hidden');
            } else if (this.value === 'Labour') {
            labourFields.classList.remove('hidden');
            } else if (this.value === 'Equipment') {
            equipmentFields.classList.remove('hidden');
            }
        });
    });
    function saveResourceAndReload() {
        $.ajax({
            url: '/index.php/resources/save_resource',
            method: 'POST',
            data: $('#resource_form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Close the modal
                    $('#resourceModal').modal('hide');
                    
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