<div class="card">
    <div class="card-header title-tab">
        <h4 class="float-start"><?php echo app_lang('meas_library'); ?></h4>
        <div class="title-button-group">
            <button class="btn btn-default" id="areaButton" onclick="showTable('Area')">Area Table</button>
            <button class="btn btn-default" id="volumeButton" onclick="showTable('Volume')">Volume Table</button>
            <button class="btn btn-default" id="weightButton" onclick="showTable('Weight')">Weight Table</button>

            <?php
            echo modal_anchor(get_uri("measurements/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_measurement'), array("class" => "btn btn-default", "title" => app_lang('add_measurement')));
            ?>
        </div>
    </div>
    <div id="areaTable" style="display: none;">
        <?php echo view('measurements/area_table'); ?>
    </div>
    <div id="volumeTable" style="display: none;">
        <?php echo view('measurements/volume_table'); ?>
    </div>
    <div id="weightTable" style="display: none;">
        <?php echo view('measurements/weight_table'); ?>
    </div>   
</div>

<script>
    $(document).ready(function () {
        $('#measurement_table').appTable();
    });

    function showTable(tableType) {
        const areaTable = document.getElementById("areaTable");
        const volumeTable = document.getElementById("volumeTable");
        const weightTable = document.getElementById("weightTable");
        
        areaTable.style.display = "none";
        volumeTable.style.display = "none";
        weightTable.style.display = "none";
        
        if (tableType === "Area") {
            areaTable.style.display = "block";
        } else if (tableType === "Volume") {
            volumeTable.style.display = "block";
        } else if (tableType === "Weight") {
            weightTable.style.display = "block";
        }
    }
</script>
