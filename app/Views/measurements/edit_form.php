<form id="measurement_form" method="post" class="general-form">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <div class="form-group">
                <div class="row">
                    <label for="measurement_type" class="col-md-3">Measurement Type:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="measurement_type" name="measurement_type" value="<?= $measurement['measurement_type']; ?>" disabled>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="task_name" class="col-md-3">Task Name:</label>
                    <div class="col-md-9">
                       <input type="text" name="task_name" id="task_name" class="form-control" value="<?= $measurement['task_name']; ?>" >
                    </div>
                </div>
            </div>

            <?php foreach ($measurements as $key => $measurement): ?>
            <?php if ($measurement['measurement_type'] === 'Area'): ?>


            <!-- Area Measurement Type -->
            <div id="areaFields" class="hidden">

                <div class="form-group">
                    <div class="row">
                        <label for="area_timesing" class="col-md-3">Timesing:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" name="area_timesing" id="area_timesing" class="form-control" value="<?= $measurement['area_timesing']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToAreaTimesing()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_number_of" class="col-md-3">Number of:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" name="area_number_of" id="area_number_of" class="form-control" value="<?= $measurement['area_number_of']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToAreaNumberOf()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_length" class="col-md-3">Length:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="area_length" id="area_length" onmouseout="GetAreaQuantity(), GetAreaTotal()" class="form-control" value="<?= $measurement['area_length']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToAreaLength()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_breadth" class="col-md-3">Breadth:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="area_breadth" id="area_breadth" onmouseout="GetAreaQuantity(), GetAreaTotal()" class="form-control" value="<?= $measurement['area_breadth']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToAreaBreadth()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_description" class="col-md-3">Description:</label>
                        <div class="col-md-9">
                            <input type="text" name="area_description" id="area_description" class="form-control" value="<?= $measurement['area_description']; ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_quantity" class="col-md-3">Area Quantity:</label>
                        <div class="col-md-9">
                            <input type="number" name="area_quantity" id="area_quantity" disabled onmouseover="GetAreaQuantity(), GetAreaTotal()" class="form-control" value="<?= $measurement['area_quantity']; ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_total" class="col-md-3">Area Total:</label>
                        <div class="col-md-9">
                            <input type="number" name="total" id="area_total" disabled onmouseover="GetAreaQuantity(), GetAreaTotal()" class="form-control" value="<?= $measurement['area_total']; ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="area_unit" class="col-md-3">Area Unit:</label>
                        <div class="col-md-9">
                         <input type="text" class="form-control" id="area_unit" name="measurement_type" value="<?= $measurement['measurement_type']; ?>" disabled> 
                        </div>
                    </div>
                </div> 

            </div>

            <?php endif; ?>
            <?php if ($measurement['measurement_type'] === 'Volume'): ?>

            <!-- Volume Measurement Type -->
            <div id="volumeFields" class="hidden">

                <div class="form-group">
                    <div class="row">
                        <label for="volume_timesing" class="col-md-3">Timesing:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" name="volume_timesing" id="volume_timesing" class="form-control" value="<?= $measurement['volume_timeesing']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToVolumeTimesing()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_number_of" class="col-md-3">Number of:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" value="1" name="volume_number_of" id="volume_number_of" class="form-control" value="<?= $measurement['volume_number_of']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToVolumeNumberOf()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_length" class="col-md-3">Length:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="volume_length" id="volume_length" onmouseout="GetVolumequantity(), GetVolumeTotal()" class="form-control" value="<?= $measurement['volume_length']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToVolumeLength()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_breadth" class="col-md-3">Breadth:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="volume_breadth" id="volume_breadth" onmouseout="GetVolumequantity(), GetVolumeTotal()" class="form-control" value="<?= $measurement['volume_breadth']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToVolumeBreadth()">Add</button>
                    </div>
                </div>

                div class="form-group">
                    <div class="row">
                        <label for="volume_height" class="col-md-3">Height:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".01" name="volume_height" id="volume_height" onmouseout="GetVolumequantity(), GetVolumeTotal()" class="form-control" value="<?= $measurement['volume_height']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToVolumeHeight()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_description" class="col-md-3">Description:</label>
                        <div class="col-md-9">
                            <input type="text" name="volume_description" id="volume_description" class="form-control" value="<?= $measurement['volume_description']; ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_quantity" class="col-md-3">Volume Quantity:</label>
                        <div class="col-md-9">
                            <input type="number" name="volume_quantity" id="volume_quantity" disabled onmouseover="GetVolumequantity(), GetVolumeTotal()" class="form-control" value="<?= $measurement['volume_quantity']; ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_total" class="col-md-3">Volume Total:</label>
                        <div class="col-md-9">
                            <input type="number" name="volume_total" id="volume_total" disabled onmouseover="GetVolumequantity(), GetVolumeTotal()" class="form-control" value="<?= $measurement['volume_total']; ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="volume_unit" class="col-md-3">Volume Unit:</label>
                        <div class="col-md-9">
                        <input type="text" class="form-control" id="volume_unit" name="volume_unit" value="<?= $measurement['volume_unit']; ?>" disabled>
                        </div>
                    </div>
                </div>                    

            </div>
            
            <?php endif; ?>
            <?php if ($measurement['measurement_type'] === 'Weight'): ?>

            <!-- weight Measurement Type -->
            <div id="weightFields" class="hidden">

                <div class="form-group">
                    <div class="row">
                        <label for="bar_mark" class="col-md-3">Bar Mark:</label>
                        <div class="col-md-9">
                            <input type="text" name="bar_mark" id="bar_mark" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="bar-size" class="col-md-3">Bar Size(mm):</label>
                        <div class="col-md-9">
                        <input type="text" class="form-control" id="bar_size" name="bar_size" value="<?= $measurement['bar_size']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="cut_length" class="col-md-3">Length:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step=".001" name="cut_length" id="cut_length" onmouseout="GetTotalLength(), GetTotalWeight()" class="form-control" value="<?= $measurement['cut_length']; ?>" >
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToCutLength()">Add</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="number_used" class="col-md-3">Number of:</label>
                        <div class="col-md-9">
                            <input type="number" min='1' step="1" value="<?= $measurement['number_used']; ?>" name="number_used" id="number_used" onmouseout="GetTotalLength(), GetTotalWeight()" class="form-control">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="AddToNumberUsed()">Add</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="weight_description" class="col-md-3">Description:</label>
                        <div class="col-md-9">
                            <input type="text" name="weight_description" id="weight_description" class="form-control" value="<?= $measurement['weight_description']; ?>" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="total_weight_length" class="col-md-3">Total Length:</label>
                        <div class="col-md-9">
                            <input type="number" name="total_weight_length" id="total_weight_length" disabled onmouseover="GetTotalLength(), GetTotalWeight()" class="form-control" value="<?= $measurement['total_weight_length']; ?>" >
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <label for="weight_quantity" class="col-md-3">Weight(kg):</label>
                        <div class="col-md-9">
                            <input type="number" name="weight_quantity" id="weight_quantity" disabled onmouseover="GetTotalLength(), GetTotalWeight()" class="form-control" value="<?= $measurement['weight_quantity']; ?>" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="offcut_length" class="col-md-3">Offcut Length/Bar(m):</label>
                        <div class="col-md-9">
                            <input type="number" name="offcut_length" id="offcut_length" class="form-control" value="<?= $measurement['offcut_length']; ?>" >
                        </div>
                    </div>
                </div>
                
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            
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