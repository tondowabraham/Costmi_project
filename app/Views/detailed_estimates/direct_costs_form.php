<style>
  .hidden {
    display: none;
  }
</style>
<!-- Edit form content -->
<form id="direct_cost_form" method="post" class="general-form">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <div class="form-group">
                <div class="row">
                    <label for="detailed_estimate_type" class="col-md-3">Detailed Estimate Type:</label>
                    <div class="col-md-9">
                        <select name="detailed_estimate_type" id="detailed_estimate_type" class="form-control" required>
                            <option selected disabled>Select Estimate Type</option>
                            <option value="Unit Rate Estimate">Unit Rate Estimate</option>
                            <option value="Operational Estimate">Operational Estimate</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
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

            <!-- Unit Rate Estimate Fields -->
            <div id="unitRateField" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="resource_type" class="col-md-3">Resource Type:</label>
                        <div class="col-md-9">
                            <input type="text" name="resource_type" id="resource_type" value="Material" class="form-control">
                        </div>
                    </div>
                </div>
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
            </div>

            <!-- Operational Rate Estimate Fields -->
            <div id="opRateField" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="resource_type" class="col-md-3">Resource Type:</label>
                        <div class="col-md-9">
                            <select name="resource_type" id="resource_type" class="form-control" required>
                                <option value="" selected disabled>Select Resource Type</option>
                                <option value="Labour">Labour</option>
                                <option value="Equipment">Equipment</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="section" class="col-md-3">Section:</label>
                    <div class="col-md-9">
                        <input type="text" name="section" id="section" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="trade" class="col-md-3">Trade:</label>
                    <div class="col-md-9">
                        <input type="text" name="trade" id="trade" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Unit Rate Estimate Type -->
            <div id="unitRateEst" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="material_name" class="col-md-3">Material Name:</label>
                        <div class="col-md-9">
                            <input type="text" name="material_name" id="material_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="resource_group" class="col-md-3">Resource Group:</label>
                        <div class="col-md-9">
                            <input type="text" name="resource_group" id="resource_group" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Labour Resource Type -->
            <div id="opEst" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="labour_name" class="col-md-3">Labour Name:</label>
                        <div class="col-md-9">
                            <input type="text" name="labour_name" id="labour_name" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Equipment Resource Type -->
            <div id="hybridEst" class="hidden">
                <div class="form-group">
                    <div class="row">
                        <label for="equipment_name_code" class="col-md-3">Equipment Name Code:</label>
                        <div class="col-md-9">
                            <input type="text" name="equipment_name_code" id="equipment_name_code" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="notes" class="col-md-3">Note:</label>
                    <div class="col-md-9">
                        <textarea name="notes" id="notes" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <div id="validation_errors" class="text-danger"></div>
                <button type="button" class="btn btn-primary" onclick="saveDirectCostEstimateAndReload()">Save</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        const detailed_estimate_type = document.getElementById('detailed_estimate_type');
        const unitRateEst = document.getElementById('unitRateEst');
        const opEst = document.getElementById('opEst');
        const hybridEst = document.getElementById('hybridEst');

        detailed_estimate_type.addEventListener('change', function () {
            unitRateEst.classList.add('hidden');
            opEst.classList.add('hidden');
            hybridEst.classList.add('hidden');

            if (this.value === 'Unit Rate Estimate') {
            unitRateEst.classList.remove('hidden');
            } else if (this.value === 'Operational Estimate') {
            opEst.classList.remove('hidden');
            } else if (this.value === 'Hybrid') {
            hybridEst.classList.remove('hidden');
            }
        });
    });
    function saveDirectCostEstimateAndReload() {
        $.ajax({
            url: '/index.php/detailed_estimates/save_direct_cost',
            method: 'POST',
            data: $('#direct_cost_form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Close the modal
                    $('#directCostModal').modal('hide');
                    
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