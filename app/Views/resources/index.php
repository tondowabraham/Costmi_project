<div class="card">
    <div class="card-header title-tab">
        <h4 class="float-start"><?php echo app_lang('res_library'); ?></h4>
        <div class="title-button-group">
            <button class="btn btn-default" id="mat" onclick="showTable('Material')">Material Table</button>
            <button class="btn btn-default" id="lab" onclick="showTable('Labour')">Labour Table</button>
            <button class="btn btn-default" id="equip" onclick="showTable('Equipment')">Equipment Table</button>

            <?php
            echo modal_anchor(get_uri("resources/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_resource'), array("class" => "btn btn-default", "title" => app_lang('add_resource')));
            ?>
        </div>
    </div>
    <div id="materialTable" style="display: none;">
        <?php echo view('resources/material_table'); ?>
    </div>
    <div id="labourTable" style="display: none;">
        <?php echo view('resources/labour_table'); ?>
    </div>
    <div id="equipmentTable" style="display: none;">
        <?php echo view('resources/equipment_table'); ?>
    </div>   
</div>


<script>
    $(document).ready(function () {
        $('#resource_table').appTable();
    });

    function showTable(resourceType) {
        var tableRows = document.querySelectorAll("#resource_table tbody tr");
        
        tableRows.forEach(function(row) {
            var resourceTypeCell = row.querySelector("td:nth-child(1)");
            if (resourceTypeCell.textContent === resourceType) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }

    function showTable(tableType) {
        const materialTable = document.getElementById("materialTable");
        const labourTable = document.getElementById("labourTable");
        const equipmentTable = document.getElementById("equipmentTable");
        
        materialTable.style.display = "none";
        labourTable.style.display = "none";
        equipmentTable.style.display = "none";
        
        if (tableType === "Material") {
            materialTable.style.display = "block";
        } else if (tableType === "Labour") {
            labourTable.style.display = "block";
        } else if (tableType === "Equipment") {
            equipmentTable.style.display = "block";
        }
    }
</script>
