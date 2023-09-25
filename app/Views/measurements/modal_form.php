<style>
  .hidden {
    display: none;
  }
</style>
<!-- Edit form content -->
<form id="measurement_form" method="post" class="general-form">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <div class="form-group">
                <div class="row">
                    <label for="measurement_type" class="col-md-3">Measurement Type:</label>
                    <div class="col-md-9">
                        <select name="measurement_type" id="measurement_type" value="<?= $measurement_type ?? ''; ?> class="form-control" required>
                            <option value="" selected disabled>Select Measurement Type</option>
                            <option value="Area" <?= ($measurement_type ?? '') === 'Area' ? 'selected' : '' ?>>Area</option>
                            <option value="Volume" <?= ($measurement_type ?? '') === 'Volume' ? 'selected' : '' ?>>Volume</option>
                            <option value="Weight" <?= ($measurement_type ?? '') === 'Area' ? 'selected' : '' ?>>Weight</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
            <div class="row">
                    <label for="task_name" class="col-md-3">Task Name:</label>
                    <div class="col-md-9">
                        <select name="task_name" id="task_name" class="form-control">
                            <option value="" selected disabled>Select Task Name</option>
                            <?php foreach ($task_name as $measuring): ?>
                                <option value="<?= $measuring->task_name ?>"><?= $measuring->task_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Area Measurement Type -->
            <div id="areaFields" class="hidden">
                
                <div class="form-group">
                    <div class="row">
                        <label for="area_timesing" class="col-md-3">Timesing:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" value="<?= $area_timesing ?? '1'; ?>" name="area_timesing" id="area_timesing" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToAreaTimesing()">Add</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_number_of" class="col-md-3">Number of:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" value="<?= $area_number_of ?? '1'; ?>" name="area_number_of" id="area_number_of" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToAreaNumberOf()">Add</button>
                        </div>
                        
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_length" class="col-md-3">Length:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="area_length" id="area_length" onmouseout="GetAreaQuantity(), GetAreaTotal()" value="<?= $area_length ?? ''; ?>" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToAreaLength()">Add</button>
                        </div>   
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_breadth" class="col-md-3">Breadth:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="area_breadth" id="area_breadth" onmouseout="GetAreaQuantity(), GetAreaTotal()" value="<?= $area_breadth ?? ''; ?>" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToAreaBreadth()">Add</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_description" class="col-md-3">Description:</label>
                        <div class="col-md-9">
                            <input type="text" name="area_description" id="area_description" value="<?= $area_description ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_quantity" class="col-md-3">Area Quantity:</label>
                        <div class="col-md-9">
                            <input type="number" name="area_quantity" id="area_quantity" disabled onmouseover="GetAreaQuantity(), GetAreaTotal()" value="<?= $area_quantity ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_total" class="col-md-3">Area Total:</label>
                        <div class="col-md-9">
                            <input type="number" name="total" id="area_total" disabled onmouseover="GetAreaQuantity(), GetAreaTotal()" value="<?= $area_total ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_unit" class="col-md-3">Area Unit:</label>
                        <div class="col-md-9">
                            <select name="area_unit" id="area_unit" class="form-control" required>
                                <option value="<?php echo $area_unit; ?>" selected disabled>Select Area Unit</option>
                                <option value="mm2" <?= ($area_unit ?? '') === 'mm2' ? 'selected' : '' ?>>mm2</option>
                                <option value="cm2" <?= ($area_unit ?? '') === 'cm2' ? 'selected' : '' ?>>cm2</option>
                                <option value="m2" <?= ($area_unit ?? '') === 'm2' ? 'selected' : '' ?>>m2</option>
                            </select>
                        </div>
                    </div>
                </div> 

            </div>
            
            <!-- volume Measurement Type -->
            <div id="volumeFields" class="hidden">

                <div class="form-group">
                    <div class="row">
                        <label for="volume_timesing" class="col-md-3">Timesing:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" value="<?= $volume_timesing ?? '1'; ?>" name="volume_timesing" id="volume_timesing" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToVolumeTimesing()">Add</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_number_of" class="col-md-3">Number of:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" value="<?= $volume_number_of ?? '1'; ?>" name="volume_number_of" id="volume_number_of" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToVolumeNumberOf()">Add</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_length" class="col-md-3">Length:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="volume_length" id="volume_length" onmouseout="GetVolumequantity(), GetVolumeTotal()" value="<?= $volume_length ?? ''; ?>" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToVolumeLength()">Add</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_breadth" class="col-md-3">Breadth:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="volume_breadth" id="volume_breadth" onmouseout="GetVolumequantity(), GetVolumeTotal()" value="<?= $volume_breadth ?? ''; ?>" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToVolumeBreadth()">Add</button>
                        </div>
                    </div>
                </div>

                ,<div class="form-group">
                    <div class="row">
                        <label for="volume_height" class="col-md-3">Height:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="volume_height" id="volume_height" onmouseout="GetVolumequantity(), GetVolumeTotal()" value="<?= $volume_height ?? ''; ?>" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToVolumeHeight()">Add</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_description" class="col-md-3">Description:</label>
                        <div class="col-md-9">
                            <input type="text" name="volume_description" id="volume_description" value="<?= $volume_description ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_quantity" class="col-md-3">Volume Quantity:</label>
                        <div class="col-md-9">
                            <input type="number" name="volume_quantity" id="volume_quantity" disabled onmouseover="GetVolumequantity(), GetVolumeTotal()" value="<?= $volume_quantity ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_total" class="col-md-3">Volume Total:</label>
                        <div class="col-md-9">
                            <input type="number" name="total" id="volume_total" disabled onmouseover="GetVolumequantity(), GetVolumeTotal()" value="<?= $volume_total ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_unit" class="col-md-3">volume Unit:</label>
                        <div class="col-md-9">
                            <select name="volume_unit" id="volume_unit" class="form-control" required>
                                <option value="<?php echo $volume_unit; ?>" selected disabled>Select Area Unit</option>
                                <option value="mm3" <?= ($volume_unit ?? '') === 'mm3' ? 'selected' : '' ?>>mm3</option>
                                <option value="cm3" <?= ($volume_unit ?? '') === 'cm3' ? 'selected' : '' ?>>cm3</option>
                                <option value="m3" <?= ($volume_unit ?? '') === 'm3' ? 'selected' : '' ?>>m3</option>
                            </select>
                        </div>
                    </div>
                </div>                    

            </div>
            
            <!-- weight Measurement Type -->
            <div id="weightFields" class="hidden">

                <div class="form-group">
                    <div class="row">
                        <label for="bar_mark" class="col-md-3">Bar Mark:</label>
                        <div class="col-md-9">
                            <input type="text" name="bar_mark" id="bar_mark" value="<?= $bar_mark ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="bar-size" class="col-md-3">Bar Size(mm):</label>
                        <div class="col-md-9">
                            <select name="bar_size" id="bar_size" class="form-control" required>
                                <option value="<?php echo $bar_size; ?>" selected disabled>Select Bar Size</option>
                                <option value="6" <?= ($bar_size ?? '') === '6' ? 'selected' : '' ?>>6mm</option>
                                <option value="8" <?= ($bar_size ?? '') === '8' ? 'selected' : '' ?>>8mm</option>
                                <option value="10" <?= ($bar_size ?? '') === '10' ? 'selected' : '' ?>>10mm</option>
                                <option value="12" <?= ($bar_size ?? '') === '12' ? 'selected' : '' ?>>12mm</option>
                                <option value="16" <?= ($bar_size ?? '') === '16' ? 'selected' : '' ?>>16mm</option>
                                <option value="20" <?= ($bar_size ?? '') === '20' ? 'selected' : '' ?>>20mm</option>
                                <option value="25" <?= ($bar_size ?? '') === '25' ? 'selected' : '' ?>>25mm</option>
                                <option value="32" <?= ($bar_size ?? '') === '32' ? 'selected' : '' ?>>32mm</option>
                                <option value="40" <?= ($bar_size ?? '') === '40' ? 'selected' : '' ?>>40mm</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="cut_length" class="col-md-3">Length:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".001" name="cut_length" id="cut_length" onmouseout="GetTotalLength(), GetTotalWeight()" value="<?= $cut_length ?? ''; ?>" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToCutLength()">Add</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="number_used" class="col-md-3">Number of:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" value="<?= $number_used ?? '1'; ?>" name="number_used" id="number_used" onmouseout="GetTotalLength(), GetTotalWeight()" class="form-control">
                            <button type="button" class="btn btn-primary" onclick="AddToNumberUsed()">Add</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="weight_description" class="col-md-3">Description:</label>
                        <div class="col-md-9">
                            <input type="text" name="weight_description" id="weight_description" value="<?= $weight_description ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="total_weight_length" class="col-md-3">Total Length:</label>
                        <div class="col-md-9">
                            <input type="number" name="total_weight_length" id="total_weight_length" disabled onmouseover="GetTotalLength(), GetTotalWeight()" value="<?= $total_weight_length ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <label for="weight_quantity" class="col-md-3">Weight(kg):</label>
                        <div class="col-md-9">
                            <input type="number" name="weight_quantity" id="weight_quantity" disabled onmouseover="GetTotalLength(), GetTotalWeight()" value="<?= $weight_quantity ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="offcut_length" class="col-md-3">Offcut Length/Bar(m):</label>
                        <div class="col-md-9">
                            <input type="number" name="offcut_length" id="offcut_length" value="<?= $offcut_length ?? ''; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="modal-footer">
                <div id="validation_errors" class="text-danger"></div>
                <button type="button" class="btn btn-primary" onclick="saveMeasurementAndReload()">Save</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        const measurement_type = document.getElementById('measurement_type');
        const areaFields = document.getElementById('areaFields');
        const volumeFields = document.getElementById('volumeFields');
        const weightFields = document.getElementById('weightFields');

        measurement_type.addEventListener('change', function () {
            areaFields.classList.add('hidden');
            volume.classList.add('hidden');
            weightFields.classList.add('hidden');

            if (this.value === 'Area') {
            areaFields.classList.remove('hidden');
            } else if (this.value === 'Volume') {
            volumeFields.classList.remove('hidden');
            } else if (this.value === 'Weight') {
            weightFields.classList.remove('hidden');
            }
        });
    });
    function saveMeasurementAndReload() {
        $.ajax({
            url: '/index.php/measurement/save_measurement',
            method: 'POST',
            data: $('#measurement_form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Close the modal
                    $('#measurementModal').modal('hide');
                    
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
    function GetAreaQuantity(){
        //Fetch value from all input fields
        let first  = document.getElementById('area_number_of').value;
        let second = document.getElementById('area_length').value;
        let third  = document.getElementById('area_breadth').value;
        let fourth = document.getElementById('area_quantity');
        //Calculate the Area 
        let quantity = Number(first)*Number(second)*Number(third);

        //Assign the Area to the fourth field
        area_quantity.value = quantity;
    }

    function GetAreaTotal(){
        //Fetch value from all input fields
        let fifth  = document.getElementById('area_timesing').value;
        let sixth = document.getElementById('area_quantity').value;
        let seventh = document.getElementById('area_total');

        //Calculate the Total
        let total = Number(fifth)*Number(sixth);

        //Assign the Total to the seventh field
        area_total.value = total;
    }

    function GetVolumeQuantity(){
        //Fetch value from all input fields
        let eight  = document.getElementById('volume_number_of').value;
        let nineth = document.getElementById('volume_length').value;
        let tenth  = document.getElementById('volume_breadth').value;
        let eleventh = document.getElementById('volume_height').value;
        let twelveth = document.getElementById('volume_quantity');

        //Calculate the Volume 
        let volquantity = Number(eight)*Number(nineth)*Number(tenth)*Number(eleventh);

        //Assign the volume to the twelveth field
        volume_quantity.value = volquantity;
    }

    function GetVolumeTotal(){
        //Fetch value from all input fields
        let thirteenth  = document.getElementById('volume_timesing').value;
        let fourteenth = document.getElementById('volume_quantity').value;
        let fifteenth = document.getElementById('volume_total');

        //Calculate the Total
        let voltotal = Number(thirteenth)*Number(fourteenth);

        //Assign the Total to the fifteenth field
        area_total.value = voltotal;
    }

    function GetTotalLength(){
        //Fetch value from all input fields
        let sixteenth  = document.getElementById('cut_length').value;
        let seventeenth = document.getElementById('number_used').value;
        let eighteenth = document.getElementById('total_weight_length');

        //Calculate the Total
        let lengthtotal = Number(sixteenth)*Number(seventeenth);

        //Assign the Total to the eighteenth field
        total_weight_length.value = lengthtotal;
    }

    function GetTotalWeight(){
        //Fetch value from all input fields
        let nineteenth  = document.getElementById('total_weight_length').value;
        let twentieth = document.getElementById('weight_quantity');
        let twentyfirst = document.getElementById('bar_size').value;

        //Calculate the Total
        if (Number(twentyfirst) == 6) {
            weighttotal= 0.222*Number(nineteenth);
        }
        if (Number(twentyfirst) == 8) {
            weighttotal= 0.394*Number(nineteenth);
        }
        if (Number(twentyfirst) == 10) {
            weighttotal = 0.616*Number(nineteenth);
        }
        if (Number(twentyfirst) == 12) {
            weighttotal = 0.887*Number(nineteenth);
        }
        if (Number(twentyfirst) == 16) {
            weighttotal = 0.1577*Number(nineteenth);
        }
        if (Number(twentyfirst) == 20) {
            weighttotal = 2.464*Number(nineteenth);
        }
        if (Number(twentyfirst) == 25) {
            weighttotal = 3.850*Number(nineteenth);
        }
        if (Number(twentyfirst) == 32) {
            weighttotal = 6.308*Number(nineteenth);
        }
        if (Number(twentyfirst) == 40) {
            weighttotal = 9.856*Number(nineteenth);
        }


        //Assign the Total to the eighteenth field
        weight_quantity.value = weighttotal;
    }

</script>