<style>
  .hidden {
    display: none;
  }
</style>

<!-- Edit form content -->
<form id="cost_form" method="post" class="general-form">
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

            <!-- Material cost Type -->
            <div id="materialField" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="material_name" class="col-md-3">Select Material:</label>
                        <div class="col-md-9">
                            <select name="material_name" id="material_name" class="form-control">
                                <option value="" selected disabled>Select Material</option>
                                <?php foreach ($materials as $material): ?>
                                    <option value="<?= $material->material_name ?>" <?= ($material->material_name == ($material_name ?? '')) ? 'selected' : '' ?>><?= $material->material_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="description" class="col-md-3">Description:</label>
                        <div class="col-md-9">
                            <select name="description" id="description" class="form-control">
                                <option value="" selected disabled>Select Description</option>
                                <?php foreach ($description as $shalaye): ?>
                                    <option value="<?= $shalaye->description ?>" <?= ($shalaye->description == ($description ?? '')) ? 'selected' : '' ?>><?= $shalaye->description ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="material_code" class="col-md-3">Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="material_code" id="material_code" class="form-control" value="<?= $material_code ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="material_manufacturer" class="col-md-3">Material Manufacturer:</label>
                        <div class="col-md-9">
                            <select name="material_manufacturer" id="material_manufacturer" class="form-control">
                                <option value="" selected disabled>Select Manufacturer</option>
                                <?php foreach ($material_manufacturer as $maker): ?>
                                    <option value="<?= $maker->material_manufacturer ?>" <?= ($maker->material_manufacturer == ($material_manufacturer ?? '')) ? 'selected' : '' ?>><?= $maker->material_manufacturer ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="unit" class="col-md-3">Unit:</label>
                        <div class="col-md-9">
                            <input type="text" name="unit" id="unit" class="form-control" value="<?= $unit ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="size" class="col-md-3">Size:</label>
                        <div class="col-md-9">
                            <input type="text" name="size" id="size" class="form-control" value="<?= $size ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="cost" class="col-md-3">Cost:</label>
                        <div class="col-md-9">
                            <input type="text" name="cost" id="cost" class="form-control" value="<?= $cost ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="material_source" class="col-md-3">Source:</label>
                        <div class="col-md-9">
                            <input type="text" name="material_source" id="material_source" class="form-control" value="<?= $material_source ?? '' ?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Labour cost Type -->
            <div id="labourField" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="labour_name" class="col-md-3">Select Labourer:</label>
                        <div class="col-md-9">
                            <select name="labour_name" id="labour_name" class="form-control">
                                <option value="" selected disabled>Select Labourer</option>
                                <?php foreach ($labour_name as $labourer): ?>
                                    <option value="<?= $labourer->labour_name ?>" <?= ($labourer->labour_name == ($labour_name ?? '')) ? 'selected' : '' ?>><?= $labourer->labour_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- ... Repeat for other Labour fields ... -->
            </div>
            
            <!-- Equipment cost Type -->
            <div id="equipmentField" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="equipment_name" class="col-md-3">Select Equipment:</label>
                        <div class="col-md-9">
                            <select name="equipment_name" id="equipment_name" class="form-control">
                                <option value="" selected disabled>Select Equipment</option>
                                <?php foreach ($equipment_name as $equip_name): ?>
                                    <option value="<?= $equip_name->equipment_name ?>" <?= ($equip_name->equipment_name == ($equipment_name ?? '')) ? 'selected' : '' ?>><?= $equip_name->equipment_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- ... Repeat for other Equipment fields ... -->
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="effective_from" class="col-md-3">Effective From:</label>
                    <div class="col-md-9">
                        <input type="date" name="effective_from" id="effective_from" class="form-control" value="<?= $effective_from ?? '' ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="validity" class="col-md-3">Validity:</label>
                    <div class="col-md-9">
                        <input type="date" name="validity" id="validity" class="form-control" value="<?= $validity ?? '' ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="notes" class="col-md-3">Note:</label>
                    <div class="col-md-9">
                        <textarea name="notes" class="form-control"><?= $notes ?? '' ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <div id="validation_errors" class="text-danger"></div>
                <button type="button" class="btn btn-primary" onclick="savecostAndReload()">Save</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        const cost_type = document.getElementById('resource_type');
        const materialField = document.getElementById('materialField');
        const labourField = document.getElementById('labourField');
        const equipmentField = document.getElementById('equipmentField');

        cost_type.addEventListener('change', function () {
            materialField.classList.add('hidden');
            labourField.classList.add('hidden');
            equipmentField.classList.add('hidden');

            if (this.value === 'Material') {
                materialField.classList.remove('hidden');
            } else if (this.value === 'Labour') {
                labourField.classList.remove('hidden');
            } else if (this.value === 'Equipment') {
                equipmentField.classList.remove('hidden');
            }
        });
    });

    function savecostAndReload() {
        $.ajax({
            url: '/index.php/costs/save_cost',
            method: 'POST',
            data: $('#cost_form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Close the modal
                    $('#costModal').modal('hide');
                    
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
