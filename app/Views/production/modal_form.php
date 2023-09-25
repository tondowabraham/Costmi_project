<style>
  .hidden {
    display: none;
  }
</style>
<!-- Edit form content -->
<form id="prod_rate_form" method="post" class="general-form">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <div class="form-group">
                <div class="row">
                    <label for="resource_type" class="col-md-3">Resource Type:</label>
                    <div class="col-md-9">
                        <select name="resource_type" id="resource_type" class="form-control" required>
                            <option value="" selected disabled>Select Resource Type</option>
                            <option value="Labour" <?php echo ($resource_type ?? '') === 'Labour' ? 'selected' : ''; ?>>Labour</option>
                            <option value="Equipment" <?php echo ($resource_type ?? '') === 'Equipment' ? 'selected' : ''; ?>>Equipment</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="LabourGroup" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="item" class="col-md-3">Labour Item:</label>
                        <div class="col-md-9">
                            <select name="item" id="item" class="form-control">
                                <option value="" selected disabled>Select Labourer</option>
                                <?php foreach ($labour_name as $labourer): ?>
                                    <option value="<?= $labourer->labour_name ?>"><?= $labourer->labour_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="EquipGroup" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="item" class="col-md-3">Item:</label>
                        <div class="col-md-9">
                            <select name="item" id="item" class="form-control">
                                <option value="" selected disabled>Select Equipment</option>
                                <?php foreach ($equipment_name as $equip_name): ?>
                                    <option value="<?= $equip_name->equipment_name ?>"><?= $equip_name->equipment_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="task_name" class="col-md-3">Activity:</label>
                    <div class="col-md-9">
                        <select name="task_name" id="task_name" class="form-control">
                            <option value="" selected disabled>Select Activity</option>
                            <?php foreach ($task_name as $activity): ?>
                                <option value="<?= $activity->task_name ?>"><?= $activity->task_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="size" class="col-md-3">Size/Capacity:</label>
                    <div class="col-md-9">
                        <input type="text" name="size" id="size" value="<?= $size ?? ''; ?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="conditions" class="col-md-3">Condition:</label>
                    <div class="col-md-9">
                        <input type="text" name="conditions" id="conditions" value="<?= $conditions ?? ''; ?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="output" class="col-md-3">Output:</label>
                    <div class="col-md-9">
                        <input type="text" name="output" id="output" value="<?= $output ?? ''; ?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="units" class="col-md-3">Units/hr:</label>
                    <div class="col-md-9">
                        <input type="text" name="units" id="units" value="<?= $units ?? ''; ?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="special_conditions" class="col-md-3">Special Conditions:</label>
                    <div class="col-md-9">
                        <textarea name="special_conditions" id="special_conditions" class="form-control"><?= $special_conditions ?? ''; ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <div id="validation_errors" class="text-danger"></div>
                <button type="button" class="btn btn-primary" onclick="saveProdRateAndReload()">Save</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        const cost_type = document.getElementById('resource_type');
        const labourGroup = document.getElementById('LabourGroup');
        const equipGroup = document.getElementById('EquipGroup');

        cost_type.addEventListener('change', function () {
            labourGroup.classList.add('hidden');
            equipGroup.classList.add('hidden');

            if (this.value === 'Labour') {
                labourGroup.classList.remove('hidden');
            } else if (this.value === 'Equipment') {
                equipGroup.classList.remove('hidden');
            }
        });
    });

    function saveProdRateAndReload() {
        $.ajax({
            url: '/index.php/production/save_prod_rate',
            method: 'POST',
            data: $('#prod_rate_form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Close the modal
                    $('#prodRateModal').modal('hide');
                    
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