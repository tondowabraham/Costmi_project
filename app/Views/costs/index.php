<div class="card">
    <div class="card-header title-tab">
        <h4 class="float-start"><?php echo app_lang('cost_library'); ?></h4>
        <div class="title-button-group">
            <button id="materialButton" class="btn btn-default">Material Table</button>
            <button id="labourButton" class="btn btn-default">Labour Table</button>
            <button id="equipmentButton" class="btn btn-default">Equipment Table</button>
            
            <?php
            echo modal_anchor(get_uri("costs/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_cost'), array("class" => "btn btn-default", "title" => app_lang('add_cost')));
            ?>
        </div>
    </div>
    <div id="materialTab" style="display: none;">
        <?php echo view('costs/material_table'); ?>
    </div>
    <div id="labourTab" style="display: none;">
        <?php echo view('costs/labour_table'); ?>
    </div>
    <div id="equipmentTab" style="display: none;">
        <?php echo view('costs/equipment_table'); ?>
    </div>
</div>


<script>
    $(document).ready(function () {
        // Initialize the DataTable for your main table (cost_table)
        $('#cost_table').DataTable();

        // Function to show the specified table and hide others
        function showTable(tabId) {
            // Hide all table divs
            $('#materialTab, #labourTab, #equipmentTab').hide();
            
            // Show the selected table
            $(tabId).show();
        }

        // Button click handlers
        $('#materialButton').click(function () {
            showTable('#materialTab');
        });

        $('#labourButton').click(function () {
            showTable('#labourTab');
        });

        $('#equipmentButton').click(function () {
            showTable('#equipmentTab');
        });
    });
</script>

